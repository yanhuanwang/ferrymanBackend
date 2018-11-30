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
$orders_search = new orders_search();

// Run the page
$orders_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($orders_search->IsModal) { ?>
var forderssearch = currentAdvancedSearchForm = new ew.Form("forderssearch", "search");
<?php } else { ?>
var forderssearch = currentForm = new ew.Form("forderssearch", "search");
<?php } ?>

// Form_CustomValidate event
forderssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderssearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
forderssearch.lists["x__userid"] = <?php echo $orders_search->_userid->Lookup->toClientList() ?>;
forderssearch.lists["x__userid"].options = <?php echo JsonEncode($orders_search->_userid->lookupOptions()) ?>;
forderssearch.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
forderssearch.lists["x_parcel_id"] = <?php echo $orders_search->parcel_id->Lookup->toClientList() ?>;
forderssearch.lists["x_parcel_id"].options = <?php echo JsonEncode($orders_search->parcel_id->lookupOptions()) ?>;
forderssearch.autoSuggests["x_parcel_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
forderssearch.lists["x_carrier_id"] = <?php echo $orders_search->carrier_id->Lookup->toClientList() ?>;
forderssearch.lists["x_carrier_id"].options = <?php echo JsonEncode($orders_search->carrier_id->lookupOptions()) ?>;
forderssearch.autoSuggests["x_carrier_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
forderssearch.lists["x_status"] = <?php echo $orders_search->status->Lookup->toClientList() ?>;
forderssearch.lists["x_status"].options = <?php echo JsonEncode($orders_search->status->options(FALSE, TRUE)) ?>;

// Form object for search
// Validate function for search

forderssearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($orders->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "__userid");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($orders->_userid->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_parcel_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($orders->parcel_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_carrier_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($orders->carrier_id->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orders_search->showPageHeader(); ?>
<?php
$orders_search->showMessage();
?>
<form name="forderssearch" id="forderssearch" class="<?php echo $orders_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$orders_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($orders->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $orders_search->LeftColumnClass ?>"><span id="elh_orders_id"><?php echo $orders->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $orders_search->RightColumnClass ?>"><div<?php echo $orders->id->cellAttributes() ?>>
			<span id="el_orders_id">
<input type="text" data-table="orders" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($orders->id->getPlaceHolder()) ?>" value="<?php echo $orders->id->EditValue ?>"<?php echo $orders->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($orders->_userid->Visible) { // userid ?>
	<div id="r__userid" class="form-group row">
		<label class="<?php echo $orders_search->LeftColumnClass ?>"><span id="elh_orders__userid"><?php echo $orders->_userid->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z__userid" id="z__userid" value="="></span>
		</label>
		<div class="<?php echo $orders_search->RightColumnClass ?>"><div<?php echo $orders->_userid->cellAttributes() ?>>
			<span id="el_orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x__userid" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x__userid" id="sv_x__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($orders->_userid->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderssearch.createAutoSuggest({"id":"x__userid","forceSelect":false});
</script>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
	<div id="r_parcel_id" class="form-group row">
		<label class="<?php echo $orders_search->LeftColumnClass ?>"><span id="elh_orders_parcel_id"><?php echo $orders->parcel_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_parcel_id" id="z_parcel_id" value="="></span>
		</label>
		<div class="<?php echo $orders_search->RightColumnClass ?>"><div<?php echo $orders->parcel_id->cellAttributes() ?>>
			<span id="el_orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_parcel_id" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_parcel_id" id="sv_x_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x_parcel_id" id="x_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderssearch.createAutoSuggest({"id":"x_parcel_id","forceSelect":false});
</script>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
	<div id="r_carrier_id" class="form-group row">
		<label class="<?php echo $orders_search->LeftColumnClass ?>"><span id="elh_orders_carrier_id"><?php echo $orders->carrier_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_carrier_id" id="z_carrier_id" value="="></span>
		</label>
		<div class="<?php echo $orders_search->RightColumnClass ?>"><div<?php echo $orders->carrier_id->cellAttributes() ?>>
			<span id="el_orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_carrier_id" class="text-nowrap" style="z-index: 8960">
	<input type="text" class="form-control" name="sv_x_carrier_id" id="sv_x_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x_carrier_id" id="x_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
forderssearch.createAutoSuggest({"id":"x_carrier_id","forceSelect":false});
</script>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label for="x_description" class="<?php echo $orders_search->LeftColumnClass ?>"><span id="elh_orders_description"><?php echo $orders->description->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span>
		</label>
		<div class="<?php echo $orders_search->RightColumnClass ?>"><div<?php echo $orders->description->cellAttributes() ?>>
			<span id="el_orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label for="x_status" class="<?php echo $orders_search->LeftColumnClass ?>"><span id="elh_orders_status"><?php echo $orders->status->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_status" id="z_status" value="="></span>
		</label>
		<div class="<?php echo $orders_search->RightColumnClass ?>"><div<?php echo $orders->status->cellAttributes() ?>>
			<span id="el_orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x_status") ?>
	</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$orders_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orders_search->terminate();
?>
