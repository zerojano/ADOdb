<?php

/**
  @version   v5.21.0-dev  ??-???-2016
  @copyright (c) 2000-2013 John Lim (jlim#natsoft.com). All rights reserved.
  @copyright (c) 2014      Damien Regad, Mark Newnham and the ADOdb community
  Released under both BSD license and Lesser GPL library license.
  Whenever there is any discrepancy between the two licenses,
  the BSD license will take precedence.

  Set tabs to 4 for best viewing.

*/

// security - hide paths
if (!defined('ADODB_DIR')) die();

class ADODB2_access extends ADODB_DataDict {

	var $databaseType = 'access';
	
	var $seqField = false;

	protected $actualTypes = array(
		ADODB_METATYPE_C=>'TEXT',
		ADODB_METATYPE_C2=>'TEXT',
		ADODB_METATYPE_B=>'BINARY',
		ADODB_METATYPE_D=>'DATETIME',
		ADODB_METATYPE_F=>'DOUBLE',
		ADODB_METATYPE_L=>'BYTE',
		ADODB_METATYPE_I=>'INTEGER',
		ADODB_METATYPE_I1=>'BYTE',
		ADODB_METATYPE_I2=>'SMALLINT',
		ADODB_METATYPE_I4=>'INTEGER',
		ADODB_METATYPE_I8=>'INTEGER',
		ADODB_METATYPE_N=>'NUMERIC',
		ADODB_METATYPE_R=>'INTEGER',
		ADODB_METATYPE_T=>'DATETIME',
		ADODB_METATYPE_XL=>'MEMO',
		ADODB_METATYPE_X=>'MEMO',
		ADODB_METATYPE_X2=>'MEMO',
		'TS'=>'DATETIME'
		);

	// return string must begin with space
	function _CreateSuffix($fname, &$ftype, $fnotnull,$fdefault,$fautoinc,$fconstraint,$funsigned)
	{
		if ($fautoinc) {
			$ftype = 'COUNTER';
			return '';
		}
		if (substr($ftype,0,7) == 'DECIMAL') $ftype = 'DECIMAL';
		$suffix = '';
		if (strlen($fdefault)) {
			//$suffix .= " DEFAULT $fdefault";
			if ($this->debug) ADOConnection::outp("Warning: Access does not supported DEFAULT values (field $fname)");
		}
		if ($fnotnull) $suffix .= ' NOT NULL';
		if ($fconstraint) $suffix .= ' '.$fconstraint;
		return $suffix;
	}

	function CreateDatabase($dbname,$options=false)
	{
		return array();
	}


	function SetSchema($schema)
	{
	}

	function AlterColumnSQL($tabname, $flds, $tableflds='',$tableoptions='')
	{
		if ($this->debug) ADOConnection::outp("AlterColumnSQL not supported");
		return array();
	}


	function DropColumnSQL($tabname, $flds, $tableflds='',$tableoptions='')
	{
		if ($this->debug) ADOConnection::outp("DropColumnSQL not supported");
		return array();
	}

}
