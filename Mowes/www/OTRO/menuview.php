<?php
define("EW_PAGE_ID", "view", TRUE); // Page ID
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
if (@$_GET["idmenu"] <> "") {
	$menu->idmenu->setQueryStringValue($_GET["idmenu"]);
} else {
	Page_Terminate("menulist.php"); // Return to list page
}

// Get action
if (@$_POST["a_view"] <> "") {
	$menu->CurrentAction = $_POST["a_view"];
} else {
	$menu->CurrentAction = "I"; // Display form
}
switch ($menu->CurrentAction) {
	case "I": // Get a record to display
		if (!LoadRow()) { // Load record based on key
			$_SESSION[EW_SESSION_MESSAGE] = "No records found"; // Set no record message
			Page_Terminate("menulist.php"); // Return to list
		}
}

// Set return url
$menu->setReturnUrl("menuview.php");

// Render row
$menu->RowType = EW_ROWTYPE_VIEW;
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
<p><span class="phpmaker">View TABLE: menu
<br><br>
<a href="menulist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="menuadd.php">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $menu->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $menu->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $menu->DeleteUrl() ?>">Delete</a>&nbsp;
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
		<td class="ewTableHeader">idmenu</td>
		<td<?php echo $menu->idmenu->CellAttributes() ?>>
<div<?php echo $menu->idmenu->ViewAttributes() ?>><?php echo $menu->idmenu->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">titulo</td>
		<td<?php echo $menu->titulo->CellAttributes() ?>>
<div<?php echo $menu->titulo->ViewAttributes() ?>><?php echo $menu->titulo->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">enlace</td>
		<td<?php echo $menu->enlace->CellAttributes() ?>>
<div<?php echo $menu->enlace->ViewAttributes() ?>><?php echo $menu->enlace->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableAltRow">
		<td class="ewTableHeader">submenu</td>
		<td<?php echo $menu->submenu->CellAttributes() ?>>
<div<?php echo $menu->submenu->ViewAttributes() ?>><?php echo $menu->submenu->ViewValue ?></div>
</td>
	</tr>
	<tr class="ewTableRow">
		<td class="ewTableHeader">estado</td>
		<td<?php echo $menu->estado->CellAttributes() ?>>
<div<?php echo $menu->estado->ViewAttributes() ?>><?php echo $menu->estado->ViewValue ?></div>
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

// Set up Starting Record parameters based on Pager Navigation
function SetUpStartRec() {
	global $nDisplayRecs, $nStartRec, $nTotalRecs, $nPageNo, $menu;
	if ($nDisplayRecs == 0) return;

	// Check for a START parameter
	if (@$_GET[EW_TABLE_START_REC] <> "") {
		$nStartRec = $_GET[EW_TABLE_START_REC];
		$menu->setStartRecordNumber($nStartRec);
	} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
		$nPageNo = $_GET[EW_TABLE_PAGE_NO];
		if (is_numeric($nPageNo)) {
			$nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
			if ($nStartRec <= 0) {
				$nStartRec = 1;
			} elseif ($nStartRec >= intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1) {
				$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
			}
			$menu->setStartRecordNumber($nStartRec);
		} else {
			$nStartRec = $menu->getStartRecordNumber();
		}
	} else {
		$nStartRec = $menu->getStartRecordNumber();
	}

	// Check if correct start record counter
	if (!is_numeric($nStartRec) || $nStartRec == "") { // Avoid invalid start record counter
		$nStartRec = 1; // Reset start record counter
		$menu->setStartRecordNumber($nStartRec);
	} elseif (intval($nStartRec) > intval($nTotalRecs)) { // Avoid starting record > total records
		$nStartRec = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to last page first record
		$menu->setStartRecordNumber($nStartRec);
	} elseif (($nStartRec-1) % $nDisplayRecs <> 0) {
		$nStartRec = intval(($nStartRec-1)/$nDisplayRecs)*$nDisplayRecs+1; // Point to page boundary
		$menu->setStartRecordNumber($nStartRec);
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
