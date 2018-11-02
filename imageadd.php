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
$image_add = new image_add();

// Run the page
$image_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fimageadd = currentForm = new ew.Form("fimageadd", "add");

// Validate form
fimageadd.validate = function() {
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
		<?php if ($image_add->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->name->caption(), $image->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_add->_userid->Required) { ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->_userid->caption(), $image->_userid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->_userid->errorMessage()) ?>");
		<?php if ($image_add->path->Required) { ?>
			felm = this.getElements("x" + infix + "_path");
			elm = this.getElements("fn_x" + infix + "_path");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $image->path->caption(), $image->path->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->description->caption(), $image->description->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
		if (fobj.captcha && !ew.hasValue(fobj.captcha))
			return this.onError(fobj.captcha, ew.language.phrase("EnterValidateCode"));

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
fimageadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimageadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fimageadd.lists["x__userid"] = <?php echo $image_add->_userid->Lookup->toClientList() ?>;
fimageadd.lists["x__userid"].options = <?php echo JsonEncode($image_add->_userid->lookupOptions()) ?>;
fimageadd.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $image_add->showPageHeader(); ?>
<?php
$image_add->showMessage();
?>
<form name="fimageadd" id="fimageadd" class="<?php echo $image_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($image_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $image_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="image">
<?php if ($image->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$image_add->IsModal ?>">
<?php if ($image->getCurrentMasterTable() == "user") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $image->_userid->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($image->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_image_name" for="x_name" class="<?php echo $image_add->LeftColumnClass ?>"><?php echo $image->name->caption() ?><?php echo ($image->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_add->RightColumnClass ?>"><div<?php echo $image->name->cellAttributes() ?>>
<?php if (!$image->isConfirm()) { ?>
<span id="el_image_name">
<input type="text" data-table="image" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->name->getPlaceHolder()) ?>" value="<?php echo $image->name->EditValue ?>"<?php echo $image->name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_image_name">
<span<?php echo $image->name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x_name" name="x_name" id="x_name" value="<?php echo HtmlEncode($image->name->FormValue) ?>">
<?php } ?>
<?php echo $image->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->_userid->Visible) { // userid ?>
	<div id="r__userid" class="form-group row">
		<label id="elh_image__userid" class="<?php echo $image_add->LeftColumnClass ?>"><?php echo $image->_userid->caption() ?><?php echo ($image->_userid->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_add->RightColumnClass ?>"><div<?php echo $image->_userid->cellAttributes() ?>>
<?php if (!$image->isConfirm()) { ?>
<?php if ($image->_userid->getSessionValue() <> "") { ?>
<span id="el_image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x__userid" name="x__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_image__userid">
<?php
$wrkonchange = "" . trim(@$image->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$image->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x__userid" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x__userid" id="sv_x__userid" value="<?php echo RemoveHtml($image->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>"<?php echo $image->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x__userid" data-value-separator="<?php echo $image->_userid->displayValueSeparatorAttribute() ?>" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fimageadd.createAutoSuggest({"id":"x__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x__userid" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($image->_userid->FormValue) ?>">
<?php } ?>
<?php echo $image->_userid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->path->Visible) { // path ?>
	<div id="r_path" class="form-group row">
		<label id="elh_image_path" class="<?php echo $image_add->LeftColumnClass ?>"><?php echo $image->path->caption() ?><?php echo ($image->path->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_add->RightColumnClass ?>"><div<?php echo $image->path->cellAttributes() ?>>
<span id="el_image_path">
<div id="fd_x_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x_path" id="x_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_path" id= "fn_x_path" value="<?php echo $image->path->Upload->FileName ?>">
<input type="hidden" name="fa_x_path" id= "fa_x_path" value="0">
<input type="hidden" name="fs_x_path" id= "fs_x_path" value="100">
<input type="hidden" name="fx_x_path" id= "fx_x_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_path" id= "fm_x_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $image->path->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_image_description" for="x_description" class="<?php echo $image_add->LeftColumnClass ?>"><?php echo $image->description->caption() ?><?php echo ($image->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_add->RightColumnClass ?>"><div<?php echo $image->description->cellAttributes() ?>>
<?php if (!$image->isConfirm()) { ?>
<span id="el_image_description">
<input type="text" data-table="image" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x_description" name="x_description" id="x_description" value="<?php echo HtmlEncode($image->description->FormValue) ?>">
<?php } ?>
<?php echo $image->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("parcel_info", explode(",", $image->getCurrentDetailTable())) && $parcel_info->DetailAdd) {
?>
<?php if ($image->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "parcel_infogrid.php" ?>
<?php } ?>
<?php if (!$image->isConfirm()) { ?>
<!-- captcha html (begin) -->
<div class="form-group row ew-captcha">
	<div class="col-sm-10 offset-sm-2">
	<p><img src="ewcaptcha.php" alt="" class="ew-captcha-image"></p>
	<input type="text" name="captcha" id="captcha" class="form-control ew-control" size="30" placeholder="<?php echo $Language->Phrase("EnterValidateCode") ?>">
	</div>
</div>
<?php } else { ?>
<input type="hidden" name="captcha" id="captcha" value="<?php echo $image_add->Captcha ?>">
<?php } ?>
<!-- captcha html (end) -->
<?php if (!$image_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $image_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$image->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $image_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$image_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$image_add->terminate();
?>
