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
$order_view = new order_view();

// Run the page
$order_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$order->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var forderview = currentForm = new ew.Form("forderview", "view");

// Form_CustomValidate event
forderview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
forderview.lists["x_user_id"] = <?php echo $order_view->user_id->Lookup->toClientList() ?>;
forderview.lists["x_user_id"].options = <?php echo JsonEncode($order_view->user_id->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$order->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $order_view->ExportOptions->render("body") ?>
<?php
	foreach ($order_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $order_view->showPageHeader(); ?>
<?php
$order_view->showMessage();
?>
<?php if (!$order_view->IsModal) { ?>
<?php if (!$order->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($order_view->Pager)) $order_view->Pager = new NumericPager($order_view->StartRec, $order_view->DisplayRecs, $order_view->TotalRecs, $order_view->RecRange, $order_view->AutoHidePager) ?>
<?php if ($order_view->Pager->RecordCount > 0 && $order_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($order_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($order_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($order_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $order_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($order_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($order_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="forderview" id="forderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($order_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $order_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order">
<input type="hidden" name="modal" value="<?php echo (int)$order_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($order->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_id"><?php echo $order->id->caption() ?></span></td>
		<td data-name="id"<?php echo $order->id->cellAttributes() ?>>
<span id="el_order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<?php echo $order->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_user_id"><?php echo $order->user_id->caption() ?></span></td>
		<td data-name="user_id"<?php echo $order->user_id->cellAttributes() ?>>
<span id="el_order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<?php echo $order->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->from_place->Visible) { // from_place ?>
	<tr id="r_from_place">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_from_place"><?php echo $order->from_place->caption() ?></span></td>
		<td data-name="from_place"<?php echo $order->from_place->cellAttributes() ?>>
<span id="el_order_from_place">
<span<?php echo $order->from_place->viewAttributes() ?>>
<?php echo $order->from_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->to_place->Visible) { // to_place ?>
	<tr id="r_to_place">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_to_place"><?php echo $order->to_place->caption() ?></span></td>
		<td data-name="to_place"<?php echo $order->to_place->cellAttributes() ?>>
<span id="el_order_to_place">
<span<?php echo $order->to_place->viewAttributes() ?>>
<?php echo $order->to_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_date"><?php echo $order->date->caption() ?></span></td>
		<td data-name="date"<?php echo $order->date->cellAttributes() ?>>
<span id="el_order_date">
<span<?php echo $order->date->viewAttributes() ?>>
<?php echo $order->date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->flight_number->Visible) { // flight_number ?>
	<tr id="r_flight_number">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_flight_number"><?php echo $order->flight_number->caption() ?></span></td>
		<td data-name="flight_number"<?php echo $order->flight_number->cellAttributes() ?>>
<span id="el_order_flight_number">
<span<?php echo $order->flight_number->viewAttributes() ?>>
<?php echo $order->flight_number->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_description"><?php echo $order->description->caption() ?></span></td>
		<td data-name="description"<?php echo $order->description->cellAttributes() ?>>
<span id="el_order_description">
<span<?php echo $order->description->viewAttributes() ?>>
<?php echo $order->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_createdAt"><?php echo $order->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $order->createdAt->cellAttributes() ?>>
<span id="el_order_createdAt">
<span<?php echo $order->createdAt->viewAttributes() ?>>
<?php echo $order->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($order->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $order_view->TableLeftColumnClass ?>"><span id="elh_order_updatedAt"><?php echo $order->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $order->updatedAt->cellAttributes() ?>>
<span id="el_order_updatedAt">
<span<?php echo $order->updatedAt->viewAttributes() ?>>
<?php echo $order->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$order_view->IsModal) { ?>
<?php if (!$order->isExport()) { ?>
<?php if (!isset($order_view->Pager)) $order_view->Pager = new NumericPager($order_view->StartRec, $order_view->DisplayRecs, $order_view->TotalRecs, $order_view->RecRange, $order_view->AutoHidePager) ?>
<?php if ($order_view->Pager->RecordCount > 0 && $order_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($order_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($order_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($order_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $order_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($order_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($order_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_view->pageUrl() ?>start=<?php echo $order_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$order_view->showPageFooter();
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
$order_view->terminate();
?>
