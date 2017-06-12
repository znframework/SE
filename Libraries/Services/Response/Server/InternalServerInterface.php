<?php namespace ZN\Services\Response;

interface InternalServerInterface
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
    // Data -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(String $data = NULL);

    //--------------------------------------------------------------------------------------------------------
    // Name -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function name() : String;

    //--------------------------------------------------------------------------------------------------------
    // Addr -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function addr() : String;

    //--------------------------------------------------------------------------------------------------------
    // Port -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function port() : Int;

    //--------------------------------------------------------------------------------------------------------
    // Admin -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function admin() : String;

    //--------------------------------------------------------------------------------------------------------
    // Protocol -> 4.3.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function protocol() : String;
}
