<?php

// Global variable for table object
$user = NULL;

//
// Table class for user
//
class cuser extends cTable {
	var $id;
	var $username;
	var $password;
	var $_email;
	var $gender;
	var $phone;
	var $address;
	var $country;
	var $photo;
	var $nickname;
	var $region;
	var $locked;
	var $send_role;
	var $carrier_role;
	var $birthday;
	var $addDate;
	var $updateDate;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'user';
		$this->TableName = 'user';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`user`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('user', 'user', 'x_id', 'id', '`id`', '`id`', 19, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// username
		$this->username = new cField('user', 'user', 'x_username', 'username', '`username`', '`username`', 200, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->username->Sortable = TRUE; // Allow sort
		$this->fields['username'] = &$this->username;

		// password
		$this->password = new cField('user', 'user', 'x_password', 'password', '`password`', '`password`', 200, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->password->Sortable = FALSE; // Allow sort
		$this->fields['password'] = &$this->password;

		// email
		$this->_email = new cField('user', 'user', 'x__email', 'email', '`email`', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->_email->FldDefaultErrMsg = $Language->Phrase("IncorrectEmail");
		$this->fields['email'] = &$this->_email;

		// gender
		$this->gender = new cField('user', 'user', 'x_gender', 'gender', '`gender`', '`gender`', 3, -1, FALSE, '`gender`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->gender->Sortable = TRUE; // Allow sort
		$this->gender->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->gender->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->gender->OptionCount = 2;
		$this->gender->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['gender'] = &$this->gender;

		// phone
		$this->phone = new cField('user', 'user', 'x_phone', 'phone', '`phone`', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Sortable = TRUE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// address
		$this->address = new cField('user', 'user', 'x_address', 'address', '`address`', '`address`', 200, -1, FALSE, '`address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;

		// country
		$this->country = new cField('user', 'user', 'x_country', 'country', '`country`', '`country`', 200, -1, FALSE, '`country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->country->Sortable = TRUE; // Allow sort
		$this->fields['country'] = &$this->country;

		// photo
		$this->photo = new cField('user', 'user', 'x_photo', 'photo', '`photo`', '`photo`', 200, -1, FALSE, '`photo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->photo->Sortable = TRUE; // Allow sort
		$this->fields['photo'] = &$this->photo;

		// nickname
		$this->nickname = new cField('user', 'user', 'x_nickname', 'nickname', '`nickname`', '`nickname`', 200, -1, FALSE, '`nickname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nickname->Sortable = TRUE; // Allow sort
		$this->fields['nickname'] = &$this->nickname;

		// region
		$this->region = new cField('user', 'user', 'x_region', 'region', '`region`', '`region`', 200, -1, FALSE, '`region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region->Sortable = TRUE; // Allow sort
		$this->fields['region'] = &$this->region;

		// locked
		$this->locked = new cField('user', 'user', 'x_locked', 'locked', '`locked`', '`locked`', 16, -1, FALSE, '`locked`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->locked->Sortable = TRUE; // Allow sort
		$this->locked->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->locked->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->locked->OptionCount = 2;
		$this->locked->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['locked'] = &$this->locked;

		// send_role
		$this->send_role = new cField('user', 'user', 'x_send_role', 'send_role', '`send_role`', '`send_role`', 16, -1, FALSE, '`send_role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->send_role->Sortable = TRUE; // Allow sort
		$this->send_role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->send_role->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->send_role->OptionCount = 2;
		$this->send_role->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['send_role'] = &$this->send_role;

		// carrier_role
		$this->carrier_role = new cField('user', 'user', 'x_carrier_role', 'carrier_role', '`carrier_role`', '`carrier_role`', 16, -1, FALSE, '`carrier_role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->carrier_role->Sortable = TRUE; // Allow sort
		$this->carrier_role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->carrier_role->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->carrier_role->OptionCount = 2;
		$this->carrier_role->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['carrier_role'] = &$this->carrier_role;

		// birthday
		$this->birthday = new cField('user', 'user', 'x_birthday', 'birthday', '`birthday`', ew_CastDateFieldForLike('`birthday`', 0, "DB"), 133, 0, FALSE, '`birthday`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->birthday->Sortable = TRUE; // Allow sort
		$this->birthday->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['birthday'] = &$this->birthday;

		// addDate
		$this->addDate = new cField('user', 'user', 'x_addDate', 'addDate', '`addDate`', ew_CastDateFieldForLike('`addDate`', 0, "DB"), 135, 0, FALSE, '`addDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addDate->Sortable = TRUE; // Allow sort
		$this->addDate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['addDate'] = &$this->addDate;

		// updateDate
		$this->updateDate = new cField('user', 'user', 'x_updateDate', 'updateDate', '`updateDate`', ew_CastDateFieldForLike('`updateDate`', 0, "DB"), 135, 0, FALSE, '`updateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updateDate->Sortable = TRUE; // Allow sort
		$this->updateDate->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['updateDate'] = &$this->updateDate;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "image") {
			$sDetailUrl = $GLOBALS["image"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "trip_info") {
			$sDetailUrl = $GLOBALS["trip_info"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "parcel_info") {
			$sDetailUrl = $GLOBALS["parcel_info"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "orders") {
			$sDetailUrl = $GLOBALS["orders"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
			$sDetailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "userlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`user`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "userlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "userview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "useredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "useradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "userlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("userview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("userview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "useradd.php?" . $this->UrlParm($parm);
		else
			$url = "useradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("useredit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("useredit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("useradd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("useradd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("userdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = $_POST["id"];
			elseif (isset($_GET["id"]))
				$arKeys[] = $_GET["id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->username->setDbValue($rs->fields('username'));
		$this->password->setDbValue($rs->fields('password'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->gender->setDbValue($rs->fields('gender'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->address->setDbValue($rs->fields('address'));
		$this->country->setDbValue($rs->fields('country'));
		$this->photo->setDbValue($rs->fields('photo'));
		$this->nickname->setDbValue($rs->fields('nickname'));
		$this->region->setDbValue($rs->fields('region'));
		$this->locked->setDbValue($rs->fields('locked'));
		$this->send_role->setDbValue($rs->fields('send_role'));
		$this->carrier_role->setDbValue($rs->fields('carrier_role'));
		$this->birthday->setDbValue($rs->fields('birthday'));
		$this->addDate->setDbValue($rs->fields('addDate'));
		$this->updateDate->setDbValue($rs->fields('updateDate'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id
		// username
		// password

		$this->password->CellCssStyle = "white-space: nowrap;";

		// email
		// gender
		// phone
		// address
		// country
		// photo
		// nickname
		// region
		// locked
		// send_role
		// carrier_role
		// birthday
		// addDate
		// updateDate
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// gender
		if (strval($this->gender->CurrentValue) <> "") {
			$this->gender->ViewValue = $this->gender->OptionCaption($this->gender->CurrentValue);
		} else {
			$this->gender->ViewValue = NULL;
		}
		$this->gender->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// country
		$this->country->ViewValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// photo
		$this->photo->ViewValue = $this->photo->CurrentValue;
		$this->photo->ViewCustomAttributes = "";

		// nickname
		$this->nickname->ViewValue = $this->nickname->CurrentValue;
		$this->nickname->ViewCustomAttributes = "";

		// region
		$this->region->ViewValue = $this->region->CurrentValue;
		$this->region->ViewCustomAttributes = "";

		// locked
		if (strval($this->locked->CurrentValue) <> "") {
			$this->locked->ViewValue = $this->locked->OptionCaption($this->locked->CurrentValue);
		} else {
			$this->locked->ViewValue = NULL;
		}
		$this->locked->ViewCustomAttributes = "";

		// send_role
		if (strval($this->send_role->CurrentValue) <> "") {
			$this->send_role->ViewValue = $this->send_role->OptionCaption($this->send_role->CurrentValue);
		} else {
			$this->send_role->ViewValue = NULL;
		}
		$this->send_role->ViewCustomAttributes = "";

		// carrier_role
		if (strval($this->carrier_role->CurrentValue) <> "") {
			$this->carrier_role->ViewValue = $this->carrier_role->OptionCaption($this->carrier_role->CurrentValue);
		} else {
			$this->carrier_role->ViewValue = NULL;
		}
		$this->carrier_role->ViewCustomAttributes = "";

		// birthday
		$this->birthday->ViewValue = $this->birthday->CurrentValue;
		$this->birthday->ViewValue = ew_FormatDateTime($this->birthday->ViewValue, 0);
		$this->birthday->ViewCustomAttributes = "";

		// addDate
		$this->addDate->ViewValue = $this->addDate->CurrentValue;
		$this->addDate->ViewValue = ew_FormatDateTime($this->addDate->ViewValue, 0);
		$this->addDate->ViewCustomAttributes = "";

		// updateDate
		$this->updateDate->ViewValue = $this->updateDate->CurrentValue;
		$this->updateDate->ViewValue = ew_FormatDateTime($this->updateDate->ViewValue, 0);
		$this->updateDate->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// gender
		$this->gender->LinkCustomAttributes = "";
		$this->gender->HrefValue = "";
		$this->gender->TooltipValue = "";

		// phone
		$this->phone->LinkCustomAttributes = "";
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

		// address
		$this->address->LinkCustomAttributes = "";
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// country
		$this->country->LinkCustomAttributes = "";
		$this->country->HrefValue = "";
		$this->country->TooltipValue = "";

		// photo
		$this->photo->LinkCustomAttributes = "";
		$this->photo->HrefValue = "";
		$this->photo->TooltipValue = "";

		// nickname
		$this->nickname->LinkCustomAttributes = "";
		$this->nickname->HrefValue = "";
		$this->nickname->TooltipValue = "";

		// region
		$this->region->LinkCustomAttributes = "";
		$this->region->HrefValue = "";
		$this->region->TooltipValue = "";

		// locked
		$this->locked->LinkCustomAttributes = "";
		$this->locked->HrefValue = "";
		$this->locked->TooltipValue = "";

		// send_role
		$this->send_role->LinkCustomAttributes = "";
		$this->send_role->HrefValue = "";
		$this->send_role->TooltipValue = "";

		// carrier_role
		$this->carrier_role->LinkCustomAttributes = "";
		$this->carrier_role->HrefValue = "";
		$this->carrier_role->TooltipValue = "";

		// birthday
		$this->birthday->LinkCustomAttributes = "";
		$this->birthday->HrefValue = "";
		$this->birthday->TooltipValue = "";

		// addDate
		$this->addDate->LinkCustomAttributes = "";
		$this->addDate->HrefValue = "";
		$this->addDate->TooltipValue = "";

		// updateDate
		$this->updateDate->LinkCustomAttributes = "";
		$this->updateDate->HrefValue = "";
		$this->updateDate->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// username
		$this->username->EditAttrs["class"] = "form-control";
		$this->username->EditCustomAttributes = "";
		$this->username->EditValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// gender
		$this->gender->EditAttrs["class"] = "form-control";
		$this->gender->EditCustomAttributes = "";
		if (strval($this->gender->CurrentValue) <> "") {
			$this->gender->EditValue = $this->gender->OptionCaption($this->gender->CurrentValue);
		} else {
			$this->gender->EditValue = NULL;
		}
		$this->gender->ViewCustomAttributes = "";

		// phone
		$this->phone->EditAttrs["class"] = "form-control";
		$this->phone->EditCustomAttributes = "";
		$this->phone->EditValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// address
		$this->address->EditAttrs["class"] = "form-control";
		$this->address->EditCustomAttributes = "";
		$this->address->EditValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// country
		$this->country->EditAttrs["class"] = "form-control";
		$this->country->EditCustomAttributes = "";
		$this->country->EditValue = $this->country->CurrentValue;
		$this->country->ViewCustomAttributes = "";

		// photo
		$this->photo->EditAttrs["class"] = "form-control";
		$this->photo->EditCustomAttributes = "";
		$this->photo->EditValue = $this->photo->CurrentValue;
		$this->photo->ViewCustomAttributes = "";

		// nickname
		$this->nickname->EditAttrs["class"] = "form-control";
		$this->nickname->EditCustomAttributes = "";
		$this->nickname->EditValue = $this->nickname->CurrentValue;
		$this->nickname->ViewCustomAttributes = "";

		// region
		$this->region->EditAttrs["class"] = "form-control";
		$this->region->EditCustomAttributes = "";
		$this->region->EditValue = $this->region->CurrentValue;
		$this->region->ViewCustomAttributes = "";

		// locked
		$this->locked->EditAttrs["class"] = "form-control";
		$this->locked->EditCustomAttributes = "";
		$this->locked->EditValue = $this->locked->Options(TRUE);

		// send_role
		$this->send_role->EditAttrs["class"] = "form-control";
		$this->send_role->EditCustomAttributes = "";
		$this->send_role->EditValue = $this->send_role->Options(TRUE);

		// carrier_role
		$this->carrier_role->EditAttrs["class"] = "form-control";
		$this->carrier_role->EditCustomAttributes = "";
		$this->carrier_role->EditValue = $this->carrier_role->Options(TRUE);

		// birthday
		$this->birthday->EditAttrs["class"] = "form-control";
		$this->birthday->EditCustomAttributes = "";
		$this->birthday->EditValue = $this->birthday->CurrentValue;
		$this->birthday->EditValue = ew_FormatDateTime($this->birthday->EditValue, 0);
		$this->birthday->ViewCustomAttributes = "";

		// addDate
		$this->addDate->EditAttrs["class"] = "form-control";
		$this->addDate->EditCustomAttributes = "";
		$this->addDate->EditValue = $this->addDate->CurrentValue;
		$this->addDate->EditValue = ew_FormatDateTime($this->addDate->EditValue, 0);
		$this->addDate->ViewCustomAttributes = "";

		// updateDate
		// Call Row Rendered event

		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->username->Exportable) $Doc->ExportCaption($this->username);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->gender->Exportable) $Doc->ExportCaption($this->gender);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->address->Exportable) $Doc->ExportCaption($this->address);
					if ($this->country->Exportable) $Doc->ExportCaption($this->country);
					if ($this->photo->Exportable) $Doc->ExportCaption($this->photo);
					if ($this->nickname->Exportable) $Doc->ExportCaption($this->nickname);
					if ($this->region->Exportable) $Doc->ExportCaption($this->region);
					if ($this->locked->Exportable) $Doc->ExportCaption($this->locked);
					if ($this->send_role->Exportable) $Doc->ExportCaption($this->send_role);
					if ($this->carrier_role->Exportable) $Doc->ExportCaption($this->carrier_role);
					if ($this->birthday->Exportable) $Doc->ExportCaption($this->birthday);
					if ($this->addDate->Exportable) $Doc->ExportCaption($this->addDate);
					if ($this->updateDate->Exportable) $Doc->ExportCaption($this->updateDate);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->username->Exportable) $Doc->ExportCaption($this->username);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->gender->Exportable) $Doc->ExportCaption($this->gender);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->address->Exportable) $Doc->ExportCaption($this->address);
					if ($this->country->Exportable) $Doc->ExportCaption($this->country);
					if ($this->photo->Exportable) $Doc->ExportCaption($this->photo);
					if ($this->nickname->Exportable) $Doc->ExportCaption($this->nickname);
					if ($this->region->Exportable) $Doc->ExportCaption($this->region);
					if ($this->locked->Exportable) $Doc->ExportCaption($this->locked);
					if ($this->send_role->Exportable) $Doc->ExportCaption($this->send_role);
					if ($this->carrier_role->Exportable) $Doc->ExportCaption($this->carrier_role);
					if ($this->birthday->Exportable) $Doc->ExportCaption($this->birthday);
					if ($this->addDate->Exportable) $Doc->ExportCaption($this->addDate);
					if ($this->updateDate->Exportable) $Doc->ExportCaption($this->updateDate);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->username->Exportable) $Doc->ExportField($this->username);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->gender->Exportable) $Doc->ExportField($this->gender);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->address->Exportable) $Doc->ExportField($this->address);
						if ($this->country->Exportable) $Doc->ExportField($this->country);
						if ($this->photo->Exportable) $Doc->ExportField($this->photo);
						if ($this->nickname->Exportable) $Doc->ExportField($this->nickname);
						if ($this->region->Exportable) $Doc->ExportField($this->region);
						if ($this->locked->Exportable) $Doc->ExportField($this->locked);
						if ($this->send_role->Exportable) $Doc->ExportField($this->send_role);
						if ($this->carrier_role->Exportable) $Doc->ExportField($this->carrier_role);
						if ($this->birthday->Exportable) $Doc->ExportField($this->birthday);
						if ($this->addDate->Exportable) $Doc->ExportField($this->addDate);
						if ($this->updateDate->Exportable) $Doc->ExportField($this->updateDate);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->username->Exportable) $Doc->ExportField($this->username);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->gender->Exportable) $Doc->ExportField($this->gender);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->address->Exportable) $Doc->ExportField($this->address);
						if ($this->country->Exportable) $Doc->ExportField($this->country);
						if ($this->photo->Exportable) $Doc->ExportField($this->photo);
						if ($this->nickname->Exportable) $Doc->ExportField($this->nickname);
						if ($this->region->Exportable) $Doc->ExportField($this->region);
						if ($this->locked->Exportable) $Doc->ExportField($this->locked);
						if ($this->send_role->Exportable) $Doc->ExportField($this->send_role);
						if ($this->carrier_role->Exportable) $Doc->ExportField($this->carrier_role);
						if ($this->birthday->Exportable) $Doc->ExportField($this->birthday);
						if ($this->addDate->Exportable) $Doc->ExportField($this->addDate);
						if ($this->updateDate->Exportable) $Doc->ExportField($this->updateDate);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
