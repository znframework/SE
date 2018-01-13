<?php namespace ZN\Hypertext\Tests;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controllers\UnitTestController;

class Html extends UnitTestController
{
    const unit =
    [
        'class'   => 'HTML',
        'methods' => 
        [
            'property'          => ['Example Property Value'],
            'exampleProperty'   => ['Other Example Property Value'],
            'image'             => ['example.jpg', 100, 200],
            #'ul'                => [function($ul){echo $ul->li(1);}, ['id' => '#id']]
            'form'              => [],
            'table'             => [],
            'list'              => [],
            'anchor'            => ['http://www.znframework.com', 'ZN Framework', ['id' => '#id']]
        ]
    ];
}
