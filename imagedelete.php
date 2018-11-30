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
$image_delete = new image_delete();

// Run the page
$image_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fimagedelete = currentForm = new ew.Form("fimagedelete", "delete");

// Form_CustomValidate event
fimagedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimagedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $image_delete->showPageHeader(); ?>
<?php
$image_delete->showMessage();
?>
<form name="fimagedelete" id="fimagedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($image_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $image_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="image">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($image_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($image->path->Visible) { // path ?>
		<th class="<?php echo $image->path->headerCellClass() ?>"><span id="elh_image_path" class="image_path"><?php echo $image->path->caption() ?></span></th>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
		<th class="<?php echo $image->description->headerCellClass() ?>"><span id="elh_image_description" class="image_description"><?php echo $image->description->caption() ?></span></th>
<?php } ?>
<?php if ($image->uuid->Visible) { // uuid ?>
		<th class="<?php echo $image->uuid->headerCellClass() ?>"><span id="elh_image_uuid" class="image_uuid"><?php echo $image->uuid->caption() ?></span></th>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
		<th class="<?php echo $image->user_id->headerCellClass() ?>"><span id="elh_image_user_id" class="image_user_id"><?php echo $image->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
		<th class="<?php echo $image->confirmed->headerCellClass() ?>"><span id="elh_image_confirmed" class="image_confirmed"><?php echo $image->confirmed->caption() ?></span></th>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
		<th class="<?php echo $image->createdAt->headerCellClass() ?>"><span id="elh_image_createdAt" class="image_createdAt"><?php echo $image->createdAt->caption() ?></span></th>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
		<th class="<?php echo $image->updatedAt->headerCellClass() ?>"><span id="elh_image_updatedAt" class="image_updatedAt"><?php echo $image->updatedAt->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$image_delete->RecCnt = 0;
$i = 0;
while (!$image_delete->Recordset->EOF) {
	$image_delete->RecCnt++;
	$image_delete->RowCnt++;

	// Set row properties
	$image->resetAttributes();
	$image->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$image_delete->loadRowValues($image_delete->Recordset);

	// Render row
	$image_delete->renderRow();
?>
	<tr<?php echo $image->rowAttributes() ?>>
<?php if ($image->path->Visible) { // path ?>
		<td<?php echo $image->path->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_path" class="image_path">
<span>
<?php echo GetFileViewTag($image->path, $image->path->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
		<td<?php echo $image->description->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_description" class="image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<?php echo $image->description->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($image->uuid->Visible) { // uuid ?>
		<td<?php echo $image->uuid->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_uuid" class="image_uuid">
<span<?php echo $image->uuid->viewAttributes() ?>>
<?php echo $image->uuid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
		<td<?php echo $image->user_id->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_user_id" class="image_user_id">
<span<?php echo $image->user_id->viewAttributes() ?>>
<?php echo $image->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
		<td<?php echo $image->confirmed->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_confirmed" class="image_confirmed">
<span<?php echo $image->confirmed->viewAttributes() ?>>
<?php echo $image->confirmed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
		<td<?php echo $image->createdAt->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_createdAt" class="image_createdAt">
<span<?php echo $image->createdAt->viewAttributes() ?>>
<?php echo $image->createdAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
		<td<?php echo $image->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $image_delete->RowCnt ?>_image_updatedAt" class="image_updatedAt">
<span<?php echo $image->updatedAt->viewAttributes() ?>>
<?php echo $image->updatedAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$image_delete->Recordset->moveNext();
}
$image_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $image_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$image_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$image_delete->terminate();
?>
