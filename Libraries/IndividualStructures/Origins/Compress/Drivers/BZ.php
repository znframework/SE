<?php namespace ZN\IndividualStructures\Compress\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Support;
use ZN\IndividualStructures\Exception\FileNotFoundException;
use ZN\IndividualStructures\Abstracts\CompressDriverMappingAbstract;

class BZDriver extends CompressDriverMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Support::func('bzopen', 'BZ');
    }

    //--------------------------------------------------------------------------------------------------------
    // Extract
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function extract($source, $target, $password)
    {
        Support::func('bzextract', 'BZ Driver Extract');
    }

    //--------------------------------------------------------------------------------------------------------
    // Write
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function write($file, $data)
    {
        $open = bzopen($file, 'w');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = bzwrite($open, $data, strlen($data));

        bzclose($open);

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function read($file)
    {
        $open = bzopen($file, 'r');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = bzread($open, 8096);

        bzclose($open);

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do($data)
    {
        return bzcompress($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Undo
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function undo($data)
    {
        return bzdecompress($data);
    }
}
