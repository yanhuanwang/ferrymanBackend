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
$trip_info_delete = new trip_info_delete();

// Run the page
$trip_info_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trip_info_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftrip_infodelete = currentForm = new ew.Form("ftrip_infodelete", "delete");

// Form_CustomValidate event
ftrip_infodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrip_infodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrip_infodelete.lists["x_user_id"] = <?php echo $trip_info_delete->user_id->Lookup->toClientList() ?>;
ftrip_infodelete.lists["x_user_id"].options = <?php echo JsonEncode($trip_info_delete->user_id->lookupOptions()) ?>;
ftrip_infodelete.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trip_info_delete->showPageHeader(); ?>
<?php
$trip_info_delete->showMessage();
?>
<form name="ftrip_infodelete" id="ftrip_infodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trip_info_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trip_info_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trip_info">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($trip_info_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($trip_info->from_place->Visible) { // from_place ?>
		<th class="<?php echo $trip_info->from_place->headerCellClass() ?>"><span id="elh_trip_info_from_place" class="trip_info_from_place"><?php echo $trip_info->from_place->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->to_place->Visible) { // to_place ?>
		<th class="<?php echo $trip_info->to_place->headerCellClass() ?>"><span id="elh_trip_info_to_place" class="trip_info_to_place"><?php echo $trip_info->to_place->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->description->Visible) { // description ?>
		<th class="<?php echo $trip_info->description->headerCellClass() ?>"><span id="elh_trip_info_description" class="trip_info_description"><?php echo $trip_info->description->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->user_id->Visible) { // user_id ?>
		<th class="<?php echo $trip_info->user_id->headerCellClass() ?>"><span id="elh_trip_info_user_id" class="trip_info_user_id"><?php echo $trip_info->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
		<th class="<?php echo $trip_info->flight_number->headerCellClass() ?>"><span id="elh_trip_info_flight_number" class="trip_info_flight_number"><?php echo $trip_info->flight_number->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
		<th class="<?php echo $trip_info->createdAt->headerCellClass() ?>"><span id="elh_trip_info_createdAt" class="trip_info_createdAt"><?php echo $trip_info->createdAt->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
		<th class="<?php echo $trip_info->updatedAt->headerCellClass() ?>"><span id="elh_trip_info_updatedAt" class="trip_info_updatedAt"><?php echo $trip_info->updatedAt->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->from_date->Visible) { // from_date ?>
		<th class="<?php echo $trip_info->from_date->headerCellClass() ?>"><span id="elh_trip_info_from_date" class="trip_info_from_date"><?php echo $trip_info->from_date->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->to_date->Visible) { // to_date ?>
		<th class="<?php echo $trip_info->to_date->headerCellClass() ?>"><span id="elh_trip_info_to_date" class="trip_info_to_date"><?php echo $trip_info->to_date->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->labor_fee->Visible) { // labor_fee ?>
		<th class="<?php echo $trip_info->labor_fee->headerCellClass() ?>"><span id="elh_trip_info_labor_fee" class="trip_info_labor_fee"><?php echo $trip_info->labor_fee->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->available->Visible) { // available ?>
		<th class="<?php echo $trip_info->available->headerCellClass() ?>"><span id="elh_trip_info_available" class="trip_info_available"><?php echo $trip_info->available->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->service_type->Visible) { // service_type ?>
		<th class="<?php echo $trip_info->service_type->headerCellClass() ?>"><span id="elh_trip_info_service_type" class="trip_info_service_type"><?php echo $trip_info->service_type->caption() ?></span></th>
<?php } ?>
<?php if ($trip_info->max_carrying_weight->Visible) { // max_carrying_weight ?>
		<th class="<?php echo $trip_info->max_carrying_weight->headerCellClass() ?>"><span id="elh_trip_info_max_carrying_weight" class="trip_info_max_carrying_weight"><?php echo $trip_info->max_carrying_weight->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$trip_info_delete->RecCnt = 0;
$i = 0;
while (!$trip_info_delete->Recordset->EOF) {
	$trip_info_delete->RecCnt++;
	$trip_info_delete->RowCnt++;

	// Set row properties
	$trip_info->resetAttributes();
	$trip_info->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$trip_info_delete->loadRowValues($trip_info_delete->Recordset);

	// Render row
	$trip_info_delete->renderRow();
?>
	<tr<?php echo $trip_info->rowAttributes() ?>>
<?php if ($trip_info->from_place->Visible) { // from_place ?>
		<td<?php echo $trip_info->from_place->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_from_place" class="trip_info_from_place">
<span<?php echo $trip_info->from_place->viewAttributes() ?>>
<?php echo $trip_info->from_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->to_place->Visible) { // to_place ?>
		<td<?php echo $trip_info->to_place->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_to_place" class="trip_info_to_place">
<span<?php echo $trip_info->to_place->viewAttributes() ?>>
<?php echo $trip_info->to_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->description->Visible) { // description ?>
		<td<?php echo $trip_info->description->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_description" class="trip_info_description">
<span<?php echo $trip_info->description->viewAttributes() ?>>
<?php echo $trip_info->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->user_id->Visible) { // user_id ?>
		<td<?php echo $trip_info->user_id->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_user_id" class="trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<?php echo $trip_info->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
		<td<?php echo $trip_info->flight_number->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_flight_number" class="trip_info_flight_number">
<span<?php echo $trip_info->flight_number->viewAttributes() ?>>
<?php echo $trip_info->flight_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
		<td<?php echo $trip_info->createdAt->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_createdAt" class="trip_info_createdAt">
<span<?php echo $trip_info->createdAt->viewAttributes() ?>>
<?php echo $trip_info->createdAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
		<td<?php echo $trip_info->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_updatedAt" class="trip_info_updatedAt">
<span<?php echo $trip_info->updatedAt->viewAttributes() ?>>
<?php echo $trip_info->updatedAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->from_date->Visible) { // from_date ?>
		<td<?php echo $trip_info->from_date->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_from_date" class="trip_info_from_date">
<span<?php echo $trip_info->from_date->viewAttributes() ?>>
<?php echo $trip_info->from_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->to_date->Visible) { // to_date ?>
		<td<?php echo $trip_info->to_date->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_to_date" class="trip_info_to_date">
<span<?php echo $trip_info->to_date->viewAttributes() ?>>
<?php echo $trip_info->to_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->labor_fee->Visible) { // labor_fee ?>
		<td<?php echo $trip_info->labor_fee->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_labor_fee" class="trip_info_labor_fee">
<span<?php echo $trip_info->labor_fee->viewAttributes() ?>>
<?php echo $trip_info->labor_fee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->available->Visible) { // available ?>
		<td<?php echo $trip_info->available->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_available" class="trip_info_available">
<span<?php echo $trip_info->available->viewAttributes() ?>>
<?php echo $trip_info->available->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->service_type->Visible) { // service_type ?>
		<td<?php echo $trip_info->service_type->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_service_type" class="trip_info_service_type">
<span<?php echo $trip_info->service_type->viewAttributes() ?>>
<?php echo $trip_info->service_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($trip_info->max_carrying_weight->Visible) { // max_carrying_weight ?>
		<td<?php echo $trip_info->max_carrying_weight->cellAttributes() ?>>
<span id="el<?php echo $trip_info_delete->RowCnt ?>_trip_info_max_carrying_weight" class="trip_info_max_carrying_weight">
<span<?php echo $trip_info->max_carrying_weight->viewAttributes() ?>>
<?php echo $trip_info->max_carrying_weight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$trip_info_delete->Recordset->moveNext();
}
$trip_info_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trip_info_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$trip_info_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trip_info_delete->terminate();
?>
