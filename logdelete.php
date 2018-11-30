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
$log_delete = new log_delete();

// Run the page
$log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var flogdelete = currentForm = new ew.Form("flogdelete", "delete");

// Form_CustomValidate event
flogdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flogdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $log_delete->showPageHeader(); ?>
<?php
$log_delete->showMessage();
?>
<form name="flogdelete" id="flogdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($log_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $log_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($log->id->Visible) { // id ?>
		<th class="<?php echo $log->id->headerCellClass() ?>"><span id="elh_log_id" class="log_id"><?php echo $log->id->caption() ?></span></th>
<?php } ?>
<?php if ($log->ip_addr->Visible) { // ip_addr ?>
		<th class="<?php echo $log->ip_addr->headerCellClass() ?>"><span id="elh_log_ip_addr" class="log_ip_addr"><?php echo $log->ip_addr->caption() ?></span></th>
<?php } ?>
<?php if ($log->mobile_phone->Visible) { // mobile_phone ?>
		<th class="<?php echo $log->mobile_phone->headerCellClass() ?>"><span id="elh_log_mobile_phone" class="log_mobile_phone"><?php echo $log->mobile_phone->caption() ?></span></th>
<?php } ?>
<?php if ($log->event->Visible) { // event ?>
		<th class="<?php echo $log->event->headerCellClass() ?>"><span id="elh_log_event" class="log_event"><?php echo $log->event->caption() ?></span></th>
<?php } ?>
<?php if ($log->detail->Visible) { // detail ?>
		<th class="<?php echo $log->detail->headerCellClass() ?>"><span id="elh_log_detail" class="log_detail"><?php echo $log->detail->caption() ?></span></th>
<?php } ?>
<?php if ($log->createdAt->Visible) { // createdAt ?>
		<th class="<?php echo $log->createdAt->headerCellClass() ?>"><span id="elh_log_createdAt" class="log_createdAt"><?php echo $log->createdAt->caption() ?></span></th>
<?php } ?>
<?php if ($log->updatedAt->Visible) { // updatedAt ?>
		<th class="<?php echo $log->updatedAt->headerCellClass() ?>"><span id="elh_log_updatedAt" class="log_updatedAt"><?php echo $log->updatedAt->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$log_delete->RecCnt = 0;
$i = 0;
while (!$log_delete->Recordset->EOF) {
	$log_delete->RecCnt++;
	$log_delete->RowCnt++;

	// Set row properties
	$log->resetAttributes();
	$log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$log_delete->loadRowValues($log_delete->Recordset);

	// Render row
	$log_delete->renderRow();
?>
	<tr<?php echo $log->rowAttributes() ?>>
<?php if ($log->id->Visible) { // id ?>
		<td<?php echo $log->id->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_id" class="log_id">
<span<?php echo $log->id->viewAttributes() ?>>
<?php echo $log->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log->ip_addr->Visible) { // ip_addr ?>
		<td<?php echo $log->ip_addr->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_ip_addr" class="log_ip_addr">
<span<?php echo $log->ip_addr->viewAttributes() ?>>
<?php echo $log->ip_addr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log->mobile_phone->Visible) { // mobile_phone ?>
		<td<?php echo $log->mobile_phone->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_mobile_phone" class="log_mobile_phone">
<span<?php echo $log->mobile_phone->viewAttributes() ?>>
<?php echo $log->mobile_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log->event->Visible) { // event ?>
		<td<?php echo $log->event->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_event" class="log_event">
<span<?php echo $log->event->viewAttributes() ?>>
<?php echo $log->event->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log->detail->Visible) { // detail ?>
		<td<?php echo $log->detail->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_detail" class="log_detail">
<span<?php echo $log->detail->viewAttributes() ?>>
<?php echo $log->detail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log->createdAt->Visible) { // createdAt ?>
		<td<?php echo $log->createdAt->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_createdAt" class="log_createdAt">
<span<?php echo $log->createdAt->viewAttributes() ?>>
<?php echo $log->createdAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log->updatedAt->Visible) { // updatedAt ?>
		<td<?php echo $log->updatedAt->cellAttributes() ?>>
<span id="el<?php echo $log_delete->RowCnt ?>_log_updatedAt" class="log_updatedAt">
<span<?php echo $log->updatedAt->viewAttributes() ?>>
<?php echo $log->updatedAt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$log_delete->Recordset->moveNext();
}
$log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $log_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$log_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$log_delete->terminate();
?>
