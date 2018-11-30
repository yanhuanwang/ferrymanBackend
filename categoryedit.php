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
$category_edit = new category_edit();

// Run the page
$category_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcategoryedit = currentForm = new ew.Form("fcategoryedit", "edit");

// Validate form
fcategoryedit.validate = function() {
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
		<?php if ($category_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->id->caption(), $category->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($category_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->name->caption(), $category->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($category_edit->description->Required) { ?>
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
fcategoryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoryedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $category_edit->showPageHeader(); ?>
<?php
$category_edit->showMessage();
?>
<?php if (!$category_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($category_edit->Pager)) $category_edit->Pager = new NumericPager($category_edit->StartRec, $category_edit->DisplayRecs, $category_edit->TotalRecs, $category_edit->RecRange, $category_edit->AutoHidePager) ?>
<?php if ($category_edit->Pager->RecordCount > 0 && $category_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($category_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($category_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($category_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $category_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($category_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($category_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcategoryedit" id="fcategoryedit" class="<?php echo $category_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$category_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($category->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_category_id" class="<?php echo $category_edit->LeftColumnClass ?>"><?php echo $category->id->caption() ?><?php echo ($category->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_edit->RightColumnClass ?>"><div<?php echo $category->id->cellAttributes() ?>>
<span id="el_category_id">
<span<?php echo $category->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($category->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="category" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($category->id->CurrentValue) ?>">
<?php echo $category->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_category_name" for="x_name" class="<?php echo $category_edit->LeftColumnClass ?>"><?php echo $category->name->caption() ?><?php echo ($category->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_edit->RightColumnClass ?>"><div<?php echo $category->name->cellAttributes() ?>>
<span id="el_category_name">
<input type="text" data-table="category" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<?php echo $category->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_category_description" for="x_description" class="<?php echo $category_edit->LeftColumnClass ?>"><?php echo $category->description->caption() ?><?php echo ($category->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_edit->RightColumnClass ?>"><div<?php echo $category->description->cellAttributes() ?>>
<span id="el_category_description">
<input type="text" data-table="category" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($category->description->getPlaceHolder()) ?>" value="<?php echo $category->description->EditValue ?>"<?php echo $category->description->editAttributes() ?>>
</span>
<?php echo $category->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$category_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $category_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$category_edit->IsModal) { ?>
<?php if (!isset($category_edit->Pager)) $category_edit->Pager = new NumericPager($category_edit->StartRec, $category_edit->DisplayRecs, $category_edit->TotalRecs, $category_edit->RecRange, $category_edit->AutoHidePager) ?>
<?php if ($category_edit->Pager->RecordCount > 0 && $category_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($category_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($category_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($category_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $category_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($category_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($category_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $category_edit->pageUrl() ?>start=<?php echo $category_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$category_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$category_edit->terminate();
?>
