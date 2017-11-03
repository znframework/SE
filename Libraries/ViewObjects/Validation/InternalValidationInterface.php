<?php namespace ZN\ViewObjects\View;

interface InternalValidationInterface
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
    // Check -> 5.4.2
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $submit = NULL;
    //
    //--------------------------------------------------------------------------------------------------------
    public function check(String $submit = NULL) : Bool;

    //--------------------------------------------------------------------------------------------------------
    // between()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $min
    // @param numeric $max
    //
    //--------------------------------------------------------------------------------------------------------
    public function between(Float $min = NULL, Float $max = NULL) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // betweenBoth()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $min
    // @param numeric $max
    //
    //--------------------------------------------------------------------------------------------------------
    public function betweenBoth(Float $min = NULL, Float $max = NULL) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // method()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    //
    //--------------------------------------------------------------------------------------------------------
    public function method(String $method) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // value()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function value(String $value) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // required()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function required() : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // numeric()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function numeric() : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // match()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $match
    //
    //--------------------------------------------------------------------------------------------------------
    public function match(String $match) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // matchPassword()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $match
    //
    //--------------------------------------------------------------------------------------------------------
    public function matchPassword(String $match) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // oldPassword()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $oldPassword
    //
    //--------------------------------------------------------------------------------------------------------
    public function oldPassword(String $oldPassword) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // compare()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $min
    // @param numeric $max
    //
    //--------------------------------------------------------------------------------------------------------
    public function compare(Int $min = NULL, Int $max = NULL) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // validate()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param args
    //
    //--------------------------------------------------------------------------------------------------------
    public function validate(...$args) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // secure()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param args
    //
    //--------------------------------------------------------------------------------------------------------
    public function secure(...$args) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // pattern()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pattern
    // @param string $char
    //
    //--------------------------------------------------------------------------------------------------------
    public function pattern(String $pattern, String $char = NULL) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // phone()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $design
    //
    //--------------------------------------------------------------------------------------------------------
    public function phone(String $design = NULL) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // alpha()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function alpha() : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // alnum()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function alnum() : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // captcha()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $captcha
    //
    //--------------------------------------------------------------------------------------------------------
    public function captcha(String $captcha) : InternalValidation;

    //--------------------------------------------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param array  $config
    // @param string $viewName
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    public function rules(String $name, Array $config = [], $viewName = '', String $met = 'post');

    //--------------------------------------------------------------------------------------------------------
    // Nval
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function nval(String $name);

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function error(String $name = 'array');

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    public function postBack(String $name, String $met = 'post');
}
