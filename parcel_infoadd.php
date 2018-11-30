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
$parcel_info_add = new parcel_info_add();

// Run the page
$parcel_info_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parcel_info_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fparcel_infoadd = currentForm = new ew.Form("fparcel_infoadd", "add");

// Validate form
fparcel_infoadd.validate = function() {
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
		<?php if ($parcel_info_add->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->from_place->caption(), $parcel_info->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_add->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->to_place->caption(), $parcel_info->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->description->caption(), $parcel_info->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_add->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->user_id->caption(), $parcel_info->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->user_id->errorMessage()) ?>");
		<?php if ($parcel_info_add->image_id->Required) { ?>
			elm = this.getElements("x" + infix + "_image_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->image_id->caption(), $parcel_info->image_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_image_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->image_id->errorMessage()) ?>");
		<?php if ($parcel_info_add->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->name->caption(), $parcel_info->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_add->categoty->Required) { ?>
			elm = this.getElements("x" + infix + "_categoty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->categoty->caption(), $parcel_info->categoty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_categoty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->categoty->errorMessage()) ?>");
		<?php if ($parcel_info_add->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->status->caption(), $parcel_info->status->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->status->errorMessage()) ?>");
		<?php if ($parcel_info_add->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->createdAt->caption(), $parcel_info->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->createdAt->errorMessage()) ?>");
		<?php if ($parcel_info_add->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->updatedAt->caption(), $parcel_info->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->updatedAt->errorMessage()) ?>");

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
fparcel_infoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparcel_infoadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fparcel_infoadd.lists["x_user_id"] = <?php echo $parcel_info_add->user_id->Lookup->toClientList() ?>;
fparcel_infoadd.lists["x_user_id"].options = <?php echo JsonEncode($parcel_info_add->user_id->lookupOptions()) ?>;
fparcel_infoadd.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fparcel_infoadd.lists["x_image_id"] = <?php echo $parcel_info_add->image_id->Lookup->toClientList() ?>;
fparcel_infoadd.lists["x_image_id"].options = <?php echo JsonEncode($parcel_info_add->image_id->lookupOptions()) ?>;
fparcel_infoadd.autoSuggests["x_image_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $parcel_info_add->showPageHeader(); ?>
<?php
$parcel_info_add->showMessage();
?>
<form name="fparcel_infoadd" id="fparcel_infoadd" class="<?php echo $parcel_info_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parcel_info_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parcel_info_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parcel_info">
<?php if ($parcel_info->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$parcel_info_add->IsModal ?>">
<?php if ($parcel_info->getCurrentMasterTable() == "image") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="image">
<input type="hidden" name="fk_id" value="<?php echo $parcel_info->image_id->getSessionValue() ?>">
<?php } ?>
<?php if ($parcel_info->getCurrentMasterTable() == "user") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $parcel_info->user_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label id="elh_parcel_info_from_place" for="x_from_place" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->from_place->caption() ?><?php echo ($parcel_info->from_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->from_place->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_from_place">
<input type="text" data-table="parcel_info" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->from_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->from_place->EditValue ?>"<?php echo $parcel_info->from_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parcel_info_from_place">
<span<?php echo $parcel_info->from_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->from_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="x_from_place" id="x_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->from_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label id="elh_parcel_info_to_place" for="x_to_place" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->to_place->caption() ?><?php echo ($parcel_info->to_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->to_place->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_to_place">
<input type="text" data-table="parcel_info" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->to_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->to_place->EditValue ?>"<?php echo $parcel_info->to_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parcel_info_to_place">
<span<?php echo $parcel_info->to_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->to_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="x_to_place" id="x_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->to_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_parcel_info_description" for="x_description" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->description->caption() ?><?php echo ($parcel_info->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->description->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_description">
<input type="text" data-table="parcel_info" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->description->getPlaceHolder()) ?>" value="<?php echo $parcel_info->description->EditValue ?>"<?php echo $parcel_info->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parcel_info_description">
<span<?php echo $parcel_info->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_description" name="x_description" id="x_description" value="<?php echo HtmlEncode($parcel_info->description->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_parcel_info_user_id" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->user_id->caption() ?><?php echo ($parcel_info->user_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->user_id->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<?php if ($parcel_info->user_id->getSessionValue() <> "") { ?>
<span id="el_parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_user_id" name="x_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_parcel_info_user_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_user_id" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_user_id" id="sv_x_user_id" value="<?php echo RemoveHtml($parcel_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>"<?php echo $parcel_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" data-value-separator="<?php echo $parcel_info->user_id->displayValueSeparatorAttribute() ?>" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infoadd.createAutoSuggest({"id":"x_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->image_id->Visible) { // image_id ?>
	<div id="r_image_id" class="form-group row">
		<label id="elh_parcel_info_image_id" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->image_id->caption() ?><?php echo ($parcel_info->image_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->image_id->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<?php if ($parcel_info->image_id->getSessionValue() <> "") { ?>
<span id="el_parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->ViewValue)) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" id="x_image_id" name="x_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_parcel_info_image_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->image_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->image_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_image_id" class="text-nowrap" style="z-index: 8940">
	<input type="text" class="form-control" name="sv_x_image_id" id="sv_x_image_id" value="<?php echo RemoveHtml($parcel_info->image_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>"<?php echo $parcel_info->image_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" data-value-separator="<?php echo $parcel_info->image_id->displayValueSeparatorAttribute() ?>" name="x_image_id" id="x_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infoadd.createAutoSuggest({"id":"x_image_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->ViewValue)) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="x_image_id" id="x_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->image_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_parcel_info_name" for="x_name" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->name->caption() ?><?php echo ($parcel_info->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->name->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_name">
<input type="text" data-table="parcel_info" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->name->getPlaceHolder()) ?>" value="<?php echo $parcel_info->name->EditValue ?>"<?php echo $parcel_info->name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parcel_info_name">
<span<?php echo $parcel_info->name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_name" name="x_name" id="x_name" value="<?php echo HtmlEncode($parcel_info->name->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->categoty->Visible) { // categoty ?>
	<div id="r_categoty" class="form-group row">
		<label id="elh_parcel_info_categoty" for="x_categoty" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->categoty->caption() ?><?php echo ($parcel_info->categoty->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->categoty->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_categoty">
<input type="text" data-table="parcel_info" data-field="x_categoty" name="x_categoty" id="x_categoty" size="30" placeholder="<?php echo HtmlEncode($parcel_info->categoty->getPlaceHolder()) ?>" value="<?php echo $parcel_info->categoty->EditValue ?>"<?php echo $parcel_info->categoty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parcel_info_categoty">
<span<?php echo $parcel_info->categoty->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->categoty->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="x_categoty" id="x_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->categoty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_parcel_info_status" for="x_status" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->status->caption() ?><?php echo ($parcel_info->status->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->status->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_status">
<input type="text" data-table="parcel_info" data-field="x_status" name="x_status" id="x_status" size="30" placeholder="<?php echo HtmlEncode($parcel_info->status->getPlaceHolder()) ?>" value="<?php echo $parcel_info->status->EditValue ?>"<?php echo $parcel_info->status->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_parcel_info_status">
<span<?php echo $parcel_info->status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->status->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_status" name="x_status" id="x_status" value="<?php echo HtmlEncode($parcel_info->status->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_parcel_info_createdAt" for="x_createdAt" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->createdAt->caption() ?><?php echo ($parcel_info->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->createdAt->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_createdAt">
<input type="text" data-table="parcel_info" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($parcel_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->createdAt->EditValue ?>"<?php echo $parcel_info->createdAt->editAttributes() ?>>
<?php if (!$parcel_info->createdAt->ReadOnly && !$parcel_info->createdAt->Disabled && !isset($parcel_info->createdAt->EditAttrs["readonly"]) && !isset($parcel_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infoadd", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_parcel_info_createdAt">
<span<?php echo $parcel_info->createdAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->createdAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_parcel_info_updatedAt" for="x_updatedAt" class="<?php echo $parcel_info_add->LeftColumnClass ?>"><?php echo $parcel_info->updatedAt->caption() ?><?php echo ($parcel_info->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $parcel_info_add->RightColumnClass ?>"><div<?php echo $parcel_info->updatedAt->cellAttributes() ?>>
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el_parcel_info_updatedAt">
<input type="text" data-table="parcel_info" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($parcel_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->updatedAt->EditValue ?>"<?php echo $parcel_info->updatedAt->editAttributes() ?>>
<?php if (!$parcel_info->updatedAt->ReadOnly && !$parcel_info->updatedAt->Disabled && !isset($parcel_info->updatedAt->EditAttrs["readonly"]) && !isset($parcel_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infoadd", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_parcel_info_updatedAt">
<span<?php echo $parcel_info->updatedAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->updatedAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->FormValue) ?>">
<?php } ?>
<?php echo $parcel_info->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$parcel_info_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $parcel_info_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$parcel_info->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $parcel_info_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$parcel_info_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$parcel_info_add->terminate();
?>
