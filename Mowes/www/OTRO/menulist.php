<?php
define("EW_PAGE_ID", "list", TRUE); // Page ID
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
if ($menu->Export == "excel") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=' . $sExportFile .'.xls');
}
?>
<?php

// Paging variables
$nStartRec = 0; // Start record index
$nStopRec = 0; // Stop record index
$nTotalRecs = 0; // Total number of records
$nDisplayRecs = 10;
$nRecRange = 10;
$nRecCount = 0; // Record count

// Search filters
$sSrchAdvanced = ""; // Advanced search filter
$sSrchBasic = ""; // Basic search filter
$sSrchWhere = ""; // Search where clause
$sFilter = "";

// Master/Detail
$sDbMasterFilter = ""; // Master filter
$sDbDetailFilter = ""; // Detail filter
$sSqlMaster = ""; // Sql for master record

// Handle reset command
ResetCmd();

// Get basic search criteria
$sSrchBasic = BasicSearchWhere();

// Build search criteria
if ($sSrchAdvanced <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchAdvanced . ")";
}
if ($sSrchBasic <> "") {
	if ($sSrchWhere <> "") $sSrchWhere .= " AND ";
	$sSrchWhere .= "(" . $sSrchBasic . ")";
}

// Save search criteria
if ($sSrchWhere <> "") {
	if ($sSrchBasic == "") ResetBasicSearchParms();
	$menu->setSearchWhere($sSrchWhere); // Save to Session
	$nStartRec = 1; // Reset start record counter
	$menu->setStartRecordNumber($nStartRec);
} else {
	RestoreSearchParms();
}

// Build filter
$sFilter = "";
if ($sDbDetailFilter <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sDbDetailFilter . ")";
}
if ($sSrchWhere <> "") {
	if ($sFilter <> "") $sFilter .= " AND ";
	$sFilter .= "(" . $sSrchWhere . ")";
}

// Set up filter in Session
$menu->setSessionWhere($sFilter);
$menu->CurrentFilter = "";

// Set Up Sorting Order
SetUpSortOrder();

