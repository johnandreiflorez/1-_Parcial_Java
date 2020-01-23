<?php
define("EW_PAGE_ID", "view", TRUE); // Page ID
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
if (@$_GET["login"] <> "") {
	$usuario->login->setQueryStringValue($_GET["login"]);
} else {
	Page_Terminate("usuariolist.php"); // Return to list page
}

// Get action
if (@$_POST["a_view"] <> "") {
	$usuario->CurrentAction = $_POST["a_view"];
} else {
	$usuario->CurrentAction = "I"; // Display form
}
switch ($usuario->CurrentAction) {
	case "I": // Get a record to display
		if (!LoadRow()) { // Load record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "No records found"; // Set no record message
			Page_Terminate("usuariolist.php"); // Return to list
		}
}

// Set return url
$usuario->setReturnUrl("usuarioview.php");

// Render row
$usuario->RowType = EW_ROWTYPE_VIEW;
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "view"; // Page id

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">View TABLE: usuario
<br><br>
<a href="usuariolist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="usuarioadd.php">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $usuario->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span>
</p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<p>
<form>
<table class="ewTable">
	<tr class="ewTableRow">
		<td class="ewTableHeader">login</td>
		<td<?php echo $usuario->login->CellAttributes() ?>>
<div<?php echo $usuario->login->ViewAttributes() ?>><?php echo $usuario->login->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">clave</td>
		<td<?php echo $usuario->clave->CellAttributes() ?>>
<div<?php echo $usuario->clave->ViewAttributes() ?>><?php echo $usuario->clave->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">nombre</td>
		<td<?php echo $usuario->nombre->CellAttributes() ?>>
<div<?php echo $usuario->nombre->ViewAttributes() ?>><?php echo $usuario->nombre->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">apellidos</td>
		<td<?php echo $usuario->apellidos->CellAttributes() ?>>
<div<?php echo $usuario->apellidos->ViewAttributes() ?>><?php echo $usuario->apellidos->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">email</td>
		<td<?php echo $usuario->email->CellAttributes() ?>>
<div<?php echo $usuario->email->ViewAttributes() ?>><?php echo $usuario->email->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">sexo</td>
		<td<?php echo $usuario->sexo->CellAttributes() ?>>
<div<?php echo $usuario->sexo->ViewAttributes() ?>><?php echo $usuario->sexo->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">fingreso</td>
		<td<?php echo $usuario->fingreso->CellAttributes() ?>>
<div<?php echo $usuario->fingreso->ViewAttributes() ?>><?php echo $usuario->fingreso->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">perfil</td>
		<td<?php echo $usuario->perfil->CellAttributes() ?>>
<div<?php echo $usuario->perfil->ViewAttributes() ?>><?php echo $usuario->perfil->ViewValue ?></div>
</td>
	</tr>
</table>
</form>
<p>
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

// Set up Starting Record parameters based on Pager Navigation
function SetUpStartRec() {
	global $nDisplayRecs, $nStartRec, $nTotalRecs, $nPageNo, $usuario;
	if ($nDisplayRecs == 0) return;

	// Check for a START parameter
	if (@$_GET[EW_TABLE_START_REC] <> "") {
		$nStartRec = $_GET[EW_TABLE_START_REC];
		$usuario->setStartRecordNumber($nStartRec);
	} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
		$nPageNo = $_GET[EW_TABLE_PAGE_NO];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			} elseif ($nStartRec >= intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$usuario->setStartRecordNumber($nStartRec);
		} else {
			$nStartRec = $usuario->getStartRecordNumber();
		}
	} else {
		$nStartRec = $usuario->getStartRecordNumber();
	}

	// Check if correct start record counter
	if (!is_numeric($nStartRec) || $nStartRec == "") { // Avoid invalid start record counter
		$nStartRec = 1; // Reset start record counter
		$usuario->setStartRecordNumber($nStartRec);
	} elseif (intval($nStartRec) > intval($nTotalRecs)) { // Avoid starting record > total records
		$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to last page first record
		$usuario->setStartRecordNumber($nStartRec);
	} elseif (($nStartRec-1) % $nDisplayRecs <> 0) {
		$nStartRec = intval(($nStartRec-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to page boundary
		$usuario->setStartRecordNumber($nStartRec);
	}
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
