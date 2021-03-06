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
$request_trip_search = new request_trip_search();

// Run the page
$request_trip_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$request_trip_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($request_trip_search->IsModal) { ?>
var frequest_tripsearch = currentAdvancedSearchForm = new ew.Form("frequest_tripsearch", "search");
<?php } else { ?>
var frequest_tripsearch = currentForm = new ew.Form("frequest_tripsearch", "search");
<?php } ?>

// Form_CustomValidate event
frequest_tripsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frequest_tripsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

frequest_tripsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_user_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->user_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_from_date");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->from_date->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_to_date");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->to_date->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_createdAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->createdAt->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_updatedAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->updatedAt->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_labor_fee");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->labor_fee->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_applicable");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->applicable->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_service_type");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->service_type->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_goods_category");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->goods_category->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_goods_weight");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->goods_weight->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_image1_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->image1_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_image2_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->image2_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_image3_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->image3_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_image4_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->image4_id->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $request_trip_search->showPageHeader(); ?>
<?php
$request_trip_search->showMessage();
?>
<form name="frequest_tripsearch" id="frequest_tripsearch" class="<?php echo $request_trip_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($request_trip_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $request_trip_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="request_trip">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$request_trip_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($request_trip->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_id"><?php echo $request_trip->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->id->cellAttributes() ?>>
			<span id="el_request_trip_id">
<input type="text" data-table="request_trip" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($request_trip->id->getPlaceHolder()) ?>" value="<?php echo $request_trip->id->EditValue ?>"<?php echo $request_trip->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label for="x_from_place" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_from_place"><?php echo $request_trip->from_place->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_from_place" id="z_from_place" value="LIKE"></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->from_place->cellAttributes() ?>>
			<span id="el_request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label for="x_to_place" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_to_place"><?php echo $request_trip->to_place->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_to_place" id="z_to_place" value="LIKE"></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->to_place->cellAttributes() ?>>
			<span id="el_request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label for="x_description" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_description"><?php echo $request_trip->description->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->description->cellAttributes() ?>>
			<span id="el_request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label for="x_user_id" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_user_id"><?php echo $request_trip->user_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->user_id->cellAttributes() ?>>
			<span id="el_request_trip_user_id">
<input type="text" data-table="request_trip" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->user_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->user_id->EditValue ?>"<?php echo $request_trip->user_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->from_date->Visible) { // from_date ?>
	<div id="r_from_date" class="form-group row">
		<label for="x_from_date" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_from_date"><?php echo $request_trip->from_date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_from_date" id="z_from_date" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->from_date->cellAttributes() ?>>
			<span id="el_request_trip_from_date">
