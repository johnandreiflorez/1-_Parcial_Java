<?php
define("EW_PAGE_ID", "add", TRUE); // Page ID
define("EW_TABLE_NAME", 'menu', TRUE);
?>
<?php 
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg50.php" ?>
<?php include "ewmysql50.php" ?>
<?php include "phpfn50.php" ?>
<?php include "menuinfo.php" ?>
<?php include "userfn50.php" ?>
<?php include "usuarioinfo.php" ?>
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
$menu->Export = @$_GET["export"]; // Get export parameter
$sExport = $menu->Export; // Get export parameter, used in header
$sExportFile = $menu->TableVar; // Get export file, used in header
?>
<?php

// Load key values from QueryString
$bCopy = TRUE;
if (@$_GET["idmenu"] != "") {
  $menu->idmenu->setQueryStringValue($_GET["idmenu"]);
} else {
  $bCopy = FALSE;
}

// Create form object
$objForm = new cFormObj();

// Process form if post back
if (@$_POST["a_add"] <> "") {
  $menu->CurrentAction = $_POST["a_add"]; // Get form action
  LoadFormValues(); // Load form values
} else { // Not post back
  if ($bCopy) {
    $menu->CurrentAction = "C"; // Copy Record
  } else {
    $menu->CurrentAction = "I"; // Display Blank Record
    LoadDefaultValues(); // Load default values
  }
}

// Perform action based on action code
switch ($menu->CurrentAction) {
  case "I": // Blank record, no action required
		break;
  case "C": // Copy an existing record
   if (!LoadRow()) { // Load record based on key
      $_SESSION[EW_SESSION_MESSAGE] = "No records found"; // No record found
      Page_Terminate($menu->getReturnUrl()); // Clean up and return
    }
		break;
  case "A": // ' Add new record
		$menu->SendEmail = TRUE; // Send email on add success
    if (AddRow()) { // Add successful
      $_SESSION[EW_SESSION_MESSAGE] = "Add New Record Successful"; // Set up success message
      Page_Terminate($menu->KeyUrl($menu->getReturnUrl())); // Clean up and return
    } else {
      RestoreFormValues(); // Add failed, restore form values
    }
}

// Render row based on row type
$menu->RowType = EW_ROWTYPE_ADD;  // Render add type
RenderRow();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "add"; // Page id

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
		elm = fobj.elements["x" + infix + "_titulo"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - titulo"))
				return false;
		}
		elm = fobj.elements["x" + infix + "_estado"];
		if (elm && !ew_HasValue(elm)) {
			if (!ew_OnError(elm, "Please enter required field - estado"))
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
<p><span class="phpmaker">Add to TABLE: menu<br><br><a href="<?php echo $menu->getReturnUrl() ?>">Go Back</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Mesasge in Session, display
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
  $_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
}
?>
<form name="fmenuadd" id="fmenuadd" action="menuadd.php" method="post" onSubmit="return ew_ValidateForm(this);">
<p>
<input type="hidden" name="a_add" id="a_add" value="A">
<table class="ewTable">
  <tr class="ewTableRow">
    <td class="ewTableHeader">titulo<span class='ewmsg'>&nbsp;*</span></td>
    <td<?php echo $menu->titulo->CellAttributes() ?>><span id="cb_x_titulo">
<input type="text" name="x_titulo" id="x_titulo" title="" size="30" maxlength="30" value="<?php echo $menu->titulo->EditValue ?>"<?php echo $menu->titulo->EditAttributes() ?>>
</span></td>
  </tr>
  <tr class="ewTableAltRow">
    <td class="ewTableHeader">enlace</td>
    <td<?php echo $menu->enlace->CellAttributes() ?>><span id="cb_x_enlace">
<input type="text" name="x_enlace" id="x_enlace" title="" size="30" maxlength="50" value="<?php echo $menu->enlace->EditValue ?>"<?php echo $menu->enlace->EditAttributes() ?>>
</span></td>
  </tr>
  <tr class="ewTableRow">
    <td class="ewTableHeader">submenu</td>
    <td<?php echo $menu->submenu->CellAttributes() ?>><span id="cb_x_submenu">
