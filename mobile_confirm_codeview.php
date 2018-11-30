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
$mobile_confirm_code_view = new mobile_confirm_code_view();

// Run the page
$mobile_confirm_code_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mobile_confirm_code_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fmobile_confirm_codeview = currentForm = new ew.Form("fmobile_confirm_codeview", "view");

// Form_CustomValidate event
fmobile_confirm_codeview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmobile_confirm_codeview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $mobile_confirm_code_view->ExportOptions->render("body") ?>
<?php
	foreach ($mobile_confirm_code_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $mobile_confirm_code_view->showPageHeader(); ?>
<?php
$mobile_confirm_code_view->showMessage();
?>
<?php if (!$mobile_confirm_code_view->IsModal) { ?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($mobile_confirm_code_view->Pager)) $mobile_confirm_code_view->Pager = new NumericPager($mobile_confirm_code_view->StartRec, $mobile_confirm_code_view->DisplayRecs, $mobile_confirm_code_view->TotalRecs, $mobile_confirm_code_view->RecRange, $mobile_confirm_code_view->AutoHidePager) ?>
<?php if ($mobile_confirm_code_view->Pager->RecordCount > 0 && $mobile_confirm_code_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($mobile_confirm_code_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($mobile_confirm_code_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $mobile_confirm_code_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmobile_confirm_codeview" id="fmobile_confirm_codeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($mobile_confirm_code_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $mobile_confirm_code_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mobile_confirm_code">
<input type="hidden" name="modal" value="<?php echo (int)$mobile_confirm_code_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($mobile_confirm_code->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $mobile_confirm_code_view->TableLeftColumnClass ?>"><span id="elh_mobile_confirm_code_id"><?php echo $mobile_confirm_code->id->caption() ?></span></td>
		<td data-name="id"<?php echo $mobile_confirm_code->id->cellAttributes() ?>>
<span id="el_mobile_confirm_code_id">
<span<?php echo $mobile_confirm_code->id->viewAttributes() ?>>
<?php echo $mobile_confirm_code->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mobile_confirm_code->mobile_phone->Visible) { // mobile_phone ?>
	<tr id="r_mobile_phone">
		<td class="<?php echo $mobile_confirm_code_view->TableLeftColumnClass ?>"><span id="elh_mobile_confirm_code_mobile_phone"><?php echo $mobile_confirm_code->mobile_phone->caption() ?></span></td>
		<td data-name="mobile_phone"<?php echo $mobile_confirm_code->mobile_phone->cellAttributes() ?>>
<span id="el_mobile_confirm_code_mobile_phone">
<span<?php echo $mobile_confirm_code->mobile_phone->viewAttributes() ?>>
<?php echo $mobile_confirm_code->mobile_phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mobile_confirm_code->code->Visible) { // code ?>
	<tr id="r_code">
		<td class="<?php echo $mobile_confirm_code_view->TableLeftColumnClass ?>"><span id="elh_mobile_confirm_code_code"><?php echo $mobile_confirm_code->code->caption() ?></span></td>
		<td data-name="code"<?php echo $mobile_confirm_code->code->cellAttributes() ?>>
<span id="el_mobile_confirm_code_code">
<span<?php echo $mobile_confirm_code->code->viewAttributes() ?>>
<?php echo $mobile_confirm_code->code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mobile_confirm_code->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $mobile_confirm_code_view->TableLeftColumnClass ?>"><span id="elh_mobile_confirm_code_createdAt"><?php echo $mobile_confirm_code->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $mobile_confirm_code->createdAt->cellAttributes() ?>>
<span id="el_mobile_confirm_code_createdAt">
<span<?php echo $mobile_confirm_code->createdAt->viewAttributes() ?>>
<?php echo $mobile_confirm_code->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mobile_confirm_code->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $mobile_confirm_code_view->TableLeftColumnClass ?>"><span id="elh_mobile_confirm_code_updatedAt"><?php echo $mobile_confirm_code->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $mobile_confirm_code->updatedAt->cellAttributes() ?>>
<span id="el_mobile_confirm_code_updatedAt">
<span<?php echo $mobile_confirm_code->updatedAt->viewAttributes() ?>>
<?php echo $mobile_confirm_code->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$mobile_confirm_code_view->IsModal) { ?>
<?php if (!$mobile_confirm_code->isExport()) { ?>
<?php if (!isset($mobile_confirm_code_view->Pager)) $mobile_confirm_code_view->Pager = new NumericPager($mobile_confirm_code_view->StartRec, $mobile_confirm_code_view->DisplayRecs, $mobile_confirm_code_view->TotalRecs, $mobile_confirm_code_view->RecRange, $mobile_confirm_code_view->AutoHidePager) ?>
<?php if ($mobile_confirm_code_view->Pager->RecordCount > 0 && $mobile_confirm_code_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($mobile_confirm_code_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($mobile_confirm_code_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $mobile_confirm_code_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_view->pageUrl() ?>start=<?php echo $mobile_confirm_code_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$mobile_confirm_code_view->showPageFooter();
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
$mobile_confirm_code_view->terminate();
?>
