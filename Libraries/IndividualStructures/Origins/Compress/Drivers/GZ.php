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

class GZDriver extends CompressDriverMappingAbstract
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
        Support::func('gzopen', 'GZ');
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
        Support::func('gzextract', 'GZ Driver Extract');
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
        $open = gzopen($file, 'w');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = gzwrite($open, $data, strlen($data));

        gzclose($open);

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
        $open = gzopen($file, 'r');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = gzread($open, 8096);

        gzclose($open);

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
        return gzcompress($data);
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
        return gzuncompress($data);
    }
}
