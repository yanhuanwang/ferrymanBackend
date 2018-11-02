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
$admin_list = new admin_list();

// Run the page
$admin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$admin->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fadminlist = currentForm = new ew.Form("fadminlist", "list");
fadminlist.formKeyCountName = '<?php echo $admin_list->FormKeyCountName ?>';

// Validate form
fadminlist.validate = function() {
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
		<?php if ($admin_list->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->username->caption(), $admin->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($admin_list->level->Required) { ?>
			elm = this.getElements("x" + infix + "_level");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->level->caption(), $admin->level->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_level");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($admin->level->errorMessage()) ?>");
		<?php if ($admin_list->locked->Required) { ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->locked->caption(), $admin->locked->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($admin->locked->errorMessage()) ?>");
		<?php if ($admin_list->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->_email->caption(), $admin->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($admin_list->activated->Required) { ?>
			elm = this.getElements("x" + infix + "_activated");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->activated->caption(), $admin->activated->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_activated");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($admin->activated->errorMessage()) ?>");

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
fadminlist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "username", false)) return false;
	if (ew.valueChanged(fobj, infix, "level", false)) return false;
	if (ew.valueChanged(fobj, infix, "locked", false)) return false;
	if (ew.valueChanged(fobj, infix, "_email", false)) return false;
	if (ew.valueChanged(fobj, infix, "activated", false)) return false;
	return true;
}

// Form_CustomValidate event
fadminlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fadminlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fadminlistsrch = currentSearchForm = new ew.Form("fadminlistsrch");

// Filters
fadminlistsrch.filterList = <?php echo $admin_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$admin->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($admin_list->TotalRecs > 0 && $admin_list->ExportOptions->visible()) { ?>
<?php $admin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($admin_list->ImportOptions->visible()) { ?>
<?php $admin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($admin_list->SearchOptions->visible()) { ?>
<?php $admin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($admin_list->FilterOptions->visible()) { ?>
<?php $admin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$admin_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$admin->isExport() && !$admin->CurrentAction) { ?>
<form name="fadminlistsrch" id="fadminlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($admin_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fadminlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="admin">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($admin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($admin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $admin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($admin_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $admin_list->showPageHeader(); ?>
<?php
$admin_list->showMessage();
?>
<?php if ($admin_list->TotalRecs > 0 || $admin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($admin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> admin">
<?php if (!$admin->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$admin->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($admin_list->Pager)) $admin_list->Pager = new NumericPager($admin_list->StartRec, $admin_list->DisplayRecs, $admin_list->TotalRecs, $admin_list->RecRange, $admin_list->AutoHidePager) ?>
<?php if ($admin_list->Pager->RecordCount > 0 && $admin_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($admin_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($admin_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($admin_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $admin_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($admin_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($admin_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($admin_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $admin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $admin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $admin_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($admin_list->TotalRecs > 0 && (!$admin_list->AutoHidePageSizeSelector || $admin_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="admin">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($admin_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($admin_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($admin_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($admin_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($admin_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fadminlist" id="fadminlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($admin_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $admin_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<div id="gmp_admin" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($admin_list->TotalRecs > 0 || $admin->isAdd() || $admin->isCopy() || $admin->isGridEdit()) { ?>
<table id="tbl_adminlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$admin_list->RowType = ROWTYPE_HEADER;

// Render list options
$admin_list->renderListOptions();

// Render list options (header, left)
$admin_list->ListOptions->render("header", "left");
?>
<?php if ($admin->username->Visible) { // username ?>
	<?php if ($admin->sortUrl($admin->username) == "") { ?>
		<th data-name="username" class="<?php echo $admin->username->headerCellClass() ?>"><div id="elh_admin_username" class="admin_username"><div class="ew-table-header-caption"><?php echo $admin->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $admin->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $admin->SortUrl($admin->username) ?>',1);"><div id="elh_admin_username" class="admin_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin->username->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($admin->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin->level->Visible) { // level ?>
	<?php if ($admin->sortUrl($admin->level) == "") { ?>
		<th data-name="level" class="<?php echo $admin->level->headerCellClass() ?>"><div id="elh_admin_level" class="admin_level"><div class="ew-table-header-caption"><?php echo $admin->level->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="level" class="<?php echo $admin->level->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $admin->SortUrl($admin->level) ?>',1);"><div id="elh_admin_level" class="admin_level">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin->level->caption() ?></span><span class="ew-table-header-sort"><?php if ($admin->level->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($admin->level->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin->locked->Visible) { // locked ?>
	<?php if ($admin->sortUrl($admin->locked) == "") { ?>
		<th data-name="locked" class="<?php echo $admin->locked->headerCellClass() ?>"><div id="elh_admin_locked" class="admin_locked"><div class="ew-table-header-caption"><?php echo $admin->locked->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="locked" class="<?php echo $admin->locked->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $admin->SortUrl($admin->locked) ?>',1);"><div id="elh_admin_locked" class="admin_locked">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin->locked->caption() ?></span><span class="ew-table-header-sort"><?php if ($admin->locked->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($admin->locked->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin->_email->Visible) { // email ?>
	<?php if ($admin->sortUrl($admin->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $admin->_email->headerCellClass() ?>"><div id="elh_admin__email" class="admin__email"><div class="ew-table-header-caption"><?php echo $admin->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $admin->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $admin->SortUrl($admin->_email) ?>',1);"><div id="elh_admin__email" class="admin__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin->_email->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($admin->_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($admin->_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($admin->activated->Visible) { // activated ?>
	<?php if ($admin->sortUrl($admin->activated) == "") { ?>
		<th data-name="activated" class="<?php echo $admin->activated->headerCellClass() ?>"><div id="elh_admin_activated" class="admin_activated"><div class="ew-table-header-caption"><?php echo $admin->activated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="activated" class="<?php echo $admin->activated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $admin->SortUrl($admin->activated) ?>',1);"><div id="elh_admin_activated" class="admin_activated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $admin->activated->caption() ?></span><span class="ew-table-header-sort"><?php if ($admin->activated->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($admin->activated->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$admin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($admin->isAdd() || $admin->isCopy()) {
		$admin_list->RowIndex = 0;
		$admin_list->KeyCount = $admin_list->RowIndex;
		if ($admin->isCopy() && !$admin_list->loadRow())
			$admin->CurrentAction = "add";
		if ($admin->isAdd())
			$admin_list->loadRowValues();
		if ($admin->EventCancelled) // Insert failed
			$admin_list->restoreFormValues(); // Restore form values

		// Set row properties
		$admin->resetAttributes();
		$admin->RowAttrs = array_merge($admin->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_admin', 'data-rowtype'=>ROWTYPE_ADD));
		$admin->RowType = ROWTYPE_ADD;

		// Render row
		$admin_list->renderRow();

		// Render list options
		$admin_list->renderListOptions();
		$admin_list->StartRowCnt = 0;
?>
	<tr<?php echo $admin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$admin_list->ListOptions->render("body", "left", $admin_list->RowCnt);
?>
	<?php if ($admin->username->Visible) { // username ?>
		<td data-name="username">
<span id="el<?php echo $admin_list->RowCnt ?>_admin_username" class="form-group admin_username">
<input type="text" data-table="admin" data-field="x_username" name="x<?php echo $admin_list->RowIndex ?>_username" id="x<?php echo $admin_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->username->getPlaceHolder()) ?>" value="<?php echo $admin->username->EditValue ?>"<?php echo $admin->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_username" name="o<?php echo $admin_list->RowIndex ?>_username" id="o<?php echo $admin_list->RowIndex ?>_username" value="<?php echo HtmlEncode($admin->username->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->level->Visible) { // level ?>
		<td data-name="level">
<span id="el<?php echo $admin_list->RowCnt ?>_admin_level" class="form-group admin_level">
<input type="text" data-table="admin" data-field="x_level" name="x<?php echo $admin_list->RowIndex ?>_level" id="x<?php echo $admin_list->RowIndex ?>_level" size="30" placeholder="<?php echo HtmlEncode($admin->level->getPlaceHolder()) ?>" value="<?php echo $admin->level->EditValue ?>"<?php echo $admin->level->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_level" name="o<?php echo $admin_list->RowIndex ?>_level" id="o<?php echo $admin_list->RowIndex ?>_level" value="<?php echo HtmlEncode($admin->level->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->locked->Visible) { // locked ?>
		<td data-name="locked">
<span id="el<?php echo $admin_list->RowCnt ?>_admin_locked" class="form-group admin_locked">
<input type="text" data-table="admin" data-field="x_locked" name="x<?php echo $admin_list->RowIndex ?>_locked" id="x<?php echo $admin_list->RowIndex ?>_locked" size="30" placeholder="<?php echo HtmlEncode($admin->locked->getPlaceHolder()) ?>" value="<?php echo $admin->locked->EditValue ?>"<?php echo $admin->locked->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_locked" name="o<?php echo $admin_list->RowIndex ?>_locked" id="o<?php echo $admin_list->RowIndex ?>_locked" value="<?php echo HtmlEncode($admin->locked->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->_email->Visible) { // email ?>
		<td data-name="_email">
<span id="el<?php echo $admin_list->RowCnt ?>_admin__email" class="form-group admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x<?php echo $admin_list->RowIndex ?>__email" id="x<?php echo $admin_list->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->_email->getPlaceHolder()) ?>" value="<?php echo $admin->_email->EditValue ?>"<?php echo $admin->_email->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x__email" name="o<?php echo $admin_list->RowIndex ?>__email" id="o<?php echo $admin_list->RowIndex ?>__email" value="<?php echo HtmlEncode($admin->_email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->activated->Visible) { // activated ?>
		<td data-name="activated">
<span id="el<?php echo $admin_list->RowCnt ?>_admin_activated" class="form-group admin_activated">
<input type="text" data-table="admin" data-field="x_activated" name="x<?php echo $admin_list->RowIndex ?>_activated" id="x<?php echo $admin_list->RowIndex ?>_activated" size="30" placeholder="<?php echo HtmlEncode($admin->activated->getPlaceHolder()) ?>" value="<?php echo $admin->activated->EditValue ?>"<?php echo $admin->activated->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_activated" name="o<?php echo $admin_list->RowIndex ?>_activated" id="o<?php echo $admin_list->RowIndex ?>_activated" value="<?php echo HtmlEncode($admin->activated->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$admin_list->ListOptions->render("body", "right", $admin_list->RowCnt);
?>
<script>
fadminlist.updateLists(<?php echo $admin_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($admin->ExportAll && $admin->isExport()) {
	$admin_list->StopRec = $admin_list->TotalRecs;
} else {

	// Set the last record to display
	if ($admin_list->TotalRecs > $admin_list->StartRec + $admin_list->DisplayRecs - 1)
		$admin_list->StopRec = $admin_list->StartRec + $admin_list->DisplayRecs - 1;
	else
		$admin_list->StopRec = $admin_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $admin_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($admin_list->FormKeyCountName) && ($admin->isGridAdd() || $admin->isGridEdit() || $admin->isConfirm())) {
		$admin_list->KeyCount = $CurrentForm->getValue($admin_list->FormKeyCountName);
		$admin_list->StopRec = $admin_list->StartRec + $admin_list->KeyCount - 1;
	}
}
$admin_list->RecCnt = $admin_list->StartRec - 1;
if ($admin_list->Recordset && !$admin_list->Recordset->EOF) {
	$admin_list->Recordset->moveFirst();
	$selectLimit = $admin_list->UseSelectLimit;
	if (!$selectLimit && $admin_list->StartRec > 1)
		$admin_list->Recordset->move($admin_list->StartRec - 1);
} elseif (!$admin->AllowAddDeleteRow && $admin_list->StopRec == 0) {
	$admin_list->StopRec = $admin->GridAddRowCount;
}

// Initialize aggregate
$admin->RowType = ROWTYPE_AGGREGATEINIT;
$admin->resetAttributes();
$admin_list->renderRow();
$admin_list->EditRowCnt = 0;
if ($admin->isEdit())
	$admin_list->RowIndex = 1;
if ($admin->isGridAdd())
	$admin_list->RowIndex = 0;
if ($admin->isGridEdit())
	$admin_list->RowIndex = 0;
while ($admin_list->RecCnt < $admin_list->StopRec) {
	$admin_list->RecCnt++;
	if ($admin_list->RecCnt >= $admin_list->StartRec) {
		$admin_list->RowCnt++;
		if ($admin->isGridAdd() || $admin->isGridEdit() || $admin->isConfirm()) {
			$admin_list->RowIndex++;
			$CurrentForm->Index = $admin_list->RowIndex;
			if ($CurrentForm->hasValue($admin_list->FormActionName) && $admin_list->EventCancelled)
				$admin_list->RowAction = strval($CurrentForm->getValue($admin_list->FormActionName));
			elseif ($admin->isGridAdd())
				$admin_list->RowAction = "insert";
			else
				$admin_list->RowAction = "";
		}

		// Set up key count
		$admin_list->KeyCount = $admin_list->RowIndex;

		// Init row class and style
		$admin->resetAttributes();
		$admin->CssClass = "";
		if ($admin->isGridAdd()) {
			$admin_list->loadRowValues(); // Load default values
		} else {
			$admin_list->loadRowValues($admin_list->Recordset); // Load row values
		}
		$admin->RowType = ROWTYPE_VIEW; // Render view
		if ($admin->isGridAdd()) // Grid add
			$admin->RowType = ROWTYPE_ADD; // Render add
		if ($admin->isGridAdd() && $admin->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$admin_list->restoreCurrentRowFormValues($admin_list->RowIndex); // Restore form values
		if ($admin->isEdit()) {
			if ($admin_list->checkInlineEditKey() && $admin_list->EditRowCnt == 0) { // Inline edit
				$admin->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($admin->isGridEdit()) { // Grid edit
			if ($admin->EventCancelled)
				$admin_list->restoreCurrentRowFormValues($admin_list->RowIndex); // Restore form values
			if ($admin_list->RowAction == "insert")
				$admin->RowType = ROWTYPE_ADD; // Render add
			else
				$admin->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($admin->isEdit() && $admin->RowType == ROWTYPE_EDIT && $admin->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$admin_list->restoreFormValues(); // Restore form values
		}
		if ($admin->isGridEdit() && ($admin->RowType == ROWTYPE_EDIT || $admin->RowType == ROWTYPE_ADD) && $admin->EventCancelled) // Update failed
			$admin_list->restoreCurrentRowFormValues($admin_list->RowIndex); // Restore form values
		if ($admin->RowType == ROWTYPE_EDIT) // Edit row
			$admin_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$admin->RowAttrs = array_merge($admin->RowAttrs, array('data-rowindex'=>$admin_list->RowCnt, 'id'=>'r' . $admin_list->RowCnt . '_admin', 'data-rowtype'=>$admin->RowType));

		// Render row
		$admin_list->renderRow();

		// Render list options
		$admin_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($admin_list->RowAction <> "delete" && $admin_list->RowAction <> "insertdelete" && !($admin_list->RowAction == "insert" && $admin->isConfirm() && $admin_list->emptyRow())) {
?>
	<tr<?php echo $admin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$admin_list->ListOptions->render("body", "left", $admin_list->RowCnt);
?>
	<?php if ($admin->username->Visible) { // username ?>
		<td data-name="username"<?php echo $admin->username->cellAttributes() ?>>
<?php if ($admin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_username" class="form-group admin_username">
<input type="text" data-table="admin" data-field="x_username" name="x<?php echo $admin_list->RowIndex ?>_username" id="x<?php echo $admin_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->username->getPlaceHolder()) ?>" value="<?php echo $admin->username->EditValue ?>"<?php echo $admin->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_username" name="o<?php echo $admin_list->RowIndex ?>_username" id="o<?php echo $admin_list->RowIndex ?>_username" value="<?php echo HtmlEncode($admin->username->OldValue) ?>">
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_username" class="form-group admin_username">
<input type="text" data-table="admin" data-field="x_username" name="x<?php echo $admin_list->RowIndex ?>_username" id="x<?php echo $admin_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->username->getPlaceHolder()) ?>" value="<?php echo $admin->username->EditValue ?>"<?php echo $admin->username->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_username" class="admin_username">
<span<?php echo $admin->username->viewAttributes() ?>>
<?php echo $admin->username->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($admin->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="admin" data-field="x_id" name="x<?php echo $admin_list->RowIndex ?>_id" id="x<?php echo $admin_list->RowIndex ?>_id" value="<?php echo HtmlEncode($admin->id->CurrentValue) ?>">
<input type="hidden" data-table="admin" data-field="x_id" name="o<?php echo $admin_list->RowIndex ?>_id" id="o<?php echo $admin_list->RowIndex ?>_id" value="<?php echo HtmlEncode($admin->id->OldValue) ?>">
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_EDIT || $admin->CurrentMode == "edit") { ?>
<input type="hidden" data-table="admin" data-field="x_id" name="x<?php echo $admin_list->RowIndex ?>_id" id="x<?php echo $admin_list->RowIndex ?>_id" value="<?php echo HtmlEncode($admin->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($admin->level->Visible) { // level ?>
		<td data-name="level"<?php echo $admin->level->cellAttributes() ?>>
<?php if ($admin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_level" class="form-group admin_level">
<input type="text" data-table="admin" data-field="x_level" name="x<?php echo $admin_list->RowIndex ?>_level" id="x<?php echo $admin_list->RowIndex ?>_level" size="30" placeholder="<?php echo HtmlEncode($admin->level->getPlaceHolder()) ?>" value="<?php echo $admin->level->EditValue ?>"<?php echo $admin->level->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_level" name="o<?php echo $admin_list->RowIndex ?>_level" id="o<?php echo $admin_list->RowIndex ?>_level" value="<?php echo HtmlEncode($admin->level->OldValue) ?>">
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_level" class="form-group admin_level">
<input type="text" data-table="admin" data-field="x_level" name="x<?php echo $admin_list->RowIndex ?>_level" id="x<?php echo $admin_list->RowIndex ?>_level" size="30" placeholder="<?php echo HtmlEncode($admin->level->getPlaceHolder()) ?>" value="<?php echo $admin->level->EditValue ?>"<?php echo $admin->level->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_level" class="admin_level">
<span<?php echo $admin->level->viewAttributes() ?>>
<?php echo $admin->level->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($admin->locked->Visible) { // locked ?>
		<td data-name="locked"<?php echo $admin->locked->cellAttributes() ?>>
<?php if ($admin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_locked" class="form-group admin_locked">
<input type="text" data-table="admin" data-field="x_locked" name="x<?php echo $admin_list->RowIndex ?>_locked" id="x<?php echo $admin_list->RowIndex ?>_locked" size="30" placeholder="<?php echo HtmlEncode($admin->locked->getPlaceHolder()) ?>" value="<?php echo $admin->locked->EditValue ?>"<?php echo $admin->locked->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_locked" name="o<?php echo $admin_list->RowIndex ?>_locked" id="o<?php echo $admin_list->RowIndex ?>_locked" value="<?php echo HtmlEncode($admin->locked->OldValue) ?>">
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_locked" class="form-group admin_locked">
<input type="text" data-table="admin" data-field="x_locked" name="x<?php echo $admin_list->RowIndex ?>_locked" id="x<?php echo $admin_list->RowIndex ?>_locked" size="30" placeholder="<?php echo HtmlEncode($admin->locked->getPlaceHolder()) ?>" value="<?php echo $admin->locked->EditValue ?>"<?php echo $admin->locked->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_locked" class="admin_locked">
<span<?php echo $admin->locked->viewAttributes() ?>>
<?php echo $admin->locked->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($admin->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $admin->_email->cellAttributes() ?>>
<?php if ($admin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin__email" class="form-group admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x<?php echo $admin_list->RowIndex ?>__email" id="x<?php echo $admin_list->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->_email->getPlaceHolder()) ?>" value="<?php echo $admin->_email->EditValue ?>"<?php echo $admin->_email->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x__email" name="o<?php echo $admin_list->RowIndex ?>__email" id="o<?php echo $admin_list->RowIndex ?>__email" value="<?php echo HtmlEncode($admin->_email->OldValue) ?>">
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin__email" class="form-group admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x<?php echo $admin_list->RowIndex ?>__email" id="x<?php echo $admin_list->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->_email->getPlaceHolder()) ?>" value="<?php echo $admin->_email->EditValue ?>"<?php echo $admin->_email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin__email" class="admin__email">
<span<?php echo $admin->_email->viewAttributes() ?>>
<?php echo $admin->_email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($admin->activated->Visible) { // activated ?>
		<td data-name="activated"<?php echo $admin->activated->cellAttributes() ?>>
<?php if ($admin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_activated" class="form-group admin_activated">
<input type="text" data-table="admin" data-field="x_activated" name="x<?php echo $admin_list->RowIndex ?>_activated" id="x<?php echo $admin_list->RowIndex ?>_activated" size="30" placeholder="<?php echo HtmlEncode($admin->activated->getPlaceHolder()) ?>" value="<?php echo $admin->activated->EditValue ?>"<?php echo $admin->activated->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_activated" name="o<?php echo $admin_list->RowIndex ?>_activated" id="o<?php echo $admin_list->RowIndex ?>_activated" value="<?php echo HtmlEncode($admin->activated->OldValue) ?>">
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_activated" class="form-group admin_activated">
<input type="text" data-table="admin" data-field="x_activated" name="x<?php echo $admin_list->RowIndex ?>_activated" id="x<?php echo $admin_list->RowIndex ?>_activated" size="30" placeholder="<?php echo HtmlEncode($admin->activated->getPlaceHolder()) ?>" value="<?php echo $admin->activated->EditValue ?>"<?php echo $admin->activated->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($admin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $admin_list->RowCnt ?>_admin_activated" class="admin_activated">
<span<?php echo $admin->activated->viewAttributes() ?>>
<?php echo $admin->activated->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$admin_list->ListOptions->render("body", "right", $admin_list->RowCnt);
?>
	</tr>
<?php if ($admin->RowType == ROWTYPE_ADD || $admin->RowType == ROWTYPE_EDIT) { ?>
<script>
fadminlist.updateLists(<?php echo $admin_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$admin->isGridAdd())
		if (!$admin_list->Recordset->EOF)
			$admin_list->Recordset->moveNext();
}
?>
<?php
	if ($admin->isGridAdd() || $admin->isGridEdit()) {
		$admin_list->RowIndex = '$rowindex$';
		$admin_list->loadRowValues();

		// Set row properties
		$admin->resetAttributes();
		$admin->RowAttrs = array_merge($admin->RowAttrs, array('data-rowindex'=>$admin_list->RowIndex, 'id'=>'r0_admin', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($admin->RowAttrs["class"], "ew-template");
		$admin->RowType = ROWTYPE_ADD;

		// Render row
		$admin_list->renderRow();

		// Render list options
		$admin_list->renderListOptions();
		$admin_list->StartRowCnt = 0;
?>
	<tr<?php echo $admin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$admin_list->ListOptions->render("body", "left", $admin_list->RowIndex);
?>
	<?php if ($admin->username->Visible) { // username ?>
		<td data-name="username">
<span id="el$rowindex$_admin_username" class="form-group admin_username">
<input type="text" data-table="admin" data-field="x_username" name="x<?php echo $admin_list->RowIndex ?>_username" id="x<?php echo $admin_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->username->getPlaceHolder()) ?>" value="<?php echo $admin->username->EditValue ?>"<?php echo $admin->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_username" name="o<?php echo $admin_list->RowIndex ?>_username" id="o<?php echo $admin_list->RowIndex ?>_username" value="<?php echo HtmlEncode($admin->username->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->level->Visible) { // level ?>
		<td data-name="level">
<span id="el$rowindex$_admin_level" class="form-group admin_level">
<input type="text" data-table="admin" data-field="x_level" name="x<?php echo $admin_list->RowIndex ?>_level" id="x<?php echo $admin_list->RowIndex ?>_level" size="30" placeholder="<?php echo HtmlEncode($admin->level->getPlaceHolder()) ?>" value="<?php echo $admin->level->EditValue ?>"<?php echo $admin->level->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_level" name="o<?php echo $admin_list->RowIndex ?>_level" id="o<?php echo $admin_list->RowIndex ?>_level" value="<?php echo HtmlEncode($admin->level->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->locked->Visible) { // locked ?>
		<td data-name="locked">
<span id="el$rowindex$_admin_locked" class="form-group admin_locked">
<input type="text" data-table="admin" data-field="x_locked" name="x<?php echo $admin_list->RowIndex ?>_locked" id="x<?php echo $admin_list->RowIndex ?>_locked" size="30" placeholder="<?php echo HtmlEncode($admin->locked->getPlaceHolder()) ?>" value="<?php echo $admin->locked->EditValue ?>"<?php echo $admin->locked->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_locked" name="o<?php echo $admin_list->RowIndex ?>_locked" id="o<?php echo $admin_list->RowIndex ?>_locked" value="<?php echo HtmlEncode($admin->locked->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->_email->Visible) { // email ?>
		<td data-name="_email">
<span id="el$rowindex$_admin__email" class="form-group admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x<?php echo $admin_list->RowIndex ?>__email" id="x<?php echo $admin_list->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->_email->getPlaceHolder()) ?>" value="<?php echo $admin->_email->EditValue ?>"<?php echo $admin->_email->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x__email" name="o<?php echo $admin_list->RowIndex ?>__email" id="o<?php echo $admin_list->RowIndex ?>__email" value="<?php echo HtmlEncode($admin->_email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($admin->activated->Visible) { // activated ?>
		<td data-name="activated">
<span id="el$rowindex$_admin_activated" class="form-group admin_activated">
<input type="text" data-table="admin" data-field="x_activated" name="x<?php echo $admin_list->RowIndex ?>_activated" id="x<?php echo $admin_list->RowIndex ?>_activated" size="30" placeholder="<?php echo HtmlEncode($admin->activated->getPlaceHolder()) ?>" value="<?php echo $admin->activated->EditValue ?>"<?php echo $admin->activated->editAttributes() ?>>
</span>
<input type="hidden" data-table="admin" data-field="x_activated" name="o<?php echo $admin_list->RowIndex ?>_activated" id="o<?php echo $admin_list->RowIndex ?>_activated" value="<?php echo HtmlEncode($admin->activated->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$admin_list->ListOptions->render("body", "right", $admin_list->RowIndex);
?>
<script>
fadminlist.updateLists(<?php echo $admin_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if ($admin->isAdd() || $admin->isCopy()) { ?>
<input type="hidden" name="<?php echo $admin_list->FormKeyCountName ?>" id="<?php echo $admin_list->FormKeyCountName ?>" value="<?php echo $admin_list->KeyCount ?>">
<?php } ?>
<?php if ($admin->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $admin_list->FormKeyCountName ?>" id="<?php echo $admin_list->FormKeyCountName ?>" value="<?php echo $admin_list->KeyCount ?>">
<?php echo $admin_list->MultiSelectKey ?>
<?php } ?>
<?php if ($admin->isEdit()) { ?>
<input type="hidden" name="<?php echo $admin_list->FormKeyCountName ?>" id="<?php echo $admin_list->FormKeyCountName ?>" value="<?php echo $admin_list->KeyCount ?>">
<?php } ?>
<?php if ($admin->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $admin_list->FormKeyCountName ?>" id="<?php echo $admin_list->FormKeyCountName ?>" value="<?php echo $admin_list->KeyCount ?>">
<?php echo $admin_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$admin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($admin_list->Recordset)
	$admin_list->Recordset->Close();
?>
<?php if (!$admin->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$admin->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($admin_list->Pager)) $admin_list->Pager = new NumericPager($admin_list->StartRec, $admin_list->DisplayRecs, $admin_list->TotalRecs, $admin_list->RecRange, $admin_list->AutoHidePager) ?>
<?php if ($admin_list->Pager->RecordCount > 0 && $admin_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($admin_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($admin_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($admin_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $admin_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($admin_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($admin_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_list->pageUrl() ?>start=<?php echo $admin_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($admin_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $admin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $admin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $admin_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($admin_list->TotalRecs > 0 && (!$admin_list->AutoHidePageSizeSelector || $admin_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="admin">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($admin_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($admin_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($admin_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($admin_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($admin_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($admin_list->TotalRecs == 0 && !$admin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($admin_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$admin_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$admin->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$admin_list->terminate();
?>
