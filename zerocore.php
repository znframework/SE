<?php
//--------------------------------------------------------------------------------------------------
// Kernel
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// VERSION INFO CONSTANTS
//--------------------------------------------------------------------------------------------------
define('ZN_VERSION'          , '5.4.7');
define('REQUIRED_PHP_VERSION', '7.0.0');
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// REQUIREMENT CONSTANTS
//--------------------------------------------------------------------------------------------------
define('PROJECT_TYPE'                , 'SE'                                                       );
define('DS'                          , DIRECTORY_SEPARATOR                                        );
define('REAL_BASE_DIR'               , realpath(__DIR__) . DS                                     );
define('INTERNAL_DIR'                , (PROJECT_TYPE === 'SE' ? 'Libraries' : 'Internal') . '/'   );
define('PROJECT_CONTROLLER_NAMESPACE', 'Project\Controllers\\'                                    );
define('PROJECT_COMMANDS_NAMESPACE'  , 'Project\Commands\\'                                       );
define('EXTERNAL_COMMANDS_NAMESPACE' , 'External\Commands\\'                                      );
define('DIRECTORY_INDEX'             , 'zeroneed.php'                                             );
define('INTERNAL_ACCESS'             , 'Internal'                                                 );
define('BASE_DIR'                    , ltrim(explode(DIRECTORY_INDEX, $_SERVER['SCRIPT_NAME'])[0], '/'));
define('PROJECTS_DIR'                , 'Projects/'                                );
define('EXTERNAL_DIR'                , (PROJECT_TYPE === 'SE' ? '' : 'External/') );
define('SETTINGS_DIR'                , (PROJECT_TYPE === 'SE' ? 'Config' : 'Settings').'/'         );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// SPACE CHAR CONSTANTS
//--------------------------------------------------------------------------------------------------
define('EOL' , PHP_EOL);
define('CRLF', "\r\n" );
define('CR'  , "\r"   );
define('LF'  , "\n"   );
define('HT'  , "\t"   );
define('TAB' , "\t"   );
define('FF'  , "\f"   );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// REQUIREMENT CONSTANTS
//--------------------------------------------------------------------------------------------------
define('PROJECTS_CONFIG'    , import
(
    (is_file(PROJECTS_DIR . 'Projects.php') ? PROJECTS_DIR : SETTINGS_DIR) . 'Projects.php'
));
define('DEFAULT_PROJECT'    , PROJECTS_CONFIG['directory']['default']);
define('EXTERNAL_CONFIG_DIR', EXTERNAL_DIR . 'Config/'               );
define('INTERNAL_CONFIG_DIR', INTERNAL_DIR . 'Config/'               );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Current Project
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
internalCurrentProject();

