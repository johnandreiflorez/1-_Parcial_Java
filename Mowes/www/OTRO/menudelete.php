<?php
define("EW_PAGE_ID", "delete", TRUE); // Page ID
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

// Load Key Parameters
$sKey = "";
$bSingleDelete = TRUE; // Initialize as single delete
$arRecKeys = array();
$nKeySelected = 0; // Initialize selected key count
$sFilter = "";
if (@$_GET["idmenu"] <> "") {
	$menu->idmenu->setQueryStringValue($_GET["idmenu"]);
	if (!is_numeric($menu->idmenu->QueryStringValue)) {
		Page_Terminate($menu->getReturnUrl()); // Prevent sql injection, exit
	}
	$sKey .= $menu->idmenu->QueryStringValue;
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
if ($nKeySelected <= 0) Page_Terminate($menu->getReturnUrl()); // No key specified, exit

// Build filter
foreach ($arRecKeys as $sKey) {
	$sFilter .= "(";

	// Set up key field
	$sKeyFld = $sKey;
	if (!is_numeric($sKeyFld)) {
		Page_Terminate($menu->getReturnUrl()); // Prevent sql injection, exit
	}
	$sFilter .= "`idmenu`=" . ew_AdjustSql($sKeyFld) . " AND ";
	if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
}
if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

// Set up filter (Sql Where Clause) and get Return Sql
// Sql constructor in menu class, menuinfo.php

$menu->CurrentFilter = $sFilter;

// Get action
if (@$_POST["a_delete"] <> "") {
	$menu->CurrentAction = $_POST["a_delete"];
} else {
	$menu->CurrentAction = "I"; // Display record
}
switch ($menu->CurrentAction) {
	case "D": // Delete
		$menu->SendEmail = TRUE; // Send email on delete success
		if (DeleteRows()) { // delete rows
			$_SESSION[EW_SESSION_MESSAGE] = "Delete Successful"; // Set up success message
			Page_Terminate($menu->getReturnUrl()); // Return to caller
		}
}

// Load records for display
$rs = LoadRecordset();
$nTotalRecs = $rs->RecordCount(); // Get record count
if ($nTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	Page_Terminate($menu->getReturnUrl()); // Return to caller
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
<p><span class="phpmaker">Delete from TABLE: menu<br><br><a href="<?php echo $menu->getReturnUrl() ?>">Go Back</a></span></p>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form action="menudelete.php" method="post">
<p>
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($arRecKeys as $sKey) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($sKey) ?>">
<?php } ?>
<table class="ewTable">
	<tr class="ewTableHeader">
		<td valign="top">idmenu</td>
		<td valign="top">titulo</td>
		<td valign="top">enlace</td>
		<td valign="top">submenu</td>
		<td valign="top">estado</td>
	</tr>
<?php
$nRecCount = 0;
$i = 0;
while (!$rs->EOF) {
	$nRecCount++;

	// Set row class and style
	$menu->CssClass = "ewTableRow";
	$menu->CssStyle = "";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 1) {
		$menu->CssClass = "ewTableAltRow";
	}

	// Get the field contents
	LoadRowValues($rs);

	// Render row value
	$menu->RowType = EW_ROWTYPE_VIEW; // view
	RenderRow();
?>
	<tr<?php echo $menu->DisplayAttributes() ?>>
		<td<?php echo $menu->idmenu->CellAttributes() ?>>
<div<?php echo $menu->idmenu->ViewAttributes() ?>><?php echo $menu->idmenu->ViewValue ?></div>
</td>
		<td<?php echo $menu->titulo->CellAttributes() ?>>
<div<?php echo $menu->titulo->ViewAttributes() ?>><?php echo $menu->titulo->ViewValue ?></div>
</td>
		<td<?php echo $menu->enlace->CellAttributes() ?>>
<div<?php echo $menu->enlace->ViewAttributes() ?>><?php echo $menu->enlace->ViewValue ?></div>
</td>
		<td<?php echo $menu->submenu->CellAttributes() ?>>
<div<?php echo $menu->submenu->ViewAttributes() ?>><?php echo $menu->submenu->ViewValue ?></div>
</td>
		<td<?php echo $menu->estado->CellAttributes() ?>>
<div<?php echo $menu->estado->ViewAttributes() ?>><?php echo $menu->estado->ViewValue ?></div>
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
	global $conn, $Security, $menu;
	$DeleteRows = TRUE;
	$sWrkFilter = $menu->CurrentFilter;

	// Set up filter (Sql Where Clause) and get Return Sql
	// Sql constructor in menu class, menuinfo.php

	$menu->CurrentFilter = $sWrkFilter;
	$sSql = $menu->SQL();
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
			$DeleteRows = $menu->Row_Deleting($row);
			if (!$DeleteRows) break;
		}
	}
	if ($DeleteRows) {
		$sKey = "";
		foreach ($rsold as $row) {
			$sThisKey = "";
			if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sThisKey .= $row['idmenu'];
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$DeleteRows = $conn->Execute($menu->DeleteSQL($row)); // Delete
			$conn->raiseErrorFn = '';
			if ($DeleteRows === FALSE)
				break;
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}
	} else {

		// Set up error message
		if ($menu->CancelMessage <> "") {
			$_SESSION[EW_SESSION_MESSAGE] = $menu->CancelMessage;
			$menu->CancelMessage = "";
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
			$menu->Row_Deleted($row);
		}	
	}
	return $DeleteRows;
}
?>
<?php

