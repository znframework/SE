<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Config;
use ZN\Singleton;
use ZN\Filesystem;
use ZN\Request\Request;

class Logger implements LoggerInterface
{
    //--------------------------------------------------------------------------------------------------
    // notice()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function notice(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // emergency()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function emergency(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // alert()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function alert(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // error()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function error(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // warning()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function warning(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // critical()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function critical(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // info()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function info(String $message, String $time = NULL)
	{
		return 	self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // debug()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $message
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function debug(String $message, String $time = NULL)
	{
		return self::report(__FUNCTION__, $message, NULL, $time);
	}

    //--------------------------------------------------------------------------------------------------
    // report()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $subject
    // @param string $message
    // @param string $destination
    // @param string $time
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function report(String $subject, String $message, String $destination = NULL, String $time = NULL) : Bool
    {
        if( ! Config::get('Project', 'log')['createFile'] )
        {
            return false;
        }

        if( empty($destination) )
        {
            $destination = str_replace(' ', '-', $subject);
        }

        $logDir    = STORAGE_DIR.'Logs/';
        $extension = '.log';

        if( ! is_dir($logDir) )
        {
            mkdir($logDir, 0755);
        }

        if( is_file($logDir.Base::suffix($destination, $extension)) )
        {
            if( empty($time) )
            {
                $time = Config::get('Project', 'log')['fileTime'];
            }

            $createDate = Filesystem\Info::createDate($logDir.Base::suffix($destination, $extension), 'd.m.Y');
            $endDate    = strtotime("$time", strtotime($createDate));
            $endDate    = date('Y.m.d', $endDate);

            if( date('Y.m.d')  >  $endDate )
            {
                unlink($logDir.Base::suffix($destination, $extension));
            }
        }

        $message = 'IP: ' . Request::ipv4().
                   ' | Subject: ' . $subject.
                   ' | Date: '.Singleton::class('ZN\DateTime\Date')->set('{dayNumber0}.{monthNumber0}.{year} {H024}:{minute}:{second}').
                   ' | Message: ' . $message . EOL;

        return error_log($message, 3, $logDir.Base::suffix($destination, $extension));
    }
}