//--------------------------------------------------------------------------------------------------
// DIRECTORY CONSTANTS
//--------------------------------------------------------------------------------------------------
//
// Almost every directory in the ZN Framework has constants. For this reason, these constants
// vary according to the project name. It can be quite useful for you.
//
//--------------------------------------------------------------------------------------------------
define('ROUTES_DIR'            , internalProjectContainerDir('Routes')                 );
define('EXTERNAL_ROUTES_DIR'   , EXTERNAL_DIR.'Routes/'                                );
define('DATABASES_DIR'         , internalProjectContainerDir('Databases')              );
define('CONFIG_DIR'            , internalProjectContainerDir('Config')                 );
define('STORAGE_DIR'           , internalProjectContainerDir('Storage')                );
define('COMMANDS_DIR'          , internalProjectContainerDir('Commands')               );
define('EXTERNAL_COMMANDS_DIR' , EXTERNAL_DIR.'Commands/'                              );
define('RESOURCES_DIR'         , internalProjectContainerDir($resources = 'Resources') );
define('EXTERNAL_RESOURCES_DIR', EXTERNAL_DIR.'Resources/'                             );
define('STARTING_DIR'          , internalProjectContainerDir($starting = 'Starting')   );
define('EXTERNAL_STARTING_DIR' , EXTERNAL_DIR.'Starting/'                              );
define('AUTOLOAD_DIR'          , internalProjectContainerDir($starting.'/Autoload')    );
define('EXTERNAL_AUTOLOAD_DIR' , EXTERNAL_STARTING_DIR.'Autoload/'                     );
define('HANDLOAD_DIR'          , internalProjectContainerDir($starting.'/Handload')    );
define('LAYERS_DIR'            , internalProjectContainerDir($starting.'/Layers')      );
define('EXTERNAL_HANDLOAD_DIR' , EXTERNAL_STARTING_DIR.'Handload/'                     );
define('EXTERNAL_LAYERS_DIR'   , EXTERNAL_STARTING_DIR.'Layers/'                       );
define('INTERNAL_LANGUAGES_DIR', INTERNAL_DIR.'Languages/'                             );
define('LANGUAGES_DIR'         , internalProjectContainerDir('Languages')              );
define('EXTERNAL_LANGUAGES_DIR', EXTERNAL_DIR.'Languages/'                             );
define('INTERNAL_LIBRARIES_DIR', INTERNAL_DIR.'Libraries/'                             );
define('REQUIREMENTS_DIR'      , INTERNAL_DIR.'Requirements/System/'                   );
define('LIBRARIES_DIR'         , internalProjectContainerDir('Libraries')              );
define('EXTERNAL_LIBRARIES_DIR', EXTERNAL_DIR.'Libraries/'                             );
define('CONTROLLERS_DIR'       , PROJECT_DIR.'Controllers/'                            );
define('MODELS_DIR'            , internalProjectContainerDir('Models')                 );
define('EXTERNAL_MODELS_DIR'   , EXTERNAL_DIR.'Models/'                                );
define('VIEWS_DIR'             , PROJECT_DIR.'Views/'                                  );
define('PAGES_DIR'             , VIEWS_DIR                                             );
define('PROCESSOR_DIR'         , internalProjectContainerDir($resources.'/Processor')  );
define('EXTERNAL_PROCESSOR_DIR', EXTERNAL_RESOURCES_DIR.'Processor/'                   );
define('FILES_DIR'             , internalProjectContainerDir($resources.'/Files')      );
define('EXTERNAL_FILES_DIR'    , EXTERNAL_RESOURCES_DIR.'Files/'                       );
define('FONTS_DIR'             , internalProjectContainerDir($resources.'/Fonts')      );
define('EXTERNAL_FONTS_DIR'    , EXTERNAL_RESOURCES_DIR.'Fonts/'                       );
define('SCRIPTS_DIR'           , internalProjectContainerDir($resources.'/Scripts')    );
define('EXTERNAL_SCRIPTS_DIR'  , EXTERNAL_RESOURCES_DIR.'Scripts/'                     );
define('STYLES_DIR'            , internalProjectContainerDir($resources.'/Styles')     );
define('EXTERNAL_STYLES_DIR'   , EXTERNAL_RESOURCES_DIR.'Styles/'                      );
define('TEMPLATES_DIR'         , internalProjectContainerDir($resources.'/Templates')  );
define('EXTERNAL_TEMPLATES_DIR', EXTERNAL_RESOURCES_DIR.'Templates/'                   );
define('THEMES_DIR'            , internalProjectContainerDir($resources.'/Themes')     );
define('EXTERNAL_THEMES_DIR'   , EXTERNAL_RESOURCES_DIR.'Themes/'                      );
define('PLUGINS_DIR'           , internalProjectContainerDir($resources.'/Plugins')    );
define('EXTERNAL_PLUGINS_DIR'  , EXTERNAL_RESOURCES_DIR.'Plugins/'                     );
define('UPLOADS_DIR'           , internalProjectContainerDir($resources.'/Uploads')    );
define('EXTERNAL_UPLOADS_DIR'  , EXTERNAL_RESOURCES_DIR.'Uploads/'                     );
define('INTERNAL_TEMPLATES_DIR', INTERNAL_DIR.'Templates/'                             );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Top Layer
//--------------------------------------------------------------------------------------------------
layer('Top');
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Import Autoloader Library
//--------------------------------------------------------------------------------------------------
import(REQUIREMENTS_DIR . 'Autoloader.php');
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// STATUS CONSTANTS
//--------------------------------------------------------------------------------------------------
//
// Status Constants
//
//--------------------------------------------------------------------------------------------------
define('SSL_STATUS'  , ! Config::get('Services','uri')['ssl'] ? 'http://' : 'https://');
define('INDEX_STATUS', ! Config::get('Htaccess', 'uri')['directoryIndex']
                       ? ''
                       : suffix(DIRECTORY_INDEX)
);
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// URL CONSTANTS
//--------------------------------------------------------------------------------------------------
//
// Useful current constants.
//
//--------------------------------------------------------------------------------------------------
define('HOST'         , host()                                                 );
define('HOST_NAME'    , HOST                                                   );
define('HOST_URL'     , SSL_STATUS . HOST . '/'                                );
define('BASE_URL'     , HOST_URL . BASE_DIR                                    );
define('SITE_URL'     , URL::site()                                            );
define('CURRENT_URL'  , rtrim(HOST_URL, '/') . ($_SERVER['REQUEST_URI'] ?? NULL));
define('PREV_URL'     , $_SERVER['HTTP_REFERER'] ?? NULL                       );
define('BASE_PATH'    , BASE_DIR                                               );
define('CURRENT_PATH' , URI::current()                                         );
define('PREV_PATH'    , str_replace(SITE_URL, NULL, PREV_URL)                  );
define('FILES_URL'    , BASE_URL . FILES_DIR                                   );
define('FONTS_URL'    , BASE_URL . FONTS_DIR                                   );
define('PLUGINS_URL'  , BASE_URL . PLUGINS_DIR                                 );
define('SCRIPTS_URL'  , BASE_URL . SCRIPTS_DIR                                 );
define('STYLES_URL'   , BASE_URL . STYLES_DIR                                  );
define('THEMES_URL'   , BASE_URL . THEMES_DIR                                  );
define('UPLOADS_URL'  , BASE_URL . UPLOADS_DIR                                 );
define('RESOURCES_URL', BASE_URL . RESOURCES_DIR                               );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Top Bottom Layer
//--------------------------------------------------------------------------------------------------
layer('TopBottom');
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Structure Data
//--------------------------------------------------------------------------------------------------
//
// Current Controller Constants
//
//--------------------------------------------------------------------------------------------------
define('STRUCTURE_DATA'     , ZN\Core\Structure::data()                );
define('CURRENT_COPEN_PAGE' , STRUCTURE_DATA['openFunction']           );
define('CURRENT_CPARAMETERS', STRUCTURE_DATA['parameters']             );
define('CURRENT_CFILE'      , STRUCTURE_DATA['file']                   );
define('CURRENT_CFUNCTION'  , STRUCTURE_DATA['function']               );
define('CURRENT_CPAGE'      , ($page = STRUCTURE_DATA['page']) . '.php');
define('CURRENT_CONTROLLER' , $page                                    );
define('CURRENT_CNAMESPACE' , $namespace = STRUCTURE_DATA['namespace'] );
define('CURRENT_CCLASS'     , $namespace . CURRENT_CONTROLLER          );
define('CURRENT_CFPATH'     , str_replace
(
    CONTROLLERS_DIR, '', CURRENT_CONTROLLER) . '/' . CURRENT_CFUNCTION
);
define('CURRENT_CFURI'      , strtolower(CURRENT_CFPATH)               );
define('CURRENT_CFURL'      , SITE_URL . CURRENT_CFPATH                );
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Illustrate
//--------------------------------------------------------------------------------------------------
//
// @param string $const
// @param  mixed $value
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function illustrate(String $const, $value = '')
{
    if( ! defined($const) )
    {
        define($const, $value);
    }
    else
    {
        if( $value !== '' )
        {
            return $value;
        }
    }

    return constant($const);
}

