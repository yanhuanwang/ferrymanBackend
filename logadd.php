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
$log_add = new log_add();

// Run the page
$log_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var flogadd = currentForm = new ew.Form("flogadd", "add");

// Validate form
flogadd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($log_add->ip_addr->Required) { ?>
			elm = this.getElements("x" + infix + "_ip_addr");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log->ip_addr->caption(), $log->ip_addr->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($log_add->mobile_phone->Required) { ?>
			elm = this.getElements("x" + infix + "_mobile_phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log->mobile_phone->caption(), $log->mobile_phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($log_add->event->Required) { ?>
			elm = this.getElements("x" + infix + "_event");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log->event->caption(), $log->event->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($log_add->detail->Required) { ?>
			elm = this.getElements("x" + infix + "_detail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log->detail->caption(), $log->detail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($log_add->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log->createdAt->caption(), $log->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($log->createdAt->errorMessage()) ?>");
		<?php if ($log_add->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log->updatedAt->caption(), $log->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($log->updatedAt->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
flogadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flogadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $log_add->showPageHeader(); ?>
<?php
$log_add->showMessage();
?>
<form name="flogadd" id="flogadd" class="<?php echo $log_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($log_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $log_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$log_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($log->ip_addr->Visible) { // ip_addr ?>
	<div id="r_ip_addr" class="form-group row">
		<label id="elh_log_ip_addr" for="x_ip_addr" class="<?php echo $log_add->LeftColumnClass ?>"><?php echo $log->ip_addr->caption() ?><?php echo ($log->ip_addr->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_add->RightColumnClass ?>"><div<?php echo $log->ip_addr->cellAttributes() ?>>
<span id="el_log_ip_addr">
<input type="text" data-table="log" data-field="x_ip_addr" name="x_ip_addr" id="x_ip_addr" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($log->ip_addr->getPlaceHolder()) ?>" value="<?php echo $log->ip_addr->EditValue ?>"<?php echo $log->ip_addr->editAttributes() ?>>
</span>
<?php echo $log->ip_addr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log->mobile_phone->Visible) { // mobile_phone ?>
	<div id="r_mobile_phone" class="form-group row">
		<label id="elh_log_mobile_phone" for="x_mobile_phone" class="<?php echo $log_add->LeftColumnClass ?>"><?php echo $log->mobile_phone->caption() ?><?php echo ($log->mobile_phone->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_add->RightColumnClass ?>"><div<?php echo $log->mobile_phone->cellAttributes() ?>>
<span id="el_log_mobile_phone">
<input type="text" data-table="log" data-field="x_mobile_phone" name="x_mobile_phone" id="x_mobile_phone" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($log->mobile_phone->getPlaceHolder()) ?>" value="<?php echo $log->mobile_phone->EditValue ?>"<?php echo $log->mobile_phone->editAttributes() ?>>
</span>
<?php echo $log->mobile_phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log->event->Visible) { // event ?>
	<div id="r_event" class="form-group row">
		<label id="elh_log_event" for="x_event" class="<?php echo $log_add->LeftColumnClass ?>"><?php echo $log->event->caption() ?><?php echo ($log->event->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_add->RightColumnClass ?>"><div<?php echo $log->event->cellAttributes() ?>>
<span id="el_log_event">
<input type="text" data-table="log" data-field="x_event" name="x_event" id="x_event" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($log->event->getPlaceHolder()) ?>" value="<?php echo $log->event->EditValue ?>"<?php echo $log->event->editAttributes() ?>>
</span>
<?php echo $log->event->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log->detail->Visible) { // detail ?>
	<div id="r_detail" class="form-group row">
		<label id="elh_log_detail" for="x_detail" class="<?php echo $log_add->LeftColumnClass ?>"><?php echo $log->detail->caption() ?><?php echo ($log->detail->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_add->RightColumnClass ?>"><div<?php echo $log->detail->cellAttributes() ?>>
<span id="el_log_detail">
<input type="text" data-table="log" data-field="x_detail" name="x_detail" id="x_detail" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($log->detail->getPlaceHolder()) ?>" value="<?php echo $log->detail->EditValue ?>"<?php echo $log->detail->editAttributes() ?>>
</span>
<?php echo $log->detail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_log_createdAt" for="x_createdAt" class="<?php echo $log_add->LeftColumnClass ?>"><?php echo $log->createdAt->caption() ?><?php echo ($log->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_add->RightColumnClass ?>"><div<?php echo $log->createdAt->cellAttributes() ?>>
<span id="el_log_createdAt">
<input type="text" data-table="log" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($log->createdAt->getPlaceHolder()) ?>" value="<?php echo $log->createdAt->EditValue ?>"<?php echo $log->createdAt->editAttributes() ?>>
<?php if (!$log->createdAt->ReadOnly && !$log->createdAt->Disabled && !isset($log->createdAt->EditAttrs["readonly"]) && !isset($log->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("flogadd", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $log->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_log_updatedAt" for="x_updatedAt" class="<?php echo $log_add->LeftColumnClass ?>"><?php echo $log->updatedAt->caption() ?><?php echo ($log->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_add->RightColumnClass ?>"><div<?php echo $log->updatedAt->cellAttributes() ?>>
<span id="el_log_updatedAt">
<input type="text" data-table="log" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($log->updatedAt->getPlaceHolder()) ?>" value="<?php echo $log->updatedAt->EditValue ?>"<?php echo $log->updatedAt->editAttributes() ?>>
<?php if (!$log->updatedAt->ReadOnly && !$log->updatedAt->Disabled && !isset($log->updatedAt->EditAttrs["readonly"]) && !isset($log->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("flogadd", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $log->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$log_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $log_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $log_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$log_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$log_add->terminate();
?>
