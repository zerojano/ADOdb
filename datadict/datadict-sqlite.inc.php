<?php

/**
  @version   v5.21.0-dev  ??-???-2016
  @copyright (c) 2000-2013 John Lim (jlim#natsoft.com). All rights reserved.
  @copyright (c) 2014      Damien Regad, Mark Newnham and the ADOdb community
  Released under both BSD license and Lesser GPL library license.
  Whenever there is any discrepancy between the two licenses,
  the BSD license will take precedence.

  Set tabs to 4 for best viewing.

	SQLite datadict Andrei Besleaga

*/

// security - hide paths
if (!defined('ADODB_DIR')) die();

class ADODB2_sqlite extends ADODB_DataDict {
	var $databaseType = 'sqlite';
	var $seqField = false;
	var $addCol=' ADD COLUMN';
	var $dropTable = 'DROP TABLE IF EXISTS %s';
	var $dropIndex = 'DROP INDEX IF EXISTS %s';
	var $renameTable = 'ALTER TABLE %s RENAME TO %s';

	/*
	* This is actually a copy of the definitions for mysql. sqlite
	* actually has a very limited datatype set
	*/
	protected $actualTypes = array(
		ADODB_METATYPE_CHAR=>'VARCHAR',
		ADODB_METATYPE_MCHAR=>'VARCHAR',
		ADODB_METATYPE_BIN=>'LONGBLOB',
		ADODB_METATYPE_DATE=>'DATE',
		ADODB_METATYPE_FLOAT=>'DOUBLE',
		ADODB_METATYPE_LOG=>'TINYINT',
		ADODB_METATYPE_INT=>'INTEGER',
		ADODB_METATYPE_INT1=>'TINYINT',
		ADODB_METATYPE_INT2=>'SMALLINT',
		ADODB_METATYPE_INT4=>'INTEGER',
		ADODB_METATYPE_INT8=>'BIGINT',
		ADODB_METATYPE_NUM=>'NUMERIC',
		ADODB_METATYPE_REAL=>'INTEGER',
		ADODB_METATYPE_TIME=>'DATETIME',
		ADODB_METATYPE_CLOB=>'LONGTEXT',
		ADODB_METATYPE_TEXT=>'TEXT',
		ADODB_METATYPE_MTEXT=>'LONGTEXT',
		'TS'=>'DATETIME'
		);

	
	// return string must begin with space
	function _CreateSuffix($fname,&$ftype,$fnotnull,$fdefault,$fautoinc,$fconstraint,$funsigned)
	{
		$suffix = '';
		if ($funsigned) $suffix .= ' UNSIGNED';
		if ($fnotnull) $suffix .= ' NOT NULL';
		if (strlen($fdefault)) $suffix .= " DEFAULT $fdefault";
		if ($fautoinc) $suffix .= ' AUTOINCREMENT';
		if ($fconstraint) $suffix .= ' '.$fconstraint;
		return $suffix;
	}

	function AlterColumnSQL($tabname, $flds, $tableflds='', $tableoptions='')
	{
		if ($this->debug) ADOConnection::outp("AlterColumnSQL not supported natively by SQLite");
		return array();
	}

	function DropColumnSQL($tabname, $flds, $tableflds='', $tableoptions='')
	{
		if ($this->debug) ADOConnection::outp("DropColumnSQL not supported natively by SQLite");
		return array();
	}

	function RenameColumnSQL($tabname,$oldcolumn,$newcolumn,$flds='')
	{
		if ($this->debug) ADOConnection::outp("RenameColumnSQL not supported natively by SQLite");
		return array();
	}

}
