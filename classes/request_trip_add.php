<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class request_trip_add extends request_trip
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'request_trip';

	// Page object name
	public $PageObjName = "request_trip_add";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
					$this->terminate(GetUrl("request_triplist.php"));
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
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
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
					$this->terminate("request_triplist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "request_triplist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "request_tripview.php")
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
		$this->service_type->CurrentValue = 1;
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

		// Check field name 'labor_fee' first before field var 'x_labor_fee'
		$val = $CurrentForm->hasValue("labor_fee") ? $CurrentForm->getValue("labor_fee") : $CurrentForm->getValue("x_labor_fee");
		if (!$this->labor_fee->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->labor_fee->Visible = FALSE; // Disable update for API request
			else
				$this->labor_fee->setFormValue($val);
		}

		// Check field name 'applicable' first before field var 'x_applicable'
		$val = $CurrentForm->hasValue("applicable") ? $CurrentForm->getValue("applicable") : $CurrentForm->getValue("x_applicable");
		if (!$this->applicable->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->applicable->Visible = FALSE; // Disable update for API request
			else
				$this->applicable->setFormValue($val);
		}

		// Check field name 'service_type' first before field var 'x_service_type'
		$val = $CurrentForm->hasValue("service_type") ? $CurrentForm->getValue("service_type") : $CurrentForm->getValue("x_service_type");
		if (!$this->service_type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->service_type->Visible = FALSE; // Disable update for API request
			else
				$this->service_type->setFormValue($val);
		}

		// Check field name 'goods_category' first before field var 'x_goods_category'
		$val = $CurrentForm->hasValue("goods_category") ? $CurrentForm->getValue("goods_category") : $CurrentForm->getValue("x_goods_category");
		if (!$this->goods_category->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->goods_category->Visible = FALSE; // Disable update for API request
			else
				$this->goods_category->setFormValue($val);
		}

		// Check field name 'goods_weight' first before field var 'x_goods_weight'
		$val = $CurrentForm->hasValue("goods_weight") ? $CurrentForm->getValue("goods_weight") : $CurrentForm->getValue("x_goods_weight");
		if (!$this->goods_weight->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->goods_weight->Visible = FALSE; // Disable update for API request
			else
				$this->goods_weight->setFormValue($val);
		}

		// Check field name 'image1_id' first before field var 'x_image1_id'
		$val = $CurrentForm->hasValue("image1_id") ? $CurrentForm->getValue("image1_id") : $CurrentForm->getValue("x_image1_id");
		if (!$this->image1_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image1_id->Visible = FALSE; // Disable update for API request
			else
				$this->image1_id->setFormValue($val);
		}

		// Check field name 'image2_id' first before field var 'x_image2_id'
		$val = $CurrentForm->hasValue("image2_id") ? $CurrentForm->getValue("image2_id") : $CurrentForm->getValue("x_image2_id");
		if (!$this->image2_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image2_id->Visible = FALSE; // Disable update for API request
			else
				$this->image2_id->setFormValue($val);
		}

		// Check field name 'image3_id' first before field var 'x_image3_id'
		$val = $CurrentForm->hasValue("image3_id") ? $CurrentForm->getValue("image3_id") : $CurrentForm->getValue("x_image3_id");
		if (!$this->image3_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image3_id->Visible = FALSE; // Disable update for API request
			else
				$this->image3_id->setFormValue($val);
		}

		// Check field name 'image4_id' first before field var 'x_image4_id'
		$val = $CurrentForm->hasValue("image4_id") ? $CurrentForm->getValue("image4_id") : $CurrentForm->getValue("x_image4_id");
		if (!$this->image4_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image4_id->Visible = FALSE; // Disable update for API request
			else
				$this->image4_id->setFormValue($val);
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("request_triplist.php"), "", $this->TableVar, TRUE);
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
