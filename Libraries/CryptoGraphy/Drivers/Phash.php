<?php namespace ZN\CryptoGraphy\Drivers;

use ZN\CryptoGraphy\CryptoMapping;
use ZN\ErrorHandling\Errors;
use ZN\IndividualStructures\IS;
use ZN\CryptoGraphy\Exception\InvalidVersionException;

class PhashDriver extends CryptoMapping
{
	//--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

	//--------------------------------------------------------------------------------------------------------
	// Construct
	//--------------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//--------------------------------------------------------------------------------------------------------
	public function __construct()
	{
		if( ! IS::phpVersion('5.5') )
		{
			throw new InvalidVersionException();
		}

        parent::__construct();
	}

	//--------------------------------------------------------------------------------------------------------
	// Keygen
	//--------------------------------------------------------------------------------------------------------
	//
	// @param numeric $length
	//
	//--------------------------------------------------------------------------------------------------------
	public function keygen($length)
	{
		return mb_substr(password_hash(PROJECT_CONFIG['key'], PASSWORD_BCRYPT), -$length);
	}
}
