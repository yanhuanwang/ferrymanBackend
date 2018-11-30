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
$request_trip_view = new request_trip_view();

// Run the page
$request_trip_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$request_trip_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$request_trip->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var frequest_tripview = currentForm = new ew.Form("frequest_tripview", "view");

// Form_CustomValidate event
frequest_tripview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frequest_tripview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$request_trip->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $request_trip_view->ExportOptions->render("body") ?>
<?php
	foreach ($request_trip_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $request_trip_view->showPageHeader(); ?>
<?php
$request_trip_view->showMessage();
?>
<?php if (!$request_trip_view->IsModal) { ?>
<?php if (!$request_trip->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($request_trip_view->Pager)) $request_trip_view->Pager = new NumericPager($request_trip_view->StartRec, $request_trip_view->DisplayRecs, $request_trip_view->TotalRecs, $request_trip_view->RecRange, $request_trip_view->AutoHidePager) ?>
<?php if ($request_trip_view->Pager->RecordCount > 0 && $request_trip_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($request_trip_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($request_trip_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $request_trip_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($request_trip_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frequest_tripview" id="frequest_tripview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($request_trip_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $request_trip_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="request_trip">
<input type="hidden" name="modal" value="<?php echo (int)$request_trip_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($request_trip->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_id"><?php echo $request_trip->id->caption() ?></span></td>
		<td data-name="id"<?php echo $request_trip->id->cellAttributes() ?>>
<span id="el_request_trip_id">
<span<?php echo $request_trip->id->viewAttributes() ?>>
<?php echo $request_trip->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->from_place->Visible) { // from_place ?>
	<tr id="r_from_place">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_from_place"><?php echo $request_trip->from_place->caption() ?></span></td>
		<td data-name="from_place"<?php echo $request_trip->from_place->cellAttributes() ?>>
<span id="el_request_trip_from_place">
<span<?php echo $request_trip->from_place->viewAttributes() ?>>
<?php echo $request_trip->from_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
	<tr id="r_to_place">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_to_place"><?php echo $request_trip->to_place->caption() ?></span></td>
		<td data-name="to_place"<?php echo $request_trip->to_place->cellAttributes() ?>>
<span id="el_request_trip_to_place">
<span<?php echo $request_trip->to_place->viewAttributes() ?>>
<?php echo $request_trip->to_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_description"><?php echo $request_trip->description->caption() ?></span></td>
		<td data-name="description"<?php echo $request_trip->description->cellAttributes() ?>>
<span id="el_request_trip_description">
<span<?php echo $request_trip->description->viewAttributes() ?>>
<?php echo $request_trip->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_user_id"><?php echo $request_trip->user_id->caption() ?></span></td>
		<td data-name="user_id"<?php echo $request_trip->user_id->cellAttributes() ?>>
<span id="el_request_trip_user_id">
<span<?php echo $request_trip->user_id->viewAttributes() ?>>
<?php echo $request_trip->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->from_date->Visible) { // from_date ?>
	<tr id="r_from_date">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_from_date"><?php echo $request_trip->from_date->caption() ?></span></td>
		<td data-name="from_date"<?php echo $request_trip->from_date->cellAttributes() ?>>
<span id="el_request_trip_from_date">
<span<?php echo $request_trip->from_date->viewAttributes() ?>>
<?php echo $request_trip->from_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->to_date->Visible) { // to_date ?>
	<tr id="r_to_date">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_to_date"><?php echo $request_trip->to_date->caption() ?></span></td>
		<td data-name="to_date"<?php echo $request_trip->to_date->cellAttributes() ?>>
<span id="el_request_trip_to_date">
<span<?php echo $request_trip->to_date->viewAttributes() ?>>
<?php echo $request_trip->to_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_createdAt"><?php echo $request_trip->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $request_trip->createdAt->cellAttributes() ?>>
<span id="el_request_trip_createdAt">
<span<?php echo $request_trip->createdAt->viewAttributes() ?>>
<?php echo $request_trip->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_updatedAt"><?php echo $request_trip->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $request_trip->updatedAt->cellAttributes() ?>>
<span id="el_request_trip_updatedAt">
<span<?php echo $request_trip->updatedAt->viewAttributes() ?>>
<?php echo $request_trip->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($request_trip->category->Visible) { // category ?>
	<tr id="r_category">
		<td class="<?php echo $request_trip_view->TableLeftColumnClass ?>"><span id="elh_request_trip_category"><?php echo $request_trip->category->caption() ?></span></td>
		<td data-name="category"<?php echo $request_trip->category->cellAttributes() ?>>
<span id="el_request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<?php echo $request_trip->category->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$request_trip_view->IsModal) { ?>
<?php if (!$request_trip->isExport()) { ?>
<?php if (!isset($request_trip_view->Pager)) $request_trip_view->Pager = new NumericPager($request_trip_view->StartRec, $request_trip_view->DisplayRecs, $request_trip_view->TotalRecs, $request_trip_view->RecRange, $request_trip_view->AutoHidePager) ?>
<?php if ($request_trip_view->Pager->RecordCount > 0 && $request_trip_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($request_trip_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($request_trip_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $request_trip_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($request_trip_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($request_trip_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $request_trip_view->pageUrl() ?>start=<?php echo $request_trip_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$request_trip_view->showPageFooter();
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
$request_trip_view->terminate();
?>
