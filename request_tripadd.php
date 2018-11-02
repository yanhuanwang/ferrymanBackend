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
		<?php if ($request_trip_add->date->Required) { ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->date->caption(), $request_trip->date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->date->errorMessage()) ?>");
		<?php if ($request_trip_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->description->caption(), $request_trip->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_add->category->Required) { ?>
			elm = this.getElements("x" + infix + "_category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->category->caption(), $request_trip->category->RequiredErrorMessage)) ?>");
		<?php } ?>

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
frequest_tripadd.lists["x_category"] = <?php echo $request_trip_add->category->Lookup->toClientList() ?>;
frequest_tripadd.lists["x_category"].options = <?php echo JsonEncode($request_trip_add->category->lookupOptions()) ?>;

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
<?php if ($request_trip->getCurrentMasterTable() == "category") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="category">
<input type="hidden" name="fk_id" value="<?php echo $request_trip->category->getSessionValue() ?>">
<?php } ?>
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
<?php if ($request_trip->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_request_trip_date" for="x_date" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->date->caption() ?><?php echo ($request_trip->date->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->date->cellAttributes() ?>>
<span id="el_request_trip_date">
<input type="text" data-table="request_trip" data-field="x_date" name="x_date" id="x_date" placeholder="<?php echo HtmlEncode($request_trip->date->getPlaceHolder()) ?>" value="<?php echo $request_trip->date->EditValue ?>"<?php echo $request_trip->date->editAttributes() ?>>
<?php if (!$request_trip->date->ReadOnly && !$request_trip->date->Disabled && !isset($request_trip->date->EditAttrs["readonly"]) && !isset($request_trip->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripadd", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $request_trip->date->CustomMsg ?></div></div>
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
<?php if ($request_trip->category->Visible) { // category ?>
	<div id="r_category" class="form-group row">
		<label id="elh_request_trip_category" for="x_category" class="<?php echo $request_trip_add->LeftColumnClass ?>"><?php echo $request_trip->category->caption() ?><?php echo ($request_trip->category->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $request_trip_add->RightColumnClass ?>"><div<?php echo $request_trip->category->cellAttributes() ?>>
<?php if ($request_trip->category->getSessionValue() <> "") { ?>
<span id="el_request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->category->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_category" name="x_category" value="<?php echo HtmlEncode($request_trip->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el_request_trip_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="request_trip" data-field="x_category" data-value-separator="<?php echo $request_trip->category->displayValueSeparatorAttribute() ?>" id="x_category" name="x_category"<?php echo $request_trip->category->editAttributes() ?>>
		<?php echo $request_trip->category->selectOptionListHtml("x_category") ?>
	</select>
<?php echo $request_trip->category->Lookup->getParamTag("p_x_category") ?>
</div>
</span>
<?php } ?>
<?php echo $request_trip->category->CustomMsg ?></div></div>
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
