<?php
define("EW_PAGE_ID", "delete", TRUE); // Page ID
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

// Load Key Parameters
$sKey = "";
$bSingleDelete = TRUE; // Initialize as single delete
$arRecKeys = array();
$nKeySelected = 0; // Initialize selected key count
$sFilter = "";
if (@$_GET["login"] <> "") {
	$usuario->login->setQueryStringValue($_GET["login"]);
	$sKey .= $usuario->login->QueryStringValue;
} else {
	$bSingleDelete = FALSE;
}
if ($bSingleDelete) {
	$nKeySelected = 1; // Set up key selected count
	$arRecKeys[0] = $sKey;
} else {
	if (isset($_POST["key_m"])) { // Key in form
		$nKeySelected = count($_POST["key_m"]); // Set up key selected count
		$arRecKeys = ew_StripSlashes($_POST["key_m"]);
	}
}
if ($nKeySelected <= 0) Page_Terminate($usuario->getReturnUrl()); // No key specified, exit

// Build filter
foreach ($arRecKeys as $sKey) {
	$sFilter .= "(";

	// Set up key field
	$sKeyFld = $sKey;
	$sFilter .= "`login`='" . ew_AdjustSql($sKeyFld) . "' AND ";
	if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
}
if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

// Set up filter (Sql Where Clause) and get Return Sql
// Sql constructor in usuario class, usuarioinfo.php

$usuario->CurrentFilter = $sFilter;

// Get action
if (@$_POST["a_delete"] <> "") {
	$usuario->CurrentAction = $_POST["a_delete"];
} else {
	$usuario->CurrentAction = "I"; // Display record
}
switch ($usuario->CurrentAction) {
	case "D": // Delete
		$usuario->SendEmail = TRUE; // Send email on delete success
		if (DeleteRows()) { // delete rows
			$_SESSION[EW_SESSION_MESSAGE] = "Delete Successful"; // Set up success message
			Page_Terminate($usuario->getReturnUrl()); // Return to caller
		}
}

// Load records for display
$rs = LoadRecordset();
$nTotalRecs = $rs->RecordCount(); // Get record count
if ($nTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	Page_Terminate($usuario->getReturnUrl()); // Return to caller
}
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "delete"; // Page id

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Delete from TABLE: usuario<br><br><a href="<?php echo $usuario->getReturnUrl() ?>">Go Back</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form action="usuariodelete.php" method="post">
<p>
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($arRecKeys as $sKey) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($sKey) ?>">
<?php } ?>
<table class="ewTable">
	<tr class="ewTableHeader">
		<td valign="top">login</td>
		<td valign="top">clave</td>
		<td valign="top">nombre</td>
		<td valign="top">apellidos</td>
		<td valign="top">email</td>
		<td valign="top">sexo</td>
		<td valign="top">fingreso</td>
		<td valign="top">perfil</td>
	</tr>
<?php
$nRecCount = 0;
$i = 0;
while (!$rs->EOF) {
	$nRecCount++;

	// Set row class and style
	$usuario->CssClass = "ewTableRow";
	$usuario->CssStyle = "";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 1) {
		$usuario->CssClass = "ewTableAltRow";
	}

	// Get the field contents
	LoadRowValues($rs);

	// Render row value
	$usuario->RowType = EW_ROWTYPE_VIEW; // view
	RenderRow();
?>
	<tr<?php echo $usuario->DisplayAttributes() ?>>
		<td<?php echo $usuario->login->CellAttributes() ?>>
<div<?php echo $usuario->login->ViewAttributes() ?>><?php echo $usuario->login->ViewValue ?></div>
</td>
		<td<?php echo $usuario->clave->CellAttributes() ?>>
<div<?php echo $usuario->clave->ViewAttributes() ?>><?php echo $usuario->clave->ViewValue ?></div>
</td>
		<td<?php echo $usuario->nombre->CellAttributes() ?>>
