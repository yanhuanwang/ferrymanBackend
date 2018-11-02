<?php
namespace PHPMaker2019\ferryman;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($image_grid))
	$image_grid = new image_grid();

// Run the page
$image_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$image_grid->Page_Render();
?>
<?php if (!$image->isExport()) { ?>
<script>

// Form object
var fimagegrid = new ew.Form("fimagegrid", "grid");
fimagegrid.formKeyCountName = '<?php echo $image_grid->FormKeyCountName ?>';

// Validate form
fimagegrid.validate = function() {
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
		<?php if ($image_grid->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->name->caption(), $image->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_grid->_userid->Required) { ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->_userid->caption(), $image->_userid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($image->_userid->errorMessage()) ?>");
		<?php if ($image_grid->path->Required) { ?>
			felm = this.getElements("x" + infix + "_path");
			elm = this.getElements("fn_x" + infix + "_path");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $image->path->caption(), $image->path->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($image_grid->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $image->description->caption(), $image->description->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fimagegrid.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "name", false)) return false;
	if (ew.valueChanged(fobj, infix, "_userid", false)) return false;
	if (ew.valueChanged(fobj, infix, "path", false)) return false;
	if (ew.valueChanged(fobj, infix, "description", false)) return false;
	return true;
}

// Form_CustomValidate event
fimagegrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fimagegrid.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fimagegrid.lists["x__userid"] = <?php echo $image_grid->_userid->Lookup->toClientList() ?>;
fimagegrid.lists["x__userid"].options = <?php echo JsonEncode($image_grid->_userid->lookupOptions()) ?>;
fimagegrid.autoSuggests["x__userid"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<?php } ?>
<?php
$image_grid->renderOtherOptions();
?>
<?php $image_grid->showPageHeader(); ?>
<?php
$image_grid->showMessage();
?>
<?php if ($image_grid->TotalRecs > 0 || $image->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($image_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> image">
<?php if ($image_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php
	foreach ($image_grid->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fimagegrid" class="ew-form ew-list-form form-inline">
<div id="gmp_image" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table id="tbl_imagegrid" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$image_grid->RowType = ROWTYPE_HEADER;

// Render list options
$image_grid->renderListOptions();

// Render list options (header, left)
$image_grid->ListOptions->render("header", "left");
?>
<?php if ($image->name->Visible) { // name ?>
	<?php if ($image->sortUrl($image->name) == "") { ?>
		<th data-name="name" class="<?php echo $image->name->headerCellClass() ?>"><div id="elh_image_name" class="image_name"><div class="ew-table-header-caption"><?php echo $image->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $image->name->headerCellClass() ?>"><div><div id="elh_image_name" class="image_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->name->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->_userid->Visible) { // userid ?>
	<?php if ($image->sortUrl($image->_userid) == "") { ?>
		<th data-name="_userid" class="<?php echo $image->_userid->headerCellClass() ?>"><div id="elh_image__userid" class="image__userid"><div class="ew-table-header-caption"><?php echo $image->_userid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userid" class="<?php echo $image->_userid->headerCellClass() ?>"><div><div id="elh_image__userid" class="image__userid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->_userid->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->_userid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->_userid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->path->Visible) { // path ?>
	<?php if ($image->sortUrl($image->path) == "") { ?>
		<th data-name="path" class="<?php echo $image->path->headerCellClass() ?>"><div id="elh_image_path" class="image_path"><div class="ew-table-header-caption"><?php echo $image->path->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="path" class="<?php echo $image->path->headerCellClass() ?>"><div><div id="elh_image_path" class="image_path">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->path->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->path->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->path->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
	<?php if ($image->sortUrl($image->description) == "") { ?>
		<th data-name="description" class="<?php echo $image->description->headerCellClass() ?>"><div id="elh_image_description" class="image_description"><div class="ew-table-header-caption"><?php echo $image->description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="description" class="<?php echo $image->description->headerCellClass() ?>"><div><div id="elh_image_description" class="image_description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $image->description->caption() ?></span><span class="ew-table-header-sort"><?php if ($image->description->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($image->description->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$image_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$image_grid->StartRec = 1;
$image_grid->StopRec = $image_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($CurrentForm && $image_grid->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($image_grid->FormKeyCountName) && ($image->isGridAdd() || $image->isGridEdit() || $image->isConfirm())) {
		$image_grid->KeyCount = $CurrentForm->getValue($image_grid->FormKeyCountName);
		$image_grid->StopRec = $image_grid->StartRec + $image_grid->KeyCount - 1;
	}
}
$image_grid->RecCnt = $image_grid->StartRec - 1;
if ($image_grid->Recordset && !$image_grid->Recordset->EOF) {
	$image_grid->Recordset->moveFirst();
	$selectLimit = $image_grid->UseSelectLimit;
	if (!$selectLimit && $image_grid->StartRec > 1)
		$image_grid->Recordset->move($image_grid->StartRec - 1);
} elseif (!$image->AllowAddDeleteRow && $image_grid->StopRec == 0) {
	$image_grid->StopRec = $image->GridAddRowCount;
}

// Initialize aggregate
$image->RowType = ROWTYPE_AGGREGATEINIT;
$image->resetAttributes();
$image_grid->renderRow();
if ($image->isGridAdd())
	$image_grid->RowIndex = 0;
if ($image->isGridEdit())
	$image_grid->RowIndex = 0;
while ($image_grid->RecCnt < $image_grid->StopRec) {
	$image_grid->RecCnt++;
	if ($image_grid->RecCnt >= $image_grid->StartRec) {
		$image_grid->RowCnt++;
		if ($image->isGridAdd() || $image->isGridEdit() || $image->isConfirm()) {
			$image_grid->RowIndex++;
			$CurrentForm->Index = $image_grid->RowIndex;
			if ($CurrentForm->hasValue($image_grid->FormActionName) && $image_grid->EventCancelled)
				$image_grid->RowAction = strval($CurrentForm->getValue($image_grid->FormActionName));
			elseif ($image->isGridAdd())
				$image_grid->RowAction = "insert";
			else
				$image_grid->RowAction = "";
		}

		// Set up key count
		$image_grid->KeyCount = $image_grid->RowIndex;

		// Init row class and style
		$image->resetAttributes();
		$image->CssClass = "";
		if ($image->isGridAdd()) {
			if ($image->CurrentMode == "copy") {
				$image_grid->loadRowValues($image_grid->Recordset); // Load row values
				$image_grid->setRecordKey($image_grid->RowOldKey, $image_grid->Recordset); // Set old record key
			} else {
				$image_grid->loadRowValues(); // Load default values
				$image_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$image_grid->loadRowValues($image_grid->Recordset); // Load row values
		}
		$image->RowType = ROWTYPE_VIEW; // Render view
		if ($image->isGridAdd()) // Grid add
			$image->RowType = ROWTYPE_ADD; // Render add
		if ($image->isGridAdd() && $image->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$image_grid->restoreCurrentRowFormValues($image_grid->RowIndex); // Restore form values
		if ($image->isGridEdit()) { // Grid edit
			if ($image->EventCancelled)
				$image_grid->restoreCurrentRowFormValues($image_grid->RowIndex); // Restore form values
			if ($image_grid->RowAction == "insert")
				$image->RowType = ROWTYPE_ADD; // Render add
			else
				$image->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($image->isGridEdit() && ($image->RowType == ROWTYPE_EDIT || $image->RowType == ROWTYPE_ADD) && $image->EventCancelled) // Update failed
			$image_grid->restoreCurrentRowFormValues($image_grid->RowIndex); // Restore form values
		if ($image->RowType == ROWTYPE_EDIT) // Edit row
			$image_grid->EditRowCnt++;
		if ($image->isConfirm()) // Confirm row
			$image_grid->restoreCurrentRowFormValues($image_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$image->RowAttrs = array_merge($image->RowAttrs, array('data-rowindex'=>$image_grid->RowCnt, 'id'=>'r' . $image_grid->RowCnt . '_image', 'data-rowtype'=>$image->RowType));

		// Render row
		$image_grid->renderRow();

		// Render list options
		$image_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($image_grid->RowAction <> "delete" && $image_grid->RowAction <> "insertdelete" && !($image_grid->RowAction == "insert" && $image->isConfirm() && $image_grid->emptyRow())) {
?>
	<tr<?php echo $image->rowAttributes() ?>>
<?php

// Render list options (body, left)
$image_grid->ListOptions->render("body", "left", $image_grid->RowCnt);
?>
	<?php if ($image->name->Visible) { // name ?>
		<td data-name="name"<?php echo $image->name->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_name" class="form-group image_name">
<input type="text" data-table="image" data-field="x_name" name="x<?php echo $image_grid->RowIndex ?>_name" id="x<?php echo $image_grid->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->name->getPlaceHolder()) ?>" value="<?php echo $image->name->EditValue ?>"<?php echo $image->name->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_name" name="o<?php echo $image_grid->RowIndex ?>_name" id="o<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_name" class="form-group image_name">
<input type="text" data-table="image" data-field="x_name" name="x<?php echo $image_grid->RowIndex ?>_name" id="x<?php echo $image_grid->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->name->getPlaceHolder()) ?>" value="<?php echo $image->name->EditValue ?>"<?php echo $image->name->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_name" class="image_name">
<span<?php echo $image->name->viewAttributes() ?>>
<?php echo $image->name->getViewValue() ?></span>
</span>
<?php if (!$image->isConfirm()) { ?>
<input type="hidden" data-table="image" data-field="x_name" name="x<?php echo $image_grid->RowIndex ?>_name" id="x<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->FormValue) ?>">
<input type="hidden" data-table="image" data-field="x_name" name="o<?php echo $image_grid->RowIndex ?>_name" id="o<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="image" data-field="x_name" name="fimagegrid$x<?php echo $image_grid->RowIndex ?>_name" id="fimagegrid$x<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->FormValue) ?>">
<input type="hidden" data-table="image" data-field="x_name" name="fimagegrid$o<?php echo $image_grid->RowIndex ?>_name" id="fimagegrid$o<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="image" data-field="x_id" name="x<?php echo $image_grid->RowIndex ?>_id" id="x<?php echo $image_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($image->id->CurrentValue) ?>">
<input type="hidden" data-table="image" data-field="x_id" name="o<?php echo $image_grid->RowIndex ?>_id" id="o<?php echo $image_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($image->id->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT || $image->CurrentMode == "edit") { ?>
<input type="hidden" data-table="image" data-field="x_id" name="x<?php echo $image_grid->RowIndex ?>_id" id="x<?php echo $image_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($image->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($image->_userid->Visible) { // userid ?>
		<td data-name="_userid"<?php echo $image->_userid->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($image->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image__userid" class="form-group image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $image_grid->RowIndex ?>__userid" name="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image__userid" class="form-group image__userid">
<?php
$wrkonchange = "" . trim(@$image->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$image->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $image_grid->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $image_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $image_grid->RowIndex ?>__userid" id="sv_x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo RemoveHtml($image->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>"<?php echo $image->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x__userid" data-value-separator="<?php echo $image->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $image_grid->RowIndex ?>__userid" id="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fimagegrid.createAutoSuggest({"id":"x<?php echo $image_grid->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="image" data-field="x__userid" name="o<?php echo $image_grid->RowIndex ?>__userid" id="o<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($image->_userid->getSessionValue() <> "") { ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image__userid" class="form-group image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $image_grid->RowIndex ?>__userid" name="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image__userid" class="form-group image__userid">
<?php
$wrkonchange = "" . trim(@$image->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$image->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $image_grid->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $image_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $image_grid->RowIndex ?>__userid" id="sv_x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo RemoveHtml($image->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>"<?php echo $image->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x__userid" data-value-separator="<?php echo $image->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $image_grid->RowIndex ?>__userid" id="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fimagegrid.createAutoSuggest({"id":"x<?php echo $image_grid->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image__userid" class="image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<?php echo $image->_userid->getViewValue() ?></span>
</span>
<?php if (!$image->isConfirm()) { ?>
<input type="hidden" data-table="image" data-field="x__userid" name="x<?php echo $image_grid->RowIndex ?>__userid" id="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->FormValue) ?>">
<input type="hidden" data-table="image" data-field="x__userid" name="o<?php echo $image_grid->RowIndex ?>__userid" id="o<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="image" data-field="x__userid" name="fimagegrid$x<?php echo $image_grid->RowIndex ?>__userid" id="fimagegrid$x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->FormValue) ?>">
<input type="hidden" data-table="image" data-field="x__userid" name="fimagegrid$o<?php echo $image_grid->RowIndex ?>__userid" id="fimagegrid$o<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->path->Visible) { // path ?>
		<td data-name="path"<?php echo $image->path->cellAttributes() ?>>
<?php if ($image_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_grid->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_grid->RowIndex ?>_path" id="x<?php echo $image_grid->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_grid->RowIndex ?>_path" id= "fn_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $image_grid->RowIndex ?>_path" id= "fa_x<?php echo $image_grid->RowIndex ?>_path" value="0">
<input type="hidden" name="fs_x<?php echo $image_grid->RowIndex ?>_path" id= "fs_x<?php echo $image_grid->RowIndex ?>_path" value="100">
<input type="hidden" name="fx_x<?php echo $image_grid->RowIndex ?>_path" id= "fx_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_grid->RowIndex ?>_path" id= "fm_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_grid->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="image" data-field="x_path" name="o<?php echo $image_grid->RowIndex ?>_path" id="o<?php echo $image_grid->RowIndex ?>_path" value="<?php echo HtmlEncode($image->path->OldValue) ?>">
<?php } elseif ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_path" class="image_path">
<span>
<?php echo GetFileViewTag($image->path, $image->path->getViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_grid->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_grid->RowIndex ?>_path" id="x<?php echo $image_grid->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_grid->RowIndex ?>_path" id= "fn_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<?php if (Post("fa_x<?php echo $image_grid->RowIndex ?>_path") == "0") { ?>
<input type="hidden" name="fa_x<?php echo $image_grid->RowIndex ?>_path" id= "fa_x<?php echo $image_grid->RowIndex ?>_path" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $image_grid->RowIndex ?>_path" id= "fa_x<?php echo $image_grid->RowIndex ?>_path" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $image_grid->RowIndex ?>_path" id= "fs_x<?php echo $image_grid->RowIndex ?>_path" value="100">
<input type="hidden" name="fx_x<?php echo $image_grid->RowIndex ?>_path" id= "fx_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_grid->RowIndex ?>_path" id= "fm_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_grid->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($image->description->Visible) { // description ?>
		<td data-name="description"<?php echo $image->description->cellAttributes() ?>>
<?php if ($image->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_grid->RowIndex ?>_description" id="x<?php echo $image_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x_description" name="o<?php echo $image_grid->RowIndex ?>_description" id="o<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
<?php } ?>
<?php if ($image->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_grid->RowIndex ?>_description" id="x<?php echo $image_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($image->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $image_grid->RowCnt ?>_image_description" class="image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<?php echo $image->description->getViewValue() ?></span>
</span>
<?php if (!$image->isConfirm()) { ?>
<input type="hidden" data-table="image" data-field="x_description" name="x<?php echo $image_grid->RowIndex ?>_description" id="x<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->FormValue) ?>">
<input type="hidden" data-table="image" data-field="x_description" name="o<?php echo $image_grid->RowIndex ?>_description" id="o<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="image" data-field="x_description" name="fimagegrid$x<?php echo $image_grid->RowIndex ?>_description" id="fimagegrid$x<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->FormValue) ?>">
<input type="hidden" data-table="image" data-field="x_description" name="fimagegrid$o<?php echo $image_grid->RowIndex ?>_description" id="fimagegrid$o<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$image_grid->ListOptions->render("body", "right", $image_grid->RowCnt);
?>
	</tr>
<?php if ($image->RowType == ROWTYPE_ADD || $image->RowType == ROWTYPE_EDIT) { ?>
<script>
fimagegrid.updateLists(<?php echo $image_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$image->isGridAdd() || $image->CurrentMode == "copy")
		if (!$image_grid->Recordset->EOF)
			$image_grid->Recordset->moveNext();
}
?>
<?php
	if ($image->CurrentMode == "add" || $image->CurrentMode == "copy" || $image->CurrentMode == "edit") {
		$image_grid->RowIndex = '$rowindex$';
		$image_grid->loadRowValues();

		// Set row properties
		$image->resetAttributes();
		$image->RowAttrs = array_merge($image->RowAttrs, array('data-rowindex'=>$image_grid->RowIndex, 'id'=>'r0_image', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($image->RowAttrs["class"], "ew-template");
		$image->RowType = ROWTYPE_ADD;

		// Render row
		$image_grid->renderRow();

		// Render list options
		$image_grid->renderListOptions();
		$image_grid->StartRowCnt = 0;
?>
	<tr<?php echo $image->rowAttributes() ?>>
<?php

// Render list options (body, left)
$image_grid->ListOptions->render("body", "left", $image_grid->RowIndex);
?>
	<?php if ($image->name->Visible) { // name ?>
		<td data-name="name">
<?php if (!$image->isConfirm()) { ?>
<span id="el$rowindex$_image_name" class="form-group image_name">
<input type="text" data-table="image" data-field="x_name" name="x<?php echo $image_grid->RowIndex ?>_name" id="x<?php echo $image_grid->RowIndex ?>_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->name->getPlaceHolder()) ?>" value="<?php echo $image->name->EditValue ?>"<?php echo $image->name->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_image_name" class="form-group image_name">
<span<?php echo $image->name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->name->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x_name" name="x<?php echo $image_grid->RowIndex ?>_name" id="x<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="image" data-field="x_name" name="o<?php echo $image_grid->RowIndex ?>_name" id="o<?php echo $image_grid->RowIndex ?>_name" value="<?php echo HtmlEncode($image->name->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->_userid->Visible) { // userid ?>
		<td data-name="_userid">
<?php if (!$image->isConfirm()) { ?>
<?php if ($image->_userid->getSessionValue() <> "") { ?>
<span id="el$rowindex$_image__userid" class="form-group image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $image_grid->RowIndex ?>__userid" name="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_image__userid" class="form-group image__userid">
<?php
$wrkonchange = "" . trim(@$image->_userid->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$image->_userid->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $image_grid->RowIndex ?>__userid" class="text-nowrap" style="z-index: <?php echo (9000 - $image_grid->RowCnt * 10) ?>">
	<input type="text" class="form-control" name="sv_x<?php echo $image_grid->RowIndex ?>__userid" id="sv_x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo RemoveHtml($image->_userid->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($image->_userid->getPlaceHolder()) ?>"<?php echo $image->_userid->editAttributes() ?>>
</span>
<input type="hidden" data-table="image" data-field="x__userid" data-value-separator="<?php echo $image->_userid->displayValueSeparatorAttribute() ?>" name="x<?php echo $image_grid->RowIndex ?>__userid" id="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fimagegrid.createAutoSuggest({"id":"x<?php echo $image_grid->RowIndex ?>__userid","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_image__userid" class="form-group image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->_userid->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x__userid" name="x<?php echo $image_grid->RowIndex ?>__userid" id="x<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="image" data-field="x__userid" name="o<?php echo $image_grid->RowIndex ?>__userid" id="o<?php echo $image_grid->RowIndex ?>__userid" value="<?php echo HtmlEncode($image->_userid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->path->Visible) { // path ?>
		<td data-name="path">
<span id="el$rowindex$_image_path" class="form-group image_path">
<div id="fd_x<?php echo $image_grid->RowIndex ?>_path">
<span title="<?php echo $image->path->title() ? $image->path->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($image->path->ReadOnly || $image->path->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="image" data-field="x_path" name="x<?php echo $image_grid->RowIndex ?>_path" id="x<?php echo $image_grid->RowIndex ?>_path"<?php echo $image->path->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $image_grid->RowIndex ?>_path" id= "fn_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $image_grid->RowIndex ?>_path" id= "fa_x<?php echo $image_grid->RowIndex ?>_path" value="0">
<input type="hidden" name="fs_x<?php echo $image_grid->RowIndex ?>_path" id= "fs_x<?php echo $image_grid->RowIndex ?>_path" value="100">
<input type="hidden" name="fx_x<?php echo $image_grid->RowIndex ?>_path" id= "fx_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $image_grid->RowIndex ?>_path" id= "fm_x<?php echo $image_grid->RowIndex ?>_path" value="<?php echo $image->path->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $image_grid->RowIndex ?>_path" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="image" data-field="x_path" name="o<?php echo $image_grid->RowIndex ?>_path" id="o<?php echo $image_grid->RowIndex ?>_path" value="<?php echo HtmlEncode($image->path->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($image->description->Visible) { // description ?>
		<td data-name="description">
<?php if (!$image->isConfirm()) { ?>
<span id="el$rowindex$_image_description" class="form-group image_description">
<input type="text" data-table="image" data-field="x_description" name="x<?php echo $image_grid->RowIndex ?>_description" id="x<?php echo $image_grid->RowIndex ?>_description" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($image->description->getPlaceHolder()) ?>" value="<?php echo $image->description->EditValue ?>"<?php echo $image->description->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_image_description" class="form-group image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($image->description->ViewValue) ?>"></span>
</span>
<input type="hidden" data-table="image" data-field="x_description" name="x<?php echo $image_grid->RowIndex ?>_description" id="x<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="image" data-field="x_description" name="o<?php echo $image_grid->RowIndex ?>_description" id="o<?php echo $image_grid->RowIndex ?>_description" value="<?php echo HtmlEncode($image->description->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$image_grid->ListOptions->render("body", "right", $image_grid->RowIndex);
?>
<script>
fimagegrid.updateLists(<?php echo $image_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php if ($image->CurrentMode == "add" || $image->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $image_grid->FormKeyCountName ?>" id="<?php echo $image_grid->FormKeyCountName ?>" value="<?php echo $image_grid->KeyCount ?>">
<?php echo $image_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($image->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $image_grid->FormKeyCountName ?>" id="<?php echo $image_grid->FormKeyCountName ?>" value="<?php echo $image_grid->KeyCount ?>">
<?php echo $image_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($image->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fimagegrid">
</div><!-- /.ew-grid-middle-panel -->
<?php

// Close recordset
if ($image_grid->Recordset)
	$image_grid->Recordset->Close();
?>
</div>
<?php if ($image_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php
	foreach ($image_grid->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($image_grid->TotalRecs == 0 && !$image->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($image_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$image_grid->terminate();
?>
