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
$orders_list = new orders_list();

// Run the page
$orders_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orders->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var forderslist = currentForm = new ew.Form("forderslist", "list");
forderslist.formKeyCountName = '<?php echo $orders_list->FormKeyCountName ?>';

// Validate form
forderslist.validate = function() {
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
		<?php if ($orders_list->_userid->Required) { ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->_userid->caption(), $orders->_userid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->_userid->errorMessage()) ?>");
		<?php if ($orders_list->parcel_id->Required) { ?>
			elm = this.getElements("x" + infix + "_parcel_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->parcel_id->caption(), $orders->parcel_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_parcel_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->parcel_id->errorMessage()) ?>");
		<?php if ($orders_list->carrier_id->Required) { ?>
			elm = this.getElements("x" + infix + "_carrier_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->carrier_id->caption(), $orders->carrier_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_carrier_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->carrier_id->errorMessage()) ?>");
		<?php if ($orders_list->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->description->caption(), $orders->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_list->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->status->caption(), $orders->status->RequiredErrorMessage)) ?>");
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
forderslist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "_userid", false)) return false;
	if (ew.valueChanged(fobj, infix, "parcel_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "carrier_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "status", false)) return false;
	return true;
}

// Form_CustomValidate event
forderslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
forderslist.lists["x__userid"] = <?php echo $orders_list->_userid->Lookup->toClientList() ?>;
forderslist.lists["x__userid"].options = <?php echo JsonEncode($orders_list->_userid->lookupOptions()) ?>;
forderslist.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
forderslist.lists["x_parcel_id"] = <?php echo $orders_list->parcel_id->Lookup->toClientList() ?>;
forderslist.lists["x_parcel_id"].options = <?php echo JsonEncode($orders_list->parcel_id->lookupOptions()) ?>;
forderslist.autoSuggests["x_parcel_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
forderslist.lists["x_carrier_id"] = <?php echo $orders_list->carrier_id->Lookup->toClientList() ?>;
forderslist.lists["x_carrier_id"].options = <?php echo JsonEncode($orders_list->carrier_id->lookupOptions()) ?>;
forderslist.autoSuggests["x_carrier_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
forderslist.lists["x_status"] = <?php echo $orders_list->status->Lookup->toClientList() ?>;
forderslist.lists["x_status"].options = <?php echo JsonEncode($orders_list->status->options(FALSE, TRUE)) ?>;

// Form object for search
var forderslistsrch = currentSearchForm = new ew.Form("forderslistsrch");

// Filters
forderslistsrch.filterList = <?php echo $orders_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orders->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($orders_list->TotalRecs > 0 && $orders_list->ExportOptions->visible()) { ?>
<?php $orders_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->ImportOptions->visible()) { ?>
<?php $orders_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->SearchOptions->visible()) { ?>
<?php $orders_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($orders_list->FilterOptions->visible()) { ?>
<?php $orders_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$orders->isExport() || EXPORT_MASTER_RECORD && $orders->isExport("print")) { ?>
<?php
if ($orders_list->DbMasterFilter <> "" && $orders->getCurrentMasterTable() == "user") {
	if ($orders_list->MasterRecordExists) {
		include_once "usermaster.php";
	}
}
?>
<?php
if ($orders_list->DbMasterFilter <> "" && $orders->getCurrentMasterTable() == "parcel_info") {
	if ($orders_list->MasterRecordExists) {
		include_once "parcel_infomaster.php";
	}
}
?>
<?php } ?>
<?php
$orders_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$orders->isExport() && !$orders->CurrentAction) { ?>
<form name="forderslistsrch" id="forderslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($orders_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="forderslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="orders">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($orders_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($orders_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $orders_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($orders_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $orders_list->showPageHeader(); ?>
<?php
$orders_list->showMessage();
?>
<?php if ($orders_list->TotalRecs > 0 || $orders->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders">
<?php if (!$orders->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$orders->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_list->Pager)) $orders_list->Pager = new NumericPager($orders_list->StartRec, $orders_list->DisplayRecs, $orders_list->TotalRecs, $orders_list->RecRange, $orders_list->AutoHidePager) ?>
<?php if ($orders_list->Pager->RecordCount > 0 && $orders_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($orders_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($orders_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($orders_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $orders_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($orders_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($orders_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($orders_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orders_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orders_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orders_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orders_list->TotalRecs > 0 && (!$orders_list->AutoHidePageSizeSelector || $orders_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orders">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orders_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orders_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orders_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($orders_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forderslist" id="forderslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<?php if ($orders->getCurrentMasterTable() == "user" && $orders->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $orders->_userid->getSessionValue() ?>">
<input type="hidden" name="fk_id" value="<?php echo $orders->carrier_id->getSessionValue() ?>">
<?php } ?>
<?php if ($orders->getCurrentMasterTable() == "parcel_info" && $orders->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="parcel_info">
<input type="hidden" name="fk_id" value="<?php echo $orders->parcel_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_orders" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($orders_list->TotalRecs > 0 || $orders->isAdd() || $orders->isCopy() || $orders->isGridEdit()) { ?>
<table id="tbl_orderslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders_list->RowType = ROWTYPE_HEADER;

// Render list options
$orders_list->renderListOptions();

// Render list options (header, left)
$orders_list->ListOptions->render("header", "left");
?>
<?php if ($orders->_userid->Visible) { // userid ?>
	<?php if ($orders->sortUrl($orders->_userid) == "") { ?>
		<th data-name="_userid" class="<?php echo $orders->_userid->headerCellClass() ?>"><div id="elh_orders__userid" class="orders__userid"><div class="ew-table-header-caption"><?php echo $orders->_userid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userid" class="<?php echo $orders->_userid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->_userid) ?>',1);"><div id="elh_orders__userid" class="orders__userid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->_userid->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->_userid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->_userid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
	<?php if ($orders->sortUrl($orders->parcel_id) == "") { ?>
		<th data-name="parcel_id" class="<?php echo $orders->parcel_id->headerCellClass() ?>"><div id="elh_orders_parcel_id" class="orders_parcel_id"><div class="ew-table-header-caption"><?php echo $orders->parcel_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="parcel_id" class="<?php echo $orders->parcel_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->parcel_id) ?>',1);"><div id="elh_orders_parcel_id" class="orders_parcel_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->parcel_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->parcel_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->parcel_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
	<?php if ($orders->sortUrl($orders->carrier_id) == "") { ?>
		<th data-name="carrier_id" class="<?php echo $orders->carrier_id->headerCellClass() ?>"><div id="elh_orders_carrier_id" class="orders_carrier_id"><div class="ew-table-header-caption"><?php echo $orders->carrier_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="carrier_id" class="<?php echo $orders->carrier_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->carrier_id) ?>',1);"><div id="elh_orders_carrier_id" class="orders_carrier_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->carrier_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->carrier_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->carrier_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
	<?php if ($orders->sortUrl($orders->description) == "") { ?>
		<th data-name="description" class="<?php echo $orders->description->headerCellClass() ?>"><div id="elh_orders_description" class="orders_description"><div class="ew-table-header-caption"><?php echo $orders->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $orders->description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->description) ?>',1);"><div id="elh_orders_description" class="orders_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->description->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($orders->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
	<?php if ($orders->sortUrl($orders->status) == "") { ?>
		<th data-name="status" class="<?php echo $orders->status->headerCellClass() ?>"><div id="elh_orders_status" class="orders_status"><div class="ew-table-header-caption"><?php echo $orders->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $orders->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $orders->SortUrl($orders->status) ?>',1);"><div id="elh_orders_status" class="orders_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($orders->isAdd() || $orders->isCopy()) {
		$orders_list->RowIndex = 0;
		$orders_list->KeyCount = $orders_list->RowIndex;
		if ($orders->isCopy() && !$orders_list->loadRow())
			$orders->CurrentAction = "add";
		if ($orders->isAdd())
			$orders_list->loadRowValues();
		if ($orders->EventCancelled) // Insert failed
			$orders_list->restoreFormValues(); // Restore form values

		// Set row properties
		$orders->resetAttributes();
		$orders->RowAttrs = array_merge($orders->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_orders', 'data-rowtype'=>ROWTYPE_ADD));
		$orders->RowType = ROWTYPE_ADD;

		// Render row
		$orders_list->renderRow();

		// Render list options
		$orders_list->renderListOptions();
		$orders_list->StartRowCnt = 0;
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_list->ListOptions->render("body", "left", $orders_list->RowCnt);
?>
	<?php if ($orders->_userid->Visible) { // userid ?>
		<td data-name="_userid">
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>__userid" name="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>__userid" id="sv_x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>__userid" id="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="o<?php echo $orders_list->RowIndex ?>__userid" id="o<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<td data-name="parcel_id">
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="o<?php echo $orders_list->RowIndex ?>_parcel_id" id="o<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<td data-name="carrier_id">
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="o<?php echo $orders_list->RowIndex ?>_carrier_id" id="o<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->description->Visible) { // description ?>
		<td data-name="description">
<span id="el<?php echo $orders_list->RowCnt ?>_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_list->RowIndex ?>_description" id="x<?php echo $orders_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_description" name="o<?php echo $orders_list->RowIndex ?>_description" id="o<?php echo $orders_list->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->status->Visible) { // status ?>
		<td data-name="status">
<span id="el<?php echo $orders_list->RowCnt ?>_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_list->RowIndex ?>_status" name="x<?php echo $orders_list->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_list->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="orders" data-field="x_status" name="o<?php echo $orders_list->RowIndex ?>_status" id="o<?php echo $orders_list->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_list->ListOptions->render("body", "right", $orders_list->RowCnt);
?>
<script>
forderslist.updateLists(<?php echo $orders_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($orders->ExportAll && $orders->isExport()) {
	$orders_list->StopRec = $orders_list->TotalRecs;
} else {

	// Set the last record to display
	if ($orders_list->TotalRecs > $orders_list->StartRec + $orders_list->DisplayRecs - 1)
		$orders_list->StopRec = $orders_list->StartRec + $orders_list->DisplayRecs - 1;
	else
		$orders_list->StopRec = $orders_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $orders_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($orders_list->FormKeyCountName) && ($orders->isGridAdd() || $orders->isGridEdit() || $orders->isConfirm())) {
		$orders_list->KeyCount = $CurrentForm->getValue($orders_list->FormKeyCountName);
		$orders_list->StopRec = $orders_list->StartRec + $orders_list->KeyCount - 1;
	}
}
$orders_list->RecCnt = $orders_list->StartRec - 1;
if ($orders_list->Recordset && !$orders_list->Recordset->EOF) {
	$orders_list->Recordset->moveFirst();
	$selectLimit = $orders_list->UseSelectLimit;
	if (!$selectLimit && $orders_list->StartRec > 1)
		$orders_list->Recordset->move($orders_list->StartRec - 1);
} elseif (!$orders->AllowAddDeleteRow && $orders_list->StopRec == 0) {
	$orders_list->StopRec = $orders->GridAddRowCount;
}

// Initialize aggregate
$orders->RowType = ROWTYPE_AGGREGATEINIT;
$orders->resetAttributes();
$orders_list->renderRow();
$orders_list->EditRowCnt = 0;
if ($orders->isEdit())
	$orders_list->RowIndex = 1;
if ($orders->isGridAdd())
	$orders_list->RowIndex = 0;
if ($orders->isGridEdit())
	$orders_list->RowIndex = 0;
while ($orders_list->RecCnt < $orders_list->StopRec) {
	$orders_list->RecCnt++;
	if ($orders_list->RecCnt >= $orders_list->StartRec) {
		$orders_list->RowCnt++;
		if ($orders->isGridAdd() || $orders->isGridEdit() || $orders->isConfirm()) {
			$orders_list->RowIndex++;
			$CurrentForm->Index = $orders_list->RowIndex;
			if ($CurrentForm->hasValue($orders_list->FormActionName) && $orders_list->EventCancelled)
				$orders_list->RowAction = strval($CurrentForm->getValue($orders_list->FormActionName));
			elseif ($orders->isGridAdd())
				$orders_list->RowAction = "insert";
			else
				$orders_list->RowAction = "";
		}

		// Set up key count
		$orders_list->KeyCount = $orders_list->RowIndex;

		// Init row class and style
		$orders->resetAttributes();
		$orders->CssClass = "";
		if ($orders->isGridAdd()) {
			$orders_list->loadRowValues(); // Load default values
		} else {
			$orders_list->loadRowValues($orders_list->Recordset); // Load row values
		}
		$orders->RowType = ROWTYPE_VIEW; // Render view
		if ($orders->isGridAdd()) // Grid add
			$orders->RowType = ROWTYPE_ADD; // Render add
		if ($orders->isGridAdd() && $orders->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$orders_list->restoreCurrentRowFormValues($orders_list->RowIndex); // Restore form values
		if ($orders->isEdit()) {
			if ($orders_list->checkInlineEditKey() && $orders_list->EditRowCnt == 0) { // Inline edit
				$orders->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($orders->isGridEdit()) { // Grid edit
			if ($orders->EventCancelled)
				$orders_list->restoreCurrentRowFormValues($orders_list->RowIndex); // Restore form values
			if ($orders_list->RowAction == "insert")
				$orders->RowType = ROWTYPE_ADD; // Render add
			else
				$orders->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($orders->isEdit() && $orders->RowType == ROWTYPE_EDIT && $orders->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$orders_list->restoreFormValues(); // Restore form values
		}
		if ($orders->isGridEdit() && ($orders->RowType == ROWTYPE_EDIT || $orders->RowType == ROWTYPE_ADD) && $orders->EventCancelled) // Update failed
			$orders_list->restoreCurrentRowFormValues($orders_list->RowIndex); // Restore form values
		if ($orders->RowType == ROWTYPE_EDIT) // Edit row
			$orders_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$orders->RowAttrs = array_merge($orders->RowAttrs, array('data-rowindex'=>$orders_list->RowCnt, 'id'=>'r' . $orders_list->RowCnt . '_orders', 'data-rowtype'=>$orders->RowType));

		// Render row
		$orders_list->renderRow();

		// Render list options
		$orders_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($orders_list->RowAction <> "delete" && $orders_list->RowAction <> "insertdelete" && !($orders_list->RowAction == "insert" && $orders->isConfirm() && $orders_list->emptyRow())) {
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_list->ListOptions->render("body", "left", $orders_list->RowCnt);
?>
	<?php if ($orders->_userid->Visible) { // userid ?>
		<td data-name="_userid"<?php echo $orders->_userid->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>__userid" name="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>__userid" id="sv_x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>__userid" id="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="o<?php echo $orders_list->RowIndex ?>__userid" id="o<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>__userid" name="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>__userid" id="sv_x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>__userid" id="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders__userid" class="orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<?php echo $orders->_userid->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="orders" data-field="x_id" name="x<?php echo $orders_list->RowIndex ?>_id" id="x<?php echo $orders_list->RowIndex ?>_id" value="<?php echo HtmlEncode($orders->id->CurrentValue) ?>">
<input type="hidden" data-table="orders" data-field="x_id" name="o<?php echo $orders_list->RowIndex ?>_id" id="o<?php echo $orders_list->RowIndex ?>_id" value="<?php echo HtmlEncode($orders->id->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT || $orders->CurrentMode == "edit") { ?>
<input type="hidden" data-table="orders" data-field="x_id" name="x<?php echo $orders_list->RowIndex ?>_id" id="x<?php echo $orders_list->RowIndex ?>_id" value="<?php echo HtmlEncode($orders->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<td data-name="parcel_id"<?php echo $orders->parcel_id->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="o<?php echo $orders_list->RowIndex ?>_parcel_id" id="o<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_parcel_id" class="orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<?php echo $orders->parcel_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<td data-name="carrier_id"<?php echo $orders->carrier_id->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="o<?php echo $orders_list->RowIndex ?>_carrier_id" id="o<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_carrier_id" class="orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<?php echo $orders->carrier_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($orders->description->Visible) { // description ?>
		<td data-name="description"<?php echo $orders->description->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_list->RowIndex ?>_description" id="x<?php echo $orders_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_description" name="o<?php echo $orders_list->RowIndex ?>_description" id="o<?php echo $orders_list->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_list->RowIndex ?>_description" id="x<?php echo $orders_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_description" class="orders_description">
<span<?php echo $orders->description->viewAttributes() ?>>
<?php echo $orders->description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($orders->status->Visible) { // status ?>
		<td data-name="status"<?php echo $orders->status->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_list->RowIndex ?>_status" name="x<?php echo $orders_list->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_list->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="orders" data-field="x_status" name="o<?php echo $orders_list->RowIndex ?>_status" id="o<?php echo $orders_list->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_list->RowIndex ?>_status" name="x<?php echo $orders_list->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_list->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_list->RowCnt ?>_orders_status" class="orders_status">
<span<?php echo $orders->status->viewAttributes() ?>>
<?php echo $orders->status->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_list->ListOptions->render("body", "right", $orders_list->RowCnt);
?>
	</tr>
<?php if ($orders->RowType == ROWTYPE_ADD || $orders->RowType == ROWTYPE_EDIT) { ?>
<script>
forderslist.updateLists(<?php echo $orders_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$orders->isGridAdd())
		if (!$orders_list->Recordset->EOF)
			$orders_list->Recordset->moveNext();
}
?>
<?php
	if ($orders->isGridAdd() || $orders->isGridEdit()) {
		$orders_list->RowIndex = '$rowindex$';
		$orders_list->loadRowValues();

		// Set row properties
		$orders->resetAttributes();
		$orders->RowAttrs = array_merge($orders->RowAttrs, array('data-rowindex'=>$orders_list->RowIndex, 'id'=>'r0_orders', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($orders->RowAttrs["class"], "ew-template");
		$orders->RowType = ROWTYPE_ADD;

		// Render row
		$orders_list->renderRow();

		// Render list options
		$orders_list->renderListOptions();
		$orders_list->StartRowCnt = 0;
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_list->ListOptions->render("body", "left", $orders_list->RowIndex);
?>
	<?php if ($orders->_userid->Visible) { // userid ?>
		<td data-name="_userid">
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el$rowindex$_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>__userid" name="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>__userid" id="sv_x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>__userid" id="x<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="o<?php echo $orders_list->RowIndex ?>__userid" id="o<?php echo $orders_list->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<td data-name="parcel_id">
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_parcel_id" id="x<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="o<?php echo $orders_list->RowIndex ?>_parcel_id" id="o<?php echo $orders_list->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<td data-name="carrier_id">
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_list->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_list->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_list->RowIndex ?>_carrier_id" id="x<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderslist.createAutoSuggest({"id":"x<?php echo $orders_list->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="o<?php echo $orders_list->RowIndex ?>_carrier_id" id="o<?php echo $orders_list->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->description->Visible) { // description ?>
		<td data-name="description">
<span id="el$rowindex$_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_list->RowIndex ?>_description" id="x<?php echo $orders_list->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_description" name="o<?php echo $orders_list->RowIndex ?>_description" id="o<?php echo $orders_list->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->status->Visible) { // status ?>
		<td data-name="status">
<span id="el$rowindex$_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_list->RowIndex ?>_status" name="x<?php echo $orders_list->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_list->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="orders" data-field="x_status" name="o<?php echo $orders_list->RowIndex ?>_status" id="o<?php echo $orders_list->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_list->ListOptions->render("body", "right", $orders_list->RowIndex);
?>
<script>
forderslist.updateLists(<?php echo $orders_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if ($orders->isAdd() || $orders->isCopy()) { ?>
<input type="hidden" name="<?php echo $orders_list->FormKeyCountName ?>" id="<?php echo $orders_list->FormKeyCountName ?>" value="<?php echo $orders_list->KeyCount ?>">
<?php } ?>
<?php if ($orders->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $orders_list->FormKeyCountName ?>" id="<?php echo $orders_list->FormKeyCountName ?>" value="<?php echo $orders_list->KeyCount ?>">
<?php echo $orders_list->MultiSelectKey ?>
<?php } ?>
<?php if ($orders->isEdit()) { ?>
<input type="hidden" name="<?php echo $orders_list->FormKeyCountName ?>" id="<?php echo $orders_list->FormKeyCountName ?>" value="<?php echo $orders_list->KeyCount ?>">
<?php } ?>
<?php if ($orders->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $orders_list->FormKeyCountName ?>" id="<?php echo $orders_list->FormKeyCountName ?>" value="<?php echo $orders_list->KeyCount ?>">
<?php echo $orders_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$orders->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($orders_list->Recordset)
	$orders_list->Recordset->Close();
?>
<?php if (!$orders->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$orders->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_list->Pager)) $orders_list->Pager = new NumericPager($orders_list->StartRec, $orders_list->DisplayRecs, $orders_list->TotalRecs, $orders_list->RecRange, $orders_list->AutoHidePager) ?>
<?php if ($orders_list->Pager->RecordCount > 0 && $orders_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($orders_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($orders_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($orders_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $orders_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($orders_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($orders_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_list->pageUrl() ?>start=<?php echo $orders_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($orders_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $orders_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $orders_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $orders_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($orders_list->TotalRecs > 0 && (!$orders_list->AutoHidePageSizeSelector || $orders_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="orders">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($orders_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($orders_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($orders_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($orders_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_list->TotalRecs == 0 && !$orders->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$orders->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$orders_list->terminate();
?>
