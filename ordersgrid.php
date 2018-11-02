<?php
namespace PHPMaker2019\ferryman;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($orders_grid))
	$orders_grid = new orders_grid();

// Run the page
$orders_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$orders_grid->Page_Render();
?>
<?php if (!$orders->isExport()) { ?>
<script>

// Form object
var fordersgrid = new ew.Form("fordersgrid", "grid");
fordersgrid.formKeyCountName = '<?php echo $orders_grid->FormKeyCountName ?>';

// Validate form
fordersgrid.validate = function() {
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
		<?php if ($orders_grid->_userid->Required) { ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->_userid->caption(), $orders->_userid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->_userid->errorMessage()) ?>");
		<?php if ($orders_grid->parcel_id->Required) { ?>
			elm = this.getElements("x" + infix + "_parcel_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->parcel_id->caption(), $orders->parcel_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_parcel_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->parcel_id->errorMessage()) ?>");
		<?php if ($orders_grid->carrier_id->Required) { ?>
			elm = this.getElements("x" + infix + "_carrier_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->carrier_id->caption(), $orders->carrier_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_carrier_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($orders->carrier_id->errorMessage()) ?>");
		<?php if ($orders_grid->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->description->caption(), $orders->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($orders_grid->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $orders->status->caption(), $orders->status->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fordersgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "_userid", false)) return false;
	if (ew.valueChanged(fobj, infix, "parcel_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "carrier_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "status", false)) return false;
	return true;
}

// Form_CustomValidate event
fordersgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordersgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fordersgrid.lists["x__userid"] = <?php echo $orders_grid->_userid->Lookup->toClientList() ?>;
fordersgrid.lists["x__userid"].options = <?php echo JsonEncode($orders_grid->_userid->lookupOptions()) ?>;
fordersgrid.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersgrid.lists["x_parcel_id"] = <?php echo $orders_grid->parcel_id->Lookup->toClientList() ?>;
fordersgrid.lists["x_parcel_id"].options = <?php echo JsonEncode($orders_grid->parcel_id->lookupOptions()) ?>;
fordersgrid.autoSuggests["x_parcel_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersgrid.lists["x_carrier_id"] = <?php echo $orders_grid->carrier_id->Lookup->toClientList() ?>;
fordersgrid.lists["x_carrier_id"].options = <?php echo JsonEncode($orders_grid->carrier_id->lookupOptions()) ?>;
fordersgrid.autoSuggests["x_carrier_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
fordersgrid.lists["x_status"] = <?php echo $orders_grid->status->Lookup->toClientList() ?>;
fordersgrid.lists["x_status"].options = <?php echo JsonEncode($orders_grid->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$orders_grid->renderOtherOptions();
?>
<?php $orders_grid->showPageHeader(); ?>
<?php
$orders_grid->showMessage();
?>
<?php if ($orders_grid->TotalRecs > 0 || $orders->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($orders_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> orders">
<?php if ($orders_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php
	foreach ($orders_grid->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fordersgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_orders" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_ordersgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$orders_grid->RowType = ROWTYPE_HEADER;

// Render list options
$orders_grid->renderListOptions();

// Render list options (header, left)
$orders_grid->ListOptions->render("header", "left");
?>
<?php if ($orders->_userid->Visible) { // userid ?>
	<?php if ($orders->sortUrl($orders->_userid) == "") { ?>
		<th data-name="_userid" class="<?php echo $orders->_userid->headerCellClass() ?>"><div id="elh_orders__userid" class="orders__userid"><div class="ew-table-header-caption"><?php echo $orders->_userid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userid" class="<?php echo $orders->_userid->headerCellClass() ?>"><div><div id="elh_orders__userid" class="orders__userid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->_userid->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->_userid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->_userid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
	<?php if ($orders->sortUrl($orders->parcel_id) == "") { ?>
		<th data-name="parcel_id" class="<?php echo $orders->parcel_id->headerCellClass() ?>"><div id="elh_orders_parcel_id" class="orders_parcel_id"><div class="ew-table-header-caption"><?php echo $orders->parcel_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="parcel_id" class="<?php echo $orders->parcel_id->headerCellClass() ?>"><div><div id="elh_orders_parcel_id" class="orders_parcel_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->parcel_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->parcel_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->parcel_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
	<?php if ($orders->sortUrl($orders->carrier_id) == "") { ?>
		<th data-name="carrier_id" class="<?php echo $orders->carrier_id->headerCellClass() ?>"><div id="elh_orders_carrier_id" class="orders_carrier_id"><div class="ew-table-header-caption"><?php echo $orders->carrier_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="carrier_id" class="<?php echo $orders->carrier_id->headerCellClass() ?>"><div><div id="elh_orders_carrier_id" class="orders_carrier_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->carrier_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->carrier_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->carrier_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->description->Visible) { // description ?>
	<?php if ($orders->sortUrl($orders->description) == "") { ?>
		<th data-name="description" class="<?php echo $orders->description->headerCellClass() ?>"><div id="elh_orders_description" class="orders_description"><div class="ew-table-header-caption"><?php echo $orders->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $orders->description->headerCellClass() ?>"><div><div id="elh_orders_description" class="orders_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->description->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($orders->status->Visible) { // status ?>
	<?php if ($orders->sortUrl($orders->status) == "") { ?>
		<th data-name="status" class="<?php echo $orders->status->headerCellClass() ?>"><div id="elh_orders_status" class="orders_status"><div class="ew-table-header-caption"><?php echo $orders->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $orders->status->headerCellClass() ?>"><div><div id="elh_orders_status" class="orders_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $orders->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($orders->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($orders->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$orders_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$orders_grid->StartRec = 1;
$orders_grid->StopRec = $orders_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $orders_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($orders_grid->FormKeyCountName) && ($orders->isGridAdd() || $orders->isGridEdit() || $orders->isConfirm())) {
		$orders_grid->KeyCount = $CurrentForm->getValue($orders_grid->FormKeyCountName);
		$orders_grid->StopRec = $orders_grid->StartRec + $orders_grid->KeyCount - 1;
	}
}
$orders_grid->RecCnt = $orders_grid->StartRec - 1;
if ($orders_grid->Recordset && !$orders_grid->Recordset->EOF) {
	$orders_grid->Recordset->moveFirst();
	$selectLimit = $orders_grid->UseSelectLimit;
	if (!$selectLimit && $orders_grid->StartRec > 1)
		$orders_grid->Recordset->move($orders_grid->StartRec - 1);
} elseif (!$orders->AllowAddDeleteRow && $orders_grid->StopRec == 0) {
	$orders_grid->StopRec = $orders->GridAddRowCount;
}

// Initialize aggregate
$orders->RowType = ROWTYPE_AGGREGATEINIT;
$orders->resetAttributes();
$orders_grid->renderRow();
if ($orders->isGridAdd())
	$orders_grid->RowIndex = 0;
if ($orders->isGridEdit())
	$orders_grid->RowIndex = 0;
while ($orders_grid->RecCnt < $orders_grid->StopRec) {
	$orders_grid->RecCnt++;
	if ($orders_grid->RecCnt >= $orders_grid->StartRec) {
		$orders_grid->RowCnt++;
		if ($orders->isGridAdd() || $orders->isGridEdit() || $orders->isConfirm()) {
			$orders_grid->RowIndex++;
			$CurrentForm->Index = $orders_grid->RowIndex;
			if ($CurrentForm->hasValue($orders_grid->FormActionName) && $orders_grid->EventCancelled)
				$orders_grid->RowAction = strval($CurrentForm->getValue($orders_grid->FormActionName));
			elseif ($orders->isGridAdd())
				$orders_grid->RowAction = "insert";
			else
				$orders_grid->RowAction = "";
		}

		// Set up key count
		$orders_grid->KeyCount = $orders_grid->RowIndex;

		// Init row class and style
		$orders->resetAttributes();
		$orders->CssClass = "";
		if ($orders->isGridAdd()) {
			if ($orders->CurrentMode == "copy") {
				$orders_grid->loadRowValues($orders_grid->Recordset); // Load row values
				$orders_grid->setRecordKey($orders_grid->RowOldKey, $orders_grid->Recordset); // Set old record key
			} else {
				$orders_grid->loadRowValues(); // Load default values
				$orders_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$orders_grid->loadRowValues($orders_grid->Recordset); // Load row values
		}
		$orders->RowType = ROWTYPE_VIEW; // Render view
		if ($orders->isGridAdd()) // Grid add
			$orders->RowType = ROWTYPE_ADD; // Render add
		if ($orders->isGridAdd() && $orders->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$orders_grid->restoreCurrentRowFormValues($orders_grid->RowIndex); // Restore form values
		if ($orders->isGridEdit()) { // Grid edit
			if ($orders->EventCancelled)
				$orders_grid->restoreCurrentRowFormValues($orders_grid->RowIndex); // Restore form values
			if ($orders_grid->RowAction == "insert")
				$orders->RowType = ROWTYPE_ADD; // Render add
			else
				$orders->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($orders->isGridEdit() && ($orders->RowType == ROWTYPE_EDIT || $orders->RowType == ROWTYPE_ADD) && $orders->EventCancelled) // Update failed
			$orders_grid->restoreCurrentRowFormValues($orders_grid->RowIndex); // Restore form values
		if ($orders->RowType == ROWTYPE_EDIT) // Edit row
			$orders_grid->EditRowCnt++;
		if ($orders->isConfirm()) // Confirm row
			$orders_grid->restoreCurrentRowFormValues($orders_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$orders->RowAttrs = array_merge($orders->RowAttrs, array('data-rowindex'=>$orders_grid->RowCnt, 'id'=>'r' . $orders_grid->RowCnt . '_orders', 'data-rowtype'=>$orders->RowType));

		// Render row
		$orders_grid->renderRow();

		// Render list options
		$orders_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($orders_grid->RowAction <> "delete" && $orders_grid->RowAction <> "insertdelete" && !($orders_grid->RowAction == "insert" && $orders->isConfirm() && $orders_grid->emptyRow())) {
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_grid->ListOptions->render("body", "left", $orders_grid->RowCnt);
?>
	<?php if ($orders->_userid->Visible) { // userid ?>
		<td data-name="_userid"<?php echo $orders->_userid->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>__userid" name="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>__userid" id="sv_x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>__userid" id="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="o<?php echo $orders_grid->RowIndex ?>__userid" id="o<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>__userid" name="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>__userid" id="sv_x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>__userid" id="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders__userid" class="orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<?php echo $orders->_userid->getViewValue() ?></span>
</span>
<?php if (!$orders->isConfirm()) { ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="x<?php echo $orders_grid->RowIndex ?>__userid" id="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x__userid" name="o<?php echo $orders_grid->RowIndex ?>__userid" id="o<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="fordersgrid$x<?php echo $orders_grid->RowIndex ?>__userid" id="fordersgrid$x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x__userid" name="fordersgrid$o<?php echo $orders_grid->RowIndex ?>__userid" id="fordersgrid$o<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="orders" data-field="x_id" name="x<?php echo $orders_grid->RowIndex ?>_id" id="x<?php echo $orders_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($orders->id->CurrentValue) ?>">
<input type="hidden" data-table="orders" data-field="x_id" name="o<?php echo $orders_grid->RowIndex ?>_id" id="o<?php echo $orders_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($orders->id->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT || $orders->CurrentMode == "edit") { ?>
<input type="hidden" data-table="orders" data-field="x_id" name="x<?php echo $orders_grid->RowIndex ?>_id" id="x<?php echo $orders_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($orders->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<td data-name="parcel_id"<?php echo $orders->parcel_id->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="o<?php echo $orders_grid->RowIndex ?>_parcel_id" id="o<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_parcel_id" class="orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<?php echo $orders->parcel_id->getViewValue() ?></span>
</span>
<?php if (!$orders->isConfirm()) { ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="o<?php echo $orders_grid->RowIndex ?>_parcel_id" id="o<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_parcel_id" id="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<td data-name="carrier_id"<?php echo $orders->carrier_id->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="o<?php echo $orders_grid->RowIndex ?>_carrier_id" id="o<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_carrier_id" class="orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<?php echo $orders->carrier_id->getViewValue() ?></span>
</span>
<?php if (!$orders->isConfirm()) { ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="o<?php echo $orders_grid->RowIndex ?>_carrier_id" id="o<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_carrier_id" id="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($orders->description->Visible) { // description ?>
		<td data-name="description"<?php echo $orders->description->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_grid->RowIndex ?>_description" id="x<?php echo $orders_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_description" name="o<?php echo $orders_grid->RowIndex ?>_description" id="o<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_grid->RowIndex ?>_description" id="x<?php echo $orders_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_description" class="orders_description">
<span<?php echo $orders->description->viewAttributes() ?>>
<?php echo $orders->description->getViewValue() ?></span>
</span>
<?php if (!$orders->isConfirm()) { ?>
<input type="hidden" data-table="orders" data-field="x_description" name="x<?php echo $orders_grid->RowIndex ?>_description" id="x<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_description" name="o<?php echo $orders_grid->RowIndex ?>_description" id="o<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="orders" data-field="x_description" name="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_description" id="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_description" name="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_description" id="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($orders->status->Visible) { // status ?>
		<td data-name="status"<?php echo $orders->status->cellAttributes() ?>>
<?php if ($orders->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_grid->RowIndex ?>_status" name="x<?php echo $orders_grid->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_grid->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="orders" data-field="x_status" name="o<?php echo $orders_grid->RowIndex ?>_status" id="o<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_grid->RowIndex ?>_status" name="x<?php echo $orders_grid->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_grid->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($orders->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $orders_grid->RowCnt ?>_orders_status" class="orders_status">
<span<?php echo $orders->status->viewAttributes() ?>>
<?php echo $orders->status->getViewValue() ?></span>
</span>
<?php if (!$orders->isConfirm()) { ?>
<input type="hidden" data-table="orders" data-field="x_status" name="x<?php echo $orders_grid->RowIndex ?>_status" id="x<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_status" name="o<?php echo $orders_grid->RowIndex ?>_status" id="o<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="orders" data-field="x_status" name="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_status" id="fordersgrid$x<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->FormValue) ?>">
<input type="hidden" data-table="orders" data-field="x_status" name="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_status" id="fordersgrid$o<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_grid->ListOptions->render("body", "right", $orders_grid->RowCnt);
?>
	</tr>
<?php if ($orders->RowType == ROWTYPE_ADD || $orders->RowType == ROWTYPE_EDIT) { ?>
<script>
fordersgrid.updateLists(<?php echo $orders_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$orders->isGridAdd() || $orders->CurrentMode == "copy")
		if (!$orders_grid->Recordset->EOF)
			$orders_grid->Recordset->moveNext();
}
?>
<?php
	if ($orders->CurrentMode == "add" || $orders->CurrentMode == "copy" || $orders->CurrentMode == "edit") {
		$orders_grid->RowIndex = '$rowindex$';
		$orders_grid->loadRowValues();

		// Set row properties
		$orders->resetAttributes();
		$orders->RowAttrs = array_merge($orders->RowAttrs, array('data-rowindex'=>$orders_grid->RowIndex, 'id'=>'r0_orders', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($orders->RowAttrs["class"], "ew-template");
		$orders->RowType = ROWTYPE_ADD;

		// Render row
		$orders_grid->renderRow();

		// Render list options
		$orders_grid->renderListOptions();
		$orders_grid->StartRowCnt = 0;
?>
	<tr<?php echo $orders->rowAttributes() ?>>
<?php

// Render list options (body, left)
$orders_grid->ListOptions->render("body", "left", $orders_grid->RowIndex);
?>
	<?php if ($orders->_userid->Visible) { // userid ?>
		<td data-name="_userid">
<?php if (!$orders->isConfirm()) { ?>
<?php if ($orders->_userid->getSessionValue() <> "") { ?>
<span id="el$rowindex$_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>__userid" name="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_orders__userid" class="form-group orders__userid">
<?php
$wrkonchange = "" . trim(@$orders->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>__userid" id="sv_x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo RemoveHtml($orders->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->_userid->getPlaceHolder()) ?>"<?php echo $orders->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" data-value-separator="<?php echo $orders->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>__userid" id="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_orders__userid" class="form-group orders__userid">
<span<?php echo $orders->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x__userid" name="x<?php echo $orders_grid->RowIndex ?>__userid" id="x<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="orders" data-field="x__userid" name="o<?php echo $orders_grid->RowIndex ?>__userid" id="o<?php echo $orders_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($orders->_userid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->parcel_id->Visible) { // parcel_id ?>
		<td data-name="parcel_id">
<?php if (!$orders->isConfirm()) { ?>
<?php if ($orders->parcel_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_orders_parcel_id" class="form-group orders_parcel_id">
<?php
$wrkonchange = "" . trim(@$orders->parcel_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->parcel_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>_parcel_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="sv_x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo RemoveHtml($orders->parcel_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->parcel_id->getPlaceHolder()) ?>"<?php echo $orders->parcel_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" data-value-separator="<?php echo $orders->parcel_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>_parcel_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_orders_parcel_id" class="form-group orders_parcel_id">
<span<?php echo $orders->parcel_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->parcel_id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="x<?php echo $orders_grid->RowIndex ?>_parcel_id" id="x<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_parcel_id" name="o<?php echo $orders_grid->RowIndex ?>_parcel_id" id="o<?php echo $orders_grid->RowIndex ?>_parcel_id" value="<?php echo HtmlEncode($orders->parcel_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->carrier_id->Visible) { // carrier_id ?>
		<td data-name="carrier_id">
<?php if (!$orders->isConfirm()) { ?>
<?php if ($orders->carrier_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_orders_carrier_id" class="form-group orders_carrier_id">
<?php
$wrkonchange = "" . trim(@$orders->carrier_id->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$orders->carrier_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $orders_grid->RowIndex ?>_carrier_id" class="text-nowrap" style="z-index: <?php echo (9000 - $orders_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="sv_x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo RemoveHtml($orders->carrier_id->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($orders->carrier_id->getPlaceHolder()) ?>"<?php echo $orders->carrier_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" data-value-separator="<?php echo $orders->carrier_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fordersgrid.createAutoSuggest({"id":"x<?php echo $orders_grid->RowIndex ?>_carrier_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_orders_carrier_id" class="form-group orders_carrier_id">
<span<?php echo $orders->carrier_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->carrier_id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="x<?php echo $orders_grid->RowIndex ?>_carrier_id" id="x<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_carrier_id" name="o<?php echo $orders_grid->RowIndex ?>_carrier_id" id="o<?php echo $orders_grid->RowIndex ?>_carrier_id" value="<?php echo HtmlEncode($orders->carrier_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->description->Visible) { // description ?>
		<td data-name="description">
<?php if (!$orders->isConfirm()) { ?>
<span id="el$rowindex$_orders_description" class="form-group orders_description">
<input type="text" data-table="orders" data-field="x_description" name="x<?php echo $orders_grid->RowIndex ?>_description" id="x<?php echo $orders_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($orders->description->getPlaceHolder()) ?>" value="<?php echo $orders->description->EditValue ?>"<?php echo $orders->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_orders_description" class="form-group orders_description">
<span<?php echo $orders->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x_description" name="x<?php echo $orders_grid->RowIndex ?>_description" id="x<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_description" name="o<?php echo $orders_grid->RowIndex ?>_description" id="o<?php echo $orders_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($orders->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($orders->status->Visible) { // status ?>
		<td data-name="status">
<?php if (!$orders->isConfirm()) { ?>
<span id="el$rowindex$_orders_status" class="form-group orders_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="orders" data-field="x_status" data-value-separator="<?php echo $orders->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $orders_grid->RowIndex ?>_status" name="x<?php echo $orders_grid->RowIndex ?>_status"<?php echo $orders->status->editAttributes() ?>>
		<?php echo $orders->status->selectOptionListHtml("x<?php echo $orders_grid->RowIndex ?>_status") ?>
	</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_orders_status" class="form-group orders_status">
<span<?php echo $orders->status->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($orders->status->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="orders" data-field="x_status" name="x<?php echo $orders_grid->RowIndex ?>_status" id="x<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="orders" data-field="x_status" name="o<?php echo $orders_grid->RowIndex ?>_status" id="o<?php echo $orders_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($orders->status->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$orders_grid->ListOptions->render("body", "right", $orders_grid->RowIndex);
?>
<script>
fordersgrid.updateLists(<?php echo $orders_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php if ($orders->CurrentMode == "add" || $orders->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $orders_grid->FormKeyCountName ?>" id="<?php echo $orders_grid->FormKeyCountName ?>" value="<?php echo $orders_grid->KeyCount ?>">
<?php echo $orders_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($orders->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $orders_grid->FormKeyCountName ?>" id="<?php echo $orders_grid->FormKeyCountName ?>" value="<?php echo $orders_grid->KeyCount ?>">
<?php echo $orders_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($orders->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fordersgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($orders_grid->Recordset)
	$orders_grid->Recordset->Close();
?>
</div>
<?php if ($orders_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($orders_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($orders_grid->TotalRecs == 0 && !$orders->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($orders_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$orders_grid->terminate();
?>
