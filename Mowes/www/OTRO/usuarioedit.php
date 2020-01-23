<?php
define("EW_PAGE_ID", "edit", TRUE); // Page ID
define("EW_TABLE_NAME", 'usuario', TRUE);
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
if (!$Security->IsLoggedIn()) $Security->AutoLogin();
if (!$Security->IsLoggedIn()) {
	$Security->SaveLastUrl();
	Page_Terminate("login.php");
}
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
$usuario->Export = @$_GET["export"]; // Get export parameter
$sExport = $usuario->Export; // Get export parameter, used in header
$sExportFile = $usuario->TableVar; // Get export file, used in header
?>
<?php

// Load key from QueryString
if (@$_GET["login"] <> "") {
	$usuario->login->setQueryStringValue($_GET["login"]);
}

// Create form object
$objForm = new cFormObj();
if (@$_POST["a_edit"] <> "") {
	$usuario->CurrentAction = $_POST["a_edit"]; // Get action code
	LoadFormValues(); // Get form values
} else {
	$usuario->CurrentAction = "I"; // Default action is display
}

// Check if valid key
if ($usuario->login->CurrentValue == "") Page_Terminate($usuario->getReturnUrl()); // Invalid key, exit
switch ($usuario->CurrentAction) {
	case "I": // Get a record to display
		if (!LoadRow()) { // Load Record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "No records found"; // No record found
			Page_Terminate($usuario->getReturnUrl()); // Return to caller
		}
		break;
	Case "U": // Update
		$usuario->SendEmail = TRUE; // Send email on update success
		if (EditRow()) { // Update Record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "Update successful"; // Update success
			Page_Terminate($usuario->getReturnUrl()); // Return to caller
		} else {
			RestoreFormValues(); // Restore form values if update failed
		}
}

// Render the record
$usuario->RowType = EW_ROWTYPE_EDIT; // Render as edit
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "edit"; // Page id

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
<p><span class="phpmaker">Edit TABLE: usuario<br><br><a href="<?php echo $usuario->getReturnUrl() ?>">Go Back</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form name="fusuarioedit" id="fusuarioedit" action="usuarioedit.php" method="post" onSubmit="return ew_ValidateForm(this);">
<p>
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table class="ewTable">
	<tr class="ewTableRow">
		<td class="ewTableHeader">login<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->login->CellAttributes() ?>><span id="cb_x_login">
<div<?php echo $usuario->login->ViewAttributes() ?>><?php echo $usuario->login->EditValue ?></div>
<input type="hidden" name="x_login" id="x_login" value="<?php echo ew_HtmlEncode($usuario->login->CurrentValue) ?>">
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">clave<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->clave->CellAttributes() ?>><span id="cb_x_clave">
<input type="text" name="x_clave" id="x_clave" title="" size="30" maxlength="15" value="<?php echo $usuario->clave->EditValue ?>"<?php echo $usuario->clave->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">nombre<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->nombre->CellAttributes() ?>><span id="cb_x_nombre">
<input type="text" name="x_nombre" id="x_nombre" title="" size="30" maxlength="15" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">apellidos<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->apellidos->CellAttributes() ?>><span id="cb_x_apellidos">
<input type="text" name="x_apellidos" id="x_apellidos" title="" size="30" maxlength="15" value="<?php echo $usuario->apellidos->EditValue ?>"<?php echo $usuario->apellidos->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">email</td>
		<td<?php echo $usuario->email->CellAttributes() ?>><span id="cb_x_email">
<input type="text" name="x_email" id="x_email" title="" size="30" maxlength="25" value="<?php echo $usuario->email->EditValue ?>"<?php echo $usuario->email->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">sexo<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->sexo->CellAttributes() ?>><span id="cb_x_sexo">
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
</span></td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">fingreso<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->fingreso->CellAttributes() ?>><span id="cb_x_fingreso">
<input type="text" name="x_fingreso" id="x_fingreso" title="" value="<?php echo $usuario->fingreso->EditValue ?>"<?php echo $usuario->fingreso->EditAttributes() ?>>
</span></td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">perfil<span class='ewmsg'>&nbsp;*</span></td>
		<td<?php echo $usuario->perfil->CellAttributes() ?>><span id="cb_x_perfil">
