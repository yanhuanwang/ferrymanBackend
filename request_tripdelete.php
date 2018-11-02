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
frequest_tripdelete.lists["x_category"] = <?php echo $request_trip_delete->category->Lookup->toClientList() ?>;
frequest_tripdelete.lists["x_category"].options = <?php echo JsonEncode($request_trip_delete->category->lookupOptions()) ?>;

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
<?php if ($request_trip->date->Visible) { // date ?>
		<th class="<?php echo $request_trip->date->headerCellClass() ?>"><span id="elh_request_trip_date" class="request_trip_date"><?php echo $request_trip->date->caption() ?></span></th>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
		<th class="<?php echo $request_trip->description->headerCellClass() ?>"><span id="elh_request_trip_description" class="request_trip_description"><?php echo $request_trip->description->caption() ?></span></th>
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
<?php if ($request_trip->date->Visible) { // date ?>
		<td<?php echo $request_trip->date->cellAttributes() ?>>
<span id="el<?php echo $request_trip_delete->RowCnt ?>_request_trip_date" class="request_trip_date">
<span<?php echo $request_trip->date->viewAttributes() ?>>
<?php echo $request_trip->date->getViewValue() ?></span>
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
