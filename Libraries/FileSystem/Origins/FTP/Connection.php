<?php namespace ZN\FileSystem\FTP;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FileSystem\Exception\IOException;

class Connection extends \CLController
{
    const config = 'FileSystem:ftp';

    //--------------------------------------------------------------------------------------------------------
    // Protected $connect
    //--------------------------------------------------------------------------------------------------------
    //
    // @const resource
    //
    //--------------------------------------------------------------------------------------------------------
    protected $connect = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Protected $login
    //--------------------------------------------------------------------------------------------------------
    //
    // @const resource
    //
    //--------------------------------------------------------------------------------------------------------
    protected $login = NULL;

    //--------------------------------------------------------------------------------------------------------
    // __construct()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(Array $config = [])
    {
        parent::__construct();

        if( ! empty($config) )
        {
            $config = \Config::get('FileSystem', 'ftp', $config);
        }
        else
        {
            $config = FILESYSTEM_FTP_CONFIG;
        }

        $this->_connect($config);
    }

    //--------------------------------------------------------------------------------------------------------
    // differentConnection()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(Array $config) : Connection
    {
        return new self($config);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected connect()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config: empty
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _connect($config)
    {
        // ----------------------------------------------------------------------------
        // FTP BAĞLANTI AYARLARI YAPILANDIRILIYOR
        // ----------------------------------------------------------------------------
        $host     = $config['host'];
        $port     = $config['port'];
        $timeout  = $config['timeout'];
        $user     = $config['user'];
        $password = $config['password'];
        $ssl      = $config['sslConnect'];
        // ----------------------------------------------------------------------------

        // Bağlantı türü ayarına göre ssl veya normal
        // bağlatı yapılıp yapılmayacağı belirlenir.
        $this->connect = $ssl === false
                       ? ftp_connect($host, $port, $timeout)
                       : ftp_ssl_connect($host, $port, $timeout);

        if( empty($this->connect) )
        {
            throw new IOException('Error', 'emptyVariable', 'Connect');
        }

        $this->login = ftp_login($this->connect, $user, $password);

        if( empty($this->login) )
        {
            throw new IOException('Error', 'emptyVariable', 'Login');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected close()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _close()
    {
        if( ! empty($this->connect) )
        {
            return ftp_close($this->connect);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // __destruct()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __destruct()
    {
        $this->_close();
    }
}
