<?php namespace ZN\Ability;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Config;
use ZN\Support;
use ZN\Singleton;
use ZN\Exception\UndefinedConstException;

trait Driver
{
    /**
     * protected driver
     * 
     * @var string
     */
    protected $driver;

    /**
     * protected driver name
     * 
     * @var string
     */
    protected $selectedDriverName;

    /**
     * magic constructor
     * 
     * @param string $driver = NULL
     * 
     * @return void
     */
    public function __construct(String $driver = NULL)
    {
        # 5.3.42[added]
        if( method_exists(get_parent_class(), '__construct'))
        {
            parent::__construct();
        }
       
        if( ! defined('static::driver') )
        {
            throw new UndefinedConstException('[const driver] is required to use the [Driver Ability]!');
        }

        # 5.3.42|5.4.5[edited]
        $driver = $driver                 ??
                  $this->config['driver'] ?? 
                  (isset(static::driver['config']) ? Config::get(...explode(':', static::driver['config']))['driver'] : NULL) ?: 
                  static::driver['options'][0];
        
        $this->selectedDriverName = $driver;

        Support::driver(static::driver['options'], $driver);

        if( ! isset(static::driver['namespace']) )
        {
            $this->driver = Singleton::class($driver);
        }
        else
        {
            $this->driver = Singleton::class(suffix(static::driver['namespace'], '\\').$driver.'Driver');
        }

        if( isset(static::driver['construct']) )
        {
            $construct = static::driver['construct'];

            $this->{$construct}();
        }
    }

    /**
     * Select driver
     * 
     * @param string $driver
     * 
     * @return self
     */
    public function driver(String $driver) : self
    {
        return new self($driver);
    }
}