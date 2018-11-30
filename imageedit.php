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
$image_edit = new image_edit();

// Run the page
$image_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fimageedit = currentForm = new ew.Form("fimageedit", "edit");

// Validate form
fimageedit.validate = function() {
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
		<?php if ($image_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->id->caption(), $image->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->id->errorMessage()) ?>");
		<?php if ($image_edit->path->Required) { ?>
			felm = this.getElements("x" + infix + "_path");
			elm = this.getElements("fn_x" + infix + "_path");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $image->path->caption(), $image->path->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_edit->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->description->caption(), $image->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_edit->uuid->Required) { ?>
			elm = this.getElements("x" + infix + "_uuid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->uuid->caption(), $image->uuid->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_edit->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->user_id->caption(), $image->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->user_id->errorMessage()) ?>");
		<?php if ($image_edit->confirmed->Required) { ?>
			elm = this.getElements("x" + infix + "_confirmed");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->confirmed->caption(), $image->confirmed->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_confirmed");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->confirmed->errorMessage()) ?>");
		<?php if ($image_edit->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->createdAt->caption(), $image->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->createdAt->errorMessage()) ?>");
		<?php if ($image_edit->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->updatedAt->caption(), $image->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->updatedAt->errorMessage()) ?>");

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
fimageedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimageedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $image_edit->showPageHeader(); ?>
<?php
$image_edit->showMessage();
?>
<?php if (!$image_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($image_edit->Pager)) $image_edit->Pager = new NumericPager($image_edit->StartRec, $image_edit->DisplayRecs, $image_edit->TotalRecs, $image_edit->RecRange, $image_edit->AutoHidePager) ?>
<?php if ($image_edit->Pager->RecordCount > 0 && $image_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($image_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($image_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($image_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $image_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($image_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($image_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fimageedit" id="fimageedit" class="<?php echo $image_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($image_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $image_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="image">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$image_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($image->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_image_id" for="x_id" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->id->caption() ?><?php echo ($image->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->id->cellAttributes() ?>>
<span id="el_image_id">
<span<?php echo $image->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($image->id->CurrentValue) ?>">
<?php echo $image->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->path->Visible) { // path ?>
	<div id="r_path" class="form-group row">
		<label id="elh_image_path" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->path->caption() ?><?php echo ($image->path->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->path->cellAttributes() ?>>
<span id="el_image_path">
<div id="fd_x_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x_path" id="x_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_path" id= "fn_x_path" value="<?php echo $image->path->Upload->FileName ?>">
<?php if (Post("fa_x_path") == "0") { ?>
<input type="hidden" name="fa_x_path" id= "fa_x_path" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_path" id= "fa_x_path" value="1">
<?php } ?>
<input type="hidden" name="fs_x_path" id= "fs_x_path" value="256">
<input type="hidden" name="fx_x_path" id= "fx_x_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_path" id= "fm_x_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $image->path->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_image_description" for="x_description" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->description->caption() ?><?php echo ($image->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->description->cellAttributes() ?>>
<span id="el_image_description">
<input type="text" data-table="image" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<?php echo $image->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->uuid->Visible) { // uuid ?>
	<div id="r_uuid" class="form-group row">
		<label id="elh_image_uuid" for="x_uuid" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->uuid->caption() ?><?php echo ($image->uuid->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->uuid->cellAttributes() ?>>
<span id="el_image_uuid">
<input type="text" data-table="image" data-field="x_uuid" name="x_uuid" id="x_uuid" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($image->uuid->getPlaceHolder()) ?>" value="<?php echo $image->uuid->EditValue ?>"<?php echo $image->uuid->editAttributes() ?>>
</span>
<?php echo $image->uuid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_image_user_id" for="x_user_id" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->user_id->caption() ?><?php echo ($image->user_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->user_id->cellAttributes() ?>>
<span id="el_image_user_id">
<input type="text" data-table="image" data-field="x_user_id" name="x_user_id" id="x_user_id" size="30" placeholder="<?php echo HtmlEncode($image->user_id->getPlaceHolder()) ?>" value="<?php echo $image->user_id->EditValue ?>"<?php echo $image->user_id->editAttributes() ?>>
</span>
<?php echo $image->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
	<div id="r_confirmed" class="form-group row">
		<label id="elh_image_confirmed" for="x_confirmed" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->confirmed->caption() ?><?php echo ($image->confirmed->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->confirmed->cellAttributes() ?>>
<span id="el_image_confirmed">
<input type="text" data-table="image" data-field="x_confirmed" name="x_confirmed" id="x_confirmed" size="30" placeholder="<?php echo HtmlEncode($image->confirmed->getPlaceHolder()) ?>" value="<?php echo $image->confirmed->EditValue ?>"<?php echo $image->confirmed->editAttributes() ?>>
</span>
<?php echo $image->confirmed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_image_createdAt" for="x_createdAt" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->createdAt->caption() ?><?php echo ($image->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->createdAt->cellAttributes() ?>>
<span id="el_image_createdAt">
<input type="text" data-table="image" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($image->createdAt->getPlaceHolder()) ?>" value="<?php echo $image->createdAt->EditValue ?>"<?php echo $image->createdAt->editAttributes() ?>>
<?php if (!$image->createdAt->ReadOnly && !$image->createdAt->Disabled && !isset($image->createdAt->EditAttrs["readonly"]) && !isset($image->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimageedit", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $image->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_image_updatedAt" for="x_updatedAt" class="<?php echo $image_edit->LeftColumnClass ?>"><?php echo $image->updatedAt->caption() ?><?php echo ($image->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $image_edit->RightColumnClass ?>"><div<?php echo $image->updatedAt->cellAttributes() ?>>
<span id="el_image_updatedAt">
<input type="text" data-table="image" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($image->updatedAt->getPlaceHolder()) ?>" value="<?php echo $image->updatedAt->EditValue ?>"<?php echo $image->updatedAt->editAttributes() ?>>
<?php if (!$image->updatedAt->ReadOnly && !$image->updatedAt->Disabled && !isset($image->updatedAt->EditAttrs["readonly"]) && !isset($image->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fimageedit", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $image->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("parcel_info", explode(",", $image->getCurrentDetailTable())) && $parcel_info->DetailEdit) {
?>
<?php if ($image->getCurrentDetailTable() <> "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->TablePhrase("parcel_info", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "parcel_infogrid.php" ?>
<?php } ?>
<?php if (!$image_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $image_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $image_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$image_edit->IsModal) { ?>
<?php if (!isset($image_edit->Pager)) $image_edit->Pager = new NumericPager($image_edit->StartRec, $image_edit->DisplayRecs, $image_edit->TotalRecs, $image_edit->RecRange, $image_edit->AutoHidePager) ?>
<?php if ($image_edit->Pager->RecordCount > 0 && $image_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($image_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($image_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($image_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $image_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($image_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($image_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $image_edit->pageUrl() ?>start=<?php echo $image_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$image_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$image_edit->terminate();
?>
