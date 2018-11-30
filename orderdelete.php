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
$order_delete = new order_delete();

// Run the page
$order_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var forderdelete = currentForm = new ew.Form("forderdelete", "delete");

// Form_CustomValidate event
forderdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
forderdelete.lists["x_user_id"] = <?php echo $order_delete->user_id->Lookup->toClientList() ?>;
forderdelete.lists["x_user_id"].options = <?php echo JsonEncode($order_delete->user_id->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $order_delete->showPageHeader(); ?>
<?php
$order_delete->showMessage();
?>
<form name="forderdelete" id="forderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($order_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $order_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($order_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($order->id->Visible) { // id ?>
		<th class="<?php echo $order->id->headerCellClass() ?>"><span id="elh_order_id" class="order_id"><?php echo $order->id->caption() ?></span></th>
<?php } ?>
<?php if ($order->user_id->Visible) { // user_id ?>
		<th class="<?php echo $order->user_id->headerCellClass() ?>"><span id="elh_order_user_id" class="order_user_id"><?php echo $order->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($order->from_place->Visible) { // from_place ?>
		<th class="<?php echo $order->from_place->headerCellClass() ?>"><span id="elh_order_from_place" class="order_from_place"><?php echo $order->from_place->caption() ?></span></th>
<?php } ?>
<?php if ($order->to_place->Visible) { // to_place ?>
		<th class="<?php echo $order->to_place->headerCellClass() ?>"><span id="elh_order_to_place" class="order_to_place"><?php echo $order->to_place->caption() ?></span></th>
<?php } ?>
<?php if ($order->date->Visible) { // date ?>
		<th class="<?php echo $order->date->headerCellClass() ?>"><span id="elh_order_date" class="order_date"><?php echo $order->date->caption() ?></span></th>
<?php } ?>
<?php if ($order->flight_number->Visible) { // flight_number ?>
		<th class="<?php echo $order->flight_number->headerCellClass() ?>"><span id="elh_order_flight_number" class="order_flight_number"><?php echo $order->flight_number->caption() ?></span></th>
<?php } ?>
<?php if ($order->description->Visible) { // description ?>
		<th class="<?php echo $order->description->headerCellClass() ?>"><span id="elh_order_description" class="order_description"><?php echo $order->description->caption() ?></span></th>
<?php } ?>
<?php if ($order->createdAt->Visible) { // createdAt ?>
		<th class="<?php echo $order->createdAt->headerCellClass() ?>"><span id="elh_order_createdAt" class="order_createdAt"><?php echo $order->createdAt->caption() ?></span></th>
<?php } ?>
<?php if ($order->updatedAt->Visible) { // updatedAt ?>
		<th class="<?php echo $order->updatedAt->headerCellClass() ?>"><span id="elh_order_updatedAt" class="order_updatedAt"><?php echo $order->updatedAt->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$order_delete->RecCnt = 0;
$i = 0;
while (!$order_delete->Recordset->EOF) {
	$order_delete->RecCnt++;
	$order_delete->RowCnt++;

	// Set row properties
	$order->resetAttributes();
	$order->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$order_delete->loadRowValues($order_delete->Recordset);

	// Render row
	$order_delete->renderRow();
?>
	<tr<?php echo $order->rowAttributes() ?>>
<?php if ($order->id->Visible) { // id ?>
		<td<?php echo $order->id->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_id" class="order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<?php echo $order->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->user_id->Visible) { // user_id ?>
		<td<?php echo $order->user_id->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_user_id" class="order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<?php echo $order->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->from_place->Visible) { // from_place ?>
		<td<?php echo $order->from_place->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_from_place" class="order_from_place">
<span<?php echo $order->from_place->viewAttributes() ?>>
<?php echo $order->from_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->to_place->Visible) { // to_place ?>
		<td<?php echo $order->to_place->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_to_place" class="order_to_place">
<span<?php echo $order->to_place->viewAttributes() ?>>
<?php echo $order->to_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->date->Visible) { // date ?>
		<td<?php echo $order->date->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_date" class="order_date">
<span<?php echo $order->date->viewAttributes() ?>>
<?php echo $order->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->flight_number->Visible) { // flight_number ?>
		<td<?php echo $order->flight_number->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_flight_number" class="order_flight_number">
<span<?php echo $order->flight_number->viewAttributes() ?>>
<?php echo $order->flight_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->description->Visible) { // description ?>
		<td<?php echo $order->description->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_description" class="order_description">
<span<?php echo $order->description->viewAttributes() ?>>
<?php echo $order->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->createdAt->Visible) { // createdAt ?>
		<td<?php echo $order->createdAt->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_createdAt" class="order_createdAt">
<span<?php echo $order->createdAt->viewAttributes() ?>>
<?php echo $order->createdAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($order->updatedAt->Visible) { // updatedAt ?>
		<td<?php echo $order->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $order_delete->RowCnt ?>_order_updatedAt" class="order_updatedAt">
<span<?php echo $order->updatedAt->viewAttributes() ?>>
<?php echo $order->updatedAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$order_delete->Recordset->moveNext();
}
$order_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $order_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$order_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$order_delete->terminate();
?>
