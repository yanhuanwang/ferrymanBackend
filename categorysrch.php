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
$category_search = new category_search();

// Run the page
$category_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($category_search->IsModal) { ?>
var fcategorysearch = currentAdvancedSearchForm = new ew.Form("fcategorysearch", "search");
<?php } else { ?>
var fcategorysearch = currentForm = new ew.Form("fcategorysearch", "search");
<?php } ?>

// Form_CustomValidate event
fcategorysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorysearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fcategorysearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($category->id->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $category_search->showPageHeader(); ?>
<?php
$category_search->showMessage();
?>
<form name="fcategorysearch" id="fcategorysearch" class="<?php echo $category_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$category_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($category->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $category_search->LeftColumnClass ?>"><span id="elh_category_id"><?php echo $category->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $category_search->RightColumnClass ?>"><div<?php echo $category->id->cellAttributes() ?>>
			<span id="el_category_id">
<input type="text" data-table="category" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($category->id->getPlaceHolder()) ?>" value="<?php echo $category->id->EditValue ?>"<?php echo $category->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label for="x_name" class="<?php echo $category_search->LeftColumnClass ?>"><span id="elh_category_name"><?php echo $category->name->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span>
		</label>
		<div class="<?php echo $category_search->RightColumnClass ?>"><div<?php echo $category->name->cellAttributes() ?>>
			<span id="el_category_name">
<input type="text" data-table="category" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label for="x_description" class="<?php echo $category_search->LeftColumnClass ?>"><span id="elh_category_description"><?php echo $category->description->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_description" id="z_description" value="LIKE"></span>
		</label>
		<div class="<?php echo $category_search->RightColumnClass ?>"><div<?php echo $category->description->cellAttributes() ?>>
			<span id="el_category_description">
<input type="text" data-table="category" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$category_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $category_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$category_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$category_search->terminate();
?>
