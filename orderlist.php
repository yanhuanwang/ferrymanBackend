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
$order_list = new order_list();

// Run the page
$order_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$order->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var forderlist = currentForm = new ew.Form("forderlist", "list");
forderlist.formKeyCountName = '<?php echo $order_list->FormKeyCountName ?>';

// Form_CustomValidate event
forderlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
forderlist.lists["x_user_id"] = <?php echo $order_list->user_id->Lookup->toClientList() ?>;
forderlist.lists["x_user_id"].options = <?php echo JsonEncode($order_list->user_id->lookupOptions()) ?>;

// Form object for search
var forderlistsrch = currentSearchForm = new ew.Form("forderlistsrch");

// Filters
forderlistsrch.filterList = <?php echo $order_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$order->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($order_list->TotalRecs > 0 && $order_list->ExportOptions->visible()) { ?>
<?php $order_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($order_list->ImportOptions->visible()) { ?>
<?php $order_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($order_list->SearchOptions->visible()) { ?>
<?php $order_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($order_list->FilterOptions->visible()) { ?>
<?php $order_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$order->isExport() || EXPORT_MASTER_RECORD && $order->isExport("print")) { ?>
<?php
if ($order_list->DbMasterFilter <> "" && $order->getCurrentMasterTable() == "user") {
	if ($order_list->MasterRecordExists) {
		include_once "usermaster.php";
	}
}
?>
<?php } ?>
<?php
$order_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$order->isExport() && !$order->CurrentAction) { ?>
<form name="forderlistsrch" id="forderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($order_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="forderlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="order">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($order_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($order_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $order_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($order_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($order_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($order_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($order_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $order_list->showPageHeader(); ?>
<?php
$order_list->showMessage();
?>
<?php if ($order_list->TotalRecs > 0 || $order->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($order_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> order">
<?php if (!$order->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$order->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($order_list->Pager)) $order_list->Pager = new NumericPager($order_list->StartRec, $order_list->DisplayRecs, $order_list->TotalRecs, $order_list->RecRange, $order_list->AutoHidePager) ?>
<?php if ($order_list->Pager->RecordCount > 0 && $order_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($order_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($order_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($order_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $order_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($order_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($order_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($order_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $order_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $order_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $order_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($order_list->TotalRecs > 0 && (!$order_list->AutoHidePageSizeSelector || $order_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="order">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($order_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($order_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($order_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($order_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="forderlist" id="forderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($order_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $order_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order">
<?php if ($order->getCurrentMasterTable() == "user" && $order->CurrentAction) { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $order->user_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_order" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($order_list->TotalRecs > 0 || $order->isGridEdit()) { ?>
<table id="tbl_orderlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$order_list->RowType = ROWTYPE_HEADER;

// Render list options
$order_list->renderListOptions();

// Render list options (header, left)
$order_list->ListOptions->render("header", "left");
?>
<?php if ($order->id->Visible) { // id ?>
	<?php if ($order->sortUrl($order->id) == "") { ?>
		<th data-name="id" class="<?php echo $order->id->headerCellClass() ?>"><div id="elh_order_id" class="order_id"><div class="ew-table-header-caption"><?php echo $order->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $order->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->id) ?>',1);"><div id="elh_order_id" class="order_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->user_id->Visible) { // user_id ?>
	<?php if ($order->sortUrl($order->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $order->user_id->headerCellClass() ?>"><div id="elh_order_user_id" class="order_user_id"><div class="ew-table-header-caption"><?php echo $order->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $order->user_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->user_id) ?>',1);"><div id="elh_order_user_id" class="order_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->from_place->Visible) { // from_place ?>
	<?php if ($order->sortUrl($order->from_place) == "") { ?>
		<th data-name="from_place" class="<?php echo $order->from_place->headerCellClass() ?>"><div id="elh_order_from_place" class="order_from_place"><div class="ew-table-header-caption"><?php echo $order->from_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_place" class="<?php echo $order->from_place->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->from_place) ?>',1);"><div id="elh_order_from_place" class="order_from_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->from_place->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order->from_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->from_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->to_place->Visible) { // to_place ?>
	<?php if ($order->sortUrl($order->to_place) == "") { ?>
		<th data-name="to_place" class="<?php echo $order->to_place->headerCellClass() ?>"><div id="elh_order_to_place" class="order_to_place"><div class="ew-table-header-caption"><?php echo $order->to_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_place" class="<?php echo $order->to_place->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->to_place) ?>',1);"><div id="elh_order_to_place" class="order_to_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->to_place->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order->to_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->to_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->date->Visible) { // date ?>
	<?php if ($order->sortUrl($order->date) == "") { ?>
		<th data-name="date" class="<?php echo $order->date->headerCellClass() ?>"><div id="elh_order_date" class="order_date"><div class="ew-table-header-caption"><?php echo $order->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $order->date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->date) ?>',1);"><div id="elh_order_date" class="order_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->flight_number->Visible) { // flight_number ?>
	<?php if ($order->sortUrl($order->flight_number) == "") { ?>
		<th data-name="flight_number" class="<?php echo $order->flight_number->headerCellClass() ?>"><div id="elh_order_flight_number" class="order_flight_number"><div class="ew-table-header-caption"><?php echo $order->flight_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="flight_number" class="<?php echo $order->flight_number->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->flight_number) ?>',1);"><div id="elh_order_flight_number" class="order_flight_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->flight_number->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order->flight_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->flight_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->description->Visible) { // description ?>
	<?php if ($order->sortUrl($order->description) == "") { ?>
		<th data-name="description" class="<?php echo $order->description->headerCellClass() ?>"><div id="elh_order_description" class="order_description"><div class="ew-table-header-caption"><?php echo $order->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $order->description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->description) ?>',1);"><div id="elh_order_description" class="order_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->description->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($order->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->createdAt->Visible) { // createdAt ?>
	<?php if ($order->sortUrl($order->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $order->createdAt->headerCellClass() ?>"><div id="elh_order_createdAt" class="order_createdAt"><div class="ew-table-header-caption"><?php echo $order->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $order->createdAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->createdAt) ?>',1);"><div id="elh_order_createdAt" class="order_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->updatedAt->Visible) { // updatedAt ?>
	<?php if ($order->sortUrl($order->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $order->updatedAt->headerCellClass() ?>"><div id="elh_order_updatedAt" class="order_updatedAt"><div class="ew-table-header-caption"><?php echo $order->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $order->updatedAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $order->SortUrl($order->updatedAt) ?>',1);"><div id="elh_order_updatedAt" class="order_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$order_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($order->ExportAll && $order->isExport()) {
	$order_list->StopRec = $order_list->TotalRecs;
} else {

	// Set the last record to display
	if ($order_list->TotalRecs > $order_list->StartRec + $order_list->DisplayRecs - 1)
		$order_list->StopRec = $order_list->StartRec + $order_list->DisplayRecs - 1;
	else
		$order_list->StopRec = $order_list->TotalRecs;
}
$order_list->RecCnt = $order_list->StartRec - 1;
if ($order_list->Recordset && !$order_list->Recordset->EOF) {
	$order_list->Recordset->moveFirst();
	$selectLimit = $order_list->UseSelectLimit;
	if (!$selectLimit && $order_list->StartRec > 1)
		$order_list->Recordset->move($order_list->StartRec - 1);
} elseif (!$order->AllowAddDeleteRow && $order_list->StopRec == 0) {
	$order_list->StopRec = $order->GridAddRowCount;
}

// Initialize aggregate
$order->RowType = ROWTYPE_AGGREGATEINIT;
$order->resetAttributes();
$order_list->renderRow();
while ($order_list->RecCnt < $order_list->StopRec) {
	$order_list->RecCnt++;
	if ($order_list->RecCnt >= $order_list->StartRec) {
		$order_list->RowCnt++;

		// Set up key count
		$order_list->KeyCount = $order_list->RowIndex;

		// Init row class and style
		$order->resetAttributes();
		$order->CssClass = "";
		if ($order->isGridAdd()) {
		} else {
			$order_list->loadRowValues($order_list->Recordset); // Load row values
		}
		$order->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$order->RowAttrs = array_merge($order->RowAttrs, array('data-rowindex'=>$order_list->RowCnt, 'id'=>'r' . $order_list->RowCnt . '_order', 'data-rowtype'=>$order->RowType));

		// Render row
		$order_list->renderRow();

		// Render list options
		$order_list->renderListOptions();
?>
	<tr<?php echo $order->rowAttributes() ?>>
<?php

// Render list options (body, left)
$order_list->ListOptions->render("body", "left", $order_list->RowCnt);
?>
	<?php if ($order->id->Visible) { // id ?>
		<td data-name="id"<?php echo $order->id->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_id" class="order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<?php echo $order->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $order->user_id->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_user_id" class="order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<?php echo $order->user_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->from_place->Visible) { // from_place ?>
		<td data-name="from_place"<?php echo $order->from_place->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_from_place" class="order_from_place">
<span<?php echo $order->from_place->viewAttributes() ?>>
<?php echo $order->from_place->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->to_place->Visible) { // to_place ?>
		<td data-name="to_place"<?php echo $order->to_place->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_to_place" class="order_to_place">
<span<?php echo $order->to_place->viewAttributes() ?>>
<?php echo $order->to_place->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->date->Visible) { // date ?>
		<td data-name="date"<?php echo $order->date->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_date" class="order_date">
<span<?php echo $order->date->viewAttributes() ?>>
<?php echo $order->date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->flight_number->Visible) { // flight_number ?>
		<td data-name="flight_number"<?php echo $order->flight_number->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_flight_number" class="order_flight_number">
<span<?php echo $order->flight_number->viewAttributes() ?>>
<?php echo $order->flight_number->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->description->Visible) { // description ?>
		<td data-name="description"<?php echo $order->description->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_description" class="order_description">
<span<?php echo $order->description->viewAttributes() ?>>
<?php echo $order->description->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $order->createdAt->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_createdAt" class="order_createdAt">
<span<?php echo $order->createdAt->viewAttributes() ?>>
<?php echo $order->createdAt->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($order->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $order->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $order_list->RowCnt ?>_order_updatedAt" class="order_updatedAt">
<span<?php echo $order->updatedAt->viewAttributes() ?>>
<?php echo $order->updatedAt->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$order_list->ListOptions->render("body", "right", $order_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$order->isGridAdd())
		$order_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if (!$order->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($order_list->Recordset)
	$order_list->Recordset->Close();
?>
<?php if (!$order->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$order->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($order_list->Pager)) $order_list->Pager = new NumericPager($order_list->StartRec, $order_list->DisplayRecs, $order_list->TotalRecs, $order_list->RecRange, $order_list->AutoHidePager) ?>
<?php if ($order_list->Pager->RecordCount > 0 && $order_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($order_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($order_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($order_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $order_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($order_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($order_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_list->pageUrl() ?>start=<?php echo $order_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($order_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $order_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $order_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $order_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($order_list->TotalRecs > 0 && (!$order_list->AutoHidePageSizeSelector || $order_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="order">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($order_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($order_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($order_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($order_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($order_list->TotalRecs == 0 && !$order->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$order_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$order->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$order_list->terminate();
?>