<input type="text" data-table="request_trip" data-field="x_from_date" name="x_from_date" id="x_from_date" placeholder="<?php echo HtmlEncode($request_trip->from_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_date->EditValue ?>"<?php echo $request_trip->from_date->editAttributes() ?>>
<?php if (!$request_trip->from_date->ReadOnly && !$request_trip->from_date->Disabled && !isset($request_trip->from_date->EditAttrs["readonly"]) && !isset($request_trip->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripsearch", "x_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->to_date->Visible) { // to_date ?>
	<div id="r_to_date" class="form-group row">
		<label for="x_to_date" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_to_date"><?php echo $request_trip->to_date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_to_date" id="z_to_date" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->to_date->cellAttributes() ?>>
			<span id="el_request_trip_to_date">
<input type="text" data-table="request_trip" data-field="x_to_date" name="x_to_date" id="x_to_date" placeholder="<?php echo HtmlEncode($request_trip->to_date->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_date->EditValue ?>"<?php echo $request_trip->to_date->editAttributes() ?>>
<?php if (!$request_trip->to_date->ReadOnly && !$request_trip->to_date->Disabled && !isset($request_trip->to_date->EditAttrs["readonly"]) && !isset($request_trip->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripsearch", "x_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label for="x_createdAt" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_createdAt"><?php echo $request_trip->createdAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_createdAt" id="z_createdAt" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->createdAt->cellAttributes() ?>>
			<span id="el_request_trip_createdAt">
<input type="text" data-table="request_trip" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($request_trip->createdAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->createdAt->EditValue ?>"<?php echo $request_trip->createdAt->editAttributes() ?>>
<?php if (!$request_trip->createdAt->ReadOnly && !$request_trip->createdAt->Disabled && !isset($request_trip->createdAt->EditAttrs["readonly"]) && !isset($request_trip->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripsearch", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label for="x_updatedAt" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_updatedAt"><?php echo $request_trip->updatedAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_updatedAt" id="z_updatedAt" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->updatedAt->cellAttributes() ?>>
			<span id="el_request_trip_updatedAt">
<input type="text" data-table="request_trip" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($request_trip->updatedAt->getPlaceHolder()) ?>" value="<?php echo $request_trip->updatedAt->EditValue ?>"<?php echo $request_trip->updatedAt->editAttributes() ?>>
<?php if (!$request_trip->updatedAt->ReadOnly && !$request_trip->updatedAt->Disabled && !isset($request_trip->updatedAt->EditAttrs["readonly"]) && !isset($request_trip->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripsearch", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->labor_fee->Visible) { // labor_fee ?>
	<div id="r_labor_fee" class="form-group row">
		<label for="x_labor_fee" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_labor_fee"><?php echo $request_trip->labor_fee->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_labor_fee" id="z_labor_fee" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->labor_fee->cellAttributes() ?>>
			<span id="el_request_trip_labor_fee">
<input type="text" data-table="request_trip" data-field="x_labor_fee" name="x_labor_fee" id="x_labor_fee" size="30" placeholder="<?php echo HtmlEncode($request_trip->labor_fee->getPlaceHolder()) ?>" value="<?php echo $request_trip->labor_fee->EditValue ?>"<?php echo $request_trip->labor_fee->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->applicable->Visible) { // applicable ?>
	<div id="r_applicable" class="form-group row">
		<label for="x_applicable" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_applicable"><?php echo $request_trip->applicable->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_applicable" id="z_applicable" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->applicable->cellAttributes() ?>>
			<span id="el_request_trip_applicable">
<input type="text" data-table="request_trip" data-field="x_applicable" name="x_applicable" id="x_applicable" size="30" placeholder="<?php echo HtmlEncode($request_trip->applicable->getPlaceHolder()) ?>" value="<?php echo $request_trip->applicable->EditValue ?>"<?php echo $request_trip->applicable->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->service_type->Visible) { // service_type ?>
	<div id="r_service_type" class="form-group row">
		<label for="x_service_type" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_service_type"><?php echo $request_trip->service_type->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_service_type" id="z_service_type" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->service_type->cellAttributes() ?>>
			<span id="el_request_trip_service_type">
<input type="text" data-table="request_trip" data-field="x_service_type" name="x_service_type" id="x_service_type" size="30" placeholder="<?php echo HtmlEncode($request_trip->service_type->getPlaceHolder()) ?>" value="<?php echo $request_trip->service_type->EditValue ?>"<?php echo $request_trip->service_type->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->goods_category->Visible) { // goods_category ?>
	<div id="r_goods_category" class="form-group row">
		<label for="x_goods_category" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_goods_category"><?php echo $request_trip->goods_category->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_goods_category" id="z_goods_category" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->goods_category->cellAttributes() ?>>
			<span id="el_request_trip_goods_category">
<input type="text" data-table="request_trip" data-field="x_goods_category" name="x_goods_category" id="x_goods_category" size="30" placeholder="<?php echo HtmlEncode($request_trip->goods_category->getPlaceHolder()) ?>" value="<?php echo $request_trip->goods_category->EditValue ?>"<?php echo $request_trip->goods_category->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->goods_weight->Visible) { // goods_weight ?>
	<div id="r_goods_weight" class="form-group row">
		<label for="x_goods_weight" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_goods_weight"><?php echo $request_trip->goods_weight->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_goods_weight" id="z_goods_weight" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->goods_weight->cellAttributes() ?>>
			<span id="el_request_trip_goods_weight">
<input type="text" data-table="request_trip" data-field="x_goods_weight" name="x_goods_weight" id="x_goods_weight" size="30" placeholder="<?php echo HtmlEncode($request_trip->goods_weight->getPlaceHolder()) ?>" value="<?php echo $request_trip->goods_weight->EditValue ?>"<?php echo $request_trip->goods_weight->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image1_id->Visible) { // image1_id ?>
	<div id="r_image1_id" class="form-group row">
		<label for="x_image1_id" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_image1_id"><?php echo $request_trip->image1_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_image1_id" id="z_image1_id" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->image1_id->cellAttributes() ?>>
			<span id="el_request_trip_image1_id">
<input type="text" data-table="request_trip" data-field="x_image1_id" name="x_image1_id" id="x_image1_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image1_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image1_id->EditValue ?>"<?php echo $request_trip->image1_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image2_id->Visible) { // image2_id ?>
	<div id="r_image2_id" class="form-group row">
		<label for="x_image2_id" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_image2_id"><?php echo $request_trip->image2_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_image2_id" id="z_image2_id" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->image2_id->cellAttributes() ?>>
			<span id="el_request_trip_image2_id">
<input type="text" data-table="request_trip" data-field="x_image2_id" name="x_image2_id" id="x_image2_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image2_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image2_id->EditValue ?>"<?php echo $request_trip->image2_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image3_id->Visible) { // image3_id ?>
	<div id="r_image3_id" class="form-group row">
		<label for="x_image3_id" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_image3_id"><?php echo $request_trip->image3_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_image3_id" id="z_image3_id" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->image3_id->cellAttributes() ?>>
			<span id="el_request_trip_image3_id">
<input type="text" data-table="request_trip" data-field="x_image3_id" name="x_image3_id" id="x_image3_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image3_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image3_id->EditValue ?>"<?php echo $request_trip->image3_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($request_trip->image4_id->Visible) { // image4_id ?>
	<div id="r_image4_id" class="form-group row">
		<label for="x_image4_id" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_image4_id"><?php echo $request_trip->image4_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_image4_id" id="z_image4_id" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->image4_id->cellAttributes() ?>>
			<span id="el_request_trip_image4_id">
<input type="text" data-table="request_trip" data-field="x_image4_id" name="x_image4_id" id="x_image4_id" size="30" placeholder="<?php echo HtmlEncode($request_trip->image4_id->getPlaceHolder()) ?>" value="<?php echo $request_trip->image4_id->EditValue ?>"<?php echo $request_trip->image4_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$request_trip_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $request_trip_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$request_trip_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$request_trip_search->terminate();
?>
