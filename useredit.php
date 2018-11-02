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
$user_edit = new user_edit();

// Run the page
$user_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fuseredit = currentForm = new ew.Form("fuseredit", "edit");

// Validate form
fuseredit.validate = function() {
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
		<?php if ($user_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->id->caption(), $user->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->username->caption(), $user->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->_email->caption(), $user->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->gender->Required) { ?>
			elm = this.getElements("x" + infix + "_gender");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->gender->caption(), $user->gender->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->phone->Required) { ?>
			elm = this.getElements("x" + infix + "_phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->phone->caption(), $user->phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->address->Required) { ?>
			elm = this.getElements("x" + infix + "_address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->address->caption(), $user->address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->country->Required) { ?>
			elm = this.getElements("x" + infix + "_country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->country->caption(), $user->country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->photo->Required) { ?>
			felm = this.getElements("x" + infix + "_photo");
			elm = this.getElements("fn_x" + infix + "_photo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $user->photo->caption(), $user->photo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->nickname->Required) { ?>
			elm = this.getElements("x" + infix + "_nickname");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->nickname->caption(), $user->nickname->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->region->Required) { ?>
			elm = this.getElements("x" + infix + "_region");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->region->caption(), $user->region->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->locked->Required) { ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->locked->caption(), $user->locked->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->send_role->Required) { ?>
			elm = this.getElements("x" + infix + "_send_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->send_role->caption(), $user->send_role->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->carrier_role->Required) { ?>
			elm = this.getElements("x" + infix + "_carrier_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->carrier_role->caption(), $user->carrier_role->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->birthday->Required) { ?>
			elm = this.getElements("x" + infix + "_birthday");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->birthday->caption(), $user->birthday->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->addDate->Required) { ?>
			elm = this.getElements("x" + infix + "_addDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->addDate->caption(), $user->addDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->updateDate->Required) { ?>
			elm = this.getElements("x" + infix + "_updateDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->updateDate->caption(), $user->updateDate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_edit->activated->Required) { ?>
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
fuseredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuseredit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuseredit.lists["x_gender"] = <?php echo $user_edit->gender->Lookup->toClientList() ?>;
fuseredit.lists["x_gender"].options = <?php echo JsonEncode($user_edit->gender->options(FALSE, TRUE)) ?>;
fuseredit.lists["x_locked"] = <?php echo $user_edit->locked->Lookup->toClientList() ?>;
fuseredit.lists["x_locked"].options = <?php echo JsonEncode($user_edit->locked->options(FALSE, TRUE)) ?>;
fuseredit.lists["x_send_role"] = <?php echo $user_edit->send_role->Lookup->toClientList() ?>;
fuseredit.lists["x_send_role"].options = <?php echo JsonEncode($user_edit->send_role->options(FALSE, TRUE)) ?>;
fuseredit.lists["x_carrier_role"] = <?php echo $user_edit->carrier_role->Lookup->toClientList() ?>;
fuseredit.lists["x_carrier_role"].options = <?php echo JsonEncode($user_edit->carrier_role->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $user_edit->showPageHeader(); ?>
<?php
$user_edit->showMessage();
?>
<?php if (!$user_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($user_edit->Pager)) $user_edit->Pager = new NumericPager($user_edit->StartRec, $user_edit->DisplayRecs, $user_edit->TotalRecs, $user_edit->RecRange, $user_edit->AutoHidePager) ?>
<?php if ($user_edit->Pager->RecordCount > 0 && $user_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fuseredit" id="fuseredit" class="<?php echo $user_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$user_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($user->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_user_id" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->id->caption() ?><?php echo ($user->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->id->cellAttributes() ?>>
<span id="el_user_id">
<span<?php echo $user->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($user->id->CurrentValue) ?>">
<?php echo $user->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_user_username" for="x_username" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->username->caption() ?><?php echo ($user->username->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->username->cellAttributes() ?>>
<span id="el_user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->username->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="x_username" id="x_username" value="<?php echo HtmlEncode($user->username->CurrentValue) ?>">
<?php echo $user->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_user__email" for="x__email" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->_email->caption() ?><?php echo ($user->_email->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->_email->cellAttributes() ?>>
<span id="el_user__email">
<span<?php echo $user->_email->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->_email->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x__email" name="x__email" id="x__email" value="<?php echo HtmlEncode($user->_email->CurrentValue) ?>">
<?php echo $user->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_user_gender" for="x_gender" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->gender->caption() ?><?php echo ($user->gender->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->gender->cellAttributes() ?>>
<span id="el_user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->gender->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="x_gender" id="x_gender" value="<?php echo HtmlEncode($user->gender->CurrentValue) ?>">
<?php echo $user->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group row">
		<label id="elh_user_phone" for="x_phone" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->phone->caption() ?><?php echo ($user->phone->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->phone->cellAttributes() ?>>
<span id="el_user_phone">
<span<?php echo $user->phone->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->phone->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_phone" name="x_phone" id="x_phone" value="<?php echo HtmlEncode($user->phone->CurrentValue) ?>">
<?php echo $user->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_user_address" for="x_address" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->address->caption() ?><?php echo ($user->address->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->address->cellAttributes() ?>>
<span id="el_user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->address->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="x_address" id="x_address" value="<?php echo HtmlEncode($user->address->CurrentValue) ?>">
<?php echo $user->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
	<div id="r_country" class="form-group row">
		<label id="elh_user_country" for="x_country" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->country->caption() ?><?php echo ($user->country->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->country->cellAttributes() ?>>
<span id="el_user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->country->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="x_country" id="x_country" value="<?php echo HtmlEncode($user->country->CurrentValue) ?>">
<?php echo $user->country->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_user_photo" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->photo->caption() ?><?php echo ($user->photo->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->photo->cellAttributes() ?>>
<span id="el_user_photo">
<span>
<?php echo GetFileViewTag($user->photo, $user->photo->EditValue) ?>
</span>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="x_photo" id="x_photo" value="<?php echo HtmlEncode($user->photo->CurrentValue) ?>">
<?php echo $user->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
	<div id="r_nickname" class="form-group row">
		<label id="elh_user_nickname" for="x_nickname" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->nickname->caption() ?><?php echo ($user->nickname->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->nickname->cellAttributes() ?>>
<span id="el_user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->nickname->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="x_nickname" id="x_nickname" value="<?php echo HtmlEncode($user->nickname->CurrentValue) ?>">
<?php echo $user->nickname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
	<div id="r_region" class="form-group row">
		<label id="elh_user_region" for="x_region" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->region->caption() ?><?php echo ($user->region->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->region->cellAttributes() ?>>
<span id="el_user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->region->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="x_region" id="x_region" value="<?php echo HtmlEncode($user->region->CurrentValue) ?>">
<?php echo $user->region->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
	<div id="r_locked" class="form-group row">
		<label id="elh_user_locked" for="x_locked" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->locked->caption() ?><?php echo ($user->locked->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->locked->cellAttributes() ?>>
<span id="el_user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x_locked" name="x_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x_locked") ?>
	</select>
</div>
</span>
<?php echo $user->locked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
	<div id="r_send_role" class="form-group row">
		<label id="elh_user_send_role" for="x_send_role" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->send_role->caption() ?><?php echo ($user->send_role->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->send_role->cellAttributes() ?>>
<span id="el_user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x_send_role" name="x_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x_send_role") ?>
	</select>
</div>
</span>
<?php echo $user->send_role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
	<div id="r_carrier_role" class="form-group row">
		<label id="elh_user_carrier_role" for="x_carrier_role" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->carrier_role->caption() ?><?php echo ($user->carrier_role->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->carrier_role->cellAttributes() ?>>
<span id="el_user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x_carrier_role" name="x_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x_carrier_role") ?>
	</select>
</div>
</span>
<?php echo $user->carrier_role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
	<div id="r_birthday" class="form-group row">
		<label id="elh_user_birthday" for="x_birthday" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->birthday->caption() ?><?php echo ($user->birthday->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->birthday->cellAttributes() ?>>
<span id="el_user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->birthday->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_birthday" name="x_birthday" id="x_birthday" value="<?php echo HtmlEncode($user->birthday->CurrentValue) ?>">
<?php echo $user->birthday->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->addDate->Visible) { // addDate ?>
	<div id="r_addDate" class="form-group row">
		<label id="elh_user_addDate" for="x_addDate" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->addDate->caption() ?><?php echo ($user->addDate->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->addDate->cellAttributes() ?>>
<span id="el_user_addDate">
<span<?php echo $user->addDate->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->addDate->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_addDate" name="x_addDate" id="x_addDate" value="<?php echo HtmlEncode($user->addDate->CurrentValue) ?>">
<?php echo $user->addDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
	<div id="r_activated" class="form-group row">
		<label id="elh_user_activated" for="x_activated" class="<?php echo $user_edit->LeftColumnClass ?>"><?php echo $user->activated->caption() ?><?php echo ($user->activated->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_edit->RightColumnClass ?>"><div<?php echo $user->activated->cellAttributes() ?>>
<span id="el_user_activated">
<input type="text" data-table="user" data-field="x_activated" name="x_activated" id="x_activated" size="30" placeholder="<?php echo HtmlEncode($user->activated->getPlaceHolder()) ?>" value="<?php echo $user->activated->EditValue ?>"<?php echo $user->activated->editAttributes() ?>>
</span>
<?php echo $user->activated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($user->getCurrentDetailTable() <> "") { ?>
<?php
	$user_edit->DetailPages->ValidKeys = explode(",", $user->getCurrentDetailTable());
	$firstActiveDetailTable = $user_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="user_edit_details"><!-- tabs -->
	<ul class="<?php echo $user_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("image", explode(",", $user->getCurrentDetailTable())) && $image->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "image") {
			$firstActiveDetailTable = "image";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_edit->DetailPages->pageStyle("image") ?>" href="#tab_image" data-toggle="tab"><?php echo $Language->TablePhrase("image", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("trip_info", explode(",", $user->getCurrentDetailTable())) && $trip_info->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "trip_info") {
			$firstActiveDetailTable = "trip_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_edit->DetailPages->pageStyle("trip_info") ?>" href="#tab_trip_info" data-toggle="tab"><?php echo $Language->TablePhrase("trip_info", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("parcel_info", explode(",", $user->getCurrentDetailTable())) && $parcel_info->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info") {
			$firstActiveDetailTable = "parcel_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_edit->DetailPages->pageStyle("parcel_info") ?>" href="#tab_parcel_info" data-toggle="tab"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("orders", explode(",", $user->getCurrentDetailTable())) && $orders->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "orders") {
			$firstActiveDetailTable = "orders";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $user_edit->DetailPages->pageStyle("orders") ?>" href="#tab_orders" data-toggle="tab"><?php echo $Language->TablePhrase("orders", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("image", explode(",", $user->getCurrentDetailTable())) && $image->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "image")
			$firstActiveDetailTable = "image";
?>
		<div class="tab-pane<?php echo $user_edit->DetailPages->pageStyle("image") ?>" id="tab_image"><!-- page* -->
<?php include_once "imagegrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("trip_info", explode(",", $user->getCurrentDetailTable())) && $trip_info->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "trip_info")
			$firstActiveDetailTable = "trip_info";
?>
		<div class="tab-pane<?php echo $user_edit->DetailPages->pageStyle("trip_info") ?>" id="tab_trip_info"><!-- page* -->
<?php include_once "trip_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("parcel_info", explode(",", $user->getCurrentDetailTable())) && $parcel_info->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info")
			$firstActiveDetailTable = "parcel_info";
?>
		<div class="tab-pane<?php echo $user_edit->DetailPages->pageStyle("parcel_info") ?>" id="tab_parcel_info"><!-- page* -->
<?php include_once "parcel_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("orders", explode(",", $user->getCurrentDetailTable())) && $orders->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "orders")
			$firstActiveDetailTable = "orders";
?>
		<div class="tab-pane<?php echo $user_edit->DetailPages->pageStyle("orders") ?>" id="tab_orders"><!-- page* -->
<?php include_once "ordersgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$user_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$user_edit->IsModal) { ?>
<?php if (!isset($user_edit->Pager)) $user_edit->Pager = new NumericPager($user_edit->StartRec, $user_edit->DisplayRecs, $user_edit->TotalRecs, $user_edit->RecRange, $user_edit->AutoHidePager) ?>
<?php if ($user_edit->Pager->RecordCount > 0 && $user_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_edit->pageUrl() ?>start=<?php echo $user_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$user_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$user_edit->terminate();
?>