// Set Return Url
$menu->setReturnUrl("menulist.php");
?>
<?php include "header.php" ?>
<?php if ($menu->Export == "") { ?>
<script type="text/javascript">
<!--
var EW_PAGE_ID = "list"; // Page id

//-->
</script>
<script type="text/javascript">
<!--
var firstrowoffset = 1; // First data row start at
var lastrowoffset = 0; // Last data row end at
var EW_LIST_TABLE_NAME = 'ewlistmain'; // Table name for list page
var rowclass = 'ewTableRow'; // Row class
var rowaltclass = 'ewTableAltRow'; // Row alternate class
var rowmoverclass = 'ewTableHighlightRow'; // Row mouse over class
var rowselectedclass = 'ewTableSelectRow'; // Row selected class
var roweditclass = 'ewTableEditRow'; // Row edit class

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
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($menu->Export == "") { ?>
<?php } ?>
<?php

// Load recordset
$bExportAll = (defined("EW_EXPORT_ALL") && $menu->Export <> "");
$bSelectLimit = ($menu->Export == "" && $menu->SelectLimit);
if (!$bSelectLimit) $rs = LoadRecordset();
$nTotalRecs = ($bSelectLimit) ? $menu->SelectRecordCount() : $rs->RecordCount();
$nStartRec = 1;
if ($nDisplayRecs <= 0) $nDisplayRecs = $nTotalRecs; // Display all records
if (!$bExportAll) SetUpStartRec(); // Set up start record position
if ($bSelectLimit) $rs = LoadRecordset($nStartRec-1, $nDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: menu
<?php if ($menu->Export == "") { ?>
&nbsp;&nbsp;<a href="menulist.php?export=excel">Export to Excel</a>
<?php } ?>
</span></p>
<?php if ($menu->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<form name="fmenulistsrch" id="fmenulistsrch" action="menulist.php" >
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($menu->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="menulist.php?cmd=reset">Show all</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="" <?php if ($menu->getBasicSearchType() == "") { ?>checked<?php } ?>>Exact phrase&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND" <?php if ($menu->getBasicSearchType() == "AND") { ?>checked<?php } ?>>All words&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR" <?php if ($menu->getBasicSearchType() == "OR") { ?>checked<?php } ?>>Any word</span></td>
	</tr>
</table>
</form>
<?php } ?>
<?php } ?>
<?php
if (@$_SESSION[EW_SESSION_MESSAGE] <> "") {
?>
<p><span class="ewmsg"><?php echo $_SESSION[EW_SESSION_MESSAGE] ?></span></p>
<?php
	$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message
}
?>
<form method="post" name="fmenulist" id="fmenulist">
<?php if ($menu->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="menuadd.php">Add</a>&nbsp;&nbsp;
<?php } ?>
	</span></td></tr>
</table>
<?php } ?>
<?php if ($nTotalRecs > 0) { ?>
<table id="ewlistmain" class="ewTable">
<?php
	$OptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$OptionCnt++; // delete
}
?>
	<!-- Table header -->
	<tr class="ewTableHeader">
		<td valign="top">
<?php if ($menu->Export <> "") { ?>
idmenu
<?php } else { ?>
	<a href="menulist.php?order=<?php echo urlencode('idmenu') ?>&ordertype=<?php echo $menu->idmenu->ReverseSort() ?>">idmenu<?php if ($menu->idmenu->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($menu->idmenu->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($menu->Export <> "") { ?>
titulo
<?php } else { ?>
	<a href="menulist.php?order=<?php echo urlencode('titulo') ?>&ordertype=<?php echo $menu->titulo->ReverseSort() ?>">titulo&nbsp;(*)<?php if ($menu->titulo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($menu->titulo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($menu->Export <> "") { ?>
enlace
<?php } else { ?>
	<a href="menulist.php?order=<?php echo urlencode('enlace') ?>&ordertype=<?php echo $menu->enlace->ReverseSort() ?>">enlace&nbsp;(*)<?php if ($menu->enlace->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($menu->enlace->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($menu->Export <> "") { ?>
submenu
<?php } else { ?>
	<a href="menulist.php?order=<?php echo urlencode('submenu') ?>&ordertype=<?php echo $menu->submenu->ReverseSort() ?>">submenu<?php if ($menu->submenu->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($menu->submenu->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($menu->Export <> "") { ?>
estado
<?php } else { ?>
	<a href="menulist.php?order=<?php echo urlencode('estado') ?>&ordertype=<?php echo $menu->estado->ReverseSort() ?>">estado<?php if ($menu->estado->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($menu->estado->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
<?php if ($menu->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap>&nbsp;</td>
<?php } ?>
<?php } ?>
	</tr>
<?php
if (defined("EW_EXPORT_ALL") && $menu->Export <> "") {
	$nStopRec = $nTotalRecs;
} else {
	$nStopRec = $nStartRec + $nDisplayRecs - 1; // Set the last record to display
}
$nRecCount = $nStartRec - 1;
if (!$rs->EOF) {
	$rs->MoveFirst();
	if (!$menu->SelectLimit) $rs->Move($nStartRec - 1); // Move to first record directly
}
$RowCnt = 0;
while (!$rs->EOF && $nRecCount < $nStopRec) {
	$nRecCount++;
	if (intval($nRecCount) >= intval($nStartRec)) {
		$RowCnt++;

	// Init row class and style
	$menu->CssClass = "ewTableRow";
	$menu->CssStyle = "";

	// Init row event
	$menu->RowClientEvents = "onmouseover='ew_MouseOver(this);' onmouseout='ew_MouseOut(this);' onclick='ew_Click(this);'";

	// Display alternate color for rows
	if ($RowCnt % 2 == 0) {
		$menu->CssClass = "ewTableAltRow";
	}
	LoadRowValues($rs); // Load row values
	$menu->RowType = EW_ROWTYPE_VIEW; // Render view
	RenderRow();
?>
	<!-- Table body -->
	<tr<?php echo $menu->DisplayAttributes() ?>>
		<!-- idmenu -->
		<td<?php echo $menu->idmenu->CellAttributes() ?>>
<div<?php echo $menu->idmenu->ViewAttributes() ?>><?php echo $menu->idmenu->ViewValue ?></div>
</td>
		<!-- titulo -->
		<td<?php echo $menu->titulo->CellAttributes() ?>>
<div<?php echo $menu->titulo->ViewAttributes() ?>><?php echo $menu->titulo->ViewValue ?></div>
</td>
		<!-- enlace -->
		<td<?php echo $menu->enlace->CellAttributes() ?>>
<div<?php echo $menu->enlace->ViewAttributes() ?>><?php echo $menu->enlace->ViewValue ?></div>
</td>
		<!-- submenu -->
		<td<?php echo $menu->submenu->CellAttributes() ?>>
<div<?php echo $menu->submenu->ViewAttributes() ?>><?php echo $menu->submenu->ViewValue ?></div>
</td>
		<!-- estado -->
		<td<?php echo $menu->estado->CellAttributes() ?>>
<div<?php echo $menu->estado->ViewAttributes() ?>><?php echo $menu->estado->ViewValue ?></div>
</td>
<?php if ($menu->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $menu->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $menu->EditUrl() ?>">Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $menu->CopyUrl() ?>">Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $menu->DeleteUrl() ?>">Delete</a>
</span></td>
<?php } ?>
<?php } ?>
	</tr>
<?php
	}
	$rs->MoveNext();
}
?>
</table>
<?php if ($menu->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="menuadd.php">Add</a>&nbsp;&nbsp;
<?php } ?>
	</span></td></tr>
</table>
<?php } ?>
<?php } ?>
</form>
<?php

// Close recordset and connection
if ($rs) $rs->Close();
?>
<?php if ($menu->Export == "") { ?>
<form action="menulist.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartRec, $nDisplayRecs, $nTotalRecs) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="menulist.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="menulist.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="menulist.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="menulist.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	<span class="phpmaker">Records <?php echo $Pager->FromIndex ?> to <?php echo $Pager->ToIndex ?> of <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php if ($menu->Export == "") { ?>
<?php } ?>
<?php if ($menu->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
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

// Return Basic Search sql
function BasicSearchSQL($Keyword) {
	$sKeyword = ew_AdjustSql($Keyword);
	$sql = "";
	$sql .= "`titulo` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`enlace` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`submenu` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`estado` LIKE '%" . $sKeyword . "%' OR ";
	if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
	return $sql;
}

// Return Basic Search Where based on search keyword and type
function BasicSearchWhere() {
	global $Security, $menu;
	$sSearchStr = "";
	$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
	$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	if ($sSearchKeyword <> "") {
		$sSearch = trim($sSearchKeyword);
		if ($sSearchType <> "") {
			while (strpos($sSearch, "  ") !== FALSE)
				$sSearch = str_replace("  ", " ", $sSearch);
			$arKeyword = explode(" ", trim($sSearch));
			foreach ($arKeyword as $sKeyword) {
				if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
				$sSearchStr .= "(" . BasicSearchSQL($sKeyword) . ")";
			}
		} else {
			$sSearchStr = BasicSearchSQL($sSearch);
		}
	}
	if ($sSearchKeyword <> "") {
		$menu->setBasicSearchKeyword($sSearchKeyword);
		$menu->setBasicSearchType($sSearchType);
	}
	return $sSearchStr;
}

// Clear all search parameters
function ResetSearchParms() {

	// Clear search where
	global $menu;
	$sSrchWhere = "";
	$menu->setSearchWhere($sSrchWhere);

	// Clear basic search parameters
	ResetBasicSearchParms();
}

// Clear all basic search parameters
function ResetBasicSearchParms() {

	// Clear basic search parameters
	global $menu;
	$menu->setBasicSearchKeyword("");
	$menu->setBasicSearchType("");
}

// Restore all search parameters
function RestoreSearchParms() {
	global $sSrchWhere, $menu;
	$sSrchWhere = $menu->getSearchWhere();
}

// Set up Sort parameters based on Sort Links clicked
function SetUpSortOrder() {
	global $menu;

	// Check for an Order parameter
	if (@$_GET["order"] <> "") {
		$menu->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
		$menu->CurrentOrderType = @$_GET["ordertype"];

		// Field idmenu
		$menu->UpdateSort($menu->idmenu);

		// Field titulo
		$menu->UpdateSort($menu->titulo);

		// Field enlace
		$menu->UpdateSort($menu->enlace);

		// Field submenu
		$menu->UpdateSort($menu->submenu);

		// Field estado
		$menu->UpdateSort($menu->estado);
		$menu->setStartRecordNumber(1); // Reset start position
	}
	$sOrderBy = $menu->getSessionOrderBy(); // Get order by from Session
	if ($sOrderBy == "") {
		if ($menu->SqlOrderBy() <> "") {
			$sOrderBy = $menu->SqlOrderBy();
			$menu->setSessionOrderBy($sOrderBy);
		}
	}
}

// Reset command based on querystring parameter cmd=
// - RESET: reset search parameters
// - RESETALL: reset search & master/detail parameters
// - RESETSORT: reset sort parameters
function ResetCmd() {
	global $sDbMasterFilter, $sDbDetailFilter, $nStartRec, $sOrderBy;
	global $menu;

	// Get reset cmd
	if (@$_GET["cmd"] <> "") {
		$sCmd = $_GET["cmd"];

		// Reset search criteria
		if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall") {
			ResetSearchParms();
		}

		// Reset Sort Criteria
		if (strtolower($sCmd) == "resetsort") {
			$sOrderBy = "";
			$menu->setSessionOrderBy($sOrderBy);
			$menu->idmenu->setSort("");
			$menu->titulo->setSort("");
			$menu->enlace->setSort("");
			$menu->submenu->setSort("");
			$menu->estado->setSort("");
		}

		// Reset start position
		$nStartRec = 1;
		$menu->setStartRecordNumber($nStartRec);
	}
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
