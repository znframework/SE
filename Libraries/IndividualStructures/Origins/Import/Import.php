<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Import extends \FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'usable'     => 'Import\Properties::usable:this',
            'recursive'  => 'Import\Properties::recursive:this',
            'data'       => 'Import\Properties::data:this',
            'headdata'   => 'Import\Masterpage::headData:this',
            'body'       => 'Import\Masterpage::body:this',
            'head'       => 'Import\Masterpage::head:this',
            'title'      => 'Import\Masterpage::title:this',
            'meta'       => 'Import\Masterpage::meta:this',
            'attributes' => 'Import\Masterpage::attributes:this',
            'content'    => 'Import\Masterpage::content:this',
            'bodycontent'=> 'Import\Masterpage::bodyContent:this',
            'masterpage' => 'Import\Masterpage::use',
            'page'       => 'Import\View::use',
            'view'       => 'Import\View::use',
            'handload'   => 'Import\Handload::use',
            'template'   => 'Import\Template::use',
            'font'       => 'Import\Font::use',
            'style'      => 'Import\Style::use',
            'script'     => 'Import\Script::use',
            'something'  => 'Import\Something::use',
            'package'    => 'Import\Package::use',
            'theme'      => 'Import\Package::theme',
            'plugin'     => 'Import\Package::plugin',
            'resource'   => 'Import\Package::resource'
        ]
    ];
}
