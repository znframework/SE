<?php namespace ZN\Classes;

class Config
{
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Config Priority
    //--------------------------------------------------------------------------------------------------
    //
    // Primary  : Internal Config
    // Secondary: Projects Config
    // Tertiary : External Config
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // $setConfigs
    //--------------------------------------------------------------------------------------------------
    //
    // Set edilen ayarları tutacak dizi değişken
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    private static $setConfigs = [];

    //--------------------------------------------------------------------------------------------------
    // $config
    //--------------------------------------------------------------------------------------------------
    //
    // Ayarları tutacak dizi değişken
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    private static $config = [];

    //--------------------------------------------------------------------------------------------------
    // __callStatic()
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters;
    //
    //--------------------------------------------------------------------------------------------------
    public static function __callStatic($method, $parameters)
    {
        $method = ucfirst($method);

        if( is_array($parameters[0] ?? NULL) || count($parameters) >= 2 )
        {
            return self::set($method, ...$parameters);
        }

        return self::get($method, ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------
    // _config()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    private static function _config($file)
    {
        if( empty(self::$config[$file]) )
        {
            $path = suffix($file, '.php');

            self::$config[$file] = array_merge
            (
                (array) import(SETTINGS_DIR . $path),
                (array) import(CONFIG_DIR   . $path)   
            );
        }
    }

    //--------------------------------------------------------------------------------------------------
    // get()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @param  string $configs
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function get(String $file, String $configs = NULL, $settings = NULL )
    {
        self::_config($file);

        if( ! empty($settings) )
        {
            self::set($file, $configs, $settings);
        }

        if( isset(self::$setConfigs[$file]) )
        {
            if( ! empty(self::$setConfigs[$file]) ) foreach( self::$setConfigs[$file] as $k => $v )
            {
                if( isset(self::$config[$file][$k]) && is_array(self::$config[$file][$k]) )
                {
                    self::$config[$file][$k] = array_merge(self::$config[$file][$k], (array) self::$setConfigs[$file][$k]);
                }
                else
                {
                    self::$config[$file][$k] = self::$setConfigs[$file][$k];
                }
            }
        }

        if( empty($configs) )
        {
            return self::$config[$file] ?? false;
        }

        return self::$config[$file][$configs] ?? false;
    }

    //--------------------------------------------------------------------------------------------------
    // set()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @param  string $configs
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function set(String $file, $configs, $set = NULL)
    {
        if( empty($configs) )
        {
            return false;
        }

        if( ! is_array($configs) )
        {
            self::$setConfigs[$file][$configs] = $set;
        }
        else
        {
            foreach( $configs as $k => $v )
            {
                self::$setConfigs[$file][$k] = $v;
            }
        }
        
        return self::$setConfigs;
    }

    //--------------------------------------------------------------------------------------------------
    // iniSet()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $key
    // @param  string $val
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniSet($key, $val = NULL)
    {
        if( empty($key) )
        {
            return false;
        }

        if( ! is_array($key) )
        {
            if( is_array($val) )
            {
                return false;
            }

            if( $val !== '' )
            {
                ini_set($key, $val);
            }
        }
        else
        {
            foreach( $key as $k => $v )
            {
                if( $v !== '' )
                {
                    ini_set($k, $v);
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------
    // iniGet()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $key
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniGet($key)
    {
        if( ! is_array($key) )
        {
            return ini_get($key);
        }
        else
        {
            $keys = [];

            foreach( $key as $k )
            {
                $keys[$k] = ini_get($k);
            }

            return $keys;
        }
    }

    //--------------------------------------------------------------------------------------------------
    // iniGetAll()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $key
    // @param  bool   $details
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniGetAll(String $extension = NULL, Bool $details = true)
    {
        if( empty($extension) )
        {
            return ini_get_all();
        }
        else
        {
            return ini_get_all($extension, $details);
        }
    }

    //--------------------------------------------------------------------------------------------------
    // iniRestore()
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $str
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function iniRestore(String $str)
    {
        return ini_restore($str);
    }
}

class_alias('ZN\Classes\Config', 'Config');
