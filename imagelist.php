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
$image_list = new image_list();

// Run the page
$image_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$image->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fimagelist = currentForm = new ew.Form("fimagelist", "list");
fimagelist.formKeyCountName = '<?php echo $image_list->FormKeyCountName ?>';

// Validate form
fimagelist.validate = function() {
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
		<?php if ($image_list->path->Required) { ?>
			felm = this.getElements("x" + infix + "_path");
			elm = this.getElements("fn_x" + infix + "_path");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $image->path->caption(), $image->path->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_list->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->description->caption(), $image->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_list->uuid->Required) { ?>
			elm = this.getElements("x" + infix + "_uuid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->uuid->caption(), $image->uuid->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_list->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->user_id->caption(), $image->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->user_id->errorMessage()) ?>");
		<?php if ($image_list->confirmed->Required) { ?>
			elm = this.getElements("x" + infix + "_confirmed");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->confirmed->caption(), $image->confirmed->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_confirmed");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->confirmed->errorMessage()) ?>");
		<?php if ($image_list->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->createdAt->caption(), $image->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->createdAt->errorMessage()) ?>");
		<?php if ($image_list->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->updatedAt->caption(), $image->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->updatedAt->errorMessage()) ?>");

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
fimagelist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "path", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "uuid", false)) return false;
	if (ew.valueChanged(fobj, infix, "user_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "confirmed", false)) return false;
	if (ew.valueChanged(fobj, infix, "createdAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "updatedAt", false)) return false;
	return true;
}

// Form_CustomValidate event
fimagelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimagelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fimagelistsrch = currentSearchForm = new ew.Form("fimagelistsrch");

// Filters
fimagelistsrch.filterList = <?php echo $image_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$image->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($image_list->TotalRecs > 0 && $image_list->ExportOptions->visible()) { ?>
<?php $image_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($image_list->ImportOptions->visible()) { ?>
<?php $image_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($image_list->SearchOptions->visible()) { ?>
<?php $image_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($image_list->FilterOptions->visible()) { ?>
<?php $image_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$image_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$image->isExport() && !$image->CurrentAction) { ?>
<form name="fimagelistsrch" id="fimagelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($image_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fimagelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="image">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($image_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($image_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $image_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($image_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($image_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($image_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($image_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $image_list->showPageHeader(); ?>
<?php
$image_list->showMessage();
?>
<?php if ($image_list->TotalRecs > 0 || $image->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($image_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> image">
<?php if (!$image->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$image->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($image_list->Pager)) $image_list->Pager = new NumericPager($image_list->StartRec, $image_list->DisplayRecs, $image_list->TotalRecs, $image_list->RecRange, $image_list->AutoHidePager) ?>
<?php if ($image_list->Pager->RecordCount > 0 && $image_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($image_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($image_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($image_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $image_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($image_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($image_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($image_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $image_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $image_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $image_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($image_list->TotalRecs > 0 && (!$image_list->AutoHidePageSizeSelector || $image_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="image">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($image_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($image_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($image_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($image_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($image_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fimagelist" id="fimagelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($image_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $image_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="image">
<div id="gmp_image" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($image_list->TotalRecs > 0 || $image->isAdd() || $image->isCopy() || $image->isGridEdit()) { ?>
<table id="tbl_imagelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$image_list->RowType = ROWTYPE_HEADER;

// Render list options
$image_list->renderListOptions();

// Render list options (header, left)
$image_list->ListOptions->render("header", "left");
?>
<?php if ($image->path->Visible) { // path ?>
	<?php if ($image->sortUrl($image->path) == "") { ?>
		<th data-name="path" class="<?php echo $image->path->headerCellClass() ?>"><div id="elh_image_path" class="image_path"><div class="ew-table-header-caption"><?php echo $image->path->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="path" class="<?php echo $image->path->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->path) ?>',1);"><div id="elh_image_path" class="image_path">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->path->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($image->path->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->path->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
	<?php if ($image->sortUrl($image->description) == "") { ?>
		<th data-name="description" class="<?php echo $image->description->headerCellClass() ?>"><div id="elh_image_description" class="image_description"><div class="ew-table-header-caption"><?php echo $image->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $image->description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->description) ?>',1);"><div id="elh_image_description" class="image_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->description->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($image->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->uuid->Visible) { // uuid ?>
	<?php if ($image->sortUrl($image->uuid) == "") { ?>
		<th data-name="uuid" class="<?php echo $image->uuid->headerCellClass() ?>"><div id="elh_image_uuid" class="image_uuid"><div class="ew-table-header-caption"><?php echo $image->uuid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="uuid" class="<?php echo $image->uuid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->uuid) ?>',1);"><div id="elh_image_uuid" class="image_uuid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->uuid->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($image->uuid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->uuid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
	<?php if ($image->sortUrl($image->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $image->user_id->headerCellClass() ?>"><div id="elh_image_user_id" class="image_user_id"><div class="ew-table-header-caption"><?php echo $image->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $image->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->user_id) ?>',1);"><div id="elh_image_user_id" class="image_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
	<?php if ($image->sortUrl($image->confirmed) == "") { ?>
		<th data-name="confirmed" class="<?php echo $image->confirmed->headerCellClass() ?>"><div id="elh_image_confirmed" class="image_confirmed"><div class="ew-table-header-caption"><?php echo $image->confirmed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="confirmed" class="<?php echo $image->confirmed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->confirmed) ?>',1);"><div id="elh_image_confirmed" class="image_confirmed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->confirmed->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->confirmed->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->confirmed->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
	<?php if ($image->sortUrl($image->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $image->createdAt->headerCellClass() ?>"><div id="elh_image_createdAt" class="image_createdAt"><div class="ew-table-header-caption"><?php echo $image->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $image->createdAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->createdAt) ?>',1);"><div id="elh_image_createdAt" class="image_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
	<?php if ($image->sortUrl($image->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $image->updatedAt->headerCellClass() ?>"><div id="elh_image_updatedAt" class="image_updatedAt"><div class="ew-table-header-caption"><?php echo $image->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $image->updatedAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $image->SortUrl($image->updatedAt) ?>',1);"><div id="elh_image_updatedAt" class="image_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$image_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($image->isAdd() || $image->isCopy()) {
		$image_list->RowIndex = 0;
		$image_list->KeyCount = $image_list->RowIndex;
		if ($image->isCopy() && !$image_list->loadRow())
			$image->CurrentAction = "add";
		if ($image->isAdd())
			$image_list->loadRowValues();
		if ($image->EventCancelled) // Insert failed
			$image_list->restoreFormValues(); // Restore form values

		// Set row properties
		$image->resetAttributes();
		$image->RowAttrs = array_merge($image->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_image', 'data-rowtype'=>ROWTYPE_ADD));
		$image->RowType = ROWTYPE_ADD;

		// Render row
		$image_list->renderRow();

		// Render list options
		$image_list->renderListOptions();
		$image_list->StartRowCnt = 0;
?>
	<tr<?php echo $image->rowAttributes() ?>>
<?php

// Render list options (body, left)
$image_list->ListOptions->render("body", "left", $image_list->RowCnt);
?>
	<?php if ($image->path->Visible) { // path ?>
		<td data-name="path">
<span id="el<?php echo $image_list->RowCnt ?>_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_list->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_list->RowIndex ?>_path" id="x<?php echo $image_list->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_list->RowIndex ?>_path" id= "fn_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $image_list->RowIndex ?>_path" id= "fa_x<?php echo $image_list->RowIndex ?>_path" value="0">
<input type="hidden" name="fs_x<?php echo $image_list->RowIndex ?>_path" id= "fs_x<?php echo $image_list->RowIndex ?>_path" value="256">
<input type="hidden" name="fx_x<?php echo $image_list->RowIndex ?>_path" id= "fx_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_list->RowIndex ?>_path" id= "fm_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_list->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="image" data-field="x_path" name="o<?php echo $image_list->RowIndex ?>_path" id="o<?php echo $image_list->RowIndex ?>_path" value="<?php echo HtmlEncode($image->path->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->description->Visible) { // description ?>
		<td data-name="description">
<span id="el<?php echo $image_list->RowCnt ?>_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_list->RowIndex ?>_description" id="x<?php echo $image_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_description" name="o<?php echo $image_list->RowIndex ?>_description" id="o<?php echo $image_list->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->uuid->Visible) { // uuid ?>
		<td data-name="uuid">
<span id="el<?php echo $image_list->RowCnt ?>_image_uuid" class="form-group image_uuid">
<input type="text" data-table="image" data-field="x_uuid" name="x<?php echo $image_list->RowIndex ?>_uuid" id="x<?php echo $image_list->RowIndex ?>_uuid" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($image->uuid->getPlaceHolder()) ?>" value="<?php echo $image->uuid->EditValue ?>"<?php echo $image->uuid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_uuid" name="o<?php echo $image_list->RowIndex ?>_uuid" id="o<?php echo $image_list->RowIndex ?>_uuid" value="<?php echo HtmlEncode($image->uuid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<span id="el<?php echo $image_list->RowCnt ?>_image_user_id" class="form-group image_user_id">
<input type="text" data-table="image" data-field="x_user_id" name="x<?php echo $image_list->RowIndex ?>_user_id" id="x<?php echo $image_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($image->user_id->getPlaceHolder()) ?>" value="<?php echo $image->user_id->EditValue ?>"<?php echo $image->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_user_id" name="o<?php echo $image_list->RowIndex ?>_user_id" id="o<?php echo $image_list->RowIndex ?>_user_id" value="<?php echo HtmlEncode($image->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->confirmed->Visible) { // confirmed ?>
		<td data-name="confirmed">
<span id="el<?php echo $image_list->RowCnt ?>_image_confirmed" class="form-group image_confirmed">
<input type="text" data-table="image" data-field="x_confirmed" name="x<?php echo $image_list->RowIndex ?>_confirmed" id="x<?php echo $image_list->RowIndex ?>_confirmed" size="30" placeholder="<?php echo HtmlEncode($image->confirmed->getPlaceHolder()) ?>" value="<?php echo $image->confirmed->EditValue ?>"<?php echo $image->confirmed->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_confirmed" name="o<?php echo $image_list->RowIndex ?>_confirmed" id="o<?php echo $image_list->RowIndex ?>_confirmed" value="<?php echo HtmlEncode($image->confirmed->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<span id="el<?php echo $image_list->RowCnt ?>_image_createdAt" class="form-group image_createdAt">
<input type="text" data-table="image" data-field="x_createdAt" name="x<?php echo $image_list->RowIndex ?>_createdAt" id="x<?php echo $image_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($image->createdAt->getPlaceHolder()) ?>" value="<?php echo $image->createdAt->EditValue ?>"<?php echo $image->createdAt->editAttributes() ?>>
<?php if (!$image->createdAt->ReadOnly && !$image->createdAt->Disabled && !isset($image->createdAt->EditAttrs["readonly"]) && !isset($image->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="image" data-field="x_createdAt" name="o<?php echo $image_list->RowIndex ?>_createdAt" id="o<?php echo $image_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($image->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<span id="el<?php echo $image_list->RowCnt ?>_image_updatedAt" class="form-group image_updatedAt">
<input type="text" data-table="image" data-field="x_updatedAt" name="x<?php echo $image_list->RowIndex ?>_updatedAt" id="x<?php echo $image_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($image->updatedAt->getPlaceHolder()) ?>" value="<?php echo $image->updatedAt->EditValue ?>"<?php echo $image->updatedAt->editAttributes() ?>>
<?php if (!$image->updatedAt->ReadOnly && !$image->updatedAt->Disabled && !isset($image->updatedAt->EditAttrs["readonly"]) && !isset($image->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="image" data-field="x_updatedAt" name="o<?php echo $image_list->RowIndex ?>_updatedAt" id="o<?php echo $image_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($image->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$image_list->ListOptions->render("body", "right", $image_list->RowCnt);
?>
<script>
fimagelist.updateLists(<?php echo $image_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($image->ExportAll && $image->isExport()) {
	$image_list->StopRec = $image_list->TotalRecs;
} else {

	// Set the last record to display
	if ($image_list->TotalRecs > $image_list->StartRec + $image_list->DisplayRecs - 1)
		$image_list->StopRec = $image_list->StartRec + $image_list->DisplayRecs - 1;
	else
		$image_list->StopRec = $image_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $image_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($image_list->FormKeyCountName) && ($image->isGridAdd() || $image->isGridEdit() || $image->isConfirm())) {
		$image_list->KeyCount = $CurrentForm->getValue($image_list->FormKeyCountName);
		$image_list->StopRec = $image_list->StartRec + $image_list->KeyCount - 1;
	}
}
$image_list->RecCnt = $image_list->StartRec - 1;
if ($image_list->Recordset && !$image_list->Recordset->EOF) {
	$image_list->Recordset->moveFirst();
	$selectLimit = $image_list->UseSelectLimit;
	if (!$selectLimit && $image_list->StartRec > 1)
		$image_list->Recordset->move($image_list->StartRec - 1);
} elseif (!$image->AllowAddDeleteRow && $image_list->StopRec == 0) {
	$image_list->StopRec = $image->GridAddRowCount;
}

// Initialize aggregate
$image->RowType = ROWTYPE_AGGREGATEINIT;
$image->resetAttributes();
$image_list->renderRow();
$image_list->EditRowCnt = 0;
if ($image->isEdit())
	$image_list->RowIndex = 1;
if ($image->isGridAdd())
	$image_list->RowIndex = 0;
if ($image->isGridEdit())
	$image_list->RowIndex = 0;
while ($image_list->RecCnt < $image_list->StopRec) {
	$image_list->RecCnt++;
	if ($image_list->RecCnt >= $image_list->StartRec) {
		$image_list->RowCnt++;
		if ($image->isGridAdd() || $image->isGridEdit() || $image->isConfirm()) {
			$image_list->RowIndex++;
			$CurrentForm->Index = $image_list->RowIndex;
			if ($CurrentForm->hasValue($image_list->FormActionName) && $image_list->EventCancelled)
				$image_list->RowAction = strval($CurrentForm->getValue($image_list->FormActionName));
			elseif ($image->isGridAdd())
				$image_list->RowAction = "insert";
			else
				$image_list->RowAction = "";
		}

		// Set up key count
		$image_list->KeyCount = $image_list->RowIndex;

		// Init row class and style
		$image->resetAttributes();
		$image->CssClass = "";
		if ($image->isGridAdd()) {
			$image_list->loadRowValues(); // Load default values
		} else {
			$image_list->loadRowValues($image_list->Recordset); // Load row values
		}
		$image->RowType = ROWTYPE_VIEW; // Render view
		if ($image->isGridAdd()) // Grid add
			$image->RowType = ROWTYPE_ADD; // Render add
		if ($image->isGridAdd() && $image->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$image_list->restoreCurrentRowFormValues($image_list->RowIndex); // Restore form values
		if ($image->isEdit()) {
			if ($image_list->checkInlineEditKey() && $image_list->EditRowCnt == 0) { // Inline edit
				$image->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($image->isGridEdit()) { // Grid edit
			if ($image->EventCancelled)
				$image_list->restoreCurrentRowFormValues($image_list->RowIndex); // Restore form values
			if ($image_list->RowAction == "insert")
				$image->RowType = ROWTYPE_ADD; // Render add
			else
				$image->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($image->isEdit() && $image->RowType == ROWTYPE_EDIT && $image->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$image_list->restoreFormValues(); // Restore form values
		}
		if ($image->isGridEdit() && ($image->RowType == ROWTYPE_EDIT || $image->RowType == ROWTYPE_ADD) && $image->EventCancelled) // Update failed
			$image_list->restoreCurrentRowFormValues($image_list->RowIndex); // Restore form values
		if ($image->RowType == ROWTYPE_EDIT) // Edit row
			$image_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$image->RowAttrs = array_merge($image->RowAttrs, array('data-rowindex'=>$image_list->RowCnt, 'id'=>'r' . $image_list->RowCnt . '_image', 'data-rowtype'=>$image->RowType));

		// Render row
		$image_list->renderRow();

		// Render list options
		$image_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($image_list->RowAction <> "delete" && $image_list->RowAction <> "insertdelete" && !($image_list->RowAction == "insert" && $image->isConfirm() && $image_list->emptyRow())) {
?>
	<tr<?php echo $image->rowAttributes() ?>>
<?php

// Render list options (body, left)
$image_list->ListOptions->render("body", "left", $image_list->RowCnt);
?>
	<?php if ($image->path->Visible) { // path ?>
		<td data-name="path"<?php echo $image->path->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_list->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_list->RowIndex ?>_path" id="x<?php echo $image_list->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_list->RowIndex ?>_path" id= "fn_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $image_list->RowIndex ?>_path" id= "fa_x<?php echo $image_list->RowIndex ?>_path" value="0">
<input type="hidden" name="fs_x<?php echo $image_list->RowIndex ?>_path" id= "fs_x<?php echo $image_list->RowIndex ?>_path" value="256">
<input type="hidden" name="fx_x<?php echo $image_list->RowIndex ?>_path" id= "fx_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_list->RowIndex ?>_path" id= "fm_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_list->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="image" data-field="x_path" name="o<?php echo $image_list->RowIndex ?>_path" id="o<?php echo $image_list->RowIndex ?>_path" value="<?php echo HtmlEncode($image->path->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_list->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_list->RowIndex ?>_path" id="x<?php echo $image_list->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_list->RowIndex ?>_path" id= "fn_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $image_list->RowIndex ?>_path") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $image_list->RowIndex ?>_path" id= "fa_x<?php echo $image_list->RowIndex ?>_path" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $image_list->RowIndex ?>_path" id= "fa_x<?php echo $image_list->RowIndex ?>_path" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $image_list->RowIndex ?>_path" id= "fs_x<?php echo $image_list->RowIndex ?>_path" value="256">
<input type="hidden" name="fx_x<?php echo $image_list->RowIndex ?>_path" id= "fx_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_list->RowIndex ?>_path" id= "fm_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_list->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_path" class="image_path">
<span>
<?php echo GetFileViewTag($image->path, $image->path->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="image" data-field="x_id" name="x<?php echo $image_list->RowIndex ?>_id" id="x<?php echo $image_list->RowIndex ?>_id" value="<?php echo HtmlEncode($image->id->CurrentValue) ?>">
<input type="hidden" data-table="image" data-field="x_id" name="o<?php echo $image_list->RowIndex ?>_id" id="o<?php echo $image_list->RowIndex ?>_id" value="<?php echo HtmlEncode($image->id->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT || $image->CurrentMode == "edit") { ?>
<input type="hidden" data-table="image" data-field="x_id" name="x<?php echo $image_list->RowIndex ?>_id" id="x<?php echo $image_list->RowIndex ?>_id" value="<?php echo HtmlEncode($image->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($image->description->Visible) { // description ?>
		<td data-name="description"<?php echo $image->description->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_list->RowIndex ?>_description" id="x<?php echo $image_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_description" name="o<?php echo $image_list->RowIndex ?>_description" id="o<?php echo $image_list->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_list->RowIndex ?>_description" id="x<?php echo $image_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_description" class="image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<?php echo $image->description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->uuid->Visible) { // uuid ?>
		<td data-name="uuid"<?php echo $image->uuid->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_uuid" class="form-group image_uuid">
<input type="text" data-table="image" data-field="x_uuid" name="x<?php echo $image_list->RowIndex ?>_uuid" id="x<?php echo $image_list->RowIndex ?>_uuid" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($image->uuid->getPlaceHolder()) ?>" value="<?php echo $image->uuid->EditValue ?>"<?php echo $image->uuid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_uuid" name="o<?php echo $image_list->RowIndex ?>_uuid" id="o<?php echo $image_list->RowIndex ?>_uuid" value="<?php echo HtmlEncode($image->uuid->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_uuid" class="form-group image_uuid">
<input type="text" data-table="image" data-field="x_uuid" name="x<?php echo $image_list->RowIndex ?>_uuid" id="x<?php echo $image_list->RowIndex ?>_uuid" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($image->uuid->getPlaceHolder()) ?>" value="<?php echo $image->uuid->EditValue ?>"<?php echo $image->uuid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_uuid" class="image_uuid">
<span<?php echo $image->uuid->viewAttributes() ?>>
<?php echo $image->uuid->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $image->user_id->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_user_id" class="form-group image_user_id">
<input type="text" data-table="image" data-field="x_user_id" name="x<?php echo $image_list->RowIndex ?>_user_id" id="x<?php echo $image_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($image->user_id->getPlaceHolder()) ?>" value="<?php echo $image->user_id->EditValue ?>"<?php echo $image->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_user_id" name="o<?php echo $image_list->RowIndex ?>_user_id" id="o<?php echo $image_list->RowIndex ?>_user_id" value="<?php echo HtmlEncode($image->user_id->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_user_id" class="form-group image_user_id">
<input type="text" data-table="image" data-field="x_user_id" name="x<?php echo $image_list->RowIndex ?>_user_id" id="x<?php echo $image_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($image->user_id->getPlaceHolder()) ?>" value="<?php echo $image->user_id->EditValue ?>"<?php echo $image->user_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_user_id" class="image_user_id">
<span<?php echo $image->user_id->viewAttributes() ?>>
<?php echo $image->user_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->confirmed->Visible) { // confirmed ?>
		<td data-name="confirmed"<?php echo $image->confirmed->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_confirmed" class="form-group image_confirmed">
<input type="text" data-table="image" data-field="x_confirmed" name="x<?php echo $image_list->RowIndex ?>_confirmed" id="x<?php echo $image_list->RowIndex ?>_confirmed" size="30" placeholder="<?php echo HtmlEncode($image->confirmed->getPlaceHolder()) ?>" value="<?php echo $image->confirmed->EditValue ?>"<?php echo $image->confirmed->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_confirmed" name="o<?php echo $image_list->RowIndex ?>_confirmed" id="o<?php echo $image_list->RowIndex ?>_confirmed" value="<?php echo HtmlEncode($image->confirmed->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_confirmed" class="form-group image_confirmed">
<input type="text" data-table="image" data-field="x_confirmed" name="x<?php echo $image_list->RowIndex ?>_confirmed" id="x<?php echo $image_list->RowIndex ?>_confirmed" size="30" placeholder="<?php echo HtmlEncode($image->confirmed->getPlaceHolder()) ?>" value="<?php echo $image->confirmed->EditValue ?>"<?php echo $image->confirmed->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_confirmed" class="image_confirmed">
<span<?php echo $image->confirmed->viewAttributes() ?>>
<?php echo $image->confirmed->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $image->createdAt->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_createdAt" class="form-group image_createdAt">
<input type="text" data-table="image" data-field="x_createdAt" name="x<?php echo $image_list->RowIndex ?>_createdAt" id="x<?php echo $image_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($image->createdAt->getPlaceHolder()) ?>" value="<?php echo $image->createdAt->EditValue ?>"<?php echo $image->createdAt->editAttributes() ?>>
<?php if (!$image->createdAt->ReadOnly && !$image->createdAt->Disabled && !isset($image->createdAt->EditAttrs["readonly"]) && !isset($image->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="image" data-field="x_createdAt" name="o<?php echo $image_list->RowIndex ?>_createdAt" id="o<?php echo $image_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($image->createdAt->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_createdAt" class="form-group image_createdAt">
<input type="text" data-table="image" data-field="x_createdAt" name="x<?php echo $image_list->RowIndex ?>_createdAt" id="x<?php echo $image_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($image->createdAt->getPlaceHolder()) ?>" value="<?php echo $image->createdAt->EditValue ?>"<?php echo $image->createdAt->editAttributes() ?>>
<?php if (!$image->createdAt->ReadOnly && !$image->createdAt->Disabled && !isset($image->createdAt->EditAttrs["readonly"]) && !isset($image->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_createdAt" class="image_createdAt">
<span<?php echo $image->createdAt->viewAttributes() ?>>
<?php echo $image->createdAt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $image->updatedAt->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_updatedAt" class="form-group image_updatedAt">
<input type="text" data-table="image" data-field="x_updatedAt" name="x<?php echo $image_list->RowIndex ?>_updatedAt" id="x<?php echo $image_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($image->updatedAt->getPlaceHolder()) ?>" value="<?php echo $image->updatedAt->EditValue ?>"<?php echo $image->updatedAt->editAttributes() ?>>
<?php if (!$image->updatedAt->ReadOnly && !$image->updatedAt->Disabled && !isset($image->updatedAt->EditAttrs["readonly"]) && !isset($image->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="image" data-field="x_updatedAt" name="o<?php echo $image_list->RowIndex ?>_updatedAt" id="o<?php echo $image_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($image->updatedAt->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_updatedAt" class="form-group image_updatedAt">
<input type="text" data-table="image" data-field="x_updatedAt" name="x<?php echo $image_list->RowIndex ?>_updatedAt" id="x<?php echo $image_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($image->updatedAt->getPlaceHolder()) ?>" value="<?php echo $image->updatedAt->EditValue ?>"<?php echo $image->updatedAt->editAttributes() ?>>
<?php if (!$image->updatedAt->ReadOnly && !$image->updatedAt->Disabled && !isset($image->updatedAt->EditAttrs["readonly"]) && !isset($image->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_list->RowCnt ?>_image_updatedAt" class="image_updatedAt">
<span<?php echo $image->updatedAt->viewAttributes() ?>>
<?php echo $image->updatedAt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$image_list->ListOptions->render("body", "right", $image_list->RowCnt);
?>
	</tr>
<?php if ($image->RowType == ROWTYPE_ADD || $image->RowType == ROWTYPE_EDIT) { ?>
<script>
fimagelist.updateLists(<?php echo $image_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$image->isGridAdd())
		if (!$image_list->Recordset->EOF)
			$image_list->Recordset->moveNext();
}
?>
<?php
	if ($image->isGridAdd() || $image->isGridEdit()) {
		$image_list->RowIndex = '$rowindex$';
		$image_list->loadRowValues();

		// Set row properties
		$image->resetAttributes();
		$image->RowAttrs = array_merge($image->RowAttrs, array('data-rowindex'=>$image_list->RowIndex, 'id'=>'r0_image', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($image->RowAttrs["class"], "ew-template");
		$image->RowType = ROWTYPE_ADD;

		// Render row
		$image_list->renderRow();

		// Render list options
		$image_list->renderListOptions();
		$image_list->StartRowCnt = 0;
?>
	<tr<?php echo $image->rowAttributes() ?>>
<?php

// Render list options (body, left)
$image_list->ListOptions->render("body", "left", $image_list->RowIndex);
?>
	<?php if ($image->path->Visible) { // path ?>
		<td data-name="path">
<span id="el$rowindex$_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_list->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_list->RowIndex ?>_path" id="x<?php echo $image_list->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_list->RowIndex ?>_path" id= "fn_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $image_list->RowIndex ?>_path" id= "fa_x<?php echo $image_list->RowIndex ?>_path" value="0">
<input type="hidden" name="fs_x<?php echo $image_list->RowIndex ?>_path" id= "fs_x<?php echo $image_list->RowIndex ?>_path" value="256">
<input type="hidden" name="fx_x<?php echo $image_list->RowIndex ?>_path" id= "fx_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_list->RowIndex ?>_path" id= "fm_x<?php echo $image_list->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_list->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="image" data-field="x_path" name="o<?php echo $image_list->RowIndex ?>_path" id="o<?php echo $image_list->RowIndex ?>_path" value="<?php echo HtmlEncode($image->path->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->description->Visible) { // description ?>
		<td data-name="description">
<span id="el$rowindex$_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_list->RowIndex ?>_description" id="x<?php echo $image_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_description" name="o<?php echo $image_list->RowIndex ?>_description" id="o<?php echo $image_list->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->uuid->Visible) { // uuid ?>
		<td data-name="uuid">
<span id="el$rowindex$_image_uuid" class="form-group image_uuid">
<input type="text" data-table="image" data-field="x_uuid" name="x<?php echo $image_list->RowIndex ?>_uuid" id="x<?php echo $image_list->RowIndex ?>_uuid" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($image->uuid->getPlaceHolder()) ?>" value="<?php echo $image->uuid->EditValue ?>"<?php echo $image->uuid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_uuid" name="o<?php echo $image_list->RowIndex ?>_uuid" id="o<?php echo $image_list->RowIndex ?>_uuid" value="<?php echo HtmlEncode($image->uuid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<span id="el$rowindex$_image_user_id" class="form-group image_user_id">
<input type="text" data-table="image" data-field="x_user_id" name="x<?php echo $image_list->RowIndex ?>_user_id" id="x<?php echo $image_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($image->user_id->getPlaceHolder()) ?>" value="<?php echo $image->user_id->EditValue ?>"<?php echo $image->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_user_id" name="o<?php echo $image_list->RowIndex ?>_user_id" id="o<?php echo $image_list->RowIndex ?>_user_id" value="<?php echo HtmlEncode($image->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->confirmed->Visible) { // confirmed ?>
		<td data-name="confirmed">
<span id="el$rowindex$_image_confirmed" class="form-group image_confirmed">
<input type="text" data-table="image" data-field="x_confirmed" name="x<?php echo $image_list->RowIndex ?>_confirmed" id="x<?php echo $image_list->RowIndex ?>_confirmed" size="30" placeholder="<?php echo HtmlEncode($image->confirmed->getPlaceHolder()) ?>" value="<?php echo $image->confirmed->EditValue ?>"<?php echo $image->confirmed->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_confirmed" name="o<?php echo $image_list->RowIndex ?>_confirmed" id="o<?php echo $image_list->RowIndex ?>_confirmed" value="<?php echo HtmlEncode($image->confirmed->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<span id="el$rowindex$_image_createdAt" class="form-group image_createdAt">
<input type="text" data-table="image" data-field="x_createdAt" name="x<?php echo $image_list->RowIndex ?>_createdAt" id="x<?php echo $image_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($image->createdAt->getPlaceHolder()) ?>" value="<?php echo $image->createdAt->EditValue ?>"<?php echo $image->createdAt->editAttributes() ?>>
<?php if (!$image->createdAt->ReadOnly && !$image->createdAt->Disabled && !isset($image->createdAt->EditAttrs["readonly"]) && !isset($image->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="image" data-field="x_createdAt" name="o<?php echo $image_list->RowIndex ?>_createdAt" id="o<?php echo $image_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($image->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<span id="el$rowindex$_image_updatedAt" class="form-group image_updatedAt">
<input type="text" data-table="image" data-field="x_updatedAt" name="x<?php echo $image_list->RowIndex ?>_updatedAt" id="x<?php echo $image_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($image->updatedAt->getPlaceHolder()) ?>" value="<?php echo $image->updatedAt->EditValue ?>"<?php echo $image->updatedAt->editAttributes() ?>>
<?php if (!$image->updatedAt->ReadOnly && !$image->updatedAt->Disabled && !isset($image->updatedAt->EditAttrs["readonly"]) && !isset($image->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagelist", "x<?php echo $image_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="image" data-field="x_updatedAt" name="o<?php echo $image_list->RowIndex ?>_updatedAt" id="o<?php echo $image_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($image->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$image_list->ListOptions->render("body", "right", $image_list->RowIndex);
?>
<script>
fimagelist.updateLists(<?php echo $image_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if ($image->isAdd() || $image->isCopy()) { ?>
<input type="hidden" name="<?php echo $image_list->FormKeyCountName ?>" id="<?php echo $image_list->FormKeyCountName ?>" value="<?php echo $image_list->KeyCount ?>">
<?php } ?>
<?php if ($image->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $image_list->FormKeyCountName ?>" id="<?php echo $image_list->FormKeyCountName ?>" value="<?php echo $image_list->KeyCount ?>">
<?php echo $image_list->MultiSelectKey ?>
<?php } ?>
<?php if ($image->isEdit()) { ?>
<input type="hidden" name="<?php echo $image_list->FormKeyCountName ?>" id="<?php echo $image_list->FormKeyCountName ?>" value="<?php echo $image_list->KeyCount ?>">
<?php } ?>
<?php if ($image->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $image_list->FormKeyCountName ?>" id="<?php echo $image_list->FormKeyCountName ?>" value="<?php echo $image_list->KeyCount ?>">
<?php echo $image_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$image->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($image_list->Recordset)
	$image_list->Recordset->Close();
?>
<?php if (!$image->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$image->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($image_list->Pager)) $image_list->Pager = new NumericPager($image_list->StartRec, $image_list->DisplayRecs, $image_list->TotalRecs, $image_list->RecRange, $image_list->AutoHidePager) ?>
<?php if ($image_list->Pager->RecordCount > 0 && $image_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($image_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($image_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($image_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $image_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($image_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($image_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_list->pageUrl() ?>start=<?php echo $image_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($image_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $image_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $image_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $image_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($image_list->TotalRecs > 0 && (!$image_list->AutoHidePageSizeSelector || $image_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="image">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($image_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($image_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($image_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($image_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($image_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($image_list->TotalRecs == 0 && !$image->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($image_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$image_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$image->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$image_list->terminate();
?>
