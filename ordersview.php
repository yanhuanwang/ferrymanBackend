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
$orders_view = new orders_view();

// Run the page
$orders_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$orders->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fordersview = currentForm = new ew.Form("fordersview", "view");

// Form_CustomValidate event
fordersview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fordersview.lists["x__userid"] = <?php echo $orders_view->_userid->Lookup->toClientList() ?>;
fordersview.lists["x__userid"].options = <?php echo JsonEncode($orders_view->_userid->lookupOptions()) ?>;
fordersview.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersview.lists["x_parcel_id"] = <?php echo $orders_view->parcel_id->Lookup->toClientList() ?>;
fordersview.lists["x_parcel_id"].options = <?php echo JsonEncode($orders_view->parcel_id->lookupOptions()) ?>;
fordersview.autoSuggests["x_parcel_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersview.lists["x_carrier_id"] = <?php echo $orders_view->carrier_id->Lookup->toClientList() ?>;
fordersview.lists["x_carrier_id"].options = <?php echo JsonEncode($orders_view->carrier_id->lookupOptions()) ?>;
fordersview.autoSuggests["x_carrier_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersview.lists["x_status"] = <?php echo $orders_view->status->Lookup->toClientList() ?>;
fordersview.lists["x_status"].options = <?php echo JsonEncode($orders_view->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$orders->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $orders_view->ExportOptions->render("body") ?>
<?php
	foreach ($orders_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $orders_view->showPageHeader(); ?>
<?php
$orders_view->showMessage();
?>
<?php if (!$orders_view->IsModal) { ?>
<?php if (!$orders->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_view->Pager)) $orders_view->Pager = new NumericPager($orders_view->StartRec, $orders_view->DisplayRecs, $orders_view->TotalRecs, $orders_view->RecRange, $orders_view->AutoHidePager) ?>
<?php if ($orders_view->Pager->RecordCount > 0 && $orders_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($orders_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($orders_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($orders_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $orders_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($orders_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($orders_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fordersview" id="fordersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="modal" value="<?php echo (int)$orders_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($orders->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_id"><?php echo $orders->id->caption() ?></span></td>
		<td data-name="id"<?php echo $orders->id->cellAttributes() ?>>
<span id="el_orders_id">
<span<?php echo $orders->id->viewAttributes() ?>>
<?php echo $orders->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->_userid->Visible) { // userid ?>
	<tr id="r__userid">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders__userid"><?php echo $orders->_userid->caption() ?></span></td>
		<td data-name="_userid"<?php echo $orders->_userid->cellAttributes() ?>>
<span id="el_orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<?php echo $orders->_userid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
	<tr id="r_parcel_id">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_parcel_id"><?php echo $orders->parcel_id->caption() ?></span></td>
		<td data-name="parcel_id"<?php echo $orders->parcel_id->cellAttributes() ?>>
<span id="el_orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<?php echo $orders->parcel_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
	<tr id="r_carrier_id">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_carrier_id"><?php echo $orders->carrier_id->caption() ?></span></td>
		<td data-name="carrier_id"<?php echo $orders->carrier_id->cellAttributes() ?>>
<span id="el_orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<?php echo $orders->carrier_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_description"><?php echo $orders->description->caption() ?></span></td>
		<td data-name="description"<?php echo $orders->description->cellAttributes() ?>>
<span id="el_orders_description">
<span<?php echo $orders->description->viewAttributes() ?>>
<?php echo $orders->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $orders_view->TableLeftColumnClass ?>"><span id="elh_orders_status"><?php echo $orders->status->caption() ?></span></td>
		<td data-name="status"<?php echo $orders->status->cellAttributes() ?>>
<span id="el_orders_status">
<span<?php echo $orders->status->viewAttributes() ?>>
<?php echo $orders->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$orders_view->IsModal) { ?>
<?php if (!$orders->isExport()) { ?>
<?php if (!isset($orders_view->Pager)) $orders_view->Pager = new NumericPager($orders_view->StartRec, $orders_view->DisplayRecs, $orders_view->TotalRecs, $orders_view->RecRange, $orders_view->AutoHidePager) ?>
<?php if ($orders_view->Pager->RecordCount > 0 && $orders_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($orders_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($orders_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($orders_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $orders_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($orders_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($orders_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_view->pageUrl() ?>start=<?php echo $orders_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$orders_view->showPageFooter();
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
$orders_view->terminate();
?>
