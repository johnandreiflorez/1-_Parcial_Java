<?php
define("EW_PAGE_ID", "register", TRUE); // Page ID
?>
<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "usuarioinfo.php" ?>
<?php include "userfn50.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Open connection to the database
$conn = ew_Connect();
?>
<?php
$Security = new cAdvancedSecurity();
?>
<?php

// Common page loading event (in userfn*.php)
Page_Loading();
?>
<?php

// Page load event, used in current page
Page_Load();
?>
<?php
$bUserExists = FALSE;

// Create form object
$objForm = new cFormObj();
if (@$_POST["a_register"] <> "") {

	// Get action
	$usuario->CurrentAction = $_POST["a_register"];
	LoadFormValues(); // Get form values
} else {
	$usuario->CurrentAction = "I"; // Display blank record
	LoadDefaultValues(); // Load default values
}

// Handle email activation
if (@$_GET["action"] <> "") {
	$sAction = $_GET["action"];
	$sEmail = $_GET["email"];
	$qs = new cQueryString();
	$sApprovalCode = $qs->getValue("code");
	if ($sEmail == TEAdecrypt($sApprovalCode, EW_RANDOM_KEY)) {
		if (strtolower($sAction) == "confirm") { // Email activation
			if (ActivateEmail($sEmail)) { // activate this email
				$_SESSION[EW_SESSION_MESSAGE] = "Your account is activated"; // Set message acount activated
				Page_Terminate("login.php"); // Go to login page
			}
		}
	}
	if (@$_SESSION[EW_SESSION_MESSAGE] == "") {
		$_SESSION[EW_SESSION_MESSAGE] = "Activation failed"; // Set activate failed message
	}
	Page_Terminate("login.php"); // Go to login page
}
switch ($usuario->CurrentAction) {
	case "I": // Blank record, no action required
		break;
	case "A": // Add

		// Check for Duplicate User ID
		$sFilter = "(`email` = '" . ew_AdjustSql($usuario->login->CurrentValue) . "')";

		// Set up filter (Sql Where Clause) and get Return Sql
		// Sql constructor in usuario class, usuarioinfo.php

		$usuario->CurrentFilter = $sFilter;
		$sUserSql = $usuario->SQL();
		if ($rs = $conn->Execute($sUserSql)) {
			if (!$rs->EOF) {
				$bUserExists = TRUE;
				RestoreFormValues(); // Restore form values
				$_SESSION[EW_SESSION_MESSAGE] = "User Already Exists!"; // Set user exist message
			}
			$rs->Close();
		}
		if (!$bUserExists) {
			$usuario->SendEmail = TRUE; // Send email on add success
			if (AddRow()) { // Add record

				// Load user email
				$sReceiverEmail = $usuario->email->CurrentValue;
				if ($sReceiverEmail == "") { // Send to recipient directly
					$sReceiverEmail = EW_RECIPIENT_EMAIL;
					$sBccEmail = "";
				} else { // Bcc recipient
					$sBccEmail = EW_RECIPIENT_EMAIL;
				}

				// Set up email content
				if ($sReceiverEmail <> "") {
					$Email = new cEmail;
					$Email->Load("txt/register.txt");
					$Email->ReplaceSender(EW_SENDER_EMAIL); // Replace Sender
					$Email->ReplaceRecipient($sReceiverEmail); // Replace Recipient
					if ($sBccEmail <> "") $Email->AddBcc($sBccEmail); // Add Bcc
					$Email->ReplaceContent('<!--login-->', strval($usuario->login->CurrentValue));
					$Email->ReplaceContent('<!--clave-->', strval($usuario->clave->CurrentValue));
					$Email->ReplaceContent('<!--nombre-->', strval($usuario->nombre->CurrentValue));
					$Email->ReplaceContent('<!--apellidos-->', strval($usuario->apellidos->CurrentValue));
					$Email->ReplaceContent('<!--email-->', strval($usuario->email->CurrentValue));
					$Email->ReplaceContent('<!--sexo-->', strval($usuario->sexo->CurrentValue));
					$Email->ReplaceContent('<!--fingreso-->', strval($usuario->fingreso->CurrentValue));
					$Email->ReplaceContent('<!--perfil-->', strval($usuario->perfil->CurrentValue));
					$sActivateLink = ew_FullUrl() . "?action=confirm";
					$sActivateLink .= "&email=" . $usuario->email->CurrentValue;
					$sActivateLink .= "&code=" . TEAencrypt($usuario->email->CurrentValue, EW_RANDOM_KEY);
					$Email->ReplaceContent("<!--ActivateLink-->", $sActivateLink);
					$Email->Send();
				}
				$_SESSION[EW_SESSION_MESSAGE] = "Registration Successful. An email has been sent to your email address, please click the link in the email to activate your account."; // Activate success
				Page_Terminate("login.php"); // Go to login page
			} else {
				RestoreFormValues(); // Restore form values
			}
		}
}

