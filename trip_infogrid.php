<?php
namespace PHPMaker2019\ferryman;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($trip_info_grid))
	$trip_info_grid = new trip_info_grid();

// Run the page
$trip_info_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$trip_info_grid->Page_Render();
?>
<?php if (!$trip_info->isExport()) { ?>
<script>

// Form object
var ftrip_infogrid = new ew.Form("ftrip_infogrid", "grid");
ftrip_infogrid.formKeyCountName = '<?php echo $trip_info_grid->FormKeyCountName ?>';

// Validate form
ftrip_infogrid.validate = function() {
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
		var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
		<?php if ($trip_info_grid->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->from_place->caption(), $trip_info->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_grid->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->to_place->caption(), $trip_info->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_grid->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->description->caption(), $trip_info->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_grid->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->user_id->caption(), $trip_info->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->user_id->errorMessage()) ?>");
		<?php if ($trip_info_grid->flight_number->Required) { ?>
			elm = this.getElements("x" + infix + "_flight_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->flight_number->caption(), $trip_info->flight_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($trip_info_grid->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->createdAt->caption(), $trip_info->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->createdAt->errorMessage()) ?>");
		<?php if ($trip_info_grid->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->updatedAt->caption(), $trip_info->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->updatedAt->errorMessage()) ?>");
		<?php if ($trip_info_grid->from_date->Required) { ?>
			elm = this.getElements("x" + infix + "_from_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->from_date->caption(), $trip_info->from_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_from_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->from_date->errorMessage()) ?>");
		<?php if ($trip_info_grid->to_date->Required) { ?>
			elm = this.getElements("x" + infix + "_to_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->to_date->caption(), $trip_info->to_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_to_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->to_date->errorMessage()) ?>");
		<?php if ($trip_info_grid->labor_fee->Required) { ?>
			elm = this.getElements("x" + infix + "_labor_fee");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->labor_fee->caption(), $trip_info->labor_fee->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_labor_fee");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->labor_fee->errorMessage()) ?>");
		<?php if ($trip_info_grid->available->Required) { ?>
			elm = this.getElements("x" + infix + "_available");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->available->caption(), $trip_info->available->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_available");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->available->errorMessage()) ?>");
		<?php if ($trip_info_grid->service_type->Required) { ?>
			elm = this.getElements("x" + infix + "_service_type");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->service_type->caption(), $trip_info->service_type->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_service_type");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->service_type->errorMessage()) ?>");
		<?php if ($trip_info_grid->max_carrying_weight->Required) { ?>
			elm = this.getElements("x" + infix + "_max_carrying_weight");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $trip_info->max_carrying_weight->caption(), $trip_info->max_carrying_weight->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_max_carrying_weight");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($trip_info->max_carrying_weight->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ftrip_infogrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "from_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "user_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "flight_number", false)) return false;
	if (ew.valueChanged(fobj, infix, "createdAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "updatedAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "from_date", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_date", false)) return false;
	if (ew.valueChanged(fobj, infix, "labor_fee", false)) return false;
	if (ew.valueChanged(fobj, infix, "available", false)) return false;
	if (ew.valueChanged(fobj, infix, "service_type", false)) return false;
	if (ew.valueChanged(fobj, infix, "max_carrying_weight", false)) return false;
	return true;
}

// Form_CustomValidate event
ftrip_infogrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftrip_infogrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftrip_infogrid.lists["x_user_id"] = <?php echo $trip_info_grid->user_id->Lookup->toClientList() ?>;
ftrip_infogrid.lists["x_user_id"].options = <?php echo JsonEncode($trip_info_grid->user_id->lookupOptions()) ?>;
ftrip_infogrid.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$trip_info_grid->renderOtherOptions();
?>
<?php $trip_info_grid->showPageHeader(); ?>
<?php
$trip_info_grid->showMessage();
?>
<?php if ($trip_info_grid->TotalRecs > 0 || $trip_info->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($trip_info_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> trip_info">
<?php if ($trip_info_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php
	foreach ($trip_info_grid->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="ftrip_infogrid" class="ew-form ew-list-form form-inline">
<div id="gmp_trip_info" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_trip_infogrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$trip_info_grid->RowType = ROWTYPE_HEADER;

// Render list options
$trip_info_grid->renderListOptions();

// Render list options (header, left)
$trip_info_grid->ListOptions->render("header", "left");
?>
<?php if ($trip_info->from_place->Visible) { // from_place ?>
	<?php if ($trip_info->sortUrl($trip_info->from_place) == "") { ?>
		<th data-name="from_place" class="<?php echo $trip_info->from_place->headerCellClass() ?>"><div id="elh_trip_info_from_place" class="trip_info_from_place"><div class="ew-table-header-caption"><?php echo $trip_info->from_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_place" class="<?php echo $trip_info->from_place->headerCellClass() ?>"><div><div id="elh_trip_info_from_place" class="trip_info_from_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->from_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->from_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->from_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->to_place->Visible) { // to_place ?>
	<?php if ($trip_info->sortUrl($trip_info->to_place) == "") { ?>
		<th data-name="to_place" class="<?php echo $trip_info->to_place->headerCellClass() ?>"><div id="elh_trip_info_to_place" class="trip_info_to_place"><div class="ew-table-header-caption"><?php echo $trip_info->to_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_place" class="<?php echo $trip_info->to_place->headerCellClass() ?>"><div><div id="elh_trip_info_to_place" class="trip_info_to_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->to_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->to_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->to_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->description->Visible) { // description ?>
	<?php if ($trip_info->sortUrl($trip_info->description) == "") { ?>
		<th data-name="description" class="<?php echo $trip_info->description->headerCellClass() ?>"><div id="elh_trip_info_description" class="trip_info_description"><div class="ew-table-header-caption"><?php echo $trip_info->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $trip_info->description->headerCellClass() ?>"><div><div id="elh_trip_info_description" class="trip_info_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->description->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->user_id->Visible) { // user_id ?>
	<?php if ($trip_info->sortUrl($trip_info->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $trip_info->user_id->headerCellClass() ?>"><div id="elh_trip_info_user_id" class="trip_info_user_id"><div class="ew-table-header-caption"><?php echo $trip_info->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $trip_info->user_id->headerCellClass() ?>"><div><div id="elh_trip_info_user_id" class="trip_info_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
	<?php if ($trip_info->sortUrl($trip_info->flight_number) == "") { ?>
		<th data-name="flight_number" class="<?php echo $trip_info->flight_number->headerCellClass() ?>"><div id="elh_trip_info_flight_number" class="trip_info_flight_number"><div class="ew-table-header-caption"><?php echo $trip_info->flight_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="flight_number" class="<?php echo $trip_info->flight_number->headerCellClass() ?>"><div><div id="elh_trip_info_flight_number" class="trip_info_flight_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->flight_number->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->flight_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->flight_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
	<?php if ($trip_info->sortUrl($trip_info->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $trip_info->createdAt->headerCellClass() ?>"><div id="elh_trip_info_createdAt" class="trip_info_createdAt"><div class="ew-table-header-caption"><?php echo $trip_info->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $trip_info->createdAt->headerCellClass() ?>"><div><div id="elh_trip_info_createdAt" class="trip_info_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
	<?php if ($trip_info->sortUrl($trip_info->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $trip_info->updatedAt->headerCellClass() ?>"><div id="elh_trip_info_updatedAt" class="trip_info_updatedAt"><div class="ew-table-header-caption"><?php echo $trip_info->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $trip_info->updatedAt->headerCellClass() ?>"><div><div id="elh_trip_info_updatedAt" class="trip_info_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->from_date->Visible) { // from_date ?>
	<?php if ($trip_info->sortUrl($trip_info->from_date) == "") { ?>
		<th data-name="from_date" class="<?php echo $trip_info->from_date->headerCellClass() ?>"><div id="elh_trip_info_from_date" class="trip_info_from_date"><div class="ew-table-header-caption"><?php echo $trip_info->from_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_date" class="<?php echo $trip_info->from_date->headerCellClass() ?>"><div><div id="elh_trip_info_from_date" class="trip_info_from_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->from_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->from_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->from_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->to_date->Visible) { // to_date ?>
	<?php if ($trip_info->sortUrl($trip_info->to_date) == "") { ?>
		<th data-name="to_date" class="<?php echo $trip_info->to_date->headerCellClass() ?>"><div id="elh_trip_info_to_date" class="trip_info_to_date"><div class="ew-table-header-caption"><?php echo $trip_info->to_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_date" class="<?php echo $trip_info->to_date->headerCellClass() ?>"><div><div id="elh_trip_info_to_date" class="trip_info_to_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->to_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->to_date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->to_date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->labor_fee->Visible) { // labor_fee ?>
	<?php if ($trip_info->sortUrl($trip_info->labor_fee) == "") { ?>
		<th data-name="labor_fee" class="<?php echo $trip_info->labor_fee->headerCellClass() ?>"><div id="elh_trip_info_labor_fee" class="trip_info_labor_fee"><div class="ew-table-header-caption"><?php echo $trip_info->labor_fee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="labor_fee" class="<?php echo $trip_info->labor_fee->headerCellClass() ?>"><div><div id="elh_trip_info_labor_fee" class="trip_info_labor_fee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->labor_fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->labor_fee->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->labor_fee->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->available->Visible) { // available ?>
	<?php if ($trip_info->sortUrl($trip_info->available) == "") { ?>
		<th data-name="available" class="<?php echo $trip_info->available->headerCellClass() ?>"><div id="elh_trip_info_available" class="trip_info_available"><div class="ew-table-header-caption"><?php echo $trip_info->available->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="available" class="<?php echo $trip_info->available->headerCellClass() ?>"><div><div id="elh_trip_info_available" class="trip_info_available">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->available->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->available->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->available->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->service_type->Visible) { // service_type ?>
	<?php if ($trip_info->sortUrl($trip_info->service_type) == "") { ?>
		<th data-name="service_type" class="<?php echo $trip_info->service_type->headerCellClass() ?>"><div id="elh_trip_info_service_type" class="trip_info_service_type"><div class="ew-table-header-caption"><?php echo $trip_info->service_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="service_type" class="<?php echo $trip_info->service_type->headerCellClass() ?>"><div><div id="elh_trip_info_service_type" class="trip_info_service_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->service_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->service_type->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->service_type->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($trip_info->max_carrying_weight->Visible) { // max_carrying_weight ?>
	<?php if ($trip_info->sortUrl($trip_info->max_carrying_weight) == "") { ?>
		<th data-name="max_carrying_weight" class="<?php echo $trip_info->max_carrying_weight->headerCellClass() ?>"><div id="elh_trip_info_max_carrying_weight" class="trip_info_max_carrying_weight"><div class="ew-table-header-caption"><?php echo $trip_info->max_carrying_weight->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="max_carrying_weight" class="<?php echo $trip_info->max_carrying_weight->headerCellClass() ?>"><div><div id="elh_trip_info_max_carrying_weight" class="trip_info_max_carrying_weight">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $trip_info->max_carrying_weight->caption() ?></span><span class="ew-table-header-sort"><?php if ($trip_info->max_carrying_weight->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($trip_info->max_carrying_weight->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$trip_info_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$trip_info_grid->StartRec = 1;
$trip_info_grid->StopRec = $trip_info_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $trip_info_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($trip_info_grid->FormKeyCountName) && ($trip_info->isGridAdd() || $trip_info->isGridEdit() || $trip_info->isConfirm())) {
		$trip_info_grid->KeyCount = $CurrentForm->getValue($trip_info_grid->FormKeyCountName);
		$trip_info_grid->StopRec = $trip_info_grid->StartRec + $trip_info_grid->KeyCount - 1;
	}
}
$trip_info_grid->RecCnt = $trip_info_grid->StartRec - 1;
if ($trip_info_grid->Recordset && !$trip_info_grid->Recordset->EOF) {
	$trip_info_grid->Recordset->moveFirst();
	$selectLimit = $trip_info_grid->UseSelectLimit;
	if (!$selectLimit && $trip_info_grid->StartRec > 1)
		$trip_info_grid->Recordset->move($trip_info_grid->StartRec - 1);
} elseif (!$trip_info->AllowAddDeleteRow && $trip_info_grid->StopRec == 0) {
	$trip_info_grid->StopRec = $trip_info->GridAddRowCount;
}

// Initialize aggregate
$trip_info->RowType = ROWTYPE_AGGREGATEINIT;
$trip_info->resetAttributes();
$trip_info_grid->renderRow();
if ($trip_info->isGridAdd())
	$trip_info_grid->RowIndex = 0;
if ($trip_info->isGridEdit())
	$trip_info_grid->RowIndex = 0;
while ($trip_info_grid->RecCnt < $trip_info_grid->StopRec) {
	$trip_info_grid->RecCnt++;
	if ($trip_info_grid->RecCnt >= $trip_info_grid->StartRec) {
		$trip_info_grid->RowCnt++;
		if ($trip_info->isGridAdd() || $trip_info->isGridEdit() || $trip_info->isConfirm()) {
			$trip_info_grid->RowIndex++;
			$CurrentForm->Index = $trip_info_grid->RowIndex;
			if ($CurrentForm->hasValue($trip_info_grid->FormActionName) && $trip_info_grid->EventCancelled)
				$trip_info_grid->RowAction = strval($CurrentForm->getValue($trip_info_grid->FormActionName));
			elseif ($trip_info->isGridAdd())
				$trip_info_grid->RowAction = "insert";
			else
				$trip_info_grid->RowAction = "";
		}

		// Set up key count
		$trip_info_grid->KeyCount = $trip_info_grid->RowIndex;

		// Init row class and style
		$trip_info->resetAttributes();
		$trip_info->CssClass = "";
		if ($trip_info->isGridAdd()) {
			if ($trip_info->CurrentMode == "copy") {
				$trip_info_grid->loadRowValues($trip_info_grid->Recordset); // Load row values
				$trip_info_grid->setRecordKey($trip_info_grid->RowOldKey, $trip_info_grid->Recordset); // Set old record key
			} else {
				$trip_info_grid->loadRowValues(); // Load default values
				$trip_info_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$trip_info_grid->loadRowValues($trip_info_grid->Recordset); // Load row values
		}
		$trip_info->RowType = ROWTYPE_VIEW; // Render view
		if ($trip_info->isGridAdd()) // Grid add
			$trip_info->RowType = ROWTYPE_ADD; // Render add
		if ($trip_info->isGridAdd() && $trip_info->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$trip_info_grid->restoreCurrentRowFormValues($trip_info_grid->RowIndex); // Restore form values
		if ($trip_info->isGridEdit()) { // Grid edit
			if ($trip_info->EventCancelled)
				$trip_info_grid->restoreCurrentRowFormValues($trip_info_grid->RowIndex); // Restore form values
			if ($trip_info_grid->RowAction == "insert")
				$trip_info->RowType = ROWTYPE_ADD; // Render add
			else
				$trip_info->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($trip_info->isGridEdit() && ($trip_info->RowType == ROWTYPE_EDIT || $trip_info->RowType == ROWTYPE_ADD) && $trip_info->EventCancelled) // Update failed
			$trip_info_grid->restoreCurrentRowFormValues($trip_info_grid->RowIndex); // Restore form values
		if ($trip_info->RowType == ROWTYPE_EDIT) // Edit row
			$trip_info_grid->EditRowCnt++;
		if ($trip_info->isConfirm()) // Confirm row
			$trip_info_grid->restoreCurrentRowFormValues($trip_info_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$trip_info->RowAttrs = array_merge($trip_info->RowAttrs, array('data-rowindex'=>$trip_info_grid->RowCnt, 'id'=>'r' . $trip_info_grid->RowCnt . '_trip_info', 'data-rowtype'=>$trip_info->RowType));

		// Render row
		$trip_info_grid->renderRow();

		// Render list options
		$trip_info_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($trip_info_grid->RowAction <> "delete" && $trip_info_grid->RowAction <> "insertdelete" && !($trip_info_grid->RowAction == "insert" && $trip_info->isConfirm() && $trip_info_grid->emptyRow())) {
?>
	<tr<?php echo $trip_info->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trip_info_grid->ListOptions->render("body", "left", $trip_info_grid->RowCnt);
?>
	<?php if ($trip_info->from_place->Visible) { // from_place ?>
		<td data-name="from_place"<?php echo $trip_info->from_place->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_from_place" class="form-group trip_info_from_place">
<input type="text" data-table="trip_info" data-field="x_from_place" name="x<?php echo $trip_info_grid->RowIndex ?>_from_place" id="x<?php echo $trip_info_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->from_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_place->EditValue ?>"<?php echo $trip_info->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="o<?php echo $trip_info_grid->RowIndex ?>_from_place" id="o<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_from_place" class="form-group trip_info_from_place">
<input type="text" data-table="trip_info" data-field="x_from_place" name="x<?php echo $trip_info_grid->RowIndex ?>_from_place" id="x<?php echo $trip_info_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->from_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_place->EditValue ?>"<?php echo $trip_info->from_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_from_place" class="trip_info_from_place">
<span<?php echo $trip_info->from_place->viewAttributes() ?>>
<?php echo $trip_info->from_place->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="x<?php echo $trip_info_grid->RowIndex ?>_from_place" id="x<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="o<?php echo $trip_info_grid->RowIndex ?>_from_place" id="o<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_from_place" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_from_place" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="trip_info" data-field="x_id" name="x<?php echo $trip_info_grid->RowIndex ?>_id" id="x<?php echo $trip_info_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($trip_info->id->CurrentValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_id" name="o<?php echo $trip_info_grid->RowIndex ?>_id" id="o<?php echo $trip_info_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($trip_info->id->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT || $trip_info->CurrentMode == "edit") { ?>
<input type="hidden" data-table="trip_info" data-field="x_id" name="x<?php echo $trip_info_grid->RowIndex ?>_id" id="x<?php echo $trip_info_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($trip_info->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($trip_info->to_place->Visible) { // to_place ?>
		<td data-name="to_place"<?php echo $trip_info->to_place->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_to_place" class="form-group trip_info_to_place">
<input type="text" data-table="trip_info" data-field="x_to_place" name="x<?php echo $trip_info_grid->RowIndex ?>_to_place" id="x<?php echo $trip_info_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->to_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_place->EditValue ?>"<?php echo $trip_info->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="o<?php echo $trip_info_grid->RowIndex ?>_to_place" id="o<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_to_place" class="form-group trip_info_to_place">
<input type="text" data-table="trip_info" data-field="x_to_place" name="x<?php echo $trip_info_grid->RowIndex ?>_to_place" id="x<?php echo $trip_info_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->to_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_place->EditValue ?>"<?php echo $trip_info->to_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_to_place" class="trip_info_to_place">
<span<?php echo $trip_info->to_place->viewAttributes() ?>>
<?php echo $trip_info->to_place->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="x<?php echo $trip_info_grid->RowIndex ?>_to_place" id="x<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="o<?php echo $trip_info_grid->RowIndex ?>_to_place" id="o<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_to_place" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_to_place" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->description->Visible) { // description ?>
		<td data-name="description"<?php echo $trip_info->description->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_description" class="form-group trip_info_description">
<input type="text" data-table="trip_info" data-field="x_description" name="x<?php echo $trip_info_grid->RowIndex ?>_description" id="x<?php echo $trip_info_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->description->getPlaceHolder()) ?>" value="<?php echo $trip_info->description->EditValue ?>"<?php echo $trip_info->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_description" name="o<?php echo $trip_info_grid->RowIndex ?>_description" id="o<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_description" class="form-group trip_info_description">
<input type="text" data-table="trip_info" data-field="x_description" name="x<?php echo $trip_info_grid->RowIndex ?>_description" id="x<?php echo $trip_info_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->description->getPlaceHolder()) ?>" value="<?php echo $trip_info->description->EditValue ?>"<?php echo $trip_info->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_description" class="trip_info_description">
<span<?php echo $trip_info->description->viewAttributes() ?>>
<?php echo $trip_info->description->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_description" name="x<?php echo $trip_info_grid->RowIndex ?>_description" id="x<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_description" name="o<?php echo $trip_info_grid->RowIndex ?>_description" id="o<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_description" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_description" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_description" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_description" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $trip_info->user_id->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($trip_info->user_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_user_id" class="form-group trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_user_id" class="form-group trip_info_user_id">
<?php
$wrkonchange = "" . trim(@$trip_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trip_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trip_info_grid->RowIndex ?>_user_id" class="text-nowrap" style="z-index: <?php echo (9000 - $trip_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="sv_x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($trip_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>"<?php echo $trip_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_user_id" data-value-separator="<?php echo $trip_info->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrip_infogrid.createAutoSuggest({"id":"x<?php echo $trip_info_grid->RowIndex ?>_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="o<?php echo $trip_info_grid->RowIndex ?>_user_id" id="o<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($trip_info->user_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_user_id" class="form-group trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_user_id" class="form-group trip_info_user_id">
<?php
$wrkonchange = "" . trim(@$trip_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trip_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trip_info_grid->RowIndex ?>_user_id" class="text-nowrap" style="z-index: <?php echo (9000 - $trip_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="sv_x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($trip_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>"<?php echo $trip_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_user_id" data-value-separator="<?php echo $trip_info->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrip_infogrid.createAutoSuggest({"id":"x<?php echo $trip_info_grid->RowIndex ?>_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_user_id" class="trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<?php echo $trip_info->user_id->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="o<?php echo $trip_info_grid->RowIndex ?>_user_id" id="o<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_user_id" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
		<td data-name="flight_number"<?php echo $trip_info->flight_number->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_flight_number" class="form-group trip_info_flight_number">
<input type="text" data-table="trip_info" data-field="x_flight_number" name="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->flight_number->getPlaceHolder()) ?>" value="<?php echo $trip_info->flight_number->EditValue ?>"<?php echo $trip_info->flight_number->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="o<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="o<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_flight_number" class="form-group trip_info_flight_number">
<input type="text" data-table="trip_info" data-field="x_flight_number" name="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->flight_number->getPlaceHolder()) ?>" value="<?php echo $trip_info->flight_number->EditValue ?>"<?php echo $trip_info->flight_number->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_flight_number" class="trip_info_flight_number">
<span<?php echo $trip_info->flight_number->viewAttributes() ?>>
<?php echo $trip_info->flight_number->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="o<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="o<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $trip_info->createdAt->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_createdAt" class="form-group trip_info_createdAt">
<input type="text" data-table="trip_info" data-field="x_createdAt" name="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($trip_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->createdAt->EditValue ?>"<?php echo $trip_info->createdAt->editAttributes() ?>>
<?php if (!$trip_info->createdAt->ReadOnly && !$trip_info->createdAt->Disabled && !isset($trip_info->createdAt->EditAttrs["readonly"]) && !isset($trip_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="o<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="o<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_createdAt" class="form-group trip_info_createdAt">
<input type="text" data-table="trip_info" data-field="x_createdAt" name="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($trip_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->createdAt->EditValue ?>"<?php echo $trip_info->createdAt->editAttributes() ?>>
<?php if (!$trip_info->createdAt->ReadOnly && !$trip_info->createdAt->Disabled && !isset($trip_info->createdAt->EditAttrs["readonly"]) && !isset($trip_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_createdAt" class="trip_info_createdAt">
<span<?php echo $trip_info->createdAt->viewAttributes() ?>>
<?php echo $trip_info->createdAt->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="o<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="o<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $trip_info->updatedAt->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_updatedAt" class="form-group trip_info_updatedAt">
<input type="text" data-table="trip_info" data-field="x_updatedAt" name="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($trip_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->updatedAt->EditValue ?>"<?php echo $trip_info->updatedAt->editAttributes() ?>>
<?php if (!$trip_info->updatedAt->ReadOnly && !$trip_info->updatedAt->Disabled && !isset($trip_info->updatedAt->EditAttrs["readonly"]) && !isset($trip_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_updatedAt" class="form-group trip_info_updatedAt">
<input type="text" data-table="trip_info" data-field="x_updatedAt" name="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($trip_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->updatedAt->EditValue ?>"<?php echo $trip_info->updatedAt->editAttributes() ?>>
<?php if (!$trip_info->updatedAt->ReadOnly && !$trip_info->updatedAt->Disabled && !isset($trip_info->updatedAt->EditAttrs["readonly"]) && !isset($trip_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_updatedAt" class="trip_info_updatedAt">
<span<?php echo $trip_info->updatedAt->viewAttributes() ?>>
<?php echo $trip_info->updatedAt->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->from_date->Visible) { // from_date ?>
		<td data-name="from_date"<?php echo $trip_info->from_date->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_from_date" class="form-group trip_info_from_date">
<input type="text" data-table="trip_info" data-field="x_from_date" name="x<?php echo $trip_info_grid->RowIndex ?>_from_date" id="x<?php echo $trip_info_grid->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($trip_info->from_date->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_date->EditValue ?>"<?php echo $trip_info->from_date->editAttributes() ?>>
<?php if (!$trip_info->from_date->ReadOnly && !$trip_info->from_date->Disabled && !isset($trip_info->from_date->EditAttrs["readonly"]) && !isset($trip_info->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="o<?php echo $trip_info_grid->RowIndex ?>_from_date" id="o<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_from_date" class="form-group trip_info_from_date">
<input type="text" data-table="trip_info" data-field="x_from_date" name="x<?php echo $trip_info_grid->RowIndex ?>_from_date" id="x<?php echo $trip_info_grid->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($trip_info->from_date->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_date->EditValue ?>"<?php echo $trip_info->from_date->editAttributes() ?>>
<?php if (!$trip_info->from_date->ReadOnly && !$trip_info->from_date->Disabled && !isset($trip_info->from_date->EditAttrs["readonly"]) && !isset($trip_info->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_from_date" class="trip_info_from_date">
<span<?php echo $trip_info->from_date->viewAttributes() ?>>
<?php echo $trip_info->from_date->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="x<?php echo $trip_info_grid->RowIndex ?>_from_date" id="x<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="o<?php echo $trip_info_grid->RowIndex ?>_from_date" id="o<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_from_date" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_from_date" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->to_date->Visible) { // to_date ?>
		<td data-name="to_date"<?php echo $trip_info->to_date->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_to_date" class="form-group trip_info_to_date">
<input type="text" data-table="trip_info" data-field="x_to_date" name="x<?php echo $trip_info_grid->RowIndex ?>_to_date" id="x<?php echo $trip_info_grid->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($trip_info->to_date->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_date->EditValue ?>"<?php echo $trip_info->to_date->editAttributes() ?>>
<?php if (!$trip_info->to_date->ReadOnly && !$trip_info->to_date->Disabled && !isset($trip_info->to_date->EditAttrs["readonly"]) && !isset($trip_info->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="o<?php echo $trip_info_grid->RowIndex ?>_to_date" id="o<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_to_date" class="form-group trip_info_to_date">
<input type="text" data-table="trip_info" data-field="x_to_date" name="x<?php echo $trip_info_grid->RowIndex ?>_to_date" id="x<?php echo $trip_info_grid->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($trip_info->to_date->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_date->EditValue ?>"<?php echo $trip_info->to_date->editAttributes() ?>>
<?php if (!$trip_info->to_date->ReadOnly && !$trip_info->to_date->Disabled && !isset($trip_info->to_date->EditAttrs["readonly"]) && !isset($trip_info->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_to_date" class="trip_info_to_date">
<span<?php echo $trip_info->to_date->viewAttributes() ?>>
<?php echo $trip_info->to_date->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="x<?php echo $trip_info_grid->RowIndex ?>_to_date" id="x<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="o<?php echo $trip_info_grid->RowIndex ?>_to_date" id="o<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_to_date" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_to_date" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->labor_fee->Visible) { // labor_fee ?>
		<td data-name="labor_fee"<?php echo $trip_info->labor_fee->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_labor_fee" class="form-group trip_info_labor_fee">
<input type="text" data-table="trip_info" data-field="x_labor_fee" name="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" size="30" placeholder="<?php echo HtmlEncode($trip_info->labor_fee->getPlaceHolder()) ?>" value="<?php echo $trip_info->labor_fee->EditValue ?>"<?php echo $trip_info->labor_fee->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_labor_fee" class="form-group trip_info_labor_fee">
<input type="text" data-table="trip_info" data-field="x_labor_fee" name="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" size="30" placeholder="<?php echo HtmlEncode($trip_info->labor_fee->getPlaceHolder()) ?>" value="<?php echo $trip_info->labor_fee->EditValue ?>"<?php echo $trip_info->labor_fee->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_labor_fee" class="trip_info_labor_fee">
<span<?php echo $trip_info->labor_fee->viewAttributes() ?>>
<?php echo $trip_info->labor_fee->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->available->Visible) { // available ?>
		<td data-name="available"<?php echo $trip_info->available->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_available" class="form-group trip_info_available">
<input type="text" data-table="trip_info" data-field="x_available" name="x<?php echo $trip_info_grid->RowIndex ?>_available" id="x<?php echo $trip_info_grid->RowIndex ?>_available" size="30" placeholder="<?php echo HtmlEncode($trip_info->available->getPlaceHolder()) ?>" value="<?php echo $trip_info->available->EditValue ?>"<?php echo $trip_info->available->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_available" name="o<?php echo $trip_info_grid->RowIndex ?>_available" id="o<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_available" class="form-group trip_info_available">
<input type="text" data-table="trip_info" data-field="x_available" name="x<?php echo $trip_info_grid->RowIndex ?>_available" id="x<?php echo $trip_info_grid->RowIndex ?>_available" size="30" placeholder="<?php echo HtmlEncode($trip_info->available->getPlaceHolder()) ?>" value="<?php echo $trip_info->available->EditValue ?>"<?php echo $trip_info->available->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_available" class="trip_info_available">
<span<?php echo $trip_info->available->viewAttributes() ?>>
<?php echo $trip_info->available->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_available" name="x<?php echo $trip_info_grid->RowIndex ?>_available" id="x<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_available" name="o<?php echo $trip_info_grid->RowIndex ?>_available" id="o<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_available" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_available" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_available" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_available" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->service_type->Visible) { // service_type ?>
		<td data-name="service_type"<?php echo $trip_info->service_type->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_service_type" class="form-group trip_info_service_type">
<input type="text" data-table="trip_info" data-field="x_service_type" name="x<?php echo $trip_info_grid->RowIndex ?>_service_type" id="x<?php echo $trip_info_grid->RowIndex ?>_service_type" size="30" placeholder="<?php echo HtmlEncode($trip_info->service_type->getPlaceHolder()) ?>" value="<?php echo $trip_info->service_type->EditValue ?>"<?php echo $trip_info->service_type->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="o<?php echo $trip_info_grid->RowIndex ?>_service_type" id="o<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_service_type" class="form-group trip_info_service_type">
<input type="text" data-table="trip_info" data-field="x_service_type" name="x<?php echo $trip_info_grid->RowIndex ?>_service_type" id="x<?php echo $trip_info_grid->RowIndex ?>_service_type" size="30" placeholder="<?php echo HtmlEncode($trip_info->service_type->getPlaceHolder()) ?>" value="<?php echo $trip_info->service_type->EditValue ?>"<?php echo $trip_info->service_type->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_service_type" class="trip_info_service_type">
<span<?php echo $trip_info->service_type->viewAttributes() ?>>
<?php echo $trip_info->service_type->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="x<?php echo $trip_info_grid->RowIndex ?>_service_type" id="x<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="o<?php echo $trip_info_grid->RowIndex ?>_service_type" id="o<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_service_type" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_service_type" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($trip_info->max_carrying_weight->Visible) { // max_carrying_weight ?>
		<td data-name="max_carrying_weight"<?php echo $trip_info->max_carrying_weight->cellAttributes() ?>>
<?php if ($trip_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_max_carrying_weight" class="form-group trip_info_max_carrying_weight">
<input type="text" data-table="trip_info" data-field="x_max_carrying_weight" name="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" size="30" placeholder="<?php echo HtmlEncode($trip_info->max_carrying_weight->getPlaceHolder()) ?>" value="<?php echo $trip_info->max_carrying_weight->EditValue ?>"<?php echo $trip_info->max_carrying_weight->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->OldValue) ?>">
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_max_carrying_weight" class="form-group trip_info_max_carrying_weight">
<input type="text" data-table="trip_info" data-field="x_max_carrying_weight" name="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" size="30" placeholder="<?php echo HtmlEncode($trip_info->max_carrying_weight->getPlaceHolder()) ?>" value="<?php echo $trip_info->max_carrying_weight->EditValue ?>"<?php echo $trip_info->max_carrying_weight->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($trip_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $trip_info_grid->RowCnt ?>_trip_info_max_carrying_weight" class="trip_info_max_carrying_weight">
<span<?php echo $trip_info->max_carrying_weight->viewAttributes() ?>>
<?php echo $trip_info->max_carrying_weight->getViewValue() ?></span>
</span>
<?php if (!$trip_info->isConfirm()) { ?>
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="ftrip_infogrid$x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->FormValue) ?>">
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="ftrip_infogrid$o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trip_info_grid->ListOptions->render("body", "right", $trip_info_grid->RowCnt);
?>
	</tr>
<?php if ($trip_info->RowType == ROWTYPE_ADD || $trip_info->RowType == ROWTYPE_EDIT) { ?>
<script>
ftrip_infogrid.updateLists(<?php echo $trip_info_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$trip_info->isGridAdd() || $trip_info->CurrentMode == "copy")
		if (!$trip_info_grid->Recordset->EOF)
			$trip_info_grid->Recordset->moveNext();
}
?>
<?php
	if ($trip_info->CurrentMode == "add" || $trip_info->CurrentMode == "copy" || $trip_info->CurrentMode == "edit") {
		$trip_info_grid->RowIndex = '$rowindex$';
		$trip_info_grid->loadRowValues();

		// Set row properties
		$trip_info->resetAttributes();
		$trip_info->RowAttrs = array_merge($trip_info->RowAttrs, array('data-rowindex'=>$trip_info_grid->RowIndex, 'id'=>'r0_trip_info', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($trip_info->RowAttrs["class"], "ew-template");
		$trip_info->RowType = ROWTYPE_ADD;

		// Render row
		$trip_info_grid->renderRow();

		// Render list options
		$trip_info_grid->renderListOptions();
		$trip_info_grid->StartRowCnt = 0;
?>
	<tr<?php echo $trip_info->rowAttributes() ?>>
<?php

// Render list options (body, left)
$trip_info_grid->ListOptions->render("body", "left", $trip_info_grid->RowIndex);
?>
	<?php if ($trip_info->from_place->Visible) { // from_place ?>
		<td data-name="from_place">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_from_place" class="form-group trip_info_from_place">
<input type="text" data-table="trip_info" data-field="x_from_place" name="x<?php echo $trip_info_grid->RowIndex ?>_from_place" id="x<?php echo $trip_info_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->from_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_place->EditValue ?>"<?php echo $trip_info->from_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_from_place" class="form-group trip_info_from_place">
<span<?php echo $trip_info->from_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->from_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="x<?php echo $trip_info_grid->RowIndex ?>_from_place" id="x<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_from_place" name="o<?php echo $trip_info_grid->RowIndex ?>_from_place" id="o<?php echo $trip_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($trip_info->from_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->to_place->Visible) { // to_place ?>
		<td data-name="to_place">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_to_place" class="form-group trip_info_to_place">
<input type="text" data-table="trip_info" data-field="x_to_place" name="x<?php echo $trip_info_grid->RowIndex ?>_to_place" id="x<?php echo $trip_info_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->to_place->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_place->EditValue ?>"<?php echo $trip_info->to_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_to_place" class="form-group trip_info_to_place">
<span<?php echo $trip_info->to_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->to_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="x<?php echo $trip_info_grid->RowIndex ?>_to_place" id="x<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_to_place" name="o<?php echo $trip_info_grid->RowIndex ?>_to_place" id="o<?php echo $trip_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($trip_info->to_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->description->Visible) { // description ?>
		<td data-name="description">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_description" class="form-group trip_info_description">
<input type="text" data-table="trip_info" data-field="x_description" name="x<?php echo $trip_info_grid->RowIndex ?>_description" id="x<?php echo $trip_info_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->description->getPlaceHolder()) ?>" value="<?php echo $trip_info->description->EditValue ?>"<?php echo $trip_info->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_description" class="form-group trip_info_description">
<span<?php echo $trip_info->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_description" name="x<?php echo $trip_info_grid->RowIndex ?>_description" id="x<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_description" name="o<?php echo $trip_info_grid->RowIndex ?>_description" id="o<?php echo $trip_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($trip_info->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if (!$trip_info->isConfirm()) { ?>
<?php if ($trip_info->user_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_trip_info_user_id" class="form-group trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_trip_info_user_id" class="form-group trip_info_user_id">
<?php
$wrkonchange = "" . trim(@$trip_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$trip_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $trip_info_grid->RowIndex ?>_user_id" class="text-nowrap" style="z-index: <?php echo (9000 - $trip_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="sv_x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($trip_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($trip_info->user_id->getPlaceHolder()) ?>"<?php echo $trip_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="trip_info" data-field="x_user_id" data-value-separator="<?php echo $trip_info->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
ftrip_infogrid.createAutoSuggest({"id":"x<?php echo $trip_info_grid->RowIndex ?>_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_trip_info_user_id" class="form-group trip_info_user_id">
<span<?php echo $trip_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="x<?php echo $trip_info_grid->RowIndex ?>_user_id" id="x<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_user_id" name="o<?php echo $trip_info_grid->RowIndex ?>_user_id" id="o<?php echo $trip_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($trip_info->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->flight_number->Visible) { // flight_number ?>
		<td data-name="flight_number">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_flight_number" class="form-group trip_info_flight_number">
<input type="text" data-table="trip_info" data-field="x_flight_number" name="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($trip_info->flight_number->getPlaceHolder()) ?>" value="<?php echo $trip_info->flight_number->EditValue ?>"<?php echo $trip_info->flight_number->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_flight_number" class="form-group trip_info_flight_number">
<span<?php echo $trip_info->flight_number->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->flight_number->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="x<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_flight_number" name="o<?php echo $trip_info_grid->RowIndex ?>_flight_number" id="o<?php echo $trip_info_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($trip_info->flight_number->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_createdAt" class="form-group trip_info_createdAt">
<input type="text" data-table="trip_info" data-field="x_createdAt" name="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($trip_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->createdAt->EditValue ?>"<?php echo $trip_info->createdAt->editAttributes() ?>>
<?php if (!$trip_info->createdAt->ReadOnly && !$trip_info->createdAt->Disabled && !isset($trip_info->createdAt->EditAttrs["readonly"]) && !isset($trip_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_createdAt" class="form-group trip_info_createdAt">
<span<?php echo $trip_info->createdAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->createdAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="x<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_createdAt" name="o<?php echo $trip_info_grid->RowIndex ?>_createdAt" id="o<?php echo $trip_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($trip_info->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_updatedAt" class="form-group trip_info_updatedAt">
<input type="text" data-table="trip_info" data-field="x_updatedAt" name="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($trip_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $trip_info->updatedAt->EditValue ?>"<?php echo $trip_info->updatedAt->editAttributes() ?>>
<?php if (!$trip_info->updatedAt->ReadOnly && !$trip_info->updatedAt->Disabled && !isset($trip_info->updatedAt->EditAttrs["readonly"]) && !isset($trip_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_updatedAt" class="form-group trip_info_updatedAt">
<span<?php echo $trip_info->updatedAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->updatedAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_updatedAt" name="o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" id="o<?php echo $trip_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($trip_info->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->from_date->Visible) { // from_date ?>
		<td data-name="from_date">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_from_date" class="form-group trip_info_from_date">
<input type="text" data-table="trip_info" data-field="x_from_date" name="x<?php echo $trip_info_grid->RowIndex ?>_from_date" id="x<?php echo $trip_info_grid->RowIndex ?>_from_date" placeholder="<?php echo HtmlEncode($trip_info->from_date->getPlaceHolder()) ?>" value="<?php echo $trip_info->from_date->EditValue ?>"<?php echo $trip_info->from_date->editAttributes() ?>>
<?php if (!$trip_info->from_date->ReadOnly && !$trip_info->from_date->Disabled && !isset($trip_info->from_date->EditAttrs["readonly"]) && !isset($trip_info->from_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_from_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_from_date" class="form-group trip_info_from_date">
<span<?php echo $trip_info->from_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->from_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="x<?php echo $trip_info_grid->RowIndex ?>_from_date" id="x<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_from_date" name="o<?php echo $trip_info_grid->RowIndex ?>_from_date" id="o<?php echo $trip_info_grid->RowIndex ?>_from_date" value="<?php echo HtmlEncode($trip_info->from_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->to_date->Visible) { // to_date ?>
		<td data-name="to_date">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_to_date" class="form-group trip_info_to_date">
<input type="text" data-table="trip_info" data-field="x_to_date" name="x<?php echo $trip_info_grid->RowIndex ?>_to_date" id="x<?php echo $trip_info_grid->RowIndex ?>_to_date" placeholder="<?php echo HtmlEncode($trip_info->to_date->getPlaceHolder()) ?>" value="<?php echo $trip_info->to_date->EditValue ?>"<?php echo $trip_info->to_date->editAttributes() ?>>
<?php if (!$trip_info->to_date->ReadOnly && !$trip_info->to_date->Disabled && !isset($trip_info->to_date->EditAttrs["readonly"]) && !isset($trip_info->to_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("ftrip_infogrid", "x<?php echo $trip_info_grid->RowIndex ?>_to_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_to_date" class="form-group trip_info_to_date">
<span<?php echo $trip_info->to_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->to_date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="x<?php echo $trip_info_grid->RowIndex ?>_to_date" id="x<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_to_date" name="o<?php echo $trip_info_grid->RowIndex ?>_to_date" id="o<?php echo $trip_info_grid->RowIndex ?>_to_date" value="<?php echo HtmlEncode($trip_info->to_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->labor_fee->Visible) { // labor_fee ?>
		<td data-name="labor_fee">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_labor_fee" class="form-group trip_info_labor_fee">
<input type="text" data-table="trip_info" data-field="x_labor_fee" name="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" size="30" placeholder="<?php echo HtmlEncode($trip_info->labor_fee->getPlaceHolder()) ?>" value="<?php echo $trip_info->labor_fee->EditValue ?>"<?php echo $trip_info->labor_fee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_labor_fee" class="form-group trip_info_labor_fee">
<span<?php echo $trip_info->labor_fee->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->labor_fee->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="x<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_labor_fee" name="o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" id="o<?php echo $trip_info_grid->RowIndex ?>_labor_fee" value="<?php echo HtmlEncode($trip_info->labor_fee->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->available->Visible) { // available ?>
		<td data-name="available">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_available" class="form-group trip_info_available">
<input type="text" data-table="trip_info" data-field="x_available" name="x<?php echo $trip_info_grid->RowIndex ?>_available" id="x<?php echo $trip_info_grid->RowIndex ?>_available" size="30" placeholder="<?php echo HtmlEncode($trip_info->available->getPlaceHolder()) ?>" value="<?php echo $trip_info->available->EditValue ?>"<?php echo $trip_info->available->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_available" class="form-group trip_info_available">
<span<?php echo $trip_info->available->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->available->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_available" name="x<?php echo $trip_info_grid->RowIndex ?>_available" id="x<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_available" name="o<?php echo $trip_info_grid->RowIndex ?>_available" id="o<?php echo $trip_info_grid->RowIndex ?>_available" value="<?php echo HtmlEncode($trip_info->available->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->service_type->Visible) { // service_type ?>
		<td data-name="service_type">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_service_type" class="form-group trip_info_service_type">
<input type="text" data-table="trip_info" data-field="x_service_type" name="x<?php echo $trip_info_grid->RowIndex ?>_service_type" id="x<?php echo $trip_info_grid->RowIndex ?>_service_type" size="30" placeholder="<?php echo HtmlEncode($trip_info->service_type->getPlaceHolder()) ?>" value="<?php echo $trip_info->service_type->EditValue ?>"<?php echo $trip_info->service_type->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_service_type" class="form-group trip_info_service_type">
<span<?php echo $trip_info->service_type->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->service_type->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="x<?php echo $trip_info_grid->RowIndex ?>_service_type" id="x<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_service_type" name="o<?php echo $trip_info_grid->RowIndex ?>_service_type" id="o<?php echo $trip_info_grid->RowIndex ?>_service_type" value="<?php echo HtmlEncode($trip_info->service_type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($trip_info->max_carrying_weight->Visible) { // max_carrying_weight ?>
		<td data-name="max_carrying_weight">
<?php if (!$trip_info->isConfirm()) { ?>
<span id="el$rowindex$_trip_info_max_carrying_weight" class="form-group trip_info_max_carrying_weight">
<input type="text" data-table="trip_info" data-field="x_max_carrying_weight" name="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" size="30" placeholder="<?php echo HtmlEncode($trip_info->max_carrying_weight->getPlaceHolder()) ?>" value="<?php echo $trip_info->max_carrying_weight->EditValue ?>"<?php echo $trip_info->max_carrying_weight->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_trip_info_max_carrying_weight" class="form-group trip_info_max_carrying_weight">
<span<?php echo $trip_info->max_carrying_weight->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($trip_info->max_carrying_weight->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="x<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="trip_info" data-field="x_max_carrying_weight" name="o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" id="o<?php echo $trip_info_grid->RowIndex ?>_max_carrying_weight" value="<?php echo HtmlEncode($trip_info->max_carrying_weight->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$trip_info_grid->ListOptions->render("body", "right", $trip_info_grid->RowIndex);
?>
<script>
ftrip_infogrid.updateLists(<?php echo $trip_info_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php if ($trip_info->CurrentMode == "add" || $trip_info->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $trip_info_grid->FormKeyCountName ?>" id="<?php echo $trip_info_grid->FormKeyCountName ?>" value="<?php echo $trip_info_grid->KeyCount ?>">
<?php echo $trip_info_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($trip_info->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $trip_info_grid->FormKeyCountName ?>" id="<?php echo $trip_info_grid->FormKeyCountName ?>" value="<?php echo $trip_info_grid->KeyCount ?>">
<?php echo $trip_info_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($trip_info->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ftrip_infogrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($trip_info_grid->Recordset)
	$trip_info_grid->Recordset->Close();
?>
</div>
<?php if ($trip_info_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($trip_info_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($trip_info_grid->TotalRecs == 0 && !$trip_info->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($trip_info_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$trip_info_grid->terminate();
?>
