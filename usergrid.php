<?php include_once "admininfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($user_grid)) $user_grid = new cuser_grid();

// Page init
$user_grid->Page_Init();

// Page main
$user_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_grid->Page_Render();
?>
<?php if ($user->Export == "") { ?>
<script type="text/javascript">

// Form object
var fusergrid = new ew_Form("fusergrid", "grid");
fusergrid.FormKeyCountName = '<?php echo $user_grid->FormKeyCountName ?>';

// Validate form
fusergrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_username");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->username->FldCaption(), $user->username->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_password");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->password->FldCaption(), $user->password->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->_email->FldCaption(), $user->_email->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_gender");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->gender->FldCaption(), $user->gender->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_gender");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($user->gender->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_phone");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->phone->FldCaption(), $user->phone->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_address");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->address->FldCaption(), $user->address->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_country");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->country->FldCaption(), $user->country->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_photo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->photo->FldCaption(), $user->photo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_nickname");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->nickname->FldCaption(), $user->nickname->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_region");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->region->FldCaption(), $user->region->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_locked");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->locked->FldCaption(), $user->locked->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_locked");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($user->locked->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_send_role");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->send_role->FldCaption(), $user->send_role->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_send_role");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($user->send_role->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_carrier_role");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $user->carrier_role->FldCaption(), $user->carrier_role->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_carrier_role");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($user->carrier_role->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fusergrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "username", false)) return false;
	if (ew_ValueChanged(fobj, infix, "password", false)) return false;
	if (ew_ValueChanged(fobj, infix, "_email", false)) return false;
	if (ew_ValueChanged(fobj, infix, "gender", false)) return false;
	if (ew_ValueChanged(fobj, infix, "phone", false)) return false;
	if (ew_ValueChanged(fobj, infix, "address", false)) return false;
	if (ew_ValueChanged(fobj, infix, "country", false)) return false;
	if (ew_ValueChanged(fobj, infix, "photo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nickname", false)) return false;
	if (ew_ValueChanged(fobj, infix, "region", false)) return false;
	if (ew_ValueChanged(fobj, infix, "locked", false)) return false;
	if (ew_ValueChanged(fobj, infix, "send_role", false)) return false;
	if (ew_ValueChanged(fobj, infix, "carrier_role", false)) return false;
	return true;
}

