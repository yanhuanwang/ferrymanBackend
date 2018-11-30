<?php
namespace PHPMaker2019\ferryman;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($order_grid))
	$order_grid = new order_grid();

// Run the page
$order_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$order_grid->Page_Render();
?>
<?php if (!$order->isExport()) { ?>
<script>

// Form object
var fordergrid = new ew.Form("fordergrid", "grid");
fordergrid.formKeyCountName = '<?php echo $order_grid->FormKeyCountName ?>';

// Validate form
fordergrid.validate = function() {
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
		<?php if ($order_grid->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->id->caption(), $order->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_grid->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->user_id->caption(), $order->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_grid->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->from_place->caption(), $order->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_grid->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->to_place->caption(), $order->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_grid->date->Required) { ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->date->caption(), $order->date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($order->date->errorMessage()) ?>");
		<?php if ($order_grid->flight_number->Required) { ?>
			elm = this.getElements("x" + infix + "_flight_number");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->flight_number->caption(), $order->flight_number->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_grid->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->description->caption(), $order->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($order_grid->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $order->createdAt->caption(), $order->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($order->createdAt->errorMessage()) ?>");
		<?php if ($order_grid->updatedAt->Required) { ?>
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
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fordergrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "user_id", false)) return false;
	if (ew.valueChanged(fobj, infix, "from_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "date", false)) return false;
	if (ew.valueChanged(fobj, infix, "flight_number", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "createdAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "updatedAt", false)) return false;
	return true;
}

// Form_CustomValidate event
fordergrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fordergrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fordergrid.lists["x_user_id"] = <?php echo $order_grid->user_id->Lookup->toClientList() ?>;
fordergrid.lists["x_user_id"].options = <?php echo JsonEncode($order_grid->user_id->lookupOptions()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$order_grid->renderOtherOptions();
?>
<?php $order_grid->showPageHeader(); ?>
<?php
$order_grid->showMessage();
?>
<?php if ($order_grid->TotalRecs > 0 || $order->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($order_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> order">
<?php if ($order_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php
	foreach ($order_grid->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fordergrid" class="ew-form ew-list-form form-inline">
<div id="gmp_order" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_ordergrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$order_grid->RowType = ROWTYPE_HEADER;

// Render list options
$order_grid->renderListOptions();

// Render list options (header, left)
$order_grid->ListOptions->render("header", "left");
?>
<?php if ($order->id->Visible) { // id ?>
	<?php if ($order->sortUrl($order->id) == "") { ?>
		<th data-name="id" class="<?php echo $order->id->headerCellClass() ?>"><div id="elh_order_id" class="order_id"><div class="ew-table-header-caption"><?php echo $order->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $order->id->headerCellClass() ?>"><div><div id="elh_order_id" class="order_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->user_id->Visible) { // user_id ?>
	<?php if ($order->sortUrl($order->user_id) == "") { ?>
		<th data-name="user_id" class="<?php echo $order->user_id->headerCellClass() ?>"><div id="elh_order_user_id" class="order_user_id"><div class="ew-table-header-caption"><?php echo $order->user_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_id" class="<?php echo $order->user_id->headerCellClass() ?>"><div><div id="elh_order_user_id" class="order_user_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->user_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->user_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->user_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->from_place->Visible) { // from_place ?>
	<?php if ($order->sortUrl($order->from_place) == "") { ?>
		<th data-name="from_place" class="<?php echo $order->from_place->headerCellClass() ?>"><div id="elh_order_from_place" class="order_from_place"><div class="ew-table-header-caption"><?php echo $order->from_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_place" class="<?php echo $order->from_place->headerCellClass() ?>"><div><div id="elh_order_from_place" class="order_from_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->from_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->from_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->from_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->to_place->Visible) { // to_place ?>
	<?php if ($order->sortUrl($order->to_place) == "") { ?>
		<th data-name="to_place" class="<?php echo $order->to_place->headerCellClass() ?>"><div id="elh_order_to_place" class="order_to_place"><div class="ew-table-header-caption"><?php echo $order->to_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_place" class="<?php echo $order->to_place->headerCellClass() ?>"><div><div id="elh_order_to_place" class="order_to_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->to_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->to_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->to_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->date->Visible) { // date ?>
	<?php if ($order->sortUrl($order->date) == "") { ?>
		<th data-name="date" class="<?php echo $order->date->headerCellClass() ?>"><div id="elh_order_date" class="order_date"><div class="ew-table-header-caption"><?php echo $order->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $order->date->headerCellClass() ?>"><div><div id="elh_order_date" class="order_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->flight_number->Visible) { // flight_number ?>
	<?php if ($order->sortUrl($order->flight_number) == "") { ?>
		<th data-name="flight_number" class="<?php echo $order->flight_number->headerCellClass() ?>"><div id="elh_order_flight_number" class="order_flight_number"><div class="ew-table-header-caption"><?php echo $order->flight_number->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="flight_number" class="<?php echo $order->flight_number->headerCellClass() ?>"><div><div id="elh_order_flight_number" class="order_flight_number">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->flight_number->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->flight_number->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->flight_number->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->description->Visible) { // description ?>
	<?php if ($order->sortUrl($order->description) == "") { ?>
		<th data-name="description" class="<?php echo $order->description->headerCellClass() ?>"><div id="elh_order_description" class="order_description"><div class="ew-table-header-caption"><?php echo $order->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $order->description->headerCellClass() ?>"><div><div id="elh_order_description" class="order_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->description->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->createdAt->Visible) { // createdAt ?>
	<?php if ($order->sortUrl($order->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $order->createdAt->headerCellClass() ?>"><div id="elh_order_createdAt" class="order_createdAt"><div class="ew-table-header-caption"><?php echo $order->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $order->createdAt->headerCellClass() ?>"><div><div id="elh_order_createdAt" class="order_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($order->updatedAt->Visible) { // updatedAt ?>
	<?php if ($order->sortUrl($order->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $order->updatedAt->headerCellClass() ?>"><div id="elh_order_updatedAt" class="order_updatedAt"><div class="ew-table-header-caption"><?php echo $order->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $order->updatedAt->headerCellClass() ?>"><div><div id="elh_order_updatedAt" class="order_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $order->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($order->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($order->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$order_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$order_grid->StartRec = 1;
$order_grid->StopRec = $order_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $order_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($order_grid->FormKeyCountName) && ($order->isGridAdd() || $order->isGridEdit() || $order->isConfirm())) {
		$order_grid->KeyCount = $CurrentForm->getValue($order_grid->FormKeyCountName);
		$order_grid->StopRec = $order_grid->StartRec + $order_grid->KeyCount - 1;
	}
}
$order_grid->RecCnt = $order_grid->StartRec - 1;
if ($order_grid->Recordset && !$order_grid->Recordset->EOF) {
	$order_grid->Recordset->moveFirst();
	$selectLimit = $order_grid->UseSelectLimit;
	if (!$selectLimit && $order_grid->StartRec > 1)
		$order_grid->Recordset->move($order_grid->StartRec - 1);
} elseif (!$order->AllowAddDeleteRow && $order_grid->StopRec == 0) {
	$order_grid->StopRec = $order->GridAddRowCount;
}

// Initialize aggregate
$order->RowType = ROWTYPE_AGGREGATEINIT;
$order->resetAttributes();
$order_grid->renderRow();
if ($order->isGridAdd())
	$order_grid->RowIndex = 0;
if ($order->isGridEdit())
	$order_grid->RowIndex = 0;
while ($order_grid->RecCnt < $order_grid->StopRec) {
	$order_grid->RecCnt++;
	if ($order_grid->RecCnt >= $order_grid->StartRec) {
		$order_grid->RowCnt++;
		if ($order->isGridAdd() || $order->isGridEdit() || $order->isConfirm()) {
			$order_grid->RowIndex++;
			$CurrentForm->Index = $order_grid->RowIndex;
			if ($CurrentForm->hasValue($order_grid->FormActionName) && $order_grid->EventCancelled)
				$order_grid->RowAction = strval($CurrentForm->getValue($order_grid->FormActionName));
			elseif ($order->isGridAdd())
				$order_grid->RowAction = "insert";
			else
				$order_grid->RowAction = "";
		}

		// Set up key count
		$order_grid->KeyCount = $order_grid->RowIndex;

		// Init row class and style
		$order->resetAttributes();
		$order->CssClass = "";
		if ($order->isGridAdd()) {
			if ($order->CurrentMode == "copy") {
				$order_grid->loadRowValues($order_grid->Recordset); // Load row values
				$order_grid->setRecordKey($order_grid->RowOldKey, $order_grid->Recordset); // Set old record key
			} else {
				$order_grid->loadRowValues(); // Load default values
				$order_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$order_grid->loadRowValues($order_grid->Recordset); // Load row values
		}
		$order->RowType = ROWTYPE_VIEW; // Render view
		if ($order->isGridAdd()) // Grid add
			$order->RowType = ROWTYPE_ADD; // Render add
		if ($order->isGridAdd() && $order->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$order_grid->restoreCurrentRowFormValues($order_grid->RowIndex); // Restore form values
		if ($order->isGridEdit()) { // Grid edit
			if ($order->EventCancelled)
				$order_grid->restoreCurrentRowFormValues($order_grid->RowIndex); // Restore form values
			if ($order_grid->RowAction == "insert")
				$order->RowType = ROWTYPE_ADD; // Render add
			else
				$order->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($order->isGridEdit() && ($order->RowType == ROWTYPE_EDIT || $order->RowType == ROWTYPE_ADD) && $order->EventCancelled) // Update failed
			$order_grid->restoreCurrentRowFormValues($order_grid->RowIndex); // Restore form values
		if ($order->RowType == ROWTYPE_EDIT) // Edit row
			$order_grid->EditRowCnt++;
		if ($order->isConfirm()) // Confirm row
			$order_grid->restoreCurrentRowFormValues($order_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$order->RowAttrs = array_merge($order->RowAttrs, array('data-rowindex'=>$order_grid->RowCnt, 'id'=>'r' . $order_grid->RowCnt . '_order', 'data-rowtype'=>$order->RowType));

		// Render row
		$order_grid->renderRow();

		// Render list options
		$order_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($order_grid->RowAction <> "delete" && $order_grid->RowAction <> "insertdelete" && !($order_grid->RowAction == "insert" && $order->isConfirm() && $order_grid->emptyRow())) {
?>
	<tr<?php echo $order->rowAttributes() ?>>
<?php

// Render list options (body, left)
$order_grid->ListOptions->render("body", "left", $order_grid->RowCnt);
?>
	<?php if ($order->id->Visible) { // id ?>
		<td data-name="id"<?php echo $order->id->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="order" data-field="x_id" name="o<?php echo $order_grid->RowIndex ?>_id" id="o<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_id" class="form-group order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_id" name="x<?php echo $order_grid->RowIndex ?>_id" id="x<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->CurrentValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_id" class="order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<?php echo $order->id->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_id" name="x<?php echo $order_grid->RowIndex ?>_id" id="x<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_id" name="o<?php echo $order_grid->RowIndex ?>_id" id="o<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_id" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_id" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_id" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_id" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->user_id->Visible) { // user_id ?>
		<td data-name="user_id"<?php echo $order->user_id->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($order->user_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_user_id" class="form-group order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $order_grid->RowIndex ?>_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_user_id" class="form-group order_user_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="order" data-field="x_user_id" data-value-separator="<?php echo $order->user_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $order_grid->RowIndex ?>_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id"<?php echo $order->user_id->editAttributes() ?>>
		<?php echo $order->user_id->selectOptionListHtml("x<?php echo $order_grid->RowIndex ?>_user_id") ?>
	</select>
<?php echo $order->user_id->Lookup->getParamTag("p_x<?php echo $order_grid->RowIndex ?>_user_id") ?>
</div>
</span>
<?php } ?>
<input type="hidden" data-table="order" data-field="x_user_id" name="o<?php echo $order_grid->RowIndex ?>_user_id" id="o<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($order->user_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_user_id" class="form-group order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $order_grid->RowIndex ?>_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_user_id" class="form-group order_user_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="order" data-field="x_user_id" data-value-separator="<?php echo $order->user_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $order_grid->RowIndex ?>_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id"<?php echo $order->user_id->editAttributes() ?>>
		<?php echo $order->user_id->selectOptionListHtml("x<?php echo $order_grid->RowIndex ?>_user_id") ?>
	</select>
<?php echo $order->user_id->Lookup->getParamTag("p_x<?php echo $order_grid->RowIndex ?>_user_id") ?>
</div>
</span>
<?php } ?>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_user_id" class="order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<?php echo $order->user_id->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id" id="x<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_user_id" name="o<?php echo $order_grid->RowIndex ?>_user_id" id="o<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_user_id" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_user_id" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_user_id" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_user_id" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->from_place->Visible) { // from_place ?>
		<td data-name="from_place"<?php echo $order->from_place->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_from_place" class="form-group order_from_place">
<input type="text" data-table="order" data-field="x_from_place" name="x<?php echo $order_grid->RowIndex ?>_from_place" id="x<?php echo $order_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->from_place->getPlaceHolder()) ?>" value="<?php echo $order->from_place->EditValue ?>"<?php echo $order->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="order" data-field="x_from_place" name="o<?php echo $order_grid->RowIndex ?>_from_place" id="o<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_from_place" class="form-group order_from_place">
<input type="text" data-table="order" data-field="x_from_place" name="x<?php echo $order_grid->RowIndex ?>_from_place" id="x<?php echo $order_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->from_place->getPlaceHolder()) ?>" value="<?php echo $order->from_place->EditValue ?>"<?php echo $order->from_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_from_place" class="order_from_place">
<span<?php echo $order->from_place->viewAttributes() ?>>
<?php echo $order->from_place->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_from_place" name="x<?php echo $order_grid->RowIndex ?>_from_place" id="x<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_from_place" name="o<?php echo $order_grid->RowIndex ?>_from_place" id="o<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_from_place" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_from_place" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_from_place" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_from_place" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->to_place->Visible) { // to_place ?>
		<td data-name="to_place"<?php echo $order->to_place->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_to_place" class="form-group order_to_place">
<input type="text" data-table="order" data-field="x_to_place" name="x<?php echo $order_grid->RowIndex ?>_to_place" id="x<?php echo $order_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->to_place->getPlaceHolder()) ?>" value="<?php echo $order->to_place->EditValue ?>"<?php echo $order->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="order" data-field="x_to_place" name="o<?php echo $order_grid->RowIndex ?>_to_place" id="o<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_to_place" class="form-group order_to_place">
<input type="text" data-table="order" data-field="x_to_place" name="x<?php echo $order_grid->RowIndex ?>_to_place" id="x<?php echo $order_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->to_place->getPlaceHolder()) ?>" value="<?php echo $order->to_place->EditValue ?>"<?php echo $order->to_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_to_place" class="order_to_place">
<span<?php echo $order->to_place->viewAttributes() ?>>
<?php echo $order->to_place->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_to_place" name="x<?php echo $order_grid->RowIndex ?>_to_place" id="x<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_to_place" name="o<?php echo $order_grid->RowIndex ?>_to_place" id="o<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_to_place" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_to_place" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_to_place" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_to_place" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->date->Visible) { // date ?>
		<td data-name="date"<?php echo $order->date->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_date" class="form-group order_date">
<input type="text" data-table="order" data-field="x_date" name="x<?php echo $order_grid->RowIndex ?>_date" id="x<?php echo $order_grid->RowIndex ?>_date" placeholder="<?php echo HtmlEncode($order->date->getPlaceHolder()) ?>" value="<?php echo $order->date->EditValue ?>"<?php echo $order->date->editAttributes() ?>>
<?php if (!$order->date->ReadOnly && !$order->date->Disabled && !isset($order->date->EditAttrs["readonly"]) && !isset($order->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="order" data-field="x_date" name="o<?php echo $order_grid->RowIndex ?>_date" id="o<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_date" class="form-group order_date">
<input type="text" data-table="order" data-field="x_date" name="x<?php echo $order_grid->RowIndex ?>_date" id="x<?php echo $order_grid->RowIndex ?>_date" placeholder="<?php echo HtmlEncode($order->date->getPlaceHolder()) ?>" value="<?php echo $order->date->EditValue ?>"<?php echo $order->date->editAttributes() ?>>
<?php if (!$order->date->ReadOnly && !$order->date->Disabled && !isset($order->date->EditAttrs["readonly"]) && !isset($order->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_date" class="order_date">
<span<?php echo $order->date->viewAttributes() ?>>
<?php echo $order->date->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_date" name="x<?php echo $order_grid->RowIndex ?>_date" id="x<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_date" name="o<?php echo $order_grid->RowIndex ?>_date" id="o<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_date" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_date" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_date" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_date" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->flight_number->Visible) { // flight_number ?>
		<td data-name="flight_number"<?php echo $order->flight_number->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_flight_number" class="form-group order_flight_number">
<input type="text" data-table="order" data-field="x_flight_number" name="x<?php echo $order_grid->RowIndex ?>_flight_number" id="x<?php echo $order_grid->RowIndex ?>_flight_number" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($order->flight_number->getPlaceHolder()) ?>" value="<?php echo $order->flight_number->EditValue ?>"<?php echo $order->flight_number->editAttributes() ?>>
</span>
<input type="hidden" data-table="order" data-field="x_flight_number" name="o<?php echo $order_grid->RowIndex ?>_flight_number" id="o<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_flight_number" class="form-group order_flight_number">
<input type="text" data-table="order" data-field="x_flight_number" name="x<?php echo $order_grid->RowIndex ?>_flight_number" id="x<?php echo $order_grid->RowIndex ?>_flight_number" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($order->flight_number->getPlaceHolder()) ?>" value="<?php echo $order->flight_number->EditValue ?>"<?php echo $order->flight_number->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_flight_number" class="order_flight_number">
<span<?php echo $order->flight_number->viewAttributes() ?>>
<?php echo $order->flight_number->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_flight_number" name="x<?php echo $order_grid->RowIndex ?>_flight_number" id="x<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_flight_number" name="o<?php echo $order_grid->RowIndex ?>_flight_number" id="o<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_flight_number" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_flight_number" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_flight_number" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_flight_number" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->description->Visible) { // description ?>
		<td data-name="description"<?php echo $order->description->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_description" class="form-group order_description">
<input type="text" data-table="order" data-field="x_description" name="x<?php echo $order_grid->RowIndex ?>_description" id="x<?php echo $order_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->description->getPlaceHolder()) ?>" value="<?php echo $order->description->EditValue ?>"<?php echo $order->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="order" data-field="x_description" name="o<?php echo $order_grid->RowIndex ?>_description" id="o<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_description" class="form-group order_description">
<input type="text" data-table="order" data-field="x_description" name="x<?php echo $order_grid->RowIndex ?>_description" id="x<?php echo $order_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->description->getPlaceHolder()) ?>" value="<?php echo $order->description->EditValue ?>"<?php echo $order->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_description" class="order_description">
<span<?php echo $order->description->viewAttributes() ?>>
<?php echo $order->description->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_description" name="x<?php echo $order_grid->RowIndex ?>_description" id="x<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_description" name="o<?php echo $order_grid->RowIndex ?>_description" id="o<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_description" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_description" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_description" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_description" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $order->createdAt->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_createdAt" class="form-group order_createdAt">
<input type="text" data-table="order" data-field="x_createdAt" name="x<?php echo $order_grid->RowIndex ?>_createdAt" id="x<?php echo $order_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($order->createdAt->getPlaceHolder()) ?>" value="<?php echo $order->createdAt->EditValue ?>"<?php echo $order->createdAt->editAttributes() ?>>
<?php if (!$order->createdAt->ReadOnly && !$order->createdAt->Disabled && !isset($order->createdAt->EditAttrs["readonly"]) && !isset($order->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="order" data-field="x_createdAt" name="o<?php echo $order_grid->RowIndex ?>_createdAt" id="o<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_createdAt" class="form-group order_createdAt">
<input type="text" data-table="order" data-field="x_createdAt" name="x<?php echo $order_grid->RowIndex ?>_createdAt" id="x<?php echo $order_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($order->createdAt->getPlaceHolder()) ?>" value="<?php echo $order->createdAt->EditValue ?>"<?php echo $order->createdAt->editAttributes() ?>>
<?php if (!$order->createdAt->ReadOnly && !$order->createdAt->Disabled && !isset($order->createdAt->EditAttrs["readonly"]) && !isset($order->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_createdAt" class="order_createdAt">
<span<?php echo $order->createdAt->viewAttributes() ?>>
<?php echo $order->createdAt->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_createdAt" name="x<?php echo $order_grid->RowIndex ?>_createdAt" id="x<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_createdAt" name="o<?php echo $order_grid->RowIndex ?>_createdAt" id="o<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_createdAt" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_createdAt" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_createdAt" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_createdAt" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($order->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $order->updatedAt->cellAttributes() ?>>
<?php if ($order->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_updatedAt" class="form-group order_updatedAt">
<input type="text" data-table="order" data-field="x_updatedAt" name="x<?php echo $order_grid->RowIndex ?>_updatedAt" id="x<?php echo $order_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($order->updatedAt->getPlaceHolder()) ?>" value="<?php echo $order->updatedAt->EditValue ?>"<?php echo $order->updatedAt->editAttributes() ?>>
<?php if (!$order->updatedAt->ReadOnly && !$order->updatedAt->Disabled && !isset($order->updatedAt->EditAttrs["readonly"]) && !isset($order->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="order" data-field="x_updatedAt" name="o<?php echo $order_grid->RowIndex ?>_updatedAt" id="o<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->OldValue) ?>">
<?php } ?>
<?php if ($order->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_updatedAt" class="form-group order_updatedAt">
<input type="text" data-table="order" data-field="x_updatedAt" name="x<?php echo $order_grid->RowIndex ?>_updatedAt" id="x<?php echo $order_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($order->updatedAt->getPlaceHolder()) ?>" value="<?php echo $order->updatedAt->EditValue ?>"<?php echo $order->updatedAt->editAttributes() ?>>
<?php if (!$order->updatedAt->ReadOnly && !$order->updatedAt->Disabled && !isset($order->updatedAt->EditAttrs["readonly"]) && !isset($order->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($order->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $order_grid->RowCnt ?>_order_updatedAt" class="order_updatedAt">
<span<?php echo $order->updatedAt->viewAttributes() ?>>
<?php echo $order->updatedAt->getViewValue() ?></span>
</span>
<?php if (!$order->isConfirm()) { ?>
<input type="hidden" data-table="order" data-field="x_updatedAt" name="x<?php echo $order_grid->RowIndex ?>_updatedAt" id="x<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_updatedAt" name="o<?php echo $order_grid->RowIndex ?>_updatedAt" id="o<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="order" data-field="x_updatedAt" name="fordergrid$x<?php echo $order_grid->RowIndex ?>_updatedAt" id="fordergrid$x<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->FormValue) ?>">
<input type="hidden" data-table="order" data-field="x_updatedAt" name="fordergrid$o<?php echo $order_grid->RowIndex ?>_updatedAt" id="fordergrid$o<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$order_grid->ListOptions->render("body", "right", $order_grid->RowCnt);
?>
	</tr>
<?php if ($order->RowType == ROWTYPE_ADD || $order->RowType == ROWTYPE_EDIT) { ?>
<script>
fordergrid.updateLists(<?php echo $order_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$order->isGridAdd() || $order->CurrentMode == "copy")
		if (!$order_grid->Recordset->EOF)
			$order_grid->Recordset->moveNext();
}
?>
<?php
	if ($order->CurrentMode == "add" || $order->CurrentMode == "copy" || $order->CurrentMode == "edit") {
		$order_grid->RowIndex = '$rowindex$';
		$order_grid->loadRowValues();

		// Set row properties
		$order->resetAttributes();
		$order->RowAttrs = array_merge($order->RowAttrs, array('data-rowindex'=>$order_grid->RowIndex, 'id'=>'r0_order', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($order->RowAttrs["class"], "ew-template");
		$order->RowType = ROWTYPE_ADD;

		// Render row
		$order_grid->renderRow();

		// Render list options
		$order_grid->renderListOptions();
		$order_grid->StartRowCnt = 0;
?>
	<tr<?php echo $order->rowAttributes() ?>>
<?php

// Render list options (body, left)
$order_grid->ListOptions->render("body", "left", $order_grid->RowIndex);
?>
	<?php if ($order->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$order->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_order_id" class="form-group order_id">
<span<?php echo $order->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_id" name="x<?php echo $order_grid->RowIndex ?>_id" id="x<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_id" name="o<?php echo $order_grid->RowIndex ?>_id" id="o<?php echo $order_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($order->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->user_id->Visible) { // user_id ?>
		<td data-name="user_id">
<?php if (!$order->isConfirm()) { ?>
<?php if ($order->user_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_order_user_id" class="form-group order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $order_grid->RowIndex ?>_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_order_user_id" class="form-group order_user_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="order" data-field="x_user_id" data-value-separator="<?php echo $order->user_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $order_grid->RowIndex ?>_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id"<?php echo $order->user_id->editAttributes() ?>>
		<?php echo $order->user_id->selectOptionListHtml("x<?php echo $order_grid->RowIndex ?>_user_id") ?>
	</select>
<?php echo $order->user_id->Lookup->getParamTag("p_x<?php echo $order_grid->RowIndex ?>_user_id") ?>
</div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_order_user_id" class="form-group order_user_id">
<span<?php echo $order->user_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->user_id->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_user_id" name="x<?php echo $order_grid->RowIndex ?>_user_id" id="x<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_user_id" name="o<?php echo $order_grid->RowIndex ?>_user_id" id="o<?php echo $order_grid->RowIndex ?>_user_id" value="<?php echo HtmlEncode($order->user_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->from_place->Visible) { // from_place ?>
		<td data-name="from_place">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_from_place" class="form-group order_from_place">
<input type="text" data-table="order" data-field="x_from_place" name="x<?php echo $order_grid->RowIndex ?>_from_place" id="x<?php echo $order_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->from_place->getPlaceHolder()) ?>" value="<?php echo $order->from_place->EditValue ?>"<?php echo $order->from_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_from_place" class="form-group order_from_place">
<span<?php echo $order->from_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->from_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_from_place" name="x<?php echo $order_grid->RowIndex ?>_from_place" id="x<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_from_place" name="o<?php echo $order_grid->RowIndex ?>_from_place" id="o<?php echo $order_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($order->from_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->to_place->Visible) { // to_place ?>
		<td data-name="to_place">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_to_place" class="form-group order_to_place">
<input type="text" data-table="order" data-field="x_to_place" name="x<?php echo $order_grid->RowIndex ?>_to_place" id="x<?php echo $order_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->to_place->getPlaceHolder()) ?>" value="<?php echo $order->to_place->EditValue ?>"<?php echo $order->to_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_to_place" class="form-group order_to_place">
<span<?php echo $order->to_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->to_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_to_place" name="x<?php echo $order_grid->RowIndex ?>_to_place" id="x<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_to_place" name="o<?php echo $order_grid->RowIndex ?>_to_place" id="o<?php echo $order_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($order->to_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->date->Visible) { // date ?>
		<td data-name="date">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_date" class="form-group order_date">
<input type="text" data-table="order" data-field="x_date" name="x<?php echo $order_grid->RowIndex ?>_date" id="x<?php echo $order_grid->RowIndex ?>_date" placeholder="<?php echo HtmlEncode($order->date->getPlaceHolder()) ?>" value="<?php echo $order->date->EditValue ?>"<?php echo $order->date->editAttributes() ?>>
<?php if (!$order->date->ReadOnly && !$order->date->Disabled && !isset($order->date->EditAttrs["readonly"]) && !isset($order->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_date" class="form-group order_date">
<span<?php echo $order->date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_date" name="x<?php echo $order_grid->RowIndex ?>_date" id="x<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_date" name="o<?php echo $order_grid->RowIndex ?>_date" id="o<?php echo $order_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($order->date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->flight_number->Visible) { // flight_number ?>
		<td data-name="flight_number">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_flight_number" class="form-group order_flight_number">
<input type="text" data-table="order" data-field="x_flight_number" name="x<?php echo $order_grid->RowIndex ?>_flight_number" id="x<?php echo $order_grid->RowIndex ?>_flight_number" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($order->flight_number->getPlaceHolder()) ?>" value="<?php echo $order->flight_number->EditValue ?>"<?php echo $order->flight_number->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_flight_number" class="form-group order_flight_number">
<span<?php echo $order->flight_number->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->flight_number->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_flight_number" name="x<?php echo $order_grid->RowIndex ?>_flight_number" id="x<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_flight_number" name="o<?php echo $order_grid->RowIndex ?>_flight_number" id="o<?php echo $order_grid->RowIndex ?>_flight_number" value="<?php echo HtmlEncode($order->flight_number->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->description->Visible) { // description ?>
		<td data-name="description">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_description" class="form-group order_description">
<input type="text" data-table="order" data-field="x_description" name="x<?php echo $order_grid->RowIndex ?>_description" id="x<?php echo $order_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($order->description->getPlaceHolder()) ?>" value="<?php echo $order->description->EditValue ?>"<?php echo $order->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_description" class="form-group order_description">
<span<?php echo $order->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_description" name="x<?php echo $order_grid->RowIndex ?>_description" id="x<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_description" name="o<?php echo $order_grid->RowIndex ?>_description" id="o<?php echo $order_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($order->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_createdAt" class="form-group order_createdAt">
<input type="text" data-table="order" data-field="x_createdAt" name="x<?php echo $order_grid->RowIndex ?>_createdAt" id="x<?php echo $order_grid->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($order->createdAt->getPlaceHolder()) ?>" value="<?php echo $order->createdAt->EditValue ?>"<?php echo $order->createdAt->editAttributes() ?>>
<?php if (!$order->createdAt->ReadOnly && !$order->createdAt->Disabled && !isset($order->createdAt->EditAttrs["readonly"]) && !isset($order->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_createdAt" class="form-group order_createdAt">
<span<?php echo $order->createdAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->createdAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_createdAt" name="x<?php echo $order_grid->RowIndex ?>_createdAt" id="x<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_createdAt" name="o<?php echo $order_grid->RowIndex ?>_createdAt" id="o<?php echo $order_grid->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($order->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($order->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<?php if (!$order->isConfirm()) { ?>
<span id="el$rowindex$_order_updatedAt" class="form-group order_updatedAt">
<input type="text" data-table="order" data-field="x_updatedAt" name="x<?php echo $order_grid->RowIndex ?>_updatedAt" id="x<?php echo $order_grid->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($order->updatedAt->getPlaceHolder()) ?>" value="<?php echo $order->updatedAt->EditValue ?>"<?php echo $order->updatedAt->editAttributes() ?>>
<?php if (!$order->updatedAt->ReadOnly && !$order->updatedAt->Disabled && !isset($order->updatedAt->EditAttrs["readonly"]) && !isset($order->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fordergrid", "x<?php echo $order_grid->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_order_updatedAt" class="form-group order_updatedAt">
<span<?php echo $order->updatedAt->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($order->updatedAt->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="order" data-field="x_updatedAt" name="x<?php echo $order_grid->RowIndex ?>_updatedAt" id="x<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="order" data-field="x_updatedAt" name="o<?php echo $order_grid->RowIndex ?>_updatedAt" id="o<?php echo $order_grid->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($order->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$order_grid->ListOptions->render("body", "right", $order_grid->RowIndex);
?>
<script>
fordergrid.updateLists(<?php echo $order_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php if ($order->CurrentMode == "add" || $order->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $order_grid->FormKeyCountName ?>" id="<?php echo $order_grid->FormKeyCountName ?>" value="<?php echo $order_grid->KeyCount ?>">
<?php echo $order_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($order->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $order_grid->FormKeyCountName ?>" id="<?php echo $order_grid->FormKeyCountName ?>" value="<?php echo $order_grid->KeyCount ?>">
<?php echo $order_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($order->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fordergrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($order_grid->Recordset)
	$order_grid->Recordset->Close();
?>
</div>
<?php if ($order_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($order_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($order_grid->TotalRecs == 0 && !$order->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($order_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$order_grid->terminate();
?>
