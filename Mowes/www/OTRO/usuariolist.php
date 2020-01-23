<?php
define("EW_PAGE_ID", "list", TRUE); // Page ID
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
if ($usuario->Export == "excel") {
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
	$usuario->setSearchWhere($sSrchWhere); // Save to Session
	$nStartRec = 1; // Reset start record counter
	$usuario->setStartRecordNumber($nStartRec);
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
$usuario->setSessionWhere($sFilter);
$usuario->CurrentFilter = "";

// Set Up Sorting Order
SetUpSortOrder();

// Set Return Url
$usuario->setReturnUrl("usuariolist.php");
?>
<?php include "header.php" ?>
<?php if ($usuario->Export == "") { ?>
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
<?php if ($usuario->Export == "") { ?>
<?php } ?>
<?php

// Load recordset
$bExportAll = (defined("EW_EXPORT_ALL") && $usuario->Export <> "");
$bSelectLimit = ($usuario->Export == "" && $usuario->SelectLimit);
if (!$bSelectLimit) $rs = LoadRecordset();
$nTotalRecs = ($bSelectLimit) ? $usuario->SelectRecordCount() : $rs->RecordCount();
$nStartRec = 1;
if ($nDisplayRecs <= 0) $nDisplayRecs = $nTotalRecs; // Display all records
if (!$bExportAll) SetUpStartRec(); // Set up start record position
if ($bSelectLimit) $rs = LoadRecordset($nStartRec-1, $nDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: usuario
<?php if ($usuario->Export == "") { ?>
&nbsp;&nbsp;<a href="usuariolist.php?export=excel">Export to Excel</a>
<?php } ?>
</span></p>
<?php if ($usuario->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<form name="fusuariolistsrch" id="fusuariolistsrch" action="usuariolist.php" >
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($usuario->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="usuariolist.php?cmd=reset">Show all</a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="" <?php if ($usuario->getBasicSearchType() == "") { ?>checked<?php } ?>>Exact phrase&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND" <?php if ($usuario->getBasicSearchType() == "AND") { ?>checked<?php } ?>>All words&nbsp;&nbsp;<input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR" <?php if ($usuario->getBasicSearchType() == "OR") { ?>checked<?php } ?>>Any word</span></td>
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
<form method="post" name="fusuariolist" id="fusuariolist">
<?php if ($usuario->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="usuarioadd.php">Add</a>&nbsp;&nbsp;
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
<?php if ($usuario->Export <> "") { ?>
login
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('login') ?>&ordertype=<?php echo $usuario->login->ReverseSort() ?>">login&nbsp;(*)<?php if ($usuario->login->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->login->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
clave
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('clave') ?>&ordertype=<?php echo $usuario->clave->ReverseSort() ?>">clave&nbsp;(*)<?php if ($usuario->clave->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->clave->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
nombre
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('nombre') ?>&ordertype=<?php echo $usuario->nombre->ReverseSort() ?>">nombre&nbsp;(*)<?php if ($usuario->nombre->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->nombre->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
apellidos
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('apellidos') ?>&ordertype=<?php echo $usuario->apellidos->ReverseSort() ?>">apellidos&nbsp;(*)<?php if ($usuario->apellidos->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->apellidos->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
email
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('email') ?>&ordertype=<?php echo $usuario->email->ReverseSort() ?>">email&nbsp;(*)<?php if ($usuario->email->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->email->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
sexo
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('sexo') ?>&ordertype=<?php echo $usuario->sexo->ReverseSort() ?>">sexo<?php if ($usuario->sexo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->sexo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
fingreso
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('fingreso') ?>&ordertype=<?php echo $usuario->fingreso->ReverseSort() ?>">fingreso<?php if ($usuario->fingreso->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->fingreso->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
		<td valign="top">
<?php if ($usuario->Export <> "") { ?>
perfil
<?php } else { ?>
	<a href="usuariolist.php?order=<?php echo urlencode('perfil') ?>&ordertype=<?php echo $usuario->perfil->ReverseSort() ?>">perfil<?php if ($usuario->perfil->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($usuario->perfil->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></a>
<?php } ?>
		</td>
<?php if ($usuario->Export == "") { ?>
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
if (defined("EW_EXPORT_ALL") && $usuario->Export <> "") {
	$nStopRec = $nTotalRecs;
} else {
	$nStopRec = $nStartRec + $nDisplayRecs - 1; // Set the last record to display
}
$nRecCount = $nStartRec - 1;
if (!$rs->EOF) {
	$rs->MoveFirst();
	if (!$usuario->SelectLimit) $rs->Move($nStartRec - 1); // Move to first record directly
}
$RowCnt = 0;
while (!$rs->EOF && $nRecCount < $nStopRec) {
	$nRecCount++;
	if (intval($nRecCount) >= intval($nStartRec)) {
		$RowCnt++;

	// Init row class and style
	$usuario->CssClass = "ewTableRow";
	$usuario->CssStyle = "";

	// Init row event
	$usuario->RowClientEvents = "onmouseover='ew_MouseOver(this);' onmouseout='ew_MouseOut(this);' onclick='ew_Click(this);'";

	// Display alternate color for rows
	if ($RowCnt % 2 == 0) {
		$usuario->CssClass = "ewTableAltRow";
	}
	LoadRowValues($rs); // Load row values
	$usuario->RowType = EW_ROWTYPE_VIEW; // Render view
	RenderRow();
?>
	<!-- Table body -->
	<tr<?php echo $usuario->DisplayAttributes() ?>>
		<!-- login -->
		<td<?php echo $usuario->login->CellAttributes() ?>>
<div<?php echo $usuario->login->ViewAttributes() ?>><?php echo $usuario->login->ViewValue ?></div>
</td>
		<!-- clave -->
		<td<?php echo $usuario->clave->CellAttributes() ?>>
<div<?php echo $usuario->clave->ViewAttributes() ?>><?php echo $usuario->clave->ViewValue ?></div>
</td>
		<!-- nombre -->
		<td<?php echo $usuario->nombre->CellAttributes() ?>>
<div<?php echo $usuario->nombre->ViewAttributes() ?>><?php echo $usuario->nombre->ViewValue ?></div>
</td>
		<!-- apellidos -->
		<td<?php echo $usuario->apellidos->CellAttributes() ?>>
<div<?php echo $usuario->apellidos->ViewAttributes() ?>><?php echo $usuario->apellidos->ViewValue ?></div>
</td>
		<!-- email -->
		<td<?php echo $usuario->email->CellAttributes() ?>>
<div<?php echo $usuario->email->ViewAttributes() ?>><?php echo $usuario->email->ViewValue ?></div>
</td>
		<!-- sexo -->
		<td<?php echo $usuario->sexo->CellAttributes() ?>>
<div<?php echo $usuario->sexo->ViewAttributes() ?>><?php echo $usuario->sexo->ViewValue ?></div>
</td>
		<!-- fingreso -->
		<td<?php echo $usuario->fingreso->CellAttributes() ?>>
<div<?php echo $usuario->fingreso->ViewAttributes() ?>><?php echo $usuario->fingreso->ViewValue ?></div>
</td>
		<!-- perfil -->
		<td<?php echo $usuario->perfil->CellAttributes() ?>>
<div<?php echo $usuario->perfil->ViewAttributes() ?>><?php echo $usuario->perfil->ViewValue ?></div>
</td>
<?php if ($usuario->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $usuario->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $usuario->EditUrl() ?>">Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $usuario->CopyUrl() ?>">Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td nowrap><span class="phpmaker">
<a href="<?php echo $usuario->DeleteUrl() ?>">Delete</a>
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
<?php if ($usuario->Export == "") { ?>
<table>
	<tr><td><span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="usuarioadd.php">Add</a>&nbsp;&nbsp;
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
<?php if ($usuario->Export == "") { ?>
<form action="usuariolist.php" name="ewpagerform" id="ewpagerform">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td nowrap>
<?php if (!isset($Pager)) $Pager = new cPrevNextPager($nStartRec, $nDisplayRecs, $nTotalRecs) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="usuariolist.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="usuariolist.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="usuariolist.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="usuariolist.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
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
<?php if ($usuario->Export == "") { ?>
<?php } ?>
<?php if ($usuario->Export == "") { ?>
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
	$sql .= "`login` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`clave` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`nombre` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`apellidos` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`email` LIKE '%" . $sKeyword . "%' OR ";
	$sql .= "`sexo` LIKE '%" . $sKeyword . "%' OR ";
	if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
	return $sql;
}

// Return Basic Search Where based on search keyword and type
function BasicSearchWhere() {
	global $Security, $usuario;
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
		$usuario->setBasicSearchKeyword($sSearchKeyword);
		$usuario->setBasicSearchType($sSearchType);
	}
	return $sSearchStr;
}

// Clear all search parameters
function ResetSearchParms() {

	// Clear search where
	global $usuario;
	$sSrchWhere = "";
	$usuario->setSearchWhere($sSrchWhere);

	// Clear basic search parameters
	ResetBasicSearchParms();
}

// Clear all basic search parameters
function ResetBasicSearchParms() {

	// Clear basic search parameters
	global $usuario;
	$usuario->setBasicSearchKeyword("");
	$usuario->setBasicSearchType("");
}

// Restore all search parameters
function RestoreSearchParms() {
	global $sSrchWhere, $usuario;
	$sSrchWhere = $usuario->getSearchWhere();
}

// Set up Sort parameters based on Sort Links clicked
function SetUpSortOrder() {
	global $usuario;

	// Check for an Order parameter
	if (@$_GET["order"] <> "") {
		$usuario->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
		$usuario->CurrentOrderType = @$_GET["ordertype"];

		// Field login
		$usuario->UpdateSort($usuario->login);

		// Field clave
		$usuario->UpdateSort($usuario->clave);

		// Field nombre
		$usuario->UpdateSort($usuario->nombre);

		// Field apellidos
		$usuario->UpdateSort($usuario->apellidos);

		// Field email
		$usuario->UpdateSort($usuario->email);

		// Field sexo
		$usuario->UpdateSort($usuario->sexo);

		// Field fingreso
		$usuario->UpdateSort($usuario->fingreso);

		// Field perfil
		$usuario->UpdateSort($usuario->perfil);
		$usuario->setStartRecordNumber(1); // Reset start position
	}
	$sOrderBy = $usuario->getSessionOrderBy(); // Get order by from Session
	if ($sOrderBy == "") {
		if ($usuario->SqlOrderBy() <> "") {
			$sOrderBy = $usuario->SqlOrderBy();
			$usuario->setSessionOrderBy($sOrderBy);
		}
	}
}

// Reset command based on querystring parameter cmd=
// - RESET: reset search parameters
// - RESETALL: reset search & master/detail parameters
// - RESETSORT: reset sort parameters
function ResetCmd() {
	global $sDbMasterFilter, $sDbDetailFilter, $nStartRec, $sOrderBy;
	global $usuario;

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
			$usuario->setSessionOrderBy($sOrderBy);
			$usuario->login->setSort("");
			$usuario->clave->setSort("");
			$usuario->nombre->setSort("");
			$usuario->apellidos->setSort("");
			$usuario->email->setSort("");
			$usuario->sexo->setSort("");
			$usuario->fingreso->setSort("");
			$usuario->perfil->setSort("");
		}

		// Reset start position
		$nStartRec = 1;
		$usuario->setStartRecordNumber($nStartRec);
	}
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
