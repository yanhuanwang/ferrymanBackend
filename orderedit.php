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
$order_edit = new order_edit();

// Run the page
$order_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var forderedit = currentForm = new ew.Form("forderedit", "edit");

// Validate form
forderedit.validate = function() {
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
		<?php if ($order_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->id->caption(), $order->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_edit->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->user_id->caption(), $order->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_edit->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->from_place->caption(), $order->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_edit->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->to_place->caption(), $order->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_edit->date->Required) { ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->date->caption(), $order->date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($order->date->errorMessage()) ?>");
		<?php if ($order_edit->flight_number->Required) { ?>
			elm = this.getElements("x" + infix + "_flight_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->flight_number->caption(), $order->flight_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_edit->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->description->caption(), $order->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_edit->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->createdAt->caption(), $order->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($order->createdAt->errorMessage()) ?>");
		<?php if ($order_edit->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->updatedAt->caption(), $order->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($order->updatedAt->errorMessage()) ?>");

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
forderedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
forderedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
forderedit.lists["x_user_id"] = <?php echo $order_edit->user_id->Lookup->toClientList() ?>;
forderedit.lists["x_user_id"].options = <?php echo JsonEncode($order_edit->user_id->lookupOptions()) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $order_edit->showPageHeader(); ?>
<?php
$order_edit->showMessage();
?>
<?php if (!$order_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($order_edit->Pager)) $order_edit->Pager = new NumericPager($order_edit->StartRec, $order_edit->DisplayRecs, $order_edit->TotalRecs, $order_edit->RecRange, $order_edit->AutoHidePager) ?>
<?php if ($order_edit->Pager->RecordCount > 0 && $order_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($order_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($order_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($order_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $order_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($order_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($order_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="forderedit" id="forderedit" class="<?php echo $order_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($order_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $order_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="order">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$order_edit->IsModal ?>">
<?php if ($order->getCurrentMasterTable() == "user") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $order->user_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($order->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_order_id" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->id->caption() ?><?php echo ($order->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->id->cellAttributes() ?>>
<span id="el_order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($order->id->CurrentValue) ?>">
<?php echo $order->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->user_id->Visible) { // user_id ?>
	<div id="r_user_id" class="form-group row">
		<label id="elh_order_user_id" for="x_user_id" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->user_id->caption() ?><?php echo ($order->user_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->user_id->cellAttributes() ?>>
<?php if ($order->user_id->getSessionValue() <> "") { ?>
<span id="el_order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_user_id" name="x_user_id" value="<?php echo HtmlEncode($order->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_order_user_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="order" data-field="x_user_id" data-value-separator="<?php echo $order->user_id->displayValueSeparatorAttribute() ?>" id="x_user_id" name="x_user_id"<?php echo $order->user_id->editAttributes() ?>>
		<?php echo $order->user_id->selectOptionListHtml("x_user_id") ?>
	</select>
<?php echo $order->user_id->Lookup->getParamTag("p_x_user_id") ?>
</div>
</span>
<?php } ?>
<?php echo $order->user_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->from_place->Visible) { // from_place ?>
	<div id="r_from_place" class="form-group row">
		<label id="elh_order_from_place" for="x_from_place" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->from_place->caption() ?><?php echo ($order->from_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->from_place->cellAttributes() ?>>
<span id="el_order_from_place">
<input type="text" data-table="order" data-field="x_from_place" name="x_from_place" id="x_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->from_place->getPlaceHolder()) ?>" value="<?php echo $order->from_place->EditValue ?>"<?php echo $order->from_place->editAttributes() ?>>
</span>
<?php echo $order->from_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->to_place->Visible) { // to_place ?>
	<div id="r_to_place" class="form-group row">
		<label id="elh_order_to_place" for="x_to_place" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->to_place->caption() ?><?php echo ($order->to_place->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->to_place->cellAttributes() ?>>
<span id="el_order_to_place">
<input type="text" data-table="order" data-field="x_to_place" name="x_to_place" id="x_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->to_place->getPlaceHolder()) ?>" value="<?php echo $order->to_place->EditValue ?>"<?php echo $order->to_place->editAttributes() ?>>
</span>
<?php echo $order->to_place->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_order_date" for="x_date" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->date->caption() ?><?php echo ($order->date->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->date->cellAttributes() ?>>
<span id="el_order_date">
<input type="text" data-table="order" data-field="x_date" name="x_date" id="x_date" placeholder="<?php echo HtmlEncode($order->date->getPlaceHolder()) ?>" value="<?php echo $order->date->EditValue ?>"<?php echo $order->date->editAttributes() ?>>
<?php if (!$order->date->ReadOnly && !$order->date->Disabled && !isset($order->date->EditAttrs["readonly"]) && !isset($order->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("forderedit", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $order->date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->flight_number->Visible) { // flight_number ?>
	<div id="r_flight_number" class="form-group row">
		<label id="elh_order_flight_number" for="x_flight_number" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->flight_number->caption() ?><?php echo ($order->flight_number->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->flight_number->cellAttributes() ?>>
<span id="el_order_flight_number">
<input type="text" data-table="order" data-field="x_flight_number" name="x_flight_number" id="x_flight_number" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($order->flight_number->getPlaceHolder()) ?>" value="<?php echo $order->flight_number->EditValue ?>"<?php echo $order->flight_number->editAttributes() ?>>
</span>
<?php echo $order->flight_number->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_order_description" for="x_description" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->description->caption() ?><?php echo ($order->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->description->cellAttributes() ?>>
<span id="el_order_description">
<input type="text" data-table="order" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->description->getPlaceHolder()) ?>" value="<?php echo $order->description->EditValue ?>"<?php echo $order->description->editAttributes() ?>>
</span>
<?php echo $order->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->createdAt->Visible) { // createdAt ?>
	<div id="r_createdAt" class="form-group row">
		<label id="elh_order_createdAt" for="x_createdAt" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->createdAt->caption() ?><?php echo ($order->createdAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->createdAt->cellAttributes() ?>>
<span id="el_order_createdAt">
<input type="text" data-table="order" data-field="x_createdAt" name="x_createdAt" id="x_createdAt" placeholder="<?php echo HtmlEncode($order->createdAt->getPlaceHolder()) ?>" value="<?php echo $order->createdAt->EditValue ?>"<?php echo $order->createdAt->editAttributes() ?>>
<?php if (!$order->createdAt->ReadOnly && !$order->createdAt->Disabled && !isset($order->createdAt->EditAttrs["readonly"]) && !isset($order->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("forderedit", "x_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $order->createdAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($order->updatedAt->Visible) { // updatedAt ?>
	<div id="r_updatedAt" class="form-group row">
		<label id="elh_order_updatedAt" for="x_updatedAt" class="<?php echo $order_edit->LeftColumnClass ?>"><?php echo $order->updatedAt->caption() ?><?php echo ($order->updatedAt->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $order_edit->RightColumnClass ?>"><div<?php echo $order->updatedAt->cellAttributes() ?>>
<span id="el_order_updatedAt">
<input type="text" data-table="order" data-field="x_updatedAt" name="x_updatedAt" id="x_updatedAt" placeholder="<?php echo HtmlEncode($order->updatedAt->getPlaceHolder()) ?>" value="<?php echo $order->updatedAt->EditValue ?>"<?php echo $order->updatedAt->editAttributes() ?>>
<?php if (!$order->updatedAt->ReadOnly && !$order->updatedAt->Disabled && !isset($order->updatedAt->EditAttrs["readonly"]) && !isset($order->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("forderedit", "x_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $order->updatedAt->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$order_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $order_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $order_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$order_edit->IsModal) { ?>
<?php if (!isset($order_edit->Pager)) $order_edit->Pager = new NumericPager($order_edit->StartRec, $order_edit->DisplayRecs, $order_edit->TotalRecs, $order_edit->RecRange, $order_edit->AutoHidePager) ?>
<?php if ($order_edit->Pager->RecordCount > 0 && $order_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($order_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($order_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($order_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $order_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($order_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($order_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $order_edit->pageUrl() ?>start=<?php echo $order_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$order_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$order_edit->terminate();
?>