// Render row
if ($usuario->CurrentAction == "F") { // Confirm page
	$usuario->RowType = EW_ROWTYPE_VIEW; // Render view
} else {
	$usuario->RowType = EW_ROWTYPE_ADD; // Render add
}
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "register"; // Page id

//-->
</script>
<script type="text/javascript">
<!--

function ew_ValidateForm(fobj) {
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_login"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - login"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_clave"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - clave"))
				return false;
		}
		if (fobj.x_clave && !ew_HasValue(fobj.x_clave)) {
			if (!ew_OnError(fobj.x_clave, "Please enter password"))
				return false; 
		}
		if (fobj.c_clave.value != fobj.x_clave.value) {
			if (!ew_OnError(fobj.c_clave, "Mismatch Password"))
				return false; 
		}
		elm = fobj.elements["x" + infix + "_nombre"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - nombre"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_apellidos"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - apellidos"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_sexo"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - sexo"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_fingreso"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - fingreso"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_fingreso"];
		if (elm && !ew_CheckDate(elm.value)) {
			if (!ew_OnError(elm, "Incorrect date, format = yyyy/mm/dd - fingreso"))
				return false; 
		}
		elm = fobj.elements["x" + infix + "_perfil"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - perfil"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_perfil"];
		if (elm && !ew_CheckInteger(elm.value)) {
			if (!ew_OnError(elm, "Incorrect integer - perfil"))
				return false; 
		}
	}
	return true;
}

//-->
</script>
<script type="text/javascript">
<!--

// js for DHtml Editor
//-->

</script>
<script type="text/javascript">
<!--

// js for Popup Calendar
//-->

