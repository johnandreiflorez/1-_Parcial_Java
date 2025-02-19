<?php

// PHPMaker 5 configuration for Table usuario
$usuario = new cusuario; // Initialize table object

// Define table class
class cusuario {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $login;
	var $clave;
	var $nombre;
	var $apellidos;
	var $email;
	var $sexo;
	var $fingreso;
	var $perfil;
	var $fields = array();

	function cusuario() {
		$this->TableVar = "usuario";
		$this->TableName = "usuario";
		$this->SelectLimit = TRUE;
		$this->login = new cField('usuario', 'x_login', 'login', "`login`", 200, -1, FALSE);
		$this->fields['login'] =& $this->login;
		$this->clave = new cField('usuario', 'x_clave', 'clave', "`clave`", 200, -1, FALSE);
		$this->fields['clave'] =& $this->clave;
		$this->nombre = new cField('usuario', 'x_nombre', 'nombre', "`nombre`", 200, -1, FALSE);
		$this->fields['nombre'] =& $this->nombre;
		$this->apellidos = new cField('usuario', 'x_apellidos', 'apellidos', "`apellidos`", 200, -1, FALSE);
		$this->fields['apellidos'] =& $this->apellidos;
		$this->email = new cField('usuario', 'x_email', 'email', "`email`", 200, -1, FALSE);
		$this->fields['email'] =& $this->email;
		$this->sexo = new cField('usuario', 'x_sexo', 'sexo', "`sexo`", 202, -1, FALSE);
		$this->fields['sexo'] =& $this->sexo;
		$this->fingreso = new cField('usuario', 'x_fingreso', 'fingreso', "`fingreso`", 135, 5, FALSE);
		$this->fields['fingreso'] =& $this->fingreso;
		$this->perfil = new cField('usuario', 'x_perfil', 'perfil', "`perfil`", 3, -1, FALSE);
		$this->fields['perfil'] =& $this->perfil;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `usuario`";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Report table sql
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter .= " AND ";
			$sFilter .= $this->CurrentFilter;
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		$sFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF) $cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $sFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (EW_MD5_PASSWORD && $name == 'clave') {
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? md5($value) : md5(strtolower($value));
			}
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `usuario` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `usuario` SET ";
		foreach ($rs as $name => $value) {
			if (EW_MD5_PASSWORD && $name == 'clave') {
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? md5($value) : md5(strtolower($value));
			}
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `usuario` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'login' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['login'], $this->login->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`login` = '@login@'";
	}

	// Return url
	function getReturnUrl() {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "usuariolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("usuarioview.php");
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("usuarioedit.php");
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl("usuariolist.php", "a=edit");
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("usuarioadd.php");
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl("usuariolist.php", "a=copy");
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("usuariodelete.php");
	}

	// Key url
	function KeyUrl($url, $action = "") {
		$sUrl = $url . "?";
		if ($action <> "") $sUrl .= $action . "&";
		if (!is_null($this->login->CurrentValue)) {
			$sUrl .= "login=" . urlencode($this->login->CurrentValue);
		} else {
			return "javascript:alert('Invalid Record! Key is null');";
		}
		return $sUrl;
	}

	// Function LoadRs
	// - Load Row based on Key Value
	function LoadRs($sFilter) {
		global $conn;

		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from rs
	function LoadListRowValues(&$rs) {
		$this->login->setDbValue($rs->fields('login'));
		$this->clave->setDbValue($rs->fields('clave'));
		$this->nombre->setDbValue($rs->fields('nombre'));
		$this->apellidos->setDbValue($rs->fields('apellidos'));
		$this->email->setDbValue($rs->fields('email'));
		$this->sexo->setDbValue($rs->fields('sexo'));
		$this->fingreso->setDbValue($rs->fields('fingreso'));
		$this->perfil->setDbValue($rs->fields('perfil'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// login
		$this->login->ViewValue = $this->login->CurrentValue;
		$this->login->CssStyle = "";
		$this->login->CssClass = "";
		$this->login->ViewCustomAttributes = "";

		// clave
		$this->clave->ViewValue = $this->clave->CurrentValue;
		$this->clave->CssStyle = "";
		$this->clave->CssClass = "";
		$this->clave->ViewCustomAttributes = "";

		// nombre
		$this->nombre->ViewValue = $this->nombre->CurrentValue;
		$this->nombre->CssStyle = "";
		$this->nombre->CssClass = "";
		$this->nombre->ViewCustomAttributes = "";

		// apellidos
		$this->apellidos->ViewValue = $this->apellidos->CurrentValue;
		$this->apellidos->CssStyle = "";
		$this->apellidos->CssClass = "";
		$this->apellidos->ViewCustomAttributes = "";

		// email
		$this->email->ViewValue = $this->email->CurrentValue;
		$this->email->CssStyle = "";
		$this->email->CssClass = "";
		$this->email->ViewCustomAttributes = "";

		// sexo
		if (!is_null($this->sexo->CurrentValue)) {
			switch ($this->sexo->CurrentValue) {
				case "M":
					$this->sexo->ViewValue = "M";
					break;
				case "F":
					$this->sexo->ViewValue = "F";
					break;
				default:
					$this->sexo->ViewValue = $this->sexo->CurrentValue;
			}
		} else {
			$this->sexo->ViewValue = NULL;
		}
		$this->sexo->CssStyle = "";
		$this->sexo->CssClass = "";
		$this->sexo->ViewCustomAttributes = "";

		// fingreso
		$this->fingreso->ViewValue = $this->fingreso->CurrentValue;
		$this->fingreso->ViewValue = ew_FormatDateTime($this->fingreso->ViewValue, 5);
		$this->fingreso->CssStyle = "";
		$this->fingreso->CssClass = "";
		$this->fingreso->ViewCustomAttributes = "";

		// perfil
		$this->perfil->ViewValue = $this->perfil->CurrentValue;
		$this->perfil->CssStyle = "";
		$this->perfil->CssClass = "";
		$this->perfil->ViewCustomAttributes = "";

		// login
		$this->login->HrefValue = "";

		// clave
		$this->clave->HrefValue = "";

		// nombre
		$this->nombre->HrefValue = "";

		// apellidos
		$this->apellidos->HrefValue = "";

		// email
		$this->email->HrefValue = "";

		// sexo
		$this->sexo->HrefValue = "";

		// fingreso
		$this->fingreso->HrefValue = "";

		// perfil
		$this->perfil->HrefValue = "";
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events

	// Display Attribute
	function DisplayAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . $this->RowClientEvents;
			}
		}
		return $sAtt;
	}

	// Export
	var $Export;

//	 ----------------
//	  Field objects
//	 ----------------
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted";
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Deleting event
	function Row_Deleting($rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}
}
?>
