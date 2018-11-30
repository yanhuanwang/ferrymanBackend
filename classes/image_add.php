<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class image_add extends image
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'image';

	// Page object name
	public $PageObjName = "image_add";

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

		// Table object (image)
		if (!isset($GLOBALS["image"]) || get_class($GLOBALS["image"]) == PROJECT_NAMESPACE . "image") {
			$GLOBALS["image"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["image"];
		}

		// Table object (admin)
		if (!isset($GLOBALS['admin'])) $GLOBALS['admin'] = new admin();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'image');

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
		global $EXPORT, $image;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($image);
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
					if ($pageName == "imageview.php")
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

	// CAPTCHA
	public $Captcha;

	// Reset Captcha
	protected function resetCaptcha()
	{
		$_SESSION[SESSION_CAPTCHA_CODE] = Random();
	}

	// Validate Captcha
	protected function validateCaptcha()
	{
		return ($this->Captcha == @$_SESSION[SESSION_CAPTCHA_CODE]);
	}

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
					$this->terminate(GetUrl("imagelist.php"));
				else
					$this->terminate(GetUrl("login.php"));
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->path->setVisibility();
		$this->description->setVisibility();
		$this->uuid->setVisibility();
		$this->user_id->setVisibility();
		$this->confirmed->setVisibility();
		$this->createdAt->setVisibility();
		$this->updatedAt->setVisibility();
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

		// CAPTCHA checking
		if ($this->isShow() || $this->isCopy()) {
			$this->resetCaptcha();
		} elseif (IsPost()) {
			$CurrentForm->Index = -1;
			$this->Captcha = $CurrentForm->getValue("captcha");
			if (!$this->validateCaptcha()) { // CAPTCHA unmatched
				$this->setFailureMessage($Language->Phrase("EnterValidateCode"));
				$this->CurrentAction = "show"; // Reset action, do not insert
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
			} else {
				if ($this->CurrentAction == "add")
					$this->resetCaptcha();
			}
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
					$this->terminate("imagelist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "imagelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "imageview.php")
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
		$this->path->Upload->Index = $CurrentForm->Index;
		$this->path->Upload->uploadFile();
		$this->path->CurrentValue = $this->path->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->path->Upload->DbValue = NULL;
		$this->path->OldValue = $this->path->Upload->DbValue;
		$this->path->CurrentValue = NULL; // Clear file related field
		$this->description->CurrentValue = NULL;
		$this->description->OldValue = $this->description->CurrentValue;
		$this->uuid->CurrentValue = NULL;
		$this->uuid->OldValue = $this->uuid->CurrentValue;
		$this->user_id->CurrentValue = NULL;
		$this->user_id->OldValue = $this->user_id->CurrentValue;
		$this->confirmed->CurrentValue = 0;
		$this->createdAt->CurrentValue = NULL;
		$this->createdAt->OldValue = $this->createdAt->CurrentValue;
		$this->updatedAt->CurrentValue = NULL;
		$this->updatedAt->OldValue = $this->updatedAt->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'description' first before field var 'x_description'
		$val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
		if (!$this->description->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->description->Visible = FALSE; // Disable update for API request
			else
				$this->description->setFormValue($val);
		}

		// Check field name 'uuid' first before field var 'x_uuid'
		$val = $CurrentForm->hasValue("uuid") ? $CurrentForm->getValue("uuid") : $CurrentForm->getValue("x_uuid");
		if (!$this->uuid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->uuid->Visible = FALSE; // Disable update for API request
			else
				$this->uuid->setFormValue($val);
		}

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}

		// Check field name 'confirmed' first before field var 'x_confirmed'
		$val = $CurrentForm->hasValue("confirmed") ? $CurrentForm->getValue("confirmed") : $CurrentForm->getValue("x_confirmed");
		if (!$this->confirmed->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->confirmed->Visible = FALSE; // Disable update for API request
			else
				$this->confirmed->setFormValue($val);
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

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->description->CurrentValue = $this->description->FormValue;
		$this->uuid->CurrentValue = $this->uuid->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->confirmed->CurrentValue = $this->confirmed->FormValue;
		$this->createdAt->CurrentValue = $this->createdAt->FormValue;
		$this->createdAt->CurrentValue = UnFormatDateTime($this->createdAt->CurrentValue, 0);
		$this->updatedAt->CurrentValue = $this->updatedAt->FormValue;
		$this->updatedAt->CurrentValue = UnFormatDateTime($this->updatedAt->CurrentValue, 0);
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
		$this->path->Upload->DbValue = $row['path'];
		$this->path->setDbValue($this->path->Upload->DbValue);
		$this->description->setDbValue($row['description']);
		$this->uuid->setDbValue($row['uuid']);
		$this->user_id->setDbValue($row['user_id']);
		$this->confirmed->setDbValue($row['confirmed']);
		$this->createdAt->setDbValue($row['createdAt']);
		$this->updatedAt->setDbValue($row['updatedAt']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['path'] = $this->path->Upload->DbValue;
		$row['description'] = $this->description->CurrentValue;
		$row['uuid'] = $this->uuid->CurrentValue;
		$row['user_id'] = $this->user_id->CurrentValue;
		$row['confirmed'] = $this->confirmed->CurrentValue;
		$row['createdAt'] = $this->createdAt->CurrentValue;
		$row['updatedAt'] = $this->updatedAt->CurrentValue;
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
		// path
		// description
		// uuid
		// user_id
		// confirmed
		// createdAt
		// updatedAt

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// path
			if (!EmptyValue($this->path->Upload->DbValue)) {
				$this->path->ImageAlt = $this->path->alt();
				$this->path->ViewValue = $this->path->Upload->DbValue;
			} else {
				$this->path->ViewValue = "";
			}
			$this->path->ViewCustomAttributes = "";

			// description
			$this->description->ViewValue = $this->description->CurrentValue;
			$this->description->ViewCustomAttributes = "";

			// uuid
			$this->uuid->ViewValue = $this->uuid->CurrentValue;
			$this->uuid->ViewCustomAttributes = "";

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, 0, -2, -2, -2);
			$this->user_id->ViewCustomAttributes = "";

			// confirmed
			$this->confirmed->ViewValue = $this->confirmed->CurrentValue;
			$this->confirmed->ViewValue = FormatNumber($this->confirmed->ViewValue, 0, -2, -2, -2);
			$this->confirmed->ViewCustomAttributes = "";

			// createdAt
			$this->createdAt->ViewValue = $this->createdAt->CurrentValue;
			$this->createdAt->ViewValue = FormatDateTime($this->createdAt->ViewValue, 0);
			$this->createdAt->ViewCustomAttributes = "";

			// updatedAt
			$this->updatedAt->ViewValue = $this->updatedAt->CurrentValue;
			$this->updatedAt->ViewValue = FormatDateTime($this->updatedAt->ViewValue, 0);
			$this->updatedAt->ViewCustomAttributes = "";

			// path
			$this->path->LinkCustomAttributes = "";
			if (!EmptyValue($this->path->Upload->DbValue)) {
				$this->path->HrefValue = GetFileUploadUrl($this->path, $this->path->Upload->DbValue); // Add prefix/suffix
				$this->path->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->path->HrefValue = FullUrl($this->path->HrefValue, "href");
			} else {
				$this->path->HrefValue = "";
			}
			$this->path->ExportHrefValue = $this->path->UploadPath . $this->path->Upload->DbValue;
			$this->path->TooltipValue = "";
			if ($this->path->UseColorbox) {
				if (EmptyValue($this->path->TooltipValue))
					$this->path->LinkAttrs["title"] = $Language->Phrase("ViewImageGallery");
				$this->path->LinkAttrs["data-rel"] = "image_x_path";
				AppendClass($this->path->LinkAttrs["class"], "ew-lightbox");
			}

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";
			$this->description->TooltipValue = "";

			// uuid
			$this->uuid->LinkCustomAttributes = "";
			$this->uuid->HrefValue = "";
			$this->uuid->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// confirmed
			$this->confirmed->LinkCustomAttributes = "";
			$this->confirmed->HrefValue = "";
			$this->confirmed->TooltipValue = "";

			// createdAt
			$this->createdAt->LinkCustomAttributes = "";
			$this->createdAt->HrefValue = "";
			$this->createdAt->TooltipValue = "";

			// updatedAt
			$this->updatedAt->LinkCustomAttributes = "";
			$this->updatedAt->HrefValue = "";
			$this->updatedAt->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// path
			$this->path->EditAttrs["class"] = "form-control";
			$this->path->EditCustomAttributes = "";
			if (!EmptyValue($this->path->Upload->DbValue)) {
				$this->path->ImageAlt = $this->path->alt();
				$this->path->EditValue = $this->path->Upload->DbValue;
			} else {
				$this->path->EditValue = "";
			}
			if (!EmptyValue($this->path->CurrentValue))
					$this->path->Upload->FileName = $this->path->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->path);

			// description
			$this->description->EditAttrs["class"] = "form-control";
			$this->description->EditCustomAttributes = "";
			$this->description->EditValue = HtmlEncode($this->description->CurrentValue);
			$this->description->PlaceHolder = RemoveHtml($this->description->caption());

			// uuid
			$this->uuid->EditAttrs["class"] = "form-control";
			$this->uuid->EditCustomAttributes = "";
			$this->uuid->EditValue = HtmlEncode($this->uuid->CurrentValue);
			$this->uuid->PlaceHolder = RemoveHtml($this->uuid->caption());

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";
			$this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
			$this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());

			// confirmed
			$this->confirmed->EditAttrs["class"] = "form-control";
			$this->confirmed->EditCustomAttributes = "";
			$this->confirmed->EditValue = HtmlEncode($this->confirmed->CurrentValue);
			$this->confirmed->PlaceHolder = RemoveHtml($this->confirmed->caption());

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

			// Add refer script
			// path

			$this->path->LinkCustomAttributes = "";
			if (!EmptyValue($this->path->Upload->DbValue)) {
				$this->path->HrefValue = GetFileUploadUrl($this->path, $this->path->Upload->DbValue); // Add prefix/suffix
				$this->path->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->path->HrefValue = FullUrl($this->path->HrefValue, "href");
			} else {
				$this->path->HrefValue = "";
			}
			$this->path->ExportHrefValue = $this->path->UploadPath . $this->path->Upload->DbValue;

			// description
			$this->description->LinkCustomAttributes = "";
			$this->description->HrefValue = "";

			// uuid
			$this->uuid->LinkCustomAttributes = "";
			$this->uuid->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// confirmed
			$this->confirmed->LinkCustomAttributes = "";
			$this->confirmed->HrefValue = "";

			// createdAt
			$this->createdAt->LinkCustomAttributes = "";
			$this->createdAt->HrefValue = "";

			// updatedAt
			$this->updatedAt->LinkCustomAttributes = "";
			$this->updatedAt->HrefValue = "";
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
		if ($this->path->Required) {
			if ($this->path->Upload->FileName == "" && !$this->path->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->path->caption(), $this->path->RequiredErrorMessage));
			}
		}
		if ($this->description->Required) {
			if (!$this->description->IsDetailKey && $this->description->FormValue != NULL && $this->description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
			}
		}
		if ($this->uuid->Required) {
			if (!$this->uuid->IsDetailKey && $this->uuid->FormValue != NULL && $this->uuid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->uuid->caption(), $this->uuid->RequiredErrorMessage));
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
		if ($this->confirmed->Required) {
			if (!$this->confirmed->IsDetailKey && $this->confirmed->FormValue != NULL && $this->confirmed->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->confirmed->caption(), $this->confirmed->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->confirmed->FormValue)) {
			AddMessage($FormError, $this->confirmed->errorMessage());
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

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("parcel_info", $detailTblVar) && $GLOBALS["parcel_info"]->DetailAdd) {
			if (!isset($GLOBALS["parcel_info_grid"]))
				$GLOBALS["parcel_info_grid"] = new parcel_info_grid(); // Get detail page object
			$GLOBALS["parcel_info_grid"]->validateGridForm();
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
		if ($this->uuid->CurrentValue <> "") { // Check field with unique index
			$filter = "(uuid = '" . AdjustSql($this->uuid->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->uuid->caption(), $Language->Phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->uuid->CurrentValue, $idxErrMsg);
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

		// path
		if ($this->path->Visible && !$this->path->Upload->KeepFile) {
			$this->path->Upload->DbValue = ""; // No need to delete old file
			if ($this->path->Upload->FileName == "") {
				$rsnew['path'] = NULL;
			} else {
				$rsnew['path'] = $this->path->Upload->FileName;
			}
		}

		// description
		$this->description->setDbValueDef($rsnew, $this->description->CurrentValue, NULL, FALSE);

		// uuid
		$this->uuid->setDbValueDef($rsnew, $this->uuid->CurrentValue, "", FALSE);

		// user_id
		$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, FALSE);

		// confirmed
		$this->confirmed->setDbValueDef($rsnew, $this->confirmed->CurrentValue, 0, strval($this->confirmed->CurrentValue) == "");

		// createdAt
		$this->createdAt->setDbValueDef($rsnew, UnFormatDateTime($this->createdAt->CurrentValue, 0), CurrentDate(), FALSE);

		// updatedAt
		$this->updatedAt->setDbValueDef($rsnew, UnFormatDateTime($this->updatedAt->CurrentValue, 0), CurrentDate(), FALSE);
		if ($this->path->Visible && !$this->path->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->path->Upload->DbValue) ? array() : array($this->path->Upload->DbValue);
			if (!EmptyValue($this->path->Upload->FileName)) {
				$newFiles = array($this->path->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->path, $this->path->Upload->Index) . $file)) {
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
							$file1 = UniqueFilename($this->path->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->path, $this->path->Upload->Index) . $file1) || file_exists($this->path->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->path->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->path, $this->path->Upload->Index) . $file, UploadTempPath($this->path, $this->path->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->path->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->path->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->path->setDbValueDef($rsnew, $this->path->Upload->FileName, "", FALSE);
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
				if ($this->path->Visible && !$this->path->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->path->Upload->DbValue) ? array() : array($this->path->Upload->DbValue);
					if (!EmptyValue($this->path->Upload->FileName)) {
						$newFiles = array($this->path->Upload->FileName);
						$newFiles2 = array($rsnew['path']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->path, $this->path->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->path->Upload->saveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->path->oldPhysicalUploadPath() . $oldFile);
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
			if (in_array("parcel_info", $detailTblVar) && $GLOBALS["parcel_info"]->DetailAdd) {
				$GLOBALS["parcel_info"]->image_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["parcel_info_grid"]))
					$GLOBALS["parcel_info_grid"] = new parcel_info_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "parcel_info"); // Load user level of detail table
				$addRow = $GLOBALS["parcel_info_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow)
					$GLOBALS["parcel_info"]->image_id->setSessionValue(""); // Clear master key if insert failed
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

		// path
		if ($this->path->Upload->FileToken <> "")
			CleanUploadTempPath($this->path->Upload->FileToken, $this->path->Upload->Index);
		else
			CleanUploadTempPath($this->path, $this->path->Upload->Index);

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
					$GLOBALS["parcel_info_grid"]->image_id->IsDetailKey = TRUE;
					$GLOBALS["parcel_info_grid"]->image_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["parcel_info_grid"]->image_id->setSessionValue($GLOBALS["parcel_info_grid"]->image_id->CurrentValue);
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
			if (in_array("parcel_info", $detailTblVar)) {
				if (!isset($GLOBALS["parcel_info_grid"]))
					$GLOBALS["parcel_info_grid"] = new parcel_info_grid();
				if ($GLOBALS["parcel_info_grid"]->DetailAdd) {
					$GLOBALS["parcel_info_grid"]->CurrentAction = "gridadd";
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("imagelist.php"), "", $this->TableVar, TRUE);
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
