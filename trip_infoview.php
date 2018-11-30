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
$trip_info_view = new trip_info_view();

// Run the page
$trip_info_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trip_info_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$trip_info->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftrip_infoview = currentForm = new ew.Form("ftrip_infoview", "view");

// Form_CustomValidate event
ftrip_infoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrip_infoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrip_infoview.lists["x_user_id"] = <?php echo $trip_info_view->user_id->Lookup->toClientList() ?>;
ftrip_infoview.lists["x_user_id"].options = <?php echo JsonEncode($trip_info_view->user_id->lookupOptions()) ?>;
ftrip_infoview.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$trip_info->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $trip_info_view->ExportOptions->render("body") ?>
<?php
	foreach ($trip_info_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $trip_info_view->showPageHeader(); ?>
<?php
$trip_info_view->showMessage();
?>
<?php if (!$trip_info_view->IsModal) { ?>
<?php if (!$trip_info->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($trip_info_view->Pager)) $trip_info_view->Pager = new NumericPager($trip_info_view->StartRec, $trip_info_view->DisplayRecs, $trip_info_view->TotalRecs, $trip_info_view->RecRange, $trip_info_view->AutoHidePager) ?>
<?php if ($trip_info_view->Pager->RecordCount > 0 && $trip_info_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($trip_info_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($trip_info_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($trip_info_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $trip_info_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($trip_info_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($trip_info_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftrip_infoview" id="ftrip_infoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trip_info_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trip_info_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trip_info">
<input type="hidden" name="modal" value="<?php echo (int)$trip_info_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($trip_info->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_id"><?php echo $trip_info->id->caption() ?></span></td>
		<td data-name="id"<?php echo $trip_info->id->cellAttributes() ?>>
<span id="el_trip_info_id">
<span<?php echo $trip_info->id->viewAttributes() ?>>
<?php echo $trip_info->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->from_place->Visible) { // from_place ?>
	<tr id="r_from_place">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_from_place"><?php echo $trip_info->from_place->caption() ?></span></td>
		<td data-name="from_place"<?php echo $trip_info->from_place->cellAttributes() ?>>
<span id="el_trip_info_from_place">
<span<?php echo $trip_info->from_place->viewAttributes() ?>>
<?php echo $trip_info->from_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->to_place->Visible) { // to_place ?>
	<tr id="r_to_place">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_to_place"><?php echo $trip_info->to_place->caption() ?></span></td>
		<td data-name="to_place"<?php echo $trip_info->to_place->cellAttributes() ?>>
<span id="el_trip_info_to_place">
<span<?php echo $trip_info->to_place->viewAttributes() ?>>
<?php echo $trip_info->to_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_description"><?php echo $trip_info->description->caption() ?></span></td>
		<td data-name="description"<?php echo $trip_info->description->cellAttributes() ?>>
<span id="el_trip_info_description">
<span<?php echo $trip_info->description->viewAttributes() ?>>
<?php echo $trip_info->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_user_id"><?php echo $trip_info->user_id->caption() ?></span></td>
		<td data-name="user_id"<?php echo $trip_info->user_id->cellAttributes() ?>>
<span id="el_trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<?php echo $trip_info->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
	<tr id="r_flight_number">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_flight_number"><?php echo $trip_info->flight_number->caption() ?></span></td>
		<td data-name="flight_number"<?php echo $trip_info->flight_number->cellAttributes() ?>>
<span id="el_trip_info_flight_number">
<span<?php echo $trip_info->flight_number->viewAttributes() ?>>
<?php echo $trip_info->flight_number->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_date"><?php echo $trip_info->date->caption() ?></span></td>
		<td data-name="date"<?php echo $trip_info->date->cellAttributes() ?>>
<span id="el_trip_info_date">
<span<?php echo $trip_info->date->viewAttributes() ?>>
<?php echo $trip_info->date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_createdAt"><?php echo $trip_info->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $trip_info->createdAt->cellAttributes() ?>>
<span id="el_trip_info_createdAt">
<span<?php echo $trip_info->createdAt->viewAttributes() ?>>
<?php echo $trip_info->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $trip_info_view->TableLeftColumnClass ?>"><span id="elh_trip_info_updatedAt"><?php echo $trip_info->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $trip_info->updatedAt->cellAttributes() ?>>
<span id="el_trip_info_updatedAt">
<span<?php echo $trip_info->updatedAt->viewAttributes() ?>>
<?php echo $trip_info->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$trip_info_view->IsModal) { ?>
<?php if (!$trip_info->isExport()) { ?>
<?php if (!isset($trip_info_view->Pager)) $trip_info_view->Pager = new NumericPager($trip_info_view->StartRec, $trip_info_view->DisplayRecs, $trip_info_view->TotalRecs, $trip_info_view->RecRange, $trip_info_view->AutoHidePager) ?>
<?php if ($trip_info_view->Pager->RecordCount > 0 && $trip_info_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($trip_info_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($trip_info_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($trip_info_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $trip_info_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($trip_info_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($trip_info_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $trip_info_view->pageUrl() ?>start=<?php echo $trip_info_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$trip_info_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$trip_info->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$trip_info_view->terminate();
?>
