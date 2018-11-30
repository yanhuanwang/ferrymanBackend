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
$admin_delete = new admin_delete();

// Run the page
$admin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fadmindelete = currentForm = new ew.Form("fadmindelete", "delete");

// Form_CustomValidate event
fadmindelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fadmindelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $admin_delete->showPageHeader(); ?>
<?php
$admin_delete->showMessage();
?>
<form name="fadmindelete" id="fadmindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($admin_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $admin_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($admin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($admin->username->Visible) { // username ?>
		<th class="<?php echo $admin->username->headerCellClass() ?>"><span id="elh_admin_username" class="admin_username"><?php echo $admin->username->caption() ?></span></th>
<?php } ?>
<?php if ($admin->password->Visible) { // password ?>
		<th class="<?php echo $admin->password->headerCellClass() ?>"><span id="elh_admin_password" class="admin_password"><?php echo $admin->password->caption() ?></span></th>
<?php } ?>
<?php if ($admin->level->Visible) { // level ?>
		<th class="<?php echo $admin->level->headerCellClass() ?>"><span id="elh_admin_level" class="admin_level"><?php echo $admin->level->caption() ?></span></th>
<?php } ?>
<?php if ($admin->locked->Visible) { // locked ?>
		<th class="<?php echo $admin->locked->headerCellClass() ?>"><span id="elh_admin_locked" class="admin_locked"><?php echo $admin->locked->caption() ?></span></th>
<?php } ?>
<?php if ($admin->_email->Visible) { // email ?>
		<th class="<?php echo $admin->_email->headerCellClass() ?>"><span id="elh_admin__email" class="admin__email"><?php echo $admin->_email->caption() ?></span></th>
<?php } ?>
<?php if ($admin->activated->Visible) { // activated ?>
		<th class="<?php echo $admin->activated->headerCellClass() ?>"><span id="elh_admin_activated" class="admin_activated"><?php echo $admin->activated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$admin_delete->RecCnt = 0;
$i = 0;
while (!$admin_delete->Recordset->EOF) {
	$admin_delete->RecCnt++;
	$admin_delete->RowCnt++;

	// Set row properties
	$admin->resetAttributes();
	$admin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$admin_delete->loadRowValues($admin_delete->Recordset);

	// Render row
	$admin_delete->renderRow();
?>
	<tr<?php echo $admin->rowAttributes() ?>>
<?php if ($admin->username->Visible) { // username ?>
		<td<?php echo $admin->username->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCnt ?>_admin_username" class="admin_username">
<span<?php echo $admin->username->viewAttributes() ?>>
<?php echo $admin->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin->password->Visible) { // password ?>
		<td<?php echo $admin->password->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCnt ?>_admin_password" class="admin_password">
<span<?php echo $admin->password->viewAttributes() ?>>
<?php echo $admin->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin->level->Visible) { // level ?>
		<td<?php echo $admin->level->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCnt ?>_admin_level" class="admin_level">
<span<?php echo $admin->level->viewAttributes() ?>>
<?php echo $admin->level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin->locked->Visible) { // locked ?>
		<td<?php echo $admin->locked->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCnt ?>_admin_locked" class="admin_locked">
<span<?php echo $admin->locked->viewAttributes() ?>>
<?php echo $admin->locked->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin->_email->Visible) { // email ?>
		<td<?php echo $admin->_email->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCnt ?>_admin__email" class="admin__email">
<span<?php echo $admin->_email->viewAttributes() ?>>
<?php echo $admin->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($admin->activated->Visible) { // activated ?>
		<td<?php echo $admin->activated->cellAttributes() ?>>
<span id="el<?php echo $admin_delete->RowCnt ?>_admin_activated" class="admin_activated">
<span<?php echo $admin->activated->viewAttributes() ?>>
<?php echo $admin->activated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$admin_delete->Recordset->moveNext();
}
$admin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$admin_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$admin_delete->terminate();
?>
