<?php namespace ZN\ViewObjects\Javascript\Helpers;

interface AnimateInterface
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
    // Speed
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $duration
    //
    //--------------------------------------------------------------------------------------------------------
    public function speed(String $duration) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Duration
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $duration
    //
    //--------------------------------------------------------------------------------------------------------
    public function duration(String $duration) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Queue
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $queue
    //
    //--------------------------------------------------------------------------------------------------------
    public function queue(String $queue) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Attr
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $attr
    //
    //--------------------------------------------------------------------------------------------------------
    public function attr(Array $attr) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Easing
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $easing
    //
    //--------------------------------------------------------------------------------------------------------
    public function easing(String $easing) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Special Easing
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $specialEasing
    //
    //--------------------------------------------------------------------------------------------------------
    public function specialEasing(Array $specialEasing) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Step
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $step
    //
    //--------------------------------------------------------------------------------------------------------
    public function step(String $step) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Comp
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $comp
    //
    //--------------------------------------------------------------------------------------------------------
    public function complete(String $comp) : Animate;

    //--------------------------------------------------------------------------------------------------------
    // Completed
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function completed() : String;

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $args
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(...$args) : String;
}
