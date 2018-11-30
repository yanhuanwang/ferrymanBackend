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
$log_list = new log_list();

// Run the page
$log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$log->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var floglist = currentForm = new ew.Form("floglist", "list");
floglist.formKeyCountName = '<?php echo $log_list->FormKeyCountName ?>';

// Form_CustomValidate event
floglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
floglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var floglistsrch = currentSearchForm = new ew.Form("floglistsrch");

// Filters
floglistsrch.filterList = <?php echo $log_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$log->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($log_list->TotalRecs > 0 && $log_list->ExportOptions->visible()) { ?>
<?php $log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($log_list->ImportOptions->visible()) { ?>
<?php $log_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($log_list->SearchOptions->visible()) { ?>
<?php $log_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($log_list->FilterOptions->visible()) { ?>
<?php $log_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$log_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$log->isExport() && !$log->CurrentAction) { ?>
<form name="floglistsrch" id="floglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($log_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="floglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="log">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($log_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($log_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $log_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($log_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($log_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($log_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($log_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $log_list->showPageHeader(); ?>
<?php
$log_list->showMessage();
?>
<?php if ($log_list->TotalRecs > 0 || $log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> log">
<?php if (!$log->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$log->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($log_list->Pager)) $log_list->Pager = new NumericPager($log_list->StartRec, $log_list->DisplayRecs, $log_list->TotalRecs, $log_list->RecRange, $log_list->AutoHidePager) ?>
<?php if ($log_list->Pager->RecordCount > 0 && $log_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($log_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($log_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($log_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $log_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($log_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($log_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($log_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $log_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $log_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $log_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($log_list->TotalRecs > 0 && (!$log_list->AutoHidePageSizeSelector || $log_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="log">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($log_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($log_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($log_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($log_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($log_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="floglist" id="floglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($log_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $log_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log">
<div id="gmp_log" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($log_list->TotalRecs > 0 || $log->isGridEdit()) { ?>
<table id="tbl_loglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$log_list->RowType = ROWTYPE_HEADER;

// Render list options
$log_list->renderListOptions();

// Render list options (header, left)
$log_list->ListOptions->render("header", "left");
?>
<?php if ($log->id->Visible) { // id ?>
	<?php if ($log->sortUrl($log->id) == "") { ?>
		<th data-name="id" class="<?php echo $log->id->headerCellClass() ?>"><div id="elh_log_id" class="log_id"><div class="ew-table-header-caption"><?php echo $log->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $log->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->id) ?>',1);"><div id="elh_log_id" class="log_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($log->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log->ip_addr->Visible) { // ip_addr ?>
	<?php if ($log->sortUrl($log->ip_addr) == "") { ?>
		<th data-name="ip_addr" class="<?php echo $log->ip_addr->headerCellClass() ?>"><div id="elh_log_ip_addr" class="log_ip_addr"><div class="ew-table-header-caption"><?php echo $log->ip_addr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ip_addr" class="<?php echo $log->ip_addr->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->ip_addr) ?>',1);"><div id="elh_log_ip_addr" class="log_ip_addr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->ip_addr->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($log->ip_addr->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->ip_addr->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log->mobile_phone->Visible) { // mobile_phone ?>
	<?php if ($log->sortUrl($log->mobile_phone) == "") { ?>
		<th data-name="mobile_phone" class="<?php echo $log->mobile_phone->headerCellClass() ?>"><div id="elh_log_mobile_phone" class="log_mobile_phone"><div class="ew-table-header-caption"><?php echo $log->mobile_phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile_phone" class="<?php echo $log->mobile_phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->mobile_phone) ?>',1);"><div id="elh_log_mobile_phone" class="log_mobile_phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->mobile_phone->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($log->mobile_phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->mobile_phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log->event->Visible) { // event ?>
	<?php if ($log->sortUrl($log->event) == "") { ?>
		<th data-name="event" class="<?php echo $log->event->headerCellClass() ?>"><div id="elh_log_event" class="log_event"><div class="ew-table-header-caption"><?php echo $log->event->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="event" class="<?php echo $log->event->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->event) ?>',1);"><div id="elh_log_event" class="log_event">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->event->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($log->event->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->event->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log->detail->Visible) { // detail ?>
	<?php if ($log->sortUrl($log->detail) == "") { ?>
		<th data-name="detail" class="<?php echo $log->detail->headerCellClass() ?>"><div id="elh_log_detail" class="log_detail"><div class="ew-table-header-caption"><?php echo $log->detail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="detail" class="<?php echo $log->detail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->detail) ?>',1);"><div id="elh_log_detail" class="log_detail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->detail->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($log->detail->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->detail->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log->createdAt->Visible) { // createdAt ?>
	<?php if ($log->sortUrl($log->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $log->createdAt->headerCellClass() ?>"><div id="elh_log_createdAt" class="log_createdAt"><div class="ew-table-header-caption"><?php echo $log->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $log->createdAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->createdAt) ?>',1);"><div id="elh_log_createdAt" class="log_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($log->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log->updatedAt->Visible) { // updatedAt ?>
	<?php if ($log->sortUrl($log->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $log->updatedAt->headerCellClass() ?>"><div id="elh_log_updatedAt" class="log_updatedAt"><div class="ew-table-header-caption"><?php echo $log->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $log->updatedAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $log->SortUrl($log->updatedAt) ?>',1);"><div id="elh_log_updatedAt" class="log_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($log->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($log->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($log->ExportAll && $log->isExport()) {
	$log_list->StopRec = $log_list->TotalRecs;
} else {

	// Set the last record to display
	if ($log_list->TotalRecs > $log_list->StartRec + $log_list->DisplayRecs - 1)
		$log_list->StopRec = $log_list->StartRec + $log_list->DisplayRecs - 1;
	else
		$log_list->StopRec = $log_list->TotalRecs;
}
$log_list->RecCnt = $log_list->StartRec - 1;
if ($log_list->Recordset && !$log_list->Recordset->EOF) {
	$log_list->Recordset->moveFirst();
	$selectLimit = $log_list->UseSelectLimit;
	if (!$selectLimit && $log_list->StartRec > 1)
		$log_list->Recordset->move($log_list->StartRec - 1);
} elseif (!$log->AllowAddDeleteRow && $log_list->StopRec == 0) {
	$log_list->StopRec = $log->GridAddRowCount;
}

// Initialize aggregate
$log->RowType = ROWTYPE_AGGREGATEINIT;
$log->resetAttributes();
$log_list->renderRow();
while ($log_list->RecCnt < $log_list->StopRec) {
	$log_list->RecCnt++;
	if ($log_list->RecCnt >= $log_list->StartRec) {
		$log_list->RowCnt++;

		// Set up key count
		$log_list->KeyCount = $log_list->RowIndex;

		// Init row class and style
		$log->resetAttributes();
		$log->CssClass = "";
		if ($log->isGridAdd()) {
		} else {
			$log_list->loadRowValues($log_list->Recordset); // Load row values
		}
		$log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$log->RowAttrs = array_merge($log->RowAttrs, array('data-rowindex'=>$log_list->RowCnt, 'id'=>'r' . $log_list->RowCnt . '_log', 'data-rowtype'=>$log->RowType));

		// Render row
		$log_list->renderRow();

		// Render list options
		$log_list->renderListOptions();
?>
	<tr<?php echo $log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$log_list->ListOptions->render("body", "left", $log_list->RowCnt);
?>
	<?php if ($log->id->Visible) { // id ?>
		<td data-name="id"<?php echo $log->id->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_id" class="log_id">
<span<?php echo $log->id->viewAttributes() ?>>
<?php echo $log->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log->ip_addr->Visible) { // ip_addr ?>
		<td data-name="ip_addr"<?php echo $log->ip_addr->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_ip_addr" class="log_ip_addr">
<span<?php echo $log->ip_addr->viewAttributes() ?>>
<?php echo $log->ip_addr->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log->mobile_phone->Visible) { // mobile_phone ?>
		<td data-name="mobile_phone"<?php echo $log->mobile_phone->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_mobile_phone" class="log_mobile_phone">
<span<?php echo $log->mobile_phone->viewAttributes() ?>>
<?php echo $log->mobile_phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log->event->Visible) { // event ?>
		<td data-name="event"<?php echo $log->event->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_event" class="log_event">
<span<?php echo $log->event->viewAttributes() ?>>
<?php echo $log->event->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log->detail->Visible) { // detail ?>
		<td data-name="detail"<?php echo $log->detail->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_detail" class="log_detail">
<span<?php echo $log->detail->viewAttributes() ?>>
<?php echo $log->detail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $log->createdAt->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_createdAt" class="log_createdAt">
<span<?php echo $log->createdAt->viewAttributes() ?>>
<?php echo $log->createdAt->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $log->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $log_list->RowCnt ?>_log_updatedAt" class="log_updatedAt">
<span<?php echo $log->updatedAt->viewAttributes() ?>>
<?php echo $log->updatedAt->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$log_list->ListOptions->render("body", "right", $log_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$log->isGridAdd())
		$log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if (!$log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($log_list->Recordset)
	$log_list->Recordset->Close();
?>
<?php if (!$log->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$log->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($log_list->Pager)) $log_list->Pager = new NumericPager($log_list->StartRec, $log_list->DisplayRecs, $log_list->TotalRecs, $log_list->RecRange, $log_list->AutoHidePager) ?>
<?php if ($log_list->Pager->RecordCount > 0 && $log_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($log_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($log_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($log_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $log_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($log_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($log_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_list->pageUrl() ?>start=<?php echo $log_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($log_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $log_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $log_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $log_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($log_list->TotalRecs > 0 && (!$log_list->AutoHidePageSizeSelector || $log_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="log">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($log_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($log_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($log_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($log_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($log_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($log_list->TotalRecs == 0 && !$log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($log_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$log_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$log->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$log_list->terminate();
?>
