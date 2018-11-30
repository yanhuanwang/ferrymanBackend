<?php
namespace PHPMaker2019\ferryman;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($parcel_info_grid))
	$parcel_info_grid = new parcel_info_grid();

// Run the page
$parcel_info_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$parcel_info_grid->Page_Render();
?>
<?php if (!$parcel_info->isExport()) { ?>
<script>

// Form object
var fparcel_infogrid = new ew.Form("fparcel_infogrid", "grid");
fparcel_infogrid.formKeyCountName = '<?php echo $parcel_info_grid->FormKeyCountName ?>';

// Validate form
fparcel_infogrid.validate = function() {
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
		<?php if ($parcel_info_grid->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->from_place->caption(), $parcel_info->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_grid->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->to_place->caption(), $parcel_info->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_grid->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->description->caption(), $parcel_info->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_grid->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->user_id->caption(), $parcel_info->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->user_id->errorMessage()) ?>");
		<?php if ($parcel_info_grid->image_id->Required) { ?>
			elm = this.getElements("x" + infix + "_image_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->image_id->caption(), $parcel_info->image_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_image_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->image_id->errorMessage()) ?>");
		<?php if ($parcel_info_grid->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->name->caption(), $parcel_info->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($parcel_info_grid->categoty->Required) { ?>
			elm = this.getElements("x" + infix + "_categoty");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->categoty->caption(), $parcel_info->categoty->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_categoty");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->categoty->errorMessage()) ?>");
		<?php if ($parcel_info_grid->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->status->caption(), $parcel_info->status->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->status->errorMessage()) ?>");
		<?php if ($parcel_info_grid->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->createdAt->caption(), $parcel_info->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->createdAt->errorMessage()) ?>");
		<?php if ($parcel_info_grid->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $parcel_info->updatedAt->caption(), $parcel_info->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($parcel_info->updatedAt->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fparcel_infogrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "from_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "user_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "image_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "name", false)) return false;
	if (ew.valueChanged(fobj, infix, "categoty", false)) return false;
	if (ew.valueChanged(fobj, infix, "status", false)) return false;
	if (ew.valueChanged(fobj, infix, "createdAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "updatedAt", false)) return false;
	return true;
}

// Form_CustomValidate event
fparcel_infogrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fparcel_infogrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fparcel_infogrid.lists["x_user_id"] = <?php echo $parcel_info_grid->user_id->Lookup->toClientList() ?>;
fparcel_infogrid.lists["x_user_id"].options = <?php echo JsonEncode($parcel_info_grid->user_id->lookupOptions()) ?>;
fparcel_infogrid.autoSuggests["x_user_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fparcel_infogrid.lists["x_image_id"] = <?php echo $parcel_info_grid->image_id->Lookup->toClientList() ?>;
fparcel_infogrid.lists["x_image_id"].options = <?php echo JsonEncode($parcel_info_grid->image_id->lookupOptions()) ?>;
fparcel_infogrid.autoSuggests["x_image_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$parcel_info_grid->renderOtherOptions();
?>
<?php $parcel_info_grid->showPageHeader(); ?>
<?php
$parcel_info_grid->showMessage();
?>
<?php if ($parcel_info_grid->TotalRecs > 0 || $parcel_info->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($parcel_info_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> parcel_info">
<?php if ($parcel_info_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php
	foreach ($parcel_info_grid->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fparcel_infogrid" class="ew-form ew-list-form form-inline">
<div id="gmp_parcel_info" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_parcel_infogrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$parcel_info_grid->RowType = ROWTYPE_HEADER;

// Render list options
$parcel_info_grid->renderListOptions();

// Render list options (header, left)
$parcel_info_grid->ListOptions->render("header", "left");
?>
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
	<?php if ($parcel_info->sortUrl($parcel_info->from_place) == "") { ?>
		<th data-name="from_place" class="<?php echo $parcel_info->from_place->headerCellClass() ?>"><div id="elh_parcel_info_from_place" class="parcel_info_from_place"><div class="ew-table-header-caption"><?php echo $parcel_info->from_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_place" class="<?php echo $parcel_info->from_place->headerCellClass() ?>"><div><div id="elh_parcel_info_from_place" class="parcel_info_from_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->from_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->from_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->from_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
	<?php if ($parcel_info->sortUrl($parcel_info->to_place) == "") { ?>
		<th data-name="to_place" class="<?php echo $parcel_info->to_place->headerCellClass() ?>"><div id="elh_parcel_info_to_place" class="parcel_info_to_place"><div class="ew-table-header-caption"><?php echo $parcel_info->to_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_place" class="<?php echo $parcel_info->to_place->headerCellClass() ?>"><div><div id="elh_parcel_info_to_place" class="parcel_info_to_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->to_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->to_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->to_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
	<?php if ($parcel_info->sortUrl($parcel_info->description) == "") { ?>
		<th data-name="description" class="<?php echo $parcel_info->description->headerCellClass() ?>"><div id="elh_parcel_info_description" class="parcel_info_description"><div class="ew-table-header-caption"><?php echo $parcel_info->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $parcel_info->description->headerCellClass() ?>"><div><div id="elh_parcel_info_description" class="parcel_info_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->description->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
	<?php if ($parcel_info->sortUrl($parcel_info->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $parcel_info->user_id->headerCellClass() ?>"><div id="elh_parcel_info_user_id" class="parcel_info_user_id"><div class="ew-table-header-caption"><?php echo $parcel_info->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $parcel_info->user_id->headerCellClass() ?>"><div><div id="elh_parcel_info_user_id" class="parcel_info_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->image_id->Visible) { // image_id ?>
	<?php if ($parcel_info->sortUrl($parcel_info->image_id) == "") { ?>
		<th data-name="image_id" class="<?php echo $parcel_info->image_id->headerCellClass() ?>"><div id="elh_parcel_info_image_id" class="parcel_info_image_id"><div class="ew-table-header-caption"><?php echo $parcel_info->image_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="image_id" class="<?php echo $parcel_info->image_id->headerCellClass() ?>"><div><div id="elh_parcel_info_image_id" class="parcel_info_image_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->image_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->image_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->image_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
	<?php if ($parcel_info->sortUrl($parcel_info->name) == "") { ?>
		<th data-name="name" class="<?php echo $parcel_info->name->headerCellClass() ?>"><div id="elh_parcel_info_name" class="parcel_info_name"><div class="ew-table-header-caption"><?php echo $parcel_info->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $parcel_info->name->headerCellClass() ?>"><div><div id="elh_parcel_info_name" class="parcel_info_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->name->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->categoty->Visible) { // categoty ?>
	<?php if ($parcel_info->sortUrl($parcel_info->categoty) == "") { ?>
		<th data-name="categoty" class="<?php echo $parcel_info->categoty->headerCellClass() ?>"><div id="elh_parcel_info_categoty" class="parcel_info_categoty"><div class="ew-table-header-caption"><?php echo $parcel_info->categoty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="categoty" class="<?php echo $parcel_info->categoty->headerCellClass() ?>"><div><div id="elh_parcel_info_categoty" class="parcel_info_categoty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->categoty->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->categoty->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->categoty->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->status->Visible) { // status ?>
	<?php if ($parcel_info->sortUrl($parcel_info->status) == "") { ?>
		<th data-name="status" class="<?php echo $parcel_info->status->headerCellClass() ?>"><div id="elh_parcel_info_status" class="parcel_info_status"><div class="ew-table-header-caption"><?php echo $parcel_info->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $parcel_info->status->headerCellClass() ?>"><div><div id="elh_parcel_info_status" class="parcel_info_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->createdAt->Visible) { // createdAt ?>
	<?php if ($parcel_info->sortUrl($parcel_info->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $parcel_info->createdAt->headerCellClass() ?>"><div id="elh_parcel_info_createdAt" class="parcel_info_createdAt"><div class="ew-table-header-caption"><?php echo $parcel_info->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $parcel_info->createdAt->headerCellClass() ?>"><div><div id="elh_parcel_info_createdAt" class="parcel_info_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($parcel_info->updatedAt->Visible) { // updatedAt ?>
	<?php if ($parcel_info->sortUrl($parcel_info->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $parcel_info->updatedAt->headerCellClass() ?>"><div id="elh_parcel_info_updatedAt" class="parcel_info_updatedAt"><div class="ew-table-header-caption"><?php echo $parcel_info->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $parcel_info->updatedAt->headerCellClass() ?>"><div><div id="elh_parcel_info_updatedAt" class="parcel_info_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $parcel_info->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($parcel_info->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($parcel_info->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$parcel_info_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$parcel_info_grid->StartRec = 1;
$parcel_info_grid->StopRec = $parcel_info_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $parcel_info_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($parcel_info_grid->FormKeyCountName) && ($parcel_info->isGridAdd() || $parcel_info->isGridEdit() || $parcel_info->isConfirm())) {
		$parcel_info_grid->KeyCount = $CurrentForm->getValue($parcel_info_grid->FormKeyCountName);
		$parcel_info_grid->StopRec = $parcel_info_grid->StartRec + $parcel_info_grid->KeyCount - 1;
	}
}
$parcel_info_grid->RecCnt = $parcel_info_grid->StartRec - 1;
if ($parcel_info_grid->Recordset && !$parcel_info_grid->Recordset->EOF) {
	$parcel_info_grid->Recordset->moveFirst();
	$selectLimit = $parcel_info_grid->UseSelectLimit;
	if (!$selectLimit && $parcel_info_grid->StartRec > 1)
		$parcel_info_grid->Recordset->move($parcel_info_grid->StartRec - 1);
} elseif (!$parcel_info->AllowAddDeleteRow && $parcel_info_grid->StopRec == 0) {
	$parcel_info_grid->StopRec = $parcel_info->GridAddRowCount;
}

// Initialize aggregate
$parcel_info->RowType = ROWTYPE_AGGREGATEINIT;
$parcel_info->resetAttributes();
$parcel_info_grid->renderRow();
if ($parcel_info->isGridAdd())
	$parcel_info_grid->RowIndex = 0;
if ($parcel_info->isGridEdit())
	$parcel_info_grid->RowIndex = 0;
while ($parcel_info_grid->RecCnt < $parcel_info_grid->StopRec) {
	$parcel_info_grid->RecCnt++;
	if ($parcel_info_grid->RecCnt >= $parcel_info_grid->StartRec) {
		$parcel_info_grid->RowCnt++;
		if ($parcel_info->isGridAdd() || $parcel_info->isGridEdit() || $parcel_info->isConfirm()) {
			$parcel_info_grid->RowIndex++;
			$CurrentForm->Index = $parcel_info_grid->RowIndex;
			if ($CurrentForm->hasValue($parcel_info_grid->FormActionName) && $parcel_info_grid->EventCancelled)
				$parcel_info_grid->RowAction = strval($CurrentForm->getValue($parcel_info_grid->FormActionName));
			elseif ($parcel_info->isGridAdd())
				$parcel_info_grid->RowAction = "insert";
			else
				$parcel_info_grid->RowAction = "";
		}

		// Set up key count
		$parcel_info_grid->KeyCount = $parcel_info_grid->RowIndex;

		// Init row class and style
		$parcel_info->resetAttributes();
		$parcel_info->CssClass = "";
		if ($parcel_info->isGridAdd()) {
			if ($parcel_info->CurrentMode == "copy") {
				$parcel_info_grid->loadRowValues($parcel_info_grid->Recordset); // Load row values
				$parcel_info_grid->setRecordKey($parcel_info_grid->RowOldKey, $parcel_info_grid->Recordset); // Set old record key
			} else {
				$parcel_info_grid->loadRowValues(); // Load default values
				$parcel_info_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$parcel_info_grid->loadRowValues($parcel_info_grid->Recordset); // Load row values
		}
		$parcel_info->RowType = ROWTYPE_VIEW; // Render view
		if ($parcel_info->isGridAdd()) // Grid add
			$parcel_info->RowType = ROWTYPE_ADD; // Render add
		if ($parcel_info->isGridAdd() && $parcel_info->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$parcel_info_grid->restoreCurrentRowFormValues($parcel_info_grid->RowIndex); // Restore form values
		if ($parcel_info->isGridEdit()) { // Grid edit
			if ($parcel_info->EventCancelled)
				$parcel_info_grid->restoreCurrentRowFormValues($parcel_info_grid->RowIndex); // Restore form values
			if ($parcel_info_grid->RowAction == "insert")
				$parcel_info->RowType = ROWTYPE_ADD; // Render add
			else
				$parcel_info->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($parcel_info->isGridEdit() && ($parcel_info->RowType == ROWTYPE_EDIT || $parcel_info->RowType == ROWTYPE_ADD) && $parcel_info->EventCancelled) // Update failed
			$parcel_info_grid->restoreCurrentRowFormValues($parcel_info_grid->RowIndex); // Restore form values
		if ($parcel_info->RowType == ROWTYPE_EDIT) // Edit row
			$parcel_info_grid->EditRowCnt++;
		if ($parcel_info->isConfirm()) // Confirm row
			$parcel_info_grid->restoreCurrentRowFormValues($parcel_info_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$parcel_info->RowAttrs = array_merge($parcel_info->RowAttrs, array('data-rowindex'=>$parcel_info_grid->RowCnt, 'id'=>'r' . $parcel_info_grid->RowCnt . '_parcel_info', 'data-rowtype'=>$parcel_info->RowType));

		// Render row
		$parcel_info_grid->renderRow();

		// Render list options
		$parcel_info_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($parcel_info_grid->RowAction <> "delete" && $parcel_info_grid->RowAction <> "insertdelete" && !($parcel_info_grid->RowAction == "insert" && $parcel_info->isConfirm() && $parcel_info_grid->emptyRow())) {
?>
	<tr<?php echo $parcel_info->rowAttributes() ?>>
<?php

// Render list options (body, left)
$parcel_info_grid->ListOptions->render("body", "left", $parcel_info_grid->RowCnt);
?>
	<?php if ($parcel_info->from_place->Visible) { // from_place ?>
		<td data-name="from_place"<?php echo $parcel_info->from_place->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_from_place" class="form-group parcel_info_from_place">
<input type="text" data-table="parcel_info" data-field="x_from_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->from_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->from_place->EditValue ?>"<?php echo $parcel_info->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="o<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="o<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_from_place" class="form-group parcel_info_from_place">
<input type="text" data-table="parcel_info" data-field="x_from_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->from_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->from_place->EditValue ?>"<?php echo $parcel_info->from_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_from_place" class="parcel_info_from_place">
<span<?php echo $parcel_info->from_place->viewAttributes() ?>>
<?php echo $parcel_info->from_place->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="o<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="o<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="parcel_info" data-field="x_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($parcel_info->id->CurrentValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($parcel_info->id->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT || $parcel_info->CurrentMode == "edit") { ?>
<input type="hidden" data-table="parcel_info" data-field="x_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($parcel_info->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($parcel_info->to_place->Visible) { // to_place ?>
		<td data-name="to_place"<?php echo $parcel_info->to_place->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_to_place" class="form-group parcel_info_to_place">
<input type="text" data-table="parcel_info" data-field="x_to_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->to_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->to_place->EditValue ?>"<?php echo $parcel_info->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="o<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="o<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_to_place" class="form-group parcel_info_to_place">
<input type="text" data-table="parcel_info" data-field="x_to_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->to_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->to_place->EditValue ?>"<?php echo $parcel_info->to_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_to_place" class="parcel_info_to_place">
<span<?php echo $parcel_info->to_place->viewAttributes() ?>>
<?php echo $parcel_info->to_place->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="o<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="o<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->description->Visible) { // description ?>
		<td data-name="description"<?php echo $parcel_info->description->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_description" class="form-group parcel_info_description">
<input type="text" data-table="parcel_info" data-field="x_description" name="x<?php echo $parcel_info_grid->RowIndex ?>_description" id="x<?php echo $parcel_info_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->description->getPlaceHolder()) ?>" value="<?php echo $parcel_info->description->EditValue ?>"<?php echo $parcel_info->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_description" name="o<?php echo $parcel_info_grid->RowIndex ?>_description" id="o<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_description" class="form-group parcel_info_description">
<input type="text" data-table="parcel_info" data-field="x_description" name="x<?php echo $parcel_info_grid->RowIndex ?>_description" id="x<?php echo $parcel_info_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->description->getPlaceHolder()) ?>" value="<?php echo $parcel_info->description->EditValue ?>"<?php echo $parcel_info->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_description" class="parcel_info_description">
<span<?php echo $parcel_info->description->viewAttributes() ?>>
<?php echo $parcel_info->description->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_description" name="x<?php echo $parcel_info_grid->RowIndex ?>_description" id="x<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_description" name="o<?php echo $parcel_info_grid->RowIndex ?>_description" id="o<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_description" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_description" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_description" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_description" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $parcel_info->user_id->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($parcel_info->user_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_user_id" class="form-group parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_user_id" class="form-group parcel_info_user_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" class="text-nowrap" style="z-index: <?php echo (9000 - $parcel_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="sv_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($parcel_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>"<?php echo $parcel_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" data-value-separator="<?php echo $parcel_info->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infogrid.createAutoSuggest({"id":"x<?php echo $parcel_info_grid->RowIndex ?>_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($parcel_info->user_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_user_id" class="form-group parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_user_id" class="form-group parcel_info_user_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" class="text-nowrap" style="z-index: <?php echo (9000 - $parcel_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="sv_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($parcel_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>"<?php echo $parcel_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" data-value-separator="<?php echo $parcel_info->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infogrid.createAutoSuggest({"id":"x<?php echo $parcel_info_grid->RowIndex ?>_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_user_id" class="parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<?php echo $parcel_info->user_id->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->image_id->Visible) { // image_id ?>
		<td data-name="image_id"<?php echo $parcel_info->image_id->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($parcel_info->image_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_image_id" class="form-group parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->ViewValue)) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_image_id" class="form-group parcel_info_image_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->image_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->image_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" class="text-nowrap" style="z-index: <?php echo (9000 - $parcel_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="sv_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo RemoveHtml($parcel_info->image_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>"<?php echo $parcel_info->image_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" data-value-separator="<?php echo $parcel_info->image_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infogrid.createAutoSuggest({"id":"x<?php echo $parcel_info_grid->RowIndex ?>_image_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($parcel_info->image_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_image_id" class="form-group parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->ViewValue)) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_image_id" class="form-group parcel_info_image_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->image_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->image_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" class="text-nowrap" style="z-index: <?php echo (9000 - $parcel_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="sv_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo RemoveHtml($parcel_info->image_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>"<?php echo $parcel_info->image_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" data-value-separator="<?php echo $parcel_info->image_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infogrid.createAutoSuggest({"id":"x<?php echo $parcel_info_grid->RowIndex ?>_image_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_image_id" class="parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->getViewValue())) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><?php echo $parcel_info->image_id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $parcel_info->image_id->getViewValue() ?>
<?php } ?>
</span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->name->Visible) { // name ?>
		<td data-name="name"<?php echo $parcel_info->name->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_name" class="form-group parcel_info_name">
<input type="text" data-table="parcel_info" data-field="x_name" name="x<?php echo $parcel_info_grid->RowIndex ?>_name" id="x<?php echo $parcel_info_grid->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->name->getPlaceHolder()) ?>" value="<?php echo $parcel_info->name->EditValue ?>"<?php echo $parcel_info->name->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_name" name="o<?php echo $parcel_info_grid->RowIndex ?>_name" id="o<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_name" class="form-group parcel_info_name">
<input type="text" data-table="parcel_info" data-field="x_name" name="x<?php echo $parcel_info_grid->RowIndex ?>_name" id="x<?php echo $parcel_info_grid->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->name->getPlaceHolder()) ?>" value="<?php echo $parcel_info->name->EditValue ?>"<?php echo $parcel_info->name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_name" class="parcel_info_name">
<span<?php echo $parcel_info->name->viewAttributes() ?>>
<?php echo $parcel_info->name->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_name" name="x<?php echo $parcel_info_grid->RowIndex ?>_name" id="x<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_name" name="o<?php echo $parcel_info_grid->RowIndex ?>_name" id="o<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_name" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_name" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_name" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_name" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->categoty->Visible) { // categoty ?>
		<td data-name="categoty"<?php echo $parcel_info->categoty->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_categoty" class="form-group parcel_info_categoty">
<input type="text" data-table="parcel_info" data-field="x_categoty" name="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" size="30" placeholder="<?php echo HtmlEncode($parcel_info->categoty->getPlaceHolder()) ?>" value="<?php echo $parcel_info->categoty->EditValue ?>"<?php echo $parcel_info->categoty->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="o<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="o<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_categoty" class="form-group parcel_info_categoty">
<input type="text" data-table="parcel_info" data-field="x_categoty" name="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" size="30" placeholder="<?php echo HtmlEncode($parcel_info->categoty->getPlaceHolder()) ?>" value="<?php echo $parcel_info->categoty->EditValue ?>"<?php echo $parcel_info->categoty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_categoty" class="parcel_info_categoty">
<span<?php echo $parcel_info->categoty->viewAttributes() ?>>
<?php echo $parcel_info->categoty->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="o<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="o<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->status->Visible) { // status ?>
		<td data-name="status"<?php echo $parcel_info->status->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_status" class="form-group parcel_info_status">
<input type="text" data-table="parcel_info" data-field="x_status" name="x<?php echo $parcel_info_grid->RowIndex ?>_status" id="x<?php echo $parcel_info_grid->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($parcel_info->status->getPlaceHolder()) ?>" value="<?php echo $parcel_info->status->EditValue ?>"<?php echo $parcel_info->status->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_status" name="o<?php echo $parcel_info_grid->RowIndex ?>_status" id="o<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_status" class="form-group parcel_info_status">
<input type="text" data-table="parcel_info" data-field="x_status" name="x<?php echo $parcel_info_grid->RowIndex ?>_status" id="x<?php echo $parcel_info_grid->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($parcel_info->status->getPlaceHolder()) ?>" value="<?php echo $parcel_info->status->EditValue ?>"<?php echo $parcel_info->status->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_status" class="parcel_info_status">
<span<?php echo $parcel_info->status->viewAttributes() ?>>
<?php echo $parcel_info->status->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_status" name="x<?php echo $parcel_info_grid->RowIndex ?>_status" id="x<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_status" name="o<?php echo $parcel_info_grid->RowIndex ?>_status" id="o<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_status" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_status" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_status" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_status" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $parcel_info->createdAt->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_createdAt" class="form-group parcel_info_createdAt">
<input type="text" data-table="parcel_info" data-field="x_createdAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($parcel_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->createdAt->EditValue ?>"<?php echo $parcel_info->createdAt->editAttributes() ?>>
<?php if (!$parcel_info->createdAt->ReadOnly && !$parcel_info->createdAt->Disabled && !isset($parcel_info->createdAt->EditAttrs["readonly"]) && !isset($parcel_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infogrid", "x<?php echo $parcel_info_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_createdAt" class="form-group parcel_info_createdAt">
<input type="text" data-table="parcel_info" data-field="x_createdAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($parcel_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->createdAt->EditValue ?>"<?php echo $parcel_info->createdAt->editAttributes() ?>>
<?php if (!$parcel_info->createdAt->ReadOnly && !$parcel_info->createdAt->Disabled && !isset($parcel_info->createdAt->EditAttrs["readonly"]) && !isset($parcel_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infogrid", "x<?php echo $parcel_info_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_createdAt" class="parcel_info_createdAt">
<span<?php echo $parcel_info->createdAt->viewAttributes() ?>>
<?php echo $parcel_info->createdAt->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($parcel_info->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $parcel_info->updatedAt->cellAttributes() ?>>
<?php if ($parcel_info->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_updatedAt" class="form-group parcel_info_updatedAt">
<input type="text" data-table="parcel_info" data-field="x_updatedAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($parcel_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->updatedAt->EditValue ?>"<?php echo $parcel_info->updatedAt->editAttributes() ?>>
<?php if (!$parcel_info->updatedAt->ReadOnly && !$parcel_info->updatedAt->Disabled && !isset($parcel_info->updatedAt->EditAttrs["readonly"]) && !isset($parcel_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infogrid", "x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->OldValue) ?>">
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_updatedAt" class="form-group parcel_info_updatedAt">
<input type="text" data-table="parcel_info" data-field="x_updatedAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($parcel_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->updatedAt->EditValue ?>"<?php echo $parcel_info->updatedAt->editAttributes() ?>>
<?php if (!$parcel_info->updatedAt->ReadOnly && !$parcel_info->updatedAt->Disabled && !isset($parcel_info->updatedAt->EditAttrs["readonly"]) && !isset($parcel_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infogrid", "x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($parcel_info->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $parcel_info_grid->RowCnt ?>_parcel_info_updatedAt" class="parcel_info_updatedAt">
<span<?php echo $parcel_info->updatedAt->viewAttributes() ?>>
<?php echo $parcel_info->updatedAt->getViewValue() ?></span>
</span>
<?php if (!$parcel_info->isConfirm()) { ?>
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="fparcel_infogrid$x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->FormValue) ?>">
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="fparcel_infogrid$o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$parcel_info_grid->ListOptions->render("body", "right", $parcel_info_grid->RowCnt);
?>
	</tr>
<?php if ($parcel_info->RowType == ROWTYPE_ADD || $parcel_info->RowType == ROWTYPE_EDIT) { ?>
<script>
fparcel_infogrid.updateLists(<?php echo $parcel_info_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$parcel_info->isGridAdd() || $parcel_info->CurrentMode == "copy")
		if (!$parcel_info_grid->Recordset->EOF)
			$parcel_info_grid->Recordset->moveNext();
}
?>
<?php
	if ($parcel_info->CurrentMode == "add" || $parcel_info->CurrentMode == "copy" || $parcel_info->CurrentMode == "edit") {
		$parcel_info_grid->RowIndex = '$rowindex$';
		$parcel_info_grid->loadRowValues();

		// Set row properties
		$parcel_info->resetAttributes();
		$parcel_info->RowAttrs = array_merge($parcel_info->RowAttrs, array('data-rowindex'=>$parcel_info_grid->RowIndex, 'id'=>'r0_parcel_info', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($parcel_info->RowAttrs["class"], "ew-template");
		$parcel_info->RowType = ROWTYPE_ADD;

		// Render row
		$parcel_info_grid->renderRow();

		// Render list options
		$parcel_info_grid->renderListOptions();
		$parcel_info_grid->StartRowCnt = 0;
?>
	<tr<?php echo $parcel_info->rowAttributes() ?>>
<?php

// Render list options (body, left)
$parcel_info_grid->ListOptions->render("body", "left", $parcel_info_grid->RowIndex);
?>
	<?php if ($parcel_info->from_place->Visible) { // from_place ?>
		<td data-name="from_place">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_from_place" class="form-group parcel_info_from_place">
<input type="text" data-table="parcel_info" data-field="x_from_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->from_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->from_place->EditValue ?>"<?php echo $parcel_info->from_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_from_place" class="form-group parcel_info_from_place">
<span<?php echo $parcel_info->from_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->from_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_from_place" name="o<?php echo $parcel_info_grid->RowIndex ?>_from_place" id="o<?php echo $parcel_info_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($parcel_info->from_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->to_place->Visible) { // to_place ?>
		<td data-name="to_place">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_to_place" class="form-group parcel_info_to_place">
<input type="text" data-table="parcel_info" data-field="x_to_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->to_place->getPlaceHolder()) ?>" value="<?php echo $parcel_info->to_place->EditValue ?>"<?php echo $parcel_info->to_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_to_place" class="form-group parcel_info_to_place">
<span<?php echo $parcel_info->to_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->to_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="x<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_to_place" name="o<?php echo $parcel_info_grid->RowIndex ?>_to_place" id="o<?php echo $parcel_info_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($parcel_info->to_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->description->Visible) { // description ?>
		<td data-name="description">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_description" class="form-group parcel_info_description">
<input type="text" data-table="parcel_info" data-field="x_description" name="x<?php echo $parcel_info_grid->RowIndex ?>_description" id="x<?php echo $parcel_info_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->description->getPlaceHolder()) ?>" value="<?php echo $parcel_info->description->EditValue ?>"<?php echo $parcel_info->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_description" class="form-group parcel_info_description">
<span<?php echo $parcel_info->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_description" name="x<?php echo $parcel_info_grid->RowIndex ?>_description" id="x<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_description" name="o<?php echo $parcel_info_grid->RowIndex ?>_description" id="o<?php echo $parcel_info_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($parcel_info->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if (!$parcel_info->isConfirm()) { ?>
<?php if ($parcel_info->user_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_parcel_info_user_id" class="form-group parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_parcel_info_user_id" class="form-group parcel_info_user_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->user_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->user_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" class="text-nowrap" style="z-index: <?php echo (9000 - $parcel_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="sv_x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo RemoveHtml($parcel_info->user_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->user_id->getPlaceHolder()) ?>"<?php echo $parcel_info->user_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" data-value-separator="<?php echo $parcel_info->user_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infogrid.createAutoSuggest({"id":"x<?php echo $parcel_info_grid->RowIndex ?>_user_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_user_id" class="form-group parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_user_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_user_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($parcel_info->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->image_id->Visible) { // image_id ?>
		<td data-name="image_id">
<?php if (!$parcel_info->isConfirm()) { ?>
<?php if ($parcel_info->image_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_parcel_info_image_id" class="form-group parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->ViewValue)) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_parcel_info_image_id" class="form-group parcel_info_image_id">
<?php
$wrkonchange = "" . trim(@$parcel_info->image_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$parcel_info->image_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" class="text-nowrap" style="z-index: <?php echo (9000 - $parcel_info_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="sv_x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo RemoveHtml($parcel_info->image_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($parcel_info->image_id->getPlaceHolder()) ?>"<?php echo $parcel_info->image_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" data-value-separator="<?php echo $parcel_info->image_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fparcel_infogrid.createAutoSuggest({"id":"x<?php echo $parcel_info_grid->RowIndex ?>_image_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_image_id" class="form-group parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->ViewValue)) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>"></a>
<?php } else { ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->image_id->ViewValue) ?>">
<?php } ?>
</span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="x<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_image_id" name="o<?php echo $parcel_info_grid->RowIndex ?>_image_id" id="o<?php echo $parcel_info_grid->RowIndex ?>_image_id" value="<?php echo HtmlEncode($parcel_info->image_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->name->Visible) { // name ?>
		<td data-name="name">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_name" class="form-group parcel_info_name">
<input type="text" data-table="parcel_info" data-field="x_name" name="x<?php echo $parcel_info_grid->RowIndex ?>_name" id="x<?php echo $parcel_info_grid->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($parcel_info->name->getPlaceHolder()) ?>" value="<?php echo $parcel_info->name->EditValue ?>"<?php echo $parcel_info->name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_name" class="form-group parcel_info_name">
<span<?php echo $parcel_info->name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_name" name="x<?php echo $parcel_info_grid->RowIndex ?>_name" id="x<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_name" name="o<?php echo $parcel_info_grid->RowIndex ?>_name" id="o<?php echo $parcel_info_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($parcel_info->name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->categoty->Visible) { // categoty ?>
		<td data-name="categoty">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_categoty" class="form-group parcel_info_categoty">
<input type="text" data-table="parcel_info" data-field="x_categoty" name="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" size="30" placeholder="<?php echo HtmlEncode($parcel_info->categoty->getPlaceHolder()) ?>" value="<?php echo $parcel_info->categoty->EditValue ?>"<?php echo $parcel_info->categoty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_categoty" class="form-group parcel_info_categoty">
<span<?php echo $parcel_info->categoty->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->categoty->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="x<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_categoty" name="o<?php echo $parcel_info_grid->RowIndex ?>_categoty" id="o<?php echo $parcel_info_grid->RowIndex ?>_categoty" value="<?php echo HtmlEncode($parcel_info->categoty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->status->Visible) { // status ?>
		<td data-name="status">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_status" class="form-group parcel_info_status">
<input type="text" data-table="parcel_info" data-field="x_status" name="x<?php echo $parcel_info_grid->RowIndex ?>_status" id="x<?php echo $parcel_info_grid->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($parcel_info->status->getPlaceHolder()) ?>" value="<?php echo $parcel_info->status->EditValue ?>"<?php echo $parcel_info->status->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_status" class="form-group parcel_info_status">
<span<?php echo $parcel_info->status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->status->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_status" name="x<?php echo $parcel_info_grid->RowIndex ?>_status" id="x<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_status" name="o<?php echo $parcel_info_grid->RowIndex ?>_status" id="o<?php echo $parcel_info_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($parcel_info->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_createdAt" class="form-group parcel_info_createdAt">
<input type="text" data-table="parcel_info" data-field="x_createdAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($parcel_info->createdAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->createdAt->EditValue ?>"<?php echo $parcel_info->createdAt->editAttributes() ?>>
<?php if (!$parcel_info->createdAt->ReadOnly && !$parcel_info->createdAt->Disabled && !isset($parcel_info->createdAt->EditAttrs["readonly"]) && !isset($parcel_info->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infogrid", "x<?php echo $parcel_info_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_createdAt" class="form-group parcel_info_createdAt">
<span<?php echo $parcel_info->createdAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->createdAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_createdAt" name="o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" id="o<?php echo $parcel_info_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($parcel_info->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($parcel_info->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<?php if (!$parcel_info->isConfirm()) { ?>
<span id="el$rowindex$_parcel_info_updatedAt" class="form-group parcel_info_updatedAt">
<input type="text" data-table="parcel_info" data-field="x_updatedAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($parcel_info->updatedAt->getPlaceHolder()) ?>" value="<?php echo $parcel_info->updatedAt->EditValue ?>"<?php echo $parcel_info->updatedAt->editAttributes() ?>>
<?php if (!$parcel_info->updatedAt->ReadOnly && !$parcel_info->updatedAt->Disabled && !isset($parcel_info->updatedAt->EditAttrs["readonly"]) && !isset($parcel_info->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fparcel_infogrid", "x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_parcel_info_updatedAt" class="form-group parcel_info_updatedAt">
<span<?php echo $parcel_info->updatedAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($parcel_info->updatedAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="x<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="parcel_info" data-field="x_updatedAt" name="o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" id="o<?php echo $parcel_info_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($parcel_info->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$parcel_info_grid->ListOptions->render("body", "right", $parcel_info_grid->RowIndex);
?>
<script>
fparcel_infogrid.updateLists(<?php echo $parcel_info_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php if ($parcel_info->CurrentMode == "add" || $parcel_info->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $parcel_info_grid->FormKeyCountName ?>" id="<?php echo $parcel_info_grid->FormKeyCountName ?>" value="<?php echo $parcel_info_grid->KeyCount ?>">
<?php echo $parcel_info_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($parcel_info->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $parcel_info_grid->FormKeyCountName ?>" id="<?php echo $parcel_info_grid->FormKeyCountName ?>" value="<?php echo $parcel_info_grid->KeyCount ?>">
<?php echo $parcel_info_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($parcel_info->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fparcel_infogrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($parcel_info_grid->Recordset)
	$parcel_info_grid->Recordset->Close();
?>
</div>
<?php if ($parcel_info_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($parcel_info_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($parcel_info_grid->TotalRecs == 0 && !$parcel_info->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($parcel_info_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$parcel_info_grid->terminate();
?>
