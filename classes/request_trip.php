<?php
namespace PHPMaker2019\ferryman;

/**
 * Table class for request_trip
 */
class request_trip extends DbTable
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
	public $from_place;
	public $to_place;
	public $description;
	public $user_id;
	public $from_date;
	public $to_date;
	public $createdAt;
	public $updatedAt;
	public $labor_fee;
	public $applicable;
	public $service_type;
	public $goods_category;
	public $goods_weight;
	public $image1_id;
	public $image2_id;
	public $image3_id;
	public $image4_id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'request_trip';
		$this->TableName = 'request_trip';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`request_trip`";
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
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('request_trip', 'request_trip', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// from_place
		$this->from_place = new DbField('request_trip', 'request_trip', 'x_from_place', 'from_place', '`from_place`', '`from_place`', 200, -1, FALSE, '`from_place`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->from_place->Nullable = FALSE; // NOT NULL field
		$this->from_place->Required = TRUE; // Required field
		$this->from_place->Sortable = TRUE; // Allow sort
		$this->fields['from_place'] = &$this->from_place;

		// to_place
		$this->to_place = new DbField('request_trip', 'request_trip', 'x_to_place', 'to_place', '`to_place`', '`to_place`', 200, -1, FALSE, '`to_place`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->to_place->Nullable = FALSE; // NOT NULL field
		$this->to_place->Required = TRUE; // Required field
		$this->to_place->Sortable = TRUE; // Allow sort
		$this->fields['to_place'] = &$this->to_place;

		// description
		$this->description = new DbField('request_trip', 'request_trip', 'x_description', 'description', '`description`', '`description`', 200, -1, FALSE, '`description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->description->Required = TRUE; // Required field
		$this->description->Sortable = TRUE; // Allow sort
		$this->fields['description'] = &$this->description;

		// user_id
		$this->user_id = new DbField('request_trip', 'request_trip', 'x_user_id', 'user_id', '`user_id`', '`user_id`', 3, -1, FALSE, '`user_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->user_id->Nullable = FALSE; // NOT NULL field
		$this->user_id->Required = TRUE; // Required field
		$this->user_id->Sortable = TRUE; // Allow sort
		$this->user_id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['user_id'] = &$this->user_id;

		// from_date
		$this->from_date = new DbField('request_trip', 'request_trip', 'x_from_date', 'from_date', '`from_date`', CastDateFieldForLike('`from_date`', 0, "DB"), 135, 0, FALSE, '`from_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->from_date->Sortable = TRUE; // Allow sort
		$this->from_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['from_date'] = &$this->from_date;

		// to_date
		$this->to_date = new DbField('request_trip', 'request_trip', 'x_to_date', 'to_date', '`to_date`', CastDateFieldForLike('`to_date`', 0, "DB"), 135, 0, FALSE, '`to_date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->to_date->Sortable = TRUE; // Allow sort
		$this->to_date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['to_date'] = &$this->to_date;

		// createdAt
		$this->createdAt = new DbField('request_trip', 'request_trip', 'x_createdAt', 'createdAt', '`createdAt`', CastDateFieldForLike('`createdAt`', 0, "DB"), 135, 0, FALSE, '`createdAt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->createdAt->Nullable = FALSE; // NOT NULL field
		$this->createdAt->Required = TRUE; // Required field
		$this->createdAt->Sortable = TRUE; // Allow sort
		$this->createdAt->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['createdAt'] = &$this->createdAt;

		// updatedAt
		$this->updatedAt = new DbField('request_trip', 'request_trip', 'x_updatedAt', 'updatedAt', '`updatedAt`', CastDateFieldForLike('`updatedAt`', 0, "DB"), 135, 0, FALSE, '`updatedAt`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->updatedAt->Nullable = FALSE; // NOT NULL field
		$this->updatedAt->Required = TRUE; // Required field
		$this->updatedAt->Sortable = TRUE; // Allow sort
		$this->updatedAt->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['updatedAt'] = &$this->updatedAt;

		// labor_fee
		$this->labor_fee = new DbField('request_trip', 'request_trip', 'x_labor_fee', 'labor_fee', '`labor_fee`', '`labor_fee`', 3, -1, FALSE, '`labor_fee`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->labor_fee->Sortable = TRUE; // Allow sort
		$this->labor_fee->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['labor_fee'] = &$this->labor_fee;

		// applicable
		$this->applicable = new DbField('request_trip', 'request_trip', 'x_applicable', 'applicable', '`applicable`', '`applicable`', 3, -1, FALSE, '`applicable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->applicable->Nullable = FALSE; // NOT NULL field
		$this->applicable->Sortable = TRUE; // Allow sort
		$this->applicable->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['applicable'] = &$this->applicable;

		// service_type
		$this->service_type = new DbField('request_trip', 'request_trip', 'x_service_type', 'service_type', '`service_type`', '`service_type`', 3, -1, FALSE, '`service_type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->service_type->Nullable = FALSE; // NOT NULL field
		$this->service_type->Sortable = TRUE; // Allow sort
		$this->service_type->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['service_type'] = &$this->service_type;

		// goods_category
		$this->goods_category = new DbField('request_trip', 'request_trip', 'x_goods_category', 'goods_category', '`goods_category`', '`goods_category`', 3, -1, FALSE, '`goods_category`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->goods_category->Sortable = TRUE; // Allow sort
		$this->goods_category->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['goods_category'] = &$this->goods_category;

		// goods_weight
		$this->goods_weight = new DbField('request_trip', 'request_trip', 'x_goods_weight', 'goods_weight', '`goods_weight`', '`goods_weight`', 3, -1, FALSE, '`goods_weight`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->goods_weight->Sortable = TRUE; // Allow sort
		$this->goods_weight->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['goods_weight'] = &$this->goods_weight;

		// image1_id
		$this->image1_id = new DbField('request_trip', 'request_trip', 'x_image1_id', 'image1_id', '`image1_id`', '`image1_id`', 3, -1, FALSE, '`image1_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->image1_id->Sortable = TRUE; // Allow sort
		$this->image1_id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['image1_id'] = &$this->image1_id;

		// image2_id
		$this->image2_id = new DbField('request_trip', 'request_trip', 'x_image2_id', 'image2_id', '`image2_id`', '`image2_id`', 3, -1, FALSE, '`image2_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->image2_id->Sortable = TRUE; // Allow sort
		$this->image2_id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['image2_id'] = &$this->image2_id;

		// image3_id
		$this->image3_id = new DbField('request_trip', 'request_trip', 'x_image3_id', 'image3_id', '`image3_id`', '`image3_id`', 3, -1, FALSE, '`image3_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->image3_id->Sortable = TRUE; // Allow sort
		$this->image3_id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['image3_id'] = &$this->image3_id;

		// image4_id
		$this->image4_id = new DbField('request_trip', 'request_trip', 'x_image4_id', 'image4_id', '`image4_id`', '`image4_id`', 3, -1, FALSE, '`image4_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->image4_id->Sortable = TRUE; // Allow sort
		$this->image4_id->DefaultErrorMessage = $Language->Phrase("IncorrectInteger");
		$this->fields['image4_id'] = &$this->image4_id;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`request_trip`";
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
		$this->from_place->DbValue = $row['from_place'];
		$this->to_place->DbValue = $row['to_place'];
		$this->description->DbValue = $row['description'];
		$this->user_id->DbValue = $row['user_id'];
		$this->from_date->DbValue = $row['from_date'];
		$this->to_date->DbValue = $row['to_date'];
		$this->createdAt->DbValue = $row['createdAt'];
		$this->updatedAt->DbValue = $row['updatedAt'];
		$this->labor_fee->DbValue = $row['labor_fee'];
		$this->applicable->DbValue = $row['applicable'];
		$this->service_type->DbValue = $row['service_type'];
		$this->goods_category->DbValue = $row['goods_category'];
		$this->goods_weight->DbValue = $row['goods_weight'];
		$this->image1_id->DbValue = $row['image1_id'];
		$this->image2_id->DbValue = $row['image2_id'];
		$this->image3_id->DbValue = $row['image3_id'];
		$this->image4_id->DbValue = $row['image4_id'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
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
			return "request_triplist.php";
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
		if ($pageName == "request_tripview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "request_tripedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "request_tripadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "request_triplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("request_tripview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("request_tripview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "request_tripadd.php?" . $this->getUrlParm($parm);
		else
			$url = "request_tripadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("request_tripedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("request_tripadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("request_tripdelete.php", $this->getUrlParm());
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
		$this->from_place->setDbValue($rs->fields('from_place'));
		$this->to_place->setDbValue($rs->fields('to_place'));
		$this->description->setDbValue($rs->fields('description'));
		$this->user_id->setDbValue($rs->fields('user_id'));
		$this->from_date->setDbValue($rs->fields('from_date'));
		$this->to_date->setDbValue($rs->fields('to_date'));
		$this->createdAt->setDbValue($rs->fields('createdAt'));
		$this->updatedAt->setDbValue($rs->fields('updatedAt'));
		$this->labor_fee->setDbValue($rs->fields('labor_fee'));
		$this->applicable->setDbValue($rs->fields('applicable'));
		$this->service_type->setDbValue($rs->fields('service_type'));
		$this->goods_category->setDbValue($rs->fields('goods_category'));
		$this->goods_weight->setDbValue($rs->fields('goods_weight'));
		$this->image1_id->setDbValue($rs->fields('image1_id'));
		$this->image2_id->setDbValue($rs->fields('image2_id'));
		$this->image3_id->setDbValue($rs->fields('image3_id'));
		$this->image4_id->setDbValue($rs->fields('image4_id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id
		// from_place
		// to_place
		// description
		// user_id
		// from_date
		// to_date
		// createdAt
		// updatedAt
		// labor_fee
		// applicable
		// service_type
		// goods_category
		// goods_weight
		// image1_id
		// image2_id
		// image3_id
		// image4_id
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// from_place
		$this->from_place->ViewValue = $this->from_place->CurrentValue;
		$this->from_place->ViewCustomAttributes = "";

		// to_place
		$this->to_place->ViewValue = $this->to_place->CurrentValue;
		$this->to_place->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->ViewCustomAttributes = "";

		// user_id
		$this->user_id->ViewValue = $this->user_id->CurrentValue;
		$this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, 0, -2, -2, -2);
		$this->user_id->ViewCustomAttributes = "";

		// from_date
		$this->from_date->ViewValue = $this->from_date->CurrentValue;
		$this->from_date->ViewValue = FormatDateTime($this->from_date->ViewValue, 0);
		$this->from_date->ViewCustomAttributes = "";

		// to_date
		$this->to_date->ViewValue = $this->to_date->CurrentValue;
		$this->to_date->ViewValue = FormatDateTime($this->to_date->ViewValue, 0);
		$this->to_date->ViewCustomAttributes = "";

		// createdAt
		$this->createdAt->ViewValue = $this->createdAt->CurrentValue;
		$this->createdAt->ViewValue = FormatDateTime($this->createdAt->ViewValue, 0);
		$this->createdAt->ViewCustomAttributes = "";

		// updatedAt
		$this->updatedAt->ViewValue = $this->updatedAt->CurrentValue;
		$this->updatedAt->ViewValue = FormatDateTime($this->updatedAt->ViewValue, 0);
		$this->updatedAt->ViewCustomAttributes = "";

		// labor_fee
		$this->labor_fee->ViewValue = $this->labor_fee->CurrentValue;
		$this->labor_fee->ViewValue = FormatNumber($this->labor_fee->ViewValue, 0, -2, -2, -2);
		$this->labor_fee->ViewCustomAttributes = "";

		// applicable
		$this->applicable->ViewValue = $this->applicable->CurrentValue;
		$this->applicable->ViewValue = FormatNumber($this->applicable->ViewValue, 0, -2, -2, -2);
		$this->applicable->ViewCustomAttributes = "";

		// service_type
		$this->service_type->ViewValue = $this->service_type->CurrentValue;
		$this->service_type->ViewValue = FormatNumber($this->service_type->ViewValue, 0, -2, -2, -2);
		$this->service_type->ViewCustomAttributes = "";

		// goods_category
		$this->goods_category->ViewValue = $this->goods_category->CurrentValue;
		$this->goods_category->ViewValue = FormatNumber($this->goods_category->ViewValue, 0, -2, -2, -2);
		$this->goods_category->ViewCustomAttributes = "";

		// goods_weight
		$this->goods_weight->ViewValue = $this->goods_weight->CurrentValue;
		$this->goods_weight->ViewValue = FormatNumber($this->goods_weight->ViewValue, 0, -2, -2, -2);
		$this->goods_weight->ViewCustomAttributes = "";

		// image1_id
		$this->image1_id->ViewValue = $this->image1_id->CurrentValue;
		$this->image1_id->ViewValue = FormatNumber($this->image1_id->ViewValue, 0, -2, -2, -2);
		$this->image1_id->ViewCustomAttributes = "";

		// image2_id
		$this->image2_id->ViewValue = $this->image2_id->CurrentValue;
		$this->image2_id->ViewValue = FormatNumber($this->image2_id->ViewValue, 0, -2, -2, -2);
		$this->image2_id->ViewCustomAttributes = "";

		// image3_id
		$this->image3_id->ViewValue = $this->image3_id->CurrentValue;
		$this->image3_id->ViewValue = FormatNumber($this->image3_id->ViewValue, 0, -2, -2, -2);
		$this->image3_id->ViewCustomAttributes = "";

		// image4_id
		$this->image4_id->ViewValue = $this->image4_id->CurrentValue;
		$this->image4_id->ViewValue = FormatNumber($this->image4_id->ViewValue, 0, -2, -2, -2);
		$this->image4_id->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// from_place
		$this->from_place->LinkCustomAttributes = "";
		$this->from_place->HrefValue = "";
		$this->from_place->TooltipValue = "";

		// to_place
		$this->to_place->LinkCustomAttributes = "";
		$this->to_place->HrefValue = "";
		$this->to_place->TooltipValue = "";

		// description
		$this->description->LinkCustomAttributes = "";
		$this->description->HrefValue = "";
		$this->description->TooltipValue = "";

		// user_id
		$this->user_id->LinkCustomAttributes = "";
		$this->user_id->HrefValue = "";
		$this->user_id->TooltipValue = "";

		// from_date
		$this->from_date->LinkCustomAttributes = "";
		$this->from_date->HrefValue = "";
		$this->from_date->TooltipValue = "";

		// to_date
		$this->to_date->LinkCustomAttributes = "";
		$this->to_date->HrefValue = "";
		$this->to_date->TooltipValue = "";

		// createdAt
		$this->createdAt->LinkCustomAttributes = "";
		$this->createdAt->HrefValue = "";
		$this->createdAt->TooltipValue = "";

		// updatedAt
		$this->updatedAt->LinkCustomAttributes = "";
		$this->updatedAt->HrefValue = "";
		$this->updatedAt->TooltipValue = "";

		// labor_fee
		$this->labor_fee->LinkCustomAttributes = "";
		$this->labor_fee->HrefValue = "";
		$this->labor_fee->TooltipValue = "";

		// applicable
		$this->applicable->LinkCustomAttributes = "";
		$this->applicable->HrefValue = "";
		$this->applicable->TooltipValue = "";

		// service_type
		$this->service_type->LinkCustomAttributes = "";
		$this->service_type->HrefValue = "";
		$this->service_type->TooltipValue = "";

		// goods_category
		$this->goods_category->LinkCustomAttributes = "";
		$this->goods_category->HrefValue = "";
		$this->goods_category->TooltipValue = "";

		// goods_weight
		$this->goods_weight->LinkCustomAttributes = "";
		$this->goods_weight->HrefValue = "";
		$this->goods_weight->TooltipValue = "";

		// image1_id
		$this->image1_id->LinkCustomAttributes = "";
		$this->image1_id->HrefValue = "";
		$this->image1_id->TooltipValue = "";

		// image2_id
		$this->image2_id->LinkCustomAttributes = "";
		$this->image2_id->HrefValue = "";
		$this->image2_id->TooltipValue = "";

		// image3_id
		$this->image3_id->LinkCustomAttributes = "";
		$this->image3_id->HrefValue = "";
		$this->image3_id->TooltipValue = "";

		// image4_id
		$this->image4_id->LinkCustomAttributes = "";
		$this->image4_id->HrefValue = "";
		$this->image4_id->TooltipValue = "";

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

		// from_place
		$this->from_place->EditAttrs["class"] = "form-control";
		$this->from_place->EditCustomAttributes = "";
		$this->from_place->EditValue = $this->from_place->CurrentValue;
		$this->from_place->PlaceHolder = RemoveHtml($this->from_place->caption());

		// to_place
		$this->to_place->EditAttrs["class"] = "form-control";
		$this->to_place->EditCustomAttributes = "";
		$this->to_place->EditValue = $this->to_place->CurrentValue;
		$this->to_place->PlaceHolder = RemoveHtml($this->to_place->caption());

		// description
		$this->description->EditAttrs["class"] = "form-control";
		$this->description->EditCustomAttributes = "";
		$this->description->EditValue = $this->description->CurrentValue;
		$this->description->PlaceHolder = RemoveHtml($this->description->caption());

		// user_id
		$this->user_id->EditAttrs["class"] = "form-control";
		$this->user_id->EditCustomAttributes = "";
		$this->user_id->EditValue = $this->user_id->CurrentValue;
		$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

		// from_date
		$this->from_date->EditAttrs["class"] = "form-control";
		$this->from_date->EditCustomAttributes = "";
		$this->from_date->EditValue = FormatDateTime($this->from_date->CurrentValue, 8);
		$this->from_date->PlaceHolder = RemoveHtml($this->from_date->caption());

		// to_date
		$this->to_date->EditAttrs["class"] = "form-control";
		$this->to_date->EditCustomAttributes = "";
		$this->to_date->EditValue = FormatDateTime($this->to_date->CurrentValue, 8);
		$this->to_date->PlaceHolder = RemoveHtml($this->to_date->caption());

		// createdAt
		$this->createdAt->EditAttrs["class"] = "form-control";
		$this->createdAt->EditCustomAttributes = "";
		$this->createdAt->EditValue = FormatDateTime($this->createdAt->CurrentValue, 8);
		$this->createdAt->PlaceHolder = RemoveHtml($this->createdAt->caption());

		// updatedAt
		$this->updatedAt->EditAttrs["class"] = "form-control";
		$this->updatedAt->EditCustomAttributes = "";
		$this->updatedAt->EditValue = FormatDateTime($this->updatedAt->CurrentValue, 8);
		$this->updatedAt->PlaceHolder = RemoveHtml($this->updatedAt->caption());

		// labor_fee
		$this->labor_fee->EditAttrs["class"] = "form-control";
		$this->labor_fee->EditCustomAttributes = "";
		$this->labor_fee->EditValue = $this->labor_fee->CurrentValue;
		$this->labor_fee->PlaceHolder = RemoveHtml($this->labor_fee->caption());

		// applicable
		$this->applicable->EditAttrs["class"] = "form-control";
		$this->applicable->EditCustomAttributes = "";
		$this->applicable->EditValue = $this->applicable->CurrentValue;
		$this->applicable->PlaceHolder = RemoveHtml($this->applicable->caption());

		// service_type
		$this->service_type->EditAttrs["class"] = "form-control";
		$this->service_type->EditCustomAttributes = "";
		$this->service_type->EditValue = $this->service_type->CurrentValue;
		$this->service_type->PlaceHolder = RemoveHtml($this->service_type->caption());

		// goods_category
		$this->goods_category->EditAttrs["class"] = "form-control";
		$this->goods_category->EditCustomAttributes = "";
		$this->goods_category->EditValue = $this->goods_category->CurrentValue;
		$this->goods_category->PlaceHolder = RemoveHtml($this->goods_category->caption());

		// goods_weight
		$this->goods_weight->EditAttrs["class"] = "form-control";
		$this->goods_weight->EditCustomAttributes = "";
		$this->goods_weight->EditValue = $this->goods_weight->CurrentValue;
		$this->goods_weight->PlaceHolder = RemoveHtml($this->goods_weight->caption());

		// image1_id
		$this->image1_id->EditAttrs["class"] = "form-control";
		$this->image1_id->EditCustomAttributes = "";
		$this->image1_id->EditValue = $this->image1_id->CurrentValue;
		$this->image1_id->PlaceHolder = RemoveHtml($this->image1_id->caption());

		// image2_id
		$this->image2_id->EditAttrs["class"] = "form-control";
		$this->image2_id->EditCustomAttributes = "";
		$this->image2_id->EditValue = $this->image2_id->CurrentValue;
		$this->image2_id->PlaceHolder = RemoveHtml($this->image2_id->caption());

		// image3_id
		$this->image3_id->EditAttrs["class"] = "form-control";
		$this->image3_id->EditCustomAttributes = "";
		$this->image3_id->EditValue = $this->image3_id->CurrentValue;
		$this->image3_id->PlaceHolder = RemoveHtml($this->image3_id->caption());

		// image4_id
		$this->image4_id->EditAttrs["class"] = "form-control";
		$this->image4_id->EditCustomAttributes = "";
		$this->image4_id->EditValue = $this->image4_id->CurrentValue;
		$this->image4_id->PlaceHolder = RemoveHtml($this->image4_id->caption());

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
					if ($this->from_place->Exportable)
						$doc->exportCaption($this->from_place);
					if ($this->to_place->Exportable)
						$doc->exportCaption($this->to_place);
					if ($this->description->Exportable)
						$doc->exportCaption($this->description);
					if ($this->user_id->Exportable)
						$doc->exportCaption($this->user_id);
					if ($this->from_date->Exportable)
						$doc->exportCaption($this->from_date);
					if ($this->to_date->Exportable)
						$doc->exportCaption($this->to_date);
					if ($this->createdAt->Exportable)
						$doc->exportCaption($this->createdAt);
					if ($this->updatedAt->Exportable)
						$doc->exportCaption($this->updatedAt);
					if ($this->labor_fee->Exportable)
						$doc->exportCaption($this->labor_fee);
					if ($this->applicable->Exportable)
						$doc->exportCaption($this->applicable);
					if ($this->service_type->Exportable)
						$doc->exportCaption($this->service_type);
					if ($this->goods_category->Exportable)
						$doc->exportCaption($this->goods_category);
					if ($this->goods_weight->Exportable)
						$doc->exportCaption($this->goods_weight);
					if ($this->image1_id->Exportable)
						$doc->exportCaption($this->image1_id);
					if ($this->image2_id->Exportable)
						$doc->exportCaption($this->image2_id);
					if ($this->image3_id->Exportable)
						$doc->exportCaption($this->image3_id);
					if ($this->image4_id->Exportable)
						$doc->exportCaption($this->image4_id);
				} else {
					if ($this->id->Exportable)
						$doc->exportCaption($this->id);
					if ($this->from_place->Exportable)
						$doc->exportCaption($this->from_place);
					if ($this->to_place->Exportable)
						$doc->exportCaption($this->to_place);
					if ($this->description->Exportable)
						$doc->exportCaption($this->description);
					if ($this->user_id->Exportable)
						$doc->exportCaption($this->user_id);
					if ($this->from_date->Exportable)
						$doc->exportCaption($this->from_date);
					if ($this->to_date->Exportable)
						$doc->exportCaption($this->to_date);
					if ($this->createdAt->Exportable)
						$doc->exportCaption($this->createdAt);
					if ($this->updatedAt->Exportable)
						$doc->exportCaption($this->updatedAt);
					if ($this->labor_fee->Exportable)
						$doc->exportCaption($this->labor_fee);
					if ($this->applicable->Exportable)
						$doc->exportCaption($this->applicable);
					if ($this->service_type->Exportable)
						$doc->exportCaption($this->service_type);
					if ($this->goods_category->Exportable)
						$doc->exportCaption($this->goods_category);
					if ($this->goods_weight->Exportable)
						$doc->exportCaption($this->goods_weight);
					if ($this->image1_id->Exportable)
						$doc->exportCaption($this->image1_id);
					if ($this->image2_id->Exportable)
						$doc->exportCaption($this->image2_id);
					if ($this->image3_id->Exportable)
						$doc->exportCaption($this->image3_id);
					if ($this->image4_id->Exportable)
						$doc->exportCaption($this->image4_id);
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
						if ($this->from_place->Exportable)
							$doc->exportField($this->from_place);
						if ($this->to_place->Exportable)
							$doc->exportField($this->to_place);
						if ($this->description->Exportable)
							$doc->exportField($this->description);
						if ($this->user_id->Exportable)
							$doc->exportField($this->user_id);
						if ($this->from_date->Exportable)
							$doc->exportField($this->from_date);
						if ($this->to_date->Exportable)
							$doc->exportField($this->to_date);
						if ($this->createdAt->Exportable)
							$doc->exportField($this->createdAt);
						if ($this->updatedAt->Exportable)
							$doc->exportField($this->updatedAt);
						if ($this->labor_fee->Exportable)
							$doc->exportField($this->labor_fee);
						if ($this->applicable->Exportable)
							$doc->exportField($this->applicable);
						if ($this->service_type->Exportable)
							$doc->exportField($this->service_type);
						if ($this->goods_category->Exportable)
							$doc->exportField($this->goods_category);
						if ($this->goods_weight->Exportable)
							$doc->exportField($this->goods_weight);
						if ($this->image1_id->Exportable)
							$doc->exportField($this->image1_id);
						if ($this->image2_id->Exportable)
							$doc->exportField($this->image2_id);
						if ($this->image3_id->Exportable)
							$doc->exportField($this->image3_id);
						if ($this->image4_id->Exportable)
							$doc->exportField($this->image4_id);
					} else {
						if ($this->id->Exportable)
							$doc->exportField($this->id);
						if ($this->from_place->Exportable)
							$doc->exportField($this->from_place);
						if ($this->to_place->Exportable)
							$doc->exportField($this->to_place);
						if ($this->description->Exportable)
							$doc->exportField($this->description);
						if ($this->user_id->Exportable)
							$doc->exportField($this->user_id);
						if ($this->from_date->Exportable)
							$doc->exportField($this->from_date);
						if ($this->to_date->Exportable)
							$doc->exportField($this->to_date);
						if ($this->createdAt->Exportable)
							$doc->exportField($this->createdAt);
						if ($this->updatedAt->Exportable)
							$doc->exportField($this->updatedAt);
						if ($this->labor_fee->Exportable)
							$doc->exportField($this->labor_fee);
						if ($this->applicable->Exportable)
							$doc->exportField($this->applicable);
						if ($this->service_type->Exportable)
							$doc->exportField($this->service_type);
						if ($this->goods_category->Exportable)
							$doc->exportField($this->goods_category);
						if ($this->goods_weight->Exportable)
							$doc->exportField($this->goods_weight);
						if ($this->image1_id->Exportable)
							$doc->exportField($this->image1_id);
						if ($this->image2_id->Exportable)
							$doc->exportField($this->image2_id);
						if ($this->image3_id->Exportable)
							$doc->exportField($this->image3_id);
						if ($this->image4_id->Exportable)
							$doc->exportField($this->image4_id);
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

		// No binary fields
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
