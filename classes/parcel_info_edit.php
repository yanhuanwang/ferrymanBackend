<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class parcel_info_edit extends parcel_info
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Table name
	public $TableName = 'parcel_info';

	// Page object name
	public $PageObjName = "parcel_info_edit";

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

		// Table object (parcel_info)
		if (!isset($GLOBALS["parcel_info"]) || get_class($GLOBALS["parcel_info"]) == PROJECT_NAMESPACE . "parcel_info") {
			$GLOBALS["parcel_info"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["parcel_info"];
		}

		// Table object (user)
		if (!isset($GLOBALS['user'])) $GLOBALS['user'] = new user();

		// Table object (admin)
		if (!isset($GLOBALS['admin'])) $GLOBALS['admin'] = new admin();

		// Table object (category)
		if (!isset($GLOBALS['category'])) $GLOBALS['category'] = new category();

		// Table object (image)
		if (!isset($GLOBALS['image'])) $GLOBALS['image'] = new image();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'parcel_info');

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
		global $EXPORT, $parcel_info;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($parcel_info);
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
					if ($pageName == "parcel_infoview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecs = 1;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $RecCnt;

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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("parcel_infolist.php"));
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
		$this->category->setVisibility();
		$this->image_id->setVisibility();
		$this->name->setVisibility();
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
		$this->setupLookupOptions($this->category);
		$this->setupLookupOptions($this->image_id);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$returnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_id")) {
				$this->id->setFormValue($CurrentForm->getValue("x_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Set up master detail parameters
		$this->setupMasterParms();

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($rs = $this->loadRecordset()) // Load records
			$this->TotalRecs = $rs->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->terminate("parcel_infolist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->setupStartRec(); // Set up start record position

			// Point to current record
			if ($this->StartRec <= $this->TotalRecs) {
				$rs->move($this->StartRec - 1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if ($this->id->CurrentValue != NULL) {
				while (!$rs->EOF) {
					if (SameString($this->id->CurrentValue, $rs->fields('id'))) {
						$this->setStartRecordNumber($this->StartRec); // Save record position
						$loaded = TRUE;
						break;
					} else {
						$this->StartRec++;
						$rs->moveNext();
					}
				}
			}
		}

		// Load current row values
		if ($loaded)
			$this->loadRowValues($rs);

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi())
					$this->terminate();
				else
					$this->CurrentAction = ""; // Form error, reset action
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->terminate("parcel_infolist.php"); // Return to list page
				} else {
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$returnUrl = $this->getViewUrl(TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "parcel_infolist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					if (IsApi())
						$this->terminate(TRUE);
					else
						$this->terminate($returnUrl); // Return to caller
				} elseif (IsApi()) { // API request, return
					$this->terminate();
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render as View
		} else {
			$this->RowType = ROWTYPE_EDIT; // Render as Edit
		}
		$this->resetAttributes();
		$this->renderRow();
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

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

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

		// Check field name 'category' first before field var 'x_category'
		$val = $CurrentForm->hasValue("category") ? $CurrentForm->getValue("category") : $CurrentForm->getValue("x_category");
		if (!$this->category->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->category->Visible = FALSE; // Disable update for API request
			else
				$this->category->setFormValue($val);
		}

		// Check field name 'image_id' first before field var 'x_image_id'
		$val = $CurrentForm->hasValue("image_id") ? $CurrentForm->getValue("image_id") : $CurrentForm->getValue("x_image_id");
		if (!$this->image_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->image_id->Visible = FALSE; // Disable update for API request
			else
				$this->image_id->setFormValue($val);
		}

		// Check field name 'name' first before field var 'x_name'
		$val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
		if (!$this->name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->name->Visible = FALSE; // Disable update for API request
			else
				$this->name->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->from_place->CurrentValue = $this->from_place->FormValue;
		$this->to_place->CurrentValue = $this->to_place->FormValue;
		$this->description->CurrentValue = $this->description->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->category->CurrentValue = $this->category->FormValue;
		$this->image_id->CurrentValue = $this->image_id->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->resetDetailParms();
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
		$this->category->setDbValue($row['category']);
		$this->image_id->setDbValue($row['image_id']);
		$this->name->setDbValue($row['name']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['from_place'] = NULL;
		$row['to_place'] = NULL;
		$row['description'] = NULL;
		$row['user_id'] = NULL;
		$row['category'] = NULL;
		$row['image_id'] = NULL;
		$row['name'] = NULL;
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
		// category
		// image_id
		// name

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

			// category
			$curVal = strval($this->category->CurrentValue);
			if ($curVal <> "") {
				$this->category->ViewValue = $this->category->lookupCacheOption($curVal);
				if ($this->category->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->category->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->category->ViewValue = $this->category->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->category->ViewValue = $this->category->CurrentValue;
					}
				}
			} else {
				$this->category->ViewValue = NULL;
			}
			$this->category->ViewCustomAttributes = "";

			// image_id
			$this->image_id->ViewValue = $this->image_id->CurrentValue;
			$curVal = strval($this->image_id->CurrentValue);
			if ($curVal <> "") {
				$this->image_id->ViewValue = $this->image_id->lookupCacheOption($curVal);
				if ($this->image_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->image_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->image_id->ViewValue = $this->image_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->image_id->ViewValue = $this->image_id->CurrentValue;
					}
				}
			} else {
				$this->image_id->ViewValue = NULL;
			}
			$this->image_id->ViewCustomAttributes = "";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->ViewCustomAttributes = "";

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

			// category
			$this->category->LinkCustomAttributes = "";
			$this->category->HrefValue = "";
			$this->category->TooltipValue = "";

			// image_id
			$this->image_id->LinkCustomAttributes = "";
			if (!EmptyValue($this->image_id->CurrentValue)) {
				$this->image_id->HrefValue = "uploads/" . ((!empty($this->image_id->ViewValue) && !is_array($this->image_id->ViewValue)) ? RemoveHtml($this->image_id->ViewValue) : $this->image_id->CurrentValue); // Add prefix/suffix
				$this->image_id->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->image_id->HrefValue = FullUrl($this->image_id->HrefValue, "href");
			} else {
				$this->image_id->HrefValue = "";
			}
			$this->image_id->TooltipValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

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

			// category
			$this->category->EditAttrs["class"] = "form-control";
			$this->category->EditCustomAttributes = "";
			if ($this->category->getSessionValue() <> "") {
				$this->category->CurrentValue = $this->category->getSessionValue();
			$curVal = strval($this->category->CurrentValue);
			if ($curVal <> "") {
				$this->category->ViewValue = $this->category->lookupCacheOption($curVal);
				if ($this->category->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->category->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->category->ViewValue = $this->category->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->category->ViewValue = $this->category->CurrentValue;
					}
				}
			} else {
				$this->category->ViewValue = NULL;
			}
			$this->category->ViewCustomAttributes = "";
			} else {
			$curVal = trim(strval($this->category->CurrentValue));
			if ($curVal <> "")
				$this->category->ViewValue = $this->category->lookupCacheOption($curVal);
			else
				$this->category->ViewValue = $this->category->Lookup !== NULL && is_array($this->category->Lookup->Options) ? $curVal : NULL;
			if ($this->category->ViewValue !== NULL) { // Load from cache
				$this->category->EditValue = array_values($this->category->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->category->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->category->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->category->EditValue = $arwrk;
			}
			}

			// image_id
			$this->image_id->EditAttrs["class"] = "form-control";
			$this->image_id->EditCustomAttributes = "";
			if ($this->image_id->getSessionValue() <> "") {
				$this->image_id->CurrentValue = $this->image_id->getSessionValue();
			$this->image_id->ViewValue = $this->image_id->CurrentValue;
			$curVal = strval($this->image_id->CurrentValue);
			if ($curVal <> "") {
				$this->image_id->ViewValue = $this->image_id->lookupCacheOption($curVal);
				if ($this->image_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->image_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->image_id->ViewValue = $this->image_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->image_id->ViewValue = $this->image_id->CurrentValue;
					}
				}
			} else {
				$this->image_id->ViewValue = NULL;
			}
			$this->image_id->ViewCustomAttributes = "";
			} else {
			$this->image_id->EditValue = HtmlEncode($this->image_id->CurrentValue);
			$curVal = strval($this->image_id->CurrentValue);
			if ($curVal <> "") {
				$this->image_id->EditValue = $this->image_id->lookupCacheOption($curVal);
				if ($this->image_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->image_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->image_id->EditValue = $this->image_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->image_id->EditValue = HtmlEncode($this->image_id->CurrentValue);
					}
				}
			} else {
				$this->image_id->EditValue = NULL;
			}
			$this->image_id->PlaceHolder = RemoveHtml($this->image_id->caption());
			}

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			$this->name->EditValue = HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = RemoveHtml($this->name->caption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

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

			// category
			$this->category->LinkCustomAttributes = "";
			$this->category->HrefValue = "";

			// image_id
			$this->image_id->LinkCustomAttributes = "";
			if (!EmptyValue($this->image_id->CurrentValue)) {
				$this->image_id->HrefValue = "uploads/" . ((!empty($this->image_id->EditValue) && !is_array($this->image_id->EditValue)) ? RemoveHtml($this->image_id->EditValue) : $this->image_id->CurrentValue); // Add prefix/suffix
				$this->image_id->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->image_id->HrefValue = FullUrl($this->image_id->HrefValue, "href");
			} else {
				$this->image_id->HrefValue = "";
			}

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
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
		if ($this->category->Required) {
			if (!$this->category->IsDetailKey && $this->category->FormValue != NULL && $this->category->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->category->caption(), $this->category->RequiredErrorMessage));
			}
		}
		if ($this->image_id->Required) {
			if (!$this->image_id->IsDetailKey && $this->image_id->FormValue != NULL && $this->image_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->image_id->caption(), $this->image_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->image_id->FormValue)) {
			AddMessage($FormError, $this->image_id->errorMessage());
		}
		if ($this->name->Required) {
			if (!$this->name->IsDetailKey && $this->name->FormValue != NULL && $this->name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("orders", $detailTblVar) && $GLOBALS["orders"]->DetailEdit) {
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

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// from_place
			$this->from_place->setDbValueDef($rsnew, $this->from_place->CurrentValue, "", $this->from_place->ReadOnly);

			// to_place
			$this->to_place->setDbValueDef($rsnew, $this->to_place->CurrentValue, "", $this->to_place->ReadOnly);

			// description
			$this->description->setDbValueDef($rsnew, $this->description->CurrentValue, "", $this->description->ReadOnly);

			// user_id
			$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly);

			// category
			$this->category->setDbValueDef($rsnew, $this->category->CurrentValue, 0, $this->category->ReadOnly);

			// image_id
			$this->image_id->setDbValueDef($rsnew, $this->image_id->CurrentValue, 0, $this->image_id->ReadOnly);

			// name
			$this->name->setDbValueDef($rsnew, $this->name->CurrentValue, "", $this->name->ReadOnly);

			// Check referential integrity for master table 'image'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_image();
			$keyValue = isset($rsnew['image_id']) ? $rsnew['image_id'] : $rsold['image_id'];
			if (strval($keyValue) <> "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["image"]))
					$GLOBALS["image"] = new image();
				$rsmaster = $GLOBALS["image"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "image", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("orders", $detailTblVar) && $GLOBALS["orders"]->DetailEdit) {
						if (!isset($GLOBALS["orders_grid"]))
							$GLOBALS["orders_grid"] = new orders_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "orders"); // Load user level of detail table
						$editRow = $GLOBALS["orders_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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
			if ($masterTblVar == "image") {
				$validMaster = TRUE;
				if (Get("fk_id") !== NULL) {
					$GLOBALS["image"]->id->setQueryStringValue(Get("fk_id"));
					$this->image_id->setQueryStringValue($GLOBALS["image"]->id->QueryStringValue);
					$this->image_id->setSessionValue($this->image_id->QueryStringValue);
					if (!is_numeric($GLOBALS["image"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
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
			if ($masterTblVar == "category") {
				$validMaster = TRUE;
				if (Get("fk_id") !== NULL) {
					$GLOBALS["category"]->id->setQueryStringValue(Get("fk_id"));
					$this->category->setQueryStringValue($GLOBALS["category"]->id->QueryStringValue);
					$this->category->setSessionValue($this->category->QueryStringValue);
					if (!is_numeric($GLOBALS["category"]->id->QueryStringValue))
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
			if ($masterTblVar == "image") {
				$validMaster = TRUE;
				if (Post("fk_id") !== NULL) {
					$GLOBALS["image"]->id->setFormValue(Post("fk_id"));
					$this->image_id->setFormValue($GLOBALS["image"]->id->FormValue);
					$this->image_id->setSessionValue($this->image_id->FormValue);
					if (!is_numeric($GLOBALS["image"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
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
			if ($masterTblVar == "category") {
				$validMaster = TRUE;
				if (Post("fk_id") !== NULL) {
					$GLOBALS["category"]->id->setFormValue(Post("fk_id"));
					$this->category->setFormValue($GLOBALS["category"]->id->FormValue);
					$this->category->setSessionValue($this->category->FormValue);
					if (!is_numeric($GLOBALS["category"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($masterTblVar <> "image") {
				if ($this->image_id->CurrentValue == "")
					$this->image_id->setSessionValue("");
			}
			if ($masterTblVar <> "user") {
				if ($this->user_id->CurrentValue == "")
					$this->user_id->setSessionValue("");
			}
			if ($masterTblVar <> "category") {
				if ($this->category->CurrentValue == "")
					$this->category->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
			if (in_array("orders", $detailTblVar)) {
				if (!isset($GLOBALS["orders_grid"]))
					$GLOBALS["orders_grid"] = new orders_grid();
				if ($GLOBALS["orders_grid"]->DetailEdit) {
					$GLOBALS["orders_grid"]->CurrentMode = "edit";
					if ($this->isConfirm())
						$GLOBALS["orders_grid"]->CurrentAction = "confirm";
					else
						$GLOBALS["orders_grid"]->CurrentAction = "gridedit";
					if ($this->isCancel())
						$GLOBALS["orders_grid"]->EventCancelled = TRUE;

					// Save current master table to detail table
					$GLOBALS["orders_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["orders_grid"]->setStartRecordNumber(1);
					$GLOBALS["orders_grid"]->parcel_id->IsDetailKey = TRUE;
					$GLOBALS["orders_grid"]->parcel_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["orders_grid"]->parcel_id->setSessionValue($GLOBALS["orders_grid"]->parcel_id->CurrentValue);
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
			if (in_array("orders", $detailTblVar)) {
				if (!isset($GLOBALS["orders_grid"]))
					$GLOBALS["orders_grid"] = new orders_grid();
				if ($GLOBALS["orders_grid"]->DetailEdit) {
					$GLOBALS["orders_grid"]->CurrentAction = "gridedit";
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("parcel_infolist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
						case "x_category":
							break;
						case "x_image_id":
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
