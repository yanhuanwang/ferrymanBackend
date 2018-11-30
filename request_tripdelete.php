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
<?php if ($request_trip->category->Visible) { // category ?>
		<th class="<?php echo $request_trip->category->headerCellClass() ?>"><span id="elh_request_trip_category" class="request_trip_category"><?php echo $request_trip->category->caption() ?></span></th>
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
<?php if ($request_trip->category->Visible) { // category ?>
		<td<?php echo $request_trip->category->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_category" class="request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<?php echo $request_trip->category->getViewValue() ?></span>
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
