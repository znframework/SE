<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Hooks
    |--------------------------------------------------------------------------
    |
    | You can use the Hook class to add functions to this file.
    | Expressions used as key are used as method name in the Hook class.
    |
    | Example: Hook::project('example'); // example
    |
    */
   
    'project' => function(String $name)
    {
        return $name;
    }
];