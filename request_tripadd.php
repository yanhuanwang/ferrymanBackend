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
$request_trip_add = new request_trip_add();

// Run the page
$request_trip_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$request_trip_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var frequest_tripadd = currentForm = new ew.Form("frequest_tripadd", "add");

// Validate form
frequest_tripadd.validate = function() {
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
		<?php if ($request_trip_add->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->from_place->caption(), $request_trip->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_add->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->to_place->caption(), $request_trip->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->description->caption(), $request_trip->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_add->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->user_id->caption(), $request_trip->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->user_id->errorMessage()) ?>");
		<?php if ($request_trip_add->from_date->Required) { ?>
			elm = this.getElements("x" + infix + "_from_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->from_date->caption(), $request_trip->from_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_from_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->from_date->errorMessage()) ?>");
		<?php if ($request_trip_add->to_date->Required) { ?>
			elm = this.getElements("x" + infix + "_to_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->to_date->caption(), $request_trip->to_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_to_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->to_date->errorMessage()) ?>");
		<?php if ($request_trip_add->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->createdAt->caption(), $request_trip->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->createdAt->errorMessage()) ?>");
		<?php if ($request_trip_add->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->updatedAt->caption(), $request_trip->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->updatedAt->errorMessage()) ?>");
		<?php if ($request_trip_add->labor_fee->Required) { ?>
			elm = this.getElements("x" + infix + "_labor_fee");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->labor_fee->caption(), $request_trip->labor_fee->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_labor_fee");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->labor_fee->errorMessage()) ?>");
		<?php if ($request_trip_add->applicable->Required) { ?>
			elm = this.getElements("x" + infix + "_applicable");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->applicable->caption(), $request_trip->applicable->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_applicable");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->applicable->errorMessage()) ?>");
		<?php if ($request_trip_add->service_type->Required) { ?>
			elm = this.getElements("x" + infix + "_service_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->service_type->caption(), $request_trip->service_type->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_service_type");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->service_type->errorMessage()) ?>");
		<?php if ($request_trip_add->goods_category->Required) { ?>
			elm = this.getElements("x" + infix + "_goods_category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->goods_category->caption(), $request_trip->goods_category->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_goods_category");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->goods_category->errorMessage()) ?>");
		<?php if ($request_trip_add->goods_weight->Required) { ?>
			elm = this.getElements("x" + infix + "_goods_weight");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->goods_weight->caption(), $request_trip->goods_weight->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_goods_weight");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->goods_weight->errorMessage()) ?>");
		<?php if ($request_trip_add->image1_id->Required) { ?>
			elm = this.getElements("x" + infix + "_image1_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->image1_id->caption(), $request_trip->image1_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_image1_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->image1_id->errorMessage()) ?>");
		<?php if ($request_trip_add->image2_id->Required) { ?>
			elm = this.getElements("x" + infix + "_image2_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->image2_id->caption(), $request_trip->image2_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_image2_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->image2_id->errorMessage()) ?>");
		<?php if ($request_trip_add->image3_id->Required) { ?>
			elm = this.getElements("x" + infix + "_image3_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->image3_id->caption(), $request_trip->image3_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_image3_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->image3_id->errorMessage()) ?>");
		<?php if ($request_trip_add->image4_id->Required) { ?>
			elm = this.getElements("x" + infix + "_image4_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->image4_id->caption(), $request_trip->image4_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_image4_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->image4_id->errorMessage()) ?>");

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
frequest_tripadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frequest_tripadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $request_trip_add->showPageHeader(); ?>
<?php
$request_trip_add->showMessage();
?>
<form name="frequest_tripadd" id="frequest_tripadd" class="<?php echo $request_trip_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($request_trip_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $request_trip_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="request_trip">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$request_trip_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($request_trip->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label id="elh_request_trip_from_place" for="x_from_place" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->from_place->caption() ?><?php echo ($request_trip->from_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->from_place->cellAttributes() ?>>
<span id="el_request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<?php echo $request_trip->from_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label id="elh_request_trip_to_place" for="x_to_place" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->to_place->caption() ?><?php echo ($request_trip->to_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->to_place->cellAttributes() ?>>
<span id="el_request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<?php echo $request_trip->to_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_request_trip_description" for="x_description" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->description->caption() ?><?php echo ($request_trip->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->description->cellAttributes() ?>>
<span id="el_request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<?php echo $request_trip->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_request_trip_user_id" for="x_user_id" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->user_id->caption() ?><?php echo ($request_trip->user_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->user_id->cellAttributes() ?>>
<span id="el_request_trip_user_id">
<input type="text" data-table="request_trip" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->user_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->user_id->EditValue ?>"<?php echo $request_trip->user_id->editAttributes() ?>>
</span>
<?php echo $request_trip->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->from_date->Visible) { // from_date ?>
	<div id="r_from_date" class="form-group row">
		<label id="elh_request_trip_from_date" for="x_from_date" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->from_date->caption() ?><?php echo ($request_trip->from_date->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->from_date->cellAttributes() ?>>
<span id="el_request_trip_from_date">
<input type="text" data-table="request_trip" data-field="x_from_date" name="x_from_date" id="x_from_date" placeholder="<?php echo HtmlEncode($request_trip->from_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_date->EditValue ?>"<?php echo $request_trip->from_date->editAttributes() ?>>
<?php if (!$request_trip->from_date->ReadOnly && !$request_trip->from_date->Disabled && !isset($request_trip->from_date->EditAttrs["readonly"]) && !isset($request_trip->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripadd", "x_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $request_trip->from_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->to_date->Visible) { // to_date ?>
	<div id="r_to_date" class="form-group row">
		<label id="elh_request_trip_to_date" for="x_to_date" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->to_date->caption() ?><?php echo ($request_trip->to_date->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->to_date->cellAttributes() ?>>
<span id="el_request_trip_to_date">
<input type="text" data-table="request_trip" data-field="x_to_date" name="x_to_date" id="x_to_date" placeholder="<?php echo HtmlEncode($request_trip->to_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_date->EditValue ?>"<?php echo $request_trip->to_date->editAttributes() ?>>
<?php if (!$request_trip->to_date->ReadOnly && !$request_trip->to_date->Disabled && !isset($request_trip->to_date->EditAttrs["readonly"]) && !isset($request_trip->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripadd", "x_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $request_trip->to_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_request_trip_createdAt" for="x_createdAt" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->createdAt->caption() ?><?php echo ($request_trip->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->createdAt->cellAttributes() ?>>
<span id="el_request_trip_createdAt">
<input type="text" data-table="request_trip" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($request_trip->createdAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->createdAt->EditValue ?>"<?php echo $request_trip->createdAt->editAttributes() ?>>
<?php if (!$request_trip->createdAt->ReadOnly && !$request_trip->createdAt->Disabled && !isset($request_trip->createdAt->EditAttrs["readonly"]) && !isset($request_trip->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripadd", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $request_trip->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_request_trip_updatedAt" for="x_updatedAt" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->updatedAt->caption() ?><?php echo ($request_trip->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->updatedAt->cellAttributes() ?>>
<span id="el_request_trip_updatedAt">
<input type="text" data-table="request_trip" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($request_trip->updatedAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->updatedAt->EditValue ?>"<?php echo $request_trip->updatedAt->editAttributes() ?>>
<?php if (!$request_trip->updatedAt->ReadOnly && !$request_trip->updatedAt->Disabled && !isset($request_trip->updatedAt->EditAttrs["readonly"]) && !isset($request_trip->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripadd", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $request_trip->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->labor_fee->Visible) { // labor_fee ?>
	<div id="r_labor_fee" class="form-group row">
		<label id="elh_request_trip_labor_fee" for="x_labor_fee" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->labor_fee->caption() ?><?php echo ($request_trip->labor_fee->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->labor_fee->cellAttributes() ?>>
<span id="el_request_trip_labor_fee">
<input type="text" data-table="request_trip" data-field="x_labor_fee" name="x_labor_fee" id="x_labor_fee" size="30" placeholder="<?php echo HtmlEncode($request_trip->labor_fee->getPlaceHolder()) ?>" value="<?php echo $request_trip->labor_fee->EditValue ?>"<?php echo $request_trip->labor_fee->editAttributes() ?>>
</span>
<?php echo $request_trip->labor_fee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->applicable->Visible) { // applicable ?>
	<div id="r_applicable" class="form-group row">
		<label id="elh_request_trip_applicable" for="x_applicable" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->applicable->caption() ?><?php echo ($request_trip->applicable->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->applicable->cellAttributes() ?>>
<span id="el_request_trip_applicable">
<input type="text" data-table="request_trip" data-field="x_applicable" name="x_applicable" id="x_applicable" size="30" placeholder="<?php echo HtmlEncode($request_trip->applicable->getPlaceHolder()) ?>" value="<?php echo $request_trip->applicable->EditValue ?>"<?php echo $request_trip->applicable->editAttributes() ?>>
</span>
<?php echo $request_trip->applicable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->service_type->Visible) { // service_type ?>
	<div id="r_service_type" class="form-group row">
		<label id="elh_request_trip_service_type" for="x_service_type" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->service_type->caption() ?><?php echo ($request_trip->service_type->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->service_type->cellAttributes() ?>>
<span id="el_request_trip_service_type">
<input type="text" data-table="request_trip" data-field="x_service_type" name="x_service_type" id="x_service_type" size="30" placeholder="<?php echo HtmlEncode($request_trip->service_type->getPlaceHolder()) ?>" value="<?php echo $request_trip->service_type->EditValue ?>"<?php echo $request_trip->service_type->editAttributes() ?>>
</span>
<?php echo $request_trip->service_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->goods_category->Visible) { // goods_category ?>
	<div id="r_goods_category" class="form-group row">
		<label id="elh_request_trip_goods_category" for="x_goods_category" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->goods_category->caption() ?><?php echo ($request_trip->goods_category->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->goods_category->cellAttributes() ?>>
<span id="el_request_trip_goods_category">
<input type="text" data-table="request_trip" data-field="x_goods_category" name="x_goods_category" id="x_goods_category" size="30" placeholder="<?php echo HtmlEncode($request_trip->goods_category->getPlaceHolder()) ?>" value="<?php echo $request_trip->goods_category->EditValue ?>"<?php echo $request_trip->goods_category->editAttributes() ?>>
</span>
<?php echo $request_trip->goods_category->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->goods_weight->Visible) { // goods_weight ?>
	<div id="r_goods_weight" class="form-group row">
		<label id="elh_request_trip_goods_weight" for="x_goods_weight" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->goods_weight->caption() ?><?php echo ($request_trip->goods_weight->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->goods_weight->cellAttributes() ?>>
<span id="el_request_trip_goods_weight">
<input type="text" data-table="request_trip" data-field="x_goods_weight" name="x_goods_weight" id="x_goods_weight" size="30" placeholder="<?php echo HtmlEncode($request_trip->goods_weight->getPlaceHolder()) ?>" value="<?php echo $request_trip->goods_weight->EditValue ?>"<?php echo $request_trip->goods_weight->editAttributes() ?>>
</span>
<?php echo $request_trip->goods_weight->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image1_id->Visible) { // image1_id ?>
	<div id="r_image1_id" class="form-group row">
		<label id="elh_request_trip_image1_id" for="x_image1_id" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->image1_id->caption() ?><?php echo ($request_trip->image1_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->image1_id->cellAttributes() ?>>
<span id="el_request_trip_image1_id">
<input type="text" data-table="request_trip" data-field="x_image1_id" name="x_image1_id" id="x_image1_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image1_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image1_id->EditValue ?>"<?php echo $request_trip->image1_id->editAttributes() ?>>
</span>
<?php echo $request_trip->image1_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image2_id->Visible) { // image2_id ?>
	<div id="r_image2_id" class="form-group row">
		<label id="elh_request_trip_image2_id" for="x_image2_id" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->image2_id->caption() ?><?php echo ($request_trip->image2_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->image2_id->cellAttributes() ?>>
<span id="el_request_trip_image2_id">
<input type="text" data-table="request_trip" data-field="x_image2_id" name="x_image2_id" id="x_image2_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image2_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image2_id->EditValue ?>"<?php echo $request_trip->image2_id->editAttributes() ?>>
</span>
<?php echo $request_trip->image2_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image3_id->Visible) { // image3_id ?>
	<div id="r_image3_id" class="form-group row">
		<label id="elh_request_trip_image3_id" for="x_image3_id" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->image3_id->caption() ?><?php echo ($request_trip->image3_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->image3_id->cellAttributes() ?>>
<span id="el_request_trip_image3_id">
<input type="text" data-table="request_trip" data-field="x_image3_id" name="x_image3_id" id="x_image3_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image3_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image3_id->EditValue ?>"<?php echo $request_trip->image3_id->editAttributes() ?>>
</span>
<?php echo $request_trip->image3_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image4_id->Visible) { // image4_id ?>
	<div id="r_image4_id" class="form-group row">
		<label id="elh_request_trip_image4_id" for="x_image4_id" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->image4_id->caption() ?><?php echo ($request_trip->image4_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->image4_id->cellAttributes() ?>>
<span id="el_request_trip_image4_id">
<input type="text" data-table="request_trip" data-field="x_image4_id" name="x_image4_id" id="x_image4_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image4_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image4_id->EditValue ?>"<?php echo $request_trip->image4_id->editAttributes() ?>>
</span>
<?php echo $request_trip->image4_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$request_trip_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $request_trip_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $request_trip_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$request_trip_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$request_trip_add->terminate();
?>