</script>
<script type="text/javascript">
<!--
var ew_MultiPagePage = "Page"; // multi-page Page Text
var ew_MultiPageOf = "of"; // multi-page Of Text
var ew_MultiPagePrev = "Prev"; // multi-page Prev Text
var ew_MultiPageNext = "Next"; // multi-page Next Text

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">
Registration Page<br><br>
<a href="login.php">Back to Login Page</a>
</span></p>
<?php 
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form name="fusuarioregister" id="fusuarioregister" action="register.php" method="post" onSubmit="return ew_ValidateForm(this);">
<p>
<input type="hidden" name="a_register" id="a_register" value="A">
<?php if ($usuario->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<table class="ewTable">
	<tr class="ewTableRow">
		<td class="ewTableHeader">login<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->login->CellAttributes() ?>><span id="cb_x_login">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_login" id="x_login" title="" size="30" maxlength="15" value="<?php echo $usuario->login->EditValue ?>"<?php echo $usuario->login->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->login->ViewAttributes() ?>><?php echo $usuario->login->ViewValue ?></div>
<input type="hidden" name="x_login" id="x_login" value="<?php echo ew_HtmlEncode($usuario->login->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">clave<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->clave->CellAttributes() ?>><span id="cb_x_clave">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_clave" id="x_clave" title="" size="30" maxlength="15" value="<?php echo $usuario->clave->EditValue ?>"<?php echo $usuario->clave->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->clave->ViewAttributes() ?>><?php echo $usuario->clave->ViewValue ?></div>
<input type="hidden" name="x_clave" id="x_clave" value="<?php echo ew_HtmlEncode($usuario->clave->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<!--tr id=""-->
	<tr class="ewTableRow">
		<td class="ewTableHeader">Confirm clave</td>
		<td<?php echo $usuario->clave->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="c_clave" id="c_clave" title="" size="30" maxlength="15" value="<?php echo $usuario->clave->EditValue ?>"<?php echo $usuario->clave->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->clave->ViewAttributes() ?>><?php echo $usuario->clave->ViewValue ?></div>
<input type="hidden" name="c_clave" id="c_clave" value="<?php echo ew_HtmlEncode($usuario->clave->CurrentValue) ?>">
<?php } ?>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">nombre<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->nombre->CellAttributes() ?>><span id="cb_x_nombre">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_nombre" id="x_nombre" title="" size="30" maxlength="15" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->nombre->ViewAttributes() ?>><?php echo $usuario->nombre->ViewValue ?></div>
<input type="hidden" name="x_nombre" id="x_nombre" value="<?php echo ew_HtmlEncode($usuario->nombre->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">apellidos<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->apellidos->CellAttributes() ?>><span id="cb_x_apellidos">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_apellidos" id="x_apellidos" title="" size="30" maxlength="15" value="<?php echo $usuario->apellidos->EditValue ?>"<?php echo $usuario->apellidos->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->apellidos->ViewAttributes() ?>><?php echo $usuario->apellidos->ViewValue ?></div>
<input type="hidden" name="x_apellidos" id="x_apellidos" value="<?php echo ew_HtmlEncode($usuario->apellidos->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">email</td>
		<td<?php echo $usuario->email->CellAttributes() ?>><span id="cb_x_email">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_email" id="x_email" title="" size="30" maxlength="25" value="<?php echo $usuario->email->EditValue ?>"<?php echo $usuario->email->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->email->ViewAttributes() ?>><?php echo $usuario->email->ViewValue ?></div>
