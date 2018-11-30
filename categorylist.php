<?php
namespace PHPMaker2019\ferryman;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$category_list = new category_list();

// Run the page
$category_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$category->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcategorylist = currentForm = new ew.Form("fcategorylist", "list");
fcategorylist.formKeyCountName = '<?php echo $category_list->FormKeyCountName ?>';

// Validate form
fcategorylist.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($category_list->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->name->caption(), $category->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($category_list->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->description->caption(), $category->description->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew.alert(ew.language.phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
fcategorylist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "name", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	return true;
}

// Form_CustomValidate event
fcategorylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorylist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcategorylistsrch = currentSearchForm = new ew.Form("fcategorylistsrch");

// Filters
fcategorylistsrch.filterList = <?php echo $category_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$category->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($category_list->TotalRecs > 0 && $category_list->ExportOptions->visible()) { ?>
<?php $category_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->ImportOptions->visible()) { ?>
<?php $category_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->SearchOptions->visible()) { ?>
<?php $category_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($category_list->FilterOptions->visible()) { ?>
<?php $category_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$category_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$category->isExport() && !$category->CurrentAction) { ?>
<form name="fcategorylistsrch" id="fcategorylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($category_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcategorylistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="category">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($category_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($category_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $category_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($category_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $category_list->showPageHeader(); ?>
<?php
$category_list->showMessage();
?>
<?php if ($category_list->TotalRecs > 0 || $category->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($category_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> category">
<?php if (!$category->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$category->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($category_list->Pager)) $category_list->Pager = new NumericPager($category_list->StartRec, $category_list->DisplayRecs, $category_list->TotalRecs, $category_list->RecRange, $category_list->AutoHidePager) ?>
<?php if ($category_list->Pager->RecordCount > 0 && $category_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($category_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($category_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($category_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $category_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($category_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($category_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($category_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $category_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $category_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $category_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($category_list->TotalRecs > 0 && (!$category_list->AutoHidePageSizeSelector || $category_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="category">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($category_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($category_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($category_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($category_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($category_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcategorylist" id="fcategorylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<div id="gmp_category" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($category_list->TotalRecs > 0 || $category->isAdd() || $category->isCopy() || $category->isGridEdit()) { ?>
<table id="tbl_categorylist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$category_list->RowType = ROWTYPE_HEADER;

// Render list options
$category_list->renderListOptions();

// Render list options (header, left)
$category_list->ListOptions->render("header", "left");
?>
<?php if ($category->name->Visible) { // name ?>
	<?php if ($category->sortUrl($category->name) == "") { ?>
		<th data-name="name" class="<?php echo $category->name->headerCellClass() ?>"><div id="elh_category_name" class="category_name"><div class="ew-table-header-caption"><?php echo $category->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $category->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $category->SortUrl($category->name) ?>',1);"><div id="elh_category_name" class="category_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category->name->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($category->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<?php if ($category->sortUrl($category->description) == "") { ?>
		<th data-name="description" class="<?php echo $category->description->headerCellClass() ?>"><div id="elh_category_description" class="category_description"><div class="ew-table-header-caption"><?php echo $category->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $category->description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $category->SortUrl($category->description) ?>',1);"><div id="elh_category_description" class="category_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $category->description->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($category->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($category->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$category_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($category->isAdd() || $category->isCopy()) {
		$category_list->RowIndex = 0;
		$category_list->KeyCount = $category_list->RowIndex;
		if ($category->isCopy() && !$category_list->loadRow())
			$category->CurrentAction = "add";
		if ($category->isAdd())
			$category_list->loadRowValues();
		if ($category->EventCancelled) // Insert failed
			$category_list->restoreFormValues(); // Restore form values

		// Set row properties
		$category->resetAttributes();
		$category->RowAttrs = array_merge($category->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_category', 'data-rowtype'=>ROWTYPE_ADD));
		$category->RowType = ROWTYPE_ADD;

		// Render row
		$category_list->renderRow();

		// Render list options
		$category_list->renderListOptions();
		$category_list->StartRowCnt = 0;
?>
	<tr<?php echo $category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$category_list->ListOptions->render("body", "left", $category_list->RowCnt);
?>
	<?php if ($category->name->Visible) { // name ?>
		<td data-name="name">
<span id="el<?php echo $category_list->RowCnt ?>_category_name" class="form-group category_name">
<input type="text" data-table="category" data-field="x_name" name="x<?php echo $category_list->RowIndex ?>_name" id="x<?php echo $category_list->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<input type="hidden" data-table="category" data-field="x_name" name="o<?php echo $category_list->RowIndex ?>_name" id="o<?php echo $category_list->RowIndex ?>_name" value="<?php echo HtmlEncode($category->name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($category->description->Visible) { // description ?>
		<td data-name="description">
<span id="el<?php echo $category_list->RowCnt ?>_category_description" class="form-group category_description">
<input type="text" data-table="category" data-field="x_description" name="x<?php echo $category_list->RowIndex ?>_description" id="x<?php echo $category_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="category" data-field="x_description" name="o<?php echo $category_list->RowIndex ?>_description" id="o<?php echo $category_list->RowIndex ?>_description" value="<?php echo HtmlEncode($category->description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_list->ListOptions->render("body", "right", $category_list->RowCnt);
?>
<script>
fcategorylist.updateLists(<?php echo $category_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($category->ExportAll && $category->isExport()) {
	$category_list->StopRec = $category_list->TotalRecs;
} else {

	// Set the last record to display
	if ($category_list->TotalRecs > $category_list->StartRec + $category_list->DisplayRecs - 1)
		$category_list->StopRec = $category_list->StartRec + $category_list->DisplayRecs - 1;
	else
		$category_list->StopRec = $category_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $category_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($category_list->FormKeyCountName) && ($category->isGridAdd() || $category->isGridEdit() || $category->isConfirm())) {
		$category_list->KeyCount = $CurrentForm->getValue($category_list->FormKeyCountName);
		$category_list->StopRec = $category_list->StartRec + $category_list->KeyCount - 1;
	}
}
$category_list->RecCnt = $category_list->StartRec - 1;
if ($category_list->Recordset && !$category_list->Recordset->EOF) {
	$category_list->Recordset->moveFirst();
	$selectLimit = $category_list->UseSelectLimit;
	if (!$selectLimit && $category_list->StartRec > 1)
		$category_list->Recordset->move($category_list->StartRec - 1);
} elseif (!$category->AllowAddDeleteRow && $category_list->StopRec == 0) {
	$category_list->StopRec = $category->GridAddRowCount;
}

// Initialize aggregate
$category->RowType = ROWTYPE_AGGREGATEINIT;
$category->resetAttributes();
$category_list->renderRow();
$category_list->EditRowCnt = 0;
if ($category->isEdit())
	$category_list->RowIndex = 1;
if ($category->isGridAdd())
	$category_list->RowIndex = 0;
if ($category->isGridEdit())
	$category_list->RowIndex = 0;
while ($category_list->RecCnt < $category_list->StopRec) {
	$category_list->RecCnt++;
	if ($category_list->RecCnt >= $category_list->StartRec) {
		$category_list->RowCnt++;
		if ($category->isGridAdd() || $category->isGridEdit() || $category->isConfirm()) {
			$category_list->RowIndex++;
			$CurrentForm->Index = $category_list->RowIndex;
			if ($CurrentForm->hasValue($category_list->FormActionName) && $category_list->EventCancelled)
				$category_list->RowAction = strval($CurrentForm->getValue($category_list->FormActionName));
			elseif ($category->isGridAdd())
				$category_list->RowAction = "insert";
			else
				$category_list->RowAction = "";
		}

		// Set up key count
		$category_list->KeyCount = $category_list->RowIndex;

		// Init row class and style
		$category->resetAttributes();
		$category->CssClass = "";
		if ($category->isGridAdd()) {
			$category_list->loadRowValues(); // Load default values
		} else {
			$category_list->loadRowValues($category_list->Recordset); // Load row values
		}
		$category->RowType = ROWTYPE_VIEW; // Render view
		if ($category->isGridAdd()) // Grid add
			$category->RowType = ROWTYPE_ADD; // Render add
		if ($category->isGridAdd() && $category->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$category_list->restoreCurrentRowFormValues($category_list->RowIndex); // Restore form values
		if ($category->isEdit()) {
			if ($category_list->checkInlineEditKey() && $category_list->EditRowCnt == 0) { // Inline edit
				$category->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($category->isGridEdit()) { // Grid edit
			if ($category->EventCancelled)
				$category_list->restoreCurrentRowFormValues($category_list->RowIndex); // Restore form values
			if ($category_list->RowAction == "insert")
				$category->RowType = ROWTYPE_ADD; // Render add
			else
				$category->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($category->isEdit() && $category->RowType == ROWTYPE_EDIT && $category->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$category_list->restoreFormValues(); // Restore form values
		}
		if ($category->isGridEdit() && ($category->RowType == ROWTYPE_EDIT || $category->RowType == ROWTYPE_ADD) && $category->EventCancelled) // Update failed
			$category_list->restoreCurrentRowFormValues($category_list->RowIndex); // Restore form values
		if ($category->RowType == ROWTYPE_EDIT) // Edit row
			$category_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$category->RowAttrs = array_merge($category->RowAttrs, array('data-rowindex'=>$category_list->RowCnt, 'id'=>'r' . $category_list->RowCnt . '_category', 'data-rowtype'=>$category->RowType));

		// Render row
		$category_list->renderRow();

		// Render list options
		$category_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($category_list->RowAction <> "delete" && $category_list->RowAction <> "insertdelete" && !($category_list->RowAction == "insert" && $category->isConfirm() && $category_list->emptyRow())) {
?>
	<tr<?php echo $category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$category_list->ListOptions->render("body", "left", $category_list->RowCnt);
?>
	<?php if ($category->name->Visible) { // name ?>
		<td data-name="name"<?php echo $category->name->cellAttributes() ?>>
<?php if ($category->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $category_list->RowCnt ?>_category_name" class="form-group category_name">
<input type="text" data-table="category" data-field="x_name" name="x<?php echo $category_list->RowIndex ?>_name" id="x<?php echo $category_list->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<input type="hidden" data-table="category" data-field="x_name" name="o<?php echo $category_list->RowIndex ?>_name" id="o<?php echo $category_list->RowIndex ?>_name" value="<?php echo HtmlEncode($category->name->OldValue) ?>">
<?php } ?>
<?php if ($category->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $category_list->RowCnt ?>_category_name" class="form-group category_name">
<input type="text" data-table="category" data-field="x_name" name="x<?php echo $category_list->RowIndex ?>_name" id="x<?php echo $category_list->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($category->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $category_list->RowCnt ?>_category_name" class="category_name">
<span<?php echo $category->name->viewAttributes() ?>>
<?php echo $category->name->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($category->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="category" data-field="x_id" name="x<?php echo $category_list->RowIndex ?>_id" id="x<?php echo $category_list->RowIndex ?>_id" value="<?php echo HtmlEncode($category->id->CurrentValue) ?>">
<input type="hidden" data-table="category" data-field="x_id" name="o<?php echo $category_list->RowIndex ?>_id" id="o<?php echo $category_list->RowIndex ?>_id" value="<?php echo HtmlEncode($category->id->OldValue) ?>">
<?php } ?>
<?php if ($category->RowType == ROWTYPE_EDIT || $category->CurrentMode == "edit") { ?>
<input type="hidden" data-table="category" data-field="x_id" name="x<?php echo $category_list->RowIndex ?>_id" id="x<?php echo $category_list->RowIndex ?>_id" value="<?php echo HtmlEncode($category->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($category->description->Visible) { // description ?>
		<td data-name="description"<?php echo $category->description->cellAttributes() ?>>
<?php if ($category->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $category_list->RowCnt ?>_category_description" class="form-group category_description">
<input type="text" data-table="category" data-field="x_description" name="x<?php echo $category_list->RowIndex ?>_description" id="x<?php echo $category_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="category" data-field="x_description" name="o<?php echo $category_list->RowIndex ?>_description" id="o<?php echo $category_list->RowIndex ?>_description" value="<?php echo HtmlEncode($category->description->OldValue) ?>">
<?php } ?>
<?php if ($category->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $category_list->RowCnt ?>_category_description" class="form-group category_description">
<input type="text" data-table="category" data-field="x_description" name="x<?php echo $category_list->RowIndex ?>_description" id="x<?php echo $category_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($category->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $category_list->RowCnt ?>_category_description" class="category_description">
<span<?php echo $category->description->viewAttributes() ?>>
<?php echo $category->description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_list->ListOptions->render("body", "right", $category_list->RowCnt);
?>
	</tr>
<?php if ($category->RowType == ROWTYPE_ADD || $category->RowType == ROWTYPE_EDIT) { ?>
<script>
fcategorylist.updateLists(<?php echo $category_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$category->isGridAdd())
		if (!$category_list->Recordset->EOF)
			$category_list->Recordset->moveNext();
}
?>
<?php
	if ($category->isGridAdd() || $category->isGridEdit()) {
		$category_list->RowIndex = '$rowindex$';
		$category_list->loadRowValues();

		// Set row properties
		$category->resetAttributes();
		$category->RowAttrs = array_merge($category->RowAttrs, array('data-rowindex'=>$category_list->RowIndex, 'id'=>'r0_category', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($category->RowAttrs["class"], "ew-template");
		$category->RowType = ROWTYPE_ADD;

		// Render row
		$category_list->renderRow();

		// Render list options
		$category_list->renderListOptions();
		$category_list->StartRowCnt = 0;
?>
	<tr<?php echo $category->rowAttributes() ?>>
<?php

// Render list options (body, left)
$category_list->ListOptions->render("body", "left", $category_list->RowIndex);
?>
	<?php if ($category->name->Visible) { // name ?>
		<td data-name="name">
<span id="el$rowindex$_category_name" class="form-group category_name">
<input type="text" data-table="category" data-field="x_name" name="x<?php echo $category_list->RowIndex ?>_name" id="x<?php echo $category_list->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<input type="hidden" data-table="category" data-field="x_name" name="o<?php echo $category_list->RowIndex ?>_name" id="o<?php echo $category_list->RowIndex ?>_name" value="<?php echo HtmlEncode($category->name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($category->description->Visible) { // description ?>
		<td data-name="description">
<span id="el$rowindex$_category_description" class="form-group category_description">
<input type="text" data-table="category" data-field="x_description" name="x<?php echo $category_list->RowIndex ?>_description" id="x<?php echo $category_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="category" data-field="x_description" name="o<?php echo $category_list->RowIndex ?>_description" id="o<?php echo $category_list->RowIndex ?>_description" value="<?php echo HtmlEncode($category->description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$category_list->ListOptions->render("body", "right", $category_list->RowIndex);
?>
<script>
fcategorylist.updateLists(<?php echo $category_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if ($category->isAdd() || $category->isCopy()) { ?>
<input type="hidden" name="<?php echo $category_list->FormKeyCountName ?>" id="<?php echo $category_list->FormKeyCountName ?>" value="<?php echo $category_list->KeyCount ?>">
<?php } ?>
<?php if ($category->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $category_list->FormKeyCountName ?>" id="<?php echo $category_list->FormKeyCountName ?>" value="<?php echo $category_list->KeyCount ?>">
<?php echo $category_list->MultiSelectKey ?>
<?php } ?>
<?php if ($category->isEdit()) { ?>
<input type="hidden" name="<?php echo $category_list->FormKeyCountName ?>" id="<?php echo $category_list->FormKeyCountName ?>" value="<?php echo $category_list->KeyCount ?>">
<?php } ?>
<?php if ($category->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $category_list->FormKeyCountName ?>" id="<?php echo $category_list->FormKeyCountName ?>" value="<?php echo $category_list->KeyCount ?>">
<?php echo $category_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$category->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($category_list->Recordset)
	$category_list->Recordset->Close();
?>
<?php if (!$category->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$category->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($category_list->Pager)) $category_list->Pager = new NumericPager($category_list->StartRec, $category_list->DisplayRecs, $category_list->TotalRecs, $category_list->RecRange, $category_list->AutoHidePager) ?>
<?php if ($category_list->Pager->RecordCount > 0 && $category_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($category_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($category_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($category_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $category_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($category_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($category_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_list->pageUrl() ?>start=<?php echo $category_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($category_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $category_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $category_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $category_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($category_list->TotalRecs > 0 && (!$category_list->AutoHidePageSizeSelector || $category_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="category">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($category_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($category_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($category_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($category_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($category_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($category_list->TotalRecs == 0 && !$category->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($category_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$category_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$category->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$category_list->terminate();
?>
