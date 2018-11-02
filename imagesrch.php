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
$image_search = new image_search();

// Run the page
$image_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($image_search->IsModal) { ?>
var fimagesearch = currentAdvancedSearchForm = new ew.Form("fimagesearch", "search");
<?php } else { ?>
var fimagesearch = currentForm = new ew.Form("fimagesearch", "search");
<?php } ?>

// Form_CustomValidate event
fimagesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimagesearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fimagesearch.lists["x__userid"] = <?php echo $image_search->_userid->Lookup->toClientList() ?>;
fimagesearch.lists["x__userid"].options = <?php echo JsonEncode($image_search->_userid->lookupOptions()) ?>;
fimagesearch.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
// Validate function for search

fimagesearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($image->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "__userid");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($image->_userid->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $image_search->showPageHeader(); ?>
<?php
$image_search->showMessage();
?>
<form name="fimagesearch" id="fimagesearch" class="<?php echo $image_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($image_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $image_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="image">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$image_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($image->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_id"><?php echo $image->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->id->cellAttributes() ?>>
			<span id="el_image_id">
<input type="text" data-table="image" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($image->id->getPlaceHolder()) ?>" value="<?php echo $image->id->EditValue ?>"<?php echo $image->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label for="x_name" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_name"><?php echo $image->name->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->name->cellAttributes() ?>>
			<span id="el_image_name">
<input type="text" data-table="image" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->name->getPlaceHolder()) ?>" value="<?php echo $image->name->EditValue ?>"<?php echo $image->name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->_userid->Visible) { // userid ?>
	<div id="r__userid" class="form-group row">
		<label class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image__userid"><?php echo $image->_userid->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z__userid" id="z__userid" value="="></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->_userid->cellAttributes() ?>>
			<span id="el_image__userid">
<?php
$wrkonchange = "" . trim(@$image->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$image->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x__userid" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x__userid" id="sv_x__userid" value="<?php echo RemoveHtml($image->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>"<?php echo $image->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x__userid" data-value-separator="<?php echo $image->_userid->displayValueSeparatorAttribute() ?>" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($image->_userid->AdvancedSearch->SearchValue) ?>"<?php echo $wrkonchange ?>>
<script>
fimagesearch.createAutoSuggest({"id":"x__userid","forceSelect":false});
</script>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label for="x_description" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_description"><?php echo $image->description->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->description->cellAttributes() ?>>
			<span id="el_image_description">
<input type="text" data-table="image" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$image_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $image_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$image_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$image_search->terminate();
?>
