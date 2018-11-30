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
$parcel_info_search = new parcel_info_search();

// Run the page
$parcel_info_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parcel_info_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($parcel_info_search->IsModal) { ?>
var fparcel_infosearch = currentAdvancedSearchForm = new ew.Form("fparcel_infosearch", "search");
<?php } else { ?>
var fparcel_infosearch = currentForm = new ew.Form("fparcel_infosearch", "search");
<?php } ?>

// Form_CustomValidate event
fparcel_infosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparcel_infosearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fparcel_infosearch.lists["x_user_id"] = <?php echo $parcel_info_search->user_id->Lookup->toClientList() ?>;
fparcel_infosearch.lists["x_user_id"].options = <?php echo JsonEncode($parcel_info_search->user_id->lookupOptions()) ?>;
fparcel_infosearch.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

fparcel_infosearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parcel_info->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_user_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parcel_info->user_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_categoty");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parcel_info->categoty->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_status");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parcel_info->status->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_createdAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parcel_info->createdAt->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_updatedAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($parcel_info->updatedAt->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $parcel_info_search->showPageHeader(); ?>
<?php
$parcel_info_search->showMessage();
?>
<form name="fparcel_infosearch" id="fparcel_infosearch" class="<?php echo $parcel_info_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($parcel_info_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $parcel_info_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="parcel_info">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$parcel_info_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($parcel_info->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_id"><?php echo $parcel_info->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->id->cellAttributes() ?>>
			<span id="el_parcel_info_id">
<input type="text" data-table="parcel_info" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($parcel_info->id->getPlaceHolder()) ?>" value="<?php echo $parcel_info->id->EditValue ?>"<?php echo $parcel_info->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label for="x_from_place" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_from_place"><?php echo $parcel_info->from_place->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_from_place" id="z_from_place" value="LIKE"></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->from_place->cellAttributes() ?>>
			<span id="el_parcel_info_from_place">
<input type="text" data-table="parcel_info" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->from_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->from_place->EditValue ?>"<?php echo $parcel_info->from_place->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label for="x_to_place" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_to_place"><?php echo $parcel_info->to_place->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_to_place" id="z_to_place" value="LIKE"></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->to_place->cellAttributes() ?>>
			<span id="el_parcel_info_to_place">
<input type="text" data-table="parcel_info" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->to_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->to_place->EditValue ?>"<?php echo $parcel_info->to_place->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label for="x_description" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_description"><?php echo $parcel_info->description->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->description->cellAttributes() ?>>
			<span id="el_parcel_info_description">
<input type="text" data-table="parcel_info" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->description->getPlaceHolder()) ?>" value="<?php echo $parcel_info->description->EditValue ?>"<?php echo $parcel_info->description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_user_id"><?php echo $parcel_info->user_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->user_id->cellAttributes() ?>>
			<span id="el_parcel_info_user_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_user_id" class="text-nowrap" style="z-index: 8950">
	<input type="text" class="form-control" name="sv_x_user_id" id="sv_x_user_id" value="<?php echo RemoveHtml($parcel_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>"<?php echo $parcel_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" data-value-separator="<?php echo $parcel_info->user_id->displayValueSeparatorAttribute() ?>" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infosearch.createAutoSuggest({"id":"x_user_id","forceSelect":false});
</script>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label for="x_name" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_name"><?php echo $parcel_info->name->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->name->cellAttributes() ?>>
			<span id="el_parcel_info_name">
<input type="text" data-table="parcel_info" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->name->getPlaceHolder()) ?>" value="<?php echo $parcel_info->name->EditValue ?>"<?php echo $parcel_info->name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->categoty->Visible) { // categoty ?>
	<div id="r_categoty" class="form-group row">
		<label for="x_categoty" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_categoty"><?php echo $parcel_info->categoty->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_categoty" id="z_categoty" value="="></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->categoty->cellAttributes() ?>>
			<span id="el_parcel_info_categoty">
<input type="text" data-table="parcel_info" data-field="x_categoty" name="x_categoty" id="x_categoty" size="30" placeholder="<?php echo HtmlEncode($parcel_info->categoty->getPlaceHolder()) ?>" value="<?php echo $parcel_info->categoty->EditValue ?>"<?php echo $parcel_info->categoty->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label for="x_status" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_status"><?php echo $parcel_info->status->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status" id="z_status" value="="></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->status->cellAttributes() ?>>
			<span id="el_parcel_info_status">
<input type="text" data-table="parcel_info" data-field="x_status" name="x_status" id="x_status" size="30" placeholder="<?php echo HtmlEncode($parcel_info->status->getPlaceHolder()) ?>" value="<?php echo $parcel_info->status->EditValue ?>"<?php echo $parcel_info->status->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label for="x_createdAt" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_createdAt"><?php echo $parcel_info->createdAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_createdAt" id="z_createdAt" value="="></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->createdAt->cellAttributes() ?>>
			<span id="el_parcel_info_createdAt">
<input type="text" data-table="parcel_info" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($parcel_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->createdAt->EditValue ?>"<?php echo $parcel_info->createdAt->editAttributes() ?>>
<?php if (!$parcel_info->createdAt->ReadOnly && !$parcel_info->createdAt->Disabled && !isset($parcel_info->createdAt->EditAttrs["readonly"]) && !isset($parcel_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infosearch", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($parcel_info->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label for="x_updatedAt" class="<?php echo $parcel_info_search->LeftColumnClass ?>"><span id="elh_parcel_info_updatedAt"><?php echo $parcel_info->updatedAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_updatedAt" id="z_updatedAt" value="="></span>
		</label>
		<div class="<?php echo $parcel_info_search->RightColumnClass ?>"><div<?php echo $parcel_info->updatedAt->cellAttributes() ?>>
			<span id="el_parcel_info_updatedAt">
<input type="text" data-table="parcel_info" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($parcel_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->updatedAt->EditValue ?>"<?php echo $parcel_info->updatedAt->editAttributes() ?>>
<?php if (!$parcel_info->updatedAt->ReadOnly && !$parcel_info->updatedAt->Disabled && !isset($parcel_info->updatedAt->EditAttrs["readonly"]) && !isset($parcel_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infosearch", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$parcel_info_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $parcel_info_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$parcel_info_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$parcel_info_search->terminate();
?>
