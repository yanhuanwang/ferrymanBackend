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
$log_view = new log_view();

// Run the page
$log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$log->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var flogview = currentForm = new ew.Form("flogview", "view");

// Form_CustomValidate event
flogview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flogview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$log->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $log_view->ExportOptions->render("body") ?>
<?php
	foreach ($log_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $log_view->showPageHeader(); ?>
<?php
$log_view->showMessage();
?>
<?php if (!$log_view->IsModal) { ?>
<?php if (!$log->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($log_view->Pager)) $log_view->Pager = new NumericPager($log_view->StartRec, $log_view->DisplayRecs, $log_view->TotalRecs, $log_view->RecRange, $log_view->AutoHidePager) ?>
<?php if ($log_view->Pager->RecordCount > 0 && $log_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($log_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($log_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($log_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $log_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($log_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($log_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="flogview" id="flogview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($log_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $log_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log">
<input type="hidden" name="modal" value="<?php echo (int)$log_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($log->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_id"><?php echo $log->id->caption() ?></span></td>
		<td data-name="id"<?php echo $log->id->cellAttributes() ?>>
<span id="el_log_id">
<span<?php echo $log->id->viewAttributes() ?>>
<?php echo $log->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log->ip_addr->Visible) { // ip_addr ?>
	<tr id="r_ip_addr">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_ip_addr"><?php echo $log->ip_addr->caption() ?></span></td>
		<td data-name="ip_addr"<?php echo $log->ip_addr->cellAttributes() ?>>
<span id="el_log_ip_addr">
<span<?php echo $log->ip_addr->viewAttributes() ?>>
<?php echo $log->ip_addr->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log->mobile_phone->Visible) { // mobile_phone ?>
	<tr id="r_mobile_phone">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_mobile_phone"><?php echo $log->mobile_phone->caption() ?></span></td>
		<td data-name="mobile_phone"<?php echo $log->mobile_phone->cellAttributes() ?>>
<span id="el_log_mobile_phone">
<span<?php echo $log->mobile_phone->viewAttributes() ?>>
<?php echo $log->mobile_phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log->event->Visible) { // event ?>
	<tr id="r_event">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_event"><?php echo $log->event->caption() ?></span></td>
		<td data-name="event"<?php echo $log->event->cellAttributes() ?>>
<span id="el_log_event">
<span<?php echo $log->event->viewAttributes() ?>>
<?php echo $log->event->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log->detail->Visible) { // detail ?>
	<tr id="r_detail">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_detail"><?php echo $log->detail->caption() ?></span></td>
		<td data-name="detail"<?php echo $log->detail->cellAttributes() ?>>
<span id="el_log_detail">
<span<?php echo $log->detail->viewAttributes() ?>>
<?php echo $log->detail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_createdAt"><?php echo $log->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $log->createdAt->cellAttributes() ?>>
<span id="el_log_createdAt">
<span<?php echo $log->createdAt->viewAttributes() ?>>
<?php echo $log->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $log_view->TableLeftColumnClass ?>"><span id="elh_log_updatedAt"><?php echo $log->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $log->updatedAt->cellAttributes() ?>>
<span id="el_log_updatedAt">
<span<?php echo $log->updatedAt->viewAttributes() ?>>
<?php echo $log->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$log_view->IsModal) { ?>
<?php if (!$log->isExport()) { ?>
<?php if (!isset($log_view->Pager)) $log_view->Pager = new NumericPager($log_view->StartRec, $log_view->DisplayRecs, $log_view->TotalRecs, $log_view->RecRange, $log_view->AutoHidePager) ?>
<?php if ($log_view->Pager->RecordCount > 0 && $log_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($log_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($log_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($log_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $log_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($log_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($log_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $log_view->pageUrl() ?>start=<?php echo $log_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$log_view->showPageFooter();
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
$log_view->terminate();
?>
