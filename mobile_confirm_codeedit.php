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
$mobile_confirm_code_edit = new mobile_confirm_code_edit();

// Run the page
$mobile_confirm_code_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mobile_confirm_code_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fmobile_confirm_codeedit = currentForm = new ew.Form("fmobile_confirm_codeedit", "edit");

// Validate form
fmobile_confirm_codeedit.validate = function() {
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
		<?php if ($mobile_confirm_code_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mobile_confirm_code->id->caption(), $mobile_confirm_code->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($mobile_confirm_code_edit->mobile_phone->Required) { ?>
			elm = this.getElements("x" + infix + "_mobile_phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mobile_confirm_code->mobile_phone->caption(), $mobile_confirm_code->mobile_phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($mobile_confirm_code_edit->code->Required) { ?>
			elm = this.getElements("x" + infix + "_code");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mobile_confirm_code->code->caption(), $mobile_confirm_code->code->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($mobile_confirm_code_edit->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mobile_confirm_code->createdAt->caption(), $mobile_confirm_code->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($mobile_confirm_code->createdAt->errorMessage()) ?>");
		<?php if ($mobile_confirm_code_edit->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mobile_confirm_code->updatedAt->caption(), $mobile_confirm_code->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($mobile_confirm_code->updatedAt->errorMessage()) ?>");

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
fmobile_confirm_codeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmobile_confirm_codeedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $mobile_confirm_code_edit->showPageHeader(); ?>
<?php
$mobile_confirm_code_edit->showMessage();
?>
<?php if (!$mobile_confirm_code_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($mobile_confirm_code_edit->Pager)) $mobile_confirm_code_edit->Pager = new NumericPager($mobile_confirm_code_edit->StartRec, $mobile_confirm_code_edit->DisplayRecs, $mobile_confirm_code_edit->TotalRecs, $mobile_confirm_code_edit->RecRange, $mobile_confirm_code_edit->AutoHidePager) ?>
<?php if ($mobile_confirm_code_edit->Pager->RecordCount > 0 && $mobile_confirm_code_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($mobile_confirm_code_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($mobile_confirm_code_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $mobile_confirm_code_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fmobile_confirm_codeedit" id="fmobile_confirm_codeedit" class="<?php echo $mobile_confirm_code_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($mobile_confirm_code_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $mobile_confirm_code_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mobile_confirm_code">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$mobile_confirm_code_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($mobile_confirm_code->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_mobile_confirm_code_id" class="<?php echo $mobile_confirm_code_edit->LeftColumnClass ?>"><?php echo $mobile_confirm_code->id->caption() ?><?php echo ($mobile_confirm_code->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mobile_confirm_code_edit->RightColumnClass ?>"><div<?php echo $mobile_confirm_code->id->cellAttributes() ?>>
<span id="el_mobile_confirm_code_id">
<span<?php echo $mobile_confirm_code->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($mobile_confirm_code->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="mobile_confirm_code" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($mobile_confirm_code->id->CurrentValue) ?>">
<?php echo $mobile_confirm_code->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mobile_confirm_code->mobile_phone->Visible) { // mobile_phone ?>
	<div id="r_mobile_phone" class="form-group row">
		<label id="elh_mobile_confirm_code_mobile_phone" for="x_mobile_phone" class="<?php echo $mobile_confirm_code_edit->LeftColumnClass ?>"><?php echo $mobile_confirm_code->mobile_phone->caption() ?><?php echo ($mobile_confirm_code->mobile_phone->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mobile_confirm_code_edit->RightColumnClass ?>"><div<?php echo $mobile_confirm_code->mobile_phone->cellAttributes() ?>>
<span id="el_mobile_confirm_code_mobile_phone">
<input type="text" data-table="mobile_confirm_code" data-field="x_mobile_phone" name="x_mobile_phone" id="x_mobile_phone" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($mobile_confirm_code->mobile_phone->getPlaceHolder()) ?>" value="<?php echo $mobile_confirm_code->mobile_phone->EditValue ?>"<?php echo $mobile_confirm_code->mobile_phone->editAttributes() ?>>
</span>
<?php echo $mobile_confirm_code->mobile_phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mobile_confirm_code->code->Visible) { // code ?>
	<div id="r_code" class="form-group row">
		<label id="elh_mobile_confirm_code_code" for="x_code" class="<?php echo $mobile_confirm_code_edit->LeftColumnClass ?>"><?php echo $mobile_confirm_code->code->caption() ?><?php echo ($mobile_confirm_code->code->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mobile_confirm_code_edit->RightColumnClass ?>"><div<?php echo $mobile_confirm_code->code->cellAttributes() ?>>
<span id="el_mobile_confirm_code_code">
<input type="text" data-table="mobile_confirm_code" data-field="x_code" name="x_code" id="x_code" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($mobile_confirm_code->code->getPlaceHolder()) ?>" value="<?php echo $mobile_confirm_code->code->EditValue ?>"<?php echo $mobile_confirm_code->code->editAttributes() ?>>
</span>
<?php echo $mobile_confirm_code->code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mobile_confirm_code->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_mobile_confirm_code_createdAt" for="x_createdAt" class="<?php echo $mobile_confirm_code_edit->LeftColumnClass ?>"><?php echo $mobile_confirm_code->createdAt->caption() ?><?php echo ($mobile_confirm_code->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mobile_confirm_code_edit->RightColumnClass ?>"><div<?php echo $mobile_confirm_code->createdAt->cellAttributes() ?>>
<span id="el_mobile_confirm_code_createdAt">
<input type="text" data-table="mobile_confirm_code" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($mobile_confirm_code->createdAt->getPlaceHolder()) ?>" value="<?php echo $mobile_confirm_code->createdAt->EditValue ?>"<?php echo $mobile_confirm_code->createdAt->editAttributes() ?>>
<?php if (!$mobile_confirm_code->createdAt->ReadOnly && !$mobile_confirm_code->createdAt->Disabled && !isset($mobile_confirm_code->createdAt->EditAttrs["readonly"]) && !isset($mobile_confirm_code->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fmobile_confirm_codeedit", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $mobile_confirm_code->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mobile_confirm_code->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_mobile_confirm_code_updatedAt" for="x_updatedAt" class="<?php echo $mobile_confirm_code_edit->LeftColumnClass ?>"><?php echo $mobile_confirm_code->updatedAt->caption() ?><?php echo ($mobile_confirm_code->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mobile_confirm_code_edit->RightColumnClass ?>"><div<?php echo $mobile_confirm_code->updatedAt->cellAttributes() ?>>
<span id="el_mobile_confirm_code_updatedAt">
<input type="text" data-table="mobile_confirm_code" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($mobile_confirm_code->updatedAt->getPlaceHolder()) ?>" value="<?php echo $mobile_confirm_code->updatedAt->EditValue ?>"<?php echo $mobile_confirm_code->updatedAt->editAttributes() ?>>
<?php if (!$mobile_confirm_code->updatedAt->ReadOnly && !$mobile_confirm_code->updatedAt->Disabled && !isset($mobile_confirm_code->updatedAt->EditAttrs["readonly"]) && !isset($mobile_confirm_code->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fmobile_confirm_codeedit", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $mobile_confirm_code->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mobile_confirm_code_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mobile_confirm_code_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mobile_confirm_code_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$mobile_confirm_code_edit->IsModal) { ?>
<?php if (!isset($mobile_confirm_code_edit->Pager)) $mobile_confirm_code_edit->Pager = new NumericPager($mobile_confirm_code_edit->StartRec, $mobile_confirm_code_edit->DisplayRecs, $mobile_confirm_code_edit->TotalRecs, $mobile_confirm_code_edit->RecRange, $mobile_confirm_code_edit->AutoHidePager) ?>
<?php if ($mobile_confirm_code_edit->Pager->RecordCount > 0 && $mobile_confirm_code_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($mobile_confirm_code_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($mobile_confirm_code_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $mobile_confirm_code_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($mobile_confirm_code_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $mobile_confirm_code_edit->pageUrl() ?>start=<?php echo $mobile_confirm_code_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$mobile_confirm_code_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$mobile_confirm_code_edit->terminate();
?>
