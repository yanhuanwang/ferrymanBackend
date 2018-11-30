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
$parcel_info_view = new parcel_info_view();

// Run the page
$parcel_info_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parcel_info_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$parcel_info->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fparcel_infoview = currentForm = new ew.Form("fparcel_infoview", "view");

// Form_CustomValidate event
fparcel_infoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparcel_infoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fparcel_infoview.lists["x_user_id"] = <?php echo $parcel_info_view->user_id->Lookup->toClientList() ?>;
fparcel_infoview.lists["x_user_id"].options = <?php echo JsonEncode($parcel_info_view->user_id->lookupOptions()) ?>;
fparcel_infoview.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fparcel_infoview.lists["x_image_id"] = <?php echo $parcel_info_view->image_id->Lookup->toClientList() ?>;
fparcel_infoview.lists["x_image_id"].options = <?php echo JsonEncode($parcel_info_view->image_id->lookupOptions()) ?>;
fparcel_infoview.autoSuggests["x_image_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$parcel_info->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $parcel_info_view->ExportOptions->render("body") ?>
<?php
	foreach ($parcel_info_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $parcel_info_view->showPageHeader(); ?>
<?php
$parcel_info_view->showMessage();
?>
<?php if (!$parcel_info_view->IsModal) { ?>
<?php if (!$parcel_info->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($parcel_info_view->Pager)) $parcel_info_view->Pager = new NumericPager($parcel_info_view->StartRec, $parcel_info_view->DisplayRecs, $parcel_info_view->TotalRecs, $parcel_info_view->RecRange, $parcel_info_view->AutoHidePager) ?>
<?php if ($parcel_info_view->Pager->RecordCount > 0 && $parcel_info_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($parcel_info_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($parcel_info_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($parcel_info_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $parcel_info_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($parcel_info_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($parcel_info_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fparcel_infoview" id="fparcel_infoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parcel_info_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parcel_info_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parcel_info">
<input type="hidden" name="modal" value="<?php echo (int)$parcel_info_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($parcel_info->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_id"><?php echo $parcel_info->id->caption() ?></span></td>
		<td data-name="id"<?php echo $parcel_info->id->cellAttributes() ?>>
<span id="el_parcel_info_id">
<span<?php echo $parcel_info->id->viewAttributes() ?>>
<?php echo $parcel_info->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
	<tr id="r_from_place">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_from_place"><?php echo $parcel_info->from_place->caption() ?></span></td>
		<td data-name="from_place"<?php echo $parcel_info->from_place->cellAttributes() ?>>
<span id="el_parcel_info_from_place">
<span<?php echo $parcel_info->from_place->viewAttributes() ?>>
<?php echo $parcel_info->from_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
	<tr id="r_to_place">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_to_place"><?php echo $parcel_info->to_place->caption() ?></span></td>
		<td data-name="to_place"<?php echo $parcel_info->to_place->cellAttributes() ?>>
<span id="el_parcel_info_to_place">
<span<?php echo $parcel_info->to_place->viewAttributes() ?>>
<?php echo $parcel_info->to_place->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_description"><?php echo $parcel_info->description->caption() ?></span></td>
		<td data-name="description"<?php echo $parcel_info->description->cellAttributes() ?>>
<span id="el_parcel_info_description">
<span<?php echo $parcel_info->description->viewAttributes() ?>>
<?php echo $parcel_info->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_user_id"><?php echo $parcel_info->user_id->caption() ?></span></td>
		<td data-name="user_id"<?php echo $parcel_info->user_id->cellAttributes() ?>>
<span id="el_parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<?php echo $parcel_info->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->image_id->Visible) { // image_id ?>
	<tr id="r_image_id">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_image_id"><?php echo $parcel_info->image_id->caption() ?></span></td>
		<td data-name="image_id"<?php echo $parcel_info->image_id->cellAttributes() ?>>
<span id="el_parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->getViewValue())) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><?php echo $parcel_info->image_id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $parcel_info->image_id->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_name"><?php echo $parcel_info->name->caption() ?></span></td>
		<td data-name="name"<?php echo $parcel_info->name->cellAttributes() ?>>
<span id="el_parcel_info_name">
<span<?php echo $parcel_info->name->viewAttributes() ?>>
<?php echo $parcel_info->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->categoty->Visible) { // categoty ?>
	<tr id="r_categoty">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_categoty"><?php echo $parcel_info->categoty->caption() ?></span></td>
		<td data-name="categoty"<?php echo $parcel_info->categoty->cellAttributes() ?>>
<span id="el_parcel_info_categoty">
<span<?php echo $parcel_info->categoty->viewAttributes() ?>>
<?php echo $parcel_info->categoty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_status"><?php echo $parcel_info->status->caption() ?></span></td>
		<td data-name="status"<?php echo $parcel_info->status->cellAttributes() ?>>
<span id="el_parcel_info_status">
<span<?php echo $parcel_info->status->viewAttributes() ?>>
<?php echo $parcel_info->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->createdAt->Visible) { // createdAt ?>
	<tr id="r_createdAt">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_createdAt"><?php echo $parcel_info->createdAt->caption() ?></span></td>
		<td data-name="createdAt"<?php echo $parcel_info->createdAt->cellAttributes() ?>>
<span id="el_parcel_info_createdAt">
<span<?php echo $parcel_info->createdAt->viewAttributes() ?>>
<?php echo $parcel_info->createdAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($parcel_info->updatedAt->Visible) { // updatedAt ?>
	<tr id="r_updatedAt">
		<td class="<?php echo $parcel_info_view->TableLeftColumnClass ?>"><span id="elh_parcel_info_updatedAt"><?php echo $parcel_info->updatedAt->caption() ?></span></td>
		<td data-name="updatedAt"<?php echo $parcel_info->updatedAt->cellAttributes() ?>>
<span id="el_parcel_info_updatedAt">
<span<?php echo $parcel_info->updatedAt->viewAttributes() ?>>
<?php echo $parcel_info->updatedAt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$parcel_info_view->IsModal) { ?>
<?php if (!$parcel_info->isExport()) { ?>
<?php if (!isset($parcel_info_view->Pager)) $parcel_info_view->Pager = new NumericPager($parcel_info_view->StartRec, $parcel_info_view->DisplayRecs, $parcel_info_view->TotalRecs, $parcel_info_view->RecRange, $parcel_info_view->AutoHidePager) ?>
<?php if ($parcel_info_view->Pager->RecordCount > 0 && $parcel_info_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($parcel_info_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($parcel_info_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($parcel_info_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $parcel_info_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($parcel_info_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($parcel_info_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $parcel_info_view->pageUrl() ?>start=<?php echo $parcel_info_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$parcel_info_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$parcel_info->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$parcel_info_view->terminate();
?>