// Form_CustomValidate event
fusergrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fusergrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($user->CurrentAction == "gridadd") {
	if ($user->CurrentMode == "copy") {
		$bSelectLimit = $user_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$user_grid->TotalRecs = $user->ListRecordCount();
			$user_grid->Recordset = $user_grid->LoadRecordset($user_grid->StartRec-1, $user_grid->DisplayRecs);
		} else {
			if ($user_grid->Recordset = $user_grid->LoadRecordset())
				$user_grid->TotalRecs = $user_grid->Recordset->RecordCount();
		}
		$user_grid->StartRec = 1;
		$user_grid->DisplayRecs = $user_grid->TotalRecs;
	} else {
		$user->CurrentFilter = "0=1";
		$user_grid->StartRec = 1;
		$user_grid->DisplayRecs = $user->GridAddRowCount;
	}
	$user_grid->TotalRecs = $user_grid->DisplayRecs;
	$user_grid->StopRec = $user_grid->DisplayRecs;
} else {
	$bSelectLimit = $user_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($user_grid->TotalRecs <= 0)
			$user_grid->TotalRecs = $user->ListRecordCount();
	} else {
		if (!$user_grid->Recordset && ($user_grid->Recordset = $user_grid->LoadRecordset()))
			$user_grid->TotalRecs = $user_grid->Recordset->RecordCount();
	}
	$user_grid->StartRec = 1;
	$user_grid->DisplayRecs = $user_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$user_grid->Recordset = $user_grid->LoadRecordset($user_grid->StartRec-1, $user_grid->DisplayRecs);

	// Set no record found message
	if ($user->CurrentAction == "" && $user_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$user_grid->setWarningMessage(ew_DeniedMsg());
		if ($user_grid->SearchWhere == "0=101")
			$user_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$user_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$user_grid->RenderOtherOptions();
?>
<?php $user_grid->ShowPageHeader(); ?>
<?php
$user_grid->ShowMessage();
?>
<?php if ($user_grid->TotalRecs > 0 || $user->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($user_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> user">
<div id="fusergrid" class="ewForm ewListForm form-inline">
<div id="gmp_user" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_usergrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$user_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$user_grid->RenderListOptions();

// Render list options (header, left)
$user_grid->ListOptions->Render("header", "left");
?>
<?php if ($user->id->Visible) { // id ?>
	<?php if ($user->SortUrl($user->id) == "") { ?>
		<th data-name="id" class="<?php echo $user->id->HeaderCellClass() ?>"><div id="elh_user_id" class="user_id"><div class="ewTableHeaderCaption"><?php echo $user->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $user->id->HeaderCellClass() ?>"><div><div id="elh_user_id" class="user_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->username->Visible) { // username ?>
	<?php if ($user->SortUrl($user->username) == "") { ?>
		<th data-name="username" class="<?php echo $user->username->HeaderCellClass() ?>"><div id="elh_user_username" class="user_username"><div class="ewTableHeaderCaption"><?php echo $user->username->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $user->username->HeaderCellClass() ?>"><div><div id="elh_user_username" class="user_username">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->username->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->username->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->username->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->password->Visible) { // password ?>
	<?php if ($user->SortUrl($user->password) == "") { ?>
		<th data-name="password" class="<?php echo $user->password->HeaderCellClass() ?>"><div id="elh_user_password" class="user_password"><div class="ewTableHeaderCaption"><?php echo $user->password->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $user->password->HeaderCellClass() ?>"><div><div id="elh_user_password" class="user_password">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->password->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->password->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->password->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
	<?php if ($user->SortUrl($user->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $user->_email->HeaderCellClass() ?>"><div id="elh_user__email" class="user__email"><div class="ewTableHeaderCaption"><?php echo $user->_email->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $user->_email->HeaderCellClass() ?>"><div><div id="elh_user__email" class="user__email">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->_email->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->_email->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->_email->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
	<?php if ($user->SortUrl($user->gender) == "") { ?>
		<th data-name="gender" class="<?php echo $user->gender->HeaderCellClass() ?>"><div id="elh_user_gender" class="user_gender"><div class="ewTableHeaderCaption"><?php echo $user->gender->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gender" class="<?php echo $user->gender->HeaderCellClass() ?>"><div><div id="elh_user_gender" class="user_gender">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->gender->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->gender->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->gender->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
	<?php if ($user->SortUrl($user->phone) == "") { ?>
		<th data-name="phone" class="<?php echo $user->phone->HeaderCellClass() ?>"><div id="elh_user_phone" class="user_phone"><div class="ewTableHeaderCaption"><?php echo $user->phone->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="phone" class="<?php echo $user->phone->HeaderCellClass() ?>"><div><div id="elh_user_phone" class="user_phone">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->phone->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->phone->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->phone->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
	<?php if ($user->SortUrl($user->address) == "") { ?>
		<th data-name="address" class="<?php echo $user->address->HeaderCellClass() ?>"><div id="elh_user_address" class="user_address"><div class="ewTableHeaderCaption"><?php echo $user->address->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $user->address->HeaderCellClass() ?>"><div><div id="elh_user_address" class="user_address">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->address->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->address->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->address->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
	<?php if ($user->SortUrl($user->country) == "") { ?>
		<th data-name="country" class="<?php echo $user->country->HeaderCellClass() ?>"><div id="elh_user_country" class="user_country"><div class="ewTableHeaderCaption"><?php echo $user->country->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="country" class="<?php echo $user->country->HeaderCellClass() ?>"><div><div id="elh_user_country" class="user_country">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->country->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->country->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->country->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
	<?php if ($user->SortUrl($user->photo) == "") { ?>
		<th data-name="photo" class="<?php echo $user->photo->HeaderCellClass() ?>"><div id="elh_user_photo" class="user_photo"><div class="ewTableHeaderCaption"><?php echo $user->photo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="photo" class="<?php echo $user->photo->HeaderCellClass() ?>"><div><div id="elh_user_photo" class="user_photo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->photo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->photo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->photo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
	<?php if ($user->SortUrl($user->nickname) == "") { ?>
		<th data-name="nickname" class="<?php echo $user->nickname->HeaderCellClass() ?>"><div id="elh_user_nickname" class="user_nickname"><div class="ewTableHeaderCaption"><?php echo $user->nickname->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nickname" class="<?php echo $user->nickname->HeaderCellClass() ?>"><div><div id="elh_user_nickname" class="user_nickname">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->nickname->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->nickname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->nickname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
	<?php if ($user->SortUrl($user->region) == "") { ?>
		<th data-name="region" class="<?php echo $user->region->HeaderCellClass() ?>"><div id="elh_user_region" class="user_region"><div class="ewTableHeaderCaption"><?php echo $user->region->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region" class="<?php echo $user->region->HeaderCellClass() ?>"><div><div id="elh_user_region" class="user_region">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->region->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->region->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->region->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
	<?php if ($user->SortUrl($user->locked) == "") { ?>
		<th data-name="locked" class="<?php echo $user->locked->HeaderCellClass() ?>"><div id="elh_user_locked" class="user_locked"><div class="ewTableHeaderCaption"><?php echo $user->locked->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="locked" class="<?php echo $user->locked->HeaderCellClass() ?>"><div><div id="elh_user_locked" class="user_locked">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->locked->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->locked->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->locked->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
	<?php if ($user->SortUrl($user->send_role) == "") { ?>
		<th data-name="send_role" class="<?php echo $user->send_role->HeaderCellClass() ?>"><div id="elh_user_send_role" class="user_send_role"><div class="ewTableHeaderCaption"><?php echo $user->send_role->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="send_role" class="<?php echo $user->send_role->HeaderCellClass() ?>"><div><div id="elh_user_send_role" class="user_send_role">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->send_role->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->send_role->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->send_role->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
	<?php if ($user->SortUrl($user->carrier_role) == "") { ?>
		<th data-name="carrier_role" class="<?php echo $user->carrier_role->HeaderCellClass() ?>"><div id="elh_user_carrier_role" class="user_carrier_role"><div class="ewTableHeaderCaption"><?php echo $user->carrier_role->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="carrier_role" class="<?php echo $user->carrier_role->HeaderCellClass() ?>"><div><div id="elh_user_carrier_role" class="user_carrier_role">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $user->carrier_role->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($user->carrier_role->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($user->carrier_role->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$user_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$user_grid->StartRec = 1;
$user_grid->StopRec = $user_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($user_grid->FormKeyCountName) && ($user->CurrentAction == "gridadd" || $user->CurrentAction == "gridedit" || $user->CurrentAction == "F")) {
		$user_grid->KeyCount = $objForm->GetValue($user_grid->FormKeyCountName);
		$user_grid->StopRec = $user_grid->StartRec + $user_grid->KeyCount - 1;
	}
}
$user_grid->RecCnt = $user_grid->StartRec - 1;
if ($user_grid->Recordset && !$user_grid->Recordset->EOF) {
	$user_grid->Recordset->MoveFirst();
	$bSelectLimit = $user_grid->UseSelectLimit;
	if (!$bSelectLimit && $user_grid->StartRec > 1)
		$user_grid->Recordset->Move($user_grid->StartRec - 1);
} elseif (!$user->AllowAddDeleteRow && $user_grid->StopRec == 0) {
	$user_grid->StopRec = $user->GridAddRowCount;
}

// Initialize aggregate
$user->RowType = EW_ROWTYPE_AGGREGATEINIT;
$user->ResetAttrs();
$user_grid->RenderRow();
if ($user->CurrentAction == "gridadd")
	$user_grid->RowIndex = 0;
if ($user->CurrentAction == "gridedit")
	$user_grid->RowIndex = 0;
while ($user_grid->RecCnt < $user_grid->StopRec) {
	$user_grid->RecCnt++;
	if (intval($user_grid->RecCnt) >= intval($user_grid->StartRec)) {
		$user_grid->RowCnt++;
		if ($user->CurrentAction == "gridadd" || $user->CurrentAction == "gridedit" || $user->CurrentAction == "F") {
			$user_grid->RowIndex++;
			$objForm->Index = $user_grid->RowIndex;
			if ($objForm->HasValue($user_grid->FormActionName))
				$user_grid->RowAction = strval($objForm->GetValue($user_grid->FormActionName));
			elseif ($user->CurrentAction == "gridadd")
				$user_grid->RowAction = "insert";
			else
				$user_grid->RowAction = "";
		}

		// Set up key count
		$user_grid->KeyCount = $user_grid->RowIndex;

		// Init row class and style
		$user->ResetAttrs();
		$user->CssClass = "";
		if ($user->CurrentAction == "gridadd") {
			if ($user->CurrentMode == "copy") {
				$user_grid->LoadRowValues($user_grid->Recordset); // Load row values
				$user_grid->SetRecordKey($user_grid->RowOldKey, $user_grid->Recordset); // Set old record key
			} else {
				$user_grid->LoadRowValues(); // Load default values
				$user_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$user_grid->LoadRowValues($user_grid->Recordset); // Load row values
		}
		$user->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($user->CurrentAction == "gridadd") // Grid add
			$user->RowType = EW_ROWTYPE_ADD; // Render add
		if ($user->CurrentAction == "gridadd" && $user->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$user_grid->RestoreCurrentRowFormValues($user_grid->RowIndex); // Restore form values
		if ($user->CurrentAction == "gridedit") { // Grid edit
			if ($user->EventCancelled) {
				$user_grid->RestoreCurrentRowFormValues($user_grid->RowIndex); // Restore form values
			}
			if ($user_grid->RowAction == "insert")
				$user->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$user->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($user->CurrentAction == "gridedit" && ($user->RowType == EW_ROWTYPE_EDIT || $user->RowType == EW_ROWTYPE_ADD) && $user->EventCancelled) // Update failed
			$user_grid->RestoreCurrentRowFormValues($user_grid->RowIndex); // Restore form values
		if ($user->RowType == EW_ROWTYPE_EDIT) // Edit row
			$user_grid->EditRowCnt++;
		if ($user->CurrentAction == "F") // Confirm row
			$user_grid->RestoreCurrentRowFormValues($user_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$user->RowAttrs = array_merge($user->RowAttrs, array('data-rowindex'=>$user_grid->RowCnt, 'id'=>'r' . $user_grid->RowCnt . '_user', 'data-rowtype'=>$user->RowType));

		// Render row
		$user_grid->RenderRow();

		// Render list options
		$user_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($user_grid->RowAction <> "delete" && $user_grid->RowAction <> "insertdelete" && !($user_grid->RowAction == "insert" && $user->CurrentAction == "F" && $user_grid->EmptyRow())) {
?>
	<tr<?php echo $user->RowAttributes() ?>>
<?php

// Render list options (body, left)
$user_grid->ListOptions->Render("body", "left", $user_grid->RowCnt);
?>
	<?php if ($user->id->Visible) { // id ?>
		<td data-name="id"<?php echo $user->id->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="user" data-field="x_id" name="o<?php echo $user_grid->RowIndex ?>_id" id="o<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_id" class="form-group user_id">
<span<?php echo $user->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_id" name="x<?php echo $user_grid->RowIndex ?>_id" id="x<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_id" class="user_id">
<span<?php echo $user->id->ViewAttributes() ?>>
<?php echo $user->id->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_id" name="x<?php echo $user_grid->RowIndex ?>_id" id="x<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_id" name="o<?php echo $user_grid->RowIndex ?>_id" id="o<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_id" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_id" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_id" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_id" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->username->Visible) { // username ?>
		<td data-name="username"<?php echo $user->username->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_username" class="form-group user_username">
<input type="text" data-table="user" data-field="x_username" name="x<?php echo $user_grid->RowIndex ?>_username" id="x<?php echo $user_grid->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="o<?php echo $user_grid->RowIndex ?>_username" id="o<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_username" class="form-group user_username">
<input type="text" data-table="user" data-field="x_username" name="x<?php echo $user_grid->RowIndex ?>_username" id="x<?php echo $user_grid->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_username" class="user_username">
<span<?php echo $user->username->ViewAttributes() ?>>
<?php echo $user->username->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_username" name="x<?php echo $user_grid->RowIndex ?>_username" id="x<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_username" name="o<?php echo $user_grid->RowIndex ?>_username" id="o<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_username" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_username" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_username" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_username" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->password->Visible) { // password ?>
		<td data-name="password"<?php echo $user->password->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_password" class="form-group user_password">
<input type="text" data-table="user" data-field="x_password" name="x<?php echo $user_grid->RowIndex ?>_password" id="x<?php echo $user_grid->RowIndex ?>_password" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->password->getPlaceHolder()) ?>" value="<?php echo $user->password->EditValue ?>"<?php echo $user->password->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_password" name="o<?php echo $user_grid->RowIndex ?>_password" id="o<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_password" class="form-group user_password">
<input type="text" data-table="user" data-field="x_password" name="x<?php echo $user_grid->RowIndex ?>_password" id="x<?php echo $user_grid->RowIndex ?>_password" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->password->getPlaceHolder()) ?>" value="<?php echo $user->password->EditValue ?>"<?php echo $user->password->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_password" class="user_password">
<span<?php echo $user->password->ViewAttributes() ?>>
<?php echo $user->password->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_password" name="x<?php echo $user_grid->RowIndex ?>_password" id="x<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_password" name="o<?php echo $user_grid->RowIndex ?>_password" id="o<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_password" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_password" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_password" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_password" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $user->_email->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user__email" class="form-group user__email">
<input type="text" data-table="user" data-field="x__email" name="x<?php echo $user_grid->RowIndex ?>__email" id="x<?php echo $user_grid->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->_email->getPlaceHolder()) ?>" value="<?php echo $user->_email->EditValue ?>"<?php echo $user->_email->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x__email" name="o<?php echo $user_grid->RowIndex ?>__email" id="o<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user__email" class="form-group user__email">
<input type="text" data-table="user" data-field="x__email" name="x<?php echo $user_grid->RowIndex ?>__email" id="x<?php echo $user_grid->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->_email->getPlaceHolder()) ?>" value="<?php echo $user->_email->EditValue ?>"<?php echo $user->_email->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user__email" class="user__email">
<span<?php echo $user->_email->ViewAttributes() ?>>
<?php echo $user->_email->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x__email" name="x<?php echo $user_grid->RowIndex ?>__email" id="x<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x__email" name="o<?php echo $user_grid->RowIndex ?>__email" id="o<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x__email" name="fusergrid$x<?php echo $user_grid->RowIndex ?>__email" id="fusergrid$x<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x__email" name="fusergrid$o<?php echo $user_grid->RowIndex ?>__email" id="fusergrid$o<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->gender->Visible) { // gender ?>
		<td data-name="gender"<?php echo $user->gender->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_gender" class="form-group user_gender">
<input type="text" data-table="user" data-field="x_gender" name="x<?php echo $user_grid->RowIndex ?>_gender" id="x<?php echo $user_grid->RowIndex ?>_gender" size="30" placeholder="<?php echo ew_HtmlEncode($user->gender->getPlaceHolder()) ?>" value="<?php echo $user->gender->EditValue ?>"<?php echo $user->gender->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="o<?php echo $user_grid->RowIndex ?>_gender" id="o<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_gender" class="form-group user_gender">
<input type="text" data-table="user" data-field="x_gender" name="x<?php echo $user_grid->RowIndex ?>_gender" id="x<?php echo $user_grid->RowIndex ?>_gender" size="30" placeholder="<?php echo ew_HtmlEncode($user->gender->getPlaceHolder()) ?>" value="<?php echo $user->gender->EditValue ?>"<?php echo $user->gender->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_gender" class="user_gender">
<span<?php echo $user->gender->ViewAttributes() ?>>
<?php echo $user->gender->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_gender" name="x<?php echo $user_grid->RowIndex ?>_gender" id="x<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_gender" name="o<?php echo $user_grid->RowIndex ?>_gender" id="o<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_gender" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_gender" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_gender" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_gender" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->phone->Visible) { // phone ?>
		<td data-name="phone"<?php echo $user->phone->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_phone" class="form-group user_phone">
<input type="text" data-table="user" data-field="x_phone" name="x<?php echo $user_grid->RowIndex ?>_phone" id="x<?php echo $user_grid->RowIndex ?>_phone" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->phone->getPlaceHolder()) ?>" value="<?php echo $user->phone->EditValue ?>"<?php echo $user->phone->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_phone" name="o<?php echo $user_grid->RowIndex ?>_phone" id="o<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_phone" class="form-group user_phone">
<input type="text" data-table="user" data-field="x_phone" name="x<?php echo $user_grid->RowIndex ?>_phone" id="x<?php echo $user_grid->RowIndex ?>_phone" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->phone->getPlaceHolder()) ?>" value="<?php echo $user->phone->EditValue ?>"<?php echo $user->phone->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_phone" class="user_phone">
<span<?php echo $user->phone->ViewAttributes() ?>>
<?php echo $user->phone->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_phone" name="x<?php echo $user_grid->RowIndex ?>_phone" id="x<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_phone" name="o<?php echo $user_grid->RowIndex ?>_phone" id="o<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_phone" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_phone" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_phone" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_phone" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->address->Visible) { // address ?>
		<td data-name="address"<?php echo $user->address->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_address" class="form-group user_address">
<input type="text" data-table="user" data-field="x_address" name="x<?php echo $user_grid->RowIndex ?>_address" id="x<?php echo $user_grid->RowIndex ?>_address" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="o<?php echo $user_grid->RowIndex ?>_address" id="o<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_address" class="form-group user_address">
<input type="text" data-table="user" data-field="x_address" name="x<?php echo $user_grid->RowIndex ?>_address" id="x<?php echo $user_grid->RowIndex ?>_address" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_address" class="user_address">
<span<?php echo $user->address->ViewAttributes() ?>>
<?php echo $user->address->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_address" name="x<?php echo $user_grid->RowIndex ?>_address" id="x<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_address" name="o<?php echo $user_grid->RowIndex ?>_address" id="o<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_address" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_address" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_address" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_address" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->country->Visible) { // country ?>
		<td data-name="country"<?php echo $user->country->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_country" class="form-group user_country">
<input type="text" data-table="user" data-field="x_country" name="x<?php echo $user_grid->RowIndex ?>_country" id="x<?php echo $user_grid->RowIndex ?>_country" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="o<?php echo $user_grid->RowIndex ?>_country" id="o<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_country" class="form-group user_country">
<input type="text" data-table="user" data-field="x_country" name="x<?php echo $user_grid->RowIndex ?>_country" id="x<?php echo $user_grid->RowIndex ?>_country" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_country" class="user_country">
<span<?php echo $user->country->ViewAttributes() ?>>
<?php echo $user->country->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_country" name="x<?php echo $user_grid->RowIndex ?>_country" id="x<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_country" name="o<?php echo $user_grid->RowIndex ?>_country" id="o<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_country" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_country" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_country" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_country" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->photo->Visible) { // photo ?>
		<td data-name="photo"<?php echo $user->photo->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_photo" class="form-group user_photo">
<input type="text" data-table="user" data-field="x_photo" name="x<?php echo $user_grid->RowIndex ?>_photo" id="x<?php echo $user_grid->RowIndex ?>_photo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->photo->getPlaceHolder()) ?>" value="<?php echo $user->photo->EditValue ?>"<?php echo $user->photo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="o<?php echo $user_grid->RowIndex ?>_photo" id="o<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_photo" class="form-group user_photo">
<input type="text" data-table="user" data-field="x_photo" name="x<?php echo $user_grid->RowIndex ?>_photo" id="x<?php echo $user_grid->RowIndex ?>_photo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->photo->getPlaceHolder()) ?>" value="<?php echo $user->photo->EditValue ?>"<?php echo $user->photo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_photo" class="user_photo">
<span<?php echo $user->photo->ViewAttributes() ?>>
<?php echo $user->photo->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_photo" name="x<?php echo $user_grid->RowIndex ?>_photo" id="x<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_photo" name="o<?php echo $user_grid->RowIndex ?>_photo" id="o<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_photo" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_photo" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_photo" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_photo" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->nickname->Visible) { // nickname ?>
		<td data-name="nickname"<?php echo $user->nickname->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_nickname" class="form-group user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x<?php echo $user_grid->RowIndex ?>_nickname" id="x<?php echo $user_grid->RowIndex ?>_nickname" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="o<?php echo $user_grid->RowIndex ?>_nickname" id="o<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_nickname" class="form-group user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x<?php echo $user_grid->RowIndex ?>_nickname" id="x<?php echo $user_grid->RowIndex ?>_nickname" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_nickname" class="user_nickname">
<span<?php echo $user->nickname->ViewAttributes() ?>>
<?php echo $user->nickname->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_nickname" name="x<?php echo $user_grid->RowIndex ?>_nickname" id="x<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_nickname" name="o<?php echo $user_grid->RowIndex ?>_nickname" id="o<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_nickname" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_nickname" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_nickname" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_nickname" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->region->Visible) { // region ?>
		<td data-name="region"<?php echo $user->region->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_region" class="form-group user_region">
<input type="text" data-table="user" data-field="x_region" name="x<?php echo $user_grid->RowIndex ?>_region" id="x<?php echo $user_grid->RowIndex ?>_region" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="o<?php echo $user_grid->RowIndex ?>_region" id="o<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_region" class="form-group user_region">
<input type="text" data-table="user" data-field="x_region" name="x<?php echo $user_grid->RowIndex ?>_region" id="x<?php echo $user_grid->RowIndex ?>_region" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_region" class="user_region">
<span<?php echo $user->region->ViewAttributes() ?>>
<?php echo $user->region->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_region" name="x<?php echo $user_grid->RowIndex ?>_region" id="x<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_region" name="o<?php echo $user_grid->RowIndex ?>_region" id="o<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_region" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_region" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_region" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_region" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->locked->Visible) { // locked ?>
		<td data-name="locked"<?php echo $user->locked->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_locked" class="form-group user_locked">
<input type="text" data-table="user" data-field="x_locked" name="x<?php echo $user_grid->RowIndex ?>_locked" id="x<?php echo $user_grid->RowIndex ?>_locked" size="30" placeholder="<?php echo ew_HtmlEncode($user->locked->getPlaceHolder()) ?>" value="<?php echo $user->locked->EditValue ?>"<?php echo $user->locked->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_locked" name="o<?php echo $user_grid->RowIndex ?>_locked" id="o<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_locked" class="form-group user_locked">
<input type="text" data-table="user" data-field="x_locked" name="x<?php echo $user_grid->RowIndex ?>_locked" id="x<?php echo $user_grid->RowIndex ?>_locked" size="30" placeholder="<?php echo ew_HtmlEncode($user->locked->getPlaceHolder()) ?>" value="<?php echo $user->locked->EditValue ?>"<?php echo $user->locked->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_locked" class="user_locked">
<span<?php echo $user->locked->ViewAttributes() ?>>
<?php echo $user->locked->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_locked" name="x<?php echo $user_grid->RowIndex ?>_locked" id="x<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_locked" name="o<?php echo $user_grid->RowIndex ?>_locked" id="o<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_locked" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_locked" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_locked" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_locked" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->send_role->Visible) { // send_role ?>
		<td data-name="send_role"<?php echo $user->send_role->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_send_role" class="form-group user_send_role">
<input type="text" data-table="user" data-field="x_send_role" name="x<?php echo $user_grid->RowIndex ?>_send_role" id="x<?php echo $user_grid->RowIndex ?>_send_role" size="30" placeholder="<?php echo ew_HtmlEncode($user->send_role->getPlaceHolder()) ?>" value="<?php echo $user->send_role->EditValue ?>"<?php echo $user->send_role->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_send_role" name="o<?php echo $user_grid->RowIndex ?>_send_role" id="o<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_send_role" class="form-group user_send_role">
<input type="text" data-table="user" data-field="x_send_role" name="x<?php echo $user_grid->RowIndex ?>_send_role" id="x<?php echo $user_grid->RowIndex ?>_send_role" size="30" placeholder="<?php echo ew_HtmlEncode($user->send_role->getPlaceHolder()) ?>" value="<?php echo $user->send_role->EditValue ?>"<?php echo $user->send_role->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_send_role" class="user_send_role">
<span<?php echo $user->send_role->ViewAttributes() ?>>
<?php echo $user->send_role->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_send_role" name="x<?php echo $user_grid->RowIndex ?>_send_role" id="x<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_send_role" name="o<?php echo $user_grid->RowIndex ?>_send_role" id="o<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_send_role" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_send_role" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_send_role" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_send_role" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<td data-name="carrier_role"<?php echo $user->carrier_role->CellAttributes() ?>>
<?php if ($user->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_carrier_role" class="form-group user_carrier_role">
<input type="text" data-table="user" data-field="x_carrier_role" name="x<?php echo $user_grid->RowIndex ?>_carrier_role" id="x<?php echo $user_grid->RowIndex ?>_carrier_role" size="30" placeholder="<?php echo ew_HtmlEncode($user->carrier_role->getPlaceHolder()) ?>" value="<?php echo $user->carrier_role->EditValue ?>"<?php echo $user->carrier_role->EditAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="o<?php echo $user_grid->RowIndex ?>_carrier_role" id="o<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_carrier_role" class="form-group user_carrier_role">
<input type="text" data-table="user" data-field="x_carrier_role" name="x<?php echo $user_grid->RowIndex ?>_carrier_role" id="x<?php echo $user_grid->RowIndex ?>_carrier_role" size="30" placeholder="<?php echo ew_HtmlEncode($user->carrier_role->getPlaceHolder()) ?>" value="<?php echo $user->carrier_role->EditValue ?>"<?php echo $user->carrier_role->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_grid->RowCnt ?>_user_carrier_role" class="user_carrier_role">
<span<?php echo $user->carrier_role->ViewAttributes() ?>>
<?php echo $user->carrier_role->ListViewValue() ?></span>
</span>
<?php if ($user->CurrentAction <> "F") { ?>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="x<?php echo $user_grid->RowIndex ?>_carrier_role" id="x<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_carrier_role" name="o<?php echo $user_grid->RowIndex ?>_carrier_role" id="o<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="fusergrid$x<?php echo $user_grid->RowIndex ?>_carrier_role" id="fusergrid$x<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->FormValue) ?>">
<input type="hidden" data-table="user" data-field="x_carrier_role" name="fusergrid$o<?php echo $user_grid->RowIndex ?>_carrier_role" id="fusergrid$o<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_grid->ListOptions->Render("body", "right", $user_grid->RowCnt);
?>
	</tr>
<?php if ($user->RowType == EW_ROWTYPE_ADD || $user->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fusergrid.UpdateOpts(<?php echo $user_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($user->CurrentAction <> "gridadd" || $user->CurrentMode == "copy")
		if (!$user_grid->Recordset->EOF) $user_grid->Recordset->MoveNext();
}
?>
<?php
	if ($user->CurrentMode == "add" || $user->CurrentMode == "copy" || $user->CurrentMode == "edit") {
		$user_grid->RowIndex = '$rowindex$';
		$user_grid->LoadRowValues();

		// Set row properties
		$user->ResetAttrs();
		$user->RowAttrs = array_merge($user->RowAttrs, array('data-rowindex'=>$user_grid->RowIndex, 'id'=>'r0_user', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($user->RowAttrs["class"], "ewTemplate");
		$user->RowType = EW_ROWTYPE_ADD;

		// Render row
		$user_grid->RenderRow();

		// Render list options
		$user_grid->RenderListOptions();
		$user_grid->StartRowCnt = 0;
?>
	<tr<?php echo $user->RowAttributes() ?>>
<?php

// Render list options (body, left)
$user_grid->ListOptions->Render("body", "left", $user_grid->RowIndex);
?>
	<?php if ($user->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($user->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_user_id" class="form-group user_id">
<span<?php echo $user->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_id" name="x<?php echo $user_grid->RowIndex ?>_id" id="x<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_id" name="o<?php echo $user_grid->RowIndex ?>_id" id="o<?php echo $user_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($user->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->username->Visible) { // username ?>
		<td data-name="username">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_username" class="form-group user_username">
<input type="text" data-table="user" data-field="x_username" name="x<?php echo $user_grid->RowIndex ?>_username" id="x<?php echo $user_grid->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_username" class="form-group user_username">
<span<?php echo $user->username->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->username->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="x<?php echo $user_grid->RowIndex ?>_username" id="x<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_username" name="o<?php echo $user_grid->RowIndex ?>_username" id="o<?php echo $user_grid->RowIndex ?>_username" value="<?php echo ew_HtmlEncode($user->username->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->password->Visible) { // password ?>
		<td data-name="password">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_password" class="form-group user_password">
<input type="text" data-table="user" data-field="x_password" name="x<?php echo $user_grid->RowIndex ?>_password" id="x<?php echo $user_grid->RowIndex ?>_password" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->password->getPlaceHolder()) ?>" value="<?php echo $user->password->EditValue ?>"<?php echo $user->password->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_password" class="form-group user_password">
<span<?php echo $user->password->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->password->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_password" name="x<?php echo $user_grid->RowIndex ?>_password" id="x<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_password" name="o<?php echo $user_grid->RowIndex ?>_password" id="o<?php echo $user_grid->RowIndex ?>_password" value="<?php echo ew_HtmlEncode($user->password->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->_email->Visible) { // email ?>
		<td data-name="_email">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user__email" class="form-group user__email">
<input type="text" data-table="user" data-field="x__email" name="x<?php echo $user_grid->RowIndex ?>__email" id="x<?php echo $user_grid->RowIndex ?>__email" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->_email->getPlaceHolder()) ?>" value="<?php echo $user->_email->EditValue ?>"<?php echo $user->_email->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user__email" class="form-group user__email">
<span<?php echo $user->_email->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->_email->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x__email" name="x<?php echo $user_grid->RowIndex ?>__email" id="x<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x__email" name="o<?php echo $user_grid->RowIndex ?>__email" id="o<?php echo $user_grid->RowIndex ?>__email" value="<?php echo ew_HtmlEncode($user->_email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->gender->Visible) { // gender ?>
		<td data-name="gender">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_gender" class="form-group user_gender">
<input type="text" data-table="user" data-field="x_gender" name="x<?php echo $user_grid->RowIndex ?>_gender" id="x<?php echo $user_grid->RowIndex ?>_gender" size="30" placeholder="<?php echo ew_HtmlEncode($user->gender->getPlaceHolder()) ?>" value="<?php echo $user->gender->EditValue ?>"<?php echo $user->gender->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_gender" class="form-group user_gender">
<span<?php echo $user->gender->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->gender->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="x<?php echo $user_grid->RowIndex ?>_gender" id="x<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_gender" name="o<?php echo $user_grid->RowIndex ?>_gender" id="o<?php echo $user_grid->RowIndex ?>_gender" value="<?php echo ew_HtmlEncode($user->gender->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->phone->Visible) { // phone ?>
		<td data-name="phone">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_phone" class="form-group user_phone">
<input type="text" data-table="user" data-field="x_phone" name="x<?php echo $user_grid->RowIndex ?>_phone" id="x<?php echo $user_grid->RowIndex ?>_phone" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->phone->getPlaceHolder()) ?>" value="<?php echo $user->phone->EditValue ?>"<?php echo $user->phone->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_phone" class="form-group user_phone">
<span<?php echo $user->phone->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->phone->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_phone" name="x<?php echo $user_grid->RowIndex ?>_phone" id="x<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_phone" name="o<?php echo $user_grid->RowIndex ?>_phone" id="o<?php echo $user_grid->RowIndex ?>_phone" value="<?php echo ew_HtmlEncode($user->phone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->address->Visible) { // address ?>
		<td data-name="address">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_address" class="form-group user_address">
<input type="text" data-table="user" data-field="x_address" name="x<?php echo $user_grid->RowIndex ?>_address" id="x<?php echo $user_grid->RowIndex ?>_address" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_address" class="form-group user_address">
<span<?php echo $user->address->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->address->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="x<?php echo $user_grid->RowIndex ?>_address" id="x<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_address" name="o<?php echo $user_grid->RowIndex ?>_address" id="o<?php echo $user_grid->RowIndex ?>_address" value="<?php echo ew_HtmlEncode($user->address->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->country->Visible) { // country ?>
		<td data-name="country">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_country" class="form-group user_country">
<input type="text" data-table="user" data-field="x_country" name="x<?php echo $user_grid->RowIndex ?>_country" id="x<?php echo $user_grid->RowIndex ?>_country" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_country" class="form-group user_country">
<span<?php echo $user->country->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->country->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="x<?php echo $user_grid->RowIndex ?>_country" id="x<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_country" name="o<?php echo $user_grid->RowIndex ?>_country" id="o<?php echo $user_grid->RowIndex ?>_country" value="<?php echo ew_HtmlEncode($user->country->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->photo->Visible) { // photo ?>
		<td data-name="photo">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_photo" class="form-group user_photo">
<input type="text" data-table="user" data-field="x_photo" name="x<?php echo $user_grid->RowIndex ?>_photo" id="x<?php echo $user_grid->RowIndex ?>_photo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->photo->getPlaceHolder()) ?>" value="<?php echo $user->photo->EditValue ?>"<?php echo $user->photo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_photo" class="form-group user_photo">
<span<?php echo $user->photo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->photo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="x<?php echo $user_grid->RowIndex ?>_photo" id="x<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_photo" name="o<?php echo $user_grid->RowIndex ?>_photo" id="o<?php echo $user_grid->RowIndex ?>_photo" value="<?php echo ew_HtmlEncode($user->photo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->nickname->Visible) { // nickname ?>
		<td data-name="nickname">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_nickname" class="form-group user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x<?php echo $user_grid->RowIndex ?>_nickname" id="x<?php echo $user_grid->RowIndex ?>_nickname" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_nickname" class="form-group user_nickname">
<span<?php echo $user->nickname->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->nickname->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="x<?php echo $user_grid->RowIndex ?>_nickname" id="x<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_nickname" name="o<?php echo $user_grid->RowIndex ?>_nickname" id="o<?php echo $user_grid->RowIndex ?>_nickname" value="<?php echo ew_HtmlEncode($user->nickname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->region->Visible) { // region ?>
		<td data-name="region">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_region" class="form-group user_region">
<input type="text" data-table="user" data-field="x_region" name="x<?php echo $user_grid->RowIndex ?>_region" id="x<?php echo $user_grid->RowIndex ?>_region" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_region" class="form-group user_region">
<span<?php echo $user->region->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->region->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="x<?php echo $user_grid->RowIndex ?>_region" id="x<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_region" name="o<?php echo $user_grid->RowIndex ?>_region" id="o<?php echo $user_grid->RowIndex ?>_region" value="<?php echo ew_HtmlEncode($user->region->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->locked->Visible) { // locked ?>
		<td data-name="locked">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_locked" class="form-group user_locked">
<input type="text" data-table="user" data-field="x_locked" name="x<?php echo $user_grid->RowIndex ?>_locked" id="x<?php echo $user_grid->RowIndex ?>_locked" size="30" placeholder="<?php echo ew_HtmlEncode($user->locked->getPlaceHolder()) ?>" value="<?php echo $user->locked->EditValue ?>"<?php echo $user->locked->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_locked" class="form-group user_locked">
<span<?php echo $user->locked->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->locked->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_locked" name="x<?php echo $user_grid->RowIndex ?>_locked" id="x<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_locked" name="o<?php echo $user_grid->RowIndex ?>_locked" id="o<?php echo $user_grid->RowIndex ?>_locked" value="<?php echo ew_HtmlEncode($user->locked->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->send_role->Visible) { // send_role ?>
		<td data-name="send_role">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_send_role" class="form-group user_send_role">
<input type="text" data-table="user" data-field="x_send_role" name="x<?php echo $user_grid->RowIndex ?>_send_role" id="x<?php echo $user_grid->RowIndex ?>_send_role" size="30" placeholder="<?php echo ew_HtmlEncode($user->send_role->getPlaceHolder()) ?>" value="<?php echo $user->send_role->EditValue ?>"<?php echo $user->send_role->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_send_role" class="form-group user_send_role">
<span<?php echo $user->send_role->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->send_role->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_send_role" name="x<?php echo $user_grid->RowIndex ?>_send_role" id="x<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_send_role" name="o<?php echo $user_grid->RowIndex ?>_send_role" id="o<?php echo $user_grid->RowIndex ?>_send_role" value="<?php echo ew_HtmlEncode($user->send_role->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<td data-name="carrier_role">
<?php if ($user->CurrentAction <> "F") { ?>
<span id="el$rowindex$_user_carrier_role" class="form-group user_carrier_role">
<input type="text" data-table="user" data-field="x_carrier_role" name="x<?php echo $user_grid->RowIndex ?>_carrier_role" id="x<?php echo $user_grid->RowIndex ?>_carrier_role" size="30" placeholder="<?php echo ew_HtmlEncode($user->carrier_role->getPlaceHolder()) ?>" value="<?php echo $user->carrier_role->EditValue ?>"<?php echo $user->carrier_role->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_user_carrier_role" class="form-group user_carrier_role">
<span<?php echo $user->carrier_role->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $user->carrier_role->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="x<?php echo $user_grid->RowIndex ?>_carrier_role" id="x<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="o<?php echo $user_grid->RowIndex ?>_carrier_role" id="o<?php echo $user_grid->RowIndex ?>_carrier_role" value="<?php echo ew_HtmlEncode($user->carrier_role->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_grid->ListOptions->Render("body", "right", $user_grid->RowIndex);
?>
<script type="text/javascript">
fusergrid.UpdateOpts(<?php echo $user_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($user->CurrentMode == "add" || $user->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $user_grid->FormKeyCountName ?>" id="<?php echo $user_grid->FormKeyCountName ?>" value="<?php echo $user_grid->KeyCount ?>">
<?php echo $user_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($user->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $user_grid->FormKeyCountName ?>" id="<?php echo $user_grid->FormKeyCountName ?>" value="<?php echo $user_grid->KeyCount ?>">
<?php echo $user_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($user->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fusergrid">
</div>
<?php

// Close recordset
if ($user_grid->Recordset)
	$user_grid->Recordset->Close();
?>
<?php if ($user_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($user_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($user_grid->TotalRecs == 0 && $user->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($user_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($user->Export == "") { ?>
<script type="text/javascript">
fusergrid.Init();
</script>
<?php } ?>
<?php
$user_grid->Page_Terminate();
?>
