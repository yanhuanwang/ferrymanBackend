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
$request_trip_delete = new request_trip_delete();

// Run the page
$request_trip_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$request_trip_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var frequest_tripdelete = currentForm = new ew.Form("frequest_tripdelete", "delete");

// Form_CustomValidate event
frequest_tripdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frequest_tripdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $request_trip_delete->showPageHeader(); ?>
<?php
$request_trip_delete->showMessage();
?>
<form name="frequest_tripdelete" id="frequest_tripdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($request_trip_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $request_trip_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="request_trip">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($request_trip_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<th class="<?php echo $request_trip->from_place->headerCellClass() ?>"><span id="elh_request_trip_from_place" class="request_trip_from_place"><?php echo $request_trip->from_place->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<th class="<?php echo $request_trip->to_place->headerCellClass() ?>"><span id="elh_request_trip_to_place" class="request_trip_to_place"><?php echo $request_trip->to_place->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
		<th class="<?php echo $request_trip->description->headerCellClass() ?>"><span id="elh_request_trip_description" class="request_trip_description"><?php echo $request_trip->description->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->user_id->Visible) { // user_id ?>
		<th class="<?php echo $request_trip->user_id->headerCellClass() ?>"><span id="elh_request_trip_user_id" class="request_trip_user_id"><?php echo $request_trip->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->from_date->Visible) { // from_date ?>
		<th class="<?php echo $request_trip->from_date->headerCellClass() ?>"><span id="elh_request_trip_from_date" class="request_trip_from_date"><?php echo $request_trip->from_date->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->to_date->Visible) { // to_date ?>
		<th class="<?php echo $request_trip->to_date->headerCellClass() ?>"><span id="elh_request_trip_to_date" class="request_trip_to_date"><?php echo $request_trip->to_date->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
		<th class="<?php echo $request_trip->createdAt->headerCellClass() ?>"><span id="elh_request_trip_createdAt" class="request_trip_createdAt"><?php echo $request_trip->createdAt->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
		<th class="<?php echo $request_trip->updatedAt->headerCellClass() ?>"><span id="elh_request_trip_updatedAt" class="request_trip_updatedAt"><?php echo $request_trip->updatedAt->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->labor_fee->Visible) { // labor_fee ?>
		<th class="<?php echo $request_trip->labor_fee->headerCellClass() ?>"><span id="elh_request_trip_labor_fee" class="request_trip_labor_fee"><?php echo $request_trip->labor_fee->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->applicable->Visible) { // applicable ?>
		<th class="<?php echo $request_trip->applicable->headerCellClass() ?>"><span id="elh_request_trip_applicable" class="request_trip_applicable"><?php echo $request_trip->applicable->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->service_type->Visible) { // service_type ?>
		<th class="<?php echo $request_trip->service_type->headerCellClass() ?>"><span id="elh_request_trip_service_type" class="request_trip_service_type"><?php echo $request_trip->service_type->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->goods_category->Visible) { // goods_category ?>
		<th class="<?php echo $request_trip->goods_category->headerCellClass() ?>"><span id="elh_request_trip_goods_category" class="request_trip_goods_category"><?php echo $request_trip->goods_category->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->goods_weight->Visible) { // goods_weight ?>
		<th class="<?php echo $request_trip->goods_weight->headerCellClass() ?>"><span id="elh_request_trip_goods_weight" class="request_trip_goods_weight"><?php echo $request_trip->goods_weight->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->image1_id->Visible) { // image1_id ?>
		<th class="<?php echo $request_trip->image1_id->headerCellClass() ?>"><span id="elh_request_trip_image1_id" class="request_trip_image1_id"><?php echo $request_trip->image1_id->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->image2_id->Visible) { // image2_id ?>
		<th class="<?php echo $request_trip->image2_id->headerCellClass() ?>"><span id="elh_request_trip_image2_id" class="request_trip_image2_id"><?php echo $request_trip->image2_id->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->image3_id->Visible) { // image3_id ?>
		<th class="<?php echo $request_trip->image3_id->headerCellClass() ?>"><span id="elh_request_trip_image3_id" class="request_trip_image3_id"><?php echo $request_trip->image3_id->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->image4_id->Visible) { // image4_id ?>
		<th class="<?php echo $request_trip->image4_id->headerCellClass() ?>"><span id="elh_request_trip_image4_id" class="request_trip_image4_id"><?php echo $request_trip->image4_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$request_trip_delete->RecCnt = 0;
$i = 0;
while (!$request_trip_delete->Recordset->EOF) {
	$request_trip_delete->RecCnt++;
	$request_trip_delete->RowCnt++;

	// Set row properties
	$request_trip->resetAttributes();
	$request_trip->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$request_trip_delete->loadRowValues($request_trip_delete->Recordset);

	// Render row
	$request_trip_delete->renderRow();
?>
	<tr<?php echo $request_trip->rowAttributes() ?>>
<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<td<?php echo $request_trip->from_place->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_from_place" class="request_trip_from_place">
<span<?php echo $request_trip->from_place->viewAttributes() ?>>
<?php echo $request_trip->from_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<td<?php echo $request_trip->to_place->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_to_place" class="request_trip_to_place">
<span<?php echo $request_trip->to_place->viewAttributes() ?>>
<?php echo $request_trip->to_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
		<td<?php echo $request_trip->description->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_description" class="request_trip_description">
<span<?php echo $request_trip->description->viewAttributes() ?>>
<?php echo $request_trip->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->user_id->Visible) { // user_id ?>
		<td<?php echo $request_trip->user_id->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_user_id" class="request_trip_user_id">
<span<?php echo $request_trip->user_id->viewAttributes() ?>>
<?php echo $request_trip->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->from_date->Visible) { // from_date ?>
		<td<?php echo $request_trip->from_date->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_from_date" class="request_trip_from_date">
<span<?php echo $request_trip->from_date->viewAttributes() ?>>
<?php echo $request_trip->from_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->to_date->Visible) { // to_date ?>
		<td<?php echo $request_trip->to_date->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_to_date" class="request_trip_to_date">
<span<?php echo $request_trip->to_date->viewAttributes() ?>>
<?php echo $request_trip->to_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
		<td<?php echo $request_trip->createdAt->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_createdAt" class="request_trip_createdAt">
<span<?php echo $request_trip->createdAt->viewAttributes() ?>>
<?php echo $request_trip->createdAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
		<td<?php echo $request_trip->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_updatedAt" class="request_trip_updatedAt">
<span<?php echo $request_trip->updatedAt->viewAttributes() ?>>
<?php echo $request_trip->updatedAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->labor_fee->Visible) { // labor_fee ?>
		<td<?php echo $request_trip->labor_fee->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_labor_fee" class="request_trip_labor_fee">
<span<?php echo $request_trip->labor_fee->viewAttributes() ?>>
<?php echo $request_trip->labor_fee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->applicable->Visible) { // applicable ?>
		<td<?php echo $request_trip->applicable->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_applicable" class="request_trip_applicable">
<span<?php echo $request_trip->applicable->viewAttributes() ?>>
<?php echo $request_trip->applicable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->service_type->Visible) { // service_type ?>
		<td<?php echo $request_trip->service_type->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_service_type" class="request_trip_service_type">
<span<?php echo $request_trip->service_type->viewAttributes() ?>>
<?php echo $request_trip->service_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->goods_category->Visible) { // goods_category ?>
		<td<?php echo $request_trip->goods_category->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_goods_category" class="request_trip_goods_category">
<span<?php echo $request_trip->goods_category->viewAttributes() ?>>
<?php echo $request_trip->goods_category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->goods_weight->Visible) { // goods_weight ?>
		<td<?php echo $request_trip->goods_weight->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_goods_weight" class="request_trip_goods_weight">
<span<?php echo $request_trip->goods_weight->viewAttributes() ?>>
<?php echo $request_trip->goods_weight->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->image1_id->Visible) { // image1_id ?>
		<td<?php echo $request_trip->image1_id->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_image1_id" class="request_trip_image1_id">
<span<?php echo $request_trip->image1_id->viewAttributes() ?>>
<?php echo $request_trip->image1_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->image2_id->Visible) { // image2_id ?>
		<td<?php echo $request_trip->image2_id->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_image2_id" class="request_trip_image2_id">
<span<?php echo $request_trip->image2_id->viewAttributes() ?>>
<?php echo $request_trip->image2_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->image3_id->Visible) { // image3_id ?>
		<td<?php echo $request_trip->image3_id->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_image3_id" class="request_trip_image3_id">
<span<?php echo $request_trip->image3_id->viewAttributes() ?>>
<?php echo $request_trip->image3_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($request_trip->image4_id->Visible) { // image4_id ?>
		<td<?php echo $request_trip->image4_id->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_image4_id" class="request_trip_image4_id">
<span<?php echo $request_trip->image4_id->viewAttributes() ?>>
<?php echo $request_trip->image4_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$request_trip_delete->Recordset->moveNext();
}
$request_trip_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $request_trip_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$request_trip_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$request_trip_delete->terminate();
?>
