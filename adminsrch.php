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
$admin_search = new admin_search();

// Run the page
$admin_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$admin_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "search";
<?php if ($admin_search->IsModal) { ?>
var fadminsearch = currentAdvancedSearchForm = new ew.Form("fadminsearch", "search");
<?php } else { ?>
var fadminsearch = currentForm = new ew.Form("fadminsearch", "search");
<?php } ?>

// Form_CustomValidate event
fadminsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fadminsearch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search
// Validate function for search

fadminsearch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";
	elm = this.getElements("x" + infix + "_id");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($admin->id->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_level");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($admin->level->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_locked");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($admin->locked->errorMessage()) ?>");
	elm = this.getElements("x" + infix + "_activated");
	if (elm && !ew.checkInteger(elm.value))
		return this.onError(elm, "<?php echo JsEncode($admin->activated->errorMessage()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $admin_search->showPageHeader(); ?>
<?php
$admin_search->showMessage();
?>
<form name="fadminsearch" id="fadminsearch" class="<?php echo $admin_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($admin_search->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $admin_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="admin">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$admin_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($admin->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $admin_search->LeftColumnClass ?>"><span id="elh_admin_id"><?php echo $admin->id->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span>
		</label>
		<div class="<?php echo $admin_search->RightColumnClass ?>"><div<?php echo $admin->id->cellAttributes() ?>>
			<span id="el_admin_id">
<input type="text" data-table="admin" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo HtmlEncode($admin->id->getPlaceHolder()) ?>" value="<?php echo $admin->id->EditValue ?>"<?php echo $admin->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($admin->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label for="x_username" class="<?php echo $admin_search->LeftColumnClass ?>"><span id="elh_admin_username"><?php echo $admin->username->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_username" id="z_username" value="LIKE"></span>
		</label>
		<div class="<?php echo $admin_search->RightColumnClass ?>"><div<?php echo $admin->username->cellAttributes() ?>>
			<span id="el_admin_username">
<input type="text" data-table="admin" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->username->getPlaceHolder()) ?>" value="<?php echo $admin->username->EditValue ?>"<?php echo $admin->username->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($admin->level->Visible) { // level ?>
	<div id="r_level" class="form-group row">
		<label for="x_level" class="<?php echo $admin_search->LeftColumnClass ?>"><span id="elh_admin_level"><?php echo $admin->level->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_level" id="z_level" value="="></span>
		</label>
		<div class="<?php echo $admin_search->RightColumnClass ?>"><div<?php echo $admin->level->cellAttributes() ?>>
			<span id="el_admin_level">
<input type="text" data-table="admin" data-field="x_level" name="x_level" id="x_level" size="30" placeholder="<?php echo HtmlEncode($admin->level->getPlaceHolder()) ?>" value="<?php echo $admin->level->EditValue ?>"<?php echo $admin->level->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($admin->locked->Visible) { // locked ?>
	<div id="r_locked" class="form-group row">
		<label for="x_locked" class="<?php echo $admin_search->LeftColumnClass ?>"><span id="elh_admin_locked"><?php echo $admin->locked->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_locked" id="z_locked" value="="></span>
		</label>
		<div class="<?php echo $admin_search->RightColumnClass ?>"><div<?php echo $admin->locked->cellAttributes() ?>>
			<span id="el_admin_locked">
<input type="text" data-table="admin" data-field="x_locked" name="x_locked" id="x_locked" size="30" placeholder="<?php echo HtmlEncode($admin->locked->getPlaceHolder()) ?>" value="<?php echo $admin->locked->EditValue ?>"<?php echo $admin->locked->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($admin->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label for="x__email" class="<?php echo $admin_search->LeftColumnClass ?>"><span id="elh_admin__email"><?php echo $admin->_email->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__email" id="z__email" value="LIKE"></span>
		</label>
		<div class="<?php echo $admin_search->RightColumnClass ?>"><div<?php echo $admin->_email->cellAttributes() ?>>
			<span id="el_admin__email">
<input type="text" data-table="admin" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($admin->_email->getPlaceHolder()) ?>" value="<?php echo $admin->_email->EditValue ?>"<?php echo $admin->_email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($admin->activated->Visible) { // activated ?>
	<div id="r_activated" class="form-group row">
		<label for="x_activated" class="<?php echo $admin_search->LeftColumnClass ?>"><span id="elh_admin_activated"><?php echo $admin->activated->caption() ?></span>
		<span class="ew-search-operator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_activated" id="z_activated" value="="></span>
		</label>
		<div class="<?php echo $admin_search->RightColumnClass ?>"><div<?php echo $admin->activated->cellAttributes() ?>>
			<span id="el_admin_activated">
<input type="text" data-table="admin" data-field="x_activated" name="x_activated" id="x_activated" size="30" placeholder="<?php echo HtmlEncode($admin->activated->getPlaceHolder()) ?>" value="<?php echo $admin->activated->EditValue ?>"<?php echo $admin->activated->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$admin_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $admin_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$admin_search->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$admin_search->terminate();
?>