<input type="hidden" name="x_email" id="x_email" value="<?php echo ew_HtmlEncode($usuario->email->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">sexo<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->sexo->CellAttributes() ?>><span id="cb_x_sexo">
<?php if ($usuario->CurrentAction <> "F") { ?>
<?php
$arwrk = $usuario->sexo->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($usuario->sexo->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked" : "";
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<input type="radio" name="x_sexo" id="x_sexo" title="" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $usuario->sexo->EditAttributes() ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
<?php } else { ?>
<div<?php echo $usuario->sexo->ViewAttributes() ?>><?php echo $usuario->sexo->ViewValue ?></div>
<input type="hidden" name="x_sexo" id="x_sexo" value="<?php echo ew_HtmlEncode($usuario->sexo->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">fingreso<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->fingreso->CellAttributes() ?>><span id="cb_x_fingreso">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_fingreso" id="x_fingreso" title="" value="<?php echo $usuario->fingreso->EditValue ?>"<?php echo $usuario->fingreso->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->fingreso->ViewAttributes() ?>><?php echo $usuario->fingreso->ViewValue ?></div>
<input type="hidden" name="x_fingreso" id="x_fingreso" value="<?php echo ew_HtmlEncode($usuario->fingreso->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">perfil<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->perfil->CellAttributes() ?>><span id="cb_x_perfil">
<?php if ($usuario->CurrentAction <> "F") { ?>
<input type="text" name="x_perfil" id="x_perfil" title="" size="30" value="<?php echo $usuario->perfil->EditValue ?>"<?php echo $usuario->perfil->EditAttributes() ?>>
<?php } else { ?>
<div<?php echo $usuario->perfil->ViewAttributes() ?>><?php echo $usuario->perfil->ViewValue ?></div>
<input type="hidden" name="x_perfil" id="x_perfil" value="<?php echo ew_HtmlEncode($usuario->perfil->CurrentValue) ?>">
<?php } ?>
</span></td>
	</tr>
</table>
<p>
<?php if ($usuario->CurrentAction <> "F") { // Confirm page ?>
<input type="submit" name="btnAction" id="btnAction" value=" Register " onClick="this.form.a_register.value='F';">
<?php } else { ?>
<input type="submit" name="btnCancel" id="btnCancel" value="  Cancel  " onClick="this.form.a_register.value='X';">
<input type="submit" name="btnAction" id="btnAction" value="  Confirm  ">
<?php } ?>
</form>
<?php if ($usuario->CurrentAction <> "F") { ?>
<?php } ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

// If control is passed here, simply terminate the page without redirect
Page_Terminate();

// -----------------------------------------------------------------
//  Subroutine Page_Terminate
//  - called when exit page
//  - clean up connection and objects
//  - if url specified, redirect to url, otherwise end response
function Page_Terminate($url = "") {
	global $conn;

	// Page unload event, used in current page
	Page_Unload();

	// Global page unloaded event (in userfn*.php)
	Page_Unloaded();

	 // Close Connection
	$conn->Close();

	// Go to url if specified
	if ($url <> "") {
		ob_end_clean();
		header("Location: $url");
	}
	exit();
}
?>
<?php

// Activate account based on email
function ActivateEmail($email) {
	global $conn, $usuario;
	$sFilter = "(`email` = '" . ew_AdjustSql($email) . "')";
	$usuario->CurrentFilter = $sFilter;
	$sSql = $usuario->SQL();
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';
	if ($rs === FALSE)
		return FALSE;
	if (!$rs->EOF) {
		$rs->Close();
		$rsnew = array('login' => "Y"); // Auto register
	 	return $conn->Execute($usuario->UpdateSQL($rsnew));
	} else {
		$_SESSION[EW_SESSION_MESSAGE] = "No records found";
		$rs->Close();
		return FALSE;
	}
}
?>
<?php

// Load default values
function LoadDefaultValues() {
	global $usuario;
}
?>
<?php

// Load form values
function LoadFormValues() {

	// Load from form
	global $objForm, $usuario;
	$usuario->login->setFormValue($objForm->GetValue("x_login"));
	$usuario->clave->setFormValue($objForm->GetValue("x_clave"));
	$usuario->nombre->setFormValue($objForm->GetValue("x_nombre"));
	$usuario->apellidos->setFormValue($objForm->GetValue("x_apellidos"));
	$usuario->email->setFormValue($objForm->GetValue("x_email"));
	$usuario->sexo->setFormValue($objForm->GetValue("x_sexo"));
	$usuario->fingreso->setFormValue($objForm->GetValue("x_fingreso"));
	$usuario->fingreso->CurrentValue = ew_UnFormatDateTime($usuario->fingreso->CurrentValue, 5);
	$usuario->perfil->setFormValue($objForm->GetValue("x_perfil"));
}

// Restore form values
function RestoreFormValues() {
	global $usuario;
	$usuario->login->CurrentValue = $usuario->login->FormValue;
	$usuario->clave->CurrentValue = $usuario->clave->FormValue;
	$usuario->nombre->CurrentValue = $usuario->nombre->FormValue;
	$usuario->apellidos->CurrentValue = $usuario->apellidos->FormValue;
	$usuario->email->CurrentValue = $usuario->email->FormValue;
	$usuario->sexo->CurrentValue = $usuario->sexo->FormValue;
	$usuario->fingreso->CurrentValue = $usuario->fingreso->FormValue;
	$usuario->fingreso->CurrentValue = ew_UnFormatDateTime($usuario->fingreso->CurrentValue, 5);
	$usuario->perfil->CurrentValue = $usuario->perfil->FormValue;
}
?>
<?php

// Render row values based on field settings
function RenderRow() {
	global $conn, $Security, $usuario;

	// Call Row Rendering event
	$usuario->Row_Rendering();

	// Common render codes for all row types
	// login

	$usuario->login->CellCssStyle = "";
	$usuario->login->CellCssClass = "";

	// clave
	$usuario->clave->CellCssStyle = "";
	$usuario->clave->CellCssClass = "";

	// nombre
	$usuario->nombre->CellCssStyle = "";
	$usuario->nombre->CellCssClass = "";

	// apellidos
	$usuario->apellidos->CellCssStyle = "";
	$usuario->apellidos->CellCssClass = "";

	// email
	$usuario->email->CellCssStyle = "";
	$usuario->email->CellCssClass = "";

	// sexo
	$usuario->sexo->CellCssStyle = "";
	$usuario->sexo->CellCssClass = "";

	// fingreso
	$usuario->fingreso->CellCssStyle = "";
	$usuario->fingreso->CellCssClass = "";

	// perfil
	$usuario->perfil->CellCssStyle = "";
	$usuario->perfil->CellCssClass = "";
	if ($usuario->RowType == EW_ROWTYPE_VIEW) { // View row

		// login
		$usuario->login->ViewValue = $usuario->login->CurrentValue;
		$usuario->login->CssStyle = "";
		$usuario->login->CssClass = "";
		$usuario->login->ViewCustomAttributes = "";

		// clave
		$usuario->clave->ViewValue = $usuario->clave->CurrentValue;
		$usuario->clave->CssStyle = "";
		$usuario->clave->CssClass = "";
		$usuario->clave->ViewCustomAttributes = "";

		// nombre
		$usuario->nombre->ViewValue = $usuario->nombre->CurrentValue;
		$usuario->nombre->CssStyle = "";
		$usuario->nombre->CssClass = "";
		$usuario->nombre->ViewCustomAttributes = "";

		// apellidos
		$usuario->apellidos->ViewValue = $usuario->apellidos->CurrentValue;
		$usuario->apellidos->CssStyle = "";
		$usuario->apellidos->CssClass = "";
		$usuario->apellidos->ViewCustomAttributes = "";

		// email
		$usuario->email->ViewValue = $usuario->email->CurrentValue;
		$usuario->email->CssStyle = "";
		$usuario->email->CssClass = "";
		$usuario->email->ViewCustomAttributes = "";

		// sexo
		if (!is_null($usuario->sexo->CurrentValue)) {
			switch ($usuario->sexo->CurrentValue) {
				case "M":
					$usuario->sexo->ViewValue = "M";
					break;
				case "F":
					$usuario->sexo->ViewValue = "F";
					break;
				default:
					$usuario->sexo->ViewValue = $usuario->sexo->CurrentValue;
			}
		} else {
			$usuario->sexo->ViewValue = NULL;
		}
		$usuario->sexo->CssStyle = "";
		$usuario->sexo->CssClass = "";
		$usuario->sexo->ViewCustomAttributes = "";

		// fingreso
		$usuario->fingreso->ViewValue = $usuario->fingreso->CurrentValue;
		$usuario->fingreso->ViewValue = ew_FormatDateTime($usuario->fingreso->ViewValue, 5);
		$usuario->fingreso->CssStyle = "";
		$usuario->fingreso->CssClass = "";
		$usuario->fingreso->ViewCustomAttributes = "";

		// perfil
		$usuario->perfil->ViewValue = $usuario->perfil->CurrentValue;
		$usuario->perfil->CssStyle = "";
		$usuario->perfil->CssClass = "";
		$usuario->perfil->ViewCustomAttributes = "";

		// login
		$usuario->login->HrefValue = "";

		// clave
		$usuario->clave->HrefValue = "";

		// nombre
		$usuario->nombre->HrefValue = "";

		// apellidos
		$usuario->apellidos->HrefValue = "";

		// email
		$usuario->email->HrefValue = "";

		// sexo
		$usuario->sexo->HrefValue = "";

		// fingreso
		$usuario->fingreso->HrefValue = "";

		// perfil
		$usuario->perfil->HrefValue = "";
	} elseif ($usuario->RowType == EW_ROWTYPE_ADD) { // Add row

		// login
		$usuario->login->EditCustomAttributes = "";
		$usuario->login->EditValue = ew_HtmlEncode($usuario->login->CurrentValue);

		// clave
		$usuario->clave->EditCustomAttributes = "";
		$usuario->clave->EditValue = ew_HtmlEncode($usuario->clave->CurrentValue);

		// nombre
		$usuario->nombre->EditCustomAttributes = "";
		$usuario->nombre->EditValue = ew_HtmlEncode($usuario->nombre->CurrentValue);

		// apellidos
		$usuario->apellidos->EditCustomAttributes = "";
		$usuario->apellidos->EditValue = ew_HtmlEncode($usuario->apellidos->CurrentValue);

		// email
		$usuario->email->EditCustomAttributes = "";
		$usuario->email->EditValue = ew_HtmlEncode($usuario->email->CurrentValue);

		// sexo
		$usuario->sexo->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array("M", "M");
		$arwrk[] = array("F", "F");
		$usuario->sexo->EditValue = $arwrk;

		// fingreso
		$usuario->fingreso->EditCustomAttributes = "";
		$usuario->fingreso->EditValue = ew_HtmlEncode(ew_FormatDateTime($usuario->fingreso->CurrentValue, 5));

		// perfil
		$usuario->perfil->EditCustomAttributes = "";
		$usuario->perfil->EditValue = ew_HtmlEncode($usuario->perfil->CurrentValue);
	} elseif ($usuario->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($usuario->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$usuario->Row_Rendered();
}
?>
<?php

// Add record
function AddRow() {
	global $conn, $Security, $usuario;

	// Check for duplicate key
	$bCheckKey = TRUE;
	$sFilter = $usuario->SqlKeyFilter();
	if (trim(strval($usuario->login->CurrentValue)) == "") {
		$bCheckKey = FALSE;
	} else {
		$sFilter = str_replace("@login@", ew_AdjustSql($usuario->login->CurrentValue), $sFilter); // Replace key value
	}
	if ($bCheckKey) {
		$rsChk = $usuario->LoadRs($sFilter);
		if ($rsChk && !$rsChk->EOF) {
			$_SESSION[EW_SESSION_MESSAGE] = "Duplicate value for primary key";
			$rsChk->Close();
			return FALSE;
		}
	}
	$rsnew = array();

	// Field login
	$usuario->login->SetDbValueDef($usuario->login->CurrentValue, "");
	$rsnew['login'] =& $usuario->login->DbValue;

	// Field clave
	$usuario->clave->SetDbValueDef($usuario->clave->CurrentValue, "");
	$rsnew['clave'] =& $usuario->clave->DbValue;

	// Field nombre
	$usuario->nombre->SetDbValueDef($usuario->nombre->CurrentValue, "");
	$rsnew['nombre'] =& $usuario->nombre->DbValue;

	// Field apellidos
	$usuario->apellidos->SetDbValueDef($usuario->apellidos->CurrentValue, "");
	$rsnew['apellidos'] =& $usuario->apellidos->DbValue;

	// Field email
	$usuario->email->SetDbValueDef($usuario->email->CurrentValue, NULL);
	$rsnew['email'] =& $usuario->email->DbValue;

	// Field sexo
	$usuario->sexo->SetDbValueDef($usuario->sexo->CurrentValue, "");
	$rsnew['sexo'] =& $usuario->sexo->DbValue;

	// Field fingreso
	$usuario->fingreso->SetDbValueDef(ew_UnFormatDateTime($usuario->fingreso->CurrentValue, 5), ew_CurrentDate());
	$rsnew['fingreso'] =& $usuario->fingreso->DbValue;

	// Field perfil
	$usuario->perfil->SetDbValueDef($usuario->perfil->CurrentValue, 0);
	$rsnew['perfil'] =& $usuario->perfil->DbValue;

	// Call Row Inserting event
	$bInsertRow = $usuario->Row_Inserting($rsnew);
	if ($bInsertRow) {
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$AddRow = $conn->Execute($usuario->InsertSQL($rsnew));
		$conn->raiseErrorFn = '';
	} else {
		if ($usuario->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $usuario->CancelMessage;
			$usuario->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "Insert cancelled";
		}
		$AddRow = FALSE;
	}
	if ($AddRow) {

		// Call Row Inserted event
		$usuario->Row_Inserted($rsnew);
	}
	return $AddRow;
}
?>
<?php

// Page Load event
function Page_Load() {

	//echo "Page Load";
}

// Page Unload event
function Page_Unload() {

	//echo "Page Unload";
}
?>
