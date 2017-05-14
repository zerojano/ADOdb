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

class ADODB2_generic extends ADODB_DataDict {

	var $databaseType = 'generic';
	var $seqField = false;

	protected $actualTypes = array(
		ADODB_METATYPE_C=>'VARCHAR',
		ADODB_METATYPE_C2=>'VARCHAR',
		ADODB_METATYPE_B=>'VARCHAR',
		ADODB_METATYPE_D=>'DATE',
		ADODB_METATYPE_F=>'DECIMAL(32,8)',
		ADODB_METATYPE_L=>'DECIMAL(1)',
		ADODB_METATYPE_I=>'DECIMAL(10)',
		ADODB_METATYPE_I1=>'DECIMAL(3)',
		ADODB_METATYPE_I2=>'DECIMAL(5)',
		ADODB_METATYPE_I4=>'DECIMAL(10)',
		ADODB_METATYPE_I8=>'DECIMAL(20)',
		ADODB_METATYPE_N=>'DECIMAL',
		ADODB_METATYPE_R=>'DECIMAL(32,8)',
		ADODB_METATYPE_T=>'DATE',
		ADODB_METATYPE_XL=>'VARCHAR(250)',
		ADODB_METATYPE_X=>'VARCHAR(250)',
		ADODB_METATYPE_X2=>'VARCHAR(250)',
		'TS'=>'DATE',
		);

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