<?php
namespace PHPMaker2019\ferryman;

//
// Page class
//
class login extends admin
{

	// Page ID
	public $PageID = "login";

	// Project ID
	public $ProjectID = "{D49A959E-F136-47C9-B9D7-6B34755F62D4}";

	// Page object name
	public $PageObjName = "login";

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
		return TRUE;
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
		$this->TokenTimeout = 48 * 60 * 60; // 48 hours for login

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (admin)
		if (!isset($GLOBALS["admin"]) || get_class($GLOBALS["admin"]) == PROJECT_NAMESPACE . "admin") {
			$GLOBALS["admin"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["admin"];
		}
		if (!isset($GLOBALS["admin"])) $GLOBALS["admin"] = &$this;

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'login');

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

	// Properties
	public $Username;
	public $LoginType;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$Breadcrumb, $FormError;

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
		}
		$this->CurrentAction = Param("action"); // Set up current action

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
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/") + 1);
		$Breadcrumb = new Breadcrumb();
		$Breadcrumb->add("login", "LoginPage", $url, "", "", TRUE);
		$this->Heading = $Language->Phrase("LoginPage");
		$this->Username = ""; // Initialize
		$password = "";
		$lastUrl = $Security->lastUrl(); // Get last URL
		if ($lastUrl == "")
			$lastUrl = "index.php";

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->Phrase("SessionExpired"));

		// If delete personal data successed, show success message
		if (Get("deleted") == "1")
			$this->setSuccessMessage($Language->Phrase("PersonalDataDeleteSuccess"));

		// Login
		if (IsLoggingIn()) { // After changing password
			$this->Username = @$_SESSION[SESSION_USER_PROFILE_USER_NAME];
			$password = @$_SESSION[SESSION_USER_PROFILE_PASSWORD];
			$this->LoginType = @$_SESSION[SESSION_USER_PROFILE_LOGIN_TYPE];
			$validPwd = $Security->validateUser($this->Username, $password, FALSE);
			if ($validPwd) {
				$_SESSION[SESSION_USER_PROFILE_USER_NAME] = "";
				$_SESSION[SESSION_USER_PROFILE_PASSWORD] = "";
				$_SESSION[SESSION_USER_PROFILE_LOGIN_TYPE] = "";
			}
		} else if (Get("provider")) { // OAuth provider
			$provider = ucfirst(strtolower(trim(Get("provider")))); // e.g. Google, Facebook
			$validate = $Security->validateUser($this->Username, $password, FALSE, FALSE, $provider); // Authenticate by provider
			$validPwd = $validate;
			if ($validate) {
				$this->Username = $UserProfile->get("email");
				if (DEBUG_ENABLED && !$Security->isLoggedIn()) {
					$validPwd = FALSE;
					$this->setFailureMessage(str_replace("%u", $this->Username, $Language->Phrase("UserNotFound"))); // Show debug message
				}
			} else {
				$this->setFailureMessage(str_replace("%p", $provider, $Language->Phrase("LoginFailed")));
			}
		} else { // Normal login
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			$Security->loadUserLevel(); // Load user level
			$encrypted = FALSE;
			if (Post("username") !== NULL) {
				$this->Username = RemoveXss(Post("username"));
				$password = RemoveXss(Post("password"));
				$this->LoginType = strtolower(RemoveXss(Post("type")));
			} else if (ALLOW_LOGIN_BY_URL && Get("username") !== NULL) {
				$this->Username = RemoveXss(Get("username"));
				$password = RemoveXss(Get("password"));
				$this->LoginType = strtolower(RemoveXss(Post("type")));
				$encrypted = !empty(Get("encrypted"));
			}
			if ($this->Username <> "") {
				$validate = $this->validateForm($this->Username, $password);
				if (!$validate)
					$this->setFailureMessage($FormError);
				$_SESSION[SESSION_USER_LOGIN_TYPE] = $this->LoginType; // Save user login type
				$_SESSION[SESSION_USER_PROFILE_USER_NAME] = $this->Username; // Save login user name
				$_SESSION[SESSION_USER_PROFILE_LOGIN_TYPE] = $this->LoginType; // Save login type
			} else {
				if ($Security->isLoggedIn()) {
					if ($this->getFailureMessage() == "")
						$this->terminate($lastUrl); // Return to last accessed page
				}
				$validate = FALSE;

				// Restore settings
				if (ReadCookie("Checksum") == strval(crc32(md5(RANDOM_KEY))))
					$this->Username = Decrypt(ReadCookie("Username"));
				if (ReadCookie("AutoLogin") == "autologin") {
					$this->LoginType = "a";

				// } elseif (ReadCookie("AutoLogin") == "rememberusername") {
				// 	$this->LoginType = "u";

				} else {
					$this->LoginType = "";
				}
			}
			$validPwd = FALSE;
			if ($validate) {

				// Call Logging In event
				$validate = $this->User_LoggingIn($this->Username, $password);
				if ($validate) {
					$validPwd = $Security->validateUser($this->Username, $password, FALSE, $encrypted); // Manual login
					if (!$validPwd) {
						if ($this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("InvalidUidPwd")); // Invalid user name or password
					}
				} else {
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("LoginCancelled")); // Login cancelled
				}
			}
		}

		// After login
		if ($validPwd) {

			// Write cookies
			if ($this->LoginType == "a") { // Auto login
				WriteCookie("AutoLogin", "autologin"); // Set autologin cookie
				WriteCookie("Username", Encrypt($this->Username)); // Set user name cookie
				WriteCookie("Password", Encrypt($password)); // Set password cookie
				WriteCookie('Checksum', crc32(md5(RANDOM_KEY)));

			// } elseif ($this->LoginType == "u") { // Remember user name
			// 	WriteCookie("AutoLogin", "rememberusername"); // Set remember user name cookie
			// 	WriteCookie("Username", Encrypt($this->Username)); // Set user name cookie
			// 	WriteCookie("Checksum", crc32(md5(RANDOM_KEY)));

			} else {
				WriteCookie("AutoLogin", ""); // Clear auto login cookie
			}
			$this->writeAuditTrailOnLogin($this->Username);

			// Call loggedin event
			$this->User_LoggedIn($this->Username);
			$this->terminate($lastUrl); // Return to last accessed URL
		} elseif ($this->Username <> "" && $password <> "") {

			// Call user login error event
			$this->User_LoginError($this->Username, $password);
		}
	}

	//
	// Validate form
	//

	protected function validateForm($usr, $pwd)
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return TRUE;
		if (trim($usr) == "") {
			AddMessage($FormError, $Language->Phrase("EnterUid"));
		}
		if (trim($pwd) == "") {
			AddMessage($FormError, $Language->Phrase("EnterPwd"));
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form Custom Validate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	//
	// Write audit trail on login
	//

	protected function writeAuditTrailOnLogin($usr)
	{
		global $Language;
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $Language->Phrase("AuditTrailLogin"), CurrentUserIP(), "", "", "", "");
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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

	// User Logging In event
	function User_LoggingIn($usr, &$pwd) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// User Logged In event
	function User_LoggedIn($usr) {

		//echo "User Logged In";
	}

	// User Login Error event
	function User_LoginError($usr, $pwd) {

		//echo "User Login Error";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
