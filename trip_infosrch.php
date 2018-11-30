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
$trip_info_search = new trip_info_search();

// Run the page
$trip_info_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trip_info_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($trip_info_search->IsModal) { ?>
var ftrip_infosearch = currentAdvancedSearchForm = new ew.Form("ftrip_infosearch", "search");
<?php } else { ?>
var ftrip_infosearch = currentForm = new ew.Form("ftrip_infosearch", "search");
<?php } ?>

// Form_CustomValidate event
ftrip_infosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrip_infosearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrip_infosearch.lists["x_user_id"] = <?php echo $trip_info_search->user_id->Lookup->toClientList() ?>;
ftrip_infosearch.lists["x_user_id"].options = <?php echo JsonEncode($trip_info_search->user_id->lookupOptions()) ?>;
ftrip_infosearch.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

ftrip_infosearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($trip_info->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_user_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($trip_info->user_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_date");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($trip_info->date->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_createdAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($trip_info->createdAt->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_updatedAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($trip_info->updatedAt->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $trip_info_search->showPageHeader(); ?>
<?php
$trip_info_search->showMessage();
?>
<form name="ftrip_infosearch" id="ftrip_infosearch" class="<?php echo $trip_info_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($trip_info_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $trip_info_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="trip_info">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$trip_info_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($trip_info->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_id"><?php echo $trip_info->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->id->cellAttributes() ?>>
			<span id="el_trip_info_id">
<input type="text" data-table="trip_info" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($trip_info->id->getPlaceHolder()) ?>" value="<?php echo $trip_info->id->EditValue ?>"<?php echo $trip_info->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label for="x_from_place" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_from_place"><?php echo $trip_info->from_place->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_from_place" id="z_from_place" value="LIKE"></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->from_place->cellAttributes() ?>>
			<span id="el_trip_info_from_place">
<input type="text" data-table="trip_info" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->from_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_place->EditValue ?>"<?php echo $trip_info->from_place->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label for="x_to_place" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_to_place"><?php echo $trip_info->to_place->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_to_place" id="z_to_place" value="LIKE"></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->to_place->cellAttributes() ?>>
			<span id="el_trip_info_to_place">
<input type="text" data-table="trip_info" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->to_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_place->EditValue ?>"<?php echo $trip_info->to_place->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label for="x_description" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_description"><?php echo $trip_info->description->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->description->cellAttributes() ?>>
			<span id="el_trip_info_description">
<input type="text" data-table="trip_info" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->description->getPlaceHolder()) ?>" value="<?php echo $trip_info->description->EditValue ?>"<?php echo $trip_info->description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_user_id"><?php echo $trip_info->user_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->user_id->cellAttributes() ?>>
			<span id="el_trip_info_user_id">
<?php
$wrkonchange = "" . trim(@$trip_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trip_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_user_id" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_user_id" id="sv_x_user_id" value="<?php echo RemoveHtml($trip_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>"<?php echo $trip_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_user_id" data-value-separator="<?php echo $trip_info->user_id->displayValueSeparatorAttribute() ?>" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($trip_info->user_id->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrip_infosearch.createAutoSuggest({"id":"x_user_id","forceSelect":false});
</script>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
	<div id="r_flight_number" class="form-group row">
		<label for="x_flight_number" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_flight_number"><?php echo $trip_info->flight_number->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_flight_number" id="z_flight_number" value="LIKE"></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->flight_number->cellAttributes() ?>>
			<span id="el_trip_info_flight_number">
<input type="text" data-table="trip_info" data-field="x_flight_number" name="x_flight_number" id="x_flight_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->flight_number->getPlaceHolder()) ?>" value="<?php echo $trip_info->flight_number->EditValue ?>"<?php echo $trip_info->flight_number->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label for="x_date" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_date"><?php echo $trip_info->date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_date" id="z_date" value="="></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->date->cellAttributes() ?>>
			<span id="el_trip_info_date">
<input type="text" data-table="trip_info" data-field="x_date" name="x_date" id="x_date" placeholder="<?php echo HtmlEncode($trip_info->date->getPlaceHolder()) ?>" value="<?php echo $trip_info->date->EditValue ?>"<?php echo $trip_info->date->editAttributes() ?>>
<?php if (!$trip_info->date->ReadOnly && !$trip_info->date->Disabled && !isset($trip_info->date->EditAttrs["readonly"]) && !isset($trip_info->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infosearch", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label for="x_createdAt" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_createdAt"><?php echo $trip_info->createdAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_createdAt" id="z_createdAt" value="="></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->createdAt->cellAttributes() ?>>
			<span id="el_trip_info_createdAt">
<input type="text" data-table="trip_info" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($trip_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->createdAt->EditValue ?>"<?php echo $trip_info->createdAt->editAttributes() ?>>
<?php if (!$trip_info->createdAt->ReadOnly && !$trip_info->createdAt->Disabled && !isset($trip_info->createdAt->EditAttrs["readonly"]) && !isset($trip_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infosearch", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label for="x_updatedAt" class="<?php echo $trip_info_search->LeftColumnClass ?>"><span id="elh_trip_info_updatedAt"><?php echo $trip_info->updatedAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_updatedAt" id="z_updatedAt" value="="></span>
		</label>
		<div class="<?php echo $trip_info_search->RightColumnClass ?>"><div<?php echo $trip_info->updatedAt->cellAttributes() ?>>
			<span id="el_trip_info_updatedAt">
<input type="text" data-table="trip_info" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($trip_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->updatedAt->EditValue ?>"<?php echo $trip_info->updatedAt->editAttributes() ?>>
<?php if (!$trip_info->updatedAt->ReadOnly && !$trip_info->updatedAt->Disabled && !isset($trip_info->updatedAt->EditAttrs["readonly"]) && !isset($trip_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infosearch", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$trip_info_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $trip_info_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$trip_info_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$trip_info_search->terminate();
?>
