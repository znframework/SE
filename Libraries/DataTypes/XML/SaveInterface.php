<?php namespace ZN\DataTypes\XML;

interface SaveInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Save
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $file, String $data) : Bool;
}
