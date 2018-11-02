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
$category_add = new category_add();

// Run the page
$category_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcategoryadd = currentForm = new ew.Form("fcategoryadd", "add");

// Validate form
fcategoryadd.validate = function() {
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
		<?php if ($category_add->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->name->caption(), $category->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($category_add->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->description->caption(), $category->description->RequiredErrorMessage)) ?>");
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
fcategoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoryadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $category_add->showPageHeader(); ?>
<?php
$category_add->showMessage();
?>
<form name="fcategoryadd" id="fcategoryadd" class="<?php echo $category_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$category_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($category->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_category_name" for="x_name" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category->name->caption() ?><?php echo ($category->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div<?php echo $category->name->cellAttributes() ?>>
<span id="el_category_name">
<input type="text" data-table="category" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<?php echo $category->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_category_description" for="x_description" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category->description->caption() ?><?php echo ($category->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div<?php echo $category->description->cellAttributes() ?>>
<span id="el_category_description">
<input type="text" data-table="category" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
<?php echo $category->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($category->getCurrentDetailTable() <> "") { ?>
<?php
	$category_add->DetailPages->ValidKeys = explode(",", $category->getCurrentDetailTable());
	$firstActiveDetailTable = $category_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="category_add_details"><!-- tabs -->
	<ul class="<?php echo $category_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("parcel_info", explode(",", $category->getCurrentDetailTable())) && $parcel_info->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info") {
			$firstActiveDetailTable = "parcel_info";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $category_add->DetailPages->pageStyle("parcel_info") ?>" href="#tab_parcel_info" data-toggle="tab"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("request_trip", explode(",", $category->getCurrentDetailTable())) && $request_trip->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "request_trip") {
			$firstActiveDetailTable = "request_trip";
		}
?>
		<li class="nav-item"><a class="nav-link<?php echo $category_add->DetailPages->pageStyle("request_trip") ?>" href="#tab_request_trip" data-toggle="tab"><?php echo $Language->TablePhrase("request_trip", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("parcel_info", explode(",", $category->getCurrentDetailTable())) && $parcel_info->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "parcel_info")
			$firstActiveDetailTable = "parcel_info";
?>
		<div class="tab-pane<?php echo $category_add->DetailPages->pageStyle("parcel_info") ?>" id="tab_parcel_info"><!-- page* -->
<?php include_once "parcel_infogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("request_trip", explode(",", $category->getCurrentDetailTable())) && $request_trip->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "request_trip")
			$firstActiveDetailTable = "request_trip";
?>
		<div class="tab-pane<?php echo $category_add->DetailPages->pageStyle("request_trip") ?>" id="tab_request_trip"><!-- page* -->
<?php include_once "request_tripgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$category_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$category_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$category_add->terminate();
?>
