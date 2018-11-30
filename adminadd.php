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
$admin_add = new admin_add();

// Run the page
$admin_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fadminadd = currentForm = new ew.Form("fadminadd", "add");

// Validate form
fadminadd.validate = function() {
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
		<?php if ($admin_add->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->username->caption(), $admin->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($admin_add->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->password->caption(), $admin->password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($admin_add->level->Required) { ?>
			elm = this.getElements("x" + infix + "_level");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->level->caption(), $admin->level->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_level");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($admin->level->errorMessage()) ?>");
		<?php if ($admin_add->locked->Required) { ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->locked->caption(), $admin->locked->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($admin->locked->errorMessage()) ?>");
		<?php if ($admin_add->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->_email->caption(), $admin->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($admin_add->activated->Required) { ?>
			elm = this.getElements("x" + infix + "_activated");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $admin->activated->caption(), $admin->activated->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_activated");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($admin->activated->errorMessage()) ?>");

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
fadminadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fadminadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $admin_add->showPageHeader(); ?>
<?php
$admin_add->showMessage();
?>
<form name="fadminadd" id="fadminadd" class="<?php echo $admin_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($admin_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $admin_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$admin_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($admin->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_admin_username" for="x_username" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin->username->caption() ?><?php echo ($admin->username->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div<?php echo $admin->username->cellAttributes() ?>>
<span id="el_admin_username">
<input type="text" data-table="admin" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->username->getPlaceHolder()) ?>" value="<?php echo $admin->username->EditValue ?>"<?php echo $admin->username->editAttributes() ?>>
</span>
<?php echo $admin->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_admin_password" for="x_password" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin->password->caption() ?><?php echo ($admin->password->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div<?php echo $admin->password->cellAttributes() ?>>
<span id="el_admin_password">
<input type="text" data-table="admin" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->password->getPlaceHolder()) ?>" value="<?php echo $admin->password->EditValue ?>"<?php echo $admin->password->editAttributes() ?>>
</span>
<?php echo $admin->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin->level->Visible) { // level ?>
	<div id="r_level" class="form-group row">
		<label id="elh_admin_level" for="x_level" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin->level->caption() ?><?php echo ($admin->level->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div<?php echo $admin->level->cellAttributes() ?>>
<span id="el_admin_level">
<input type="text" data-table="admin" data-field="x_level" name="x_level" id="x_level" size="30" placeholder="<?php echo HtmlEncode($admin->level->getPlaceHolder()) ?>" value="<?php echo $admin->level->EditValue ?>"<?php echo $admin->level->editAttributes() ?>>
</span>
<?php echo $admin->level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin->locked->Visible) { // locked ?>
	<div id="r_locked" class="form-group row">
		<label id="elh_admin_locked" for="x_locked" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin->locked->caption() ?><?php echo ($admin->locked->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div<?php echo $admin->locked->cellAttributes() ?>>
<span id="el_admin_locked">
<input type="text" data-table="admin" data-field="x_locked" name="x_locked" id="x_locked" size="30" placeholder="<?php echo HtmlEncode($admin->locked->getPlaceHolder()) ?>" value="<?php echo $admin->locked->EditValue ?>"<?php echo $admin->locked->editAttributes() ?>>
</span>
<?php echo $admin->locked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_admin__email" for="x__email" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin->_email->caption() ?><?php echo ($admin->_email->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div<?php echo $admin->_email->cellAttributes() ?>>
<span id="el_admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->_email->getPlaceHolder()) ?>" value="<?php echo $admin->_email->EditValue ?>"<?php echo $admin->_email->editAttributes() ?>>
</span>
<?php echo $admin->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($admin->activated->Visible) { // activated ?>
	<div id="r_activated" class="form-group row">
		<label id="elh_admin_activated" for="x_activated" class="<?php echo $admin_add->LeftColumnClass ?>"><?php echo $admin->activated->caption() ?><?php echo ($admin->activated->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $admin_add->RightColumnClass ?>"><div<?php echo $admin->activated->cellAttributes() ?>>
<span id="el_admin_activated">
<input type="text" data-table="admin" data-field="x_activated" name="x_activated" id="x_activated" size="30" placeholder="<?php echo HtmlEncode($admin->activated->getPlaceHolder()) ?>" value="<?php echo $admin->activated->EditValue ?>"<?php echo $admin->activated->editAttributes() ?>>
</span>
<?php echo $admin->activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$admin_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $admin_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $admin_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$admin_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$admin_add->terminate();
?>
