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
$request_trip_list = new request_trip_list();

// Run the page
$request_trip_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$request_trip_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$request_trip->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var frequest_triplist = currentForm = new ew.Form("frequest_triplist", "list");
frequest_triplist.formKeyCountName = '<?php echo $request_trip_list->FormKeyCountName ?>';

// Validate form
frequest_triplist.validate = function() {
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
		<?php if ($request_trip_list->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->from_place->caption(), $request_trip->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_list->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->to_place->caption(), $request_trip->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_list->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->description->caption(), $request_trip->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_list->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->user_id->caption(), $request_trip->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->user_id->errorMessage()) ?>");
		<?php if ($request_trip_list->from_date->Required) { ?>
			elm = this.getElements("x" + infix + "_from_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->from_date->caption(), $request_trip->from_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_from_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->from_date->errorMessage()) ?>");
		<?php if ($request_trip_list->to_date->Required) { ?>
			elm = this.getElements("x" + infix + "_to_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->to_date->caption(), $request_trip->to_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_to_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->to_date->errorMessage()) ?>");
		<?php if ($request_trip_list->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->createdAt->caption(), $request_trip->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->createdAt->errorMessage()) ?>");
		<?php if ($request_trip_list->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->updatedAt->caption(), $request_trip->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->updatedAt->errorMessage()) ?>");
		<?php if ($request_trip_list->category->Required) { ?>
			elm = this.getElements("x" + infix + "_category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->category->caption(), $request_trip->category->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_category");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->category->errorMessage()) ?>");

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
frequest_triplist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "from_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "user_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "from_date", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_date", false)) return false;
	if (ew.valueChanged(fobj, infix, "createdAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "updatedAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "category", false)) return false;
	return true;
}

// Form_CustomValidate event
frequest_triplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frequest_triplist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var frequest_triplistsrch = currentSearchForm = new ew.Form("frequest_triplistsrch");

// Filters
frequest_triplistsrch.filterList = <?php echo $request_trip_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$request_trip->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($request_trip_list->TotalRecs > 0 && $request_trip_list->ExportOptions->visible()) { ?>
<?php $request_trip_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($request_trip_list->ImportOptions->visible()) { ?>
<?php $request_trip_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($request_trip_list->SearchOptions->visible()) { ?>
<?php $request_trip_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($request_trip_list->FilterOptions->visible()) { ?>
<?php $request_trip_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$request_trip_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$request_trip->isExport() && !$request_trip->CurrentAction) { ?>
<form name="frequest_triplistsrch" id="frequest_triplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($request_trip_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="frequest_triplistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="request_trip">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($request_trip_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($request_trip_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $request_trip_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($request_trip_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($request_trip_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($request_trip_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($request_trip_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $request_trip_list->showPageHeader(); ?>
<?php
$request_trip_list->showMessage();
?>
<?php if ($request_trip_list->TotalRecs > 0 || $request_trip->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($request_trip_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> request_trip">
<?php if (!$request_trip->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$request_trip->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($request_trip_list->Pager)) $request_trip_list->Pager = new NumericPager($request_trip_list->StartRec, $request_trip_list->DisplayRecs, $request_trip_list->TotalRecs, $request_trip_list->RecRange, $request_trip_list->AutoHidePager) ?>
<?php if ($request_trip_list->Pager->RecordCount > 0 && $request_trip_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($request_trip_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($request_trip_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $request_trip_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($request_trip_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($request_trip_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $request_trip_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $request_trip_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $request_trip_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($request_trip_list->TotalRecs > 0 && (!$request_trip_list->AutoHidePageSizeSelector || $request_trip_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="request_trip">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($request_trip_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($request_trip_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($request_trip_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($request_trip_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($request_trip_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frequest_triplist" id="frequest_triplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($request_trip_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $request_trip_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="request_trip">
<div id="gmp_request_trip" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($request_trip_list->TotalRecs > 0 || $request_trip->isAdd() || $request_trip->isCopy() || $request_trip->isGridEdit()) { ?>
<table id="tbl_request_triplist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$request_trip_list->RowType = ROWTYPE_HEADER;

// Render list options
$request_trip_list->renderListOptions();

// Render list options (header, left)
$request_trip_list->ListOptions->render("header", "left");
?>
<?php if ($request_trip->from_place->Visible) { // from_place ?>
	<?php if ($request_trip->sortUrl($request_trip->from_place) == "") { ?>
		<th data-name="from_place" class="<?php echo $request_trip->from_place->headerCellClass() ?>"><div id="elh_request_trip_from_place" class="request_trip_from_place"><div class="ew-table-header-caption"><?php echo $request_trip->from_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_place" class="<?php echo $request_trip->from_place->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->from_place) ?>',1);"><div id="elh_request_trip_from_place" class="request_trip_from_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->from_place->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($request_trip->from_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->from_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
	<?php if ($request_trip->sortUrl($request_trip->to_place) == "") { ?>
		<th data-name="to_place" class="<?php echo $request_trip->to_place->headerCellClass() ?>"><div id="elh_request_trip_to_place" class="request_trip_to_place"><div class="ew-table-header-caption"><?php echo $request_trip->to_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_place" class="<?php echo $request_trip->to_place->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->to_place) ?>',1);"><div id="elh_request_trip_to_place" class="request_trip_to_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->to_place->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($request_trip->to_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->to_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
	<?php if ($request_trip->sortUrl($request_trip->description) == "") { ?>
		<th data-name="description" class="<?php echo $request_trip->description->headerCellClass() ?>"><div id="elh_request_trip_description" class="request_trip_description"><div class="ew-table-header-caption"><?php echo $request_trip->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $request_trip->description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->description) ?>',1);"><div id="elh_request_trip_description" class="request_trip_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->description->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($request_trip->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->user_id->Visible) { // user_id ?>
	<?php if ($request_trip->sortUrl($request_trip->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $request_trip->user_id->headerCellClass() ?>"><div id="elh_request_trip_user_id" class="request_trip_user_id"><div class="ew-table-header-caption"><?php echo $request_trip->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $request_trip->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->user_id) ?>',1);"><div id="elh_request_trip_user_id" class="request_trip_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->from_date->Visible) { // from_date ?>
	<?php if ($request_trip->sortUrl($request_trip->from_date) == "") { ?>
		<th data-name="from_date" class="<?php echo $request_trip->from_date->headerCellClass() ?>"><div id="elh_request_trip_from_date" class="request_trip_from_date"><div class="ew-table-header-caption"><?php echo $request_trip->from_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_date" class="<?php echo $request_trip->from_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->from_date) ?>',1);"><div id="elh_request_trip_from_date" class="request_trip_from_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->from_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->from_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->from_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->to_date->Visible) { // to_date ?>
	<?php if ($request_trip->sortUrl($request_trip->to_date) == "") { ?>
		<th data-name="to_date" class="<?php echo $request_trip->to_date->headerCellClass() ?>"><div id="elh_request_trip_to_date" class="request_trip_to_date"><div class="ew-table-header-caption"><?php echo $request_trip->to_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_date" class="<?php echo $request_trip->to_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->to_date) ?>',1);"><div id="elh_request_trip_to_date" class="request_trip_to_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->to_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->to_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->to_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
	<?php if ($request_trip->sortUrl($request_trip->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $request_trip->createdAt->headerCellClass() ?>"><div id="elh_request_trip_createdAt" class="request_trip_createdAt"><div class="ew-table-header-caption"><?php echo $request_trip->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $request_trip->createdAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->createdAt) ?>',1);"><div id="elh_request_trip_createdAt" class="request_trip_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
	<?php if ($request_trip->sortUrl($request_trip->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $request_trip->updatedAt->headerCellClass() ?>"><div id="elh_request_trip_updatedAt" class="request_trip_updatedAt"><div class="ew-table-header-caption"><?php echo $request_trip->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $request_trip->updatedAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->updatedAt) ?>',1);"><div id="elh_request_trip_updatedAt" class="request_trip_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->category->Visible) { // category ?>
	<?php if ($request_trip->sortUrl($request_trip->category) == "") { ?>
		<th data-name="category" class="<?php echo $request_trip->category->headerCellClass() ?>"><div id="elh_request_trip_category" class="request_trip_category"><div class="ew-table-header-caption"><?php echo $request_trip->category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category" class="<?php echo $request_trip->category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $request_trip->SortUrl($request_trip->category) ?>',1);"><div id="elh_request_trip_category" class="request_trip_category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->category->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->category->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->category->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$request_trip_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($request_trip->isAdd() || $request_trip->isCopy()) {
		$request_trip_list->RowIndex = 0;
		$request_trip_list->KeyCount = $request_trip_list->RowIndex;
		if ($request_trip->isCopy() && !$request_trip_list->loadRow())
			$request_trip->CurrentAction = "add";
		if ($request_trip->isAdd())
			$request_trip_list->loadRowValues();
		if ($request_trip->EventCancelled) // Insert failed
			$request_trip_list->restoreFormValues(); // Restore form values

		// Set row properties
		$request_trip->resetAttributes();
		$request_trip->RowAttrs = array_merge($request_trip->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_request_trip', 'data-rowtype'=>ROWTYPE_ADD));
		$request_trip->RowType = ROWTYPE_ADD;

		// Render row
		$request_trip_list->renderRow();

		// Render list options
		$request_trip_list->renderListOptions();
		$request_trip_list->StartRowCnt = 0;
?>
	<tr<?php echo $request_trip->rowAttributes() ?>>
<?php

// Render list options (body, left)
$request_trip_list->ListOptions->render("body", "left", $request_trip_list->RowCnt);
?>
	<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<td data-name="from_place">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_list->RowIndex ?>_from_place" id="x<?php echo $request_trip_list->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="o<?php echo $request_trip_list->RowIndex ?>_from_place" id="o<?php echo $request_trip_list->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<td data-name="to_place">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_list->RowIndex ?>_to_place" id="x<?php echo $request_trip_list->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="o<?php echo $request_trip_list->RowIndex ?>_to_place" id="o<?php echo $request_trip_list->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->description->Visible) { // description ?>
		<td data-name="description">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_list->RowIndex ?>_description" id="x<?php echo $request_trip_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_description" name="o<?php echo $request_trip_list->RowIndex ?>_description" id="o<?php echo $request_trip_list->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_user_id" class="form-group request_trip_user_id">
<input type="text" data-table="request_trip" data-field="x_user_id" name="x<?php echo $request_trip_list->RowIndex ?>_user_id" id="x<?php echo $request_trip_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->user_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->user_id->EditValue ?>"<?php echo $request_trip->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_user_id" name="o<?php echo $request_trip_list->RowIndex ?>_user_id" id="o<?php echo $request_trip_list->RowIndex ?>_user_id" value="<?php echo HtmlEncode($request_trip->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->from_date->Visible) { // from_date ?>
		<td data-name="from_date">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_date" class="form-group request_trip_from_date">
<input type="text" data-table="request_trip" data-field="x_from_date" name="x<?php echo $request_trip_list->RowIndex ?>_from_date" id="x<?php echo $request_trip_list->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($request_trip->from_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_date->EditValue ?>"<?php echo $request_trip->from_date->editAttributes() ?>>
<?php if (!$request_trip->from_date->ReadOnly && !$request_trip->from_date->Disabled && !isset($request_trip->from_date->EditAttrs["readonly"]) && !isset($request_trip->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_date" name="o<?php echo $request_trip_list->RowIndex ?>_from_date" id="o<?php echo $request_trip_list->RowIndex ?>_from_date" value="<?php echo HtmlEncode($request_trip->from_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->to_date->Visible) { // to_date ?>
		<td data-name="to_date">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_date" class="form-group request_trip_to_date">
<input type="text" data-table="request_trip" data-field="x_to_date" name="x<?php echo $request_trip_list->RowIndex ?>_to_date" id="x<?php echo $request_trip_list->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($request_trip->to_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_date->EditValue ?>"<?php echo $request_trip->to_date->editAttributes() ?>>
<?php if (!$request_trip->to_date->ReadOnly && !$request_trip->to_date->Disabled && !isset($request_trip->to_date->EditAttrs["readonly"]) && !isset($request_trip->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_date" name="o<?php echo $request_trip_list->RowIndex ?>_to_date" id="o<?php echo $request_trip_list->RowIndex ?>_to_date" value="<?php echo HtmlEncode($request_trip->to_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_createdAt" class="form-group request_trip_createdAt">
<input type="text" data-table="request_trip" data-field="x_createdAt" name="x<?php echo $request_trip_list->RowIndex ?>_createdAt" id="x<?php echo $request_trip_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($request_trip->createdAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->createdAt->EditValue ?>"<?php echo $request_trip->createdAt->editAttributes() ?>>
<?php if (!$request_trip->createdAt->ReadOnly && !$request_trip->createdAt->Disabled && !isset($request_trip->createdAt->EditAttrs["readonly"]) && !isset($request_trip->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_createdAt" name="o<?php echo $request_trip_list->RowIndex ?>_createdAt" id="o<?php echo $request_trip_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($request_trip->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_updatedAt" class="form-group request_trip_updatedAt">
<input type="text" data-table="request_trip" data-field="x_updatedAt" name="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($request_trip->updatedAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->updatedAt->EditValue ?>"<?php echo $request_trip->updatedAt->editAttributes() ?>>
<?php if (!$request_trip->updatedAt->ReadOnly && !$request_trip->updatedAt->Disabled && !isset($request_trip->updatedAt->EditAttrs["readonly"]) && !isset($request_trip->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_updatedAt" name="o<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="o<?php echo $request_trip_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($request_trip->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->category->Visible) { // category ?>
		<td data-name="category">
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<input type="text" data-table="request_trip" data-field="x_category" name="x<?php echo $request_trip_list->RowIndex ?>_category" id="x<?php echo $request_trip_list->RowIndex ?>_category" size="30" placeholder="<?php echo HtmlEncode($request_trip->category->getPlaceHolder()) ?>" value="<?php echo $request_trip->category->EditValue ?>"<?php echo $request_trip->category->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_category" name="o<?php echo $request_trip_list->RowIndex ?>_category" id="o<?php echo $request_trip_list->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$request_trip_list->ListOptions->render("body", "right", $request_trip_list->RowCnt);
?>
<script>
frequest_triplist.updateLists(<?php echo $request_trip_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($request_trip->ExportAll && $request_trip->isExport()) {
	$request_trip_list->StopRec = $request_trip_list->TotalRecs;
} else {

	// Set the last record to display
	if ($request_trip_list->TotalRecs > $request_trip_list->StartRec + $request_trip_list->DisplayRecs - 1)
		$request_trip_list->StopRec = $request_trip_list->StartRec + $request_trip_list->DisplayRecs - 1;
	else
		$request_trip_list->StopRec = $request_trip_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $request_trip_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($request_trip_list->FormKeyCountName) && ($request_trip->isGridAdd() || $request_trip->isGridEdit() || $request_trip->isConfirm())) {
		$request_trip_list->KeyCount = $CurrentForm->getValue($request_trip_list->FormKeyCountName);
		$request_trip_list->StopRec = $request_trip_list->StartRec + $request_trip_list->KeyCount - 1;
	}
}
$request_trip_list->RecCnt = $request_trip_list->StartRec - 1;
if ($request_trip_list->Recordset && !$request_trip_list->Recordset->EOF) {
	$request_trip_list->Recordset->moveFirst();
	$selectLimit = $request_trip_list->UseSelectLimit;
	if (!$selectLimit && $request_trip_list->StartRec > 1)
		$request_trip_list->Recordset->move($request_trip_list->StartRec - 1);
} elseif (!$request_trip->AllowAddDeleteRow && $request_trip_list->StopRec == 0) {
	$request_trip_list->StopRec = $request_trip->GridAddRowCount;
}

// Initialize aggregate
$request_trip->RowType = ROWTYPE_AGGREGATEINIT;
$request_trip->resetAttributes();
$request_trip_list->renderRow();
$request_trip_list->EditRowCnt = 0;
if ($request_trip->isEdit())
	$request_trip_list->RowIndex = 1;
if ($request_trip->isGridAdd())
	$request_trip_list->RowIndex = 0;
if ($request_trip->isGridEdit())
	$request_trip_list->RowIndex = 0;
while ($request_trip_list->RecCnt < $request_trip_list->StopRec) {
	$request_trip_list->RecCnt++;
	if ($request_trip_list->RecCnt >= $request_trip_list->StartRec) {
		$request_trip_list->RowCnt++;
		if ($request_trip->isGridAdd() || $request_trip->isGridEdit() || $request_trip->isConfirm()) {
			$request_trip_list->RowIndex++;
			$CurrentForm->Index = $request_trip_list->RowIndex;
			if ($CurrentForm->hasValue($request_trip_list->FormActionName) && $request_trip_list->EventCancelled)
				$request_trip_list->RowAction = strval($CurrentForm->getValue($request_trip_list->FormActionName));
			elseif ($request_trip->isGridAdd())
				$request_trip_list->RowAction = "insert";
			else
				$request_trip_list->RowAction = "";
		}

		// Set up key count
		$request_trip_list->KeyCount = $request_trip_list->RowIndex;

		// Init row class and style
		$request_trip->resetAttributes();
		$request_trip->CssClass = "";
		if ($request_trip->isGridAdd()) {
			$request_trip_list->loadRowValues(); // Load default values
		} else {
			$request_trip_list->loadRowValues($request_trip_list->Recordset); // Load row values
		}
		$request_trip->RowType = ROWTYPE_VIEW; // Render view
		if ($request_trip->isGridAdd()) // Grid add
			$request_trip->RowType = ROWTYPE_ADD; // Render add
		if ($request_trip->isGridAdd() && $request_trip->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$request_trip_list->restoreCurrentRowFormValues($request_trip_list->RowIndex); // Restore form values
		if ($request_trip->isEdit()) {
			if ($request_trip_list->checkInlineEditKey() && $request_trip_list->EditRowCnt == 0) { // Inline edit
				$request_trip->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($request_trip->isGridEdit()) { // Grid edit
			if ($request_trip->EventCancelled)
				$request_trip_list->restoreCurrentRowFormValues($request_trip_list->RowIndex); // Restore form values
			if ($request_trip_list->RowAction == "insert")
				$request_trip->RowType = ROWTYPE_ADD; // Render add
			else
				$request_trip->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($request_trip->isEdit() && $request_trip->RowType == ROWTYPE_EDIT && $request_trip->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$request_trip_list->restoreFormValues(); // Restore form values
		}
		if ($request_trip->isGridEdit() && ($request_trip->RowType == ROWTYPE_EDIT || $request_trip->RowType == ROWTYPE_ADD) && $request_trip->EventCancelled) // Update failed
			$request_trip_list->restoreCurrentRowFormValues($request_trip_list->RowIndex); // Restore form values
		if ($request_trip->RowType == ROWTYPE_EDIT) // Edit row
			$request_trip_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$request_trip->RowAttrs = array_merge($request_trip->RowAttrs, array('data-rowindex'=>$request_trip_list->RowCnt, 'id'=>'r' . $request_trip_list->RowCnt . '_request_trip', 'data-rowtype'=>$request_trip->RowType));

		// Render row
		$request_trip_list->renderRow();

		// Render list options
		$request_trip_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($request_trip_list->RowAction <> "delete" && $request_trip_list->RowAction <> "insertdelete" && !($request_trip_list->RowAction == "insert" && $request_trip->isConfirm() && $request_trip_list->emptyRow())) {
?>
	<tr<?php echo $request_trip->rowAttributes() ?>>
<?php

// Render list options (body, left)
$request_trip_list->ListOptions->render("body", "left", $request_trip_list->RowCnt);
?>
	<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<td data-name="from_place"<?php echo $request_trip->from_place->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_list->RowIndex ?>_from_place" id="x<?php echo $request_trip_list->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="o<?php echo $request_trip_list->RowIndex ?>_from_place" id="o<?php echo $request_trip_list->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_list->RowIndex ?>_from_place" id="x<?php echo $request_trip_list->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_place" class="request_trip_from_place">
<span<?php echo $request_trip->from_place->viewAttributes() ?>>
<?php echo $request_trip->from_place->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="request_trip" data-field="x_id" name="x<?php echo $request_trip_list->RowIndex ?>_id" id="x<?php echo $request_trip_list->RowIndex ?>_id" value="<?php echo HtmlEncode($request_trip->id->CurrentValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_id" name="o<?php echo $request_trip_list->RowIndex ?>_id" id="o<?php echo $request_trip_list->RowIndex ?>_id" value="<?php echo HtmlEncode($request_trip->id->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT || $request_trip->CurrentMode == "edit") { ?>
<input type="hidden" data-table="request_trip" data-field="x_id" name="x<?php echo $request_trip_list->RowIndex ?>_id" id="x<?php echo $request_trip_list->RowIndex ?>_id" value="<?php echo HtmlEncode($request_trip->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<td data-name="to_place"<?php echo $request_trip->to_place->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_list->RowIndex ?>_to_place" id="x<?php echo $request_trip_list->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="o<?php echo $request_trip_list->RowIndex ?>_to_place" id="o<?php echo $request_trip_list->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_list->RowIndex ?>_to_place" id="x<?php echo $request_trip_list->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_place" class="request_trip_to_place">
<span<?php echo $request_trip->to_place->viewAttributes() ?>>
<?php echo $request_trip->to_place->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->description->Visible) { // description ?>
		<td data-name="description"<?php echo $request_trip->description->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_list->RowIndex ?>_description" id="x<?php echo $request_trip_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_description" name="o<?php echo $request_trip_list->RowIndex ?>_description" id="o<?php echo $request_trip_list->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_list->RowIndex ?>_description" id="x<?php echo $request_trip_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_description" class="request_trip_description">
<span<?php echo $request_trip->description->viewAttributes() ?>>
<?php echo $request_trip->description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $request_trip->user_id->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_user_id" class="form-group request_trip_user_id">
<input type="text" data-table="request_trip" data-field="x_user_id" name="x<?php echo $request_trip_list->RowIndex ?>_user_id" id="x<?php echo $request_trip_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->user_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->user_id->EditValue ?>"<?php echo $request_trip->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_user_id" name="o<?php echo $request_trip_list->RowIndex ?>_user_id" id="o<?php echo $request_trip_list->RowIndex ?>_user_id" value="<?php echo HtmlEncode($request_trip->user_id->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_user_id" class="form-group request_trip_user_id">
<input type="text" data-table="request_trip" data-field="x_user_id" name="x<?php echo $request_trip_list->RowIndex ?>_user_id" id="x<?php echo $request_trip_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->user_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->user_id->EditValue ?>"<?php echo $request_trip->user_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_user_id" class="request_trip_user_id">
<span<?php echo $request_trip->user_id->viewAttributes() ?>>
<?php echo $request_trip->user_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->from_date->Visible) { // from_date ?>
		<td data-name="from_date"<?php echo $request_trip->from_date->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_date" class="form-group request_trip_from_date">
<input type="text" data-table="request_trip" data-field="x_from_date" name="x<?php echo $request_trip_list->RowIndex ?>_from_date" id="x<?php echo $request_trip_list->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($request_trip->from_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_date->EditValue ?>"<?php echo $request_trip->from_date->editAttributes() ?>>
<?php if (!$request_trip->from_date->ReadOnly && !$request_trip->from_date->Disabled && !isset($request_trip->from_date->EditAttrs["readonly"]) && !isset($request_trip->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_date" name="o<?php echo $request_trip_list->RowIndex ?>_from_date" id="o<?php echo $request_trip_list->RowIndex ?>_from_date" value="<?php echo HtmlEncode($request_trip->from_date->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_date" class="form-group request_trip_from_date">
<input type="text" data-table="request_trip" data-field="x_from_date" name="x<?php echo $request_trip_list->RowIndex ?>_from_date" id="x<?php echo $request_trip_list->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($request_trip->from_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_date->EditValue ?>"<?php echo $request_trip->from_date->editAttributes() ?>>
<?php if (!$request_trip->from_date->ReadOnly && !$request_trip->from_date->Disabled && !isset($request_trip->from_date->EditAttrs["readonly"]) && !isset($request_trip->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_from_date" class="request_trip_from_date">
<span<?php echo $request_trip->from_date->viewAttributes() ?>>
<?php echo $request_trip->from_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->to_date->Visible) { // to_date ?>
		<td data-name="to_date"<?php echo $request_trip->to_date->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_date" class="form-group request_trip_to_date">
<input type="text" data-table="request_trip" data-field="x_to_date" name="x<?php echo $request_trip_list->RowIndex ?>_to_date" id="x<?php echo $request_trip_list->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($request_trip->to_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_date->EditValue ?>"<?php echo $request_trip->to_date->editAttributes() ?>>
<?php if (!$request_trip->to_date->ReadOnly && !$request_trip->to_date->Disabled && !isset($request_trip->to_date->EditAttrs["readonly"]) && !isset($request_trip->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_date" name="o<?php echo $request_trip_list->RowIndex ?>_to_date" id="o<?php echo $request_trip_list->RowIndex ?>_to_date" value="<?php echo HtmlEncode($request_trip->to_date->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_date" class="form-group request_trip_to_date">
<input type="text" data-table="request_trip" data-field="x_to_date" name="x<?php echo $request_trip_list->RowIndex ?>_to_date" id="x<?php echo $request_trip_list->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($request_trip->to_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_date->EditValue ?>"<?php echo $request_trip->to_date->editAttributes() ?>>
<?php if (!$request_trip->to_date->ReadOnly && !$request_trip->to_date->Disabled && !isset($request_trip->to_date->EditAttrs["readonly"]) && !isset($request_trip->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_to_date" class="request_trip_to_date">
<span<?php echo $request_trip->to_date->viewAttributes() ?>>
<?php echo $request_trip->to_date->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $request_trip->createdAt->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_createdAt" class="form-group request_trip_createdAt">
<input type="text" data-table="request_trip" data-field="x_createdAt" name="x<?php echo $request_trip_list->RowIndex ?>_createdAt" id="x<?php echo $request_trip_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($request_trip->createdAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->createdAt->EditValue ?>"<?php echo $request_trip->createdAt->editAttributes() ?>>
<?php if (!$request_trip->createdAt->ReadOnly && !$request_trip->createdAt->Disabled && !isset($request_trip->createdAt->EditAttrs["readonly"]) && !isset($request_trip->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_createdAt" name="o<?php echo $request_trip_list->RowIndex ?>_createdAt" id="o<?php echo $request_trip_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($request_trip->createdAt->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_createdAt" class="form-group request_trip_createdAt">
<input type="text" data-table="request_trip" data-field="x_createdAt" name="x<?php echo $request_trip_list->RowIndex ?>_createdAt" id="x<?php echo $request_trip_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($request_trip->createdAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->createdAt->EditValue ?>"<?php echo $request_trip->createdAt->editAttributes() ?>>
<?php if (!$request_trip->createdAt->ReadOnly && !$request_trip->createdAt->Disabled && !isset($request_trip->createdAt->EditAttrs["readonly"]) && !isset($request_trip->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_createdAt" class="request_trip_createdAt">
<span<?php echo $request_trip->createdAt->viewAttributes() ?>>
<?php echo $request_trip->createdAt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $request_trip->updatedAt->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_updatedAt" class="form-group request_trip_updatedAt">
<input type="text" data-table="request_trip" data-field="x_updatedAt" name="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($request_trip->updatedAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->updatedAt->EditValue ?>"<?php echo $request_trip->updatedAt->editAttributes() ?>>
<?php if (!$request_trip->updatedAt->ReadOnly && !$request_trip->updatedAt->Disabled && !isset($request_trip->updatedAt->EditAttrs["readonly"]) && !isset($request_trip->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_updatedAt" name="o<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="o<?php echo $request_trip_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($request_trip->updatedAt->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_updatedAt" class="form-group request_trip_updatedAt">
<input type="text" data-table="request_trip" data-field="x_updatedAt" name="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($request_trip->updatedAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->updatedAt->EditValue ?>"<?php echo $request_trip->updatedAt->editAttributes() ?>>
<?php if (!$request_trip->updatedAt->ReadOnly && !$request_trip->updatedAt->Disabled && !isset($request_trip->updatedAt->EditAttrs["readonly"]) && !isset($request_trip->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_updatedAt" class="request_trip_updatedAt">
<span<?php echo $request_trip->updatedAt->viewAttributes() ?>>
<?php echo $request_trip->updatedAt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->category->Visible) { // category ?>
		<td data-name="category"<?php echo $request_trip->category->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<input type="text" data-table="request_trip" data-field="x_category" name="x<?php echo $request_trip_list->RowIndex ?>_category" id="x<?php echo $request_trip_list->RowIndex ?>_category" size="30" placeholder="<?php echo HtmlEncode($request_trip->category->getPlaceHolder()) ?>" value="<?php echo $request_trip->category->EditValue ?>"<?php echo $request_trip->category->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_category" name="o<?php echo $request_trip_list->RowIndex ?>_category" id="o<?php echo $request_trip_list->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<input type="text" data-table="request_trip" data-field="x_category" name="x<?php echo $request_trip_list->RowIndex ?>_category" id="x<?php echo $request_trip_list->RowIndex ?>_category" size="30" placeholder="<?php echo HtmlEncode($request_trip->category->getPlaceHolder()) ?>" value="<?php echo $request_trip->category->EditValue ?>"<?php echo $request_trip->category->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_list->RowCnt ?>_request_trip_category" class="request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<?php echo $request_trip->category->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$request_trip_list->ListOptions->render("body", "right", $request_trip_list->RowCnt);
?>
	</tr>
<?php if ($request_trip->RowType == ROWTYPE_ADD || $request_trip->RowType == ROWTYPE_EDIT) { ?>
<script>
frequest_triplist.updateLists(<?php echo $request_trip_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$request_trip->isGridAdd())
		if (!$request_trip_list->Recordset->EOF)
			$request_trip_list->Recordset->moveNext();
}
?>
<?php
	if ($request_trip->isGridAdd() || $request_trip->isGridEdit()) {
		$request_trip_list->RowIndex = '$rowindex$';
		$request_trip_list->loadRowValues();

		// Set row properties
		$request_trip->resetAttributes();
		$request_trip->RowAttrs = array_merge($request_trip->RowAttrs, array('data-rowindex'=>$request_trip_list->RowIndex, 'id'=>'r0_request_trip', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($request_trip->RowAttrs["class"], "ew-template");
		$request_trip->RowType = ROWTYPE_ADD;

		// Render row
		$request_trip_list->renderRow();

		// Render list options
		$request_trip_list->renderListOptions();
		$request_trip_list->StartRowCnt = 0;
?>
	<tr<?php echo $request_trip->rowAttributes() ?>>
<?php

// Render list options (body, left)
$request_trip_list->ListOptions->render("body", "left", $request_trip_list->RowIndex);
?>
	<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<td data-name="from_place">
<span id="el$rowindex$_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_list->RowIndex ?>_from_place" id="x<?php echo $request_trip_list->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="o<?php echo $request_trip_list->RowIndex ?>_from_place" id="o<?php echo $request_trip_list->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<td data-name="to_place">
<span id="el$rowindex$_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_list->RowIndex ?>_to_place" id="x<?php echo $request_trip_list->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="o<?php echo $request_trip_list->RowIndex ?>_to_place" id="o<?php echo $request_trip_list->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->description->Visible) { // description ?>
		<td data-name="description">
<span id="el$rowindex$_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_list->RowIndex ?>_description" id="x<?php echo $request_trip_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_description" name="o<?php echo $request_trip_list->RowIndex ?>_description" id="o<?php echo $request_trip_list->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<span id="el$rowindex$_request_trip_user_id" class="form-group request_trip_user_id">
<input type="text" data-table="request_trip" data-field="x_user_id" name="x<?php echo $request_trip_list->RowIndex ?>_user_id" id="x<?php echo $request_trip_list->RowIndex ?>_user_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->user_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->user_id->EditValue ?>"<?php echo $request_trip->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_user_id" name="o<?php echo $request_trip_list->RowIndex ?>_user_id" id="o<?php echo $request_trip_list->RowIndex ?>_user_id" value="<?php echo HtmlEncode($request_trip->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->from_date->Visible) { // from_date ?>
		<td data-name="from_date">
<span id="el$rowindex$_request_trip_from_date" class="form-group request_trip_from_date">
<input type="text" data-table="request_trip" data-field="x_from_date" name="x<?php echo $request_trip_list->RowIndex ?>_from_date" id="x<?php echo $request_trip_list->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($request_trip->from_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_date->EditValue ?>"<?php echo $request_trip->from_date->editAttributes() ?>>
<?php if (!$request_trip->from_date->ReadOnly && !$request_trip->from_date->Disabled && !isset($request_trip->from_date->EditAttrs["readonly"]) && !isset($request_trip->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_date" name="o<?php echo $request_trip_list->RowIndex ?>_from_date" id="o<?php echo $request_trip_list->RowIndex ?>_from_date" value="<?php echo HtmlEncode($request_trip->from_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->to_date->Visible) { // to_date ?>
		<td data-name="to_date">
<span id="el$rowindex$_request_trip_to_date" class="form-group request_trip_to_date">
<input type="text" data-table="request_trip" data-field="x_to_date" name="x<?php echo $request_trip_list->RowIndex ?>_to_date" id="x<?php echo $request_trip_list->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($request_trip->to_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_date->EditValue ?>"<?php echo $request_trip->to_date->editAttributes() ?>>
<?php if (!$request_trip->to_date->ReadOnly && !$request_trip->to_date->Disabled && !isset($request_trip->to_date->EditAttrs["readonly"]) && !isset($request_trip->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_date" name="o<?php echo $request_trip_list->RowIndex ?>_to_date" id="o<?php echo $request_trip_list->RowIndex ?>_to_date" value="<?php echo HtmlEncode($request_trip->to_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<span id="el$rowindex$_request_trip_createdAt" class="form-group request_trip_createdAt">
<input type="text" data-table="request_trip" data-field="x_createdAt" name="x<?php echo $request_trip_list->RowIndex ?>_createdAt" id="x<?php echo $request_trip_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($request_trip->createdAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->createdAt->EditValue ?>"<?php echo $request_trip->createdAt->editAttributes() ?>>
<?php if (!$request_trip->createdAt->ReadOnly && !$request_trip->createdAt->Disabled && !isset($request_trip->createdAt->EditAttrs["readonly"]) && !isset($request_trip->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_createdAt" name="o<?php echo $request_trip_list->RowIndex ?>_createdAt" id="o<?php echo $request_trip_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($request_trip->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<span id="el$rowindex$_request_trip_updatedAt" class="form-group request_trip_updatedAt">
<input type="text" data-table="request_trip" data-field="x_updatedAt" name="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="x<?php echo $request_trip_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($request_trip->updatedAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->updatedAt->EditValue ?>"<?php echo $request_trip->updatedAt->editAttributes() ?>>
<?php if (!$request_trip->updatedAt->ReadOnly && !$request_trip->updatedAt->Disabled && !isset($request_trip->updatedAt->EditAttrs["readonly"]) && !isset($request_trip->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_triplist", "x<?php echo $request_trip_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_updatedAt" name="o<?php echo $request_trip_list->RowIndex ?>_updatedAt" id="o<?php echo $request_trip_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($request_trip->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->category->Visible) { // category ?>
		<td data-name="category">
<span id="el$rowindex$_request_trip_category" class="form-group request_trip_category">
<input type="text" data-table="request_trip" data-field="x_category" name="x<?php echo $request_trip_list->RowIndex ?>_category" id="x<?php echo $request_trip_list->RowIndex ?>_category" size="30" placeholder="<?php echo HtmlEncode($request_trip->category->getPlaceHolder()) ?>" value="<?php echo $request_trip->category->EditValue ?>"<?php echo $request_trip->category->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_category" name="o<?php echo $request_trip_list->RowIndex ?>_category" id="o<?php echo $request_trip_list->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$request_trip_list->ListOptions->render("body", "right", $request_trip_list->RowIndex);
?>
<script>
frequest_triplist.updateLists(<?php echo $request_trip_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if ($request_trip->isAdd() || $request_trip->isCopy()) { ?>
<input type="hidden" name="<?php echo $request_trip_list->FormKeyCountName ?>" id="<?php echo $request_trip_list->FormKeyCountName ?>" value="<?php echo $request_trip_list->KeyCount ?>">
<?php } ?>
<?php if ($request_trip->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $request_trip_list->FormKeyCountName ?>" id="<?php echo $request_trip_list->FormKeyCountName ?>" value="<?php echo $request_trip_list->KeyCount ?>">
<?php echo $request_trip_list->MultiSelectKey ?>
<?php } ?>
<?php if ($request_trip->isEdit()) { ?>
<input type="hidden" name="<?php echo $request_trip_list->FormKeyCountName ?>" id="<?php echo $request_trip_list->FormKeyCountName ?>" value="<?php echo $request_trip_list->KeyCount ?>">
<?php } ?>
<?php if ($request_trip->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $request_trip_list->FormKeyCountName ?>" id="<?php echo $request_trip_list->FormKeyCountName ?>" value="<?php echo $request_trip_list->KeyCount ?>">
<?php echo $request_trip_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$request_trip->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($request_trip_list->Recordset)
	$request_trip_list->Recordset->Close();
?>
<?php if (!$request_trip->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$request_trip->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($request_trip_list->Pager)) $request_trip_list->Pager = new NumericPager($request_trip_list->StartRec, $request_trip_list->DisplayRecs, $request_trip_list->TotalRecs, $request_trip_list->RecRange, $request_trip_list->AutoHidePager) ?>
<?php if ($request_trip_list->Pager->RecordCount > 0 && $request_trip_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($request_trip_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($request_trip_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $request_trip_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($request_trip_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_list->pageUrl() ?>start=<?php echo $request_trip_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($request_trip_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $request_trip_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $request_trip_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $request_trip_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($request_trip_list->TotalRecs > 0 && (!$request_trip_list->AutoHidePageSizeSelector || $request_trip_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="request_trip">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($request_trip_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($request_trip_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($request_trip_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($request_trip_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($request_trip_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($request_trip_list->TotalRecs == 0 && !$request_trip->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($request_trip_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$request_trip_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$request_trip->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$request_trip_list->terminate();
?>
