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
$category_view = new category_view();

// Run the page
$category_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$category->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcategoryview = currentForm = new ew.Form("fcategoryview", "view");

// Form_CustomValidate event
fcategoryview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoryview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$category->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $category_view->ExportOptions->render("body") ?>
<?php
	foreach ($category_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $category_view->showPageHeader(); ?>
<?php
$category_view->showMessage();
?>
<?php if (!$category_view->IsModal) { ?>
<?php if (!$category->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($category_view->Pager)) $category_view->Pager = new NumericPager($category_view->StartRec, $category_view->DisplayRecs, $category_view->TotalRecs, $category_view->RecRange, $category_view->AutoHidePager) ?>
<?php if ($category_view->Pager->RecordCount > 0 && $category_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($category_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($category_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($category_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $category_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($category_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($category_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcategoryview" id="fcategoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="modal" value="<?php echo (int)$category_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($category->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_id"><?php echo $category->id->caption() ?></span></td>
		<td data-name="id"<?php echo $category->id->cellAttributes() ?>>
<span id="el_category_id">
<span<?php echo $category->id->viewAttributes() ?>>
<?php echo $category->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_name"><?php echo $category->name->caption() ?></span></td>
		<td data-name="name"<?php echo $category->name->cellAttributes() ?>>
<span id="el_category_name">
<span<?php echo $category->name->viewAttributes() ?>>
<?php echo $category->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $category_view->TableLeftColumnClass ?>"><span id="elh_category_description"><?php echo $category->description->caption() ?></span></td>
		<td data-name="description"<?php echo $category->description->cellAttributes() ?>>
<span id="el_category_description">
<span<?php echo $category->description->viewAttributes() ?>>
<?php echo $category->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$category_view->IsModal) { ?>
<?php if (!$category->isExport()) { ?>
<?php if (!isset($category_view->Pager)) $category_view->Pager = new NumericPager($category_view->StartRec, $category_view->DisplayRecs, $category_view->TotalRecs, $category_view->RecRange, $category_view->AutoHidePager) ?>
<?php if ($category_view->Pager->RecordCount > 0 && $category_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($category_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($category_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($category_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $category_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($category_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($category_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_view->pageUrl() ?>start=<?php echo $category_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php if ($category->getCurrentDetailTable() <> "") { ?>
<?php
	$category_view->DetailPages->ValidKeys = explode(",", $category->getCurrentDetailTable());
	$firstActiveDetailTable = $category_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="category_view_details"><!-- tabs -->
	<ul class="<?php echo $category_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("parcel_info", explode(",", $category->getCurrentDetailTable())) && $parcel_info->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info") {
			$firstActiveDetailTable = "parcel_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $category_view->DetailPages->pageStyle("parcel_info") ?>" href="#tab_parcel_info" data-toggle="tab"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $category_view->parcel_info_Count, $Language->Phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("request_trip", explode(",", $category->getCurrentDetailTable())) && $request_trip->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "request_trip") {
			$firstActiveDetailTable = "request_trip";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $category_view->DetailPages->pageStyle("request_trip") ?>" href="#tab_request_trip" data-toggle="tab"><?php echo $Language->TablePhrase("request_trip", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $category_view->request_trip_Count, $Language->Phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("parcel_info", explode(",", $category->getCurrentDetailTable())) && $parcel_info->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info")
			$firstActiveDetailTable = "parcel_info";
?>
		<div class="tab-pane<?php echo $category_view->DetailPages->pageStyle("parcel_info") ?>" id="tab_parcel_info"><!-- page* -->
<?php include_once "parcel_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("request_trip", explode(",", $category->getCurrentDetailTable())) && $request_trip->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "request_trip")
			$firstActiveDetailTable = "request_trip";
?>
		<div class="tab-pane<?php echo $category_view->DetailPages->pageStyle("request_trip") ?>" id="tab_request_trip"><!-- page* -->
<?php include_once "request_tripgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$category_view->showPageFooter();
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
$category_view->terminate();
?>
