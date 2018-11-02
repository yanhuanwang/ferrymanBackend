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
frequest_tripsearch.lists["x_category"] = <?php echo $request_trip_search->category->Lookup->toClientList() ?>;
frequest_tripsearch.lists["x_category"].options = <?php echo JsonEncode($request_trip_search->category->lookupOptions()) ?>;

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
	elm = this.getElements("x" + infix + "_date");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($request_trip->date->errorMessage()) ?>");

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
<?php if ($request_trip->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label for="x_date" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_date"><?php echo $request_trip->date->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_date" id="z_date" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->date->cellAttributes() ?>>
			<span id="el_request_trip_date">
<input type="text" data-table="request_trip" data-field="x_date" name="x_date" id="x_date" placeholder="<?php echo HtmlEncode($request_trip->date->getPlaceHolder()) ?>" value="<?php echo $request_trip->date->EditValue ?>"<?php echo $request_trip->date->editAttributes() ?>>
<?php if (!$request_trip->date->ReadOnly && !$request_trip->date->Disabled && !isset($request_trip->date->EditAttrs["readonly"]) && !isset($request_trip->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripsearch", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
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
<?php if ($request_trip->category->Visible) { // category ?>
	<div id="r_category" class="form-group row">
		<label for="x_category" class="<?php echo $request_trip_search->LeftColumnClass ?>"><span id="elh_request_trip_category"><?php echo $request_trip->category->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_category" id="z_category" value="="></span>
		</label>
		<div class="<?php echo $request_trip_search->RightColumnClass ?>"><div<?php echo $request_trip->category->cellAttributes() ?>>
			<span id="el_request_trip_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="request_trip" data-field="x_category" data-value-separator="<?php echo $request_trip->category->displayValueSeparatorAttribute() ?>" id="x_category" name="x_category"<?php echo $request_trip->category->editAttributes() ?>>
		<?php echo $request_trip->category->selectOptionListHtml("x_category") ?>
	</select>
<?php echo $request_trip->category->Lookup->getParamTag("p_x_category") ?>
</div>
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
