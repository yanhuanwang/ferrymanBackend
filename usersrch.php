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
$user_search = new user_search();

// Run the page
$user_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($user_search->IsModal) { ?>
var fusersearch = currentAdvancedSearchForm = new ew.Form("fusersearch", "search");
<?php } else { ?>
var fusersearch = currentForm = new ew.Form("fusersearch", "search");
<?php } ?>

// Form_CustomValidate event
fusersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusersearch.lists["x_gender"] = <?php echo $user_search->gender->Lookup->toClientList() ?>;
fusersearch.lists["x_gender"].options = <?php echo JsonEncode($user_search->gender->options(FALSE, TRUE)) ?>;
fusersearch.lists["x_locked"] = <?php echo $user_search->locked->Lookup->toClientList() ?>;
fusersearch.lists["x_locked"].options = <?php echo JsonEncode($user_search->locked->options(FALSE, TRUE)) ?>;
fusersearch.lists["x_send_role"] = <?php echo $user_search->send_role->Lookup->toClientList() ?>;
fusersearch.lists["x_send_role"].options = <?php echo JsonEncode($user_search->send_role->options(FALSE, TRUE)) ?>;
fusersearch.lists["x_carrier_role"] = <?php echo $user_search->carrier_role->Lookup->toClientList() ?>;
fusersearch.lists["x_carrier_role"].options = <?php echo JsonEncode($user_search->carrier_role->options(FALSE, TRUE)) ?>;

// Form object for search
// Validate function for search

fusersearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($user->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_birthday");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($user->birthday->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_addDate");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($user->addDate->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_updateDate");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($user->updateDate->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_activated");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($user->activated->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $user_search->showPageHeader(); ?>
<?php
$user_search->showMessage();
?>
<form name="fusersearch" id="fusersearch" class="<?php echo $user_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$user_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($user->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_id"><?php echo $user->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->id->cellAttributes() ?>>
			<span id="el_user_id">
<input type="text" data-table="user" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($user->id->getPlaceHolder()) ?>" value="<?php echo $user->id->EditValue ?>"<?php echo $user->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label for="x_username" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_username"><?php echo $user->username->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_username" id="z_username" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->username->cellAttributes() ?>>
			<span id="el_user_username">
<input type="text" data-table="user" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label for="x__email" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user__email"><?php echo $user->_email->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__email" id="z__email" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->_email->cellAttributes() ?>>
			<span id="el_user__email">
<input type="text" data-table="user" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->_email->getPlaceHolder()) ?>" value="<?php echo $user->_email->EditValue ?>"<?php echo $user->_email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label for="x_gender" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_gender"><?php echo $user->gender->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_gender" id="z_gender" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->gender->cellAttributes() ?>>
			<span id="el_user_gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_gender" data-value-separator="<?php echo $user->gender->displayValueSeparatorAttribute() ?>" id="x_gender" name="x_gender"<?php echo $user->gender->editAttributes() ?>>
		<?php echo $user->gender->selectOptionListHtml("x_gender") ?>
	</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label for="x_phone" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_phone"><?php echo $user->phone->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_phone" id="z_phone" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->phone->cellAttributes() ?>>
			<span id="el_user_phone">
<input type="text" data-table="user" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->phone->getPlaceHolder()) ?>" value="<?php echo $user->phone->EditValue ?>"<?php echo $user->phone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label for="x_address" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_address"><?php echo $user->address->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_address" id="z_address" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->address->cellAttributes() ?>>
			<span id="el_user_address">
<input type="text" data-table="user" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
	<div id="r_country" class="form-group row">
		<label for="x_country" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_country"><?php echo $user->country->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_country" id="z_country" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->country->cellAttributes() ?>>
			<span id="el_user_country">
<input type="text" data-table="user" data-field="x_country" name="x_country" id="x_country" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_photo"><?php echo $user->photo->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_photo" id="z_photo" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->photo->cellAttributes() ?>>
			<span id="el_user_photo">