<?php
$arwrk = $menu->submenu->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($menu->submenu->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked" : "";
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<input type="radio" name="x_submenu" id="x_submenu" title="" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $menu->submenu->EditAttributes() ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</span></td>
  </tr>
  <tr class="ewTableAltRow">
    <td class="ewTableHeader">estado<span class='ewmsg'>&nbsp;*</span></td>
    <td<?php echo $menu->estado->CellAttributes() ?>><span id="cb_x_estado">
<?php
$arwrk = $menu->estado->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($menu->estado->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked" : "";
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<input type="radio" name="x_estado" id="x_estado" title="" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $menu->estado->EditAttributes() ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</span></td>
  </tr>
</table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="    Add    ">
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

// Load default values
function LoadDefaultValues() {
	global $menu;
	$menu->estado->CurrentValue = "A";
}
?>
<?php

// Load form values
function LoadFormValues() {

	// Load from form
	global $objForm, $menu;
	$menu->titulo->setFormValue($objForm->GetValue("x_titulo"));
	$menu->enlace->setFormValue($objForm->GetValue("x_enlace"));
	$menu->submenu->setFormValue($objForm->GetValue("x_submenu"));
	$menu->estado->setFormValue($objForm->GetValue("x_estado"));
}

// Restore form values
function RestoreFormValues() {
	global $menu;
	$menu->titulo->CurrentValue = $menu->titulo->FormValue;
	$menu->enlace->CurrentValue = $menu->enlace->FormValue;
	$menu->submenu->CurrentValue = $menu->submenu->FormValue;
	$menu->estado->CurrentValue = $menu->estado->FormValue;
}
?>
<?php

// Load row based on key values
function LoadRow() {
	global $conn, $Security, $menu;
	$sFilter = $menu->SqlKeyFilter();
	if (!is_numeric($menu->idmenu->CurrentValue)) {
		return FALSE; // Invalid key, exit
	}
	$sFilter = str_replace("@idmenu@", ew_AdjustSql($menu->idmenu->CurrentValue), $sFilter); // Replace key value

	// Call Row Selecting event
	$menu->Row_Selecting($sFilter);

	// Load sql based on filter
	$menu->CurrentFilter = $sFilter;
	$sSql = $menu->SQL();
	if ($rs = $conn->Execute($sSql)) {
		if ($rs->EOF) {
			$LoadRow = FALSE;
		} else {
			$LoadRow = TRUE;
			$rs->MoveFirst();
			LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$menu->Row_Selected($rs);
		}
		$rs->Close();
	} else {
		$LoadRow = FALSE;
	}
	return $LoadRow;
}

// Load row values from recordset
function LoadRowValues(&$rs) {
	global $menu;
	$menu->idmenu->setDbValue($rs->fields('idmenu'));
	$menu->titulo->setDbValue($rs->fields('titulo'));
	$menu->enlace->setDbValue($rs->fields('enlace'));
	$menu->submenu->setDbValue($rs->fields('submenu'));
	$menu->estado->setDbValue($rs->fields('estado'));
}
?>
<?php

// Render row values based on field settings
function RenderRow() {
	global $conn, $Security, $menu;

	// Call Row Rendering event
	$menu->Row_Rendering();

	// Common render codes for all row types
	// titulo

	$menu->titulo->CellCssStyle = "";
	$menu->titulo->CellCssClass = "";

	// enlace
	$menu->enlace->CellCssStyle = "";
	$menu->enlace->CellCssClass = "";

	// submenu
	$menu->submenu->CellCssStyle = "";
	$menu->submenu->CellCssClass = "";

	// estado
	$menu->estado->CellCssStyle = "";
	$menu->estado->CellCssClass = "";
	if ($menu->RowType == EW_ROWTYPE_VIEW) { // View row
	} elseif ($menu->RowType == EW_ROWTYPE_ADD) { // Add row

		// titulo
		$menu->titulo->EditCustomAttributes = "";
		$menu->titulo->EditValue = ew_HtmlEncode($menu->titulo->CurrentValue);

		// enlace
		$menu->enlace->EditCustomAttributes = "";
		$menu->enlace->EditValue = ew_HtmlEncode($menu->enlace->CurrentValue);

		// submenu
		$menu->submenu->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array("S", "S");
		$arwrk[] = array("N", "N");
		$menu->submenu->EditValue = $arwrk;

		// estado
		$menu->estado->EditCustomAttributes = "";
		$arwrk = array();
		$arwrk[] = array("A", "A");
		$arwrk[] = array("I", "I");
		$menu->estado->EditValue = $arwrk;
	} elseif ($menu->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($menu->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$menu->Row_Rendered();
}
?>
<?php

// Add record
function AddRow() {
	global $conn, $Security, $menu;

	// Check for duplicate key
	$bCheckKey = TRUE;
	$sFilter = $menu->SqlKeyFilter();
	if (trim(strval($menu->idmenu->CurrentValue)) == "") {
		$bCheckKey = FALSE;
	} else {
		$sFilter = str_replace("@idmenu@", ew_AdjustSql($menu->idmenu->CurrentValue), $sFilter); // Replace key value
	}
	if (!is_numeric($menu->idmenu->CurrentValue)) {
		$bCheckKey = FALSE;
	}
	if ($bCheckKey) {
		$rsChk = $menu->LoadRs($sFilter);
		if ($rsChk && !$rsChk->EOF) {
			$_SESSION[EW_SESSION_MESSAGE] = "Duplicate value for primary key";
			$rsChk->Close();
			return FALSE;
		}
	}
	$rsnew = array();

	// Field titulo
	$menu->titulo->SetDbValueDef($menu->titulo->CurrentValue, "");
	$rsnew['titulo'] =& $menu->titulo->DbValue;

	// Field enlace
	$menu->enlace->SetDbValueDef($menu->enlace->CurrentValue, NULL);
	$rsnew['enlace'] =& $menu->enlace->DbValue;

	// Field submenu
	$menu->submenu->SetDbValueDef($menu->submenu->CurrentValue, NULL);
	$rsnew['submenu'] =& $menu->submenu->DbValue;

	// Field estado
	$menu->estado->SetDbValueDef($menu->estado->CurrentValue, "");
	$rsnew['estado'] =& $menu->estado->DbValue;

	// Call Row Inserting event
	$bInsertRow = $menu->Row_Inserting($rsnew);
	if ($bInsertRow) {
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$AddRow = $conn->Execute($menu->InsertSQL($rsnew));
		$conn->raiseErrorFn = '';
	} else {
		if ($menu->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $menu->CancelMessage;
			$menu->CancelMessage = "";
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = "Insert cancelled";
		}
		$AddRow = FALSE;
	}
	if ($AddRow) {
		$menu->idmenu->setDbValue($conn->Insert_ID());
		$rsnew['idmenu'] =& $menu->idmenu->DbValue;

		// Call Row Inserted event
		$menu->Row_Inserted($rsnew);
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
