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
$user_add = new user_add();

// Run the page
$user_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fuseradd = currentForm = new ew.Form("fuseradd", "add");

// Validate form
fuseradd.validate = function() {
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
		<?php if ($user_add->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->username->caption(), $user->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->password->caption(), $user->password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->_email->caption(), $user->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.checkEmail(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user->_email->errorMessage()) ?>");
		<?php if ($user_add->gender->Required) { ?>
			elm = this.getElements("x" + infix + "_gender");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->gender->caption(), $user->gender->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->phone->Required) { ?>
			elm = this.getElements("x" + infix + "_phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->phone->caption(), $user->phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->address->Required) { ?>
			elm = this.getElements("x" + infix + "_address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->address->caption(), $user->address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->country->Required) { ?>
			elm = this.getElements("x" + infix + "_country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->country->caption(), $user->country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->photo->Required) { ?>
			felm = this.getElements("x" + infix + "_photo");
			elm = this.getElements("fn_x" + infix + "_photo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $user->photo->caption(), $user->photo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->nickname->Required) { ?>
			elm = this.getElements("x" + infix + "_nickname");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->nickname->caption(), $user->nickname->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->region->Required) { ?>
			elm = this.getElements("x" + infix + "_region");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->region->caption(), $user->region->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->locked->Required) { ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->locked->caption(), $user->locked->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->send_role->Required) { ?>
			elm = this.getElements("x" + infix + "_send_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->send_role->caption(), $user->send_role->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->carrier_role->Required) { ?>
			elm = this.getElements("x" + infix + "_carrier_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->carrier_role->caption(), $user->carrier_role->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_add->birthday->Required) { ?>
			elm = this.getElements("x" + infix + "_birthday");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->birthday->caption(), $user->birthday->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_birthday");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user->birthday->errorMessage()) ?>");
		<?php if ($user_add->activated->Required) { ?>
			elm = this.getElements("x" + infix + "_activated");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->activated->caption(), $user->activated->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_activated");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user->activated->errorMessage()) ?>");

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
fuseradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuseradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuseradd.lists["x_gender"] = <?php echo $user_add->gender->Lookup->toClientList() ?>;
fuseradd.lists["x_gender"].options = <?php echo JsonEncode($user_add->gender->options(FALSE, TRUE)) ?>;
fuseradd.lists["x_locked"] = <?php echo $user_add->locked->Lookup->toClientList() ?>;
fuseradd.lists["x_locked"].options = <?php echo JsonEncode($user_add->locked->options(FALSE, TRUE)) ?>;
fuseradd.lists["x_send_role"] = <?php echo $user_add->send_role->Lookup->toClientList() ?>;
fuseradd.lists["x_send_role"].options = <?php echo JsonEncode($user_add->send_role->options(FALSE, TRUE)) ?>;
fuseradd.lists["x_carrier_role"] = <?php echo $user_add->carrier_role->Lookup->toClientList() ?>;
fuseradd.lists["x_carrier_role"].options = <?php echo JsonEncode($user_add->carrier_role->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $user_add->showPageHeader(); ?>
<?php
$user_add->showMessage();
?>
<form name="fuseradd" id="fuseradd" class="<?php echo $user_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<?php if ($user->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$user_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($user->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_username" for="x_username" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->username->caption() ?><?php echo ($user->username->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->username->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_username">
<input type="text" data-table="user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->username->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="x_username" id="x_username" value="<?php echo HtmlEncode($user->username->FormValue) ?>">
<?php } ?>
<?php echo $user->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_user_password" for="x_password" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->password->caption() ?><?php echo ($user->password->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->password->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_password">
<input type="text" data-table="user" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->password->getPlaceHolder()) ?>" value="<?php echo $user->password->EditValue ?>"<?php echo $user->password->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_password">
<span<?php echo $user->password->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->password->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_password" name="x_password" id="x_password" value="<?php echo HtmlEncode($user->password->FormValue) ?>">
<?php } ?>
<?php echo $user->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_user__email" for="x__email" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->_email->caption() ?><?php echo ($user->_email->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->_email->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user__email">
<input type="text" data-table="user" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->_email->getPlaceHolder()) ?>" value="<?php echo $user->_email->EditValue ?>"<?php echo $user->_email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user__email">
<span<?php echo $user->_email->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->_email->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x__email" name="x__email" id="x__email" value="<?php echo HtmlEncode($user->_email->FormValue) ?>">
<?php } ?>
<?php echo $user->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_user_gender" for="x_gender" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->gender->caption() ?><?php echo ($user->gender->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->gender->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_gender" data-value-separator="<?php echo $user->gender->displayValueSeparatorAttribute() ?>" id="x_gender" name="x_gender"<?php echo $user->gender->editAttributes() ?>>
		<?php echo $user->gender->selectOptionListHtml("x_gender") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->gender->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="x_gender" id="x_gender" value="<?php echo HtmlEncode($user->gender->FormValue) ?>">
<?php } ?>
<?php echo $user->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label id="elh_user_phone" for="x_phone" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->phone->caption() ?><?php echo ($user->phone->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->phone->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_phone">
<input type="text" data-table="user" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->phone->getPlaceHolder()) ?>" value="<?php echo $user->phone->EditValue ?>"<?php echo $user->phone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_phone">
<span<?php echo $user->phone->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->phone->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_phone" name="x_phone" id="x_phone" value="<?php echo HtmlEncode($user->phone->FormValue) ?>">
<?php } ?>
<?php echo $user->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_user_address" for="x_address" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->address->caption() ?><?php echo ($user->address->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->address->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_address">
<input type="text" data-table="user" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->address->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="x_address" id="x_address" value="<?php echo HtmlEncode($user->address->FormValue) ?>">
<?php } ?>
<?php echo $user->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
	<div id="r_country" class="form-group row">
		<label id="elh_user_country" for="x_country" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->country->caption() ?><?php echo ($user->country->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->country->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_country">
<input type="text" data-table="user" data-field="x_country" name="x_country" id="x_country" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->country->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="x_country" id="x_country" value="<?php echo HtmlEncode($user->country->FormValue) ?>">
<?php } ?>
<?php echo $user->country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_user_photo" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->photo->caption() ?><?php echo ($user->photo->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->photo->cellAttributes() ?>>
<span id="el_user_photo">
<div id="fd_x_photo">
<span title="<?php echo $user->photo->title() ? $user->photo->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($user->photo->ReadOnly || $user->photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="user" data-field="x_photo" name="x_photo" id="x_photo"<?php echo $user->photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?php echo $user->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<input type="hidden" name="fs_x_photo" id= "fs_x_photo" value="100">
<input type="hidden" name="fx_x_photo" id= "fx_x_photo" value="<?php echo $user->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo" id= "fm_x_photo" value="<?php echo $user->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $user->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
	<div id="r_nickname" class="form-group row">
		<label id="elh_user_nickname" for="x_nickname" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->nickname->caption() ?><?php echo ($user->nickname->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->nickname->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x_nickname" id="x_nickname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->nickname->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="x_nickname" id="x_nickname" value="<?php echo HtmlEncode($user->nickname->FormValue) ?>">
<?php } ?>
<?php echo $user->nickname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
	<div id="r_region" class="form-group row">
		<label id="elh_user_region" for="x_region" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->region->caption() ?><?php echo ($user->region->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->region->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_region">
<input type="text" data-table="user" data-field="x_region" name="x_region" id="x_region" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->region->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="x_region" id="x_region" value="<?php echo HtmlEncode($user->region->FormValue) ?>">
<?php } ?>
<?php echo $user->region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
	<div id="r_locked" class="form-group row">
		<label id="elh_user_locked" for="x_locked" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->locked->caption() ?><?php echo ($user->locked->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->locked->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x_locked" name="x_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x_locked") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_user_locked">
<span<?php echo $user->locked->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->locked->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_locked" name="x_locked" id="x_locked" value="<?php echo HtmlEncode($user->locked->FormValue) ?>">
<?php } ?>
<?php echo $user->locked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
	<div id="r_send_role" class="form-group row">
		<label id="elh_user_send_role" for="x_send_role" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->send_role->caption() ?><?php echo ($user->send_role->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->send_role->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x_send_role" name="x_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x_send_role") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_user_send_role">
<span<?php echo $user->send_role->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->send_role->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_send_role" name="x_send_role" id="x_send_role" value="<?php echo HtmlEncode($user->send_role->FormValue) ?>">
<?php } ?>
<?php echo $user->send_role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
	<div id="r_carrier_role" class="form-group row">
		<label id="elh_user_carrier_role" for="x_carrier_role" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->carrier_role->caption() ?><?php echo ($user->carrier_role->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->carrier_role->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x_carrier_role" name="x_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x_carrier_role") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el_user_carrier_role">
<span<?php echo $user->carrier_role->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->carrier_role->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="x_carrier_role" id="x_carrier_role" value="<?php echo HtmlEncode($user->carrier_role->FormValue) ?>">
<?php } ?>
<?php echo $user->carrier_role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
	<div id="r_birthday" class="form-group row">
		<label id="elh_user_birthday" for="x_birthday" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->birthday->caption() ?><?php echo ($user->birthday->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->birthday->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_birthday">
<input type="text" data-table="user" data-field="x_birthday" name="x_birthday" id="x_birthday" placeholder="<?php echo HtmlEncode($user->birthday->getPlaceHolder()) ?>" value="<?php echo $user->birthday->EditValue ?>"<?php echo $user->birthday->editAttributes() ?>>
<?php if (!$user->birthday->ReadOnly && !$user->birthday->Disabled && !isset($user->birthday->EditAttrs["readonly"]) && !isset($user->birthday->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuseradd", "x_birthday", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->birthday->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_birthday" name="x_birthday" id="x_birthday" value="<?php echo HtmlEncode($user->birthday->FormValue) ?>">
<?php } ?>
<?php echo $user->birthday->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
	<div id="r_activated" class="form-group row">
		<label id="elh_user_activated" for="x_activated" class="<?php echo $user_add->LeftColumnClass ?>"><?php echo $user->activated->caption() ?><?php echo ($user->activated->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_add->RightColumnClass ?>"><div<?php echo $user->activated->cellAttributes() ?>>
<?php if (!$user->isConfirm()) { ?>
<span id="el_user_activated">
<input type="text" data-table="user" data-field="x_activated" name="x_activated" id="x_activated" size="30" placeholder="<?php echo HtmlEncode($user->activated->getPlaceHolder()) ?>" value="<?php echo $user->activated->EditValue ?>"<?php echo $user->activated->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_user_activated">
<span<?php echo $user->activated->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->activated->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_activated" name="x_activated" id="x_activated" value="<?php echo HtmlEncode($user->activated->FormValue) ?>">
<?php } ?>
<?php echo $user->activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($user->getCurrentDetailTable() <> "") { ?>
<?php
	$user_add->DetailPages->ValidKeys = explode(",", $user->getCurrentDetailTable());
	$firstActiveDetailTable = $user_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="user_add_details"><!-- tabs -->
	<ul class="<?php echo $user_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("image", explode(",", $user->getCurrentDetailTable())) && $image->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "image") {
			$firstActiveDetailTable = "image";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_add->DetailPages->pageStyle("image") ?>" href="#tab_image" data-toggle="tab"><?php echo $Language->TablePhrase("image", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("trip_info", explode(",", $user->getCurrentDetailTable())) && $trip_info->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "trip_info") {
			$firstActiveDetailTable = "trip_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_add->DetailPages->pageStyle("trip_info") ?>" href="#tab_trip_info" data-toggle="tab"><?php echo $Language->TablePhrase("trip_info", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("parcel_info", explode(",", $user->getCurrentDetailTable())) && $parcel_info->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info") {
			$firstActiveDetailTable = "parcel_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_add->DetailPages->pageStyle("parcel_info") ?>" href="#tab_parcel_info" data-toggle="tab"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("orders", explode(",", $user->getCurrentDetailTable())) && $orders->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "orders") {
			$firstActiveDetailTable = "orders";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_add->DetailPages->pageStyle("orders") ?>" href="#tab_orders" data-toggle="tab"><?php echo $Language->TablePhrase("orders", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("image", explode(",", $user->getCurrentDetailTable())) && $image->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "image")
			$firstActiveDetailTable = "image";
?>
		<div class="tab-pane<?php echo $user_add->DetailPages->pageStyle("image") ?>" id="tab_image"><!-- page* -->
<?php include_once "imagegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("trip_info", explode(",", $user->getCurrentDetailTable())) && $trip_info->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "trip_info")
			$firstActiveDetailTable = "trip_info";
?>
		<div class="tab-pane<?php echo $user_add->DetailPages->pageStyle("trip_info") ?>" id="tab_trip_info"><!-- page* -->
<?php include_once "trip_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("parcel_info", explode(",", $user->getCurrentDetailTable())) && $parcel_info->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info")
			$firstActiveDetailTable = "parcel_info";
?>
		<div class="tab-pane<?php echo $user_add->DetailPages->pageStyle("parcel_info") ?>" id="tab_parcel_info"><!-- page* -->
<?php include_once "parcel_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("orders", explode(",", $user->getCurrentDetailTable())) && $orders->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "orders")
			$firstActiveDetailTable = "orders";
?>
		<div class="tab-pane<?php echo $user_add->DetailPages->pageStyle("orders") ?>" id="tab_orders"><!-- page* -->
<?php include_once "ordersgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$user_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$user->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$user_add->terminate();
?>
