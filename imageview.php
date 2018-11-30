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
$image_view = new image_view();

// Run the page
$image_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$image->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fimageview = currentForm = new ew.Form("fimageview", "view");

// Form_CustomValidate event
fimageview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimageview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$image->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $image_view->ExportOptions->render("body") ?>
<?php
	foreach ($image_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $image_view->showPageHeader(); ?>
<?php
$image_view->showMessage();
?>
<?php if (!$image_view->IsModal) { ?>
<?php if (!$image->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($image_view->Pager)) $image_view->Pager = new NumericPager($image_view->StartRec, $image_view->DisplayRecs, $image_view->TotalRecs, $image_view->RecRange, $image_view->AutoHidePager) ?>
<?php if ($image_view->Pager->RecordCount > 0 && $image_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($image_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($image_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($image_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $image_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($image_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($image_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fimageview" id="fimageview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($image_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $image_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="image">
<input type="hidden" name="modal" value="<?php echo (int)$image_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($image->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_id"><?php echo $image->id->caption() ?></span></td>
		<td data-name="id"<?php echo $image->id->cellAttributes() ?>>
<span id="el_image_id">
<span<?php echo $image->id->viewAttributes() ?>>
<?php echo $image->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->path->Visible) { // path ?>
	<tr id="r_path">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_path"><?php echo $image->path->caption() ?></span></td>
		<td data-name="path"<?php echo $image->path->cellAttributes() ?>>
<span id="el_image_path">
<span>
<?php echo GetFileViewTag($image->path, $image->path->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_description"><?php echo $image->description->caption() ?></span></td>
		<td data-name="description"<?php echo $image->description->cellAttributes() ?>>
<span id="el_image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<?php echo $image->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->uuid->Visible) { // uuid ?>
	<tr id="r_uuid">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_uuid"><?php echo $image->uuid->caption() ?></span></td>
		<td data-name="uuid"<?php echo $image->uuid->cellAttributes() ?>>
<span id="el_image_uuid">
<span<?php echo $image->uuid->viewAttributes() ?>>
<?php echo $image->uuid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_user_id"><?php echo $image->user_id->caption() ?></span></td>
		<td data-name="user_id"<?php echo $image->user_id->cellAttributes() ?>>
<span id="el_image_user_id">
<span<?php echo $image->user_id->viewAttributes() ?>>
<?php echo $image->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
	<tr id="r_confirmed">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_confirmed"><?php echo $image->confirmed->caption() ?></span></td>
		<td data-name="confirmed"<?php echo $image->confirmed->cellAttributes() ?>>
<span id="el_image_confirmed">
<span<?php echo $image->confirmed->viewAttributes() ?>>
<?php echo $image->confirmed->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_createdAt"><?php echo $image->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $image->createdAt->cellAttributes() ?>>
<span id="el_image_createdAt">
<span<?php echo $image->createdAt->viewAttributes() ?>>
<?php echo $image->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $image_view->TableLeftColumnClass ?>"><span id="elh_image_updatedAt"><?php echo $image->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $image->updatedAt->cellAttributes() ?>>
<span id="el_image_updatedAt">
<span<?php echo $image->updatedAt->viewAttributes() ?>>
<?php echo $image->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$image_view->IsModal) { ?>
<?php if (!$image->isExport()) { ?>
<?php if (!isset($image_view->Pager)) $image_view->Pager = new NumericPager($image_view->StartRec, $image_view->DisplayRecs, $image_view->TotalRecs, $image_view->RecRange, $image_view->AutoHidePager) ?>
<?php if ($image_view->Pager->RecordCount > 0 && $image_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($image_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($image_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($image_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $image_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($image_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($image_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_view->pageUrl() ?>start=<?php echo $image_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("parcel_info", explode(",", $image->getCurrentDetailTable())) && $parcel_info->DetailView) {
?>
<?php if ($image->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $image_view->parcel_info_Count, $Language->Phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "parcel_infogrid.php" ?>
<?php } ?>
</form>
<?php
$image_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$image->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$image_view->terminate();
?>
