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
$orders_edit = new orders_edit();

// Run the page
$orders_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fordersedit = currentForm = new ew.Form("fordersedit", "edit");

// Validate form
fordersedit.validate = function() {
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
		<?php if ($orders_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->id->caption(), $orders->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_edit->_userid->Required) { ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->_userid->caption(), $orders->_userid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->_userid->errorMessage()) ?>");
		<?php if ($orders_edit->parcel_id->Required) { ?>
			elm = this.getElements("x" + infix + "_parcel_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->parcel_id->caption(), $orders->parcel_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_parcel_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->parcel_id->errorMessage()) ?>");
		<?php if ($orders_edit->carrier_id->Required) { ?>
			elm = this.getElements("x" + infix + "_carrier_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->carrier_id->caption(), $orders->carrier_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_carrier_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->carrier_id->errorMessage()) ?>");
		<?php if ($orders_edit->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->description->caption(), $orders->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_edit->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->status->caption(), $orders->status->RequiredErrorMessage)) ?>");
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
fordersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fordersedit.lists["x__userid"] = <?php echo $orders_edit->_userid->Lookup->toClientList() ?>;
fordersedit.lists["x__userid"].options = <?php echo JsonEncode($orders_edit->_userid->lookupOptions()) ?>;
fordersedit.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersedit.lists["x_parcel_id"] = <?php echo $orders_edit->parcel_id->Lookup->toClientList() ?>;
fordersedit.lists["x_parcel_id"].options = <?php echo JsonEncode($orders_edit->parcel_id->lookupOptions()) ?>;
fordersedit.autoSuggests["x_parcel_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersedit.lists["x_carrier_id"] = <?php echo $orders_edit->carrier_id->Lookup->toClientList() ?>;
fordersedit.lists["x_carrier_id"].options = <?php echo JsonEncode($orders_edit->carrier_id->lookupOptions()) ?>;
fordersedit.autoSuggests["x_carrier_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersedit.lists["x_status"] = <?php echo $orders_edit->status->Lookup->toClientList() ?>;
fordersedit.lists["x_status"].options = <?php echo JsonEncode($orders_edit->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $orders_edit->showPageHeader(); ?>
<?php
$orders_edit->showMessage();
?>
<?php if (!$orders_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($orders_edit->Pager)) $orders_edit->Pager = new NumericPager($orders_edit->StartRec, $orders_edit->DisplayRecs, $orders_edit->TotalRecs, $orders_edit->RecRange, $orders_edit->AutoHidePager) ?>
<?php if ($orders_edit->Pager->RecordCount > 0 && $orders_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($orders_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($orders_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($orders_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $orders_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($orders_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($orders_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fordersedit" id="fordersedit" class="<?php echo $orders_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($orders_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $orders_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="orders">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$orders_edit->IsModal ?>">
<?php if ($orders->getCurrentMasterTable() == "user") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="user">
<input type="hidden" name="fk_id" value="<?php echo $orders->_userid->getSessionValue() ?>">
<input type="hidden" name="fk_id" value="<?php echo $orders->carrier_id->getSessionValue() ?>">
<?php } ?>
<?php if ($orders->getCurrentMasterTable() == "parcel_info") { ?>
<input type="hidden" name="<?php echo TABLE_SHOW_MASTER ?>" value="parcel_info">
<input type="hidden" name="fk_id" value="<?php echo $orders->parcel_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($orders->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_orders_id" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders->id->caption() ?><?php echo ($orders->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div<?php echo $orders->id->cellAttributes() ?>>
<span id="el_orders_id">
<span<?php echo $orders->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($orders->id->CurrentValue) ?>">
<?php echo $orders->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders->_userid->Visible) { // userid ?>
	<div id="r__userid" class="form-group row">
		<label id="elh_orders__userid" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders->_userid->caption() ?><?php echo ($orders->_userid->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div<?php echo $orders->_userid->cellAttributes() ?>>
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el_orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x__userid" name="x__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x__userid" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x__userid" id="sv_x__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersedit.createAutoSuggest({"id":"x__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $orders->_userid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
	<div id="r_parcel_id" class="form-group row">
		<label id="elh_orders_parcel_id" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders->parcel_id->caption() ?><?php echo ($orders->parcel_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div<?php echo $orders->parcel_id->cellAttributes() ?>>
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el_orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_parcel_id" name="x_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_parcel_id" class="text-nowrap" style="z-index: 8970">
	<input type="text" class="form-control" name="sv_x_parcel_id" id="sv_x_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x_parcel_id" id="x_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersedit.createAutoSuggest({"id":"x_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $orders->parcel_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
	<div id="r_carrier_id" class="form-group row">
		<label id="elh_orders_carrier_id" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders->carrier_id->caption() ?><?php echo ($orders->carrier_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div<?php echo $orders->carrier_id->cellAttributes() ?>>
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el_orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x_carrier_id" name="x_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_carrier_id" class="text-nowrap" style="z-index: 8960">
	<input type="text" class="form-control" name="sv_x_carrier_id" id="sv_x_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x_carrier_id" id="x_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersedit.createAutoSuggest({"id":"x_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $orders->carrier_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
	<div id="r_description" class="form-group row">
		<label id="elh_orders_description" for="x_description" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders->description->caption() ?><?php echo ($orders->description->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div<?php echo $orders->description->cellAttributes() ?>>
<span id="el_orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x_description" id="x_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<?php echo $orders->description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_orders_status" for="x_status" class="<?php echo $orders_edit->LeftColumnClass ?>"><?php echo $orders->status->caption() ?><?php echo ($orders->status->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $orders_edit->RightColumnClass ?>"><div<?php echo $orders->status->cellAttributes() ?>>
<span id="el_orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x_status") ?>
	</select>
</div>
</span>
<?php echo $orders->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$orders_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $orders_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $orders_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$orders_edit->IsModal) { ?>
<?php if (!isset($orders_edit->Pager)) $orders_edit->Pager = new NumericPager($orders_edit->StartRec, $orders_edit->DisplayRecs, $orders_edit->TotalRecs, $orders_edit->RecRange, $orders_edit->AutoHidePager) ?>
<?php if ($orders_edit->Pager->RecordCount > 0 && $orders_edit->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($orders_edit->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($orders_edit->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($orders_edit->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $orders_edit->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($orders_edit->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($orders_edit->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $orders_edit->pageUrl() ?>start=<?php echo $orders_edit->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$orders_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$orders_edit->terminate();
?>
