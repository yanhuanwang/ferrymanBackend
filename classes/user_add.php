<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class user_add extends user
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'user';

	// Page object name
	public $PageObjName = "user_add";

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

		// Table object (user)
		if (!isset($GLOBALS["user"]) || get_class($GLOBALS["user"]) == PROJECT_NAMESPACE . "user") {
			$GLOBALS["user"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["user"];
		}

		// Table object (admin)
		if (!isset($GLOBALS['admin'])) $GLOBALS['admin'] = new admin();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'user');

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
		global $EXPORT, $user;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($user);
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
					if ($pageName == "userview.php")
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
	public $DetailPages; // Detail pages object

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
					$this->terminate(GetUrl("userlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->username->setVisibility();
		$this->password->setVisibility();
		$this->_email->setVisibility();
		$this->gender->setVisibility();
		$this->phone->setVisibility();
		$this->address->setVisibility();
		$this->country->setVisibility();
		$this->photo->setVisibility();
		$this->nickname->setVisibility();
		$this->region->setVisibility();
		$this->locked->setVisibility();
		$this->send_role->setVisibility();
		$this->carrier_role->setVisibility();
		$this->birthday->setVisibility();
		$this->addDate->Visible = FALSE;
		$this->updateDate->Visible = FALSE;
		$this->activated->setVisibility();
		$this->hideFieldsForAddEdit();

		// Set up detail page object
		$this->setupDetailPages();

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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("userlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "userlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "userview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view type
		} else {
			$this->RowType = ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->photo->Upload->Index = $CurrentForm->Index;
		$this->photo->Upload->uploadFile();
		$this->photo->CurrentValue = $this->photo->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->password->CurrentValue = NULL;
		$this->password->OldValue = $this->password->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->gender->CurrentValue = NULL;
		$this->gender->OldValue = $this->gender->CurrentValue;
		$this->phone->CurrentValue = NULL;
		$this->phone->OldValue = $this->phone->CurrentValue;
		$this->address->CurrentValue = NULL;
		$this->address->OldValue = $this->address->CurrentValue;
		$this->country->CurrentValue = NULL;
		$this->country->OldValue = $this->country->CurrentValue;
		$this->photo->Upload->DbValue = NULL;
		$this->photo->OldValue = $this->photo->Upload->DbValue;
		$this->photo->CurrentValue = NULL; // Clear file related field
		$this->nickname->CurrentValue = NULL;
		$this->nickname->OldValue = $this->nickname->CurrentValue;
		$this->region->CurrentValue = NULL;
		$this->region->OldValue = $this->region->CurrentValue;
		$this->locked->CurrentValue = NULL;
		$this->locked->OldValue = $this->locked->CurrentValue;
		$this->send_role->CurrentValue = NULL;
		$this->send_role->OldValue = $this->send_role->CurrentValue;
		$this->carrier_role->CurrentValue = NULL;
		$this->carrier_role->OldValue = $this->carrier_role->CurrentValue;
		$this->birthday->CurrentValue = NULL;
		$this->birthday->OldValue = $this->birthday->CurrentValue;
		$this->addDate->CurrentValue = NULL;
		$this->addDate->OldValue = $this->addDate->CurrentValue;
		$this->updateDate->CurrentValue = NULL;
		$this->updateDate->OldValue = $this->updateDate->CurrentValue;
		$this->activated->CurrentValue = NULL;
		$this->activated->OldValue = $this->activated->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'username' first before field var 'x_username'
		$val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x_username");
		if (!$this->username->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->username->Visible = FALSE; // Disable update for API request
			else
				$this->username->setFormValue($val);
		}

		// Check field name 'password' first before field var 'x_password'
		$val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x_password");
		if (!$this->password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->password->Visible = FALSE; // Disable update for API request
			else
				$this->password->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'gender' first before field var 'x_gender'
		$val = $CurrentForm->hasValue("gender") ? $CurrentForm->getValue("gender") : $CurrentForm->getValue("x_gender");
		if (!$this->gender->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->gender->Visible = FALSE; // Disable update for API request
			else
				$this->gender->setFormValue($val);
		}

		// Check field name 'phone' first before field var 'x_phone'
		$val = $CurrentForm->hasValue("phone") ? $CurrentForm->getValue("phone") : $CurrentForm->getValue("x_phone");
		if (!$this->phone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->phone->Visible = FALSE; // Disable update for API request
			else
				$this->phone->setFormValue($val);
		}

		// Check field name 'address' first before field var 'x_address'
		$val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
		if (!$this->address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->address->Visible = FALSE; // Disable update for API request
			else
				$this->address->setFormValue($val);
		}

		// Check field name 'country' first before field var 'x_country'
		$val = $CurrentForm->hasValue("country") ? $CurrentForm->getValue("country") : $CurrentForm->getValue("x_country");
		if (!$this->country->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->country->Visible = FALSE; // Disable update for API request
			else
				$this->country->setFormValue($val);
		}

		// Check field name 'nickname' first before field var 'x_nickname'
		$val = $CurrentForm->hasValue("nickname") ? $CurrentForm->getValue("nickname") : $CurrentForm->getValue("x_nickname");
		if (!$this->nickname->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nickname->Visible = FALSE; // Disable update for API request
			else
				$this->nickname->setFormValue($val);
		}

		// Check field name 'region' first before field var 'x_region'
		$val = $CurrentForm->hasValue("region") ? $CurrentForm->getValue("region") : $CurrentForm->getValue("x_region");
		if (!$this->region->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->region->Visible = FALSE; // Disable update for API request
			else
				$this->region->setFormValue($val);
		}

		// Check field name 'locked' first before field var 'x_locked'
		$val = $CurrentForm->hasValue("locked") ? $CurrentForm->getValue("locked") : $CurrentForm->getValue("x_locked");
		if (!$this->locked->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->locked->Visible = FALSE; // Disable update for API request
			else
				$this->locked->setFormValue($val);
		}

		// Check field name 'send_role' first before field var 'x_send_role'
		$val = $CurrentForm->hasValue("send_role") ? $CurrentForm->getValue("send_role") : $CurrentForm->getValue("x_send_role");
		if (!$this->send_role->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->send_role->Visible = FALSE; // Disable update for API request
			else
				$this->send_role->setFormValue($val);
		}

		// Check field name 'carrier_role' first before field var 'x_carrier_role'
		$val = $CurrentForm->hasValue("carrier_role") ? $CurrentForm->getValue("carrier_role") : $CurrentForm->getValue("x_carrier_role");
		if (!$this->carrier_role->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->carrier_role->Visible = FALSE; // Disable update for API request
			else
				$this->carrier_role->setFormValue($val);
		}

		// Check field name 'birthday' first before field var 'x_birthday'
		$val = $CurrentForm->hasValue("birthday") ? $CurrentForm->getValue("birthday") : $CurrentForm->getValue("x_birthday");
		if (!$this->birthday->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->birthday->Visible = FALSE; // Disable update for API request
			else
				$this->birthday->setFormValue($val);
			$this->birthday->CurrentValue = UnFormatDateTime($this->birthday->CurrentValue, 0);
		}

		// Check field name 'activated' first before field var 'x_activated'
		$val = $CurrentForm->hasValue("activated") ? $CurrentForm->getValue("activated") : $CurrentForm->getValue("x_activated");
		if (!$this->activated->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->activated->Visible = FALSE; // Disable update for API request
			else
				$this->activated->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->username->CurrentValue = $this->username->FormValue;
		$this->password->CurrentValue = $this->password->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->gender->CurrentValue = $this->gender->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->country->CurrentValue = $this->country->FormValue;
		$this->nickname->CurrentValue = $this->nickname->FormValue;
		$this->region->CurrentValue = $this->region->FormValue;
		$this->locked->CurrentValue = $this->locked->FormValue;
		$this->send_role->CurrentValue = $this->send_role->FormValue;
		$this->carrier_role->CurrentValue = $this->carrier_role->FormValue;
		$this->birthday->CurrentValue = $this->birthday->FormValue;
		$this->birthday->CurrentValue = UnFormatDateTime($this->birthday->CurrentValue, 0);
		$this->activated->CurrentValue = $this->activated->FormValue;
		$this->resetDetailParms();
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
		$this->username->setDbValue($row['username']);
		$this->password->setDbValue($row['password']);
		$this->_email->setDbValue($row['email']);
		$this->gender->setDbValue($row['gender']);
		$this->phone->setDbValue($row['phone']);
		$this->address->setDbValue($row['address']);
		$this->country->setDbValue($row['country']);
		$this->photo->Upload->DbValue = $row['photo'];
		$this->photo->setDbValue($this->photo->Upload->DbValue);
		$this->nickname->setDbValue($row['nickname']);
		$this->region->setDbValue($row['region']);
		$this->locked->setDbValue($row['locked']);
		$this->send_role->setDbValue($row['send_role']);
		$this->carrier_role->setDbValue($row['carrier_role']);
		$this->birthday->setDbValue($row['birthday']);
		$this->addDate->setDbValue($row['addDate']);
		$this->updateDate->setDbValue($row['updateDate']);
		$this->activated->setDbValue($row['activated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		$row['password'] = $this->password->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['gender'] = $this->gender->CurrentValue;
		$row['phone'] = $this->phone->CurrentValue;
		$row['address'] = $this->address->CurrentValue;
		$row['country'] = $this->country->CurrentValue;
		$row['photo'] = $this->photo->Upload->DbValue;
		$row['nickname'] = $this->nickname->CurrentValue;
		$row['region'] = $this->region->CurrentValue;
		$row['locked'] = $this->locked->CurrentValue;
		$row['send_role'] = $this->send_role->CurrentValue;
		$row['carrier_role'] = $this->carrier_role->CurrentValue;
		$row['birthday'] = $this->birthday->CurrentValue;
		$row['addDate'] = $this->addDate->CurrentValue;
		$row['updateDate'] = $this->updateDate->CurrentValue;
		$row['activated'] = $this->activated->CurrentValue;
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
		// username
		// password
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// activated
			$this->activated->LinkCustomAttributes = "";
			$this->activated->HrefValue = "";
			$this->activated->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// username
			$this->username->EditAttrs["class"] = "form-control";
			$this->username->EditCustomAttributes = "";
			$this->username->EditValue = HtmlEncode($this->username->CurrentValue);
			$this->username->PlaceHolder = RemoveHtml($this->username->caption());

			// password
			$this->password->EditAttrs["class"] = "form-control";
			$this->password->EditCustomAttributes = "";
			$this->password->EditValue = HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = RemoveHtml($this->password->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// gender
			$this->gender->EditAttrs["class"] = "form-control";
			$this->gender->EditCustomAttributes = "";
			$this->gender->EditValue = $this->gender->options(TRUE);

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = RemoveHtml($this->address->caption());

			// country
			$this->country->EditAttrs["class"] = "form-control";
			$this->country->EditCustomAttributes = "";
			$this->country->EditValue = HtmlEncode($this->country->CurrentValue);
			$this->country->PlaceHolder = RemoveHtml($this->country->caption());

			// photo
			$this->photo->EditAttrs["class"] = "form-control";
			$this->photo->EditCustomAttributes = "";
			if (!EmptyValue($this->photo->Upload->DbValue)) {
				$this->photo->ImageAlt = $this->photo->alt();
				$this->photo->EditValue = $this->photo->Upload->DbValue;
			} else {
				$this->photo->EditValue = "";
			}
			if (!EmptyValue($this->photo->CurrentValue))
					$this->photo->Upload->FileName = $this->photo->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->photo);

			// nickname
			$this->nickname->EditAttrs["class"] = "form-control";
			$this->nickname->EditCustomAttributes = "";
			$this->nickname->EditValue = HtmlEncode($this->nickname->CurrentValue);
			$this->nickname->PlaceHolder = RemoveHtml($this->nickname->caption());

			// region
			$this->region->EditAttrs["class"] = "form-control";
			$this->region->EditCustomAttributes = "";
			$this->region->EditValue = HtmlEncode($this->region->CurrentValue);
			$this->region->PlaceHolder = RemoveHtml($this->region->caption());

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
			$this->birthday->EditValue = HtmlEncode(FormatDateTime($this->birthday->CurrentValue, 8));
			$this->birthday->PlaceHolder = RemoveHtml($this->birthday->caption());

			// activated
			$this->activated->EditAttrs["class"] = "form-control";
			$this->activated->EditCustomAttributes = "";
			$this->activated->EditValue = HtmlEncode($this->activated->CurrentValue);
			$this->activated->PlaceHolder = RemoveHtml($this->activated->caption());

			// Add refer script
			// username

			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// gender
			$this->gender->LinkCustomAttributes = "";
			$this->gender->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// country
			$this->country->LinkCustomAttributes = "";
			$this->country->HrefValue = "";

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

			// nickname
			$this->nickname->LinkCustomAttributes = "";
			$this->nickname->HrefValue = "";

			// region
			$this->region->LinkCustomAttributes = "";
			$this->region->HrefValue = "";

			// locked
			$this->locked->LinkCustomAttributes = "";
			$this->locked->HrefValue = "";

			// send_role
			$this->send_role->LinkCustomAttributes = "";
			$this->send_role->HrefValue = "";

			// carrier_role
			$this->carrier_role->LinkCustomAttributes = "";
			$this->carrier_role->HrefValue = "";

			// birthday
			$this->birthday->LinkCustomAttributes = "";
			$this->birthday->HrefValue = "";

			// activated
			$this->activated->LinkCustomAttributes = "";
			$this->activated->HrefValue = "";
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
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->username->caption(), $this->username->RequiredErrorMessage));
			}
		}
		if ($this->password->Required) {
			if (!$this->password->IsDetailKey && $this->password->FormValue != NULL && $this->password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->password->caption(), $this->password->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->_email->FormValue)) {
			AddMessage($FormError, $this->_email->errorMessage());
		}
		if ($this->gender->Required) {
			if (!$this->gender->IsDetailKey && $this->gender->FormValue != NULL && $this->gender->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->gender->caption(), $this->gender->RequiredErrorMessage));
			}
		}
		if ($this->phone->Required) {
			if (!$this->phone->IsDetailKey && $this->phone->FormValue != NULL && $this->phone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
			}
		}
		if ($this->address->Required) {
			if (!$this->address->IsDetailKey && $this->address->FormValue != NULL && $this->address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
			}
		}
		if ($this->country->Required) {
			if (!$this->country->IsDetailKey && $this->country->FormValue != NULL && $this->country->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->country->caption(), $this->country->RequiredErrorMessage));
			}
		}
		if ($this->photo->Required) {
			if ($this->photo->Upload->FileName == "" && !$this->photo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->photo->caption(), $this->photo->RequiredErrorMessage));
			}
		}
		if ($this->nickname->Required) {
			if (!$this->nickname->IsDetailKey && $this->nickname->FormValue != NULL && $this->nickname->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nickname->caption(), $this->nickname->RequiredErrorMessage));
			}
		}
		if ($this->region->Required) {
			if (!$this->region->IsDetailKey && $this->region->FormValue != NULL && $this->region->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->region->caption(), $this->region->RequiredErrorMessage));
			}
		}
		if ($this->locked->Required) {
			if (!$this->locked->IsDetailKey && $this->locked->FormValue != NULL && $this->locked->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->locked->caption(), $this->locked->RequiredErrorMessage));
			}
		}
		if ($this->send_role->Required) {
			if (!$this->send_role->IsDetailKey && $this->send_role->FormValue != NULL && $this->send_role->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->send_role->caption(), $this->send_role->RequiredErrorMessage));
			}
		}
		if ($this->carrier_role->Required) {
			if (!$this->carrier_role->IsDetailKey && $this->carrier_role->FormValue != NULL && $this->carrier_role->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->carrier_role->caption(), $this->carrier_role->RequiredErrorMessage));
			}
		}
		if ($this->birthday->Required) {
			if (!$this->birthday->IsDetailKey && $this->birthday->FormValue != NULL && $this->birthday->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->birthday->caption(), $this->birthday->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->birthday->FormValue)) {
			AddMessage($FormError, $this->birthday->errorMessage());
		}
		if ($this->addDate->Required) {
			if (!$this->addDate->IsDetailKey && $this->addDate->FormValue != NULL && $this->addDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->addDate->caption(), $this->addDate->RequiredErrorMessage));
			}
		}
		if ($this->updateDate->Required) {
			if (!$this->updateDate->IsDetailKey && $this->updateDate->FormValue != NULL && $this->updateDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updateDate->caption(), $this->updateDate->RequiredErrorMessage));
			}
		}
		if ($this->activated->Required) {
			if (!$this->activated->IsDetailKey && $this->activated->FormValue != NULL && $this->activated->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->activated->caption(), $this->activated->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->activated->FormValue)) {
			AddMessage($FormError, $this->activated->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("image", $detailTblVar) && $GLOBALS["image"]->DetailAdd) {
			if (!isset($GLOBALS["image_grid"]))
				$GLOBALS["image_grid"] = new image_grid(); // Get detail page object
			$GLOBALS["image_grid"]->validateGridForm();
		}
		if (in_array("trip_info", $detailTblVar) && $GLOBALS["trip_info"]->DetailAdd) {
			if (!isset($GLOBALS["trip_info_grid"]))
				$GLOBALS["trip_info_grid"] = new trip_info_grid(); // Get detail page object
			$GLOBALS["trip_info_grid"]->validateGridForm();
		}
		if (in_array("parcel_info", $detailTblVar) && $GLOBALS["parcel_info"]->DetailAdd) {
			if (!isset($GLOBALS["parcel_info_grid"]))
				$GLOBALS["parcel_info_grid"] = new parcel_info_grid(); // Get detail page object
			$GLOBALS["parcel_info_grid"]->validateGridForm();
		}
		if (in_array("orders", $detailTblVar) && $GLOBALS["orders"]->DetailAdd) {
			if (!isset($GLOBALS["orders_grid"]))
				$GLOBALS["orders_grid"] = new orders_grid(); // Get detail page object
			$GLOBALS["orders_grid"]->validateGridForm();
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
		if ($this->username->CurrentValue <> "") { // Check field with unique index
			$filter = "(username = '" . AdjustSql($this->username->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->username->caption(), $Language->Phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->username->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		if ($this->_email->CurrentValue <> "") { // Check field with unique index
			$filter = "(email = '" . AdjustSql($this->_email->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->_email->caption(), $Language->Phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->_email->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		if ($this->nickname->CurrentValue <> "") { // Check field with unique index
			$filter = "(nickname = '" . AdjustSql($this->nickname->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->nickname->caption(), $Language->Phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->nickname->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = &$this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// username
		$this->username->setDbValueDef($rsnew, $this->username->CurrentValue, "", FALSE);

		// password
		$this->password->setDbValueDef($rsnew, $this->password->CurrentValue, "", FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, "", FALSE);

		// gender
		$this->gender->setDbValueDef($rsnew, $this->gender->CurrentValue, 0, FALSE);

		// phone
		$this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, "", FALSE);

		// address
		$this->address->setDbValueDef($rsnew, $this->address->CurrentValue, "", FALSE);

		// country
		$this->country->setDbValueDef($rsnew, $this->country->CurrentValue, "", FALSE);

		// photo
		if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
			$this->photo->Upload->DbValue = ""; // No need to delete old file
			if ($this->photo->Upload->FileName == "") {
				$rsnew['photo'] = NULL;
			} else {
				$rsnew['photo'] = $this->photo->Upload->FileName;
			}
		}

		// nickname
		$this->nickname->setDbValueDef($rsnew, $this->nickname->CurrentValue, "", FALSE);

		// region
		$this->region->setDbValueDef($rsnew, $this->region->CurrentValue, "", FALSE);

		// locked
		$this->locked->setDbValueDef($rsnew, $this->locked->CurrentValue, 0, FALSE);

		// send_role
		$this->send_role->setDbValueDef($rsnew, $this->send_role->CurrentValue, 0, FALSE);

		// carrier_role
		$this->carrier_role->setDbValueDef($rsnew, $this->carrier_role->CurrentValue, 0, FALSE);

		// birthday
		$this->birthday->setDbValueDef($rsnew, UnFormatDateTime($this->birthday->CurrentValue, 0), CurrentDate(), FALSE);

		// activated
		$this->activated->setDbValueDef($rsnew, $this->activated->CurrentValue, 0, FALSE);
		if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->photo->Upload->DbValue) ? array() : array($this->photo->Upload->DbValue);
			if (!EmptyValue($this->photo->Upload->FileName)) {
				$newFiles = array($this->photo->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->photo, $this->photo->Upload->Index) . $file)) {
							if (DELETE_UPLOADED_FILES) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										unset($oldFiles[$j]);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->photo->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->photo, $this->photo->Upload->Index) . $file1) || file_exists($this->photo->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->photo->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->photo, $this->photo->Upload->Index) . $file, UploadTempPath($this->photo, $this->photo->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->photo->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->photo->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->photo->setDbValueDef($rsnew, $this->photo->Upload->FileName, "", FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->photo->Visible && !$this->photo->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->photo->Upload->DbValue) ? array() : array($this->photo->Upload->DbValue);
					if (!EmptyValue($this->photo->Upload->FileName)) {
						$newFiles = array($this->photo->Upload->FileName);
						$newFiles2 = array($rsnew['photo']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->photo, $this->photo->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->photo->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->Phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = array();
					}
					if (DELETE_UPLOADED_FILES) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile <> "" && !in_array($oldFile, $newFiles))
								@unlink($this->photo->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("image", $detailTblVar) && $GLOBALS["image"]->DetailAdd) {
				$GLOBALS["image"]->_userid->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["image_grid"]))
					$GLOBALS["image_grid"] = new image_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "image"); // Load user level of detail table
				$addRow = $GLOBALS["image_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["image"]->_userid->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("trip_info", $detailTblVar) && $GLOBALS["trip_info"]->DetailAdd) {
				$GLOBALS["trip_info"]->user_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["trip_info_grid"]))
					$GLOBALS["trip_info_grid"] = new trip_info_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "trip_info"); // Load user level of detail table
				$addRow = $GLOBALS["trip_info_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["trip_info"]->user_id->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("parcel_info", $detailTblVar) && $GLOBALS["parcel_info"]->DetailAdd) {
				$GLOBALS["parcel_info"]->user_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["parcel_info_grid"]))
					$GLOBALS["parcel_info_grid"] = new parcel_info_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "parcel_info"); // Load user level of detail table
				$addRow = $GLOBALS["parcel_info_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["parcel_info"]->user_id->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("orders", $detailTblVar) && $GLOBALS["orders"]->DetailAdd) {
				$GLOBALS["orders"]->_userid->setSessionValue($this->id->CurrentValue); // Set master key
				$GLOBALS["orders"]->carrier_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["orders_grid"]))
					$GLOBALS["orders_grid"] = new orders_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "orders"); // Load user level of detail table
				$addRow = $GLOBALS["orders_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["orders"]->carrier_id->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// photo
		if ($this->photo->Upload->FileToken <> "")
			CleanUploadTempPath($this->photo->Upload->FileToken, $this->photo->Upload->Index);
		else
			CleanUploadTempPath($this->photo, $this->photo->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		if (Get(TABLE_SHOW_DETAIL) !== NULL) {
			$detailTblVar = Get(TABLE_SHOW_DETAIL);
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar <> "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("image", $detailTblVar)) {
				if (!isset($GLOBALS["image_grid"]))
					$GLOBALS["image_grid"] = new image_grid();
				if ($GLOBALS["image_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["image_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["image_grid"]->CurrentMode = "add";
					if ($this->isConfirm())
						$GLOBALS["image_grid"]->CurrentAction = "confirm";
					else
						$GLOBALS["image_grid"]->CurrentAction = "gridadd";
					if ($this->isCancel())
						$GLOBALS["image_grid"]->EventCancelled = TRUE;

					// Save current master table to detail table
					$GLOBALS["image_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["image_grid"]->setStartRecordNumber(1);
					$GLOBALS["image_grid"]->_userid->IsDetailKey = TRUE;
					$GLOBALS["image_grid"]->_userid->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["image_grid"]->_userid->setSessionValue($GLOBALS["image_grid"]->_userid->CurrentValue);
				}
			}
			if (in_array("trip_info", $detailTblVar)) {
				if (!isset($GLOBALS["trip_info_grid"]))
					$GLOBALS["trip_info_grid"] = new trip_info_grid();
				if ($GLOBALS["trip_info_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["trip_info_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["trip_info_grid"]->CurrentMode = "add";
					if ($this->isConfirm())
						$GLOBALS["trip_info_grid"]->CurrentAction = "confirm";
					else
						$GLOBALS["trip_info_grid"]->CurrentAction = "gridadd";
					if ($this->isCancel())
						$GLOBALS["trip_info_grid"]->EventCancelled = TRUE;

					// Save current master table to detail table
					$GLOBALS["trip_info_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["trip_info_grid"]->setStartRecordNumber(1);
					$GLOBALS["trip_info_grid"]->user_id->IsDetailKey = TRUE;
					$GLOBALS["trip_info_grid"]->user_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["trip_info_grid"]->user_id->setSessionValue($GLOBALS["trip_info_grid"]->user_id->CurrentValue);
				}
			}
			if (in_array("parcel_info", $detailTblVar)) {
				if (!isset($GLOBALS["parcel_info_grid"]))
					$GLOBALS["parcel_info_grid"] = new parcel_info_grid();
				if ($GLOBALS["parcel_info_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["parcel_info_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["parcel_info_grid"]->CurrentMode = "add";
					if ($this->isConfirm())
						$GLOBALS["parcel_info_grid"]->CurrentAction = "confirm";
					else
						$GLOBALS["parcel_info_grid"]->CurrentAction = "gridadd";
					if ($this->isCancel())
						$GLOBALS["parcel_info_grid"]->EventCancelled = TRUE;

					// Save current master table to detail table
					$GLOBALS["parcel_info_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["parcel_info_grid"]->setStartRecordNumber(1);
					$GLOBALS["parcel_info_grid"]->user_id->IsDetailKey = TRUE;
					$GLOBALS["parcel_info_grid"]->user_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["parcel_info_grid"]->user_id->setSessionValue($GLOBALS["parcel_info_grid"]->user_id->CurrentValue);
				}
			}
			if (in_array("orders", $detailTblVar)) {
				if (!isset($GLOBALS["orders_grid"]))
					$GLOBALS["orders_grid"] = new orders_grid();
				if ($GLOBALS["orders_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["orders_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["orders_grid"]->CurrentMode = "add";
					if ($this->isConfirm())
						$GLOBALS["orders_grid"]->CurrentAction = "confirm";
					else
						$GLOBALS["orders_grid"]->CurrentAction = "gridadd";
					if ($this->isCancel())
						$GLOBALS["orders_grid"]->EventCancelled = TRUE;

					// Save current master table to detail table
					$GLOBALS["orders_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["orders_grid"]->setStartRecordNumber(1);
					$GLOBALS["orders_grid"]->_userid->IsDetailKey = TRUE;
					$GLOBALS["orders_grid"]->_userid->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["orders_grid"]->_userid->setSessionValue($GLOBALS["orders_grid"]->_userid->CurrentValue);
					$GLOBALS["orders_grid"]->carrier_id->IsDetailKey = TRUE;
					$GLOBALS["orders_grid"]->carrier_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["orders_grid"]->carrier_id->setSessionValue($GLOBALS["orders_grid"]->carrier_id->CurrentValue);
				}
			}
		}
	}

	// Reset detail parms
	protected function resetDetailParms()
	{

		// Get the keys for master table
		if (Get(TABLE_SHOW_DETAIL) !== NULL) {
			$detailTblVar = Get(TABLE_SHOW_DETAIL);
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar <> "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("image", $detailTblVar)) {
				if (!isset($GLOBALS["image_grid"]))
					$GLOBALS["image_grid"] = new image_grid();
				if ($GLOBALS["image_grid"]->DetailAdd) {
					$GLOBALS["image_grid"]->CurrentAction = "gridadd";
				}
			}
			if (in_array("trip_info", $detailTblVar)) {
				if (!isset($GLOBALS["trip_info_grid"]))
					$GLOBALS["trip_info_grid"] = new trip_info_grid();
				if ($GLOBALS["trip_info_grid"]->DetailAdd) {
					$GLOBALS["trip_info_grid"]->CurrentAction = "gridadd";
				}
			}
			if (in_array("parcel_info", $detailTblVar)) {
				if (!isset($GLOBALS["parcel_info_grid"]))
					$GLOBALS["parcel_info_grid"] = new parcel_info_grid();
				if ($GLOBALS["parcel_info_grid"]->DetailAdd) {
					$GLOBALS["parcel_info_grid"]->CurrentAction = "gridadd";
				}
			}
			if (in_array("orders", $detailTblVar)) {
				if (!isset($GLOBALS["orders_grid"]))
					$GLOBALS["orders_grid"] = new orders_grid();
				if ($GLOBALS["orders_grid"]->DetailAdd) {
					$GLOBALS["orders_grid"]->CurrentAction = "gridadd";
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("userlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "pills";
		$pages->add('image');
		$pages->add('trip_info');
		$pages->add('parcel_info');
		$pages->add('orders');
		$this->DetailPages = $pages;
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
