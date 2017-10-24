<?php namespace ZN\ViewObjects;

use Import, stdClass;

class InternalWizard
{
    //--------------------------------------------------------------------------------------------------------
    // Wizard -> 5.4.1
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Protected Check
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $check = ['template', 'view', 'page', 'something'];

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {   
        $submethod = $parameters[0];

        $submethod($data = new stdClass);

        preg_match('/\[(\$\w+)\]/', print_r(debug_backtrace()[0]['args'][1][0], true), $match);
  
        $function = ltrim($match[1], '$');

        if( ! in_array($function, $this->check) )
        {
            $function = 'template';
        }

        return Import::$function($method, (array) $data, $parameters[1] ?? false);
    }
}
