<?php namespace ZN\FileSystem\File;

interface LoaderInterface
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
    // Require
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function require(String $file, String $type = 'require');

    //--------------------------------------------------------------------------------------------------------
    // Require Once
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function requireOnce(String $file);

    //--------------------------------------------------------------------------------------------------------
    // Include
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function include(String $file);

    //--------------------------------------------------------------------------------------------------------
    // Include Once
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function includeOnce(String $file);
}