//--------------------------------------------------------------------------------------------------
// CSRFInput
//--------------------------------------------------------------------------------------------------
//
// @param string data
//
// @return int
//
//--------------------------------------------------------------------------------------------------
function CSRFInput()
{
    Session::insert('token', ZN\CryptoGraphy\Encode\RandomPassword::create(32));

    return Form::hidden('token', Session::select('token'));
}

//--------------------------------------------------------------------------------------------------
// Length
//--------------------------------------------------------------------------------------------------
//
// @param string data
//
// @return int
//
//--------------------------------------------------------------------------------------------------
function length($data) : Int
{
    return ! is_scalar($data)
           ? count((array) $data)
           : strlen($data);
}

//--------------------------------------------------------------------------------------------------
// headers()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $header
//
//--------------------------------------------------------------------------------------------------
function headers($header)
{
    if( empty($header) )
    {
        return false;
    }

    if( ! is_array($header) )
    {
         header($header);
    }
    else
    {
        if( ! empty($header) ) foreach( $header as $k => $v )
        {
            header($v);
        }
    }
}

//--------------------------------------------------------------------------------------------------
// currentUri()
//--------------------------------------------------------------------------------------------------
//
// @param bool $fullPath = false
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUri(Bool $fullPath = false) : String
{
    return URI::active($fullPath);
}

