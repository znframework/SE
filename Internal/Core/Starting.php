<?php
//--------------------------------------------------------------------------------------------------------
// Starting
//--------------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// BASE_URL
//--------------------------------------------------------------------------------------------------------
//
// @return example.com/
//
//--------------------------------------------------------------------------------------------------------
define('BASE_URL', baseUrl());

//--------------------------------------------------------------------------------------------------------
// SITE_URL
//--------------------------------------------------------------------------------------------------------
//
// @return example.com/zeroneed.php
//
//--------------------------------------------------------------------------------------------------------
define('SITE_URL', siteUrl());

//--------------------------------------------------------------------------------------------------------
// CURRENT_URL
//--------------------------------------------------------------------------------------------------------
//
// @return example.com/aktive
//
//--------------------------------------------------------------------------------------------------------
define('CURRENT_URL', currentUrl());

//--------------------------------------------------------------------------------------------------------
// PREV_URL
//--------------------------------------------------------------------------------------------------------
//
// @return example.com/prev
//
//--------------------------------------------------------------------------------------------------------
define('PREV_URL', prevUrl());

//--------------------------------------------------------------------------------------------------------
// HOST_URL
//--------------------------------------------------------------------------------------------------------
//
// @return hostname
//
//--------------------------------------------------------------------------------------------------------
define('HOST_URL', hostUrl());

//--------------------------------------------------------------------------------------------------------
// BASE_PATH
//--------------------------------------------------------------------------------------------------------
//
// @return example.com/
//
//--------------------------------------------------------------------------------------------------------
define('BASE_PATH', basePath());

//--------------------------------------------------------------------------------------------------------
// CURRENT_PATH
//--------------------------------------------------------------------------------------------------------
//
// @return current/
//
//--------------------------------------------------------------------------------------------------------
define('CURRENT_PATH', currentPath());

//--------------------------------------------------------------------------------------------------------
// PREV_PATH
//--------------------------------------------------------------------------------------------------------
//
// @return prev/
//
//--------------------------------------------------------------------------------------------------------
define('PREV_PATH', prevPath());

//--------------------------------------------------------------------------------------------------------
// HOST
//--------------------------------------------------------------------------------------------------------
//
// @return example.com
//
//--------------------------------------------------------------------------------------------------------
define('HOST', host());

//--------------------------------------------------------------------------------------------------------
// HOST_NAME
//--------------------------------------------------------------------------------------------------------
//
// @return example.com
//
//--------------------------------------------------------------------------------------------------------
define('HOST_NAME', HOST);

//--------------------------------------------------------------------------------------------------------
// BASE PATH URLS -> 4.6.0
//--------------------------------------------------------------------------------------------------------
//
// @return example.com/Projects/ProjectDirectory/Resources/xxx
//
//--------------------------------------------------------------------------------------------------------
define('FILES_URL'    , baseUrl(FILES_DIR    ));
define('FONTS_URL'    , baseUrl(FONTS_DIR    ));
define('PLUGINS_URL'  , baseUrl(PLUGINS_DIR  ));
define('SCRIPTS_URL'  , baseUrl(SCRIPTS_DIR  ));
define('STYLES_URL'   , baseUrl(STYLES_DIR   ));
define('THEMES_URL'   , baseUrl(THEMES_DIR   ));
define('UPLOADS_URL'  , baseUrl(UPLOADS_DIR  ));
define('RESOURCES_URL', baseUrl(RESOURCES_DIR));
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Ob Start
//--------------------------------------------------------------------------------------------------------
//
// Tampon başlatılıyor.
//
//--------------------------------------------------------------------------------------------------------
if( Config::get('IndividualStructures', 'cache')['obGzhandler'] && substr_count(server('acceptEncoding'), 'gzip') )
{
    ob_start('ob_gzhandler');
}
else
{
    ob_start();
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Headers
//--------------------------------------------------------------------------------------------------------
//
// Başlık bilgileri düzenleniyor.
//
//--------------------------------------------------------------------------------------------------------
headers(Config::get('General', 'headers'));
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Set Error Handler
//--------------------------------------------------------------------------------------------------------
//
// Yakanalan hata set ediliyor.
//
//--------------------------------------------------------------------------------------------------------
if( PROJECT_MODE !== 'publication' )
{
    set_error_handler('Exceptions::table');
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// INI Ayarlarını Yapılandırma İşlemi
//--------------------------------------------------------------------------------------------------------
if( $iniSet = Config::get('Htaccess', 'ini')['settings'] )
{
    Config::iniSet($iniSet);
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Htaccess Dosyası Oluşturma İşlemi
//--------------------------------------------------------------------------------------------------------
if( Config::get('Htaccess','createFile') === true )
{
    internalCreateHtaccessFile();
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Robots Dosyası Oluşturma İşlemi
//--------------------------------------------------------------------------------------------------------
if( Config::get('Robots','createFile') === true )
{
    internalCreateRobotsFile();
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Generate Databases
//--------------------------------------------------------------------------------------------------------
$generateConfig = Config::get('FileSystem', 'generate');

if( $generateConfig['databases'] === true )
{
    Generate::databases();
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Generate Grand Vision
//--------------------------------------------------------------------------------------------------------
if( $grandVision = $generateConfig['grandVision'] )
{
    $databases = is_array($grandVision) ? $grandVision : NULL;

    Generate::grandVision($databases);
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// URI Set lang
//--------------------------------------------------------------------------------------------------------
if( currentLang() )
{
    $langFix = str_ireplace([suffix((string) illustrate('_CURRENT_PROJECT'))], '', server('currentPath'));
    $langFix = explode('/', $langFix)[1] ?? NULL;

    if( strlen($langFix) === 2 )
    {
        setLang($langFix);
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Composer Autoloader
//--------------------------------------------------------------------------------------------------------
if( $composer = Config::get('Autoloader', 'composer') )
{
    $path = 'vendor/autoload.php';

    if( $composer === true )
    {
        if( file_exists($path) )
        {
            import($path);
        }
        else
        {
            report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

            die(Errors::message('Error', 'fileNotFound', $path));
        }
    }
    elseif( is_file($composer) )
    {
        require_once($composer);
    }
    else
    {
        $path = suffix($composer) . $path;

        report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

        die(Errors::message('Error', 'fileNotFound', $path));
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Autoload Files
//--------------------------------------------------------------------------------------------------------
$starting = Config::get('Starting');

if( $starting['autoload']['status'] === true )
{
    $startingAutoload = Folder::allFiles(AUTOLOAD_DIR, $starting['autoload']['recursive']);

    if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
    {
        if( extension($file) === 'php' )
        {
            if( is_file($file) )
            {
                import($file);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Handload Files
//--------------------------------------------------------------------------------------------------------
if( ! empty($starting['handload']) )
{
    Import::handload(...$starting['handload']);
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
//  Restore Modu
//--------------------------------------------------------------------------------------------------------
if( PROJECT_MODE === 'restoration' )
{
    Restoration::mode();
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Route Filter
//--------------------------------------------------------------------------------------------------------
Route::filter();
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Invalid Request Page
//--------------------------------------------------------------------------------------------------------
internalInvalidRequest('disallowMethods', true);
internalInvalidRequest('allowMethods', false);
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Starting Controllers
//--------------------------------------------------------------------------------------------------------
if( $startController = Config::get('Starting', 'controller') )
{
    if( is_string($startController) )
    {
        internalStartingController($startController);
    }
    elseif( is_array($startController) )
    {
        foreach( $startController as $key => $val )
        {
            if( is_numeric($key) )
            {
                internalStartingController($val);
            }
            else
            {
                internalStartingController($key, $val);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------
