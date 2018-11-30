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
$user_list = new user_list();

// Run the page
$user_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$user->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fuserlist = currentForm = new ew.Form("fuserlist", "list");
fuserlist.formKeyCountName = '<?php echo $user_list->FormKeyCountName ?>';

// Validate form
fuserlist.validate = function() {
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
		<?php if ($user_list->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->username->caption(), $user->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->gender->Required) { ?>
			elm = this.getElements("x" + infix + "_gender");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->gender->caption(), $user->gender->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->address->Required) { ?>
			elm = this.getElements("x" + infix + "_address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->address->caption(), $user->address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->country->Required) { ?>
			elm = this.getElements("x" + infix + "_country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->country->caption(), $user->country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->photo->Required) { ?>
			felm = this.getElements("x" + infix + "_photo");
			elm = this.getElements("fn_x" + infix + "_photo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $user->photo->caption(), $user->photo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->nickname->Required) { ?>
			elm = this.getElements("x" + infix + "_nickname");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->nickname->caption(), $user->nickname->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->region->Required) { ?>
			elm = this.getElements("x" + infix + "_region");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->region->caption(), $user->region->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->locked->Required) { ?>
			elm = this.getElements("x" + infix + "_locked");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->locked->caption(), $user->locked->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->send_role->Required) { ?>
			elm = this.getElements("x" + infix + "_send_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->send_role->caption(), $user->send_role->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->carrier_role->Required) { ?>
			elm = this.getElements("x" + infix + "_carrier_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->carrier_role->caption(), $user->carrier_role->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->birthday->Required) { ?>
			elm = this.getElements("x" + infix + "_birthday");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->birthday->caption(), $user->birthday->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->mobile_phone->Required) { ?>
			elm = this.getElements("x" + infix + "_mobile_phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->mobile_phone->caption(), $user->mobile_phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->status->caption(), $user->status->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user->status->errorMessage()) ?>");
		<?php if ($user_list->session_token->Required) { ?>
			elm = this.getElements("x" + infix + "_session_token");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->session_token->caption(), $user->session_token->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($user_list->createdAt->Required) { ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->createdAt->caption(), $user->createdAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_createdAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user->createdAt->errorMessage()) ?>");
		<?php if ($user_list->updatedAt->Required) { ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user->updatedAt->caption(), $user->updatedAt->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_updatedAt");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($user->updatedAt->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew.alert(ew.language.phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
fuserlist.emptyRow = function(infix) {
	var fobj = this._form;
	if (ew.valueChanged(fobj, infix, "username", false)) return false;
	if (ew.valueChanged(fobj, infix, "gender", false)) return false;
	if (ew.valueChanged(fobj, infix, "address", false)) return false;
	if (ew.valueChanged(fobj, infix, "country", false)) return false;
	if (ew.valueChanged(fobj, infix, "photo", false)) return false;
	if (ew.valueChanged(fobj, infix, "nickname", false)) return false;
	if (ew.valueChanged(fobj, infix, "region", false)) return false;
	if (ew.valueChanged(fobj, infix, "locked", false)) return false;
	if (ew.valueChanged(fobj, infix, "send_role", false)) return false;
	if (ew.valueChanged(fobj, infix, "carrier_role", false)) return false;
	if (ew.valueChanged(fobj, infix, "birthday", false)) return false;
	if (ew.valueChanged(fobj, infix, "mobile_phone", false)) return false;
	if (ew.valueChanged(fobj, infix, "status", false)) return false;
	if (ew.valueChanged(fobj, infix, "session_token", false)) return false;
	if (ew.valueChanged(fobj, infix, "createdAt", false)) return false;
	if (ew.valueChanged(fobj, infix, "updatedAt", false)) return false;
	return true;
}

// Form_CustomValidate event
fuserlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserlist.lists["x_gender"] = <?php echo $user_list->gender->Lookup->toClientList() ?>;
fuserlist.lists["x_gender"].options = <?php echo JsonEncode($user_list->gender->options(FALSE, TRUE)) ?>;
fuserlist.lists["x_locked"] = <?php echo $user_list->locked->Lookup->toClientList() ?>;
fuserlist.lists["x_locked"].options = <?php echo JsonEncode($user_list->locked->options(FALSE, TRUE)) ?>;
fuserlist.lists["x_send_role"] = <?php echo $user_list->send_role->Lookup->toClientList() ?>;
fuserlist.lists["x_send_role"].options = <?php echo JsonEncode($user_list->send_role->options(FALSE, TRUE)) ?>;
fuserlist.lists["x_carrier_role"] = <?php echo $user_list->carrier_role->Lookup->toClientList() ?>;
fuserlist.lists["x_carrier_role"].options = <?php echo JsonEncode($user_list->carrier_role->options(FALSE, TRUE)) ?>;

// Form object for search
var fuserlistsrch = currentSearchForm = new ew.Form("fuserlistsrch");

// Filters
fuserlistsrch.filterList = <?php echo $user_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$user->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($user_list->TotalRecs > 0 && $user_list->ExportOptions->visible()) { ?>
<?php $user_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->ImportOptions->visible()) { ?>
<?php $user_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->SearchOptions->visible()) { ?>
<?php $user_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($user_list->FilterOptions->visible()) { ?>
<?php $user_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$user_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$user->isExport() && !$user->CurrentAction) { ?>
<form name="fuserlistsrch" id="fuserlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($user_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fuserlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="user">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($user_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->Phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($user_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $user_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($user_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $user_list->showPageHeader(); ?>
<?php
$user_list->showMessage();
?>
<?php if ($user_list->TotalRecs > 0 || $user->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($user_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user">
<?php if (!$user->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$user->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($user_list->Pager)) $user_list->Pager = new NumericPager($user_list->StartRec, $user_list->DisplayRecs, $user_list->TotalRecs, $user_list->RecRange, $user_list->AutoHidePager) ?>
<?php if ($user_list->Pager->RecordCount > 0 && $user_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($user_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $user_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($user_list->TotalRecs > 0 && (!$user_list->AutoHidePageSizeSelector || $user_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="user">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($user_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($user_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($user_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($user_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($user_list->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserlist" id="fuserlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($user_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $user_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user">
<div id="gmp_user" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($user_list->TotalRecs > 0 || $user->isAdd() || $user->isCopy() || $user->isGridEdit()) { ?>
<table id="tbl_userlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$user_list->RowType = ROWTYPE_HEADER;

// Render list options
$user_list->renderListOptions();

// Render list options (header, left)
$user_list->ListOptions->render("header", "left");
?>
<?php if ($user->username->Visible) { // username ?>
	<?php if ($user->sortUrl($user->username) == "") { ?>
		<th data-name="username" class="<?php echo $user->username->headerCellClass() ?>"><div id="elh_user_username" class="user_username"><div class="ew-table-header-caption"><?php echo $user->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $user->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->username) ?>',1);"><div id="elh_user_username" class="user_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->username->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
	<?php if ($user->sortUrl($user->gender) == "") { ?>
		<th data-name="gender" class="<?php echo $user->gender->headerCellClass() ?>"><div id="elh_user_gender" class="user_gender"><div class="ew-table-header-caption"><?php echo $user->gender->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gender" class="<?php echo $user->gender->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->gender) ?>',1);"><div id="elh_user_gender" class="user_gender">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->gender->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->gender->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->gender->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
	<?php if ($user->sortUrl($user->address) == "") { ?>
		<th data-name="address" class="<?php echo $user->address->headerCellClass() ?>"><div id="elh_user_address" class="user_address"><div class="ew-table-header-caption"><?php echo $user->address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $user->address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->address) ?>',1);"><div id="elh_user_address" class="user_address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->address->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
	<?php if ($user->sortUrl($user->country) == "") { ?>
		<th data-name="country" class="<?php echo $user->country->headerCellClass() ?>"><div id="elh_user_country" class="user_country"><div class="ew-table-header-caption"><?php echo $user->country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="country" class="<?php echo $user->country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->country) ?>',1);"><div id="elh_user_country" class="user_country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->country->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->country->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->country->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
	<?php if ($user->sortUrl($user->photo) == "") { ?>
		<th data-name="photo" class="<?php echo $user->photo->headerCellClass() ?>"><div id="elh_user_photo" class="user_photo"><div class="ew-table-header-caption"><?php echo $user->photo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="photo" class="<?php echo $user->photo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->photo) ?>',1);"><div id="elh_user_photo" class="user_photo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->photo->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->photo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->photo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
	<?php if ($user->sortUrl($user->nickname) == "") { ?>
		<th data-name="nickname" class="<?php echo $user->nickname->headerCellClass() ?>"><div id="elh_user_nickname" class="user_nickname"><div class="ew-table-header-caption"><?php echo $user->nickname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nickname" class="<?php echo $user->nickname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->nickname) ?>',1);"><div id="elh_user_nickname" class="user_nickname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->nickname->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->nickname->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->nickname->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
	<?php if ($user->sortUrl($user->region) == "") { ?>
		<th data-name="region" class="<?php echo $user->region->headerCellClass() ?>"><div id="elh_user_region" class="user_region"><div class="ew-table-header-caption"><?php echo $user->region->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="region" class="<?php echo $user->region->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->region) ?>',1);"><div id="elh_user_region" class="user_region">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->region->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->region->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->region->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
	<?php if ($user->sortUrl($user->locked) == "") { ?>
		<th data-name="locked" class="<?php echo $user->locked->headerCellClass() ?>"><div id="elh_user_locked" class="user_locked"><div class="ew-table-header-caption"><?php echo $user->locked->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="locked" class="<?php echo $user->locked->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->locked) ?>',1);"><div id="elh_user_locked" class="user_locked">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->locked->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->locked->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->locked->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
	<?php if ($user->sortUrl($user->send_role) == "") { ?>
		<th data-name="send_role" class="<?php echo $user->send_role->headerCellClass() ?>"><div id="elh_user_send_role" class="user_send_role"><div class="ew-table-header-caption"><?php echo $user->send_role->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="send_role" class="<?php echo $user->send_role->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->send_role) ?>',1);"><div id="elh_user_send_role" class="user_send_role">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->send_role->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->send_role->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->send_role->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
	<?php if ($user->sortUrl($user->carrier_role) == "") { ?>
		<th data-name="carrier_role" class="<?php echo $user->carrier_role->headerCellClass() ?>"><div id="elh_user_carrier_role" class="user_carrier_role"><div class="ew-table-header-caption"><?php echo $user->carrier_role->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="carrier_role" class="<?php echo $user->carrier_role->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->carrier_role) ?>',1);"><div id="elh_user_carrier_role" class="user_carrier_role">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->carrier_role->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->carrier_role->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->carrier_role->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
	<?php if ($user->sortUrl($user->birthday) == "") { ?>
		<th data-name="birthday" class="<?php echo $user->birthday->headerCellClass() ?>"><div id="elh_user_birthday" class="user_birthday"><div class="ew-table-header-caption"><?php echo $user->birthday->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="birthday" class="<?php echo $user->birthday->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->birthday) ?>',1);"><div id="elh_user_birthday" class="user_birthday">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->birthday->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->birthday->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->birthday->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->mobile_phone->Visible) { // mobile_phone ?>
	<?php if ($user->sortUrl($user->mobile_phone) == "") { ?>
		<th data-name="mobile_phone" class="<?php echo $user->mobile_phone->headerCellClass() ?>"><div id="elh_user_mobile_phone" class="user_mobile_phone"><div class="ew-table-header-caption"><?php echo $user->mobile_phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mobile_phone" class="<?php echo $user->mobile_phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->mobile_phone) ?>',1);"><div id="elh_user_mobile_phone" class="user_mobile_phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->mobile_phone->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->mobile_phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->mobile_phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->status->Visible) { // status ?>
	<?php if ($user->sortUrl($user->status) == "") { ?>
		<th data-name="status" class="<?php echo $user->status->headerCellClass() ?>"><div id="elh_user_status" class="user_status"><div class="ew-table-header-caption"><?php echo $user->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $user->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->status) ?>',1);"><div id="elh_user_status" class="user_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->session_token->Visible) { // session_token ?>
	<?php if ($user->sortUrl($user->session_token) == "") { ?>
		<th data-name="session_token" class="<?php echo $user->session_token->headerCellClass() ?>"><div id="elh_user_session_token" class="user_session_token"><div class="ew-table-header-caption"><?php echo $user->session_token->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="session_token" class="<?php echo $user->session_token->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->session_token) ?>',1);"><div id="elh_user_session_token" class="user_session_token">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->session_token->caption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user->session_token->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->session_token->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->createdAt->Visible) { // createdAt ?>
	<?php if ($user->sortUrl($user->createdAt) == "") { ?>
		<th data-name="createdAt" class="<?php echo $user->createdAt->headerCellClass() ?>"><div id="elh_user_createdAt" class="user_createdAt"><div class="ew-table-header-caption"><?php echo $user->createdAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createdAt" class="<?php echo $user->createdAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->createdAt) ?>',1);"><div id="elh_user_createdAt" class="user_createdAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->createdAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->createdAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->createdAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user->updatedAt->Visible) { // updatedAt ?>
	<?php if ($user->sortUrl($user->updatedAt) == "") { ?>
		<th data-name="updatedAt" class="<?php echo $user->updatedAt->headerCellClass() ?>"><div id="elh_user_updatedAt" class="user_updatedAt"><div class="ew-table-header-caption"><?php echo $user->updatedAt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updatedAt" class="<?php echo $user->updatedAt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $user->SortUrl($user->updatedAt) ?>',1);"><div id="elh_user_updatedAt" class="user_updatedAt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user->updatedAt->caption() ?></span><span class="ew-table-header-sort"><?php if ($user->updatedAt->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($user->updatedAt->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$user_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($user->isAdd() || $user->isCopy()) {
		$user_list->RowIndex = 0;
		$user_list->KeyCount = $user_list->RowIndex;
		if ($user->isCopy() && !$user_list->loadRow())
			$user->CurrentAction = "add";
		if ($user->isAdd())
			$user_list->loadRowValues();
		if ($user->EventCancelled) // Insert failed
			$user_list->restoreFormValues(); // Restore form values

		// Set row properties
		$user->resetAttributes();
		$user->RowAttrs = array_merge($user->RowAttrs, array('data-rowindex'=>0, 'id'=>'r0_user', 'data-rowtype'=>ROWTYPE_ADD));
		$user->RowType = ROWTYPE_ADD;

		// Render row
		$user_list->renderRow();

		// Render list options
		$user_list->renderListOptions();
		$user_list->StartRowCnt = 0;
?>
	<tr<?php echo $user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$user_list->ListOptions->render("body", "left", $user_list->RowCnt);
?>
	<?php if ($user->username->Visible) { // username ?>
		<td data-name="username">
<span id="el<?php echo $user_list->RowCnt ?>_user_username" class="form-group user_username">
<input type="text" data-table="user" data-field="x_username" name="x<?php echo $user_list->RowIndex ?>_username" id="x<?php echo $user_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="o<?php echo $user_list->RowIndex ?>_username" id="o<?php echo $user_list->RowIndex ?>_username" value="<?php echo HtmlEncode($user->username->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->gender->Visible) { // gender ?>
		<td data-name="gender">
<span id="el<?php echo $user_list->RowCnt ?>_user_gender" class="form-group user_gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_gender" data-value-separator="<?php echo $user->gender->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_gender" name="x<?php echo $user_list->RowIndex ?>_gender"<?php echo $user->gender->editAttributes() ?>>
		<?php echo $user->gender->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_gender") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="o<?php echo $user_list->RowIndex ?>_gender" id="o<?php echo $user_list->RowIndex ?>_gender" value="<?php echo HtmlEncode($user->gender->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->address->Visible) { // address ?>
		<td data-name="address">
<span id="el<?php echo $user_list->RowCnt ?>_user_address" class="form-group user_address">
<input type="text" data-table="user" data-field="x_address" name="x<?php echo $user_list->RowIndex ?>_address" id="x<?php echo $user_list->RowIndex ?>_address" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="o<?php echo $user_list->RowIndex ?>_address" id="o<?php echo $user_list->RowIndex ?>_address" value="<?php echo HtmlEncode($user->address->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->country->Visible) { // country ?>
		<td data-name="country">
<span id="el<?php echo $user_list->RowCnt ?>_user_country" class="form-group user_country">
<input type="text" data-table="user" data-field="x_country" name="x<?php echo $user_list->RowIndex ?>_country" id="x<?php echo $user_list->RowIndex ?>_country" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="o<?php echo $user_list->RowIndex ?>_country" id="o<?php echo $user_list->RowIndex ?>_country" value="<?php echo HtmlEncode($user->country->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->photo->Visible) { // photo ?>
		<td data-name="photo">
<span id="el<?php echo $user_list->RowCnt ?>_user_photo" class="form-group user_photo">
<div id="fd_x<?php echo $user_list->RowIndex ?>_photo">
<span title="<?php echo $user->photo->title() ? $user->photo->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($user->photo->ReadOnly || $user->photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="user" data-field="x_photo" name="x<?php echo $user_list->RowIndex ?>_photo" id="x<?php echo $user_list->RowIndex ?>_photo"<?php echo $user->photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $user_list->RowIndex ?>_photo" id= "fn_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $user_list->RowIndex ?>_photo" id= "fa_x<?php echo $user_list->RowIndex ?>_photo" value="0">
<input type="hidden" name="fs_x<?php echo $user_list->RowIndex ?>_photo" id= "fs_x<?php echo $user_list->RowIndex ?>_photo" value="100">
<input type="hidden" name="fx_x<?php echo $user_list->RowIndex ?>_photo" id= "fx_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $user_list->RowIndex ?>_photo" id= "fm_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $user_list->RowIndex ?>_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="o<?php echo $user_list->RowIndex ?>_photo" id="o<?php echo $user_list->RowIndex ?>_photo" value="<?php echo HtmlEncode($user->photo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->nickname->Visible) { // nickname ?>
		<td data-name="nickname">
<span id="el<?php echo $user_list->RowCnt ?>_user_nickname" class="form-group user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x<?php echo $user_list->RowIndex ?>_nickname" id="x<?php echo $user_list->RowIndex ?>_nickname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="o<?php echo $user_list->RowIndex ?>_nickname" id="o<?php echo $user_list->RowIndex ?>_nickname" value="<?php echo HtmlEncode($user->nickname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->region->Visible) { // region ?>
		<td data-name="region">
<span id="el<?php echo $user_list->RowCnt ?>_user_region" class="form-group user_region">
<input type="text" data-table="user" data-field="x_region" name="x<?php echo $user_list->RowIndex ?>_region" id="x<?php echo $user_list->RowIndex ?>_region" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="o<?php echo $user_list->RowIndex ?>_region" id="o<?php echo $user_list->RowIndex ?>_region" value="<?php echo HtmlEncode($user->region->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->locked->Visible) { // locked ?>
		<td data-name="locked">
<span id="el<?php echo $user_list->RowCnt ?>_user_locked" class="form-group user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_locked" name="x<?php echo $user_list->RowIndex ?>_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_locked") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_locked" name="o<?php echo $user_list->RowIndex ?>_locked" id="o<?php echo $user_list->RowIndex ?>_locked" value="<?php echo HtmlEncode($user->locked->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->send_role->Visible) { // send_role ?>
		<td data-name="send_role">
<span id="el<?php echo $user_list->RowCnt ?>_user_send_role" class="form-group user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_send_role" name="x<?php echo $user_list->RowIndex ?>_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_send_role") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_send_role" name="o<?php echo $user_list->RowIndex ?>_send_role" id="o<?php echo $user_list->RowIndex ?>_send_role" value="<?php echo HtmlEncode($user->send_role->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<td data-name="carrier_role">
<span id="el<?php echo $user_list->RowCnt ?>_user_carrier_role" class="form-group user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_carrier_role" name="x<?php echo $user_list->RowIndex ?>_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_carrier_role") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="o<?php echo $user_list->RowIndex ?>_carrier_role" id="o<?php echo $user_list->RowIndex ?>_carrier_role" value="<?php echo HtmlEncode($user->carrier_role->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->birthday->Visible) { // birthday ?>
		<td data-name="birthday">
<span id="el<?php echo $user_list->RowCnt ?>_user_birthday" class="form-group user_birthday">
<input type="text" data-table="user" data-field="x_birthday" name="x<?php echo $user_list->RowIndex ?>_birthday" id="x<?php echo $user_list->RowIndex ?>_birthday" placeholder="<?php echo HtmlEncode($user->birthday->getPlaceHolder()) ?>" value="<?php echo $user->birthday->EditValue ?>"<?php echo $user->birthday->editAttributes() ?>>
<?php if (!$user->birthday->ReadOnly && !$user->birthday->Disabled && !isset($user->birthday->EditAttrs["readonly"]) && !isset($user->birthday->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_birthday", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_birthday" name="o<?php echo $user_list->RowIndex ?>_birthday" id="o<?php echo $user_list->RowIndex ?>_birthday" value="<?php echo HtmlEncode($user->birthday->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->mobile_phone->Visible) { // mobile_phone ?>
		<td data-name="mobile_phone">
<span id="el<?php echo $user_list->RowCnt ?>_user_mobile_phone" class="form-group user_mobile_phone">
<input type="text" data-table="user" data-field="x_mobile_phone" name="x<?php echo $user_list->RowIndex ?>_mobile_phone" id="x<?php echo $user_list->RowIndex ?>_mobile_phone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->mobile_phone->getPlaceHolder()) ?>" value="<?php echo $user->mobile_phone->EditValue ?>"<?php echo $user->mobile_phone->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_mobile_phone" name="o<?php echo $user_list->RowIndex ?>_mobile_phone" id="o<?php echo $user_list->RowIndex ?>_mobile_phone" value="<?php echo HtmlEncode($user->mobile_phone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->status->Visible) { // status ?>
		<td data-name="status">
<span id="el<?php echo $user_list->RowCnt ?>_user_status" class="form-group user_status">
<input type="text" data-table="user" data-field="x_status" name="x<?php echo $user_list->RowIndex ?>_status" id="x<?php echo $user_list->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($user->status->getPlaceHolder()) ?>" value="<?php echo $user->status->EditValue ?>"<?php echo $user->status->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_status" name="o<?php echo $user_list->RowIndex ?>_status" id="o<?php echo $user_list->RowIndex ?>_status" value="<?php echo HtmlEncode($user->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->session_token->Visible) { // session_token ?>
		<td data-name="session_token">
<span id="el<?php echo $user_list->RowCnt ?>_user_session_token" class="form-group user_session_token">
<input type="text" data-table="user" data-field="x_session_token" name="x<?php echo $user_list->RowIndex ?>_session_token" id="x<?php echo $user_list->RowIndex ?>_session_token" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user->session_token->getPlaceHolder()) ?>" value="<?php echo $user->session_token->EditValue ?>"<?php echo $user->session_token->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_session_token" name="o<?php echo $user_list->RowIndex ?>_session_token" id="o<?php echo $user_list->RowIndex ?>_session_token" value="<?php echo HtmlEncode($user->session_token->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<span id="el<?php echo $user_list->RowCnt ?>_user_createdAt" class="form-group user_createdAt">
<input type="text" data-table="user" data-field="x_createdAt" name="x<?php echo $user_list->RowIndex ?>_createdAt" id="x<?php echo $user_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($user->createdAt->getPlaceHolder()) ?>" value="<?php echo $user->createdAt->EditValue ?>"<?php echo $user->createdAt->editAttributes() ?>>
<?php if (!$user->createdAt->ReadOnly && !$user->createdAt->Disabled && !isset($user->createdAt->EditAttrs["readonly"]) && !isset($user->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_createdAt" name="o<?php echo $user_list->RowIndex ?>_createdAt" id="o<?php echo $user_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($user->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<span id="el<?php echo $user_list->RowCnt ?>_user_updatedAt" class="form-group user_updatedAt">
<input type="text" data-table="user" data-field="x_updatedAt" name="x<?php echo $user_list->RowIndex ?>_updatedAt" id="x<?php echo $user_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($user->updatedAt->getPlaceHolder()) ?>" value="<?php echo $user->updatedAt->EditValue ?>"<?php echo $user->updatedAt->editAttributes() ?>>
<?php if (!$user->updatedAt->ReadOnly && !$user->updatedAt->Disabled && !isset($user->updatedAt->EditAttrs["readonly"]) && !isset($user->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_updatedAt" name="o<?php echo $user_list->RowIndex ?>_updatedAt" id="o<?php echo $user_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($user->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_list->ListOptions->render("body", "right", $user_list->RowCnt);
?>
<script>
fuserlist.updateLists(<?php echo $user_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
<?php
if ($user->ExportAll && $user->isExport()) {
	$user_list->StopRec = $user_list->TotalRecs;
} else {

	// Set the last record to display
	if ($user_list->TotalRecs > $user_list->StartRec + $user_list->DisplayRecs - 1)
		$user_list->StopRec = $user_list->StartRec + $user_list->DisplayRecs - 1;
	else
		$user_list->StopRec = $user_list->TotalRecs;
}

// Restore number of post back records
if ($CurrentForm && $user_list->EventCancelled) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($user_list->FormKeyCountName) && ($user->isGridAdd() || $user->isGridEdit() || $user->isConfirm())) {
		$user_list->KeyCount = $CurrentForm->getValue($user_list->FormKeyCountName);
		$user_list->StopRec = $user_list->StartRec + $user_list->KeyCount - 1;
	}
}
$user_list->RecCnt = $user_list->StartRec - 1;
if ($user_list->Recordset && !$user_list->Recordset->EOF) {
	$user_list->Recordset->moveFirst();
	$selectLimit = $user_list->UseSelectLimit;
	if (!$selectLimit && $user_list->StartRec > 1)
		$user_list->Recordset->move($user_list->StartRec - 1);
} elseif (!$user->AllowAddDeleteRow && $user_list->StopRec == 0) {
	$user_list->StopRec = $user->GridAddRowCount;
}

// Initialize aggregate
$user->RowType = ROWTYPE_AGGREGATEINIT;
$user->resetAttributes();
$user_list->renderRow();
$user_list->EditRowCnt = 0;
if ($user->isEdit())
	$user_list->RowIndex = 1;
if ($user->isGridAdd())
	$user_list->RowIndex = 0;
if ($user->isGridEdit())
	$user_list->RowIndex = 0;
while ($user_list->RecCnt < $user_list->StopRec) {
	$user_list->RecCnt++;
	if ($user_list->RecCnt >= $user_list->StartRec) {
		$user_list->RowCnt++;
		if ($user->isGridAdd() || $user->isGridEdit() || $user->isConfirm()) {
			$user_list->RowIndex++;
			$CurrentForm->Index = $user_list->RowIndex;
			if ($CurrentForm->hasValue($user_list->FormActionName) && $user_list->EventCancelled)
				$user_list->RowAction = strval($CurrentForm->getValue($user_list->FormActionName));
			elseif ($user->isGridAdd())
				$user_list->RowAction = "insert";
			else
				$user_list->RowAction = "";
		}

		// Set up key count
		$user_list->KeyCount = $user_list->RowIndex;

		// Init row class and style
		$user->resetAttributes();
		$user->CssClass = "";
		if ($user->isGridAdd()) {
			$user_list->loadRowValues(); // Load default values
		} else {
			$user_list->loadRowValues($user_list->Recordset); // Load row values
		}
		$user->RowType = ROWTYPE_VIEW; // Render view
		if ($user->isGridAdd()) // Grid add
			$user->RowType = ROWTYPE_ADD; // Render add
		if ($user->isGridAdd() && $user->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$user_list->restoreCurrentRowFormValues($user_list->RowIndex); // Restore form values
		if ($user->isEdit()) {
			if ($user_list->checkInlineEditKey() && $user_list->EditRowCnt == 0) { // Inline edit
				$user->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($user->isGridEdit()) { // Grid edit
			if ($user->EventCancelled)
				$user_list->restoreCurrentRowFormValues($user_list->RowIndex); // Restore form values
			if ($user_list->RowAction == "insert")
				$user->RowType = ROWTYPE_ADD; // Render add
			else
				$user->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($user->isEdit() && $user->RowType == ROWTYPE_EDIT && $user->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$user_list->restoreFormValues(); // Restore form values
		}
		if ($user->isGridEdit() && ($user->RowType == ROWTYPE_EDIT || $user->RowType == ROWTYPE_ADD) && $user->EventCancelled) // Update failed
			$user_list->restoreCurrentRowFormValues($user_list->RowIndex); // Restore form values
		if ($user->RowType == ROWTYPE_EDIT) // Edit row
			$user_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$user->RowAttrs = array_merge($user->RowAttrs, array('data-rowindex'=>$user_list->RowCnt, 'id'=>'r' . $user_list->RowCnt . '_user', 'data-rowtype'=>$user->RowType));

		// Render row
		$user_list->renderRow();

		// Render list options
		$user_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($user_list->RowAction <> "delete" && $user_list->RowAction <> "insertdelete" && !($user_list->RowAction == "insert" && $user->isConfirm() && $user_list->emptyRow())) {
?>
	<tr<?php echo $user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$user_list->ListOptions->render("body", "left", $user_list->RowCnt);
?>
	<?php if ($user->username->Visible) { // username ?>
		<td data-name="username"<?php echo $user->username->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_username" class="form-group user_username">
<input type="text" data-table="user" data-field="x_username" name="x<?php echo $user_list->RowIndex ?>_username" id="x<?php echo $user_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="o<?php echo $user_list->RowIndex ?>_username" id="o<?php echo $user_list->RowIndex ?>_username" value="<?php echo HtmlEncode($user->username->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_username" class="form-group user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->username->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="x<?php echo $user_list->RowIndex ?>_username" id="x<?php echo $user_list->RowIndex ?>_username" value="<?php echo HtmlEncode($user->username->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_username" class="user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<?php echo $user->username->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="user" data-field="x_id" name="x<?php echo $user_list->RowIndex ?>_id" id="x<?php echo $user_list->RowIndex ?>_id" value="<?php echo HtmlEncode($user->id->CurrentValue) ?>">
<input type="hidden" data-table="user" data-field="x_id" name="o<?php echo $user_list->RowIndex ?>_id" id="o<?php echo $user_list->RowIndex ?>_id" value="<?php echo HtmlEncode($user->id->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT || $user->CurrentMode == "edit") { ?>
<input type="hidden" data-table="user" data-field="x_id" name="x<?php echo $user_list->RowIndex ?>_id" id="x<?php echo $user_list->RowIndex ?>_id" value="<?php echo HtmlEncode($user->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($user->gender->Visible) { // gender ?>
		<td data-name="gender"<?php echo $user->gender->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_gender" class="form-group user_gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_gender" data-value-separator="<?php echo $user->gender->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_gender" name="x<?php echo $user_list->RowIndex ?>_gender"<?php echo $user->gender->editAttributes() ?>>
		<?php echo $user->gender->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_gender") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="o<?php echo $user_list->RowIndex ?>_gender" id="o<?php echo $user_list->RowIndex ?>_gender" value="<?php echo HtmlEncode($user->gender->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_gender" class="form-group user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->gender->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="x<?php echo $user_list->RowIndex ?>_gender" id="x<?php echo $user_list->RowIndex ?>_gender" value="<?php echo HtmlEncode($user->gender->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_gender" class="user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<?php echo $user->gender->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->address->Visible) { // address ?>
		<td data-name="address"<?php echo $user->address->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_address" class="form-group user_address">
<input type="text" data-table="user" data-field="x_address" name="x<?php echo $user_list->RowIndex ?>_address" id="x<?php echo $user_list->RowIndex ?>_address" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="o<?php echo $user_list->RowIndex ?>_address" id="o<?php echo $user_list->RowIndex ?>_address" value="<?php echo HtmlEncode($user->address->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_address" class="form-group user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->address->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="x<?php echo $user_list->RowIndex ?>_address" id="x<?php echo $user_list->RowIndex ?>_address" value="<?php echo HtmlEncode($user->address->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_address" class="user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<?php echo $user->address->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->country->Visible) { // country ?>
		<td data-name="country"<?php echo $user->country->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_country" class="form-group user_country">
<input type="text" data-table="user" data-field="x_country" name="x<?php echo $user_list->RowIndex ?>_country" id="x<?php echo $user_list->RowIndex ?>_country" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="o<?php echo $user_list->RowIndex ?>_country" id="o<?php echo $user_list->RowIndex ?>_country" value="<?php echo HtmlEncode($user->country->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_country" class="form-group user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->country->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="x<?php echo $user_list->RowIndex ?>_country" id="x<?php echo $user_list->RowIndex ?>_country" value="<?php echo HtmlEncode($user->country->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_country" class="user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<?php echo $user->country->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->photo->Visible) { // photo ?>
		<td data-name="photo"<?php echo $user->photo->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_photo" class="form-group user_photo">
<div id="fd_x<?php echo $user_list->RowIndex ?>_photo">
<span title="<?php echo $user->photo->title() ? $user->photo->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($user->photo->ReadOnly || $user->photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="user" data-field="x_photo" name="x<?php echo $user_list->RowIndex ?>_photo" id="x<?php echo $user_list->RowIndex ?>_photo"<?php echo $user->photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $user_list->RowIndex ?>_photo" id= "fn_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $user_list->RowIndex ?>_photo" id= "fa_x<?php echo $user_list->RowIndex ?>_photo" value="0">
<input type="hidden" name="fs_x<?php echo $user_list->RowIndex ?>_photo" id= "fs_x<?php echo $user_list->RowIndex ?>_photo" value="100">
<input type="hidden" name="fx_x<?php echo $user_list->RowIndex ?>_photo" id= "fx_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $user_list->RowIndex ?>_photo" id= "fm_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $user_list->RowIndex ?>_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="o<?php echo $user_list->RowIndex ?>_photo" id="o<?php echo $user_list->RowIndex ?>_photo" value="<?php echo HtmlEncode($user->photo->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_photo" class="form-group user_photo">
<span>
<?php echo GetFileViewTag($user->photo, $user->photo->EditValue) ?>
</span>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="x<?php echo $user_list->RowIndex ?>_photo" id="x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo HtmlEncode($user->photo->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_photo" class="user_photo">
<span>
<?php echo GetFileViewTag($user->photo, $user->photo->getViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->nickname->Visible) { // nickname ?>
		<td data-name="nickname"<?php echo $user->nickname->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_nickname" class="form-group user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x<?php echo $user_list->RowIndex ?>_nickname" id="x<?php echo $user_list->RowIndex ?>_nickname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="o<?php echo $user_list->RowIndex ?>_nickname" id="o<?php echo $user_list->RowIndex ?>_nickname" value="<?php echo HtmlEncode($user->nickname->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_nickname" class="form-group user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->nickname->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="x<?php echo $user_list->RowIndex ?>_nickname" id="x<?php echo $user_list->RowIndex ?>_nickname" value="<?php echo HtmlEncode($user->nickname->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_nickname" class="user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<?php echo $user->nickname->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->region->Visible) { // region ?>
		<td data-name="region"<?php echo $user->region->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_region" class="form-group user_region">
<input type="text" data-table="user" data-field="x_region" name="x<?php echo $user_list->RowIndex ?>_region" id="x<?php echo $user_list->RowIndex ?>_region" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="o<?php echo $user_list->RowIndex ?>_region" id="o<?php echo $user_list->RowIndex ?>_region" value="<?php echo HtmlEncode($user->region->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_region" class="form-group user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->region->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="x<?php echo $user_list->RowIndex ?>_region" id="x<?php echo $user_list->RowIndex ?>_region" value="<?php echo HtmlEncode($user->region->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_region" class="user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<?php echo $user->region->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->locked->Visible) { // locked ?>
		<td data-name="locked"<?php echo $user->locked->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_locked" class="form-group user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_locked" name="x<?php echo $user_list->RowIndex ?>_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_locked") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_locked" name="o<?php echo $user_list->RowIndex ?>_locked" id="o<?php echo $user_list->RowIndex ?>_locked" value="<?php echo HtmlEncode($user->locked->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_locked" class="form-group user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_locked" name="x<?php echo $user_list->RowIndex ?>_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_locked") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_locked" class="user_locked">
<span<?php echo $user->locked->viewAttributes() ?>>
<?php echo $user->locked->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->send_role->Visible) { // send_role ?>
		<td data-name="send_role"<?php echo $user->send_role->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_send_role" class="form-group user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_send_role" name="x<?php echo $user_list->RowIndex ?>_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_send_role") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_send_role" name="o<?php echo $user_list->RowIndex ?>_send_role" id="o<?php echo $user_list->RowIndex ?>_send_role" value="<?php echo HtmlEncode($user->send_role->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_send_role" class="form-group user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_send_role" name="x<?php echo $user_list->RowIndex ?>_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_send_role") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_send_role" class="user_send_role">
<span<?php echo $user->send_role->viewAttributes() ?>>
<?php echo $user->send_role->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<td data-name="carrier_role"<?php echo $user->carrier_role->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_carrier_role" class="form-group user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_carrier_role" name="x<?php echo $user_list->RowIndex ?>_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_carrier_role") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="o<?php echo $user_list->RowIndex ?>_carrier_role" id="o<?php echo $user_list->RowIndex ?>_carrier_role" value="<?php echo HtmlEncode($user->carrier_role->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_carrier_role" class="form-group user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_carrier_role" name="x<?php echo $user_list->RowIndex ?>_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_carrier_role") ?>
	</select>
</div>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_carrier_role" class="user_carrier_role">
<span<?php echo $user->carrier_role->viewAttributes() ?>>
<?php echo $user->carrier_role->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->birthday->Visible) { // birthday ?>
		<td data-name="birthday"<?php echo $user->birthday->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_birthday" class="form-group user_birthday">
<input type="text" data-table="user" data-field="x_birthday" name="x<?php echo $user_list->RowIndex ?>_birthday" id="x<?php echo $user_list->RowIndex ?>_birthday" placeholder="<?php echo HtmlEncode($user->birthday->getPlaceHolder()) ?>" value="<?php echo $user->birthday->EditValue ?>"<?php echo $user->birthday->editAttributes() ?>>
<?php if (!$user->birthday->ReadOnly && !$user->birthday->Disabled && !isset($user->birthday->EditAttrs["readonly"]) && !isset($user->birthday->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_birthday", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_birthday" name="o<?php echo $user_list->RowIndex ?>_birthday" id="o<?php echo $user_list->RowIndex ?>_birthday" value="<?php echo HtmlEncode($user->birthday->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_birthday" class="form-group user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($user->birthday->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="user" data-field="x_birthday" name="x<?php echo $user_list->RowIndex ?>_birthday" id="x<?php echo $user_list->RowIndex ?>_birthday" value="<?php echo HtmlEncode($user->birthday->CurrentValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_birthday" class="user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<?php echo $user->birthday->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->mobile_phone->Visible) { // mobile_phone ?>
		<td data-name="mobile_phone"<?php echo $user->mobile_phone->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_mobile_phone" class="form-group user_mobile_phone">
<input type="text" data-table="user" data-field="x_mobile_phone" name="x<?php echo $user_list->RowIndex ?>_mobile_phone" id="x<?php echo $user_list->RowIndex ?>_mobile_phone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->mobile_phone->getPlaceHolder()) ?>" value="<?php echo $user->mobile_phone->EditValue ?>"<?php echo $user->mobile_phone->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_mobile_phone" name="o<?php echo $user_list->RowIndex ?>_mobile_phone" id="o<?php echo $user_list->RowIndex ?>_mobile_phone" value="<?php echo HtmlEncode($user->mobile_phone->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_mobile_phone" class="form-group user_mobile_phone">
<input type="text" data-table="user" data-field="x_mobile_phone" name="x<?php echo $user_list->RowIndex ?>_mobile_phone" id="x<?php echo $user_list->RowIndex ?>_mobile_phone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->mobile_phone->getPlaceHolder()) ?>" value="<?php echo $user->mobile_phone->EditValue ?>"<?php echo $user->mobile_phone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_mobile_phone" class="user_mobile_phone">
<span<?php echo $user->mobile_phone->viewAttributes() ?>>
<?php echo $user->mobile_phone->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->status->Visible) { // status ?>
		<td data-name="status"<?php echo $user->status->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_status" class="form-group user_status">
<input type="text" data-table="user" data-field="x_status" name="x<?php echo $user_list->RowIndex ?>_status" id="x<?php echo $user_list->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($user->status->getPlaceHolder()) ?>" value="<?php echo $user->status->EditValue ?>"<?php echo $user->status->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_status" name="o<?php echo $user_list->RowIndex ?>_status" id="o<?php echo $user_list->RowIndex ?>_status" value="<?php echo HtmlEncode($user->status->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_status" class="form-group user_status">
<input type="text" data-table="user" data-field="x_status" name="x<?php echo $user_list->RowIndex ?>_status" id="x<?php echo $user_list->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($user->status->getPlaceHolder()) ?>" value="<?php echo $user->status->EditValue ?>"<?php echo $user->status->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_status" class="user_status">
<span<?php echo $user->status->viewAttributes() ?>>
<?php echo $user->status->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->session_token->Visible) { // session_token ?>
		<td data-name="session_token"<?php echo $user->session_token->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_session_token" class="form-group user_session_token">
<input type="text" data-table="user" data-field="x_session_token" name="x<?php echo $user_list->RowIndex ?>_session_token" id="x<?php echo $user_list->RowIndex ?>_session_token" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user->session_token->getPlaceHolder()) ?>" value="<?php echo $user->session_token->EditValue ?>"<?php echo $user->session_token->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_session_token" name="o<?php echo $user_list->RowIndex ?>_session_token" id="o<?php echo $user_list->RowIndex ?>_session_token" value="<?php echo HtmlEncode($user->session_token->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_session_token" class="form-group user_session_token">
<input type="text" data-table="user" data-field="x_session_token" name="x<?php echo $user_list->RowIndex ?>_session_token" id="x<?php echo $user_list->RowIndex ?>_session_token" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user->session_token->getPlaceHolder()) ?>" value="<?php echo $user->session_token->EditValue ?>"<?php echo $user->session_token->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_session_token" class="user_session_token">
<span<?php echo $user->session_token->viewAttributes() ?>>
<?php echo $user->session_token->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt"<?php echo $user->createdAt->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_createdAt" class="form-group user_createdAt">
<input type="text" data-table="user" data-field="x_createdAt" name="x<?php echo $user_list->RowIndex ?>_createdAt" id="x<?php echo $user_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($user->createdAt->getPlaceHolder()) ?>" value="<?php echo $user->createdAt->EditValue ?>"<?php echo $user->createdAt->editAttributes() ?>>
<?php if (!$user->createdAt->ReadOnly && !$user->createdAt->Disabled && !isset($user->createdAt->EditAttrs["readonly"]) && !isset($user->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_createdAt" name="o<?php echo $user_list->RowIndex ?>_createdAt" id="o<?php echo $user_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($user->createdAt->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_createdAt" class="form-group user_createdAt">
<input type="text" data-table="user" data-field="x_createdAt" name="x<?php echo $user_list->RowIndex ?>_createdAt" id="x<?php echo $user_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($user->createdAt->getPlaceHolder()) ?>" value="<?php echo $user->createdAt->EditValue ?>"<?php echo $user->createdAt->editAttributes() ?>>
<?php if (!$user->createdAt->ReadOnly && !$user->createdAt->Disabled && !isset($user->createdAt->EditAttrs["readonly"]) && !isset($user->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_createdAt" class="user_createdAt">
<span<?php echo $user->createdAt->viewAttributes() ?>>
<?php echo $user->createdAt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($user->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt"<?php echo $user->updatedAt->cellAttributes() ?>>
<?php if ($user->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_updatedAt" class="form-group user_updatedAt">
<input type="text" data-table="user" data-field="x_updatedAt" name="x<?php echo $user_list->RowIndex ?>_updatedAt" id="x<?php echo $user_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($user->updatedAt->getPlaceHolder()) ?>" value="<?php echo $user->updatedAt->EditValue ?>"<?php echo $user->updatedAt->editAttributes() ?>>
<?php if (!$user->updatedAt->ReadOnly && !$user->updatedAt->Disabled && !isset($user->updatedAt->EditAttrs["readonly"]) && !isset($user->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_updatedAt" name="o<?php echo $user_list->RowIndex ?>_updatedAt" id="o<?php echo $user_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($user->updatedAt->OldValue) ?>">
<?php } ?>
<?php if ($user->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_updatedAt" class="form-group user_updatedAt">
<input type="text" data-table="user" data-field="x_updatedAt" name="x<?php echo $user_list->RowIndex ?>_updatedAt" id="x<?php echo $user_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($user->updatedAt->getPlaceHolder()) ?>" value="<?php echo $user->updatedAt->EditValue ?>"<?php echo $user->updatedAt->editAttributes() ?>>
<?php if (!$user->updatedAt->ReadOnly && !$user->updatedAt->Disabled && !isset($user->updatedAt->EditAttrs["readonly"]) && !isset($user->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($user->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $user_list->RowCnt ?>_user_updatedAt" class="user_updatedAt">
<span<?php echo $user->updatedAt->viewAttributes() ?>>
<?php echo $user->updatedAt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_list->ListOptions->render("body", "right", $user_list->RowCnt);
?>
	</tr>
<?php if ($user->RowType == ROWTYPE_ADD || $user->RowType == ROWTYPE_EDIT) { ?>
<script>
fuserlist.updateLists(<?php echo $user_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$user->isGridAdd())
		if (!$user_list->Recordset->EOF)
			$user_list->Recordset->moveNext();
}
?>
<?php
	if ($user->isGridAdd() || $user->isGridEdit()) {
		$user_list->RowIndex = '$rowindex$';
		$user_list->loadRowValues();

		// Set row properties
		$user->resetAttributes();
		$user->RowAttrs = array_merge($user->RowAttrs, array('data-rowindex'=>$user_list->RowIndex, 'id'=>'r0_user', 'data-rowtype'=>ROWTYPE_ADD));
		AppendClass($user->RowAttrs["class"], "ew-template");
		$user->RowType = ROWTYPE_ADD;

		// Render row
		$user_list->renderRow();

		// Render list options
		$user_list->renderListOptions();
		$user_list->StartRowCnt = 0;
?>
	<tr<?php echo $user->rowAttributes() ?>>
<?php

// Render list options (body, left)
$user_list->ListOptions->render("body", "left", $user_list->RowIndex);
?>
	<?php if ($user->username->Visible) { // username ?>
		<td data-name="username">
<span id="el$rowindex$_user_username" class="form-group user_username">
<input type="text" data-table="user" data-field="x_username" name="x<?php echo $user_list->RowIndex ?>_username" id="x<?php echo $user_list->RowIndex ?>_username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->username->getPlaceHolder()) ?>" value="<?php echo $user->username->EditValue ?>"<?php echo $user->username->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_username" name="o<?php echo $user_list->RowIndex ?>_username" id="o<?php echo $user_list->RowIndex ?>_username" value="<?php echo HtmlEncode($user->username->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->gender->Visible) { // gender ?>
		<td data-name="gender">
<span id="el$rowindex$_user_gender" class="form-group user_gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_gender" data-value-separator="<?php echo $user->gender->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_gender" name="x<?php echo $user_list->RowIndex ?>_gender"<?php echo $user->gender->editAttributes() ?>>
		<?php echo $user->gender->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_gender") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_gender" name="o<?php echo $user_list->RowIndex ?>_gender" id="o<?php echo $user_list->RowIndex ?>_gender" value="<?php echo HtmlEncode($user->gender->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->address->Visible) { // address ?>
		<td data-name="address">
<span id="el$rowindex$_user_address" class="form-group user_address">
<input type="text" data-table="user" data-field="x_address" name="x<?php echo $user_list->RowIndex ?>_address" id="x<?php echo $user_list->RowIndex ?>_address" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->address->getPlaceHolder()) ?>" value="<?php echo $user->address->EditValue ?>"<?php echo $user->address->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_address" name="o<?php echo $user_list->RowIndex ?>_address" id="o<?php echo $user_list->RowIndex ?>_address" value="<?php echo HtmlEncode($user->address->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->country->Visible) { // country ?>
		<td data-name="country">
<span id="el$rowindex$_user_country" class="form-group user_country">
<input type="text" data-table="user" data-field="x_country" name="x<?php echo $user_list->RowIndex ?>_country" id="x<?php echo $user_list->RowIndex ?>_country" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->country->getPlaceHolder()) ?>" value="<?php echo $user->country->EditValue ?>"<?php echo $user->country->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_country" name="o<?php echo $user_list->RowIndex ?>_country" id="o<?php echo $user_list->RowIndex ?>_country" value="<?php echo HtmlEncode($user->country->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->photo->Visible) { // photo ?>
		<td data-name="photo">
<span id="el$rowindex$_user_photo" class="form-group user_photo">
<div id="fd_x<?php echo $user_list->RowIndex ?>_photo">
<span title="<?php echo $user->photo->title() ? $user->photo->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($user->photo->ReadOnly || $user->photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="user" data-field="x_photo" name="x<?php echo $user_list->RowIndex ?>_photo" id="x<?php echo $user_list->RowIndex ?>_photo"<?php echo $user->photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $user_list->RowIndex ?>_photo" id= "fn_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $user_list->RowIndex ?>_photo" id= "fa_x<?php echo $user_list->RowIndex ?>_photo" value="0">
<input type="hidden" name="fs_x<?php echo $user_list->RowIndex ?>_photo" id= "fs_x<?php echo $user_list->RowIndex ?>_photo" value="100">
<input type="hidden" name="fx_x<?php echo $user_list->RowIndex ?>_photo" id= "fx_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $user_list->RowIndex ?>_photo" id= "fm_x<?php echo $user_list->RowIndex ?>_photo" value="<?php echo $user->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $user_list->RowIndex ?>_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="user" data-field="x_photo" name="o<?php echo $user_list->RowIndex ?>_photo" id="o<?php echo $user_list->RowIndex ?>_photo" value="<?php echo HtmlEncode($user->photo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->nickname->Visible) { // nickname ?>
		<td data-name="nickname">
<span id="el$rowindex$_user_nickname" class="form-group user_nickname">
<input type="text" data-table="user" data-field="x_nickname" name="x<?php echo $user_list->RowIndex ?>_nickname" id="x<?php echo $user_list->RowIndex ?>_nickname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->nickname->getPlaceHolder()) ?>" value="<?php echo $user->nickname->EditValue ?>"<?php echo $user->nickname->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_nickname" name="o<?php echo $user_list->RowIndex ?>_nickname" id="o<?php echo $user_list->RowIndex ?>_nickname" value="<?php echo HtmlEncode($user->nickname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->region->Visible) { // region ?>
		<td data-name="region">
<span id="el$rowindex$_user_region" class="form-group user_region">
<input type="text" data-table="user" data-field="x_region" name="x<?php echo $user_list->RowIndex ?>_region" id="x<?php echo $user_list->RowIndex ?>_region" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->region->getPlaceHolder()) ?>" value="<?php echo $user->region->EditValue ?>"<?php echo $user->region->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_region" name="o<?php echo $user_list->RowIndex ?>_region" id="o<?php echo $user_list->RowIndex ?>_region" value="<?php echo HtmlEncode($user->region->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->locked->Visible) { // locked ?>
		<td data-name="locked">
<span id="el$rowindex$_user_locked" class="form-group user_locked">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_locked" data-value-separator="<?php echo $user->locked->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_locked" name="x<?php echo $user_list->RowIndex ?>_locked"<?php echo $user->locked->editAttributes() ?>>
		<?php echo $user->locked->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_locked") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_locked" name="o<?php echo $user_list->RowIndex ?>_locked" id="o<?php echo $user_list->RowIndex ?>_locked" value="<?php echo HtmlEncode($user->locked->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->send_role->Visible) { // send_role ?>
		<td data-name="send_role">
<span id="el$rowindex$_user_send_role" class="form-group user_send_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_send_role" data-value-separator="<?php echo $user->send_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_send_role" name="x<?php echo $user_list->RowIndex ?>_send_role"<?php echo $user->send_role->editAttributes() ?>>
		<?php echo $user->send_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_send_role") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_send_role" name="o<?php echo $user_list->RowIndex ?>_send_role" id="o<?php echo $user_list->RowIndex ?>_send_role" value="<?php echo HtmlEncode($user->send_role->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<td data-name="carrier_role">
<span id="el$rowindex$_user_carrier_role" class="form-group user_carrier_role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="user" data-field="x_carrier_role" data-value-separator="<?php echo $user->carrier_role->displayValueSeparatorAttribute() ?>" id="x<?php echo $user_list->RowIndex ?>_carrier_role" name="x<?php echo $user_list->RowIndex ?>_carrier_role"<?php echo $user->carrier_role->editAttributes() ?>>
		<?php echo $user->carrier_role->selectOptionListHtml("x<?php echo $user_list->RowIndex ?>_carrier_role") ?>
	</select>
</div>
</span>
<input type="hidden" data-table="user" data-field="x_carrier_role" name="o<?php echo $user_list->RowIndex ?>_carrier_role" id="o<?php echo $user_list->RowIndex ?>_carrier_role" value="<?php echo HtmlEncode($user->carrier_role->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->birthday->Visible) { // birthday ?>
		<td data-name="birthday">
<span id="el$rowindex$_user_birthday" class="form-group user_birthday">
<input type="text" data-table="user" data-field="x_birthday" name="x<?php echo $user_list->RowIndex ?>_birthday" id="x<?php echo $user_list->RowIndex ?>_birthday" placeholder="<?php echo HtmlEncode($user->birthday->getPlaceHolder()) ?>" value="<?php echo $user->birthday->EditValue ?>"<?php echo $user->birthday->editAttributes() ?>>
<?php if (!$user->birthday->ReadOnly && !$user->birthday->Disabled && !isset($user->birthday->EditAttrs["readonly"]) && !isset($user->birthday->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_birthday", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_birthday" name="o<?php echo $user_list->RowIndex ?>_birthday" id="o<?php echo $user_list->RowIndex ?>_birthday" value="<?php echo HtmlEncode($user->birthday->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->mobile_phone->Visible) { // mobile_phone ?>
		<td data-name="mobile_phone">
<span id="el$rowindex$_user_mobile_phone" class="form-group user_mobile_phone">
<input type="text" data-table="user" data-field="x_mobile_phone" name="x<?php echo $user_list->RowIndex ?>_mobile_phone" id="x<?php echo $user_list->RowIndex ?>_mobile_phone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($user->mobile_phone->getPlaceHolder()) ?>" value="<?php echo $user->mobile_phone->EditValue ?>"<?php echo $user->mobile_phone->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_mobile_phone" name="o<?php echo $user_list->RowIndex ?>_mobile_phone" id="o<?php echo $user_list->RowIndex ?>_mobile_phone" value="<?php echo HtmlEncode($user->mobile_phone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->status->Visible) { // status ?>
		<td data-name="status">
<span id="el$rowindex$_user_status" class="form-group user_status">
<input type="text" data-table="user" data-field="x_status" name="x<?php echo $user_list->RowIndex ?>_status" id="x<?php echo $user_list->RowIndex ?>_status" size="30" placeholder="<?php echo HtmlEncode($user->status->getPlaceHolder()) ?>" value="<?php echo $user->status->EditValue ?>"<?php echo $user->status->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_status" name="o<?php echo $user_list->RowIndex ?>_status" id="o<?php echo $user_list->RowIndex ?>_status" value="<?php echo HtmlEncode($user->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->session_token->Visible) { // session_token ?>
		<td data-name="session_token">
<span id="el$rowindex$_user_session_token" class="form-group user_session_token">
<input type="text" data-table="user" data-field="x_session_token" name="x<?php echo $user_list->RowIndex ?>_session_token" id="x<?php echo $user_list->RowIndex ?>_session_token" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user->session_token->getPlaceHolder()) ?>" value="<?php echo $user->session_token->EditValue ?>"<?php echo $user->session_token->editAttributes() ?>>
</span>
<input type="hidden" data-table="user" data-field="x_session_token" name="o<?php echo $user_list->RowIndex ?>_session_token" id="o<?php echo $user_list->RowIndex ?>_session_token" value="<?php echo HtmlEncode($user->session_token->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->createdAt->Visible) { // createdAt ?>
		<td data-name="createdAt">
<span id="el$rowindex$_user_createdAt" class="form-group user_createdAt">
<input type="text" data-table="user" data-field="x_createdAt" name="x<?php echo $user_list->RowIndex ?>_createdAt" id="x<?php echo $user_list->RowIndex ?>_createdAt" placeholder="<?php echo HtmlEncode($user->createdAt->getPlaceHolder()) ?>" value="<?php echo $user->createdAt->EditValue ?>"<?php echo $user->createdAt->editAttributes() ?>>
<?php if (!$user->createdAt->ReadOnly && !$user->createdAt->Disabled && !isset($user->createdAt->EditAttrs["readonly"]) && !isset($user->createdAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_createdAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_createdAt" name="o<?php echo $user_list->RowIndex ?>_createdAt" id="o<?php echo $user_list->RowIndex ?>_createdAt" value="<?php echo HtmlEncode($user->createdAt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($user->updatedAt->Visible) { // updatedAt ?>
		<td data-name="updatedAt">
<span id="el$rowindex$_user_updatedAt" class="form-group user_updatedAt">
<input type="text" data-table="user" data-field="x_updatedAt" name="x<?php echo $user_list->RowIndex ?>_updatedAt" id="x<?php echo $user_list->RowIndex ?>_updatedAt" placeholder="<?php echo HtmlEncode($user->updatedAt->getPlaceHolder()) ?>" value="<?php echo $user->updatedAt->EditValue ?>"<?php echo $user->updatedAt->editAttributes() ?>>
<?php if (!$user->updatedAt->ReadOnly && !$user->updatedAt->Disabled && !isset($user->updatedAt->EditAttrs["readonly"]) && !isset($user->updatedAt->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fuserlist", "x<?php echo $user_list->RowIndex ?>_updatedAt", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="user" data-field="x_updatedAt" name="o<?php echo $user_list->RowIndex ?>_updatedAt" id="o<?php echo $user_list->RowIndex ?>_updatedAt" value="<?php echo HtmlEncode($user->updatedAt->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_list->ListOptions->render("body", "right", $user_list->RowIndex);
?>
<script>
fuserlist.updateLists(<?php echo $user_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table ##-->
<?php } ?>
<?php if ($user->isAdd() || $user->isCopy()) { ?>
<input type="hidden" name="<?php echo $user_list->FormKeyCountName ?>" id="<?php echo $user_list->FormKeyCountName ?>" value="<?php echo $user_list->KeyCount ?>">
<?php } ?>
<?php if ($user->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $user_list->FormKeyCountName ?>" id="<?php echo $user_list->FormKeyCountName ?>" value="<?php echo $user_list->KeyCount ?>">
<?php echo $user_list->MultiSelectKey ?>
<?php } ?>
<?php if ($user->isEdit()) { ?>
<input type="hidden" name="<?php echo $user_list->FormKeyCountName ?>" id="<?php echo $user_list->FormKeyCountName ?>" value="<?php echo $user_list->KeyCount ?>">
<?php } ?>
<?php if ($user->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $user_list->FormKeyCountName ?>" id="<?php echo $user_list->FormKeyCountName ?>" value="<?php echo $user_list->KeyCount ?>">
<?php echo $user_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$user->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($user_list->Recordset)
	$user_list->Recordset->Close();
?>
<?php if (!$user->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$user->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($user_list->Pager)) $user_list->Pager = new NumericPager($user_list->StartRec, $user_list->DisplayRecs, $user_list->TotalRecs, $user_list->RecRange, $user_list->AutoHidePager) ?>
<?php if ($user_list->Pager->RecordCount > 0 && $user_list->Pager->Visible) { ?>
<div class="ew-pager">
<div class="ew-numeric-page"><ul class="pagination">
	<?php if ($user_list->Pager->FirstButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($user_list->Pager->PrevButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($user_list->Pager->Items as $pagerItem) { ?>
		<li class="page-item<?php if (!$pagerItem->Enabled) { ?> active<?php } ?>"><a class="page-link" href="<?php if ($pagerItem->Enabled) { echo $user_list->pageUrl() . "start=" . $pagerItem->Start; } else { echo "#"; } ?>"><?php echo $pagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($user_list->Pager->NextButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($user_list->Pager->LastButton->Enabled) { ?>
	<li class="page-item"><a class="page-link" href="<?php echo $user_list->pageUrl() ?>start=<?php echo $user_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($user_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $user_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($user_list->TotalRecs > 0 && (!$user_list->AutoHidePageSizeSelector || $user_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="user">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($user_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($user_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($user_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="100"<?php if ($user_list->DisplayRecs == 100) { ?> selected<?php } ?>>100</option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php
	foreach ($user_list->OtherOptions as &$option)
		$option->render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($user_list->TotalRecs == 0 && !$user->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php
	foreach ($user_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$user_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$user->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$user_list->terminate();
?>