//--------------------------------------------------------------------------------------------------
// getLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function getLang() : String
{
    return Lang::get();
}

//--------------------------------------------------------------------------------------------------
// setLang()
//--------------------------------------------------------------------------------------------------
//
// @param string $l
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function setLang(String $l = NULL) : Bool
{
    return Lang::set($l);
}

//--------------------------------------------------------------------------------------------------
// lang()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $str
// @param mixed  $changed
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function lang(String $file = NULL, String $str = NULL, $changed = NULL)
{
    return Lang::select($file, $str, $changed);
}

//--------------------------------------------------------------------------------------------------
// currentLang()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentLang() : String
{
    return Lang::current();
}

//--------------------------------------------------------------------------------------------------
// currentUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $fix
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentUrl(String $fix = NULL) : String
{
    return URL::current($fix);
}

//--------------------------------------------------------------------------------------------------
// siteUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrl(String $uri = NULL, Int $index = 0) : String
{
    return URL::site($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// siteUrls() - v.4.2.6
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function siteUrls(String $uri = NULL, Int $index = 0) : String
{
    return URL::sites($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// baseUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function baseUrl(String $uri = NULL, Int $index = 0) : String
{
    return URL::base($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// prevUrl()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevUrl() : String
{
    return URL::prev();
}

//--------------------------------------------------------------------------------------------------
// hostUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function hostUrl(String $uri = NULL) : String
{
    return URL::host($uri);
}

//--------------------------------------------------------------------------------------------------
// currentPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function currentPath(Bool $isPath = true) : String
{
    return URI::current($isPath);
}

//--------------------------------------------------------------------------------------------------
// basePath()
//--------------------------------------------------------------------------------------------------
//
// @param string $uri
// @param int    $index
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function basePath(String $uri = NULL, Int $index = 0) : String
{
    return URI::base($uri, $index);
}

//--------------------------------------------------------------------------------------------------
// prevPath()
//--------------------------------------------------------------------------------------------------
//
// @param bool $isPath
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prevPath(Bool $isPath = true) : String
{
    return URI::prev($isPath);
}

//--------------------------------------------------------------------------------------------------
// redirect()
//--------------------------------------------------------------------------------------------------
//
// @param string $url
// @param int    $time
// @param array  $data
// @param bool   $exit
//
//--------------------------------------------------------------------------------------------------
function redirect(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = true)
{
    Redirect::location($url, $time, $data, $exit);
}

//--------------------------------------------------------------------------------------------------
// redirectData()
//--------------------------------------------------------------------------------------------------
//
// @param string $k
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function redirectData(String $k)
{
    return Redirect::selectData($k);
}

//--------------------------------------------------------------------------------------------------
// redirectDeleteData()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
//
// @return bool
//
//--------------------------------------------------------------------------------------------------
function redirectDeleteData($data) : Bool
{
    return Redirect::deleteData($data);
}

//--------------------------------------------------------------------------------------------------
// internalDefaultProjectKey()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function internalDefaultProjectKey()
{
    return ZN\In::defaultProjectKey();
}

//--------------------------------------------------------------------------------------------------
// library()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param string $function
// @param mixed  $parameters
//
// @return callable
//
//--------------------------------------------------------------------------------------------------
function library(String $class, String $function, $parameters = [])
{
    $var = uselib($class);

    if( ! is_array($parameters) )
    {
        $parameters = [$parameters];
    }

    if( is_callable([$var, $function]) )
    {
        return call_user_func_array([$var, $function], $parameters);
    }
    else
    {
        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// uselib()
//--------------------------------------------------------------------------------------------------
//
// @param string $class
// @param array  $parameters
//
// @return class
//
//--------------------------------------------------------------------------------------------------
function uselib(String $class, Array $parameters = [])
{
    if( ! class_exists($class) )
    {
        $classInfo = Autoloader::getClassFileInfo($class);
    
        $class = $classInfo['namespace'];

        if( ! class_exists($class) )
        {
            throw new GeneralException('Error', 'classError', $class);
        }
    }

    if( ! isset(ZN::$use->$class) )
    {
        if( ! is_object(ZN::$use) )
        {
            ZN::$use = new stdClass();
        }

        ZN::$use->$class = new $class(...$parameters);
    }

    return ZN::$use->$class;
}

//--------------------------------------------------------------------------------------------------
// Layer -> 5.3.6[added]
//--------------------------------------------------------------------------------------------------
//
// @param string $layer
//
//--------------------------------------------------------------------------------------------------
function layer(String $layer)
{
    $path = $layer . '.php';

    import(LAYERS_DIR          . $path);
    import(EXTERNAL_LAYERS_DIR . $path);
}

//--------------------------------------------------------------------------------------------------
// Import
//--------------------------------------------------------------------------------------------------
//
// Require Once
//
//--------------------------------------------------------------------------------------------------
function import(String $file)
{
    $constant = 'ImportFilePrefix' . $file;

    if( ! defined($constant) )
    {
        define($constant, true);

        if( is_file($file) )
        {
            return require $file;
        }

        return false;
    }
}

//--------------------------------------------------------------------------------------------------
// trace()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Sistem kullanıyor.
// Dönen Değerler: Sistem kullanıyor.
//
//--------------------------------------------------------------------------------------------------
function trace(String $message)
{
    $style  = 'border:solid 1px #E1E4E5;';
    $style .= 'background:#FEFEFE;';
    $style .= 'padding:10px;';
    $style .= 'margin-bottom:10px;';
    $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
    $style .= 'color:#666;';
    $style .= 'text-align:left;';
    $style .= 'font-size:14px;';

    $message = preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);

    $str  = "<div style=\"$style\">";
    $str .= $message;
    $str .= '</div>';

    exit($str);
}

//--------------------------------------------------------------------------------------------------
// isPhpVersion()
//--------------------------------------------------------------------------------------------------
//
// İşlev: Parametrenin geçerli php sürümü olup olmadığını kontrol eder.
// Parametreler: $version => Geçerliliği kontrol edilecek veri.
// Dönen Değerler: Geçerli sürümse true değilse false değerleri döner.
//
//--------------------------------------------------------------------------------------------------
function isPhpVersion(String $version = '5.2.4')
{
    return IS::phpVersion($version);
}

//--------------------------------------------------------------------------------------------------
// absoluteRelativePath()
//--------------------------------------------------------------------------------------------------
//
// Gerçek yolu yalın yola çevirir.
//
//--------------------------------------------------------------------------------------------------
function absoluteRelativePath(String $path = NULL)
{
    return ZN\FileSystem\File\Info::absolutePath($path);
}

//--------------------------------------------------------------------------------------------------
// isUrl()
//--------------------------------------------------------------------------------------------------
//
// @param string $url
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isUrl(String $url) : Bool
{
    return IS::url($url);
}

//--------------------------------------------------------------------------------------------------
// isEmail()
//--------------------------------------------------------------------------------------------------
//
// @param string $email
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isEmail(String $email) : Bool
{
    return IS::email($email);
}

//--------------------------------------------------------------------------------------------------
// isChar()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $str
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isChar($str) : Bool
{
    return IS::char($str);
}

//--------------------------------------------------------------------------------------------------
// isHash()
//--------------------------------------------------------------------------------------------------
//
// @param string $type
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isHash(String $type) : Bool
{
    return IS::hash($type);
}

//--------------------------------------------------------------------------------------------------
// isCharset()
//--------------------------------------------------------------------------------------------------
//
// @param string $charset
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isCharset(String $charset) : Bool
{
    return IS::charset($charset);
}

//--------------------------------------------------------------------------------------------------
// isArray
//--------------------------------------------------------------------------------------------------
//
// @param mixed $array
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function isArray($array) : Bool
{
    return IS::array($array);
}

//--------------------------------------------------------------------------------------------------
// Null Coalesce
//--------------------------------------------------------------------------------------------------
//
// @param var   &$var
// @param mixed $value
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function nullCoalesce( & $var, $value)
{
    Coalesce::null($var, $value);
}

//--------------------------------------------------------------------------------------------------
// False Coalesce
//--------------------------------------------------------------------------------------------------
//
// @param var   &$var
// @param mixed $value
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function falseCoalesce( & $var, $value)
{
    Coalesce::false($var, $value);
}

//--------------------------------------------------------------------------------------------------
// Empty Coalesce
//--------------------------------------------------------------------------------------------------
//
// @param var   &$var
// @param mixed $value
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function emptyCoalesce( & $var, $value)
{
    Coalesce::empty($var, $value);
}

//--------------------------------------------------------------------------------------------------
// output()
//--------------------------------------------------------------------------------------------------
//
// @param mixed $data
// @param array $settings = []
// @param bool  $content  = false
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function output($data, Array $settings = NULL, Bool $content = false)
{
    return Output::display($data, $settings, $content);
}

//--------------------------------------------------------------------------------------------------
// write()
//--------------------------------------------------------------------------------------------------
//
// @param string $data
// @param array  $vars = []
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function write($data = NULL, Array $vars = NULL)
{
    Output::write($data, $vars);
}

//--------------------------------------------------------------------------------------------------
// writeLine()
//--------------------------------------------------------------------------------------------------
//
// @param string $data
// @param array  $vars    = []
// @param int    $brCount = 1
//
// @return void
//
//--------------------------------------------------------------------------------------------------
function writeLine($data = NULL, Array $vars = NULL, Int $brCount = 1)
{
    Output::writeLine($data, $vars, $brCount);
}

//--------------------------------------------------------------------------------------------------
// ipv4()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function ipv4() : String
{
    return User::ip();
}

//--------------------------------------------------------------------------------------------------
// server()
//--------------------------------------------------------------------------------------------------
//
// @param string $type = ''
//
// @return mixed
//
//--------------------------------------------------------------------------------------------------
function server(String $type = NULL)
{
    $server =
    [
        NULL                         => $_SERVER,
        'name'                       => $_SERVER['SERVER_NAME']           ?? false,
        'admin'                      => $_SERVER['SERVER_ADMIN']          ?? false,
        'addr'                       => $_SERVER['SERVER_ADDR']           ?? false,
        'port'                       => $_SERVER['SERVER_PORT']           ?? false,
        'protocol'                   => $_SERVER['SERVER_PROTOCOL']       ?? false,
        'signature'                  => $_SERVER['SERVER_SIGNATURE']      ?? false,
        'software'                   => $_SERVER['SERVER_SOFTWARE']       ?? false,
        'remoteAddr'                 => $_SERVER['REMOTE_ADDR']           ?? false,
        'remotePort'                 => $_SERVER['REMOTE_PORT']           ?? false,
        'requestMethod'              => $_SERVER['REQUEST_METHOD']        ?? false,
        'requestUri'                 => $_SERVER['REQUEST_URI']           ?? false,
        'requestScheme'              => $_SERVER['REQUEST_SCHEME']        ?? false,
        'requestTime'                => $_SERVER['REQUEST_TIME']          ?? false,
        'requestTimeFloat'           => $_SERVER['REQUEST_TIME_FLOAT']    ?? false,
        'accept'                     => $_SERVER['HTTP_ACCEPT']           ?? false,
        'acceptCharset'              => $_SERVER['HTTP_ACCEPT_CHARSET']   ?? false,
        'acceptEncoding'             => $_SERVER['HTTP_ACCEPT_ENCODING']  ?? false,
        'acceptLanguage'             => $_SERVER['HTTP_ACCEPT_LANGUAGE']  ?? false,
        'clientIp'                   => $_SERVER['HTTP_CLIENT_IP']        ?? false,
        'xForwardedHost'             => $_SERVER['HTTP_X_FORWARDED_HOST'] ?? false,
        'xForwardedFor'              => $_SERVER['HTTP_X_FORWARDED_FOR']  ?? false,
        'xOriginalUrl'               => $_SERVER['HTTP_X_ORIGINAL_URL']   ?? false,
        'xRequestedWith'             => $_SERVER['HTTP_X_REQUESTED_WITH'] ?? false,
        'connection'                 => $_SERVER['HTTP_CONNECTION']       ?? false,
        'host'                       => $_SERVER['HTTP_HOST']             ?? false,
        'referer'                    => $_SERVER['HTTP_REFERER']          ?? false,
        'userAgent'                  => $_SERVER['HTTP_USER_AGENT']       ?? false,
        'cookie'                     => $_SERVER['HTTP_COOKIE']           ?? false,
        'cacheControl'               => $_SERVER['HTTP_CACHE_CONTROL']    ?? false,
        'https'                      => $_SERVER['HTTPS']                 ?? false,
        'scriptFileName'             => $_SERVER['SCRIPT_FILENAME']       ?? false,
        'scriptName'                 => $_SERVER['SCRIPT_NAME']           ?? false,
        'path'                       => $_SERVER['PATH']                  ?? false,
        'pathInfo'                   => $_SERVER['PATH_INFO']             ?? false,
        'currentPath'                => $_SERVER['PATH_INFO']             ?? $_SERVER['QUERY_STRING'] ?? false,
        'pathTranslated'             => $_SERVER['PATH_TRANSLATED']       ?? false,
        'pathext'                    => $_SERVER['PATHEXT']               ?? false,
        'redirectQueryString'        => $_SERVER['REDIRECT_QUERY_STRING'] ?? false,
        'redirectUrl'                => $_SERVER['REDIRECT_URL']          ?? false,
        'redirectStatus'             => $_SERVER['REDIRECT_STATUS']       ?? false,
        'phpSelf'                    => $_SERVER['PHP_SELF']              ?? false,
        'queryString'                => $_SERVER['QUERY_STRING']          ?? false,
        'documentRoot'               => $_SERVER['DOCUMENT_ROOT']         ?? false,
        'windir'                     => $_SERVER['WINDIR']                ?? false,
        'comspec'                    => $_SERVER['COMSPEC']               ?? false,
        'systemRoot'                 => $_SERVER['SystemRoot']            ?? false,
        'gatewayInterface'           => $_SERVER['GATEWAY_INTERFACE']     ?? false
    ];

    if( isset($server[$type]) )
    {
        if( is_array($server[$type]) )
        {
            return $server[$type];
        }
        else
        {
            $return = htmlspecialchars($server[$type], ENT_QUOTES, "utf-8");
        }
    }
    elseif( isset($_SERVER[$type]) )
    {
        $return = htmlspecialchars($_SERVER[$type], ENT_QUOTES, "utf-8");
    }

    // 5.4.3[edited]
    return str_replace('&amp;', '&', $return) ?: false;
}

//--------------------------------------------------------------------------------------------------
// pathInfos()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param string $info = 'basename'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function pathInfos(String $file, String $info = 'basename') : String
{
    return ZN\FileSystem\File\Info::pathInfo($file, $info);
}

//--------------------------------------------------------------------------------------------------
// extension()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
// @param bool   $dote = false
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function extension(String $file, Bool $dote = false) : String
{
    return ZN\FileSystem\File\Extension::get($file, $dote);
}

//--------------------------------------------------------------------------------------------------
// removeExtension()
//--------------------------------------------------------------------------------------------------
//
// @param string $file
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function removeExtension(String $file) : String
{
    return ZN\FileSystem\File\Extension::remove($file);
}

//--------------------------------------------------------------------------------------------------
// host()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function host() : String
{
    if( isset($_SERVER['HTTP_X_FORWARDED_HOST']) )
    {
        $host     = $_SERVER['HTTP_X_FORWARDED_HOST'];
        $elements = explode(',', $host);
        $host     = trim(end($elements));
    }
    else
    {
        $host = $_SERVER['HTTP_HOST']   ??
                $_SERVER['SERVER_NAME'] ??
                $_SERVER['SERVER_ADDR'] ??
                '';
    }

    return trim($host);
}

//--------------------------------------------------------------------------------------------------
// hostName()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function hostName() : String
{
    return host();
}

//--------------------------------------------------------------------------------------------------
// charsetList()
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @return array
//
//--------------------------------------------------------------------------------------------------
function charsetList() : Array
{
    return mb_list_encodings();
}

//--------------------------------------------------------------------------------------------------
// compare()
//--------------------------------------------------------------------------------------------------
//
// @param string $p1
// @param string $p2
// @param string $p3
//
// @return Bool
//
//--------------------------------------------------------------------------------------------------
function compare(String $p1, String $operator, String $p2) : Bool
{
    return version_compare($p1, $p2, $operator);
}

//--------------------------------------------------------------------------------------------------
// suffix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function suffix(String $string = NULL, String $fix = '/') : String
{
    return prefix($string, $fix, __FUNCTION__);
}

//--------------------------------------------------------------------------------------------------
// prefix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function prefix(String $string = NULL, String $fix = '/', $type = __FUNCTION__) : String
{
    $stringFix = $type === 'prefix' ? $fix . $string : $string . $fix;

    if( strlen($fix) <= strlen($string) )
    {
        $prefix = $type === 'prefix' ? substr($string, 0, strlen($fix)) : substr($string, -strlen($fix));

        if( $prefix !== $fix )
        {
            $string = $stringFix;
        }
    }
    else
    {
        $string = $stringFix;
    }

    if( $string === $fix )
    {
        return false;
    }

    return $string;
}

//--------------------------------------------------------------------------------------------------
// presuffix()
//--------------------------------------------------------------------------------------------------
//
// @param string $string
// @param string $fix = '/'
//
// @return string
//
//--------------------------------------------------------------------------------------------------
function presuffix(String $string = NULL, String $fix = '/') : String
{
    return suffix(prefix(empty($string) ? $fix . $string . $fix : $string, $fix), $fix);
}

//--------------------------------------------------------------------------------------------------
// internalProjectContainerDir)
//--------------------------------------------------------------------------------------------------
//
// @param void
//
// @param string
//
//--------------------------------------------------------------------------------------------------
function internalProjectContainerDir($path = NULL) : String
{
    $path = suffix($path);

    if( PROJECT_TYPE === 'SE' )
    {
        return $path;
    }

    $containers          = PROJECTS_CONFIG['containers'];
    $containerProjectDir = prefix($path, PROJECT_DIR);

    if( ! empty($containers) && defined('_CURRENT_PROJECT') )
    {
        $restoreFix = 'Restore';

        // 5.3.8[added]
        if( strpos(_CURRENT_PROJECT, $restoreFix) === 0 && is_dir(PROJECTS_DIR . ($restoredir = ltrim(_CURRENT_PROJECT, $restoreFix))) )
        {
            $condir = $restoredir;

            if( $containers[$condir] ?? NULL )
            {
                $condir = $containers[$condir];
            }
        }
        else
        {
            $condir = $containers[_CURRENT_PROJECT] ?? NULL;
        }  
        
        return ! empty($condir) && ! file_exists($containerProjectDir)
               ? PROJECTS_DIR . suffix($condir) . $path
               : $containerProjectDir;
    }

    // 5.3.33[edited]
    if( is_dir($containerProjectDir) )
    {
        return $containerProjectDir;
    }

    // 5.1.5 -> The enclosures can be the opening controller
    if( $container = ($containers[CURRENT_PROJECT] ?? NULL) )
    {
        $containerProjectDir = str_replace(CURRENT_PROJECT, $container, $containerProjectDir);
    }

    return $containerProjectDir;
}

//--------------------------------------------------------------------------------------------------
// Internal Is Writable
//--------------------------------------------------------------------------------------------------
//
// @param string $path
//
//--------------------------------------------------------------------------------------------------
function internalIsWritable(String $path)
{
    if( is_file($path) && ! is_writable($path) )
    {   
        trace
        (
            'Please check the [file permissions]. Click the 
                <a target="_blank" style="text-decoration:none" href="https://docs.znframework.com/getting-started/installation-instructions#sh42">
                    [documentation]
                </a> 
            to see how to configure file permissions.'
        );
    }
}

//--------------------------------------------------------------------------------------------------
// Internal Current Project -> 5.4.7[edited]
//--------------------------------------------------------------------------------------------------
//
// @param void
//
//--------------------------------------------------------------------------------------------------
function internalCurrentProject()
{
    internalIsWritable('.htaccess');

    if( PROJECT_TYPE === 'SE' )
    {
        define('CURRENT_PROJECT', NULL);
        define('PROJECT_DIR'    , NULL);

        return false;
    }

    $projectConfig = PROJECTS_CONFIG['directory']['others'];
    $projectDir    = $projectConfig;

    if( defined('CONSOLE_PROJECT_NAME') )
    {
        $internalDir = CONSOLE_PROJECT_NAME;
    }
    else
    {
        $currentPath = server('currentPath');

        // 5.0.3 -> Updated -------------------------------------------------------
        //
        // QUERY_STRING & REQUEST URI Empty Control
		if( empty($currentPath) && ($requestUri = server('requestUri')) !== '/' )
		{
			$currentPath = $requestUri;
		}
        // ------------------------------------------------------------------------
        
        $internalDir = ( ! empty($currentPath) ? explode('/', ltrim($currentPath, '/'))[0] : '' );
    }

    if( is_array($projectDir) )
    {
        $internalDir = $projectDir[$internalDir] ?? $internalDir;
        $projectDir  = $projectDir[host()] ?? DEFAULT_PROJECT;
    }

    if( ! empty($internalDir) && is_dir(PROJECTS_DIR . $internalDir) )
    {
        define('_CURRENT_PROJECT', $internalDir);

        $flip              = array_flip($projectConfig);
        $projectDir        = _CURRENT_PROJECT;
        $currentProjectDir = $flip[$projectDir] ?? $projectDir;
    }

    define('CURRENT_PROJECT', $currentProjectDir ?? $projectDir);
    define('PROJECT_DIR', suffix(PROJECTS_DIR . $projectDir));

    if( ! is_dir(PROJECT_DIR) )
    {
        trace('["'.$projectDir.'"] Project Directory Not Found!');
    }
}
