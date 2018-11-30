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
$mobile_confirm_code_list = new mobile_confirm_code_list();

// Run the page
$mobile_confirm_code_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mobile_confirm_code_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fmobile_confirm_codelist = currentForm = new ew.Form("fmobile_confirm_codelist", "list");
fmobile_confirm_codelist.formKeyCountName = '<?php echo $mobile_confirm_code_list->FormKeyCountName ?>';

// Form_CustomValidate event
fmobile_confirm_codelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmobile_confirm_codelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fmobile_confirm_codelistsrch = currentSearchForm = new ew.Form("fmobile_confirm_codelistsrch");

// Filters
fmobile_confirm_codelistsrch.filterList = <?php echo $mobile_confirm_code_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mobile_confirm_code_list->TotalRecs > 0 && $mobile_confirm_code_list->ExportOptions->visible()) { ?>
<?php $mobile_confirm_code_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mobile_confirm_code_list->ImportOptions->visible()) { ?>
<?php $mobile_confirm_code_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mobile_confirm_code_list->SearchOptions->visible()) { ?>
<?php $mobile_confirm_code_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mobile_confirm_code_list->FilterOptions->visible()) { ?>
<?php $mobile_confirm_code_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mobile_confirm_code_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mobile_confirm_code->isExport() && !$mobile_confirm_code->CurrentAction) { ?>
<form name="fmobile_confirm_codelistsrch" id="fmobile_confirm_codelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($mobile_confirm_code_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fmobile_confirm_codelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mobile_confirm_code">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($mobile_confirm_code_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($mobile_confirm_code_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mobile_confirm_code_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mobile_confirm_code_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mobile_confirm_code_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mobile_confirm_code_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mobile_confirm_code_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $mobile_confirm_code_list->showPageHeader(); ?>
<?php
$mobile_confirm_code_list->showMessage();
?>
<?php if ($mobile_confirm_code_list->TotalRecs > 0 || $mobile_confirm_code->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mobile_confirm_code_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mobile_confirm_code">
<?php if (!$mobile_confirm_code->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$mobile_confirm_code->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($mobile_confirm_code_list->Pager)) $mobile_confirm_code_list->Pager = new NumericPager($mobile_confirm_code_list->StartRec, $mobile_confirm_code_list->DisplayRecs, $mobile_confirm_code_list->TotalRecs, $mobile_confirm_code_list->RecRange, $mobile_confirm_code_list->AutoHidePager) ?>
<?php if ($mobile_confirm_code_list->Pager->RecordCount > 0 && $mobile_confirm_code_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($mobile_confirm_code_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($mobile_confirm_code_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $mobile_confirm_code_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($mobile_confirm_code_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $mobile_confirm_code_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $mobile_confirm_code_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $mobile_confirm_code_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($mobile_confirm_code_list->TotalRecs > 0 && (!$mobile_confirm_code_list->AutoHidePageSizeSelector || $mobile_confirm_code_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="mobile_confirm_code">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($mobile_confirm_code_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($mobile_confirm_code_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($mobile_confirm_code_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($mobile_confirm_code_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($mobile_confirm_code_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmobile_confirm_codelist" id="fmobile_confirm_codelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($mobile_confirm_code_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $mobile_confirm_code_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mobile_confirm_code">
<div id="gmp_mobile_confirm_code" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($mobile_confirm_code_list->TotalRecs > 0 || $mobile_confirm_code->isGridEdit()) { ?>
<table id="tbl_mobile_confirm_codelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mobile_confirm_code_list->RowType = ROWTYPE_HEADER;

// Render list options
$mobile_confirm_code_list->renderListOptions();

// Render list options (header, left)
$mobile_confirm_code_list->ListOptions->render("header", "left");
?>
<?php if ($mobile_confirm_code->id->Visible) { // id ?>
	<?php if ($mobile_confirm_code->sortUrl($mobile_confirm_code->id) == "") { ?>
		<th data-name="id" class="<?php echo $mobile_confirm_code->id->headerCellClass() ?>"><div id="elh_mobile_confirm_code_id" class="mobile_confirm_code_id"><div class="ew-table-header-caption"><?php echo $mobile_confirm_code->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $mobile_confirm_code->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mobile_confirm_code->SortUrl($mobile_confirm_code->id) ?>',1);"><div id="elh_mobile_confirm_code_id" class="mobile_confirm_code_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mobile_confirm_code->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($mobile_confirm_code->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mobile_confirm_code->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mobile_confirm_code->mobile_phone->Visible) { // mobile_phone ?>
	<?php if ($mobile_confirm_code->sortUrl($mobile_confirm_code->mobile_phone) == "") { ?>
		<th data-name="mobile_phone" class="<?php echo $mobile_confirm_code->mobile_phone->headerCellClass() ?>"><div id="elh_mobile_confirm_code_mobile_phone" class="mobile_confirm_code_mobile_phone"><div class="ew-table-header-caption"><?php echo $mobile_confirm_code->mobile_phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile_phone" class="<?php echo $mobile_confirm_code->mobile_phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mobile_confirm_code->SortUrl($mobile_confirm_code->mobile_phone) ?>',1);"><div id="elh_mobile_confirm_code_mobile_phone" class="mobile_confirm_code_mobile_phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mobile_confirm_code->mobile_phone->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mobile_confirm_code->mobile_phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mobile_confirm_code->mobile_phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mobile_confirm_code->code->Visible) { // code ?>
	<?php if ($mobile_confirm_code->sortUrl($mobile_confirm_code->code) == "") { ?>
		<th data-name="code" class="<?php echo $mobile_confirm_code->code->headerCellClass() ?>"><div id="elh_mobile_confirm_code_code" class="mobile_confirm_code_code"><div class="ew-table-header-caption"><?php echo $mobile_confirm_code->code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="code" class="<?php echo $mobile_confirm_code->code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mobile_confirm_code->SortUrl($mobile_confirm_code->code) ?>',1);"><div id="elh_mobile_confirm_code_code" class="mobile_confirm_code_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mobile_confirm_code->code->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mobile_confirm_code->code->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mobile_confirm_code->code->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mobile_confirm_code->createdAt->Visible) { // createdAt ?>
	<?php if ($mobile_confirm_code->sortUrl($mobile_confirm_code->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $mobile_confirm_code->createdAt->headerCellClass() ?>"><div id="elh_mobile_confirm_code_createdAt" class="mobile_confirm_code_createdAt"><div class="ew-table-header-caption"><?php echo $mobile_confirm_code->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $mobile_confirm_code->createdAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mobile_confirm_code->SortUrl($mobile_confirm_code->createdAt) ?>',1);"><div id="elh_mobile_confirm_code_createdAt" class="mobile_confirm_code_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mobile_confirm_code->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($mobile_confirm_code->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mobile_confirm_code->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mobile_confirm_code->updatedAt->Visible) { // updatedAt ?>
	<?php if ($mobile_confirm_code->sortUrl($mobile_confirm_code->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $mobile_confirm_code->updatedAt->headerCellClass() ?>"><div id="elh_mobile_confirm_code_updatedAt" class="mobile_confirm_code_updatedAt"><div class="ew-table-header-caption"><?php echo $mobile_confirm_code->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $mobile_confirm_code->updatedAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $mobile_confirm_code->SortUrl($mobile_confirm_code->updatedAt) ?>',1);"><div id="elh_mobile_confirm_code_updatedAt" class="mobile_confirm_code_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mobile_confirm_code->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($mobile_confirm_code->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($mobile_confirm_code->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mobile_confirm_code_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mobile_confirm_code->ExportAll && $mobile_confirm_code->isExport()) {
	$mobile_confirm_code_list->StopRec = $mobile_confirm_code_list->TotalRecs;
} else {

	// Set the last record to display
	if ($mobile_confirm_code_list->TotalRecs > $mobile_confirm_code_list->StartRec + $mobile_confirm_code_list->DisplayRecs - 1)
		$mobile_confirm_code_list->StopRec = $mobile_confirm_code_list->StartRec + $mobile_confirm_code_list->DisplayRecs - 1;
	else
		$mobile_confirm_code_list->StopRec = $mobile_confirm_code_list->TotalRecs;
}
$mobile_confirm_code_list->RecCnt = $mobile_confirm_code_list->StartRec - 1;
if ($mobile_confirm_code_list->Recordset && !$mobile_confirm_code_list->Recordset->EOF) {
	$mobile_confirm_code_list->Recordset->moveFirst();
	$selectLimit = $mobile_confirm_code_list->UseSelectLimit;
	if (!$selectLimit && $mobile_confirm_code_list->StartRec > 1)
		$mobile_confirm_code_list->Recordset->move($mobile_confirm_code_list->StartRec - 1);
} elseif (!$mobile_confirm_code->AllowAddDeleteRow && $mobile_confirm_code_list->StopRec == 0) {
	$mobile_confirm_code_list->StopRec = $mobile_confirm_code->GridAddRowCount;
}

// Initialize aggregate
$mobile_confirm_code->RowType = ROWTYPE_AGGREGATEINIT;
$mobile_confirm_code->resetAttributes();
$mobile_confirm_code_list->renderRow();
while ($mobile_confirm_code_list->RecCnt < $mobile_confirm_code_list->StopRec) {
	$mobile_confirm_code_list->RecCnt++;
	if ($mobile_confirm_code_list->RecCnt >= $mobile_confirm_code_list->StartRec) {
		$mobile_confirm_code_list->RowCnt++;

		// Set up key count
		$mobile_confirm_code_list->KeyCount = $mobile_confirm_code_list->RowIndex;

		// Init row class and style
		$mobile_confirm_code->resetAttributes();
		$mobile_confirm_code->CssClass = "";
		if ($mobile_confirm_code->isGridAdd()) {
		} else {
			$mobile_confirm_code_list->loadRowValues($mobile_confirm_code_list->Recordset); // Load row values
		}
		$mobile_confirm_code->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mobile_confirm_code->RowAttrs = array_merge($mobile_confirm_code->RowAttrs, array('data-rowindex'=>$mobile_confirm_code_list->RowCnt, 'id'=>'r' . $mobile_confirm_code_list->RowCnt . '_mobile_confirm_code', 'data-rowtype'=>$mobile_confirm_code->RowType));

		// Render row
		$mobile_confirm_code_list->renderRow();

		// Render list options
		$mobile_confirm_code_list->renderListOptions();
?>
	<tr<?php echo $mobile_confirm_code->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mobile_confirm_code_list->ListOptions->render("body", "left", $mobile_confirm_code_list->RowCnt);
?>
	<?php if ($mobile_confirm_code->id->Visible) { // id ?>
		<td data-name="id"<?php echo $mobile_confirm_code->id->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_list->RowCnt ?>_mobile_confirm_code_id" class="mobile_confirm_code_id">
<span<?php echo $mobile_confirm_code->id->viewAttributes() ?>>
<?php echo $mobile_confirm_code->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mobile_confirm_code->mobile_phone->Visible) { // mobile_phone ?>
		<td data-name="mobile_phone"<?php echo $mobile_confirm_code->mobile_phone->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_list->RowCnt ?>_mobile_confirm_code_mobile_phone" class="mobile_confirm_code_mobile_phone">
<span<?php echo $mobile_confirm_code->mobile_phone->viewAttributes() ?>>
<?php echo $mobile_confirm_code->mobile_phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mobile_confirm_code->code->Visible) { // code ?>
		<td data-name="code"<?php echo $mobile_confirm_code->code->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_list->RowCnt ?>_mobile_confirm_code_code" class="mobile_confirm_code_code">
<span<?php echo $mobile_confirm_code->code->viewAttributes() ?>>
<?php echo $mobile_confirm_code->code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mobile_confirm_code->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $mobile_confirm_code->createdAt->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_list->RowCnt ?>_mobile_confirm_code_createdAt" class="mobile_confirm_code_createdAt">
<span<?php echo $mobile_confirm_code->createdAt->viewAttributes() ?>>
<?php echo $mobile_confirm_code->createdAt->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mobile_confirm_code->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $mobile_confirm_code->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_list->RowCnt ?>_mobile_confirm_code_updatedAt" class="mobile_confirm_code_updatedAt">
<span<?php echo $mobile_confirm_code->updatedAt->viewAttributes() ?>>
<?php echo $mobile_confirm_code->updatedAt->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mobile_confirm_code_list->ListOptions->render("body", "right", $mobile_confirm_code_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$mobile_confirm_code->isGridAdd())
		$mobile_confirm_code_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if (!$mobile_confirm_code->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mobile_confirm_code_list->Recordset)
	$mobile_confirm_code_list->Recordset->Close();
?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mobile_confirm_code->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($mobile_confirm_code_list->Pager)) $mobile_confirm_code_list->Pager = new NumericPager($mobile_confirm_code_list->StartRec, $mobile_confirm_code_list->DisplayRecs, $mobile_confirm_code_list->TotalRecs, $mobile_confirm_code_list->RecRange, $mobile_confirm_code_list->AutoHidePager) ?>
<?php if ($mobile_confirm_code_list->Pager->RecordCount > 0 && $mobile_confirm_code_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($mobile_confirm_code_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($mobile_confirm_code_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $mobile_confirm_code_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_list->pageUrl() ?>start=<?php echo $mobile_confirm_code_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($mobile_confirm_code_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $mobile_confirm_code_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $mobile_confirm_code_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $mobile_confirm_code_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($mobile_confirm_code_list->TotalRecs > 0 && (!$mobile_confirm_code_list->AutoHidePageSizeSelector || $mobile_confirm_code_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="mobile_confirm_code">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($mobile_confirm_code_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($mobile_confirm_code_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($mobile_confirm_code_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($mobile_confirm_code_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($mobile_confirm_code_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mobile_confirm_code_list->TotalRecs == 0 && !$mobile_confirm_code->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($mobile_confirm_code_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mobile_confirm_code_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$mobile_confirm_code_list->terminate();
?>
