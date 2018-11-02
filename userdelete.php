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
$user_delete = new user_delete();

// Run the page
$user_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fuserdelete = currentForm = new ew.Form("fuserdelete", "delete");

// Form_CustomValidate event
fuserdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserdelete.lists["x_gender"] = <?php echo $user_delete->gender->Lookup->toClientList() ?>;
fuserdelete.lists["x_gender"].options = <?php echo JsonEncode($user_delete->gender->options(FALSE, TRUE)) ?>;
fuserdelete.lists["x_locked"] = <?php echo $user_delete->locked->Lookup->toClientList() ?>;
fuserdelete.lists["x_locked"].options = <?php echo JsonEncode($user_delete->locked->options(FALSE, TRUE)) ?>;
fuserdelete.lists["x_send_role"] = <?php echo $user_delete->send_role->Lookup->toClientList() ?>;
fuserdelete.lists["x_send_role"].options = <?php echo JsonEncode($user_delete->send_role->options(FALSE, TRUE)) ?>;
fuserdelete.lists["x_carrier_role"] = <?php echo $user_delete->carrier_role->Lookup->toClientList() ?>;
fuserdelete.lists["x_carrier_role"].options = <?php echo JsonEncode($user_delete->carrier_role->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $user_delete->showPageHeader(); ?>
<?php
$user_delete->showMessage();
?>
<form name="fuserdelete" id="fuserdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($user_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($user->username->Visible) { // username ?>
		<th class="<?php echo $user->username->headerCellClass() ?>"><span id="elh_user_username" class="user_username"><?php echo $user->username->caption() ?></span></th>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
		<th class="<?php echo $user->_email->headerCellClass() ?>"><span id="elh_user__email" class="user__email"><?php echo $user->_email->caption() ?></span></th>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
		<th class="<?php echo $user->gender->headerCellClass() ?>"><span id="elh_user_gender" class="user_gender"><?php echo $user->gender->caption() ?></span></th>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
		<th class="<?php echo $user->phone->headerCellClass() ?>"><span id="elh_user_phone" class="user_phone"><?php echo $user->phone->caption() ?></span></th>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
		<th class="<?php echo $user->address->headerCellClass() ?>"><span id="elh_user_address" class="user_address"><?php echo $user->address->caption() ?></span></th>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
		<th class="<?php echo $user->country->headerCellClass() ?>"><span id="elh_user_country" class="user_country"><?php echo $user->country->caption() ?></span></th>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
		<th class="<?php echo $user->photo->headerCellClass() ?>"><span id="elh_user_photo" class="user_photo"><?php echo $user->photo->caption() ?></span></th>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
		<th class="<?php echo $user->nickname->headerCellClass() ?>"><span id="elh_user_nickname" class="user_nickname"><?php echo $user->nickname->caption() ?></span></th>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
		<th class="<?php echo $user->region->headerCellClass() ?>"><span id="elh_user_region" class="user_region"><?php echo $user->region->caption() ?></span></th>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
		<th class="<?php echo $user->locked->headerCellClass() ?>"><span id="elh_user_locked" class="user_locked"><?php echo $user->locked->caption() ?></span></th>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
		<th class="<?php echo $user->send_role->headerCellClass() ?>"><span id="elh_user_send_role" class="user_send_role"><?php echo $user->send_role->caption() ?></span></th>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<th class="<?php echo $user->carrier_role->headerCellClass() ?>"><span id="elh_user_carrier_role" class="user_carrier_role"><?php echo $user->carrier_role->caption() ?></span></th>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
		<th class="<?php echo $user->birthday->headerCellClass() ?>"><span id="elh_user_birthday" class="user_birthday"><?php echo $user->birthday->caption() ?></span></th>
<?php } ?>
<?php if ($user->addDate->Visible) { // addDate ?>
		<th class="<?php echo $user->addDate->headerCellClass() ?>"><span id="elh_user_addDate" class="user_addDate"><?php echo $user->addDate->caption() ?></span></th>
<?php } ?>
<?php if ($user->updateDate->Visible) { // updateDate ?>
		<th class="<?php echo $user->updateDate->headerCellClass() ?>"><span id="elh_user_updateDate" class="user_updateDate"><?php echo $user->updateDate->caption() ?></span></th>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
		<th class="<?php echo $user->activated->headerCellClass() ?>"><span id="elh_user_activated" class="user_activated"><?php echo $user->activated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$user_delete->RecCnt = 0;
$i = 0;
while (!$user_delete->Recordset->EOF) {
	$user_delete->RecCnt++;
	$user_delete->RowCnt++;

	// Set row properties
	$user->resetAttributes();
	$user->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$user_delete->loadRowValues($user_delete->Recordset);

	// Render row
	$user_delete->renderRow();
?>
	<tr<?php echo $user->rowAttributes() ?>>
<?php if ($user->username->Visible) { // username ?>
		<td<?php echo $user->username->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_username" class="user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<?php echo $user->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
		<td<?php echo $user->_email->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user__email" class="user__email">
<span<?php echo $user->_email->viewAttributes() ?>>
<?php echo $user->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
		<td<?php echo $user->gender->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_gender" class="user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<?php echo $user->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
		<td<?php echo $user->phone->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_phone" class="user_phone">
<span<?php echo $user->phone->viewAttributes() ?>>
<?php echo $user->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
		<td<?php echo $user->address->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_address" class="user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<?php echo $user->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
		<td<?php echo $user->country->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_country" class="user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<?php echo $user->country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
		<td<?php echo $user->photo->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_photo" class="user_photo">
<span>
<?php echo GetFileViewTag($user->photo, $user->photo->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
		<td<?php echo $user->nickname->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_nickname" class="user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<?php echo $user->nickname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
		<td<?php echo $user->region->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_region" class="user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<?php echo $user->region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
		<td<?php echo $user->locked->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_locked" class="user_locked">
<span<?php echo $user->locked->viewAttributes() ?>>
<?php echo $user->locked->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
		<td<?php echo $user->send_role->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_send_role" class="user_send_role">
<span<?php echo $user->send_role->viewAttributes() ?>>
<?php echo $user->send_role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<td<?php echo $user->carrier_role->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_carrier_role" class="user_carrier_role">
<span<?php echo $user->carrier_role->viewAttributes() ?>>
<?php echo $user->carrier_role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
		<td<?php echo $user->birthday->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_birthday" class="user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<?php echo $user->birthday->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->addDate->Visible) { // addDate ?>
		<td<?php echo $user->addDate->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_addDate" class="user_addDate">
<span<?php echo $user->addDate->viewAttributes() ?>>
<?php echo $user->addDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->updateDate->Visible) { // updateDate ?>
		<td<?php echo $user->updateDate->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_updateDate" class="user_updateDate">
<span<?php echo $user->updateDate->viewAttributes() ?>>
<?php echo $user->updateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
		<td<?php echo $user->activated->cellAttributes() ?>>
<span id="el<?php echo $user_delete->RowCnt ?>_user_activated" class="user_activated">
<span<?php echo $user->activated->viewAttributes() ?>>
<?php echo $user->activated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$user_delete->Recordset->moveNext();
}
$user_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$user_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$user_delete->terminate();
?>