<input type="text" name="x_perfil" id="x_perfil" title="" size="30" value="<?php echo $usuario->perfil->EditValue ?>"<?php echo $usuario->perfil->EditAttributes() ?>>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="   Edit   ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
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

// Load row based on key values
function LoadRow() {
	global $conn, $Security, $usuario;
	$sFilter = $usuario->SqlKeyFilter();
	$sFilter = str_replace("@login@", ew_AdjustSql($usuario->login->CurrentValue), $sFilter); // Replace key value

	// Call Row Selecting event
	$usuario->Row_Selecting($sFilter);

	// Load sql based on filter
	$usuario->CurrentFilter = $sFilter;
	$sSql = $usuario->SQL();
	if ($rs = $conn->Execute($sSql)) {
		if ($rs->EOF) {
			$LoadRow = FALSE;
		} else {
			$LoadRow = TRUE;
			$rs->MoveFirst();
			LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$usuario->Row_Selected($rs);
		}
		$rs->Close();
	} else {
		$LoadRow = FALSE;
	}
	return $LoadRow;
}

// Load row values from recordset
function LoadRowValues(&$rs) {
	global $usuario;
	$usuario->login->setDbValue($rs->fields('login'));
	$usuario->clave->setDbValue($rs->fields('clave'));
	$usuario->nombre->setDbValue($rs->fields('nombre'));
	$usuario->apellidos->setDbValue($rs->fields('apellidos'));
	$usuario->email->setDbValue($rs->fields('email'));
	$usuario->sexo->setDbValue($rs->fields('sexo'));
	$usuario->fingreso->setDbValue($rs->fields('fingreso'));
	$usuario->perfil->setDbValue($rs->fields('perfil'));
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
	} elseif ($usuario->RowType == EW_ROWTYPE_ADD) { // Add row
	} elseif ($usuario->RowType == EW_ROWTYPE_EDIT) { // Edit row

		// login
		$usuario->login->EditCustomAttributes = "";
		$usuario->login->EditValue = $usuario->login->CurrentValue;
		$usuario->login->CssStyle = "";
		$usuario->login->CssClass = "";
		$usuario->login->ViewCustomAttributes = "";

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
	} elseif ($usuario->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$usuario->Row_Rendered();
}
?>
<?php

// Update record based on key values
function EditRow() {
	global $conn, $Security, $usuario;
	$sFilter = $usuario->SqlKeyFilter();
	$sFilter = str_replace("@login@", ew_AdjustSql($usuario->login->CurrentValue), $sFilter); // Replace key value
	$usuario->CurrentFilter = $sFilter;
	$sSql = $usuario->SQL();
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';
	if ($rs === FALSE)
		return FALSE;
	if ($rs->EOF) {
		$EditRow = FALSE; // Update Failed
	} else {

		// Save old values
		$rsold =& $rs->fields;
		$rsnew = array();

		// Field login
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

		// Call Row Updating event
		$bUpdateRow = $usuario->Row_Updating($rsold, $rsnew);
		if ($bUpdateRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$EditRow = $conn->Execute($usuario->UpdateSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($usuario->CancelMessage <> "") {
				$_SESSION[EW_SESSION_MESSAGE] = $usuario->CancelMessage;
				$usuario->CancelMessage = "";
			} else {
				$_SESSION[EW_SESSION_MESSAGE] = "Update cancelled";
			}
			$EditRow = FALSE;
		}
	}

	// Call Row Updated event
	if ($EditRow) {
		$usuario->Row_Updated($rsold, $rsnew);
	}
	$rs->Close();
	return $EditRow;
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
