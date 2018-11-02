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
$parcel_info_delete = new parcel_info_delete();

// Run the page
$parcel_info_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parcel_info_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fparcel_infodelete = currentForm = new ew.Form("fparcel_infodelete", "delete");

// Form_CustomValidate event
fparcel_infodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparcel_infodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fparcel_infodelete.lists["x_user_id"] = <?php echo $parcel_info_delete->user_id->Lookup->toClientList() ?>;
fparcel_infodelete.lists["x_user_id"].options = <?php echo JsonEncode($parcel_info_delete->user_id->lookupOptions()) ?>;
fparcel_infodelete.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fparcel_infodelete.lists["x_category"] = <?php echo $parcel_info_delete->category->Lookup->toClientList() ?>;
fparcel_infodelete.lists["x_category"].options = <?php echo JsonEncode($parcel_info_delete->category->lookupOptions()) ?>;
fparcel_infodelete.lists["x_image_id"] = <?php echo $parcel_info_delete->image_id->Lookup->toClientList() ?>;
fparcel_infodelete.lists["x_image_id"].options = <?php echo JsonEncode($parcel_info_delete->image_id->lookupOptions()) ?>;
fparcel_infodelete.autoSuggests["x_image_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $parcel_info_delete->showPageHeader(); ?>
<?php
$parcel_info_delete->showMessage();
?>
<form name="fparcel_infodelete" id="fparcel_infodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parcel_info_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parcel_info_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parcel_info">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($parcel_info_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
		<th class="<?php echo $parcel_info->from_place->headerCellClass() ?>"><span id="elh_parcel_info_from_place" class="parcel_info_from_place"><?php echo $parcel_info->from_place->caption() ?></span></th>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
		<th class="<?php echo $parcel_info->to_place->headerCellClass() ?>"><span id="elh_parcel_info_to_place" class="parcel_info_to_place"><?php echo $parcel_info->to_place->caption() ?></span></th>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
		<th class="<?php echo $parcel_info->description->headerCellClass() ?>"><span id="elh_parcel_info_description" class="parcel_info_description"><?php echo $parcel_info->description->caption() ?></span></th>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
		<th class="<?php echo $parcel_info->user_id->headerCellClass() ?>"><span id="elh_parcel_info_user_id" class="parcel_info_user_id"><?php echo $parcel_info->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($parcel_info->category->Visible) { // category ?>
		<th class="<?php echo $parcel_info->category->headerCellClass() ?>"><span id="elh_parcel_info_category" class="parcel_info_category"><?php echo $parcel_info->category->caption() ?></span></th>
<?php } ?>
<?php if ($parcel_info->image_id->Visible) { // image_id ?>
		<th class="<?php echo $parcel_info->image_id->headerCellClass() ?>"><span id="elh_parcel_info_image_id" class="parcel_info_image_id"><?php echo $parcel_info->image_id->caption() ?></span></th>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
		<th class="<?php echo $parcel_info->name->headerCellClass() ?>"><span id="elh_parcel_info_name" class="parcel_info_name"><?php echo $parcel_info->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$parcel_info_delete->RecCnt = 0;
$i = 0;
while (!$parcel_info_delete->Recordset->EOF) {
	$parcel_info_delete->RecCnt++;
	$parcel_info_delete->RowCnt++;

	// Set row properties
	$parcel_info->resetAttributes();
	$parcel_info->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$parcel_info_delete->loadRowValues($parcel_info_delete->Recordset);

	// Render row
	$parcel_info_delete->renderRow();
?>
	<tr<?php echo $parcel_info->rowAttributes() ?>>
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
		<td<?php echo $parcel_info->from_place->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_from_place" class="parcel_info_from_place">
<span<?php echo $parcel_info->from_place->viewAttributes() ?>>
<?php echo $parcel_info->from_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
		<td<?php echo $parcel_info->to_place->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_to_place" class="parcel_info_to_place">
<span<?php echo $parcel_info->to_place->viewAttributes() ?>>
<?php echo $parcel_info->to_place->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
		<td<?php echo $parcel_info->description->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_description" class="parcel_info_description">
<span<?php echo $parcel_info->description->viewAttributes() ?>>
<?php echo $parcel_info->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
		<td<?php echo $parcel_info->user_id->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_user_id" class="parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<?php echo $parcel_info->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($parcel_info->category->Visible) { // category ?>
		<td<?php echo $parcel_info->category->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_category" class="parcel_info_category">
<span<?php echo $parcel_info->category->viewAttributes() ?>>
<?php echo $parcel_info->category->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($parcel_info->image_id->Visible) { // image_id ?>
		<td<?php echo $parcel_info->image_id->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_image_id" class="parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->getViewValue())) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><?php echo $parcel_info->image_id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $parcel_info->image_id->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
		<td<?php echo $parcel_info->name->cellAttributes() ?>>
<span id="el<?php echo $parcel_info_delete->RowCnt ?>_parcel_info_name" class="parcel_info_name">
<span<?php echo $parcel_info->name->viewAttributes() ?>>
<?php echo $parcel_info->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$parcel_info_delete->Recordset->moveNext();
}
$parcel_info_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $parcel_info_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$parcel_info_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$parcel_info_delete->terminate();
?>
