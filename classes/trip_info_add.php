<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class trip_info_add extends trip_info
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'trip_info';

	// Page object name
	public $PageObjName = "trip_info_add";

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

		// Table object (trip_info)
		if (!isset($GLOBALS["trip_info"]) || get_class($GLOBALS["trip_info"]) == PROJECT_NAMESPACE . "trip_info") {
			$GLOBALS["trip_info"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["trip_info"];
		}

		// Table object (user)
		if (!isset($GLOBALS['user'])) $GLOBALS['user'] = new user();

		// Table object (admin)
		if (!isset($GLOBALS['admin'])) $GLOBALS['admin'] = new admin();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'trip_info');

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
		global $EXPORT, $trip_info;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($trip_info);
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
					if ($pageName == "trip_infoview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("trip_infolist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->from_place->setVisibility();
		$this->to_place->setVisibility();
		$this->description->setVisibility();
		$this->user_id->setVisibility();
		$this->flight_number->setVisibility();
		$this->createdAt->setVisibility();
		$this->updatedAt->setVisibility();
		$this->from_date->setVisibility();
		$this->to_date->setVisibility();
		$this->labor_fee->setVisibility();
		$this->available->setVisibility();
		$this->service_type->setVisibility();
		$this->max_carrying_weight->setVisibility();
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
		$this->setupLookupOptions($this->user_id);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";

		// Set up master/detail parameters
		$this->setupMasterParms();
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi())
					$this->terminate();
				else
					$this->CurrentAction = "show"; // Form error, reset action
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->terminate("trip_infolist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "trip_infolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "trip_infoview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) // Return to caller
						$this->terminate(TRUE);
					else
						$this->terminate($returnUrl);
				} elseif (IsApi()) { // API request, return
					$this->terminate();
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
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
		$this->flight_number->CurrentValue = NULL;
		$this->flight_number->OldValue = $this->flight_number->CurrentValue;
		$this->createdAt->CurrentValue = NULL;
		$this->createdAt->OldValue = $this->createdAt->CurrentValue;
		$this->updatedAt->CurrentValue = NULL;
		$this->updatedAt->OldValue = $this->updatedAt->CurrentValue;
		$this->from_date->CurrentValue = NULL;
		$this->from_date->OldValue = $this->from_date->CurrentValue;
		$this->to_date->CurrentValue = NULL;
		$this->to_date->OldValue = $this->to_date->CurrentValue;
		$this->labor_fee->CurrentValue = NULL;
		$this->labor_fee->OldValue = $this->labor_fee->CurrentValue;
		$this->available->CurrentValue = NULL;
		$this->available->OldValue = $this->available->CurrentValue;
		$this->service_type->CurrentValue = 1;
		$this->max_carrying_weight->CurrentValue = NULL;
		$this->max_carrying_weight->OldValue = $this->max_carrying_weight->CurrentValue;
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

		// Check field name 'to_place' first before field var 'x_to_place'
		$val = $CurrentForm->hasValue("to_place") ? $CurrentForm->getValue("to_place") : $CurrentForm->getValue("x_to_place");
		if (!$this->to_place->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->to_place->Visible = FALSE; // Disable update for API request
			else
				$this->to_place->setFormValue($val);
		}

		// Check field name 'description' first before field var 'x_description'
		$val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
		if (!$this->description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->description->Visible = FALSE; // Disable update for API request
			else
				$this->description->setFormValue($val);
		}

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}

		// Check field name 'flight_number' first before field var 'x_flight_number'
		$val = $CurrentForm->hasValue("flight_number") ? $CurrentForm->getValue("flight_number") : $CurrentForm->getValue("x_flight_number");
		if (!$this->flight_number->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->flight_number->Visible = FALSE; // Disable update for API request
			else
				$this->flight_number->setFormValue($val);
		}

		// Check field name 'createdAt' first before field var 'x_createdAt'
		$val = $CurrentForm->hasValue("createdAt") ? $CurrentForm->getValue("createdAt") : $CurrentForm->getValue("x_createdAt");
		if (!$this->createdAt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->createdAt->Visible = FALSE; // Disable update for API request
			else
				$this->createdAt->setFormValue($val);
			$this->createdAt->CurrentValue = UnFormatDateTime($this->createdAt->CurrentValue, 0);
		}

		// Check field name 'updatedAt' first before field var 'x_updatedAt'
		$val = $CurrentForm->hasValue("updatedAt") ? $CurrentForm->getValue("updatedAt") : $CurrentForm->getValue("x_updatedAt");
		if (!$this->updatedAt->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->updatedAt->Visible = FALSE; // Disable update for API request
			else
				$this->updatedAt->setFormValue($val);
			$this->updatedAt->CurrentValue = UnFormatDateTime($this->updatedAt->CurrentValue, 0);
		}

		// Check field name 'from_date' first before field var 'x_from_date'
		$val = $CurrentForm->hasValue("from_date") ? $CurrentForm->getValue("from_date") : $CurrentForm->getValue("x_from_date");
		if (!$this->from_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->from_date->Visible = FALSE; // Disable update for API request
			else
				$this->from_date->setFormValue($val);
			$this->from_date->CurrentValue = UnFormatDateTime($this->from_date->CurrentValue, 0);
		}

		// Check field name 'to_date' first before field var 'x_to_date'
		$val = $CurrentForm->hasValue("to_date") ? $CurrentForm->getValue("to_date") : $CurrentForm->getValue("x_to_date");
		if (!$this->to_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->to_date->Visible = FALSE; // Disable update for API request
			else
				$this->to_date->setFormValue($val);
			$this->to_date->CurrentValue = UnFormatDateTime($this->to_date->CurrentValue, 0);
		}

		// Check field name 'labor_fee' first before field var 'x_labor_fee'
		$val = $CurrentForm->hasValue("labor_fee") ? $CurrentForm->getValue("labor_fee") : $CurrentForm->getValue("x_labor_fee");
		if (!$this->labor_fee->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->labor_fee->Visible = FALSE; // Disable update for API request
			else
				$this->labor_fee->setFormValue($val);
		}

		// Check field name 'available' first before field var 'x_available'
		$val = $CurrentForm->hasValue("available") ? $CurrentForm->getValue("available") : $CurrentForm->getValue("x_available");
		if (!$this->available->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->available->Visible = FALSE; // Disable update for API request
			else
				$this->available->setFormValue($val);
		}

		// Check field name 'service_type' first before field var 'x_service_type'
		$val = $CurrentForm->hasValue("service_type") ? $CurrentForm->getValue("service_type") : $CurrentForm->getValue("x_service_type");
		if (!$this->service_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->service_type->Visible = FALSE; // Disable update for API request
			else
				$this->service_type->setFormValue($val);
		}

		// Check field name 'max_carrying_weight' first before field var 'x_max_carrying_weight'
		$val = $CurrentForm->hasValue("max_carrying_weight") ? $CurrentForm->getValue("max_carrying_weight") : $CurrentForm->getValue("x_max_carrying_weight");
		if (!$this->max_carrying_weight->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->max_carrying_weight->Visible = FALSE; // Disable update for API request
			else
				$this->max_carrying_weight->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->from_place->CurrentValue = $this->from_place->FormValue;
		$this->to_place->CurrentValue = $this->to_place->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->flight_number->CurrentValue = $this->flight_number->FormValue;
		$this->createdAt->CurrentValue = $this->createdAt->FormValue;
		$this->createdAt->CurrentValue = UnFormatDateTime($this->createdAt->CurrentValue, 0);
		$this->updatedAt->CurrentValue = $this->updatedAt->FormValue;
		$this->updatedAt->CurrentValue = UnFormatDateTime($this->updatedAt->CurrentValue, 0);
		$this->from_date->CurrentValue = $this->from_date->FormValue;
		$this->from_date->CurrentValue = UnFormatDateTime($this->from_date->CurrentValue, 0);
		$this->to_date->CurrentValue = $this->to_date->FormValue;
		$this->to_date->CurrentValue = UnFormatDateTime($this->to_date->CurrentValue, 0);
		$this->labor_fee->CurrentValue = $this->labor_fee->FormValue;
		$this->available->CurrentValue = $this->available->FormValue;
		$this->service_type->CurrentValue = $this->service_type->FormValue;
		$this->max_carrying_weight->CurrentValue = $this->max_carrying_weight->FormValue;
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
		$this->flight_number->setDbValue($row['flight_number']);
		$this->createdAt->setDbValue($row['createdAt']);
		$this->updatedAt->setDbValue($row['updatedAt']);
		$this->from_date->setDbValue($row['from_date']);
		$this->to_date->setDbValue($row['to_date']);
		$this->labor_fee->setDbValue($row['labor_fee']);
		$this->available->setDbValue($row['available']);
		$this->service_type->setDbValue($row['service_type']);
		$this->max_carrying_weight->setDbValue($row['max_carrying_weight']);
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
		$row['flight_number'] = $this->flight_number->CurrentValue;
		$row['createdAt'] = $this->createdAt->CurrentValue;
		$row['updatedAt'] = $this->updatedAt->CurrentValue;
		$row['from_date'] = $this->from_date->CurrentValue;
		$row['to_date'] = $this->to_date->CurrentValue;
		$row['labor_fee'] = $this->labor_fee->CurrentValue;
		$row['available'] = $this->available->CurrentValue;
		$row['service_type'] = $this->service_type->CurrentValue;
		$row['max_carrying_weight'] = $this->max_carrying_weight->CurrentValue;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// from_place
		// to_place
		// description
		// user_id
		// flight_number
		// createdAt
		// updatedAt
		// from_date
		// to_date
		// labor_fee
		// available
		// service_type
		// max_carrying_weight

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
			$curVal = strval($this->user_id->CurrentValue);
			if ($curVal <> "") {
				$this->user_id->ViewValue = $this->user_id->lookupCacheOption($curVal);
				if ($this->user_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->user_id->ViewValue = $this->user_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->user_id->ViewValue = $this->user_id->CurrentValue;
					}
				}
			} else {
				$this->user_id->ViewValue = NULL;
			}
			$this->user_id->ViewCustomAttributes = "";

			// flight_number
			$this->flight_number->ViewValue = $this->flight_number->CurrentValue;
			$this->flight_number->ViewCustomAttributes = "";

			// createdAt
			$this->createdAt->ViewValue = $this->createdAt->CurrentValue;
			$this->createdAt->ViewValue = FormatDateTime($this->createdAt->ViewValue, 0);
			$this->createdAt->ViewCustomAttributes = "";

			// updatedAt
			$this->updatedAt->ViewValue = $this->updatedAt->CurrentValue;
			$this->updatedAt->ViewValue = FormatDateTime($this->updatedAt->ViewValue, 0);
			$this->updatedAt->ViewCustomAttributes = "";

			// from_date
			$this->from_date->ViewValue = $this->from_date->CurrentValue;
			$this->from_date->ViewValue = FormatDateTime($this->from_date->ViewValue, 0);
			$this->from_date->ViewCustomAttributes = "";

			// to_date
			$this->to_date->ViewValue = $this->to_date->CurrentValue;
			$this->to_date->ViewValue = FormatDateTime($this->to_date->ViewValue, 0);
			$this->to_date->ViewCustomAttributes = "";

			// labor_fee
			$this->labor_fee->ViewValue = $this->labor_fee->CurrentValue;
			$this->labor_fee->ViewValue = FormatNumber($this->labor_fee->ViewValue, 0, -2, -2, -2);
			$this->labor_fee->ViewCustomAttributes = "";

			// available
			$this->available->ViewValue = $this->available->CurrentValue;
			$this->available->ViewValue = FormatNumber($this->available->ViewValue, 0, -2, -2, -2);
			$this->available->ViewCustomAttributes = "";

			// service_type
			$this->service_type->ViewValue = $this->service_type->CurrentValue;
			$this->service_type->ViewValue = FormatNumber($this->service_type->ViewValue, 0, -2, -2, -2);
			$this->service_type->ViewCustomAttributes = "";

			// max_carrying_weight
			$this->max_carrying_weight->ViewValue = $this->max_carrying_weight->CurrentValue;
			$this->max_carrying_weight->ViewValue = FormatNumber($this->max_carrying_weight->ViewValue, 0, -2, -2, -2);
			$this->max_carrying_weight->ViewCustomAttributes = "";

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

			// flight_number
			$this->flight_number->LinkCustomAttributes = "";
			$this->flight_number->HrefValue = "";
			$this->flight_number->TooltipValue = "";

			// createdAt
			$this->createdAt->LinkCustomAttributes = "";
			$this->createdAt->HrefValue = "";
			$this->createdAt->TooltipValue = "";

			// updatedAt
			$this->updatedAt->LinkCustomAttributes = "";
			$this->updatedAt->HrefValue = "";
			$this->updatedAt->TooltipValue = "";

			// from_date
			$this->from_date->LinkCustomAttributes = "";
			$this->from_date->HrefValue = "";
			$this->from_date->TooltipValue = "";

			// to_date
			$this->to_date->LinkCustomAttributes = "";
			$this->to_date->HrefValue = "";
			$this->to_date->TooltipValue = "";

			// labor_fee
			$this->labor_fee->LinkCustomAttributes = "";
			$this->labor_fee->HrefValue = "";
			$this->labor_fee->TooltipValue = "";

			// available
			$this->available->LinkCustomAttributes = "";
			$this->available->HrefValue = "";
			$this->available->TooltipValue = "";

			// service_type
			$this->service_type->LinkCustomAttributes = "";
			$this->service_type->HrefValue = "";
			$this->service_type->TooltipValue = "";

			// max_carrying_weight
			$this->max_carrying_weight->LinkCustomAttributes = "";
			$this->max_carrying_weight->HrefValue = "";
			$this->max_carrying_weight->TooltipValue = "";
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
			if ($this->user_id->getSessionValue() <> "") {
				$this->user_id->CurrentValue = $this->user_id->getSessionValue();
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$curVal = strval($this->user_id->CurrentValue);
			if ($curVal <> "") {
				$this->user_id->ViewValue = $this->user_id->lookupCacheOption($curVal);
				if ($this->user_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->user_id->ViewValue = $this->user_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->user_id->ViewValue = $this->user_id->CurrentValue;
					}
				}
			} else {
				$this->user_id->ViewValue = NULL;
			}
			$this->user_id->ViewCustomAttributes = "";
			} else {
			$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
			$curVal = strval($this->user_id->CurrentValue);
			if ($curVal <> "") {
				$this->user_id->EditValue = $this->user_id->lookupCacheOption($curVal);
				if ($this->user_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->user_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->user_id->EditValue = $this->user_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
					}
				}
			} else {
				$this->user_id->EditValue = NULL;
			}
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
			}

			// flight_number
			$this->flight_number->EditAttrs["class"] = "form-control";
			$this->flight_number->EditCustomAttributes = "";
			$this->flight_number->EditValue = HtmlEncode($this->flight_number->CurrentValue);
			$this->flight_number->PlaceHolder = RemoveHtml($this->flight_number->caption());

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

			// labor_fee
			$this->labor_fee->EditAttrs["class"] = "form-control";
			$this->labor_fee->EditCustomAttributes = "";
			$this->labor_fee->EditValue = HtmlEncode($this->labor_fee->CurrentValue);
			$this->labor_fee->PlaceHolder = RemoveHtml($this->labor_fee->caption());

			// available
			$this->available->EditAttrs["class"] = "form-control";
			$this->available->EditCustomAttributes = "";
			$this->available->EditValue = HtmlEncode($this->available->CurrentValue);
			$this->available->PlaceHolder = RemoveHtml($this->available->caption());

			// service_type
			$this->service_type->EditAttrs["class"] = "form-control";
			$this->service_type->EditCustomAttributes = "";
			$this->service_type->EditValue = HtmlEncode($this->service_type->CurrentValue);
			$this->service_type->PlaceHolder = RemoveHtml($this->service_type->caption());

			// max_carrying_weight
			$this->max_carrying_weight->EditAttrs["class"] = "form-control";
			$this->max_carrying_weight->EditCustomAttributes = "";
			$this->max_carrying_weight->EditValue = HtmlEncode($this->max_carrying_weight->CurrentValue);
			$this->max_carrying_weight->PlaceHolder = RemoveHtml($this->max_carrying_weight->caption());

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

			// flight_number
			$this->flight_number->LinkCustomAttributes = "";
			$this->flight_number->HrefValue = "";

			// createdAt
			$this->createdAt->LinkCustomAttributes = "";
			$this->createdAt->HrefValue = "";

			// updatedAt
			$this->updatedAt->LinkCustomAttributes = "";
			$this->updatedAt->HrefValue = "";

			// from_date
			$this->from_date->LinkCustomAttributes = "";
			$this->from_date->HrefValue = "";

			// to_date
			$this->to_date->LinkCustomAttributes = "";
			$this->to_date->HrefValue = "";

			// labor_fee
			$this->labor_fee->LinkCustomAttributes = "";
			$this->labor_fee->HrefValue = "";

			// available
			$this->available->LinkCustomAttributes = "";
			$this->available->HrefValue = "";

			// service_type
			$this->service_type->LinkCustomAttributes = "";
			$this->service_type->HrefValue = "";

			// max_carrying_weight
			$this->max_carrying_weight->LinkCustomAttributes = "";
			$this->max_carrying_weight->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		if ($this->flight_number->Required) {
			if (!$this->flight_number->IsDetailKey && $this->flight_number->FormValue != NULL && $this->flight_number->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->flight_number->caption(), $this->flight_number->RequiredErrorMessage));
			}
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
		if ($this->labor_fee->Required) {
			if (!$this->labor_fee->IsDetailKey && $this->labor_fee->FormValue != NULL && $this->labor_fee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->labor_fee->caption(), $this->labor_fee->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->labor_fee->FormValue)) {
			AddMessage($FormError, $this->labor_fee->errorMessage());
		}
		if ($this->available->Required) {
			if (!$this->available->IsDetailKey && $this->available->FormValue != NULL && $this->available->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->available->caption(), $this->available->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->available->FormValue)) {
			AddMessage($FormError, $this->available->errorMessage());
		}
		if ($this->service_type->Required) {
			if (!$this->service_type->IsDetailKey && $this->service_type->FormValue != NULL && $this->service_type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->service_type->caption(), $this->service_type->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->service_type->FormValue)) {
			AddMessage($FormError, $this->service_type->errorMessage());
		}
		if ($this->max_carrying_weight->Required) {
			if (!$this->max_carrying_weight->IsDetailKey && $this->max_carrying_weight->FormValue != NULL && $this->max_carrying_weight->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->max_carrying_weight->caption(), $this->max_carrying_weight->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->max_carrying_weight->FormValue)) {
			AddMessage($FormError, $this->max_carrying_weight->errorMessage());
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

		// flight_number
		$this->flight_number->setDbValueDef($rsnew, $this->flight_number->CurrentValue, "", FALSE);

		// createdAt
		$this->createdAt->setDbValueDef($rsnew, UnFormatDateTime($this->createdAt->CurrentValue, 0), NULL, FALSE);

		// updatedAt
		$this->updatedAt->setDbValueDef($rsnew, UnFormatDateTime($this->updatedAt->CurrentValue, 0), NULL, FALSE);

		// from_date
		$this->from_date->setDbValueDef($rsnew, UnFormatDateTime($this->from_date->CurrentValue, 0), CurrentDate(), FALSE);

		// to_date
		$this->to_date->setDbValueDef($rsnew, UnFormatDateTime($this->to_date->CurrentValue, 0), NULL, FALSE);

		// labor_fee
		$this->labor_fee->setDbValueDef($rsnew, $this->labor_fee->CurrentValue, NULL, FALSE);

		// available
		$this->available->setDbValueDef($rsnew, $this->available->CurrentValue, NULL, FALSE);

		// service_type
		$this->service_type->setDbValueDef($rsnew, $this->service_type->CurrentValue, 0, strval($this->service_type->CurrentValue) == "");

		// max_carrying_weight
		$this->max_carrying_weight->setDbValueDef($rsnew, $this->max_carrying_weight->CurrentValue, NULL, FALSE);

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (Get(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Get(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "user") {
				$validMaster = TRUE;
				if (Get("fk_id") !== NULL) {
					$GLOBALS["user"]->id->setQueryStringValue(Get("fk_id"));
					$this->user_id->setQueryStringValue($GLOBALS["user"]->id->QueryStringValue);
					$this->user_id->setSessionValue($this->user_id->QueryStringValue);
					if (!is_numeric($GLOBALS["user"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (Post(TABLE_SHOW_MASTER) !== NULL) {
			$masterTblVar = Post(TABLE_SHOW_MASTER);
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "user") {
				$validMaster = TRUE;
				if (Post("fk_id") !== NULL) {
					$GLOBALS["user"]->id->setFormValue(Post("fk_id"));
					$this->user_id->setFormValue($GLOBALS["user"]->id->FormValue);
					$this->user_id->setSessionValue($this->user_id->FormValue);
					if (!is_numeric($GLOBALS["user"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($masterTblVar <> "user") {
				if ($this->user_id->CurrentValue == "")
					$this->user_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("trip_infolist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
						case "x_user_id":
							break;
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
