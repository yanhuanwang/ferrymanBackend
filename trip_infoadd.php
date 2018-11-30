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
$trip_info_add = new trip_info_add();

// Run the page
$trip_info_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trip_info_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftrip_infoadd = currentForm = new ew.Form("ftrip_infoadd", "add");

// Validate form
ftrip_infoadd.validate = function() {
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
		<?php if ($trip_info_add->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->from_place->caption(), $trip_info->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_add->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->to_place->caption(), $trip_info->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->description->caption(), $trip_info->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_add->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->user_id->caption(), $trip_info->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->user_id->errorMessage()) ?>");
		<?php if ($trip_info_add->flight_number->Required) { ?>
			elm = this.getElements("x" + infix + "_flight_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->flight_number->caption(), $trip_info->flight_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_add->date->Required) { ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->date->caption(), $trip_info->date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->date->errorMessage()) ?>");
		<?php if ($trip_info_add->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->createdAt->caption(), $trip_info->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->createdAt->errorMessage()) ?>");
		<?php if ($trip_info_add->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->updatedAt->caption(), $trip_info->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->updatedAt->errorMessage()) ?>");

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
ftrip_infoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrip_infoadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrip_infoadd.lists["x_user_id"] = <?php echo $trip_info_add->user_id->Lookup->toClientList() ?>;
ftrip_infoadd.lists["x_user_id"].options = <?php echo JsonEncode($trip_info_add->user_id->lookupOptions()) ?>;
ftrip_infoadd.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trip_info_add->showPageHeader(); ?>
<?php
$trip_info_add->showMessage();
?>
<form name="ftrip_infoadd" id="ftrip_infoadd" class="<?php echo $trip_info_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trip_info_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trip_info_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trip_info">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$trip_info_add->IsModal ?>">
<?php if ($trip_info->getCurrentMasterTable() == "user") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $trip_info->user_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($trip_info->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label id="elh_trip_info_from_place" for="x_from_place" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->from_place->caption() ?><?php echo ($trip_info->from_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->from_place->cellAttributes() ?>>
<span id="el_trip_info_from_place">
<input type="text" data-table="trip_info" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->from_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_place->EditValue ?>"<?php echo $trip_info->from_place->editAttributes() ?>>
</span>
<?php echo $trip_info->from_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label id="elh_trip_info_to_place" for="x_to_place" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->to_place->caption() ?><?php echo ($trip_info->to_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->to_place->cellAttributes() ?>>
<span id="el_trip_info_to_place">
<input type="text" data-table="trip_info" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->to_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_place->EditValue ?>"<?php echo $trip_info->to_place->editAttributes() ?>>
</span>
<?php echo $trip_info->to_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_trip_info_description" for="x_description" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->description->caption() ?><?php echo ($trip_info->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->description->cellAttributes() ?>>
<span id="el_trip_info_description">
<input type="text" data-table="trip_info" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->description->getPlaceHolder()) ?>" value="<?php echo $trip_info->description->EditValue ?>"<?php echo $trip_info->description->editAttributes() ?>>
</span>
<?php echo $trip_info->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_trip_info_user_id" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->user_id->caption() ?><?php echo ($trip_info->user_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->user_id->cellAttributes() ?>>
<?php if ($trip_info->user_id->getSessionValue() <> "") { ?>
<span id="el_trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_user_id" name="x_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_trip_info_user_id">
<?php
$wrkonchange = "" . trim(@$trip_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trip_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_user_id" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_user_id" id="sv_x_user_id" value="<?php echo RemoveHtml($trip_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>"<?php echo $trip_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_user_id" data-value-separator="<?php echo $trip_info->user_id->displayValueSeparatorAttribute() ?>" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrip_infoadd.createAutoSuggest({"id":"x_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $trip_info->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
	<div id="r_flight_number" class="form-group row">
		<label id="elh_trip_info_flight_number" for="x_flight_number" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->flight_number->caption() ?><?php echo ($trip_info->flight_number->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->flight_number->cellAttributes() ?>>
<span id="el_trip_info_flight_number">
<input type="text" data-table="trip_info" data-field="x_flight_number" name="x_flight_number" id="x_flight_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->flight_number->getPlaceHolder()) ?>" value="<?php echo $trip_info->flight_number->EditValue ?>"<?php echo $trip_info->flight_number->editAttributes() ?>>
</span>
<?php echo $trip_info->flight_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_trip_info_date" for="x_date" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->date->caption() ?><?php echo ($trip_info->date->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->date->cellAttributes() ?>>
<span id="el_trip_info_date">
<input type="text" data-table="trip_info" data-field="x_date" name="x_date" id="x_date" placeholder="<?php echo HtmlEncode($trip_info->date->getPlaceHolder()) ?>" value="<?php echo $trip_info->date->EditValue ?>"<?php echo $trip_info->date->editAttributes() ?>>
<?php if (!$trip_info->date->ReadOnly && !$trip_info->date->Disabled && !isset($trip_info->date->EditAttrs["readonly"]) && !isset($trip_info->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infoadd", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $trip_info->date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_trip_info_createdAt" for="x_createdAt" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->createdAt->caption() ?><?php echo ($trip_info->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->createdAt->cellAttributes() ?>>
<span id="el_trip_info_createdAt">
<input type="text" data-table="trip_info" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($trip_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->createdAt->EditValue ?>"<?php echo $trip_info->createdAt->editAttributes() ?>>
<?php if (!$trip_info->createdAt->ReadOnly && !$trip_info->createdAt->Disabled && !isset($trip_info->createdAt->EditAttrs["readonly"]) && !isset($trip_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infoadd", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $trip_info->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_trip_info_updatedAt" for="x_updatedAt" class="<?php echo $trip_info_add->LeftColumnClass ?>"><?php echo $trip_info->updatedAt->caption() ?><?php echo ($trip_info->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $trip_info_add->RightColumnClass ?>"><div<?php echo $trip_info->updatedAt->cellAttributes() ?>>
<span id="el_trip_info_updatedAt">
<input type="text" data-table="trip_info" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($trip_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->updatedAt->EditValue ?>"<?php echo $trip_info->updatedAt->editAttributes() ?>>
<?php if (!$trip_info->updatedAt->ReadOnly && !$trip_info->updatedAt->Disabled && !isset($trip_info->updatedAt->EditAttrs["readonly"]) && !isset($trip_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infoadd", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $trip_info->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$trip_info_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trip_info_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $trip_info_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trip_info_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trip_info_add->terminate();
?>