// Load recordset
function LoadRecordset($offset = -1, $rowcnt = -1) {
	global $conn, $menu;

	// Call Recordset Selecting event
	$menu->Recordset_Selecting($menu->CurrentFilter);

	// Load list page sql
	$sSql = $menu->SelectSQL();
	if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

	// Load recordset
	$conn->raiseErrorFn = 'ew_ErrorFn';	
	$rs = $conn->Execute($sSql);
	$conn->raiseErrorFn = '';

	// Call Recordset Selected event
	$menu->Recordset_Selected($rs);
	return $rs;
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
	// idmenu

	$menu->idmenu->CellCssStyle = "";
	$menu->idmenu->CellCssClass = "";

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

		// idmenu
		$menu->idmenu->ViewValue = $menu->idmenu->CurrentValue;
		$menu->idmenu->CssStyle = "";
		$menu->idmenu->CssClass = "";
		$menu->idmenu->ViewCustomAttributes = "";

		// titulo
		$menu->titulo->ViewValue = $menu->titulo->CurrentValue;
		$menu->titulo->CssStyle = "";
		$menu->titulo->CssClass = "";
		$menu->titulo->ViewCustomAttributes = "";

		// enlace
		$menu->enlace->ViewValue = $menu->enlace->CurrentValue;
		$menu->enlace->CssStyle = "";
		$menu->enlace->CssClass = "";
		$menu->enlace->ViewCustomAttributes = "";

		// submenu
		if (!is_null($menu->submenu->CurrentValue)) {
			switch ($menu->submenu->CurrentValue) {
				case "S":
					$menu->submenu->ViewValue = "S";
					break;
				case "N":
					$menu->submenu->ViewValue = "N";
					break;
				default:
					$menu->submenu->ViewValue = $menu->submenu->CurrentValue;
			}
		} else {
			$menu->submenu->ViewValue = NULL;
		}
		$menu->submenu->CssStyle = "";
		$menu->submenu->CssClass = "";
		$menu->submenu->ViewCustomAttributes = "";

		// estado
		if (!is_null($menu->estado->CurrentValue)) {
			switch ($menu->estado->CurrentValue) {
				case "A":
					$menu->estado->ViewValue = "A";
					break;
				case "I":
					$menu->estado->ViewValue = "I";
					break;
				default:
					$menu->estado->ViewValue = $menu->estado->CurrentValue;
			}
		} else {
			$menu->estado->ViewValue = NULL;
		}
		$menu->estado->CssStyle = "";
		$menu->estado->CssClass = "";
		$menu->estado->ViewCustomAttributes = "";

		// idmenu
		$menu->idmenu->HrefValue = "";

		// titulo
		$menu->titulo->HrefValue = "";

		// enlace
		$menu->enlace->HrefValue = "";

		// submenu
		$menu->submenu->HrefValue = "";

		// estado
		$menu->estado->HrefValue = "";
	} elseif ($menu->RowType == EW_ROWTYPE_ADD) { // Add row
	} elseif ($menu->RowType == EW_ROWTYPE_EDIT) { // Edit row
	} elseif ($menu->RowType == EW_ROWTYPE_SEARCH) { // Search row
	}

	// Call Row Rendered event
	$menu->Row_Rendered();
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