<div<?php echo $usuario->nombre->ViewAttributes() ?>><?php echo $usuario->nombre->ViewValue ?></div>
</td>
		<td<?php echo $usuario->apellidos->CellAttributes() ?>>
<div<?php echo $usuario->apellidos->ViewAttributes() ?>><?php echo $usuario->apellidos->ViewValue ?></div>
</td>
		<td<?php echo $usuario->email->CellAttributes() ?>>
<div<?php echo $usuario->email->ViewAttributes() ?>><?php echo $usuario->email->ViewValue ?></div>
</td>
		<td<?php echo $usuario->sexo->CellAttributes() ?>>
<div<?php echo $usuario->sexo->ViewAttributes() ?>><?php echo $usuario->sexo->ViewValue ?></div>
</td>
		<td<?php echo $usuario->fingreso->CellAttributes() ?>>
<div<?php echo $usuario->fingreso->ViewAttributes() ?>><?php echo $usuario->fingreso->ViewValue ?></div>
</td>
		<td<?php echo $usuario->perfil->CellAttributes() ?>>
<div<?php echo $usuario->perfil->ViewAttributes() ?>><?php echo $usuario->perfil->ViewValue ?></div>
</td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</table>
<p>
<input type="submit" name="Action" id="Action" value="Confirm Delete">
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

// ------------------------------------------------
//  Function DeleteRows
//  - Delete Records based on current filter
function DeleteRows() {
	global $conn, $Security, $usuario;
	$DeleteRows = TRUE;
	$sWrkFilter = $usuario->CurrentFilter;

	// Set up filter (Sql Where Clause) and get Return Sql
	// Sql constructor in usuario class, usuarioinfo.php

	$usuario->CurrentFilter = $sWrkFilter;
	$sSql = $usuario->SQL();
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';
	if ($rs === FALSE) {
		return FALSE;
	} elseif ($rs->EOF) {
		$_SESSION[EW_SESSION_MESSAGE] = "No records found"; // No record found
		$rs->Close();
		return FALSE;
	}
	$conn->BeginTrans();

	// Clone old rows
	$rsold = ($rs) ? $rs->GetRows() : array();
	if ($rs) $rs->Close();

	// Call row deleting event
	if ($DeleteRows) {
		foreach ($rsold as $row) {
			$DeleteRows = $usuario->Row_Deleting($row);
			if (!$DeleteRows) break;
		}
	}
	if ($DeleteRows) {
		$sKey = "";
		foreach ($rsold as $row) {
			$sThisKey = "";
			if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sThisKey .= $row['login'];
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$DeleteRows = $conn->Execute($usuario->DeleteSQL($row)); // Delete
			$conn->raiseErrorFn = '';
			if ($DeleteRows === FALSE)
				break;
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}
	} else {

		// Set up error message
		if ($usuario->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $usuario->CancelMessage;
			$usuario->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "Delete cancelled";
		}
	}
	if ($DeleteRows) {
		$conn->CommitTrans(); // Commit the changes
	} else {
		$conn->RollbackTrans(); // Rollback changes
	}

	// Call recordset deleted event
	if ($DeleteRows) {
		foreach ($rsold as $row) {
			$usuario->Row_Deleted($row);
		}	
	}
	return $DeleteRows;
}
?>
<?php

// Load recordset
function LoadRecordset($offset = -1, $rowcnt = -1) {
	global $conn, $usuario;

	// Call Recordset Selecting event
	$usuario->Recordset_Selecting($usuario->CurrentFilter);

	// Load list page sql
	$sSql = $usuario->SelectSQL();
	if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

	// Load recordset
	$conn->raiseErrorFn = 'ew_ErrorFn';	
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';

	// Call Recordset Selected event
	$usuario->Recordset_Selected($rs);
	return $rs;
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
	} elseif ($usuario->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($usuario->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$usuario->Row_Rendered();
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
