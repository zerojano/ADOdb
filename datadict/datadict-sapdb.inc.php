<?php

/**
  @version   v5.21.0-dev  ??-???-2016
  @copyright (c) 2000-2013 John Lim (jlim#natsoft.com). All rights reserved.
  @copyright (c) 2014      Damien Regad, Mark Newnham and the ADOdb community
  Released under both BSD license and Lesser GPL library license.
  Whenever there is any discrepancy between the two licenses,
  the BSD license will take precedence.

  Set tabs to 4 for best viewing.

  Modified from datadict-generic.inc.php for sapdb by RalfBecker-AT-outdoor-training.de
*/

// security - hide paths
if (!defined('ADODB_DIR')) die();

class ADODB2_sapdb extends ADODB_DataDict {

	var $databaseType = 'sapdb';
	var $seqField = false;
	var $renameColumn = 'RENAME COLUMN %s.%s TO %s';
	
	protected $actualTypes = array(
		ADODB_METATYPE_C=>'VARCHAR',
		ADODB_METATYPE_C2=>'VARCHAR UNICODE',
		ADODB_METATYPE_B=>'LONG',
		ADODB_METATYPE_D=>'DATE',
		ADODB_METATYPE_F=>'FLOAT(38)',
		ADODB_METATYPE_L=>'BOOLEAN',
		ADODB_METATYPE_I=>'INTEGER',
		ADODB_METATYPE_I1=>'FIXED(3)',
		ADODB_METATYPE_I2=>'SMALLINT',
		ADODB_METATYPE_I4=>'INTEGER',
		ADODB_METATYPE_I8=>'FIXED(20)',
		ADODB_METATYPE_N=>'FIXED',
		ADODB_METATYPE_R=>'FLOAT(16)',
		ADODB_METATYPE_T=>'TIMESTAMP',
		ADODB_METATYPE_XL=>'LONG',
		ADODB_METATYPE_X=>'LONG UNICODE',
		ADODB_METATYPE_X2=>'TEXT',
		'TS'=>'TIMESTAMP',
		);

 	
	function MetaType($t,$len=-1,$fieldobj=false)
	{
		if (is_object($t)) {
			$fieldobj = $t;
			$t = $fieldobj->type;
			$len = $fieldobj->max_length;
		}
		static $maxdb_type2adodb = array(
			'VARCHAR'	=> 'C',
			'CHARACTER'	=> 'C',
			'LONG'		=> 'X',		// no way to differ between 'X' and 'B' :-(
			'DATE'		=> 'D',
			'TIMESTAMP'	=> 'T',
			'BOOLEAN'	=> 'L',
			'INTEGER'	=> 'I4',
			'SMALLINT'	=> 'I2',
			'FLOAT'		=> 'F',
			'FIXED'		=> 'N',
		);
		$type = isset($maxdb_type2adodb[$t]) ? $maxdb_type2adodb[$t] : ADODB_DEFAULT_METATYPE;

		// convert integer-types simulated with fixed back to integer
		if ($t == 'FIXED' && !$fieldobj->scale && ($len == 20 || $len == 3)) {
			$type = $len == 20 ? 'I8' : 'I1';
		}
		if ($fieldobj->auto_increment) $type = 'R';

		return $type;
	}

	// return string must begin with space
	function _CreateSuffix($fname,&$ftype,$fnotnull,$fdefault,$fautoinc,$fconstraint,$funsigned)
	{
		$suffix = '';
		if ($funsigned) $suffix .= ' UNSIGNED';
		if ($fnotnull) $suffix .= ' NOT NULL';
		if ($fautoinc) $suffix .= ' DEFAULT SERIAL';
		elseif (strlen($fdefault)) $suffix .= " DEFAULT $fdefault";
		if ($fconstraint) $suffix .= ' '.$fconstraint;
		return $suffix;
	}

	function AddColumnSQL($tabname, $flds)
	{
		$tabname = $this->TableName ($tabname);
		$sql = array();
		list($lines,$pkey) = $this->_GenFields($flds);
		return array( 'ALTER TABLE ' . $tabname . ' ADD (' . implode(', ',$lines) . ')' );
	}

	function AlterColumnSQL($tabname, $flds, $tableflds='', $tableoptions='')
	{
		$tabname = $this->TableName ($tabname);
		$sql = array();
		list($lines,$pkey) = $this->_GenFields($flds);
		return array( 'ALTER TABLE ' . $tabname . ' MODIFY (' . implode(', ',$lines) . ')' );
	}

	function DropColumnSQL($tabname, $flds, $tableflds='',$tableoptions='')
	{
		$tabname = $this->TableName ($tabname);
		if (!is_array($flds)) $flds = explode(',',$flds);
		foreach($flds as $k => $v) {
			$flds[$k] = $this->NameQuote($v);
		}
		return array( 'ALTER TABLE ' . $tabname . ' DROP (' . implode(', ',$flds) . ')' );
	}
}
