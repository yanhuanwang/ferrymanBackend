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
$user_view = new user_view();

// Run the page
$user_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$user->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fuserview = currentForm = new ew.Form("fuserview", "view");

// Form_CustomValidate event
fuserview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserview.lists["x_gender"] = <?php echo $user_view->gender->Lookup->toClientList() ?>;
fuserview.lists["x_gender"].options = <?php echo JsonEncode($user_view->gender->options(FALSE, TRUE)) ?>;
fuserview.lists["x_locked"] = <?php echo $user_view->locked->Lookup->toClientList() ?>;
fuserview.lists["x_locked"].options = <?php echo JsonEncode($user_view->locked->options(FALSE, TRUE)) ?>;
fuserview.lists["x_send_role"] = <?php echo $user_view->send_role->Lookup->toClientList() ?>;
fuserview.lists["x_send_role"].options = <?php echo JsonEncode($user_view->send_role->options(FALSE, TRUE)) ?>;
fuserview.lists["x_carrier_role"] = <?php echo $user_view->carrier_role->Lookup->toClientList() ?>;
fuserview.lists["x_carrier_role"].options = <?php echo JsonEncode($user_view->carrier_role->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$user->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $user_view->ExportOptions->render("body") ?>
<?php
	foreach ($user_view->OtherOptions as &$option)
		$option->render("body");
?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $user_view->showPageHeader(); ?>
<?php
$user_view->showMessage();
?>
<?php if (!$user_view->IsModal) { ?>
<?php if (!$user->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($user_view->Pager)) $user_view->Pager = new NumericPager($user_view->StartRec, $user_view->DisplayRecs, $user_view->TotalRecs, $user_view->RecRange, $user_view->AutoHidePager) ?>
<?php if ($user_view->Pager->RecordCount > 0 && $user_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fuserview" id="fuserview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="modal" value="<?php echo (int)$user_view->IsModal ?>">
<table class="table ew-view-table">
<?php if ($user->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_id"><?php echo $user->id->caption() ?></span></td>
		<td data-name="id"<?php echo $user->id->cellAttributes() ?>>
<span id="el_user_id">
<span<?php echo $user->id->viewAttributes() ?>>
<?php echo $user->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_username"><?php echo $user->username->caption() ?></span></td>
		<td data-name="username"<?php echo $user->username->cellAttributes() ?>>
<span id="el_user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<?php echo $user->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user__email"><?php echo $user->_email->caption() ?></span></td>
		<td data-name="_email"<?php echo $user->_email->cellAttributes() ?>>
<span id="el_user__email">
<span<?php echo $user->_email->viewAttributes() ?>>
<?php echo $user->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
	<tr id="r_gender">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_gender"><?php echo $user->gender->caption() ?></span></td>
		<td data-name="gender"<?php echo $user->gender->cellAttributes() ?>>
<span id="el_user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<?php echo $user->gender->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
	<tr id="r_phone">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_phone"><?php echo $user->phone->caption() ?></span></td>
		<td data-name="phone"<?php echo $user->phone->cellAttributes() ?>>
<span id="el_user_phone">
<span<?php echo $user->phone->viewAttributes() ?>>
<?php echo $user->phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
	<tr id="r_address">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_address"><?php echo $user->address->caption() ?></span></td>
		<td data-name="address"<?php echo $user->address->cellAttributes() ?>>
<span id="el_user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<?php echo $user->address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
	<tr id="r_country">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_country"><?php echo $user->country->caption() ?></span></td>
		<td data-name="country"<?php echo $user->country->cellAttributes() ?>>
<span id="el_user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<?php echo $user->country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
	<tr id="r_photo">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_photo"><?php echo $user->photo->caption() ?></span></td>
		<td data-name="photo"<?php echo $user->photo->cellAttributes() ?>>
<span id="el_user_photo">
<span>
<?php echo GetFileViewTag($user->photo, $user->photo->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
	<tr id="r_nickname">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_nickname"><?php echo $user->nickname->caption() ?></span></td>
		<td data-name="nickname"<?php echo $user->nickname->cellAttributes() ?>>
<span id="el_user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<?php echo $user->nickname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
	<tr id="r_region">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_region"><?php echo $user->region->caption() ?></span></td>
		<td data-name="region"<?php echo $user->region->cellAttributes() ?>>
<span id="el_user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<?php echo $user->region->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
	<tr id="r_locked">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_locked"><?php echo $user->locked->caption() ?></span></td>
		<td data-name="locked"<?php echo $user->locked->cellAttributes() ?>>
<span id="el_user_locked">
<span<?php echo $user->locked->viewAttributes() ?>>
<?php echo $user->locked->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
	<tr id="r_send_role">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_send_role"><?php echo $user->send_role->caption() ?></span></td>
		<td data-name="send_role"<?php echo $user->send_role->cellAttributes() ?>>
<span id="el_user_send_role">
<span<?php echo $user->send_role->viewAttributes() ?>>
<?php echo $user->send_role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
	<tr id="r_carrier_role">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_carrier_role"><?php echo $user->carrier_role->caption() ?></span></td>
		<td data-name="carrier_role"<?php echo $user->carrier_role->cellAttributes() ?>>
<span id="el_user_carrier_role">
<span<?php echo $user->carrier_role->viewAttributes() ?>>
<?php echo $user->carrier_role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
	<tr id="r_birthday">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_birthday"><?php echo $user->birthday->caption() ?></span></td>
		<td data-name="birthday"<?php echo $user->birthday->cellAttributes() ?>>
<span id="el_user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<?php echo $user->birthday->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->addDate->Visible) { // addDate ?>
	<tr id="r_addDate">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_addDate"><?php echo $user->addDate->caption() ?></span></td>
		<td data-name="addDate"<?php echo $user->addDate->cellAttributes() ?>>
<span id="el_user_addDate">
<span<?php echo $user->addDate->viewAttributes() ?>>
<?php echo $user->addDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->updateDate->Visible) { // updateDate ?>
	<tr id="r_updateDate">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_updateDate"><?php echo $user->updateDate->caption() ?></span></td>
		<td data-name="updateDate"<?php echo $user->updateDate->cellAttributes() ?>>
<span id="el_user_updateDate">
<span<?php echo $user->updateDate->viewAttributes() ?>>
<?php echo $user->updateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
	<tr id="r_activated">
		<td class="<?php echo $user_view->TableLeftColumnClass ?>"><span id="elh_user_activated"><?php echo $user->activated->caption() ?></span></td>
		<td data-name="activated"<?php echo $user->activated->cellAttributes() ?>>
<span id="el_user_activated">
<span<?php echo $user->activated->viewAttributes() ?>>
<?php echo $user->activated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$user_view->IsModal) { ?>
<?php if (!$user->isExport()) { ?>
<?php if (!isset($user_view->Pager)) $user_view->Pager = new NumericPager($user_view->StartRec, $user_view->DisplayRecs, $user_view->TotalRecs, $user_view->RecRange, $user_view->AutoHidePager) ?>
<?php if ($user_view->Pager->RecordCount > 0 && $user_view->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_view->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_view->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_view->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_view->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_view->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_view->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_view->pageUrl() ?>start=<?php echo $user_view->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php if ($user->getCurrentDetailTable() <> "") { ?>
<?php
	$user_view->DetailPages->ValidKeys = explode(",", $user->getCurrentDetailTable());
	$firstActiveDetailTable = $user_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="user_view_details"><!-- tabs -->
	<ul class="<?php echo $user_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("image", explode(",", $user->getCurrentDetailTable())) && $image->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "image") {
			$firstActiveDetailTable = "image";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_view->DetailPages->pageStyle("image") ?>" href="#tab_image" data-toggle="tab"><?php echo $Language->TablePhrase("image", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $user_view->image_Count, $Language->Phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("trip_info", explode(",", $user->getCurrentDetailTable())) && $trip_info->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "trip_info") {
			$firstActiveDetailTable = "trip_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_view->DetailPages->pageStyle("trip_info") ?>" href="#tab_trip_info" data-toggle="tab"><?php echo $Language->TablePhrase("trip_info", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $user_view->trip_info_Count, $Language->Phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("parcel_info", explode(",", $user->getCurrentDetailTable())) && $parcel_info->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info") {
			$firstActiveDetailTable = "parcel_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_view->DetailPages->pageStyle("parcel_info") ?>" href="#tab_parcel_info" data-toggle="tab"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $user_view->parcel_info_Count, $Language->Phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("orders", explode(",", $user->getCurrentDetailTable())) && $orders->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "orders") {
			$firstActiveDetailTable = "orders";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_view->DetailPages->pageStyle("orders") ?>" href="#tab_orders" data-toggle="tab"><?php echo $Language->TablePhrase("orders", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $user_view->orders_Count, $Language->Phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("image", explode(",", $user->getCurrentDetailTable())) && $image->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "image")
			$firstActiveDetailTable = "image";
?>
		<div class="tab-pane<?php echo $user_view->DetailPages->pageStyle("image") ?>" id="tab_image"><!-- page* -->
<?php include_once "imagegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("trip_info", explode(",", $user->getCurrentDetailTable())) && $trip_info->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "trip_info")
			$firstActiveDetailTable = "trip_info";
?>
		<div class="tab-pane<?php echo $user_view->DetailPages->pageStyle("trip_info") ?>" id="tab_trip_info"><!-- page* -->
<?php include_once "trip_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("parcel_info", explode(",", $user->getCurrentDetailTable())) && $parcel_info->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info")
			$firstActiveDetailTable = "parcel_info";
?>
		<div class="tab-pane<?php echo $user_view->DetailPages->pageStyle("parcel_info") ?>" id="tab_parcel_info"><!-- page* -->
<?php include_once "parcel_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("orders", explode(",", $user->getCurrentDetailTable())) && $orders->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "orders")
			$firstActiveDetailTable = "orders";
?>
		<div class="tab-pane<?php echo $user_view->DetailPages->pageStyle("orders") ?>" id="tab_orders"><!-- page* -->
<?php include_once "ordersgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$user_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$user->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$user_view->terminate();
?>
