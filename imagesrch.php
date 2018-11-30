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
	elm = this.getElements("x" + infix + "_user_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($image->user_id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_confirmed");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($image->confirmed->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_createdAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($image->createdAt->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_updatedAt");
	if (elm && !ew.checkDateDef(elm.value))
		return this.onError(elm, "<?php echo JsEncode($image->updatedAt->errorMessage()) ?>");

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
<?php if ($image->uuid->Visible) { // uuid ?>
	<div id="r_uuid" class="form-group row">
		<label for="x_uuid" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_uuid"><?php echo $image->uuid->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_uuid" id="z_uuid" value="LIKE"></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->uuid->cellAttributes() ?>>
			<span id="el_image_uuid">
<input type="text" data-table="image" data-field="x_uuid" name="x_uuid" id="x_uuid" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($image->uuid->getPlaceHolder()) ?>" value="<?php echo $image->uuid->EditValue ?>"<?php echo $image->uuid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label for="x_user_id" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_user_id"><?php echo $image->user_id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_user_id" id="z_user_id" value="="></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->user_id->cellAttributes() ?>>
			<span id="el_image_user_id">
<input type="text" data-table="image" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?php echo HtmlEncode($image->user_id->getPlaceHolder()) ?>" value="<?php echo $image->user_id->EditValue ?>"<?php echo $image->user_id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
	<div id="r_confirmed" class="form-group row">
		<label for="x_confirmed" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_confirmed"><?php echo $image->confirmed->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_confirmed" id="z_confirmed" value="="></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->confirmed->cellAttributes() ?>>
			<span id="el_image_confirmed">
<input type="text" data-table="image" data-field="x_confirmed" name="x_confirmed" id="x_confirmed" size="30" placeholder="<?php echo HtmlEncode($image->confirmed->getPlaceHolder()) ?>" value="<?php echo $image->confirmed->EditValue ?>"<?php echo $image->confirmed->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label for="x_createdAt" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_createdAt"><?php echo $image->createdAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_createdAt" id="z_createdAt" value="="></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->createdAt->cellAttributes() ?>>
			<span id="el_image_createdAt">
<input type="text" data-table="image" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($image->createdAt->getPlaceHolder()) ?>" value="<?php echo $image->createdAt->EditValue ?>"<?php echo $image->createdAt->editAttributes() ?>>
<?php if (!$image->createdAt->ReadOnly && !$image->createdAt->Disabled && !isset($image->createdAt->EditAttrs["readonly"]) && !isset($image->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagesearch", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label for="x_updatedAt" class="<?php echo $image_search->LeftColumnClass ?>"><span id="elh_image_updatedAt"><?php echo $image->updatedAt->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_updatedAt" id="z_updatedAt" value="="></span>
		</label>
		<div class="<?php echo $image_search->RightColumnClass ?>"><div<?php echo $image->updatedAt->cellAttributes() ?>>
			<span id="el_image_updatedAt">
<input type="text" data-table="image" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($image->updatedAt->getPlaceHolder()) ?>" value="<?php echo $image->updatedAt->EditValue ?>"<?php echo $image->updatedAt->editAttributes() ?>>
<?php if (!$image->updatedAt->ReadOnly && !$image->updatedAt->Disabled && !isset($image->updatedAt->EditAttrs["readonly"]) && !isset($image->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimagesearch", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
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
