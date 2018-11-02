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
$orders_delete = new orders_delete();

// Run the page
$orders_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fordersdelete = currentForm = new ew.Form("fordersdelete", "delete");

// Form_CustomValidate event
fordersdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fordersdelete.lists["x__userid"] = <?php echo $orders_delete->_userid->Lookup->toClientList() ?>;
fordersdelete.lists["x__userid"].options = <?php echo JsonEncode($orders_delete->_userid->lookupOptions()) ?>;
fordersdelete.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersdelete.lists["x_parcel_id"] = <?php echo $orders_delete->parcel_id->Lookup->toClientList() ?>;
fordersdelete.lists["x_parcel_id"].options = <?php echo JsonEncode($orders_delete->parcel_id->lookupOptions()) ?>;
fordersdelete.autoSuggests["x_parcel_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersdelete.lists["x_carrier_id"] = <?php echo $orders_delete->carrier_id->Lookup->toClientList() ?>;
fordersdelete.lists["x_carrier_id"].options = <?php echo JsonEncode($orders_delete->carrier_id->lookupOptions()) ?>;
fordersdelete.autoSuggests["x_carrier_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersdelete.lists["x_status"] = <?php echo $orders_delete->status->Lookup->toClientList() ?>;
fordersdelete.lists["x_status"].options = <?php echo JsonEncode($orders_delete->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orders_delete->showPageHeader(); ?>
<?php
$orders_delete->showMessage();
?>
<form name="fordersdelete" id="fordersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($orders_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($orders->_userid->Visible) { // userid ?>
		<th class="<?php echo $orders->_userid->headerCellClass() ?>"><span id="elh_orders__userid" class="orders__userid"><?php echo $orders->_userid->caption() ?></span></th>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<th class="<?php echo $orders->parcel_id->headerCellClass() ?>"><span id="elh_orders_parcel_id" class="orders_parcel_id"><?php echo $orders->parcel_id->caption() ?></span></th>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<th class="<?php echo $orders->carrier_id->headerCellClass() ?>"><span id="elh_orders_carrier_id" class="orders_carrier_id"><?php echo $orders->carrier_id->caption() ?></span></th>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
		<th class="<?php echo $orders->description->headerCellClass() ?>"><span id="elh_orders_description" class="orders_description"><?php echo $orders->description->caption() ?></span></th>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
		<th class="<?php echo $orders->status->headerCellClass() ?>"><span id="elh_orders_status" class="orders_status"><?php echo $orders->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$orders_delete->RecCnt = 0;
$i = 0;
while (!$orders_delete->Recordset->EOF) {
	$orders_delete->RecCnt++;
	$orders_delete->RowCnt++;

	// Set row properties
	$orders->resetAttributes();
	$orders->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$orders_delete->loadRowValues($orders_delete->Recordset);

	// Render row
	$orders_delete->renderRow();
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php if ($orders->_userid->Visible) { // userid ?>
		<td<?php echo $orders->_userid->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders__userid" class="orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<?php echo $orders->_userid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<td<?php echo $orders->parcel_id->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_parcel_id" class="orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<?php echo $orders->parcel_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<td<?php echo $orders->carrier_id->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_carrier_id" class="orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<?php echo $orders->carrier_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
		<td<?php echo $orders->description->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_description" class="orders_description">
<span<?php echo $orders->description->viewAttributes() ?>>
<?php echo $orders->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
		<td<?php echo $orders->status->cellAttributes() ?>>
<span id="el<?php echo $orders_delete->RowCnt ?>_orders_status" class="orders_status">
<span<?php echo $orders->status->viewAttributes() ?>>
<?php echo $orders->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$orders_delete->Recordset->moveNext();
}
$orders_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$orders_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orders_delete->terminate();
?>
