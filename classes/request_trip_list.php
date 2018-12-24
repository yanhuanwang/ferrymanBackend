<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class request_trip_list extends request_trip
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'request_trip';

	// Page object name
	public $PageObjName = "request_trip_list";

	// Grid form hidden field names
	public $FormName = "frequest_triplist";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->AddUrl = "request_tripadd.php";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "request_tripdelete.php";
		$this->MultiUpdateUrl = "request_tripupdate.php";

		// Table object (admin)
		if (!isset($GLOBALS['admin'])) $GLOBALS['admin'] = new admin();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new ListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions();
		$this->ImportOptions->Tag = "div";
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		$this->OtherOptions["addedit"] = new ListOptions();
		$this->OtherOptions["addedit"]->Tag = "div";
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions();
		$this->OtherOptions["detail"]->Tag = "div";
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions();
		$this->OtherOptions["action"]->Tag = "div";
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ew-filter-option frequest_triplistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
			SaveDebugMessage();
			AddHeader("Location", $url);
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions = array(); // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $DisplayRecs = 20;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $AutoHidePageSizeSelector = AUTO_HIDE_PAGE_SIZE_SELECTOR;
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $RecCnt = 0; // Record count
	public $EditRowCnt;
	public $StartRowCnt = 1;
	public $RowCnt = 0;
	public $Attrs = array(); // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SearchError, $EXPORT;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined(PROJECT_NAMESPACE . "USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined(PROJECT_NAMESPACE . "USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(TABLE_GRID_ADD_ROW_COUNT, "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->id->Visible = FALSE;
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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		// Search filters

		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecs();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

			// Check QueryString parameters
			if (Get("action") !== NULL) {
				$this->CurrentAction = Get("action");

				// Clear inline mode
				if ($this->isCancel())
					$this->clearInlineMode();

				// Switch to grid edit mode
				if ($this->isGridEdit())
					$this->gridEditMode();

				// Switch to inline edit mode
				if ($this->isEdit())
					$this->inlineEditMode();

				// Switch to inline add mode
				if ($this->isAdd() || $this->isCopy())
					$this->inlineAddMode();

				// Switch to grid add mode
				if ($this->isGridAdd())
					$this->gridAddMode();
			} else {
				if (Post("action") !== NULL) {
					$this->CurrentAction = Post("action"); // Get action

					// Grid Update
					if (($this->isGridUpdate() || $this->isGridOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "gridedit") {
						if ($this->validateGridForm()) {
							$gridUpdate = $this->gridUpdate();
						} else {
							$gridUpdate = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridUpdate) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridEditMode(); // Stay in Grid edit mode
						}
					}

					// Inline Update
					if (($this->isUpdate() || $this->isOverwrite()) && @$_SESSION[SESSION_INLINE_MODE] == "edit")
						$this->inlineUpdate();

					// Insert Inline
					if ($this->isInsert() && @$_SESSION[SESSION_INLINE_MODE] == "add")
						$this->inlineInsert();

					// Grid Insert
					if ($this->isGridInsert() && @$_SESSION[SESSION_INLINE_MODE] == "gridadd") {
						if ($this->validateGridForm()) {
							$gridInsert = $this->gridInsert();
						} else {
							$gridInsert = FALSE;
							$this->setFailureMessage($FormError);
						}
						if ($gridInsert) {
						} else {
							$this->EventCancelled = TRUE;
							$this->gridAddMode(); // Stay in Grid add mode
						}
					}
				} elseif (@$_SESSION[SESSION_INLINE_MODE] == "gridedit") { // Previously in grid edit mode
					if (Get(TABLE_START_REC) !== NULL || Get(TABLE_PAGE_NO) !== NULL) // Stay in grid edit mode if paging
						$this->gridEditMode();
					else // Reset grid edit
						$this->clearInlineMode();
				}
			}

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport()) {
				foreach ($this->OtherOptions as &$option)
					$option->hideAllOptions();
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions->getItem("griddelete");
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->loadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys($EXPORT))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRec = 1;
			$this->DisplayRecs = $this->GridAddRowCount;
			$this->TotalRecs = $this->DisplayRecs;
			$this->StopRec = $this->DisplayRecs;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecs = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
			$this->StartRec = 1;
			if ($this->DisplayRecs <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecs = $this->TotalRecs;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRec();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecs == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->Phrase("NoRecord"));
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecs()
	{
		$wrk = Get(TABLE_REC_PER_PAGE, "");
		if ($wrk <> "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecs = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->setKey("id", ""); // Clear inline edit key
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Inline Edit mode
	protected function inlineEditMode()
	{
		global $Security, $Language;
		if (!$Security->canEdit())
			return FALSE; // Edit not allowed
		$inlineEdit = TRUE;
		if (Get("id") !== NULL) {
			$this->id->setQueryStringValue(Get("id"));
		} else {
			$inlineEdit = FALSE;
		}
		if ($inlineEdit) {
			if ($this->loadRow()) {
				$this->setKey("id", $this->id->CurrentValue); // Set up inline edit key
				$_SESSION[SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
		return TRUE;
	}

	// Perform update to Inline Edit record
	protected function inlineUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$CurrentForm->Index = 1;
		$this->loadFormValues(); // Get form values

		// Validate form
		$inlineUpdate = TRUE;
		if (!$this->validateForm()) {
			$inlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($FormError);
		} else {
			$inlineUpdate = FALSE;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			if ($this->setupKeyValues($rowkey)) { // Set up key values
				if ($this->checkInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$inlineUpdate = $this->editRow(); // Update record
				} else {
					$inlineUpdate = FALSE;
				}
			}
		}
		if ($inlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	public function checkInlineEditKey()
	{
		if (strval($this->getKey("id")) <> strval($this->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	protected function inlineAddMode()
	{
		global $Security, $Language;
		if (!$Security->canAdd())
			return FALSE; // Add not allowed
		if ($this->isCopy()) {
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CurrentAction = "add";
			}
		}
		$_SESSION[SESSION_INLINE_MODE] = "add"; // Enable inline add
		return TRUE;
	}

	// Perform update to Inline Add/Copy record
	protected function inlineInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$this->loadOldRecord(); // Load old record
		$CurrentForm->Index = 0;
		$this->loadFormValues(); // Get form values

		// Validate form
		if (!$this->validateForm()) {
			$this->setFailureMessage($FormError); // Set validation error message
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$this->SendEmail = TRUE; // Send email on add success
		if ($this->addRow($this->OldRecordset)) { // Add record
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up add success message
			$this->clearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$this->EventCancelled = TRUE; // Set event cancelled
			$this->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key <> "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey <> "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter <> "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode($GLOBALS["COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setFormValue($arKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = &$this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Begin transaction
		$conn->beginTrans();

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key <> "")
						$key .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
					$key .= $this->id->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter <> "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$gridInsert = FALSE;
		}
		if ($gridInsert) {
			$conn->commitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			$conn->rollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_from_place") && $CurrentForm->hasValue("o_from_place") && $this->from_place->CurrentValue <> $this->from_place->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_to_place") && $CurrentForm->hasValue("o_to_place") && $this->to_place->CurrentValue <> $this->to_place->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_description") && $CurrentForm->hasValue("o_description") && $this->description->CurrentValue <> $this->description->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_user_id") && $CurrentForm->hasValue("o_user_id") && $this->user_id->CurrentValue <> $this->user_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_from_date") && $CurrentForm->hasValue("o_from_date") && $this->from_date->CurrentValue <> $this->from_date->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_to_date") && $CurrentForm->hasValue("o_to_date") && $this->to_date->CurrentValue <> $this->to_date->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_createdAt") && $CurrentForm->hasValue("o_createdAt") && $this->createdAt->CurrentValue <> $this->createdAt->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_updatedAt") && $CurrentForm->hasValue("o_updatedAt") && $this->updatedAt->CurrentValue <> $this->updatedAt->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_labor_fee") && $CurrentForm->hasValue("o_labor_fee") && $this->labor_fee->CurrentValue <> $this->labor_fee->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_applicable") && $CurrentForm->hasValue("o_applicable") && $this->applicable->CurrentValue <> $this->applicable->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_service_type") && $CurrentForm->hasValue("o_service_type") && $this->service_type->CurrentValue <> $this->service_type->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_goods_category") && $CurrentForm->hasValue("o_goods_category") && $this->goods_category->CurrentValue <> $this->goods_category->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_goods_weight") && $CurrentForm->hasValue("o_goods_weight") && $this->goods_weight->CurrentValue <> $this->goods_weight->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_image1_id") && $CurrentForm->hasValue("o_image1_id") && $this->image1_id->CurrentValue <> $this->image1_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_image2_id") && $CurrentForm->hasValue("o_image2_id") && $this->image2_id->CurrentValue <> $this->image2_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_image3_id") && $CurrentForm->hasValue("o_image3_id") && $this->image3_id->CurrentValue <> $this->image3_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_image4_id") && $CurrentForm->hasValue("o_image4_id") && $this->image4_id->CurrentValue <> $this->image4_id->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->from_place->AdvancedSearch->toJson(), ","); // Field from_place
		$filterList = Concat($filterList, $this->to_place->AdvancedSearch->toJson(), ","); // Field to_place
		$filterList = Concat($filterList, $this->description->AdvancedSearch->toJson(), ","); // Field description
		$filterList = Concat($filterList, $this->user_id->AdvancedSearch->toJson(), ","); // Field user_id
		$filterList = Concat($filterList, $this->from_date->AdvancedSearch->toJson(), ","); // Field from_date
		$filterList = Concat($filterList, $this->to_date->AdvancedSearch->toJson(), ","); // Field to_date
		$filterList = Concat($filterList, $this->createdAt->AdvancedSearch->toJson(), ","); // Field createdAt
		$filterList = Concat($filterList, $this->updatedAt->AdvancedSearch->toJson(), ","); // Field updatedAt
		$filterList = Concat($filterList, $this->labor_fee->AdvancedSearch->toJson(), ","); // Field labor_fee
		$filterList = Concat($filterList, $this->applicable->AdvancedSearch->toJson(), ","); // Field applicable
		$filterList = Concat($filterList, $this->service_type->AdvancedSearch->toJson(), ","); // Field service_type
		$filterList = Concat($filterList, $this->goods_category->AdvancedSearch->toJson(), ","); // Field goods_category
		$filterList = Concat($filterList, $this->goods_weight->AdvancedSearch->toJson(), ","); // Field goods_weight
		$filterList = Concat($filterList, $this->image1_id->AdvancedSearch->toJson(), ","); // Field image1_id
		$filterList = Concat($filterList, $this->image2_id->AdvancedSearch->toJson(), ","); // Field image2_id
		$filterList = Concat($filterList, $this->image3_id->AdvancedSearch->toJson(), ","); // Field image3_id
		$filterList = Concat($filterList, $this->image4_id->AdvancedSearch->toJson(), ","); // Field image4_id
		if ($this->BasicSearch->Keyword <> "") {
			$wrk = "\"" . TABLE_BASIC_SEARCH . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . TABLE_BASIC_SEARCH_TYPE . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList <> "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList <> "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList <> "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "frequest_triplistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field from_place
		$this->from_place->AdvancedSearch->SearchValue = @$filter["x_from_place"];
		$this->from_place->AdvancedSearch->SearchOperator = @$filter["z_from_place"];
		$this->from_place->AdvancedSearch->SearchCondition = @$filter["v_from_place"];
		$this->from_place->AdvancedSearch->SearchValue2 = @$filter["y_from_place"];
		$this->from_place->AdvancedSearch->SearchOperator2 = @$filter["w_from_place"];
		$this->from_place->AdvancedSearch->save();

		// Field to_place
		$this->to_place->AdvancedSearch->SearchValue = @$filter["x_to_place"];
		$this->to_place->AdvancedSearch->SearchOperator = @$filter["z_to_place"];
		$this->to_place->AdvancedSearch->SearchCondition = @$filter["v_to_place"];
		$this->to_place->AdvancedSearch->SearchValue2 = @$filter["y_to_place"];
		$this->to_place->AdvancedSearch->SearchOperator2 = @$filter["w_to_place"];
		$this->to_place->AdvancedSearch->save();

		// Field description
		$this->description->AdvancedSearch->SearchValue = @$filter["x_description"];
		$this->description->AdvancedSearch->SearchOperator = @$filter["z_description"];
		$this->description->AdvancedSearch->SearchCondition = @$filter["v_description"];
		$this->description->AdvancedSearch->SearchValue2 = @$filter["y_description"];
		$this->description->AdvancedSearch->SearchOperator2 = @$filter["w_description"];
		$this->description->AdvancedSearch->save();

		// Field user_id
		$this->user_id->AdvancedSearch->SearchValue = @$filter["x_user_id"];
		$this->user_id->AdvancedSearch->SearchOperator = @$filter["z_user_id"];
		$this->user_id->AdvancedSearch->SearchCondition = @$filter["v_user_id"];
		$this->user_id->AdvancedSearch->SearchValue2 = @$filter["y_user_id"];
		$this->user_id->AdvancedSearch->SearchOperator2 = @$filter["w_user_id"];
		$this->user_id->AdvancedSearch->save();

		// Field from_date
		$this->from_date->AdvancedSearch->SearchValue = @$filter["x_from_date"];
		$this->from_date->AdvancedSearch->SearchOperator = @$filter["z_from_date"];
		$this->from_date->AdvancedSearch->SearchCondition = @$filter["v_from_date"];
		$this->from_date->AdvancedSearch->SearchValue2 = @$filter["y_from_date"];
		$this->from_date->AdvancedSearch->SearchOperator2 = @$filter["w_from_date"];
		$this->from_date->AdvancedSearch->save();

		// Field to_date
		$this->to_date->AdvancedSearch->SearchValue = @$filter["x_to_date"];
		$this->to_date->AdvancedSearch->SearchOperator = @$filter["z_to_date"];
		$this->to_date->AdvancedSearch->SearchCondition = @$filter["v_to_date"];
		$this->to_date->AdvancedSearch->SearchValue2 = @$filter["y_to_date"];
		$this->to_date->AdvancedSearch->SearchOperator2 = @$filter["w_to_date"];
		$this->to_date->AdvancedSearch->save();

		// Field createdAt
		$this->createdAt->AdvancedSearch->SearchValue = @$filter["x_createdAt"];
		$this->createdAt->AdvancedSearch->SearchOperator = @$filter["z_createdAt"];
		$this->createdAt->AdvancedSearch->SearchCondition = @$filter["v_createdAt"];
		$this->createdAt->AdvancedSearch->SearchValue2 = @$filter["y_createdAt"];
		$this->createdAt->AdvancedSearch->SearchOperator2 = @$filter["w_createdAt"];
		$this->createdAt->AdvancedSearch->save();

		// Field updatedAt
		$this->updatedAt->AdvancedSearch->SearchValue = @$filter["x_updatedAt"];
		$this->updatedAt->AdvancedSearch->SearchOperator = @$filter["z_updatedAt"];
		$this->updatedAt->AdvancedSearch->SearchCondition = @$filter["v_updatedAt"];
		$this->updatedAt->AdvancedSearch->SearchValue2 = @$filter["y_updatedAt"];
		$this->updatedAt->AdvancedSearch->SearchOperator2 = @$filter["w_updatedAt"];
		$this->updatedAt->AdvancedSearch->save();

		// Field labor_fee
		$this->labor_fee->AdvancedSearch->SearchValue = @$filter["x_labor_fee"];
		$this->labor_fee->AdvancedSearch->SearchOperator = @$filter["z_labor_fee"];
		$this->labor_fee->AdvancedSearch->SearchCondition = @$filter["v_labor_fee"];
		$this->labor_fee->AdvancedSearch->SearchValue2 = @$filter["y_labor_fee"];
		$this->labor_fee->AdvancedSearch->SearchOperator2 = @$filter["w_labor_fee"];
		$this->labor_fee->AdvancedSearch->save();

		// Field applicable
		$this->applicable->AdvancedSearch->SearchValue = @$filter["x_applicable"];
		$this->applicable->AdvancedSearch->SearchOperator = @$filter["z_applicable"];
		$this->applicable->AdvancedSearch->SearchCondition = @$filter["v_applicable"];
		$this->applicable->AdvancedSearch->SearchValue2 = @$filter["y_applicable"];
		$this->applicable->AdvancedSearch->SearchOperator2 = @$filter["w_applicable"];
		$this->applicable->AdvancedSearch->save();

		// Field service_type
		$this->service_type->AdvancedSearch->SearchValue = @$filter["x_service_type"];
		$this->service_type->AdvancedSearch->SearchOperator = @$filter["z_service_type"];
		$this->service_type->AdvancedSearch->SearchCondition = @$filter["v_service_type"];
		$this->service_type->AdvancedSearch->SearchValue2 = @$filter["y_service_type"];
		$this->service_type->AdvancedSearch->SearchOperator2 = @$filter["w_service_type"];
		$this->service_type->AdvancedSearch->save();

		// Field goods_category
		$this->goods_category->AdvancedSearch->SearchValue = @$filter["x_goods_category"];
		$this->goods_category->AdvancedSearch->SearchOperator = @$filter["z_goods_category"];
		$this->goods_category->AdvancedSearch->SearchCondition = @$filter["v_goods_category"];
		$this->goods_category->AdvancedSearch->SearchValue2 = @$filter["y_goods_category"];
		$this->goods_category->AdvancedSearch->SearchOperator2 = @$filter["w_goods_category"];
		$this->goods_category->AdvancedSearch->save();

		// Field goods_weight
		$this->goods_weight->AdvancedSearch->SearchValue = @$filter["x_goods_weight"];
		$this->goods_weight->AdvancedSearch->SearchOperator = @$filter["z_goods_weight"];
		$this->goods_weight->AdvancedSearch->SearchCondition = @$filter["v_goods_weight"];
		$this->goods_weight->AdvancedSearch->SearchValue2 = @$filter["y_goods_weight"];
		$this->goods_weight->AdvancedSearch->SearchOperator2 = @$filter["w_goods_weight"];
		$this->goods_weight->AdvancedSearch->save();

		// Field image1_id
		$this->image1_id->AdvancedSearch->SearchValue = @$filter["x_image1_id"];
		$this->image1_id->AdvancedSearch->SearchOperator = @$filter["z_image1_id"];
		$this->image1_id->AdvancedSearch->SearchCondition = @$filter["v_image1_id"];
		$this->image1_id->AdvancedSearch->SearchValue2 = @$filter["y_image1_id"];
		$this->image1_id->AdvancedSearch->SearchOperator2 = @$filter["w_image1_id"];
		$this->image1_id->AdvancedSearch->save();

		// Field image2_id
		$this->image2_id->AdvancedSearch->SearchValue = @$filter["x_image2_id"];
		$this->image2_id->AdvancedSearch->SearchOperator = @$filter["z_image2_id"];
		$this->image2_id->AdvancedSearch->SearchCondition = @$filter["v_image2_id"];
		$this->image2_id->AdvancedSearch->SearchValue2 = @$filter["y_image2_id"];
		$this->image2_id->AdvancedSearch->SearchOperator2 = @$filter["w_image2_id"];
		$this->image2_id->AdvancedSearch->save();

		// Field image3_id
		$this->image3_id->AdvancedSearch->SearchValue = @$filter["x_image3_id"];
		$this->image3_id->AdvancedSearch->SearchOperator = @$filter["z_image3_id"];
		$this->image3_id->AdvancedSearch->SearchCondition = @$filter["v_image3_id"];
		$this->image3_id->AdvancedSearch->SearchValue2 = @$filter["y_image3_id"];
		$this->image3_id->AdvancedSearch->SearchOperator2 = @$filter["w_image3_id"];
		$this->image3_id->AdvancedSearch->save();

		// Field image4_id
		$this->image4_id->AdvancedSearch->SearchValue = @$filter["x_image4_id"];
		$this->image4_id->AdvancedSearch->SearchOperator = @$filter["z_image4_id"];
		$this->image4_id->AdvancedSearch->SearchCondition = @$filter["v_image4_id"];
		$this->image4_id->AdvancedSearch->SearchValue2 = @$filter["y_image4_id"];
		$this->image4_id->AdvancedSearch->SearchOperator2 = @$filter["w_image4_id"];
		$this->image4_id->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->id, $default, FALSE); // id
		$this->buildSearchSql($where, $this->from_place, $default, FALSE); // from_place
		$this->buildSearchSql($where, $this->to_place, $default, FALSE); // to_place
		$this->buildSearchSql($where, $this->description, $default, FALSE); // description
		$this->buildSearchSql($where, $this->user_id, $default, FALSE); // user_id
		$this->buildSearchSql($where, $this->from_date, $default, FALSE); // from_date
		$this->buildSearchSql($where, $this->to_date, $default, FALSE); // to_date
		$this->buildSearchSql($where, $this->createdAt, $default, FALSE); // createdAt
		$this->buildSearchSql($where, $this->updatedAt, $default, FALSE); // updatedAt
		$this->buildSearchSql($where, $this->labor_fee, $default, FALSE); // labor_fee
		$this->buildSearchSql($where, $this->applicable, $default, FALSE); // applicable
		$this->buildSearchSql($where, $this->service_type, $default, FALSE); // service_type
		$this->buildSearchSql($where, $this->goods_category, $default, FALSE); // goods_category
		$this->buildSearchSql($where, $this->goods_weight, $default, FALSE); // goods_weight
		$this->buildSearchSql($where, $this->image1_id, $default, FALSE); // image1_id
		$this->buildSearchSql($where, $this->image2_id, $default, FALSE); // image2_id
		$this->buildSearchSql($where, $this->image3_id, $default, FALSE); // image3_id
		$this->buildSearchSql($where, $this->image4_id, $default, FALSE); // image4_id

		// Set up search parm
		if (!$default && $where <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->id->AdvancedSearch->save(); // id
			$this->from_place->AdvancedSearch->save(); // from_place
			$this->to_place->AdvancedSearch->save(); // to_place
			$this->description->AdvancedSearch->save(); // description
			$this->user_id->AdvancedSearch->save(); // user_id
			$this->from_date->AdvancedSearch->save(); // from_date
			$this->to_date->AdvancedSearch->save(); // to_date
			$this->createdAt->AdvancedSearch->save(); // createdAt
			$this->updatedAt->AdvancedSearch->save(); // updatedAt
			$this->labor_fee->AdvancedSearch->save(); // labor_fee
			$this->applicable->AdvancedSearch->save(); // applicable
			$this->service_type->AdvancedSearch->save(); // service_type
			$this->goods_category->AdvancedSearch->save(); // goods_category
			$this->goods_weight->AdvancedSearch->save(); // goods_weight
			$this->image1_id->AdvancedSearch->save(); // image1_id
			$this->image2_id->AdvancedSearch->save(); // image2_id
			$this->image3_id->AdvancedSearch->save(); // image3_id
			$this->image4_id->AdvancedSearch->save(); // image4_id
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(",", $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(",", $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (SEARCH_MULTI_VALUE_OPTION == 1)
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal <> "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 <> "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 <> "")
				$wrk = ($wrk <> "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == NULL_VALUE || $fldVal == NOT_NULL_VALUE)
			return $fldVal;
		$value = $fldVal;
		if ($fld->DataType == DATATYPE_BOOLEAN) {
			if ($fldVal <> "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal <> "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->from_place, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->to_place, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->description, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		global $BASIC_SEARCH_IGNORE_PATTERN;
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if ($BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$keyword = preg_replace($BASIC_SEARCH_IGNORE_PATTERN, "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = array($keyword);
			}
			foreach ($ar as $keyword) {
				if ($keyword <> "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == NULL_VALUE) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == NOT_NULL_VALUE) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk <> "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] <> "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql <> "") {
			if ($where <> "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword <> "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword <> "") {
						if ($searchStr <> "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql(array($keyword), $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, array("", "reset", "resetall")))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->from_place->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->to_place->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->description->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->user_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->from_date->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->to_date->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->createdAt->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->updatedAt->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->labor_fee->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->applicable->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->service_type->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->goods_category->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->goods_weight->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->image1_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->image2_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->image3_id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->image4_id->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->id->AdvancedSearch->unsetSession();
		$this->from_place->AdvancedSearch->unsetSession();
		$this->to_place->AdvancedSearch->unsetSession();
		$this->description->AdvancedSearch->unsetSession();
		$this->user_id->AdvancedSearch->unsetSession();
		$this->from_date->AdvancedSearch->unsetSession();
		$this->to_date->AdvancedSearch->unsetSession();
		$this->createdAt->AdvancedSearch->unsetSession();
		$this->updatedAt->AdvancedSearch->unsetSession();
		$this->labor_fee->AdvancedSearch->unsetSession();
		$this->applicable->AdvancedSearch->unsetSession();
		$this->service_type->AdvancedSearch->unsetSession();
		$this->goods_category->AdvancedSearch->unsetSession();
		$this->goods_weight->AdvancedSearch->unsetSession();
		$this->image1_id->AdvancedSearch->unsetSession();
		$this->image2_id->AdvancedSearch->unsetSession();
		$this->image3_id->AdvancedSearch->unsetSession();
		$this->image4_id->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
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

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->from_place); // from_place
			$this->updateSort($this->to_place); // to_place
			$this->updateSort($this->description); // description
			$this->updateSort($this->user_id); // user_id
			$this->updateSort($this->from_date); // from_date
			$this->updateSort($this->to_date); // to_date
			$this->updateSort($this->createdAt); // createdAt
			$this->updateSort($this->updatedAt); // updatedAt
			$this->updateSort($this->labor_fee); // labor_fee
			$this->updateSort($this->applicable); // applicable
			$this->updateSort($this->service_type); // service_type
			$this->updateSort($this->goods_category); // goods_category
			$this->updateSort($this->goods_weight); // goods_weight
			$this->updateSort($this->image1_id); // image1_id
			$this->updateSort($this->image2_id); // image2_id
			$this->updateSort($this->image3_id); // image3_id
			$this->updateSort($this->image4_id); // image4_id
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->from_place->setSort("");
				$this->to_place->setSort("");
				$this->description->setSort("");
				$this->user_id->setSort("");
				$this->from_date->setSort("");
				$this->to_date->setSort("");
				$this->createdAt->setSort("");
				$this->updatedAt->setSort("");
				$this->labor_fee->setSort("");
				$this->applicable->setSort("");
				$this->service_type->setSort("");
				$this->goods_category->setSort("");
				$this->goods_weight->setSort("");
				$this->image1_id->setSort("");
				$this->image2_id->setSort("");
				$this->image3_id->setSort("");
				$this->image4_id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew.selectAllKey(this);\">";
		$item->moveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = ""; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->setupListOptionsExt();
		$item = &$this->ListOptions->getItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->isGridAdd() || $this->isGridEdit()) {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = &$options->Items["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$opt = &$this->ListOptions->Items["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecCnt);

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		if ($this->isInlineAddRow() || $this->isInlineCopyRow()) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
			$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
				"<a class=\"ew-grid-link ew-inline-insert\" title=\"" . HtmlTitle($Language->Phrase("InsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("InsertLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		if ($this->isInlineEditRow()) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
					"<a class=\"ew-grid-link ew-inline-update\" title=\"" . HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . UrlAddHash($this->pageName(), "r" . $this->RowCnt . "_" . $this->TableVar) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update\"></div>";
			$opt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\">";
			return;
		}

		// "view"
		$opt = &$this->ListOptions->Items["view"];
		$viewcaption = HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = &$this->ListOptions->Items["edit"];
		$editcaption = HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$opt->Body .= "<a class=\"ew-row-link ew-inline-edit\" title=\"" . HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . HtmlEncode(UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = &$this->ListOptions->Items["copy"];
		$copycaption = HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
			$opt->Body .= "<a class=\"ew-row-link ew-inline-copy\" title=\"" . HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("InlineCopyLink")) . "\" href=\"" . HtmlEncode($this->InlineCopyUrl) . "\">" . $Language->Phrase("InlineCopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = &$this->ListOptions->Items["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";

		// Set up list action buttons
		$opt = &$this->ListOptions->getItem("listactions");
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}

		// "checkbox"
		$opt = &$this->ListOptions->Items["checkbox"];
		$opt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\">";
		if ($this->isGridEdit() && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->canAdd());

		// Inline Add
		$item = &$option->add("inlineadd");
		$item->Body = "<a class=\"ew-add-edit ew-inline-add\" title=\"" . HtmlTitle($Language->Phrase("InlineAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("InlineAddLink")) . "\" href=\"" . HtmlEncode($this->InlineAddUrl) . "\">" .$Language->Phrase("InlineAddLink") . "</a>";
		$item->Visible = ($this->InlineAddUrl <> "" && $Security->canAdd());
		$item = &$option->add("gridadd");
		$item->Body = "<a class=\"ew-add-edit ew-grid-add\" title=\"" . HtmlTitle($Language->Phrase("GridAddLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridAddLink")) . "\" href=\"" . HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->canAdd());

		// Add grid edit
		$option = $options["addedit"];
		$item = &$option->add("gridedit");
		$item->Body = "<a class=\"ew-add-edit ew-grid-edit\" title=\"" . HtmlTitle($Language->Phrase("GridEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridEditLink")) . "\" href=\"" . HtmlEncode($this->GridEditUrl) . "\">" . $Language->Phrase("GridEditLink") . "</a>";
		$item->Visible = ($this->GridEditUrl <> "" && $Security->canEdit());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = TRUE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"frequest_triplistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"frequest_triplistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (!$this->isGridAdd() && !$this->isGridEdit()) { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"\" onclick=\"ew.submitAction(event,jQuery.extend({f:document.frequest_triplist}," . $listaction->toJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->getItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->hideAllOptions();
			}
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->hideAllOptions();
			if ($this->isGridAdd()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;

				// Add grid insert
				$item = &$option->add("gridinsert");
				$item->Body = "<a class=\"ew-action ew-grid-insert\" title=\"" . HtmlTitle($Language->Phrase("GridInsertLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->add("gridcancel");
				$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
				$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
			if ($this->isGridEdit()) {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$item = &$option->add("addblankrow");
					$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew.addGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->canAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
					$item = &$option->add("gridsave");
					$item->Body = "<a class=\"ew-action ew-grid-save\" title=\"" . HtmlTitle($Language->Phrase("GridSaveLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridSaveLink")) . "\" href=\"\" onclick=\"return ew.forms(this).submit('" . $this->pageName() . "');\">" . $Language->Phrase("GridSaveLink") . "</a>";
					$item = &$option->add("gridcancel");
					$cancelurl = $this->addMasterUrl($this->pageUrl() . "action=cancel");
					$item->Body = "<a class=\"ew-action ew-grid-cancel\" title=\"" . HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
		}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter <> "" && $userAction <> "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions->Items[$userAction]->Caption;
				if (!$this->ListActions->Items[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"frequest_triplistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ew-advanced-aearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"request_tripsrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}
	protected function setupListOptionsExt()
	{
		global $Security, $Language;
	}
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->from_place->CurrentValue = NULL;
		$this->from_place->OldValue = $this->from_place->CurrentValue;
		$this->to_place->CurrentValue = NULL;
		$this->to_place->OldValue = $this->to_place->CurrentValue;
		$this->description->CurrentValue = NULL;
		$this->description->OldValue = $this->description->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->from_date->CurrentValue = NULL;
		$this->from_date->OldValue = $this->from_date->CurrentValue;
		$this->to_date->CurrentValue = NULL;
		$this->to_date->OldValue = $this->to_date->CurrentValue;
		$this->createdAt->CurrentValue = NULL;
		$this->createdAt->OldValue = $this->createdAt->CurrentValue;
		$this->updatedAt->CurrentValue = NULL;
		$this->updatedAt->OldValue = $this->updatedAt->CurrentValue;
		$this->labor_fee->CurrentValue = NULL;
		$this->labor_fee->OldValue = $this->labor_fee->CurrentValue;
		$this->applicable->CurrentValue = 1;
		$this->applicable->OldValue = $this->applicable->CurrentValue;
		$this->service_type->CurrentValue = 1;
		$this->service_type->OldValue = $this->service_type->CurrentValue;
		$this->goods_category->CurrentValue = NULL;
		$this->goods_category->OldValue = $this->goods_category->CurrentValue;
		$this->goods_weight->CurrentValue = NULL;
		$this->goods_weight->OldValue = $this->goods_weight->CurrentValue;
		$this->image1_id->CurrentValue = NULL;
		$this->image1_id->OldValue = $this->image1_id->CurrentValue;
		$this->image2_id->CurrentValue = NULL;
		$this->image2_id->OldValue = $this->image2_id->CurrentValue;
		$this->image3_id->CurrentValue = NULL;
		$this->image3_id->OldValue = $this->image3_id->CurrentValue;
		$this->image4_id->CurrentValue = NULL;
		$this->image4_id->OldValue = $this->image4_id->CurrentValue;
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(TABLE_BASIC_SEARCH, ""), FALSE);
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(TABLE_BASIC_SEARCH_TYPE, ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{
		global $CurrentForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->setSearchValue(Get("x_id", Get("id", "")));
		if ($this->id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->id->AdvancedSearch->setSearchOperator(Get("z_id", ""));

		// from_place
		$this->from_place->AdvancedSearch->setSearchValue(Get("x_from_place", Get("from_place", "")));
		if ($this->from_place->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->from_place->AdvancedSearch->setSearchOperator(Get("z_from_place", ""));

		// to_place
		$this->to_place->AdvancedSearch->setSearchValue(Get("x_to_place", Get("to_place", "")));
		if ($this->to_place->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->to_place->AdvancedSearch->setSearchOperator(Get("z_to_place", ""));

		// description
		$this->description->AdvancedSearch->setSearchValue(Get("x_description", Get("description", "")));
		if ($this->description->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->description->AdvancedSearch->setSearchOperator(Get("z_description", ""));

		// user_id
		$this->user_id->AdvancedSearch->setSearchValue(Get("x_user_id", Get("user_id", "")));
		if ($this->user_id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->user_id->AdvancedSearch->setSearchOperator(Get("z_user_id", ""));

		// from_date
		$this->from_date->AdvancedSearch->setSearchValue(Get("x_from_date", Get("from_date", "")));
		if ($this->from_date->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->from_date->AdvancedSearch->setSearchOperator(Get("z_from_date", ""));

		// to_date
		$this->to_date->AdvancedSearch->setSearchValue(Get("x_to_date", Get("to_date", "")));
		if ($this->to_date->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->to_date->AdvancedSearch->setSearchOperator(Get("z_to_date", ""));

		// createdAt
		$this->createdAt->AdvancedSearch->setSearchValue(Get("x_createdAt", Get("createdAt", "")));
		if ($this->createdAt->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->createdAt->AdvancedSearch->setSearchOperator(Get("z_createdAt", ""));

		// updatedAt
		$this->updatedAt->AdvancedSearch->setSearchValue(Get("x_updatedAt", Get("updatedAt", "")));
		if ($this->updatedAt->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->updatedAt->AdvancedSearch->setSearchOperator(Get("z_updatedAt", ""));

		// labor_fee
		$this->labor_fee->AdvancedSearch->setSearchValue(Get("x_labor_fee", Get("labor_fee", "")));
		if ($this->labor_fee->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->labor_fee->AdvancedSearch->setSearchOperator(Get("z_labor_fee", ""));

		// applicable
		$this->applicable->AdvancedSearch->setSearchValue(Get("x_applicable", Get("applicable", "")));
		if ($this->applicable->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->applicable->AdvancedSearch->setSearchOperator(Get("z_applicable", ""));

		// service_type
		$this->service_type->AdvancedSearch->setSearchValue(Get("x_service_type", Get("service_type", "")));
		if ($this->service_type->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->service_type->AdvancedSearch->setSearchOperator(Get("z_service_type", ""));

		// goods_category
		$this->goods_category->AdvancedSearch->setSearchValue(Get("x_goods_category", Get("goods_category", "")));
		if ($this->goods_category->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->goods_category->AdvancedSearch->setSearchOperator(Get("z_goods_category", ""));

		// goods_weight
		$this->goods_weight->AdvancedSearch->setSearchValue(Get("x_goods_weight", Get("goods_weight", "")));
		if ($this->goods_weight->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->goods_weight->AdvancedSearch->setSearchOperator(Get("z_goods_weight", ""));

		// image1_id
		$this->image1_id->AdvancedSearch->setSearchValue(Get("x_image1_id", Get("image1_id", "")));
		if ($this->image1_id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->image1_id->AdvancedSearch->setSearchOperator(Get("z_image1_id", ""));

		// image2_id
		$this->image2_id->AdvancedSearch->setSearchValue(Get("x_image2_id", Get("image2_id", "")));
		if ($this->image2_id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->image2_id->AdvancedSearch->setSearchOperator(Get("z_image2_id", ""));

		// image3_id
		$this->image3_id->AdvancedSearch->setSearchValue(Get("x_image3_id", Get("image3_id", "")));
		if ($this->image3_id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->image3_id->AdvancedSearch->setSearchOperator(Get("z_image3_id", ""));

		// image4_id
		$this->image4_id->AdvancedSearch->setSearchValue(Get("x_image4_id", Get("image4_id", "")));
		if ($this->image4_id->AdvancedSearch->SearchValue <> "" && $this->Command == "")
			$this->Command = "search";
		$this->image4_id->AdvancedSearch->setSearchOperator(Get("z_image4_id", ""));
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'from_place' first before field var 'x_from_place'
		$val = $CurrentForm->hasValue("from_place") ? $CurrentForm->getValue("from_place") : $CurrentForm->getValue("x_from_place");
		if (!$this->from_place->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->from_place->Visible = FALSE; // Disable update for API request
			else
				$this->from_place->setFormValue($val);
		}
		$this->from_place->setOldValue($CurrentForm->getValue("o_from_place"));

		// Check field name 'to_place' first before field var 'x_to_place'
		$val = $CurrentForm->hasValue("to_place") ? $CurrentForm->getValue("to_place") : $CurrentForm->getValue("x_to_place");
		if (!$this->to_place->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->to_place->Visible = FALSE; // Disable update for API request
			else
				$this->to_place->setFormValue($val);
		}
		$this->to_place->setOldValue($CurrentForm->getValue("o_to_place"));

		// Check field name 'description' first before field var 'x_description'
		$val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
		if (!$this->description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->description->Visible = FALSE; // Disable update for API request
			else
				$this->description->setFormValue($val);
		}
		$this->description->setOldValue($CurrentForm->getValue("o_description"));

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}
		$this->user_id->setOldValue($CurrentForm->getValue("o_user_id"));

		// Check field name 'from_date' first before field var 'x_from_date'
		$val = $CurrentForm->hasValue("from_date") ? $CurrentForm->getValue("from_date") : $CurrentForm->getValue("x_from_date");
		if (!$this->from_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->from_date->Visible = FALSE; // Disable update for API request
			else
				$this->from_date->setFormValue($val);
			$this->from_date->CurrentValue = UnFormatDateTime($this->from_date->CurrentValue, 0);
		}
		$this->from_date->setOldValue($CurrentForm->getValue("o_from_date"));

		// Check field name 'to_date' first before field var 'x_to_date'
		$val = $CurrentForm->hasValue("to_date") ? $CurrentForm->getValue("to_date") : $CurrentForm->getValue("x_to_date");
		if (!$this->to_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->to_date->Visible = FALSE; // Disable update for API request
			else
				$this->to_date->setFormValue($val);
			$this->to_date->CurrentValue = UnFormatDateTime($this->to_date->CurrentValue, 0);
		}
		$this->to_date->setOldValue($CurrentForm->getValue("o_to_date"));

		// Check field name 'createdAt' first before field var 'x_createdAt'
		$val = $CurrentForm->hasValue("createdAt") ? $CurrentForm->getValue("createdAt") : $CurrentForm->getValue("x_createdAt");
		if (!$this->createdAt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->createdAt->Visible = FALSE; // Disable update for API request
			else
				$this->createdAt->setFormValue($val);
			$this->createdAt->CurrentValue = UnFormatDateTime($this->createdAt->CurrentValue, 0);
		}
		$this->createdAt->setOldValue($CurrentForm->getValue("o_createdAt"));

		// Check field name 'updatedAt' first before field var 'x_updatedAt'
		$val = $CurrentForm->hasValue("updatedAt") ? $CurrentForm->getValue("updatedAt") : $CurrentForm->getValue("x_updatedAt");
		if (!$this->updatedAt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->updatedAt->Visible = FALSE; // Disable update for API request
			else
				$this->updatedAt->setFormValue($val);
			$this->updatedAt->CurrentValue = UnFormatDateTime($this->updatedAt->CurrentValue, 0);
		}
		$this->updatedAt->setOldValue($CurrentForm->getValue("o_updatedAt"));

		// Check field name 'labor_fee' first before field var 'x_labor_fee'
		$val = $CurrentForm->hasValue("labor_fee") ? $CurrentForm->getValue("labor_fee") : $CurrentForm->getValue("x_labor_fee");
		if (!$this->labor_fee->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->labor_fee->Visible = FALSE; // Disable update for API request
			else
				$this->labor_fee->setFormValue($val);
		}
		$this->labor_fee->setOldValue($CurrentForm->getValue("o_labor_fee"));

		// Check field name 'applicable' first before field var 'x_applicable'
		$val = $CurrentForm->hasValue("applicable") ? $CurrentForm->getValue("applicable") : $CurrentForm->getValue("x_applicable");
		if (!$this->applicable->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->applicable->Visible = FALSE; // Disable update for API request
			else
				$this->applicable->setFormValue($val);
		}
		$this->applicable->setOldValue($CurrentForm->getValue("o_applicable"));

		// Check field name 'service_type' first before field var 'x_service_type'
		$val = $CurrentForm->hasValue("service_type") ? $CurrentForm->getValue("service_type") : $CurrentForm->getValue("x_service_type");
		if (!$this->service_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->service_type->Visible = FALSE; // Disable update for API request
			else
				$this->service_type->setFormValue($val);
		}
		$this->service_type->setOldValue($CurrentForm->getValue("o_service_type"));

		// Check field name 'goods_category' first before field var 'x_goods_category'
		$val = $CurrentForm->hasValue("goods_category") ? $CurrentForm->getValue("goods_category") : $CurrentForm->getValue("x_goods_category");
		if (!$this->goods_category->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->goods_category->Visible = FALSE; // Disable update for API request
			else
				$this->goods_category->setFormValue($val);
		}
		$this->goods_category->setOldValue($CurrentForm->getValue("o_goods_category"));

		// Check field name 'goods_weight' first before field var 'x_goods_weight'
		$val = $CurrentForm->hasValue("goods_weight") ? $CurrentForm->getValue("goods_weight") : $CurrentForm->getValue("x_goods_weight");
		if (!$this->goods_weight->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->goods_weight->Visible = FALSE; // Disable update for API request
			else
				$this->goods_weight->setFormValue($val);
		}
		$this->goods_weight->setOldValue($CurrentForm->getValue("o_goods_weight"));

		// Check field name 'image1_id' first before field var 'x_image1_id'
		$val = $CurrentForm->hasValue("image1_id") ? $CurrentForm->getValue("image1_id") : $CurrentForm->getValue("x_image1_id");
		if (!$this->image1_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image1_id->Visible = FALSE; // Disable update for API request
			else
				$this->image1_id->setFormValue($val);
		}
		$this->image1_id->setOldValue($CurrentForm->getValue("o_image1_id"));

		// Check field name 'image2_id' first before field var 'x_image2_id'
		$val = $CurrentForm->hasValue("image2_id") ? $CurrentForm->getValue("image2_id") : $CurrentForm->getValue("x_image2_id");
		if (!$this->image2_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image2_id->Visible = FALSE; // Disable update for API request
			else
				$this->image2_id->setFormValue($val);
		}
		$this->image2_id->setOldValue($CurrentForm->getValue("o_image2_id"));

		// Check field name 'image3_id' first before field var 'x_image3_id'
		$val = $CurrentForm->hasValue("image3_id") ? $CurrentForm->getValue("image3_id") : $CurrentForm->getValue("x_image3_id");
		if (!$this->image3_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image3_id->Visible = FALSE; // Disable update for API request
			else
				$this->image3_id->setFormValue($val);
		}
		$this->image3_id->setOldValue($CurrentForm->getValue("o_image3_id"));

		// Check field name 'image4_id' first before field var 'x_image4_id'
		$val = $CurrentForm->hasValue("image4_id") ? $CurrentForm->getValue("image4_id") : $CurrentForm->getValue("x_image4_id");
		if (!$this->image4_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image4_id->Visible = FALSE; // Disable update for API request
			else
				$this->image4_id->setFormValue($val);
		}
		$this->image4_id->setOldValue($CurrentForm->getValue("o_image4_id"));

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->from_place->CurrentValue = $this->from_place->FormValue;
		$this->to_place->CurrentValue = $this->to_place->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->from_date->CurrentValue = $this->from_date->FormValue;
		$this->from_date->CurrentValue = UnFormatDateTime($this->from_date->CurrentValue, 0);
		$this->to_date->CurrentValue = $this->to_date->FormValue;
		$this->to_date->CurrentValue = UnFormatDateTime($this->to_date->CurrentValue, 0);
		$this->createdAt->CurrentValue = $this->createdAt->FormValue;
		$this->createdAt->CurrentValue = UnFormatDateTime($this->createdAt->CurrentValue, 0);
		$this->updatedAt->CurrentValue = $this->updatedAt->FormValue;
		$this->updatedAt->CurrentValue = UnFormatDateTime($this->updatedAt->CurrentValue, 0);
		$this->labor_fee->CurrentValue = $this->labor_fee->FormValue;
		$this->applicable->CurrentValue = $this->applicable->FormValue;
		$this->service_type->CurrentValue = $this->service_type->FormValue;
		$this->goods_category->CurrentValue = $this->goods_category->FormValue;
		$this->goods_weight->CurrentValue = $this->goods_weight->FormValue;
		$this->image1_id->CurrentValue = $this->image1_id->FormValue;
		$this->image2_id->CurrentValue = $this->image2_id->FormValue;
		$this->image3_id->CurrentValue = $this->image3_id->FormValue;
		$this->image4_id->CurrentValue = $this->image4_id->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			if (!$this->EventCancelled)
				$this->HashValue = $this->getRowHash($rs); // Get hash value for record
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->from_place->setDbValue($row['from_place']);
		$this->to_place->setDbValue($row['to_place']);
		$this->description->setDbValue($row['description']);
		$this->user_id->setDbValue($row['user_id']);
		$this->from_date->setDbValue($row['from_date']);
		$this->to_date->setDbValue($row['to_date']);
		$this->createdAt->setDbValue($row['createdAt']);
		$this->updatedAt->setDbValue($row['updatedAt']);
		$this->labor_fee->setDbValue($row['labor_fee']);
		$this->applicable->setDbValue($row['applicable']);
		$this->service_type->setDbValue($row['service_type']);
		$this->goods_category->setDbValue($row['goods_category']);
		$this->goods_weight->setDbValue($row['goods_weight']);
		$this->image1_id->setDbValue($row['image1_id']);
		$this->image2_id->setDbValue($row['image2_id']);
		$this->image3_id->setDbValue($row['image3_id']);
		$this->image4_id->setDbValue($row['image4_id']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['from_place'] = $this->from_place->CurrentValue;
		$row['to_place'] = $this->to_place->CurrentValue;
		$row['description'] = $this->description->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['from_date'] = $this->from_date->CurrentValue;
		$row['to_date'] = $this->to_date->CurrentValue;
		$row['createdAt'] = $this->createdAt->CurrentValue;
		$row['updatedAt'] = $this->updatedAt->CurrentValue;
		$row['labor_fee'] = $this->labor_fee->CurrentValue;
		$row['applicable'] = $this->applicable->CurrentValue;
		$row['service_type'] = $this->service_type->CurrentValue;
		$row['goods_category'] = $this->goods_category->CurrentValue;
		$row['goods_weight'] = $this->goods_weight->CurrentValue;
		$row['image1_id'] = $this->image1_id->CurrentValue;
		$row['image2_id'] = $this->image2_id->CurrentValue;
		$row['image3_id'] = $this->image3_id->CurrentValue;
		$row['image4_id'] = $this->image4_id->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// from_place
			$this->from_place->EditAttrs["class"] = "form-control";
			$this->from_place->EditCustomAttributes = "";
			$this->from_place->EditValue = HtmlEncode($this->from_place->CurrentValue);
			$this->from_place->PlaceHolder = RemoveHtml($this->from_place->caption());

			// to_place
			$this->to_place->EditAttrs["class"] = "form-control";
			$this->to_place->EditCustomAttributes = "";
			$this->to_place->EditValue = HtmlEncode($this->to_place->CurrentValue);
			$this->to_place->PlaceHolder = RemoveHtml($this->to_place->caption());

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = RemoveHtml($this->description->caption());

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

			// from_date
			$this->from_date->EditAttrs["class"] = "form-control";
			$this->from_date->EditCustomAttributes = "";
			$this->from_date->EditValue = HtmlEncode(FormatDateTime($this->from_date->CurrentValue, 8));
			$this->from_date->PlaceHolder = RemoveHtml($this->from_date->caption());

			// to_date
			$this->to_date->EditAttrs["class"] = "form-control";
			$this->to_date->EditCustomAttributes = "";
			$this->to_date->EditValue = HtmlEncode(FormatDateTime($this->to_date->CurrentValue, 8));
			$this->to_date->PlaceHolder = RemoveHtml($this->to_date->caption());

			// createdAt
			$this->createdAt->EditAttrs["class"] = "form-control";
			$this->createdAt->EditCustomAttributes = "";
			$this->createdAt->EditValue = HtmlEncode(FormatDateTime($this->createdAt->CurrentValue, 8));
			$this->createdAt->PlaceHolder = RemoveHtml($this->createdAt->caption());

			// updatedAt
			$this->updatedAt->EditAttrs["class"] = "form-control";
			$this->updatedAt->EditCustomAttributes = "";
			$this->updatedAt->EditValue = HtmlEncode(FormatDateTime($this->updatedAt->CurrentValue, 8));
			$this->updatedAt->PlaceHolder = RemoveHtml($this->updatedAt->caption());

			// labor_fee
			$this->labor_fee->EditAttrs["class"] = "form-control";
			$this->labor_fee->EditCustomAttributes = "";
			$this->labor_fee->EditValue = HtmlEncode($this->labor_fee->CurrentValue);
			$this->labor_fee->PlaceHolder = RemoveHtml($this->labor_fee->caption());

			// applicable
			$this->applicable->EditAttrs["class"] = "form-control";
			$this->applicable->EditCustomAttributes = "";
			$this->applicable->EditValue = HtmlEncode($this->applicable->CurrentValue);
			$this->applicable->PlaceHolder = RemoveHtml($this->applicable->caption());

			// service_type
			$this->service_type->EditAttrs["class"] = "form-control";
			$this->service_type->EditCustomAttributes = "";
			$this->service_type->EditValue = HtmlEncode($this->service_type->CurrentValue);
			$this->service_type->PlaceHolder = RemoveHtml($this->service_type->caption());

			// goods_category
			$this->goods_category->EditAttrs["class"] = "form-control";
			$this->goods_category->EditCustomAttributes = "";
			$this->goods_category->EditValue = HtmlEncode($this->goods_category->CurrentValue);
			$this->goods_category->PlaceHolder = RemoveHtml($this->goods_category->caption());

			// goods_weight
			$this->goods_weight->EditAttrs["class"] = "form-control";
			$this->goods_weight->EditCustomAttributes = "";
			$this->goods_weight->EditValue = HtmlEncode($this->goods_weight->CurrentValue);
			$this->goods_weight->PlaceHolder = RemoveHtml($this->goods_weight->caption());

			// image1_id
			$this->image1_id->EditAttrs["class"] = "form-control";
			$this->image1_id->EditCustomAttributes = "";
			$this->image1_id->EditValue = HtmlEncode($this->image1_id->CurrentValue);
			$this->image1_id->PlaceHolder = RemoveHtml($this->image1_id->caption());

			// image2_id
			$this->image2_id->EditAttrs["class"] = "form-control";
			$this->image2_id->EditCustomAttributes = "";
			$this->image2_id->EditValue = HtmlEncode($this->image2_id->CurrentValue);
			$this->image2_id->PlaceHolder = RemoveHtml($this->image2_id->caption());

			// image3_id
			$this->image3_id->EditAttrs["class"] = "form-control";
			$this->image3_id->EditCustomAttributes = "";
			$this->image3_id->EditValue = HtmlEncode($this->image3_id->CurrentValue);
			$this->image3_id->PlaceHolder = RemoveHtml($this->image3_id->caption());

			// image4_id
			$this->image4_id->EditAttrs["class"] = "form-control";
			$this->image4_id->EditCustomAttributes = "";
			$this->image4_id->EditValue = HtmlEncode($this->image4_id->CurrentValue);
			$this->image4_id->PlaceHolder = RemoveHtml($this->image4_id->caption());

			// Add refer script
			// from_place

			$this->from_place->LinkCustomAttributes = "";
			$this->from_place->HrefValue = "";

			// to_place
			$this->to_place->LinkCustomAttributes = "";
			$this->to_place->HrefValue = "";

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// from_date
			$this->from_date->LinkCustomAttributes = "";
			$this->from_date->HrefValue = "";

			// to_date
			$this->to_date->LinkCustomAttributes = "";
			$this->to_date->HrefValue = "";

			// createdAt
			$this->createdAt->LinkCustomAttributes = "";
			$this->createdAt->HrefValue = "";

			// updatedAt
			$this->updatedAt->LinkCustomAttributes = "";
			$this->updatedAt->HrefValue = "";

			// labor_fee
			$this->labor_fee->LinkCustomAttributes = "";
			$this->labor_fee->HrefValue = "";

			// applicable
			$this->applicable->LinkCustomAttributes = "";
			$this->applicable->HrefValue = "";

			// service_type
			$this->service_type->LinkCustomAttributes = "";
			$this->service_type->HrefValue = "";

			// goods_category
			$this->goods_category->LinkCustomAttributes = "";
			$this->goods_category->HrefValue = "";

			// goods_weight
			$this->goods_weight->LinkCustomAttributes = "";
			$this->goods_weight->HrefValue = "";

			// image1_id
			$this->image1_id->LinkCustomAttributes = "";
			$this->image1_id->HrefValue = "";

			// image2_id
			$this->image2_id->LinkCustomAttributes = "";
			$this->image2_id->HrefValue = "";

			// image3_id
			$this->image3_id->LinkCustomAttributes = "";
			$this->image3_id->HrefValue = "";

			// image4_id
			$this->image4_id->LinkCustomAttributes = "";
			$this->image4_id->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// from_place
			$this->from_place->EditAttrs["class"] = "form-control";
			$this->from_place->EditCustomAttributes = "";
			$this->from_place->EditValue = HtmlEncode($this->from_place->CurrentValue);
			$this->from_place->PlaceHolder = RemoveHtml($this->from_place->caption());

			// to_place
			$this->to_place->EditAttrs["class"] = "form-control";
			$this->to_place->EditCustomAttributes = "";
			$this->to_place->EditValue = HtmlEncode($this->to_place->CurrentValue);
			$this->to_place->PlaceHolder = RemoveHtml($this->to_place->caption());

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = RemoveHtml($this->description->caption());

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

			// from_date
			$this->from_date->EditAttrs["class"] = "form-control";
			$this->from_date->EditCustomAttributes = "";
			$this->from_date->EditValue = HtmlEncode(FormatDateTime($this->from_date->CurrentValue, 8));
			$this->from_date->PlaceHolder = RemoveHtml($this->from_date->caption());

			// to_date
			$this->to_date->EditAttrs["class"] = "form-control";
			$this->to_date->EditCustomAttributes = "";
			$this->to_date->EditValue = HtmlEncode(FormatDateTime($this->to_date->CurrentValue, 8));
			$this->to_date->PlaceHolder = RemoveHtml($this->to_date->caption());

			// createdAt
			$this->createdAt->EditAttrs["class"] = "form-control";
			$this->createdAt->EditCustomAttributes = "";
			$this->createdAt->EditValue = HtmlEncode(FormatDateTime($this->createdAt->CurrentValue, 8));
			$this->createdAt->PlaceHolder = RemoveHtml($this->createdAt->caption());

			// updatedAt
			$this->updatedAt->EditAttrs["class"] = "form-control";
			$this->updatedAt->EditCustomAttributes = "";
			$this->updatedAt->EditValue = HtmlEncode(FormatDateTime($this->updatedAt->CurrentValue, 8));
			$this->updatedAt->PlaceHolder = RemoveHtml($this->updatedAt->caption());

			// labor_fee
			$this->labor_fee->EditAttrs["class"] = "form-control";
			$this->labor_fee->EditCustomAttributes = "";
			$this->labor_fee->EditValue = HtmlEncode($this->labor_fee->CurrentValue);
			$this->labor_fee->PlaceHolder = RemoveHtml($this->labor_fee->caption());

			// applicable
			$this->applicable->EditAttrs["class"] = "form-control";
			$this->applicable->EditCustomAttributes = "";
			$this->applicable->EditValue = HtmlEncode($this->applicable->CurrentValue);
			$this->applicable->PlaceHolder = RemoveHtml($this->applicable->caption());

			// service_type
			$this->service_type->EditAttrs["class"] = "form-control";
			$this->service_type->EditCustomAttributes = "";
			$this->service_type->EditValue = HtmlEncode($this->service_type->CurrentValue);
			$this->service_type->PlaceHolder = RemoveHtml($this->service_type->caption());

			// goods_category
			$this->goods_category->EditAttrs["class"] = "form-control";
			$this->goods_category->EditCustomAttributes = "";
			$this->goods_category->EditValue = HtmlEncode($this->goods_category->CurrentValue);
			$this->goods_category->PlaceHolder = RemoveHtml($this->goods_category->caption());

			// goods_weight
			$this->goods_weight->EditAttrs["class"] = "form-control";
			$this->goods_weight->EditCustomAttributes = "";
			$this->goods_weight->EditValue = HtmlEncode($this->goods_weight->CurrentValue);
			$this->goods_weight->PlaceHolder = RemoveHtml($this->goods_weight->caption());

			// image1_id
			$this->image1_id->EditAttrs["class"] = "form-control";
			$this->image1_id->EditCustomAttributes = "";
			$this->image1_id->EditValue = HtmlEncode($this->image1_id->CurrentValue);
			$this->image1_id->PlaceHolder = RemoveHtml($this->image1_id->caption());

			// image2_id
			$this->image2_id->EditAttrs["class"] = "form-control";
			$this->image2_id->EditCustomAttributes = "";
			$this->image2_id->EditValue = HtmlEncode($this->image2_id->CurrentValue);
			$this->image2_id->PlaceHolder = RemoveHtml($this->image2_id->caption());

			// image3_id
			$this->image3_id->EditAttrs["class"] = "form-control";
			$this->image3_id->EditCustomAttributes = "";
			$this->image3_id->EditValue = HtmlEncode($this->image3_id->CurrentValue);
			$this->image3_id->PlaceHolder = RemoveHtml($this->image3_id->caption());

			// image4_id
			$this->image4_id->EditAttrs["class"] = "form-control";
			$this->image4_id->EditCustomAttributes = "";
			$this->image4_id->EditValue = HtmlEncode($this->image4_id->CurrentValue);
			$this->image4_id->PlaceHolder = RemoveHtml($this->image4_id->caption());

			// Edit refer script
			// from_place

			$this->from_place->LinkCustomAttributes = "";
			$this->from_place->HrefValue = "";

			// to_place
			$this->to_place->LinkCustomAttributes = "";
			$this->to_place->HrefValue = "";

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// from_date
			$this->from_date->LinkCustomAttributes = "";
			$this->from_date->HrefValue = "";

			// to_date
			$this->to_date->LinkCustomAttributes = "";
			$this->to_date->HrefValue = "";

			// createdAt
			$this->createdAt->LinkCustomAttributes = "";
			$this->createdAt->HrefValue = "";

			// updatedAt
			$this->updatedAt->LinkCustomAttributes = "";
			$this->updatedAt->HrefValue = "";

			// labor_fee
			$this->labor_fee->LinkCustomAttributes = "";
			$this->labor_fee->HrefValue = "";

			// applicable
			$this->applicable->LinkCustomAttributes = "";
			$this->applicable->HrefValue = "";

			// service_type
			$this->service_type->LinkCustomAttributes = "";
			$this->service_type->HrefValue = "";

			// goods_category
			$this->goods_category->LinkCustomAttributes = "";
			$this->goods_category->HrefValue = "";

			// goods_weight
			$this->goods_weight->LinkCustomAttributes = "";
			$this->goods_weight->HrefValue = "";

			// image1_id
			$this->image1_id->LinkCustomAttributes = "";
			$this->image1_id->HrefValue = "";

			// image2_id
			$this->image2_id->LinkCustomAttributes = "";
			$this->image2_id->HrefValue = "";

			// image3_id
			$this->image3_id->LinkCustomAttributes = "";
			$this->image3_id->HrefValue = "";

			// image4_id
			$this->image4_id->LinkCustomAttributes = "";
			$this->image4_id->HrefValue = "";
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

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->from_place->Required) {
			if (!$this->from_place->IsDetailKey && $this->from_place->FormValue != NULL && $this->from_place->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->from_place->caption(), $this->from_place->RequiredErrorMessage));
			}
		}
		if ($this->to_place->Required) {
			if (!$this->to_place->IsDetailKey && $this->to_place->FormValue != NULL && $this->to_place->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->to_place->caption(), $this->to_place->RequiredErrorMessage));
			}
		}
		if ($this->description->Required) {
			if (!$this->description->IsDetailKey && $this->description->FormValue != NULL && $this->description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
			}
		}
		if ($this->user_id->Required) {
			if (!$this->user_id->IsDetailKey && $this->user_id->FormValue != NULL && $this->user_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->user_id->FormValue)) {
			AddMessage($FormError, $this->user_id->errorMessage());
		}
		if ($this->from_date->Required) {
			if (!$this->from_date->IsDetailKey && $this->from_date->FormValue != NULL && $this->from_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->from_date->caption(), $this->from_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->from_date->FormValue)) {
			AddMessage($FormError, $this->from_date->errorMessage());
		}
		if ($this->to_date->Required) {
			if (!$this->to_date->IsDetailKey && $this->to_date->FormValue != NULL && $this->to_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->to_date->caption(), $this->to_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->to_date->FormValue)) {
			AddMessage($FormError, $this->to_date->errorMessage());
		}
		if ($this->createdAt->Required) {
			if (!$this->createdAt->IsDetailKey && $this->createdAt->FormValue != NULL && $this->createdAt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->createdAt->caption(), $this->createdAt->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->createdAt->FormValue)) {
			AddMessage($FormError, $this->createdAt->errorMessage());
		}
		if ($this->updatedAt->Required) {
			if (!$this->updatedAt->IsDetailKey && $this->updatedAt->FormValue != NULL && $this->updatedAt->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updatedAt->caption(), $this->updatedAt->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->updatedAt->FormValue)) {
			AddMessage($FormError, $this->updatedAt->errorMessage());
		}
		if ($this->labor_fee->Required) {
			if (!$this->labor_fee->IsDetailKey && $this->labor_fee->FormValue != NULL && $this->labor_fee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->labor_fee->caption(), $this->labor_fee->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->labor_fee->FormValue)) {
			AddMessage($FormError, $this->labor_fee->errorMessage());
		}
		if ($this->applicable->Required) {
			if (!$this->applicable->IsDetailKey && $this->applicable->FormValue != NULL && $this->applicable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->applicable->caption(), $this->applicable->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->applicable->FormValue)) {
			AddMessage($FormError, $this->applicable->errorMessage());
		}
		if ($this->service_type->Required) {
			if (!$this->service_type->IsDetailKey && $this->service_type->FormValue != NULL && $this->service_type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->service_type->caption(), $this->service_type->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->service_type->FormValue)) {
			AddMessage($FormError, $this->service_type->errorMessage());
		}
		if ($this->goods_category->Required) {
			if (!$this->goods_category->IsDetailKey && $this->goods_category->FormValue != NULL && $this->goods_category->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->goods_category->caption(), $this->goods_category->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->goods_category->FormValue)) {
			AddMessage($FormError, $this->goods_category->errorMessage());
		}
		if ($this->goods_weight->Required) {
			if (!$this->goods_weight->IsDetailKey && $this->goods_weight->FormValue != NULL && $this->goods_weight->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->goods_weight->caption(), $this->goods_weight->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->goods_weight->FormValue)) {
			AddMessage($FormError, $this->goods_weight->errorMessage());
		}
		if ($this->image1_id->Required) {
			if (!$this->image1_id->IsDetailKey && $this->image1_id->FormValue != NULL && $this->image1_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->image1_id->caption(), $this->image1_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->image1_id->FormValue)) {
			AddMessage($FormError, $this->image1_id->errorMessage());
		}
		if ($this->image2_id->Required) {
			if (!$this->image2_id->IsDetailKey && $this->image2_id->FormValue != NULL && $this->image2_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->image2_id->caption(), $this->image2_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->image2_id->FormValue)) {
			AddMessage($FormError, $this->image2_id->errorMessage());
		}
		if ($this->image3_id->Required) {
			if (!$this->image3_id->IsDetailKey && $this->image3_id->FormValue != NULL && $this->image3_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->image3_id->caption(), $this->image3_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->image3_id->FormValue)) {
			AddMessage($FormError, $this->image3_id->errorMessage());
		}
		if ($this->image4_id->Required) {
			if (!$this->image4_id->IsDetailKey && $this->image4_id->FormValue != NULL && $this->image4_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->image4_id->caption(), $this->image4_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->image4_id->FormValue)) {
			AddMessage($FormError, $this->image4_id->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	//
	// Delete records based on current filter
	//

	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey <> "")
					$thisKey .= $GLOBALS["COMPOSITE_KEY_SEPARATOR"];
				$thisKey .= $row['id'];
				if (DELETE_UPLOADED_FILES) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($deleteRows === FALSE)
					break;
				if ($key <> "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// from_place
			$this->from_place->setDbValueDef($rsnew, $this->from_place->CurrentValue, "", $this->from_place->ReadOnly);

			// to_place
			$this->to_place->setDbValueDef($rsnew, $this->to_place->CurrentValue, "", $this->to_place->ReadOnly);

			// description
			$this->description->setDbValueDef($rsnew, $this->description->CurrentValue, NULL, $this->description->ReadOnly);

			// user_id
			$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly);

			// from_date
			$this->from_date->setDbValueDef($rsnew, UnFormatDateTime($this->from_date->CurrentValue, 0), NULL, $this->from_date->ReadOnly);

			// to_date
			$this->to_date->setDbValueDef($rsnew, UnFormatDateTime($this->to_date->CurrentValue, 0), NULL, $this->to_date->ReadOnly);

			// createdAt
			$this->createdAt->setDbValueDef($rsnew, UnFormatDateTime($this->createdAt->CurrentValue, 0), CurrentDate(), $this->createdAt->ReadOnly);

			// updatedAt
			$this->updatedAt->setDbValueDef($rsnew, UnFormatDateTime($this->updatedAt->CurrentValue, 0), CurrentDate(), $this->updatedAt->ReadOnly);

			// labor_fee
			$this->labor_fee->setDbValueDef($rsnew, $this->labor_fee->CurrentValue, NULL, $this->labor_fee->ReadOnly);

			// applicable
			$this->applicable->setDbValueDef($rsnew, $this->applicable->CurrentValue, 0, $this->applicable->ReadOnly);

			// service_type
			$this->service_type->setDbValueDef($rsnew, $this->service_type->CurrentValue, 0, $this->service_type->ReadOnly);

			// goods_category
			$this->goods_category->setDbValueDef($rsnew, $this->goods_category->CurrentValue, NULL, $this->goods_category->ReadOnly);

			// goods_weight
			$this->goods_weight->setDbValueDef($rsnew, $this->goods_weight->CurrentValue, NULL, $this->goods_weight->ReadOnly);

			// image1_id
			$this->image1_id->setDbValueDef($rsnew, $this->image1_id->CurrentValue, NULL, $this->image1_id->ReadOnly);

			// image2_id
			$this->image2_id->setDbValueDef($rsnew, $this->image2_id->CurrentValue, NULL, $this->image2_id->ReadOnly);

			// image3_id
			$this->image3_id->setDbValueDef($rsnew, $this->image3_id->CurrentValue, NULL, $this->image3_id->ReadOnly);

			// image4_id
			$this->image4_id->setDbValueDef($rsnew, $this->image4_id->CurrentValue, NULL, $this->image4_id->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Load row hash
	protected function loadRowHash()
	{
		$filter = $this->getRecordFilter();

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$rsRow = $conn->Execute($sql);
		$this->HashValue = ($rsRow && !$rsRow->EOF) ? $this->getRowHash($rsRow) : ""; // Get hash value for record
		$rsRow->close();
	}

	// Get Row Hash
	public function getRowHash(&$rs)
	{
		if (!$rs)
			return "";
		$hash = "";
		$hash .= GetFieldHash($rs->fields('from_place')); // from_place
		$hash .= GetFieldHash($rs->fields('to_place')); // to_place
		$hash .= GetFieldHash($rs->fields('description')); // description
		$hash .= GetFieldHash($rs->fields('user_id')); // user_id
		$hash .= GetFieldHash($rs->fields('from_date')); // from_date
		$hash .= GetFieldHash($rs->fields('to_date')); // to_date
		$hash .= GetFieldHash($rs->fields('createdAt')); // createdAt
		$hash .= GetFieldHash($rs->fields('updatedAt')); // updatedAt
		$hash .= GetFieldHash($rs->fields('labor_fee')); // labor_fee
		$hash .= GetFieldHash($rs->fields('applicable')); // applicable
		$hash .= GetFieldHash($rs->fields('service_type')); // service_type
		$hash .= GetFieldHash($rs->fields('goods_category')); // goods_category
		$hash .= GetFieldHash($rs->fields('goods_weight')); // goods_weight
		$hash .= GetFieldHash($rs->fields('image1_id')); // image1_id
		$hash .= GetFieldHash($rs->fields('image2_id')); // image2_id
		$hash .= GetFieldHash($rs->fields('image3_id')); // image3_id
		$hash .= GetFieldHash($rs->fields('image4_id')); // image4_id
		return md5($hash);
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// from_place
		$this->from_place->setDbValueDef($rsnew, $this->from_place->CurrentValue, "", FALSE);

		// to_place
		$this->to_place->setDbValueDef($rsnew, $this->to_place->CurrentValue, "", FALSE);

		// description
		$this->description->setDbValueDef($rsnew, $this->description->CurrentValue, NULL, FALSE);

		// user_id
		$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, FALSE);

		// from_date
		$this->from_date->setDbValueDef($rsnew, UnFormatDateTime($this->from_date->CurrentValue, 0), NULL, FALSE);

		// to_date
		$this->to_date->setDbValueDef($rsnew, UnFormatDateTime($this->to_date->CurrentValue, 0), NULL, FALSE);

		// createdAt
		$this->createdAt->setDbValueDef($rsnew, UnFormatDateTime($this->createdAt->CurrentValue, 0), CurrentDate(), FALSE);

		// updatedAt
		$this->updatedAt->setDbValueDef($rsnew, UnFormatDateTime($this->updatedAt->CurrentValue, 0), CurrentDate(), FALSE);

		// labor_fee
		$this->labor_fee->setDbValueDef($rsnew, $this->labor_fee->CurrentValue, NULL, FALSE);

		// applicable
		$this->applicable->setDbValueDef($rsnew, $this->applicable->CurrentValue, 0, strval($this->applicable->CurrentValue) == "");

		// service_type
		$this->service_type->setDbValueDef($rsnew, $this->service_type->CurrentValue, 0, strval($this->service_type->CurrentValue) == "");

		// goods_category
		$this->goods_category->setDbValueDef($rsnew, $this->goods_category->CurrentValue, NULL, FALSE);

		// goods_weight
		$this->goods_weight->setDbValueDef($rsnew, $this->goods_weight->CurrentValue, NULL, FALSE);

		// image1_id
		$this->image1_id->setDbValueDef($rsnew, $this->image1_id->CurrentValue, NULL, FALSE);

		// image2_id
		$this->image2_id->setDbValueDef($rsnew, $this->image2_id->CurrentValue, NULL, FALSE);

		// image3_id
		$this->image3_id->setDbValueDef($rsnew, $this->image3_id->CurrentValue, NULL, FALSE);

		// image4_id
		$this->image4_id->setDbValueDef($rsnew, $this->image4_id->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
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

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$url = "";
		$item->Body = "<button id=\"emf_request_trip\" class=\"ew-export-link ew-email\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew.emailDialogShow({lnk:'emf_request_trip',hdr:ew.language.phrase('ExportToEmailText'),f:document.frequest_triplist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	protected function exportData()
	{
		$utf8 = SameText(PROJECT_CHARSET, "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecs = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->setupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRec - 1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if ($selectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRec, $this->StopRec, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer
		if (!DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (DEBUG_ENABLED && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {
			echo $this->exportEmail($doc->Text);
		} else {
			$doc->export();
		}
	}

	// Export email
	protected function exportEmail($emailContent)
	{
		global $TempImages, $Language;
		$sender = Post("sender", "");
		$recipient = Post("recipient", "");
		$cc = Post("cc", "");
		$bcc = Post("bcc", "");

		// Subject
		$subject = Post("subject", "");
		$emailSubject = $subject;

		// Message
		$content = Post("message", "");
		$emailMessage = $content;

		// Check sender
		if ($sender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!CheckEmail($sender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!CheckEmailList($recipient, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!CheckEmailList($cc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!CheckEmailList($bcc, MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EXPORT_EMAIL_COUNTER]))
			$_SESSION[EXPORT_EMAIL_COUNTER] = 0;
		if ((int)$_SESSION[EXPORT_EMAIL_COUNTER] > MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$email = new Email();
		$email->Sender = $sender; // Sender
		$email->Recipient = $recipient; // Recipient
		$email->Cc = $cc; // Cc
		$email->Bcc = $bcc; // Bcc
		$email->Subject = $emailSubject; // Subject
		$email->Format = "html";
		if ($emailMessage <> "")
			$emailMessage = RemoveXss($emailMessage) . "<br><br>";
		foreach ($TempImages as $tmpImage)
			$email->addEmbeddedImage($tmpImage);
		$email->Content = $emailMessage . CleanEmailContent($emailContent); // Content
		$eventArgs = [];
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->moveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->move($this->StartRec - 1);
			$eventArgs["rs"] = &$this->Recordset;
		}
		$emailSent = FALSE;
		if ($this->Email_Sending($email, $eventArgs))
			$emailSent = $email->send();

		// Check email sent status
		if ($emailSent) {

			// Update email sent count
			$_SESSION[EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $email->SendErrDescription . "</p>";
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
}
?>