<input type="text" data-table="user" data-field="x_photo" name="x_photo" id="x_photo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->photo->getPlaceHolder()) ?>" value="<?php echo $user->photo->EditValue ?>"<?php echo $user->photo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
	<div id="r_nickname" class="form-group row">
		<label for="x_nickname" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_nickname"><?php echo $user->nickname->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_nickname" id="z_nickname" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->nickname->cellAttributes() ?>>
			<span id="el_user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x_nickname" id="x_nickname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
	<div id="r_region" class="form-group row">
		<label for="x_region" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_region"><?php echo $user->region->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_region" id="z_region" value="LIKE"></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->region->cellAttributes() ?>>
			<span id="el_user_region">
<input type="text" data-table="user" data-field="x_region" name="x_region" id="x_region" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
	<div id="r_locked" class="form-group row">
		<label for="x_locked" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_locked"><?php echo $user->locked->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_locked" id="z_locked" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->locked->cellAttributes() ?>>
			<span id="el_user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x_locked" name="x_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x_locked") ?>
	</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
	<div id="r_send_role" class="form-group row">
		<label for="x_send_role" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_send_role"><?php echo $user->send_role->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_send_role" id="z_send_role" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->send_role->cellAttributes() ?>>
			<span id="el_user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x_send_role" name="x_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x_send_role") ?>
	</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
	<div id="r_carrier_role" class="form-group row">
		<label for="x_carrier_role" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_carrier_role"><?php echo $user->carrier_role->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_carrier_role" id="z_carrier_role" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->carrier_role->cellAttributes() ?>>
			<span id="el_user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x_carrier_role" name="x_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x_carrier_role") ?>
	</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
	<div id="r_birthday" class="form-group row">
		<label for="x_birthday" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_birthday"><?php echo $user->birthday->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_birthday" id="z_birthday" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->birthday->cellAttributes() ?>>
			<span id="el_user_birthday">
<input type="text" data-table="user" data-field="x_birthday" name="x_birthday" id="x_birthday" placeholder="<?php echo HtmlEncode($user->birthday->getPlaceHolder()) ?>" value="<?php echo $user->birthday->EditValue ?>"<?php echo $user->birthday->editAttributes() ?>>
<?php if (!$user->birthday->ReadOnly && !$user->birthday->Disabled && !isset($user->birthday->EditAttrs["readonly"]) && !isset($user->birthday->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fusersearch", "x_birthday", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->addDate->Visible) { // addDate ?>
	<div id="r_addDate" class="form-group row">
		<label for="x_addDate" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_addDate"><?php echo $user->addDate->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_addDate" id="z_addDate" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->addDate->cellAttributes() ?>>
			<span id="el_user_addDate">
<input type="text" data-table="user" data-field="x_addDate" name="x_addDate" id="x_addDate" placeholder="<?php echo HtmlEncode($user->addDate->getPlaceHolder()) ?>" value="<?php echo $user->addDate->EditValue ?>"<?php echo $user->addDate->editAttributes() ?>>
<?php if (!$user->addDate->ReadOnly && !$user->addDate->Disabled && !isset($user->addDate->EditAttrs["readonly"]) && !isset($user->addDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fusersearch", "x_addDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->updateDate->Visible) { // updateDate ?>
	<div id="r_updateDate" class="form-group row">
		<label for="x_updateDate" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_updateDate"><?php echo $user->updateDate->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_updateDate" id="z_updateDate" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->updateDate->cellAttributes() ?>>
			<span id="el_user_updateDate">
<input type="text" data-table="user" data-field="x_updateDate" name="x_updateDate" id="x_updateDate" placeholder="<?php echo HtmlEncode($user->updateDate->getPlaceHolder()) ?>" value="<?php echo $user->updateDate->EditValue ?>"<?php echo $user->updateDate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
	<div id="r_activated" class="form-group row">
		<label for="x_activated" class="<?php echo $user_search->LeftColumnClass ?>"><span id="elh_user_activated"><?php echo $user->activated->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_activated" id="z_activated" value="="></span>
		</label>
		<div class="<?php echo $user_search->RightColumnClass ?>"><div<?php echo $user->activated->cellAttributes() ?>>
			<span id="el_user_activated">
<input type="text" data-table="user" data-field="x_activated" name="x_activated" id="x_activated" size="30" placeholder="<?php echo HtmlEncode($user->activated->getPlaceHolder()) ?>" value="<?php echo $user->activated->EditValue ?>"<?php echo $user->activated->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$user_search->terminate();
?>
