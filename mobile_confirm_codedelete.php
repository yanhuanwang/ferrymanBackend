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
$mobile_confirm_code_delete = new mobile_confirm_code_delete();

// Run the page
$mobile_confirm_code_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mobile_confirm_code_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fmobile_confirm_codedelete = currentForm = new ew.Form("fmobile_confirm_codedelete", "delete");

// Form_CustomValidate event
fmobile_confirm_codedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmobile_confirm_codedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $mobile_confirm_code_delete->showPageHeader(); ?>
<?php
$mobile_confirm_code_delete->showMessage();
?>
<form name="fmobile_confirm_codedelete" id="fmobile_confirm_codedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($mobile_confirm_code_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $mobile_confirm_code_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mobile_confirm_code">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($mobile_confirm_code_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($mobile_confirm_code->id->Visible) { // id ?>
		<th class="<?php echo $mobile_confirm_code->id->headerCellClass() ?>"><span id="elh_mobile_confirm_code_id" class="mobile_confirm_code_id"><?php echo $mobile_confirm_code->id->caption() ?></span></th>
<?php } ?>
<?php if ($mobile_confirm_code->mobile_phone->Visible) { // mobile_phone ?>
		<th class="<?php echo $mobile_confirm_code->mobile_phone->headerCellClass() ?>"><span id="elh_mobile_confirm_code_mobile_phone" class="mobile_confirm_code_mobile_phone"><?php echo $mobile_confirm_code->mobile_phone->caption() ?></span></th>
<?php } ?>
<?php if ($mobile_confirm_code->code->Visible) { // code ?>
		<th class="<?php echo $mobile_confirm_code->code->headerCellClass() ?>"><span id="elh_mobile_confirm_code_code" class="mobile_confirm_code_code"><?php echo $mobile_confirm_code->code->caption() ?></span></th>
<?php } ?>
<?php if ($mobile_confirm_code->createdAt->Visible) { // createdAt ?>
		<th class="<?php echo $mobile_confirm_code->createdAt->headerCellClass() ?>"><span id="elh_mobile_confirm_code_createdAt" class="mobile_confirm_code_createdAt"><?php echo $mobile_confirm_code->createdAt->caption() ?></span></th>
<?php } ?>
<?php if ($mobile_confirm_code->updatedAt->Visible) { // updatedAt ?>
		<th class="<?php echo $mobile_confirm_code->updatedAt->headerCellClass() ?>"><span id="elh_mobile_confirm_code_updatedAt" class="mobile_confirm_code_updatedAt"><?php echo $mobile_confirm_code->updatedAt->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$mobile_confirm_code_delete->RecCnt = 0;
$i = 0;
while (!$mobile_confirm_code_delete->Recordset->EOF) {
	$mobile_confirm_code_delete->RecCnt++;
	$mobile_confirm_code_delete->RowCnt++;

	// Set row properties
	$mobile_confirm_code->resetAttributes();
	$mobile_confirm_code->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$mobile_confirm_code_delete->loadRowValues($mobile_confirm_code_delete->Recordset);

	// Render row
	$mobile_confirm_code_delete->renderRow();
?>
	<tr<?php echo $mobile_confirm_code->rowAttributes() ?>>
<?php if ($mobile_confirm_code->id->Visible) { // id ?>
		<td<?php echo $mobile_confirm_code->id->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_delete->RowCnt ?>_mobile_confirm_code_id" class="mobile_confirm_code_id">
<span<?php echo $mobile_confirm_code->id->viewAttributes() ?>>
<?php echo $mobile_confirm_code->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mobile_confirm_code->mobile_phone->Visible) { // mobile_phone ?>
		<td<?php echo $mobile_confirm_code->mobile_phone->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_delete->RowCnt ?>_mobile_confirm_code_mobile_phone" class="mobile_confirm_code_mobile_phone">
<span<?php echo $mobile_confirm_code->mobile_phone->viewAttributes() ?>>
<?php echo $mobile_confirm_code->mobile_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mobile_confirm_code->code->Visible) { // code ?>
		<td<?php echo $mobile_confirm_code->code->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_delete->RowCnt ?>_mobile_confirm_code_code" class="mobile_confirm_code_code">
<span<?php echo $mobile_confirm_code->code->viewAttributes() ?>>
<?php echo $mobile_confirm_code->code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mobile_confirm_code->createdAt->Visible) { // createdAt ?>
		<td<?php echo $mobile_confirm_code->createdAt->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_delete->RowCnt ?>_mobile_confirm_code_createdAt" class="mobile_confirm_code_createdAt">
<span<?php echo $mobile_confirm_code->createdAt->viewAttributes() ?>>
<?php echo $mobile_confirm_code->createdAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mobile_confirm_code->updatedAt->Visible) { // updatedAt ?>
		<td<?php echo $mobile_confirm_code->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $mobile_confirm_code_delete->RowCnt ?>_mobile_confirm_code_updatedAt" class="mobile_confirm_code_updatedAt">
<span<?php echo $mobile_confirm_code->updatedAt->viewAttributes() ?>>
<?php echo $mobile_confirm_code->updatedAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$mobile_confirm_code_delete->Recordset->moveNext();
}
$mobile_confirm_code_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mobile_confirm_code_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$mobile_confirm_code_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$mobile_confirm_code_delete->terminate();
?>
