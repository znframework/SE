<?php namespace ZN\Classes;

use ZN\Helpers\Converter;

class Autoloader
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
    // Protected Static Classes
    //--------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    protected static $classes;

    //--------------------------------------------------------------------------------------------------
    // Protected Static Namespaces
    //--------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------
    protected static $namespaces;

    //--------------------------------------------------------------------------------------------------
    // Protected Static Path
    //--------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------
    protected static $path = CONFIG_DIR . 'ClassMap.php';

    //--------------------------------------------------------------------------------------------------
    // Lower
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public static function lower(String $string = NULL) : String
    {
        return str_replace('I', 'i', strtolower($string));
    }

    //--------------------------------------------------------------------------------------------------
    // Lower
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public static function upper(String $string = NULL) : String
    {
        return str_replace('i', 'I', strtoupper($string));
    }

    //--------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------
    //
    // @param  autoloader $class
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function run(String $class)
    {
        if( ! is_file(self::$path) )
        {
            self::createClassMap();
        }

        $classInfo = self::getClassFileInfo($class);
        $file      = $classInfo['path'];
        
        if( is_file($file) )
        {
            import($file);

            if
            (
                ! class_exists($classInfo['namespace']) &&
                ! trait_exists($classInfo['namespace']) &&
                ! interface_exists($classInfo['namespace'])
            )
            {
                self::tryAgainCreateClassMap($class);
            }
        }
        else
        {
            // 5.4.2[added]
            if( PROJECT_TYPE === 'EIP' && strpos($file, 'Projects/' . CURRENT_PROJECT) !== 0 )
            {
                self::restart();
            }

            self::tryAgainCreateClassMap($class);
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Restart
    //--------------------------------------------------------------------------------------------------
    //
    // ClassMap'i yeniden oluşturmak için kullanılır.
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------
    public static function restart()
    {
        if( is_file(self::$path) )
        {
            unlink(self::$path);
        }

        return self::createClassMap();
    }

    //--------------------------------------------------------------------------------------------------
    // Create Class Map
    //--------------------------------------------------------------------------------------------------
    //
    // Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.
    // yol bilgisi oluşturulur. Böylece bir sınıf dahil edilmeden kullanılabilir.
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    public static function createClassMap()
    {
        clearstatcache();

        $configAutoloader = Config::get('Autoloader');
        $configClassMap   = self::_config();

        if( $configAutoloader['directoryScanning'] === false )
        {
            return false;
        }

        $classMap = $configAutoloader['classMap'];
       
        if( ! empty($classMap) ) foreach( $classMap as $directory )
        {
            $classMaps = self::searchClassMap($directory, $directory);
        }

        $classArray = array_diff_key
        (
            $classMaps['classes']      ?? [],
            $configClassMap['classes'] ?? []
        );

        $eol  = EOL;

        if( ! is_file(self::$path) )
        {
            $classMapPage  = '<?php'.$eol;
            $classMapPage .= '//--------------------------------------------------------------------------------------------------'.$eol;
            $classMapPage .= '// This file automatically created and updated'.$eol;
            $classMapPage .= '//--------------------------------------------------------------------------------------------------'.$eol;
        }
        else
        {
            $classMapPage = '';
        }

        if( ! empty($classArray) )
        {
            self::$classes = $classMaps['classes'];

            foreach( $classArray as $k => $v )
            {
                $classMapPage .= '$classMap[\'classes\'][\''.$k.'\'] = \''.$v.'\';'.$eol;
            }
        }

        $namespaceArray = array_diff_key
        (
            $classMaps['namespaces']      ?? [],
            $configClassMap['namespaces'] ?? []
        );

        if( ! empty($namespaceArray) )
        {
            self::$namespaces = $classMaps['namespaces'];

            foreach( $namespaceArray as $k => $v )
            {
                $classMapPage .= '$classMap[\'namespaces\'][\''.$k.'\'] = \''.$v.'\';'.$eol;
            }
        }

        internalIsWritable(self::$path);

        file_put_contents(self::$path, $classMapPage, FILE_APPEND);
    }

    //--------------------------------------------------------------------------------------------------
    // Get Class File Info
    //--------------------------------------------------------------------------------------------------
    //
    // Çağrılan sınıfın sınıf, yol ve namespace bilgilerini almak için oluşturulmuştur.
    //
    // @param  string $class
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function getClassFileInfo(String $class) : Array
    {
        $classCaseLower = self::lower($class);
        $classMap       = self::_config();
        $classes        = array_merge($classMap['classes']    ?? [], (array) self::$classes);
        $namespaces     = array_merge($classMap['namespaces'] ?? [], (array) self::$namespaces);
        $path           = '';
        $namespace      = '';

        if( isset($classes[$classCaseLower]) )
        {
            $path      = $classes[$classCaseLower];
            $namespace = $class;
        }
        elseif( ! empty($namespaces) )
        {
            $namespaces = array_flip($namespaces);

            if( isset($namespaces[$classCaseLower]) )
            {
                $namespace = $namespaces[$classCaseLower];
                $path      = $classes[$namespace] ?? '';
            }
        }

        return
        [
            'path'      => $path,
            'class'     => $class,
            'namespace' => $namespace
        ];
    }

    //--------------------------------------------------------------------------------------------------
    // Token Class File Info
    //--------------------------------------------------------------------------------------------------
    //
    // Yolu belirtilen sınıfın sınıf ve namespace bilgilerini almak için oluşturulmuştur.
    //
    // @param  string $fileName
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function tokenClassFileInfo(String $fileName) : Array
    {
        $classInfo = [];

        if( ! is_file($fileName) )
        {
            return $classInfo;
        }

        $tokens = token_get_all(file_get_contents($fileName));
        $i      = 0;
        $ns     = '';

        foreach( $tokens as $token )
        {
            if( $token[0] === T_NAMESPACE )
            {
                if( isset($tokens[$i + 2][1]) )
                {
                    if( ! isset($tokens[$i + 3][1]) )
                    {
                        $ns = $tokens[$i + 2][1];
                    }
                    else
                    {
                        $ii = $i;

                        while( isset($tokens[$ii + 2][1]) )
                        {
                            $ns .= $tokens[$ii + 2][1];

                            $ii++;
                        }
                    }
                }

                $classInfo['namespace'] = trim($ns);
            }

            if
            (
                $token[0] === T_CLASS     ||
                $token[0] === T_INTERFACE ||
                $token[0] === T_TRAIT
            )
            {
                $classInfo['class'] = $tokens[$i + 2][1] ?? NULL;

                break;
            }

            $i++;
        }

        return $classInfo;
    }

    //--------------------------------------------------------------------------------------------------
    // Token File Info
    //--------------------------------------------------------------------------------------------------
    //
    // Yolu belirtilen fonksiyon bilgilerini almak için oluşturulmuştur.
    //
    // @param  string $fileName
    // @return array
    //
    //--------------------------------------------------------------------------------------------------
    public static function tokenFileInfo(String $fileName, Int $type = T_FUNCTION)
    {
        if( ! is_file($fileName) )
        {
            return false;
        }

        $tokens = token_get_all(file_get_contents($fileName));
        $info   = [];

        $i = 0;

        $type = Converter::toConstant($type, 'T_');

        foreach( $tokens as $token )
        {
            if( $token[0] === $type )
            {
                $info[] = $tokens[$i + 2][1] ?? NULL;
            }

            $i++;
        }

        return $info;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Search Class Map
    //--------------------------------------------------------------------------------------------------
    //
    // Yolu belirtilen Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.
    // yol bilgisi oluşturulur. createClassMap() yöntemi için oluşturulmuştur.
    //
    // @param  string $directory
    // @param  string $baseDirectory
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function searchClassMap($directory, $baseDirectory = NULL)
    {
        static $classes;

        $directory           = suffix($directory);
        $baseDirectory       = suffix($baseDirectory);
        $configClassMap      = self::_config();
        $configAutoloader    = Config::get('Autoloader');
        $directoryPermission = $configAutoloader['directoryPermission'];

        $files = glob($directory.'*');
        $files = array_diff
        (
            $files,
            $configClassMap['classes'] ?? []
        );

        $staticAccessDirectory = RESOURCES_DIR . 'Statics/';

        $eol = EOL;

        if( ! empty($files) ) foreach( $files as $val )
        {
            $v = $val;

            if( is_file($val) )
            {
                $classInfo = self::tokenClassFileInfo($val);

                if( isset($classInfo['class']) )
                {
                    $class = self::lower($classInfo['class']);

                    if( isset($classInfo['namespace']) )
                    {
                        $className = self::lower($classInfo['namespace']).'\\'.$class;

                        $classes['namespaces'][self::_cleanNail($className)] = self::_cleanNail($class);
                    }
                    else
                    {
                        $className = $class;
                    }

                    $classes['classes'][self::_cleanNail($className)] = self::_cleanNail($v);

                    $useStaticAccess = self::lower(INTERNAL_ACCESS);

                    if( strpos($class, $useStaticAccess) === 0  && ! preg_match('/(Interface|Trait)$/i', $class) )
                    {
                        $newClassName = str_ireplace(INTERNAL_ACCESS, '', $classInfo['class']);

                        $pathEx = explode('/', $v);

                        array_pop($pathEx);

                        $newDir = implode('/', $pathEx);
                        $dir    = $staticAccessDirectory;
                        $newDir = $dir.$newDir;
                     
                        if( ! is_dir($dir) )
                        {
                            mkdir($dir, $directoryPermission, true);
                            file_put_contents($dir . '.htaccess', 'Deny from all');
                        }

                        if( ! is_dir($newDir) )
                        {
                            mkdir($newDir, $directoryPermission, true);
                        }

                        $rpath = $path     = suffix($newDir).$classInfo['class'].'.php';
                    
                        $constants         = self::_findConstants($val);
                        $classContent      = self::_classFileContent($newClassName, $constants);
                        $fileContentLength = is_file($rpath) ? strlen(file_get_contents($rpath)) : 0;

                        if( strlen($classContent) !== $fileContentLength )
                        {
                            file_put_contents($rpath, $classContent);
                        }

                        $classes['classes'][self::lower($newClassName)] = $path;
                    }
                }
            }
            elseif( is_dir($val) )
            {
                self::searchClassMap($val, $baseDirectory);
            }
        }

        return $classes;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Find Constants
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _findConstants($v)
    {
        $getFileContent = file_get_contents($v);

        preg_match_all('/const\s+(\w+)\s+\=\s+(.*?);/i', $getFileContent, $match);

        $const = $match[1] ?? [];
        $value = $match[2] ?? [];

        $constants = '';

        if( ! empty($const) )
        {
            foreach( $const as $key => $c )
            {
                $constants .= HT."const ".$c.' = '.$value[$key].';'.EOL.EOL;
            }
        }

        return $constants;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Class File Content
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _classFileContent($newClassName, $constants)
    {
        $classContent  = '<?php'.EOL;
        $classContent .= '//--------------------------------------------------------------------------------------------------'.EOL;
        $classContent .= '// This file automatically created and updated'.EOL;
        $classContent .= '//--------------------------------------------------------------------------------------------------'.EOL.EOL;
        $classContent .= 'class '.$newClassName.' extends StaticAccess'.EOL;
        $classContent .= '{'.EOL;
        $classContent .= $constants;
        $classContent .= HT.'public static function getClassName()'.EOL;
        $classContent .= HT.'{'.EOL;
        $classContent .= HT.HT.'return __CLASS__;'.EOL;
        $classContent .= HT.'}'.EOL;
        $classContent .= '}'.EOL.EOL;
        $classContent .= '//--------------------------------------------------------------------------------------------------';

        return $classContent;
    }

    //--------------------------------------------------------------------------------------------------
    // Private Config -> 5.4.61[edited]
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    private static function _config()
    {
        if( is_file(self::$path) )
        {
            global $classMap;
            
            // 5.4.61[added]
            try
            {
                require_once self::$path;
            }
            catch( \Throwable $e )
            {
                self::restart();
            }

            return $classMap;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Try Again Create Class Map
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $class
    // @return void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function tryAgainCreateClassMap($class)
    {
        self::createClassMap();

        $classInfo = self::getClassFileInfo($class);

        $file = $classInfo['path'];

        if( is_file($file) )
        {
            import($file);
        }
        else
        {
            $backtrace = debug_backtrace(2);
            $debug     = $backtrace[2];
            $message   = 'Error: ['.$class.'] class was not found! Make sure the [class name] is spelled correctly or
                         try to rebuild with [Autoloader::restart()]<br>';
            $message  .= 'File: '.($debug['file'] ?? $backtrace[5]['file'] ?? NULL).'<br>';
            $message  .= 'Line: '.($debug['line'] ?? $backtrace[5]['line'] ?? NULL);

            trace($message);
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Clean Nail
    //--------------------------------------------------------------------------------------------------
    //
    // @param  string $string
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _cleanNail($string)
    {
        return str_replace(["'", '"'], NULL, $string);
    }
}

//------------------------------------------------------------------------------------------------------
// Class Alias
//------------------------------------------------------------------------------------------------------
//
// ZN\Autoloader\Autoloader -> Autoloader
//
//------------------------------------------------------------------------------------------------------
class_alias('ZN\Classes\Autoloader', 'Autoloader');

//------------------------------------------------------------------------------------------------------
// Import Config Class
//------------------------------------------------------------------------------------------------------
//
// Config library required for the Autoloader library.
//
//------------------------------------------------------------------------------------------------------
import(REQUIREMENTS_DIR . 'Config.php');

//------------------------------------------------------------------------------------------------------
// Autoload Register
//------------------------------------------------------------------------------------------------------
//
// Nesne çağrımında otomatik devreye girerek sınıfın yüklenmesini sağlar.
//
//------------------------------------------------------------------------------------------------------
spl_autoload_register('Autoloader::run');
