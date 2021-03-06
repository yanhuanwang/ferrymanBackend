<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class request_trip_search extends request_trip
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'request_trip';

	// Page object name
	public $PageObjName = "request_trip_search";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;
	public $CheckTokenFn = PROJECT_NAMESPACE . "CheckToken";
	public $CreateTokenFn = PROJECT_NAMESPACE . "CreateToken";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Message
	public function getMessage()
	{
		return @$_SESSION[SESSION_MESSAGE];
	}
	public function setMessage($v)
	{
		AddMessage($_SESSION[SESSION_MESSAGE], $v);
	}
	public function getFailureMessage()
	{
		return @$_SESSION[SESSION_FAILURE_MESSAGE];
	}
	public function setFailureMessage($v)
	{
		AddMessage($_SESSION[SESSION_FAILURE_MESSAGE], $v);
	}
	public function getSuccessMessage()
	{
		return @$_SESSION[SESSION_SUCCESS_MESSAGE];
	}
	public function setSuccessMessage($v)
	{
		AddMessage($_SESSION[SESSION_SUCCESS_MESSAGE], $v);
	}
	public function getWarningMessage()
	{
		return @$_SESSION[SESSION_WARNING_MESSAGE];
	}
	public function setWarningMessage($v)
	{
		AddMessage($_SESSION[SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	public function clearMessage()
	{
		$_SESSION[SESSION_MESSAGE] = "";
	}
	public function clearFailureMessage()
	{
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}
	public function clearSuccessMessage()
	{
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}
	public function clearWarningMessage()
	{
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}
	public function clearMessages()
	{
		$_SESSION[SESSION_MESSAGE] = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessageAsArray()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") <> "")
				return ($this->TableVar == Get("t"));
		} else {
			return TRUE;
		}
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;

		//if ($this->CheckToken) { // Always create token, required by API file/lookup request
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$CurrentToken = $this->Token; // Save to global variable

		//}
	}

	//
	// Page class constructor
	//

	public function __construct()
	{
		global $Conn, $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Validate configuration
		if (!IS_PHP5)
			die("This script requires PHP 5.5 or later, but you are running " . phpversion() . ".");
		if (!function_exists("xml_parser_create"))
			die("This script requires PHP XML Parser.");
		if (!IS_WINDOWS && IS_MSACCESS)
			die("Microsoft Access is supported on Windows server only.");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (request_trip)
		if (!isset($GLOBALS["request_trip"]) || get_class($GLOBALS["request_trip"]) == PROJECT_NAMESPACE . "request_trip") {
			$GLOBALS["request_trip"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["request_trip"];
		}

		// Table object (admin)
		if (!isset($GLOBALS['admin'])) $GLOBALS['admin'] = new admin();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'request_trip');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($Conn))
			$Conn = GetConnection($this->Dbid);

		// User table object (admin)
		if (!isset($UserTable)) {
			$UserTable = new admin();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	//
	// Terminate page
	//

	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $request_trip;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($request_trip);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessageAsArray()));
			exit();
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "request_tripview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson([$row]);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") // Upload field
						if (EmptyValue($val))
							$row[$fldname] = NULL;
						else

							//$row[$fldname] = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
							$row[$fldname] = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
					else
						$row[$fldname] = $val;
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (!$Security->isLoggedIn()) $Security->autoLogin();
			if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("request_triplist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->from_place->setVisibility();
		$this->to_place->setVisibility();
		$this->description->setVisibility();
		$this->user_id->setVisibility();
		$this->from_date->setVisibility();
		$this->to_date->setVisibility();
		$this->createdAt->setVisibility();
		$this->updatedAt->setVisibility();
		$this->labor_fee->setVisibility();
		$this->applicable->setVisibility();
		$this->service_type->setVisibility();
		$this->goods_category->setVisibility();
		$this->goods_weight->setVisibility();
		$this->image1_id->setVisibility();
		$this->image2_id->setVisibility();
		$this->image3_id->setVisibility();
		$this->image4_id->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->Phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Set up Breadcrumb

		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr <> "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "request_triplist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->id); // id
		$this->buildSearchUrl($srchUrl, $this->from_place); // from_place
		$this->buildSearchUrl($srchUrl, $this->to_place); // to_place
		$this->buildSearchUrl($srchUrl, $this->description); // description
		$this->buildSearchUrl($srchUrl, $this->user_id); // user_id
		$this->buildSearchUrl($srchUrl, $this->from_date); // from_date
		$this->buildSearchUrl($srchUrl, $this->to_date); // to_date
		$this->buildSearchUrl($srchUrl, $this->createdAt); // createdAt
		$this->buildSearchUrl($srchUrl, $this->updatedAt); // updatedAt
		$this->buildSearchUrl($srchUrl, $this->labor_fee); // labor_fee
		$this->buildSearchUrl($srchUrl, $this->applicable); // applicable
		$this->buildSearchUrl($srchUrl, $this->service_type); // service_type
		$this->buildSearchUrl($srchUrl, $this->goods_category); // goods_category
		$this->buildSearchUrl($srchUrl, $this->goods_weight); // goods_weight
		$this->buildSearchUrl($srchUrl, $this->image1_id); // image1_id
		$this->buildSearchUrl($srchUrl, $this->image2_id); // image2_id
		$this->buildSearchUrl($srchUrl, $this->image3_id); // image3_id
		$this->buildSearchUrl($srchUrl, $this->image4_id); // image4_id
		if ($srchUrl <> "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal <> "" && $fldVal2 <> "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal <> "" && $isValidValue && IsValidOpr($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr <> "" && $oprOnly && IsValidOpr($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType <> DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 <> "" && $isValidValue && IsValidOpr($fldOpr2, $fldDataType)) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 <> "" && $oprOnly && IsValidOpr($fldOpr2, $fldDataType))) {
				if ($wrk <> "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk <> "") {
			if ($url <> "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_id"));
		$this->id->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_id"));

		// from_place
		$this->from_place->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_from_place"));
		$this->from_place->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_from_place"));

		// to_place
		$this->to_place->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_to_place"));
		$this->to_place->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_to_place"));

		// description
		$this->description->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_description"));
		$this->description->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_description"));

		// user_id
		$this->user_id->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_user_id"));
		$this->user_id->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_user_id"));

		// from_date
		$this->from_date->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_from_date"));
		$this->from_date->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_from_date"));

		// to_date
		$this->to_date->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_to_date"));
		$this->to_date->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_to_date"));

		// createdAt
		$this->createdAt->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_createdAt"));
		$this->createdAt->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_createdAt"));

		// updatedAt
		$this->updatedAt->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_updatedAt"));
		$this->updatedAt->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_updatedAt"));

		// labor_fee
		$this->labor_fee->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_labor_fee"));
		$this->labor_fee->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_labor_fee"));

		// applicable
		$this->applicable->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_applicable"));
		$this->applicable->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_applicable"));

		// service_type
		$this->service_type->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_service_type"));
		$this->service_type->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_service_type"));

		// goods_category
		$this->goods_category->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_goods_category"));
		$this->goods_category->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_goods_category"));

		// goods_weight
		$this->goods_weight->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_goods_weight"));
		$this->goods_weight->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_goods_weight"));

		// image1_id
		$this->image1_id->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_image1_id"));
		$this->image1_id->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_image1_id"));

		// image2_id
		$this->image2_id->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_image2_id"));
		$this->image2_id->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_image2_id"));

		// image3_id
		$this->image3_id->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_image3_id"));
		$this->image3_id->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_image3_id"));

		// image4_id
		$this->image4_id->AdvancedSearch->setSearchValue($CurrentForm->getValue("x_image4_id"));
		$this->image4_id->AdvancedSearch->setSearchOperator($CurrentForm->getValue("z_image4_id"));
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
			$this->id->PlaceHolder = RemoveHtml($this->id->caption());

			// from_place
			$this->from_place->EditAttrs["class"] = "form-control";
			$this->from_place->EditCustomAttributes = "";
			$this->from_place->EditValue = HtmlEncode($this->from_place->AdvancedSearch->SearchValue);
			$this->from_place->PlaceHolder = RemoveHtml($this->from_place->caption());

			// to_place
			$this->to_place->EditAttrs["class"] = "form-control";
			$this->to_place->EditCustomAttributes = "";
			$this->to_place->EditValue = HtmlEncode($this->to_place->AdvancedSearch->SearchValue);
			$this->to_place->PlaceHolder = RemoveHtml($this->to_place->caption());

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = HtmlEncode($this->description->AdvancedSearch->SearchValue);
			$this->description->PlaceHolder = RemoveHtml($this->description->caption());

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = HtmlEncode($this->user_id->AdvancedSearch->SearchValue);
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

			// from_date
			$this->from_date->EditAttrs["class"] = "form-control";
			$this->from_date->EditCustomAttributes = "";
			$this->from_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->from_date->AdvancedSearch->SearchValue, 0), 8));
			$this->from_date->PlaceHolder = RemoveHtml($this->from_date->caption());

			// to_date
			$this->to_date->EditAttrs["class"] = "form-control";
			$this->to_date->EditCustomAttributes = "";
			$this->to_date->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->to_date->AdvancedSearch->SearchValue, 0), 8));
			$this->to_date->PlaceHolder = RemoveHtml($this->to_date->caption());

			// createdAt
			$this->createdAt->EditAttrs["class"] = "form-control";
			$this->createdAt->EditCustomAttributes = "";
			$this->createdAt->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->createdAt->AdvancedSearch->SearchValue, 0), 8));
			$this->createdAt->PlaceHolder = RemoveHtml($this->createdAt->caption());

			// updatedAt
			$this->updatedAt->EditAttrs["class"] = "form-control";
			$this->updatedAt->EditCustomAttributes = "";
			$this->updatedAt->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->updatedAt->AdvancedSearch->SearchValue, 0), 8));
			$this->updatedAt->PlaceHolder = RemoveHtml($this->updatedAt->caption());

			// labor_fee
			$this->labor_fee->EditAttrs["class"] = "form-control";
			$this->labor_fee->EditCustomAttributes = "";
			$this->labor_fee->EditValue = HtmlEncode($this->labor_fee->AdvancedSearch->SearchValue);
			$this->labor_fee->PlaceHolder = RemoveHtml($this->labor_fee->caption());

			// applicable
			$this->applicable->EditAttrs["class"] = "form-control";
			$this->applicable->EditCustomAttributes = "";
			$this->applicable->EditValue = HtmlEncode($this->applicable->AdvancedSearch->SearchValue);
			$this->applicable->PlaceHolder = RemoveHtml($this->applicable->caption());

			// service_type
			$this->service_type->EditAttrs["class"] = "form-control";
			$this->service_type->EditCustomAttributes = "";
			$this->service_type->EditValue = HtmlEncode($this->service_type->AdvancedSearch->SearchValue);
			$this->service_type->PlaceHolder = RemoveHtml($this->service_type->caption());

			// goods_category
			$this->goods_category->EditAttrs["class"] = "form-control";
			$this->goods_category->EditCustomAttributes = "";
			$this->goods_category->EditValue = HtmlEncode($this->goods_category->AdvancedSearch->SearchValue);
			$this->goods_category->PlaceHolder = RemoveHtml($this->goods_category->caption());

			// goods_weight
			$this->goods_weight->EditAttrs["class"] = "form-control";
			$this->goods_weight->EditCustomAttributes = "";
			$this->goods_weight->EditValue = HtmlEncode($this->goods_weight->AdvancedSearch->SearchValue);
			$this->goods_weight->PlaceHolder = RemoveHtml($this->goods_weight->caption());

			// image1_id
			$this->image1_id->EditAttrs["class"] = "form-control";
			$this->image1_id->EditCustomAttributes = "";
			$this->image1_id->EditValue = HtmlEncode($this->image1_id->AdvancedSearch->SearchValue);
			$this->image1_id->PlaceHolder = RemoveHtml($this->image1_id->caption());

			// image2_id
			$this->image2_id->EditAttrs["class"] = "form-control";
			$this->image2_id->EditCustomAttributes = "";
			$this->image2_id->EditValue = HtmlEncode($this->image2_id->AdvancedSearch->SearchValue);
			$this->image2_id->PlaceHolder = RemoveHtml($this->image2_id->caption());

			// image3_id
			$this->image3_id->EditAttrs["class"] = "form-control";
			$this->image3_id->EditCustomAttributes = "";
			$this->image3_id->EditValue = HtmlEncode($this->image3_id->AdvancedSearch->SearchValue);
			$this->image3_id->PlaceHolder = RemoveHtml($this->image3_id->caption());

			// image4_id
			$this->image4_id->EditAttrs["class"] = "form-control";
			$this->image4_id->EditCustomAttributes = "";
			$this->image4_id->EditValue = HtmlEncode($this->image4_id->AdvancedSearch->SearchValue);
			$this->image4_id->PlaceHolder = RemoveHtml($this->image4_id->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return TRUE;
		if (!CheckInteger($this->id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->id->errorMessage());
		}
		if (!CheckInteger($this->user_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->user_id->errorMessage());
		}
		if (!CheckDate($this->from_date->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->from_date->errorMessage());
		}
		if (!CheckDate($this->to_date->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->to_date->errorMessage());
		}
		if (!CheckDate($this->createdAt->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->createdAt->errorMessage());
		}
		if (!CheckDate($this->updatedAt->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->updatedAt->errorMessage());
		}
		if (!CheckInteger($this->labor_fee->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->labor_fee->errorMessage());
		}
		if (!CheckInteger($this->applicable->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->applicable->errorMessage());
		}
		if (!CheckInteger($this->service_type->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->service_type->errorMessage());
		}
		if (!CheckInteger($this->goods_category->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->goods_category->errorMessage());
		}
		if (!CheckInteger($this->goods_weight->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->goods_weight->errorMessage());
		}
		if (!CheckInteger($this->image1_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->image1_id->errorMessage());
		}
		if (!CheckInteger($this->image2_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->image2_id->errorMessage());
		}
		if (!CheckInteger($this->image3_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->image3_id->errorMessage());
		}
		if (!CheckInteger($this->image4_id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->image4_id->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->id->AdvancedSearch->load();
		$this->from_place->AdvancedSearch->load();
		$this->to_place->AdvancedSearch->load();
		$this->description->AdvancedSearch->load();
		$this->user_id->AdvancedSearch->load();
		$this->from_date->AdvancedSearch->load();
		$this->to_date->AdvancedSearch->load();
		$this->createdAt->AdvancedSearch->load();
		$this->updatedAt->AdvancedSearch->load();
		$this->labor_fee->AdvancedSearch->load();
		$this->applicable->AdvancedSearch->load();
		$this->service_type->AdvancedSearch->load();
		$this->goods_category->AdvancedSearch->load();
		$this->goods_weight->AdvancedSearch->load();
		$this->image1_id->AdvancedSearch->load();
		$this->image2_id->AdvancedSearch->load();
		$this->image3_id->AdvancedSearch->load();
		$this->image4_id->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("request_triplist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
