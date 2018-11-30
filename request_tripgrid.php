<?php
namespace PHPMaker2019\ferryman;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($request_trip_grid))
	$request_trip_grid = new request_trip_grid();

// Run the page
$request_trip_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$request_trip_grid->Page_Render();
?>
<?php if (!$request_trip->isExport()) { ?>
<script>

// Form object
var frequest_tripgrid = new ew.Form("frequest_tripgrid", "grid");
frequest_tripgrid.formKeyCountName = '<?php echo $request_trip_grid->FormKeyCountName ?>';

// Validate form
frequest_tripgrid.validate = function() {
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
		<?php if ($request_trip_grid->from_place->Required) { ?>
			elm = this.getElements("x" + infix + "_from_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->from_place->caption(), $request_trip->from_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_grid->to_place->Required) { ?>
			elm = this.getElements("x" + infix + "_to_place");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->to_place->caption(), $request_trip->to_place->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_grid->date->Required) { ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->date->caption(), $request_trip->date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($request_trip->date->errorMessage()) ?>");
		<?php if ($request_trip_grid->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->description->caption(), $request_trip->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($request_trip_grid->category->Required) { ?>
			elm = this.getElements("x" + infix + "_category");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $request_trip->category->caption(), $request_trip->category->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
frequest_tripgrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "from_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "to_place", false)) return false;
	if (ew.valueChanged(fobj, infix, "date", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	if (ew.valueChanged(fobj, infix, "category", false)) return false;
	return true;
}

// Form_CustomValidate event
frequest_tripgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
frequest_tripgrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frequest_tripgrid.lists["x_category"] = <?php echo $request_trip_grid->category->Lookup->toClientList() ?>;
frequest_tripgrid.lists["x_category"].options = <?php echo JsonEncode($request_trip_grid->category->lookupOptions()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$request_trip_grid->renderOtherOptions();
?>
<?php $request_trip_grid->showPageHeader(); ?>
<?php
$request_trip_grid->showMessage();
?>
<?php if ($request_trip_grid->TotalRecs > 0 || $request_trip->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($request_trip_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> request_trip">
<?php if ($request_trip_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php
	foreach ($request_trip_grid->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="frequest_tripgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_request_trip" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_request_tripgrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$request_trip_grid->RowType = ROWTYPE_HEADER;

// Render list options
$request_trip_grid->renderListOptions();

// Render list options (header, left)
$request_trip_grid->ListOptions->render("header", "left");
?>
<?php if ($request_trip->from_place->Visible) { // from_place ?>
	<?php if ($request_trip->sortUrl($request_trip->from_place) == "") { ?>
		<th data-name="from_place" class="<?php echo $request_trip->from_place->headerCellClass() ?>"><div id="elh_request_trip_from_place" class="request_trip_from_place"><div class="ew-table-header-caption"><?php echo $request_trip->from_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="from_place" class="<?php echo $request_trip->from_place->headerCellClass() ?>"><div><div id="elh_request_trip_from_place" class="request_trip_from_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->from_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->from_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->from_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->to_place->Visible) { // to_place ?>
	<?php if ($request_trip->sortUrl($request_trip->to_place) == "") { ?>
		<th data-name="to_place" class="<?php echo $request_trip->to_place->headerCellClass() ?>"><div id="elh_request_trip_to_place" class="request_trip_to_place"><div class="ew-table-header-caption"><?php echo $request_trip->to_place->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="to_place" class="<?php echo $request_trip->to_place->headerCellClass() ?>"><div><div id="elh_request_trip_to_place" class="request_trip_to_place">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->to_place->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->to_place->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->to_place->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->date->Visible) { // date ?>
	<?php if ($request_trip->sortUrl($request_trip->date) == "") { ?>
		<th data-name="date" class="<?php echo $request_trip->date->headerCellClass() ?>"><div id="elh_request_trip_date" class="request_trip_date"><div class="ew-table-header-caption"><?php echo $request_trip->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $request_trip->date->headerCellClass() ?>"><div><div id="elh_request_trip_date" class="request_trip_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->date->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->date->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->description->Visible) { // description ?>
	<?php if ($request_trip->sortUrl($request_trip->description) == "") { ?>
		<th data-name="description" class="<?php echo $request_trip->description->headerCellClass() ?>"><div id="elh_request_trip_description" class="request_trip_description"><div class="ew-table-header-caption"><?php echo $request_trip->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $request_trip->description->headerCellClass() ?>"><div><div id="elh_request_trip_description" class="request_trip_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->description->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($request_trip->category->Visible) { // category ?>
	<?php if ($request_trip->sortUrl($request_trip->category) == "") { ?>
		<th data-name="category" class="<?php echo $request_trip->category->headerCellClass() ?>"><div id="elh_request_trip_category" class="request_trip_category"><div class="ew-table-header-caption"><?php echo $request_trip->category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="category" class="<?php echo $request_trip->category->headerCellClass() ?>"><div><div id="elh_request_trip_category" class="request_trip_category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $request_trip->category->caption() ?></span><span class="ew-table-header-sort"><?php if ($request_trip->category->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($request_trip->category->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$request_trip_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$request_trip_grid->StartRec = 1;
$request_trip_grid->StopRec = $request_trip_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $request_trip_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($request_trip_grid->FormKeyCountName) && ($request_trip->isGridAdd() || $request_trip->isGridEdit() || $request_trip->isConfirm())) {
		$request_trip_grid->KeyCount = $CurrentForm->getValue($request_trip_grid->FormKeyCountName);
		$request_trip_grid->StopRec = $request_trip_grid->StartRec + $request_trip_grid->KeyCount - 1;
	}
}
$request_trip_grid->RecCnt = $request_trip_grid->StartRec - 1;
if ($request_trip_grid->Recordset && !$request_trip_grid->Recordset->EOF) {
	$request_trip_grid->Recordset->moveFirst();
	$selectLimit = $request_trip_grid->UseSelectLimit;
	if (!$selectLimit && $request_trip_grid->StartRec > 1)
		$request_trip_grid->Recordset->move($request_trip_grid->StartRec - 1);
} elseif (!$request_trip->AllowAddDeleteRow && $request_trip_grid->StopRec == 0) {
	$request_trip_grid->StopRec = $request_trip->GridAddRowCount;
}

// Initialize aggregate
$request_trip->RowType = ROWTYPE_AGGREGATEINIT;
$request_trip->resetAttributes();
$request_trip_grid->renderRow();
if ($request_trip->isGridAdd())
	$request_trip_grid->RowIndex = 0;
if ($request_trip->isGridEdit())
	$request_trip_grid->RowIndex = 0;
while ($request_trip_grid->RecCnt < $request_trip_grid->StopRec) {
	$request_trip_grid->RecCnt++;
	if ($request_trip_grid->RecCnt >= $request_trip_grid->StartRec) {
		$request_trip_grid->RowCnt++;
		if ($request_trip->isGridAdd() || $request_trip->isGridEdit() || $request_trip->isConfirm()) {
			$request_trip_grid->RowIndex++;
			$CurrentForm->Index = $request_trip_grid->RowIndex;
			if ($CurrentForm->hasValue($request_trip_grid->FormActionName) && $request_trip_grid->EventCancelled)
				$request_trip_grid->RowAction = strval($CurrentForm->getValue($request_trip_grid->FormActionName));
			elseif ($request_trip->isGridAdd())
				$request_trip_grid->RowAction = "insert";
			else
				$request_trip_grid->RowAction = "";
		}

		// Set up key count
		$request_trip_grid->KeyCount = $request_trip_grid->RowIndex;

		// Init row class and style
		$request_trip->resetAttributes();
		$request_trip->CssClass = "";
		if ($request_trip->isGridAdd()) {
			if ($request_trip->CurrentMode == "copy") {
				$request_trip_grid->loadRowValues($request_trip_grid->Recordset); // Load row values
				$request_trip_grid->setRecordKey($request_trip_grid->RowOldKey, $request_trip_grid->Recordset); // Set old record key
			} else {
				$request_trip_grid->loadRowValues(); // Load default values
				$request_trip_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$request_trip_grid->loadRowValues($request_trip_grid->Recordset); // Load row values
		}
		$request_trip->RowType = ROWTYPE_VIEW; // Render view
		if ($request_trip->isGridAdd()) // Grid add
			$request_trip->RowType = ROWTYPE_ADD; // Render add
		if ($request_trip->isGridAdd() && $request_trip->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$request_trip_grid->restoreCurrentRowFormValues($request_trip_grid->RowIndex); // Restore form values
		if ($request_trip->isGridEdit()) { // Grid edit
			if ($request_trip->EventCancelled)
				$request_trip_grid->restoreCurrentRowFormValues($request_trip_grid->RowIndex); // Restore form values
			if ($request_trip_grid->RowAction == "insert")
				$request_trip->RowType = ROWTYPE_ADD; // Render add
			else
				$request_trip->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($request_trip->isGridEdit() && ($request_trip->RowType == ROWTYPE_EDIT || $request_trip->RowType == ROWTYPE_ADD) && $request_trip->EventCancelled) // Update failed
			$request_trip_grid->restoreCurrentRowFormValues($request_trip_grid->RowIndex); // Restore form values
		if ($request_trip->RowType == ROWTYPE_EDIT) // Edit row
			$request_trip_grid->EditRowCnt++;
		if ($request_trip->isConfirm()) // Confirm row
			$request_trip_grid->restoreCurrentRowFormValues($request_trip_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$request_trip->RowAttrs = array_merge($request_trip->RowAttrs, array('data-rowindex'=>$request_trip_grid->RowCnt, 'id'=>'r' . $request_trip_grid->RowCnt . '_request_trip', 'data-rowtype'=>$request_trip->RowType));

		// Render row
		$request_trip_grid->renderRow();

		// Render list options
		$request_trip_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($request_trip_grid->RowAction <> "delete" && $request_trip_grid->RowAction <> "insertdelete" && !($request_trip_grid->RowAction == "insert" && $request_trip->isConfirm() && $request_trip_grid->emptyRow())) {
?>
	<tr<?php echo $request_trip->rowAttributes() ?>>
<?php

// Render list options (body, left)
$request_trip_grid->ListOptions->render("body", "left", $request_trip_grid->RowCnt);
?>
	<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<td data-name="from_place"<?php echo $request_trip->from_place->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_grid->RowIndex ?>_from_place" id="x<?php echo $request_trip_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="o<?php echo $request_trip_grid->RowIndex ?>_from_place" id="o<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_grid->RowIndex ?>_from_place" id="x<?php echo $request_trip_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_from_place" class="request_trip_from_place">
<span<?php echo $request_trip->from_place->viewAttributes() ?>>
<?php echo $request_trip->from_place->getViewValue() ?></span>
</span>
<?php if (!$request_trip->isConfirm()) { ?>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_grid->RowIndex ?>_from_place" id="x<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="o<?php echo $request_trip_grid->RowIndex ?>_from_place" id="o<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_from_place" id="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_from_place" id="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="request_trip" data-field="x_id" name="x<?php echo $request_trip_grid->RowIndex ?>_id" id="x<?php echo $request_trip_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($request_trip->id->CurrentValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_id" name="o<?php echo $request_trip_grid->RowIndex ?>_id" id="o<?php echo $request_trip_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($request_trip->id->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT || $request_trip->CurrentMode == "edit") { ?>
<input type="hidden" data-table="request_trip" data-field="x_id" name="x<?php echo $request_trip_grid->RowIndex ?>_id" id="x<?php echo $request_trip_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($request_trip->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<td data-name="to_place"<?php echo $request_trip->to_place->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_grid->RowIndex ?>_to_place" id="x<?php echo $request_trip_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="o<?php echo $request_trip_grid->RowIndex ?>_to_place" id="o<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_grid->RowIndex ?>_to_place" id="x<?php echo $request_trip_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_to_place" class="request_trip_to_place">
<span<?php echo $request_trip->to_place->viewAttributes() ?>>
<?php echo $request_trip->to_place->getViewValue() ?></span>
</span>
<?php if (!$request_trip->isConfirm()) { ?>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_grid->RowIndex ?>_to_place" id="x<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="o<?php echo $request_trip_grid->RowIndex ?>_to_place" id="o<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_to_place" id="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_to_place" id="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->date->Visible) { // date ?>
		<td data-name="date"<?php echo $request_trip->date->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_date" class="form-group request_trip_date">
<input type="text" data-table="request_trip" data-field="x_date" name="x<?php echo $request_trip_grid->RowIndex ?>_date" id="x<?php echo $request_trip_grid->RowIndex ?>_date" placeholder="<?php echo HtmlEncode($request_trip->date->getPlaceHolder()) ?>" value="<?php echo $request_trip->date->EditValue ?>"<?php echo $request_trip->date->editAttributes() ?>>
<?php if (!$request_trip->date->ReadOnly && !$request_trip->date->Disabled && !isset($request_trip->date->EditAttrs["readonly"]) && !isset($request_trip->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripgrid", "x<?php echo $request_trip_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="request_trip" data-field="x_date" name="o<?php echo $request_trip_grid->RowIndex ?>_date" id="o<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_date" class="form-group request_trip_date">
<input type="text" data-table="request_trip" data-field="x_date" name="x<?php echo $request_trip_grid->RowIndex ?>_date" id="x<?php echo $request_trip_grid->RowIndex ?>_date" placeholder="<?php echo HtmlEncode($request_trip->date->getPlaceHolder()) ?>" value="<?php echo $request_trip->date->EditValue ?>"<?php echo $request_trip->date->editAttributes() ?>>
<?php if (!$request_trip->date->ReadOnly && !$request_trip->date->Disabled && !isset($request_trip->date->EditAttrs["readonly"]) && !isset($request_trip->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripgrid", "x<?php echo $request_trip_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_date" class="request_trip_date">
<span<?php echo $request_trip->date->viewAttributes() ?>>
<?php echo $request_trip->date->getViewValue() ?></span>
</span>
<?php if (!$request_trip->isConfirm()) { ?>
<input type="hidden" data-table="request_trip" data-field="x_date" name="x<?php echo $request_trip_grid->RowIndex ?>_date" id="x<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_date" name="o<?php echo $request_trip_grid->RowIndex ?>_date" id="o<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="request_trip" data-field="x_date" name="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_date" id="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_date" name="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_date" id="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->description->Visible) { // description ?>
		<td data-name="description"<?php echo $request_trip->description->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_grid->RowIndex ?>_description" id="x<?php echo $request_trip_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="request_trip" data-field="x_description" name="o<?php echo $request_trip_grid->RowIndex ?>_description" id="o<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_grid->RowIndex ?>_description" id="x<?php echo $request_trip_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_description" class="request_trip_description">
<span<?php echo $request_trip->description->viewAttributes() ?>>
<?php echo $request_trip->description->getViewValue() ?></span>
</span>
<?php if (!$request_trip->isConfirm()) { ?>
<input type="hidden" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_grid->RowIndex ?>_description" id="x<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_description" name="o<?php echo $request_trip_grid->RowIndex ?>_description" id="o<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="request_trip" data-field="x_description" name="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_description" id="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_description" name="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_description" id="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($request_trip->category->Visible) { // category ?>
		<td data-name="category"<?php echo $request_trip->category->cellAttributes() ?>>
<?php if ($request_trip->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($request_trip->category->getSessionValue() <> "") { ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->category->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $request_trip_grid->RowIndex ?>_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="request_trip" data-field="x_category" data-value-separator="<?php echo $request_trip->category->displayValueSeparatorAttribute() ?>" id="x<?php echo $request_trip_grid->RowIndex ?>_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category"<?php echo $request_trip->category->editAttributes() ?>>
		<?php echo $request_trip->category->selectOptionListHtml("x<?php echo $request_trip_grid->RowIndex ?>_category") ?>
	</select>
<?php echo $request_trip->category->Lookup->getParamTag("p_x<?php echo $request_trip_grid->RowIndex ?>_category") ?>
</div>
</span>
<?php } ?>
<input type="hidden" data-table="request_trip" data-field="x_category" name="o<?php echo $request_trip_grid->RowIndex ?>_category" id="o<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($request_trip->category->getSessionValue() <> "") { ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->category->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $request_trip_grid->RowIndex ?>_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_category" class="form-group request_trip_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="request_trip" data-field="x_category" data-value-separator="<?php echo $request_trip->category->displayValueSeparatorAttribute() ?>" id="x<?php echo $request_trip_grid->RowIndex ?>_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category"<?php echo $request_trip->category->editAttributes() ?>>
		<?php echo $request_trip->category->selectOptionListHtml("x<?php echo $request_trip_grid->RowIndex ?>_category") ?>
	</select>
<?php echo $request_trip->category->Lookup->getParamTag("p_x<?php echo $request_trip_grid->RowIndex ?>_category") ?>
</div>
</span>
<?php } ?>
<?php } ?>
<?php if ($request_trip->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $request_trip_grid->RowCnt ?>_request_trip_category" class="request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<?php echo $request_trip->category->getViewValue() ?></span>
</span>
<?php if (!$request_trip->isConfirm()) { ?>
<input type="hidden" data-table="request_trip" data-field="x_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category" id="x<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_category" name="o<?php echo $request_trip_grid->RowIndex ?>_category" id="o<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="request_trip" data-field="x_category" name="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_category" id="frequest_tripgrid$x<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->FormValue) ?>">
<input type="hidden" data-table="request_trip" data-field="x_category" name="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_category" id="frequest_tripgrid$o<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$request_trip_grid->ListOptions->render("body", "right", $request_trip_grid->RowCnt);
?>
	</tr>
<?php if ($request_trip->RowType == ROWTYPE_ADD || $request_trip->RowType == ROWTYPE_EDIT) { ?>
<script>
frequest_tripgrid.updateLists(<?php echo $request_trip_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$request_trip->isGridAdd() || $request_trip->CurrentMode == "copy")
		if (!$request_trip_grid->Recordset->EOF)
			$request_trip_grid->Recordset->moveNext();
}
?>
<?php
	if ($request_trip->CurrentMode == "add" || $request_trip->CurrentMode == "copy" || $request_trip->CurrentMode == "edit") {
		$request_trip_grid->RowIndex = '$rowindex$';
		$request_trip_grid->loadRowValues();

		// Set row properties
		$request_trip->resetAttributes();
		$request_trip->RowAttrs = array_merge($request_trip->RowAttrs, array('data-rowindex'=>$request_trip_grid->RowIndex, 'id'=>'r0_request_trip', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($request_trip->RowAttrs["class"], "ew-template");
		$request_trip->RowType = ROWTYPE_ADD;

		// Render row
		$request_trip_grid->renderRow();

		// Render list options
		$request_trip_grid->renderListOptions();
		$request_trip_grid->StartRowCnt = 0;
?>
	<tr<?php echo $request_trip->rowAttributes() ?>>
<?php

// Render list options (body, left)
$request_trip_grid->ListOptions->render("body", "left", $request_trip_grid->RowIndex);
?>
	<?php if ($request_trip->from_place->Visible) { // from_place ?>
		<td data-name="from_place">
<?php if (!$request_trip->isConfirm()) { ?>
<span id="el$rowindex$_request_trip_from_place" class="form-group request_trip_from_place">
<input type="text" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_grid->RowIndex ?>_from_place" id="x<?php echo $request_trip_grid->RowIndex ?>_from_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->from_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->from_place->EditValue ?>"<?php echo $request_trip->from_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_trip_from_place" class="form-group request_trip_from_place">
<span<?php echo $request_trip->from_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->from_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="x<?php echo $request_trip_grid->RowIndex ?>_from_place" id="x<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_trip" data-field="x_from_place" name="o<?php echo $request_trip_grid->RowIndex ?>_from_place" id="o<?php echo $request_trip_grid->RowIndex ?>_from_place" value="<?php echo HtmlEncode($request_trip->from_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->to_place->Visible) { // to_place ?>
		<td data-name="to_place">
<?php if (!$request_trip->isConfirm()) { ?>
<span id="el$rowindex$_request_trip_to_place" class="form-group request_trip_to_place">
<input type="text" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_grid->RowIndex ?>_to_place" id="x<?php echo $request_trip_grid->RowIndex ?>_to_place" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->to_place->getPlaceHolder()) ?>" value="<?php echo $request_trip->to_place->EditValue ?>"<?php echo $request_trip->to_place->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_trip_to_place" class="form-group request_trip_to_place">
<span<?php echo $request_trip->to_place->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->to_place->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="x<?php echo $request_trip_grid->RowIndex ?>_to_place" id="x<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_trip" data-field="x_to_place" name="o<?php echo $request_trip_grid->RowIndex ?>_to_place" id="o<?php echo $request_trip_grid->RowIndex ?>_to_place" value="<?php echo HtmlEncode($request_trip->to_place->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->date->Visible) { // date ?>
		<td data-name="date">
<?php if (!$request_trip->isConfirm()) { ?>
<span id="el$rowindex$_request_trip_date" class="form-group request_trip_date">
<input type="text" data-table="request_trip" data-field="x_date" name="x<?php echo $request_trip_grid->RowIndex ?>_date" id="x<?php echo $request_trip_grid->RowIndex ?>_date" placeholder="<?php echo HtmlEncode($request_trip->date->getPlaceHolder()) ?>" value="<?php echo $request_trip->date->EditValue ?>"<?php echo $request_trip->date->editAttributes() ?>>
<?php if (!$request_trip->date->ReadOnly && !$request_trip->date->Disabled && !isset($request_trip->date->EditAttrs["readonly"]) && !isset($request_trip->date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("frequest_tripgrid", "x<?php echo $request_trip_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_trip_date" class="form-group request_trip_date">
<span<?php echo $request_trip->date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->date->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="request_trip" data-field="x_date" name="x<?php echo $request_trip_grid->RowIndex ?>_date" id="x<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_trip" data-field="x_date" name="o<?php echo $request_trip_grid->RowIndex ?>_date" id="o<?php echo $request_trip_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($request_trip->date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->description->Visible) { // description ?>
		<td data-name="description">
<?php if (!$request_trip->isConfirm()) { ?>
<span id="el$rowindex$_request_trip_description" class="form-group request_trip_description">
<input type="text" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_grid->RowIndex ?>_description" id="x<?php echo $request_trip_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($request_trip->description->getPlaceHolder()) ?>" value="<?php echo $request_trip->description->EditValue ?>"<?php echo $request_trip->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_request_trip_description" class="form-group request_trip_description">
<span<?php echo $request_trip->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="request_trip" data-field="x_description" name="x<?php echo $request_trip_grid->RowIndex ?>_description" id="x<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_trip" data-field="x_description" name="o<?php echo $request_trip_grid->RowIndex ?>_description" id="o<?php echo $request_trip_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($request_trip->description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($request_trip->category->Visible) { // category ?>
		<td data-name="category">
<?php if (!$request_trip->isConfirm()) { ?>
<?php if ($request_trip->category->getSessionValue() <> "") { ?>
<span id="el$rowindex$_request_trip_category" class="form-group request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->category->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $request_trip_grid->RowIndex ?>_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_request_trip_category" class="form-group request_trip_category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="request_trip" data-field="x_category" data-value-separator="<?php echo $request_trip->category->displayValueSeparatorAttribute() ?>" id="x<?php echo $request_trip_grid->RowIndex ?>_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category"<?php echo $request_trip->category->editAttributes() ?>>
		<?php echo $request_trip->category->selectOptionListHtml("x<?php echo $request_trip_grid->RowIndex ?>_category") ?>
	</select>
<?php echo $request_trip->category->Lookup->getParamTag("p_x<?php echo $request_trip_grid->RowIndex ?>_category") ?>
</div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_request_trip_category" class="form-group request_trip_category">
<span<?php echo $request_trip->category->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($request_trip->category->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="request_trip" data-field="x_category" name="x<?php echo $request_trip_grid->RowIndex ?>_category" id="x<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="request_trip" data-field="x_category" name="o<?php echo $request_trip_grid->RowIndex ?>_category" id="o<?php echo $request_trip_grid->RowIndex ?>_category" value="<?php echo HtmlEncode($request_trip->category->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$request_trip_grid->ListOptions->render("body", "right", $request_trip_grid->RowIndex);
?>
<script>
frequest_tripgrid.updateLists(<?php echo $request_trip_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php if ($request_trip->CurrentMode == "add" || $request_trip->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $request_trip_grid->FormKeyCountName ?>" id="<?php echo $request_trip_grid->FormKeyCountName ?>" value="<?php echo $request_trip_grid->KeyCount ?>">
<?php echo $request_trip_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($request_trip->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $request_trip_grid->FormKeyCountName ?>" id="<?php echo $request_trip_grid->FormKeyCountName ?>" value="<?php echo $request_trip_grid->KeyCount ?>">
<?php echo $request_trip_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($request_trip->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frequest_tripgrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($request_trip_grid->Recordset)
	$request_trip_grid->Recordset->Close();
?>
</div>
<?php if ($request_trip_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($request_trip_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($request_trip_grid->TotalRecs == 0 && !$request_trip->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($request_trip_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$request_trip_grid->terminate();
?>
