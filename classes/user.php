<?php
namespace PHPMaker2019\ferryman;

/**
 * Table class for user
 */
class user extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $username;
	public $password;
	public $_email;
	public $gender;
	public $phone;
	public $address;
	public $country;
	public $photo;
	public $nickname;
	public $region;
	public $locked;
	public $send_role;
	public $carrier_role;
	public $birthday;
	public $addDate;
	public $updateDate;
	public $activated;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'user';
		$this->TableName = 'user';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`user`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('user', 'user', 'x_id', 'id', '`id`', '`id`', 19, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// username
		$this->username = new DbField('user', 'user', 'x_username', 'username', '`username`', '`username`', 200, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->username->Nullable = FALSE; // NOT NULL field
		$this->username->Required = TRUE; // Required field
		$this->username->Sortable = TRUE; // Allow sort
		$this->fields['username'] = &$this->username;

		// password
		$this->password = new DbField('user', 'user', 'x_password', 'password', '`password`', '`password`', 200, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->password->Nullable = FALSE; // NOT NULL field
		$this->password->Sortable = FALSE; // Allow sort
		$this->fields['password'] = &$this->password;

		// email
		$this->_email = new DbField('user', 'user', 'x__email', 'email', '`email`', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Nullable = FALSE; // NOT NULL field
		$this->_email->Required = TRUE; // Required field
		$this->_email->Sortable = TRUE; // Allow sort
		$this->_email->DefaultErrorMessage = $Language->Phrase("IncorrectEmail");
		$this->fields['email'] = &$this->_email;

		// gender
		$this->gender = new DbField('user', 'user', 'x_gender', 'gender', '`gender`', '`gender`', 3, -1, FALSE, '`gender`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->gender->Nullable = FALSE; // NOT NULL field
		$this->gender->Required = TRUE; // Required field
		$this->gender->Sortable = TRUE; // Allow sort
		$this->gender->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->gender->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		switch ($CurrentLanguage) {
			case "en":
				$this->gender->Lookup = new Lookup('gender', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
			default:
				$this->gender->Lookup = new Lookup('gender', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
		}
		$this->gender->OptionCount = 2;
		$this->gender->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['gender'] = &$this->gender;

		// phone
		$this->phone = new DbField('user', 'user', 'x_phone', 'phone', '`phone`', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Nullable = FALSE; // NOT NULL field
		$this->phone->Required = TRUE; // Required field
		$this->phone->Sortable = TRUE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// address
		$this->address = new DbField('user', 'user', 'x_address', 'address', '`address`', '`address`', 200, -1, FALSE, '`address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address->Nullable = FALSE; // NOT NULL field
		$this->address->Required = TRUE; // Required field
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;

		// country
		$this->country = new DbField('user', 'user', 'x_country', 'country', '`country`', '`country`', 200, -1, FALSE, '`country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->country->Nullable = FALSE; // NOT NULL field
		$this->country->Required = TRUE; // Required field
		$this->country->Sortable = TRUE; // Allow sort
		$this->fields['country'] = &$this->country;

		// photo
		$this->photo = new DbField('user', 'user', 'x_photo', 'photo', '`photo`', '`photo`', 200, -1, TRUE, '`photo`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->photo->Nullable = FALSE; // NOT NULL field
		$this->photo->Required = TRUE; // Required field
		$this->photo->Sortable = TRUE; // Allow sort
		$this->fields['photo'] = &$this->photo;

		// nickname
		$this->nickname = new DbField('user', 'user', 'x_nickname', 'nickname', '`nickname`', '`nickname`', 200, -1, FALSE, '`nickname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nickname->Nullable = FALSE; // NOT NULL field
		$this->nickname->Required = TRUE; // Required field
		$this->nickname->Sortable = TRUE; // Allow sort
		$this->fields['nickname'] = &$this->nickname;

		// region
		$this->region = new DbField('user', 'user', 'x_region', 'region', '`region`', '`region`', 200, -1, FALSE, '`region`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->region->Nullable = FALSE; // NOT NULL field
		$this->region->Required = TRUE; // Required field
		$this->region->Sortable = TRUE; // Allow sort
		$this->fields['region'] = &$this->region;

		// locked
		$this->locked = new DbField('user', 'user', 'x_locked', 'locked', '`locked`', '`locked`', 16, -1, FALSE, '`locked`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->locked->Nullable = FALSE; // NOT NULL field
		$this->locked->Required = TRUE; // Required field
		$this->locked->Sortable = TRUE; // Allow sort
		$this->locked->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->locked->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		switch ($CurrentLanguage) {
			case "en":
				$this->locked->Lookup = new Lookup('locked', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
			default:
				$this->locked->Lookup = new Lookup('locked', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
		}
		$this->locked->OptionCount = 2;
		$this->locked->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['locked'] = &$this->locked;

		// send_role
		$this->send_role = new DbField('user', 'user', 'x_send_role', 'send_role', '`send_role`', '`send_role`', 16, -1, FALSE, '`send_role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->send_role->Nullable = FALSE; // NOT NULL field
		$this->send_role->Required = TRUE; // Required field
		$this->send_role->Sortable = TRUE; // Allow sort
		$this->send_role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->send_role->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		switch ($CurrentLanguage) {
			case "en":
				$this->send_role->Lookup = new Lookup('send_role', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
			default:
				$this->send_role->Lookup = new Lookup('send_role', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
		}
		$this->send_role->OptionCount = 2;
		$this->send_role->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['send_role'] = &$this->send_role;

		// carrier_role
		$this->carrier_role = new DbField('user', 'user', 'x_carrier_role', 'carrier_role', '`carrier_role`', '`carrier_role`', 16, -1, FALSE, '`carrier_role`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->carrier_role->Nullable = FALSE; // NOT NULL field
		$this->carrier_role->Required = TRUE; // Required field
		$this->carrier_role->Sortable = TRUE; // Allow sort
		$this->carrier_role->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->carrier_role->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		switch ($CurrentLanguage) {
			case "en":
				$this->carrier_role->Lookup = new Lookup('carrier_role', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
			default:
				$this->carrier_role->Lookup = new Lookup('carrier_role', 'user', FALSE, '', ["","","",""], [], [], [], [], [], '', '');
				break;
		}
		$this->carrier_role->OptionCount = 2;
		$this->carrier_role->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['carrier_role'] = &$this->carrier_role;

		// birthday
		$this->birthday = new DbField('user', 'user', 'x_birthday', 'birthday', '`birthday`', CastDateFieldForLike('`birthday`', 0, "DB"), 133, 0, FALSE, '`birthday`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->birthday->Nullable = FALSE; // NOT NULL field
		$this->birthday->Required = TRUE; // Required field
		$this->birthday->Sortable = TRUE; // Allow sort
		$this->birthday->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['birthday'] = &$this->birthday;

		// addDate
		$this->addDate = new DbField('user', 'user', 'x_addDate', 'addDate', '`addDate`', CastDateFieldForLike('`addDate`', 0, "DB"), 135, 0, FALSE, '`addDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->addDate->Sortable = TRUE; // Allow sort
		$this->addDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['addDate'] = &$this->addDate;

		// updateDate
		$this->updateDate = new DbField('user', 'user', 'x_updateDate', 'updateDate', '`updateDate`', CastDateFieldForLike('`updateDate`', 0, "DB"), 135, 0, FALSE, '`updateDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updateDate->Sortable = TRUE; // Allow sort
		$this->updateDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['updateDate'] = &$this->updateDate;

		// activated
		$this->activated = new DbField('user', 'user', 'x_activated', 'activated', '`activated`', '`activated`', 16, -1, FALSE, '`activated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->activated->Nullable = FALSE; // NOT NULL field
		$this->activated->Required = TRUE; // Required field
		$this->activated->Sortable = TRUE; // Allow sort
		$this->activated->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['activated'] = &$this->activated;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "image") {
			$detailUrl = $GLOBALS["image"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "trip_info") {
			$detailUrl = $GLOBALS["trip_info"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "parcel_info") {
			$detailUrl = $GLOBALS["parcel_info"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "orders") {
			$detailUrl = $GLOBALS["orders"]->getListUrl() . "?" . TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "userlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`user`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
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
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->username->DbValue = $row['username'];
		$this->password->DbValue = $row['password'];
		$this->_email->DbValue = $row['email'];
		$this->gender->DbValue = $row['gender'];
		$this->phone->DbValue = $row['phone'];
		$this->address->DbValue = $row['address'];
		$this->country->DbValue = $row['country'];
		$this->photo->Upload->DbValue = $row['photo'];
		$this->nickname->DbValue = $row['nickname'];
		$this->region->DbValue = $row['region'];
		$this->locked->DbValue = $row['locked'];
		$this->send_role->DbValue = $row['send_role'];
		$this->carrier_role->DbValue = $row['carrier_role'];
		$this->birthday->DbValue = $row['birthday'];
		$this->addDate->DbValue = $row['addDate'];
		$this->updateDate->DbValue = $row['updateDate'];
		$this->activated->DbValue = $row['activated'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['photo']) ? [] : [$row['photo']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->photo->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->photo->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('id', $row) ? $row['id'] : NULL) : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "userlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
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
	public function getListUrl()
	{
		return "userlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("userview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("userview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "useradd.php?" . $this->getUrlParm($parm);
		else
			$url = "useradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("useredit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("useredit.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("useradd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("useradd.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("userdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
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

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->username->setDbValue($rs->fields('username'));
		$this->password->setDbValue($rs->fields('password'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->gender->setDbValue($rs->fields('gender'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->address->setDbValue($rs->fields('address'));
		$this->country->setDbValue($rs->fields('country'));
		$this->photo->Upload->DbValue = $rs->fields('photo');
		$this->nickname->setDbValue($rs->fields('nickname'));
		$this->region->setDbValue($rs->fields('region'));
		$this->locked->setDbValue($rs->fields('locked'));
		$this->send_role->setDbValue($rs->fields('send_role'));
		$this->carrier_role->setDbValue($rs->fields('carrier_role'));
		$this->birthday->setDbValue($rs->fields('birthday'));
		$this->addDate->setDbValue($rs->fields('addDate'));
		$this->updateDate->setDbValue($rs->fields('updateDate'));
		$this->activated->setDbValue($rs->fields('activated'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

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
		// activated
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
			$this->gender->ViewValue = $this->gender->optionCaption($this->gender->CurrentValue);
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
		if (!EmptyValue($this->photo->Upload->DbValue)) {
			$this->photo->ImageAlt = $this->photo->alt();
			$this->photo->ViewValue = $this->photo->Upload->DbValue;
		} else {
			$this->photo->ViewValue = "";
		}
		$this->photo->ViewCustomAttributes = "";

		// nickname
		$this->nickname->ViewValue = $this->nickname->CurrentValue;
		$this->nickname->ViewCustomAttributes = "";

		// region
		$this->region->ViewValue = $this->region->CurrentValue;
		$this->region->ViewCustomAttributes = "";

		// locked
		if (strval($this->locked->CurrentValue) <> "") {
			$this->locked->ViewValue = $this->locked->optionCaption($this->locked->CurrentValue);
		} else {
			$this->locked->ViewValue = NULL;
		}
		$this->locked->ViewCustomAttributes = "";

		// send_role
		if (strval($this->send_role->CurrentValue) <> "") {
			$this->send_role->ViewValue = $this->send_role->optionCaption($this->send_role->CurrentValue);
		} else {
			$this->send_role->ViewValue = NULL;
		}
		$this->send_role->ViewCustomAttributes = "";

		// carrier_role
		if (strval($this->carrier_role->CurrentValue) <> "") {
			$this->carrier_role->ViewValue = $this->carrier_role->optionCaption($this->carrier_role->CurrentValue);
		} else {
			$this->carrier_role->ViewValue = NULL;
		}
		$this->carrier_role->ViewCustomAttributes = "";

		// birthday
		$this->birthday->ViewValue = $this->birthday->CurrentValue;
		$this->birthday->ViewValue = FormatDateTime($this->birthday->ViewValue, 0);
		$this->birthday->ViewCustomAttributes = "";

		// addDate
		$this->addDate->ViewValue = $this->addDate->CurrentValue;
		$this->addDate->ViewValue = FormatDateTime($this->addDate->ViewValue, 0);
		$this->addDate->ViewCustomAttributes = "";

		// updateDate
		$this->updateDate->ViewValue = $this->updateDate->CurrentValue;
		$this->updateDate->ViewValue = FormatDateTime($this->updateDate->ViewValue, 0);
		$this->updateDate->ViewCustomAttributes = "";

		// activated
		$this->activated->ViewValue = $this->activated->CurrentValue;
		$this->activated->ViewValue = FormatNumber($this->activated->ViewValue, 0, -2, -2, -2);
		$this->activated->ViewCustomAttributes = "";

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
		if (!EmptyValue($this->photo->Upload->DbValue)) {
			$this->photo->HrefValue = GetFileUploadUrl($this->photo, $this->photo->Upload->DbValue); // Add prefix/suffix
			$this->photo->LinkAttrs["target"] = ""; // Add target
			if ($this->isExport()) $this->photo->HrefValue = FullUrl($this->photo->HrefValue, "href");
		} else {
			$this->photo->HrefValue = "";
		}
		$this->photo->ExportHrefValue = $this->photo->UploadPath . $this->photo->Upload->DbValue;
		$this->photo->TooltipValue = "";
		if ($this->photo->UseColorbox) {
			if (EmptyValue($this->photo->TooltipValue))
				$this->photo->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
			$this->photo->LinkAttrs["data-rel"] = "user_x_photo";
			AppendClass($this->photo->LinkAttrs["class"], "ew-lightbox");
		}

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

		// activated
		$this->activated->LinkCustomAttributes = "";
		$this->activated->HrefValue = "";
		$this->activated->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

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
		$this->password->PlaceHolder = RemoveHtml($this->password->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// gender
		$this->gender->EditAttrs["class"] = "form-control";
		$this->gender->EditCustomAttributes = "";
		if (strval($this->gender->CurrentValue) <> "") {
			$this->gender->EditValue = $this->gender->optionCaption($this->gender->CurrentValue);
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
		if (!EmptyValue($this->photo->Upload->DbValue)) {
			$this->photo->ImageAlt = $this->photo->alt();
			$this->photo->EditValue = $this->photo->Upload->DbValue;
		} else {
			$this->photo->EditValue = "";
		}
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
		$this->locked->EditValue = $this->locked->options(TRUE);

		// send_role
		$this->send_role->EditAttrs["class"] = "form-control";
		$this->send_role->EditCustomAttributes = "";
		$this->send_role->EditValue = $this->send_role->options(TRUE);

		// carrier_role
		$this->carrier_role->EditAttrs["class"] = "form-control";
		$this->carrier_role->EditCustomAttributes = "";
		$this->carrier_role->EditValue = $this->carrier_role->options(TRUE);

		// birthday
		$this->birthday->EditAttrs["class"] = "form-control";
		$this->birthday->EditCustomAttributes = "";
		$this->birthday->EditValue = $this->birthday->CurrentValue;
		$this->birthday->EditValue = FormatDateTime($this->birthday->EditValue, 0);
		$this->birthday->ViewCustomAttributes = "";

		// addDate
		$this->addDate->EditAttrs["class"] = "form-control";
		$this->addDate->EditCustomAttributes = "";
		$this->addDate->EditValue = $this->addDate->CurrentValue;
		$this->addDate->EditValue = FormatDateTime($this->addDate->EditValue, 0);
		$this->addDate->ViewCustomAttributes = "";

		// updateDate
		// activated

		$this->activated->EditAttrs["class"] = "form-control";
		$this->activated->EditCustomAttributes = "";
		$this->activated->EditValue = $this->activated->CurrentValue;
		$this->activated->PlaceHolder = RemoveHtml($this->activated->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					if ($this->id->Exportable)
						$doc->exportCaption($this->id);
					if ($this->username->Exportable)
						$doc->exportCaption($this->username);
					if ($this->_email->Exportable)
						$doc->exportCaption($this->_email);
					if ($this->gender->Exportable)
						$doc->exportCaption($this->gender);
					if ($this->phone->Exportable)
						$doc->exportCaption($this->phone);
					if ($this->address->Exportable)
						$doc->exportCaption($this->address);
					if ($this->country->Exportable)
						$doc->exportCaption($this->country);
					if ($this->photo->Exportable)
						$doc->exportCaption($this->photo);
					if ($this->nickname->Exportable)
						$doc->exportCaption($this->nickname);
					if ($this->region->Exportable)
						$doc->exportCaption($this->region);
					if ($this->locked->Exportable)
						$doc->exportCaption($this->locked);
					if ($this->send_role->Exportable)
						$doc->exportCaption($this->send_role);
					if ($this->carrier_role->Exportable)
						$doc->exportCaption($this->carrier_role);
					if ($this->birthday->Exportable)
						$doc->exportCaption($this->birthday);
					if ($this->addDate->Exportable)
						$doc->exportCaption($this->addDate);
					if ($this->updateDate->Exportable)
						$doc->exportCaption($this->updateDate);
					if ($this->activated->Exportable)
						$doc->exportCaption($this->activated);
				} else {
					if ($this->id->Exportable)
						$doc->exportCaption($this->id);
					if ($this->username->Exportable)
						$doc->exportCaption($this->username);
					if ($this->_email->Exportable)
						$doc->exportCaption($this->_email);
					if ($this->gender->Exportable)
						$doc->exportCaption($this->gender);
					if ($this->phone->Exportable)
						$doc->exportCaption($this->phone);
					if ($this->address->Exportable)
						$doc->exportCaption($this->address);
					if ($this->country->Exportable)
						$doc->exportCaption($this->country);
					if ($this->photo->Exportable)
						$doc->exportCaption($this->photo);
					if ($this->nickname->Exportable)
						$doc->exportCaption($this->nickname);
					if ($this->region->Exportable)
						$doc->exportCaption($this->region);
					if ($this->locked->Exportable)
						$doc->exportCaption($this->locked);
					if ($this->send_role->Exportable)
						$doc->exportCaption($this->send_role);
					if ($this->carrier_role->Exportable)
						$doc->exportCaption($this->carrier_role);
					if ($this->birthday->Exportable)
						$doc->exportCaption($this->birthday);
					if ($this->addDate->Exportable)
						$doc->exportCaption($this->addDate);
					if ($this->updateDate->Exportable)
						$doc->exportCaption($this->updateDate);
					if ($this->activated->Exportable)
						$doc->exportCaption($this->activated);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						if ($this->id->Exportable)
							$doc->exportField($this->id);
						if ($this->username->Exportable)
							$doc->exportField($this->username);
						if ($this->_email->Exportable)
							$doc->exportField($this->_email);
						if ($this->gender->Exportable)
							$doc->exportField($this->gender);
						if ($this->phone->Exportable)
							$doc->exportField($this->phone);
						if ($this->address->Exportable)
							$doc->exportField($this->address);
						if ($this->country->Exportable)
							$doc->exportField($this->country);
						if ($this->photo->Exportable)
							$doc->exportField($this->photo);
						if ($this->nickname->Exportable)
							$doc->exportField($this->nickname);
						if ($this->region->Exportable)
							$doc->exportField($this->region);
						if ($this->locked->Exportable)
							$doc->exportField($this->locked);
						if ($this->send_role->Exportable)
							$doc->exportField($this->send_role);
						if ($this->carrier_role->Exportable)
							$doc->exportField($this->carrier_role);
						if ($this->birthday->Exportable)
							$doc->exportField($this->birthday);
						if ($this->addDate->Exportable)
							$doc->exportField($this->addDate);
						if ($this->updateDate->Exportable)
							$doc->exportField($this->updateDate);
						if ($this->activated->Exportable)
							$doc->exportField($this->activated);
					} else {
						if ($this->id->Exportable)
							$doc->exportField($this->id);
						if ($this->username->Exportable)
							$doc->exportField($this->username);
						if ($this->_email->Exportable)
							$doc->exportField($this->_email);
						if ($this->gender->Exportable)
							$doc->exportField($this->gender);
						if ($this->phone->Exportable)
							$doc->exportField($this->phone);
						if ($this->address->Exportable)
							$doc->exportField($this->address);
						if ($this->country->Exportable)
							$doc->exportField($this->country);
						if ($this->photo->Exportable)
							$doc->exportField($this->photo);
						if ($this->nickname->Exportable)
							$doc->exportField($this->nickname);
						if ($this->region->Exportable)
							$doc->exportField($this->region);
						if ($this->locked->Exportable)
							$doc->exportField($this->locked);
						if ($this->send_role->Exportable)
							$doc->exportField($this->send_role);
						if ($this->carrier_role->Exportable)
							$doc->exportField($this->carrier_role);
						if ($this->birthday->Exportable)
							$doc->exportField($this->birthday);
						if ($this->addDate->Exportable)
							$doc->exportField($this->addDate);
						if ($this->updateDate->Exportable)
							$doc->exportField($this->updateDate);
						if ($this->activated->Exportable)
							$doc->exportField($this->activated);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					$validRequest = $Security->isLoggedIn(); // Logged in
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$validRequest = $Security->isLoggedIn(); // Logged in
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = (Post("distinct") === "1");
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		$lookup->FilterValues[] = rawurldecode(Post("v0", Post("lookupValue", ""))); // Lookup values
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = rawurldecode(Post("v" . $i, ""));
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'photo') {
			$fldName = "photo";
			$fileNameFld = "photo";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						if (!ContainsString(ServerVar("HTTP_USER_AGENT"), "MSIE"))
							AddHeader("Content-type", ContentType(substr($val, 0, 11)));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0\0", $val))
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
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
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
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
