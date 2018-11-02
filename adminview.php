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
$admin_view = new admin_view();

// Run the page
$admin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$admin->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fadminview = currentForm = new ew.Form("fadminview", "view");

// Form_CustomValidate event
fadminview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fadminview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$admin->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $admin_view->ExportOptions->render("body") ?>
<?php
	foreach ($admin_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $admin_view->showPageHeader(); ?>
<?php
$admin_view->showMessage();
?>
<?php if (!$admin_view->IsModal) { ?>
<?php if (!$admin->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($admin_view->Pager)) $admin_view->Pager = new NumericPager($admin_view->StartRec, $admin_view->DisplayRecs, $admin_view->TotalRecs, $admin_view->RecRange, $admin_view->AutoHidePager) ?>
<?php if ($admin_view->Pager->RecordCount > 0 && $admin_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($admin_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($admin_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($admin_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $admin_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($admin_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($admin_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fadminview" id="fadminview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($admin_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $admin_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="modal" value="<?php echo (int)$admin_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($admin->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_id"><?php echo $admin->id->caption() ?></span></td>
		<td data-name="id"<?php echo $admin->id->cellAttributes() ?>>
<span id="el_admin_id">
<span<?php echo $admin->id->viewAttributes() ?>>
<?php echo $admin->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_username"><?php echo $admin->username->caption() ?></span></td>
		<td data-name="username"<?php echo $admin->username->cellAttributes() ?>>
<span id="el_admin_username">
<span<?php echo $admin->username->viewAttributes() ?>>
<?php echo $admin->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_password"><?php echo $admin->password->caption() ?></span></td>
		<td data-name="password"<?php echo $admin->password->cellAttributes() ?>>
<span id="el_admin_password">
<span<?php echo $admin->password->viewAttributes() ?>>
<?php echo $admin->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin->level->Visible) { // level ?>
	<tr id="r_level">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_level"><?php echo $admin->level->caption() ?></span></td>
		<td data-name="level"<?php echo $admin->level->cellAttributes() ?>>
<span id="el_admin_level">
<span<?php echo $admin->level->viewAttributes() ?>>
<?php echo $admin->level->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin->locked->Visible) { // locked ?>
	<tr id="r_locked">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_locked"><?php echo $admin->locked->caption() ?></span></td>
		<td data-name="locked"<?php echo $admin->locked->cellAttributes() ?>>
<span id="el_admin_locked">
<span<?php echo $admin->locked->viewAttributes() ?>>
<?php echo $admin->locked->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin__email"><?php echo $admin->_email->caption() ?></span></td>
		<td data-name="_email"<?php echo $admin->_email->cellAttributes() ?>>
<span id="el_admin__email">
<span<?php echo $admin->_email->viewAttributes() ?>>
<?php echo $admin->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($admin->activated->Visible) { // activated ?>
	<tr id="r_activated">
		<td class="<?php echo $admin_view->TableLeftColumnClass ?>"><span id="elh_admin_activated"><?php echo $admin->activated->caption() ?></span></td>
		<td data-name="activated"<?php echo $admin->activated->cellAttributes() ?>>
<span id="el_admin_activated">
<span<?php echo $admin->activated->viewAttributes() ?>>
<?php echo $admin->activated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$admin_view->IsModal) { ?>
<?php if (!$admin->isExport()) { ?>
<?php if (!isset($admin_view->Pager)) $admin_view->Pager = new NumericPager($admin_view->StartRec, $admin_view->DisplayRecs, $admin_view->TotalRecs, $admin_view->RecRange, $admin_view->AutoHidePager) ?>
<?php if ($admin_view->Pager->RecordCount > 0 && $admin_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($admin_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($admin_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($admin_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $admin_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($admin_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($admin_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $admin_view->pageUrl() ?>start=<?php echo $admin_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$admin_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$admin->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$admin_view->terminate();
?>
