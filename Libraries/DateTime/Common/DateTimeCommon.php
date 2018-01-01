<?php namespace ZN\DateTime;

use Config;
use ZN\DateTime\Carbon\Carbon;
use ZN\DataTypes\Arrays;

class DateTimeCommon extends Carbon
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Confi
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $config;

    //--------------------------------------------------------------------------------------------------------
    // Class Name
    //--------------------------------------------------------------------------------------------------------
    //
    // Sınıf uzantısı
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $className = 'ZN\DateTime\Date';

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->config = Config::get('DateTime');

        setlocale(LC_ALL, $this->config['setLocale']['charset'], $this->config['setLocale']['language']);
    }

    //--------------------------------------------------------------------------------------------------------
    // Compare
    //--------------------------------------------------------------------------------------------------------
    //
    // Tarihleri karşılaştırmak için kullanılır.
    //
    // @param  string clock
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function compare(String $value1, String $condition, String $value2) : Bool
    {
        $value1 = $this->toNumeric($value1);
        $value2 = $this->toNumeric($value2);
        
        return version_compare($value1, $value2, $condition);
    }

    //--------------------------------------------------------------------------------------------------------
    // To Numeric
    //--------------------------------------------------------------------------------------------------------
    //
    // Tarihi sayısal veriye çevirir.
    //
    // @param  string dateFormat
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function toNumeric(String $dateFormat, Int $now = NULL) : Int
    {
        if( $now === NULL )
        {
            $now = time();
        }

        return strtotime($this->_datetime($dateFormat), $now);
    }

    //--------------------------------------------------------------------------------------------------------
    // To Readble -> 5.3.5[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // Veriyi okunabilir tarihe çevirir.
    //
    // @param  string dateFormat
    // @return numeric
    //
    //--------------------------------------------------------------------------------------------------------
    public function toReadable(Int $time, String $dateFormat = 'Y-m-d H:i:s') : String
    {
        return $this->_datetime($dateFormat, $time);
    }

    //--------------------------------------------------------------------------------------------------------
    // Calculate -> 5.3.5[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // Tarihler arasında hesaplama yapmak için kullanılır.
    //
    // @param  string input
    // @param  string calculate
    // @param  string output
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function calculate(String $input, String $calculate, String $output = 'Y-m-d') : String
    {
        if( ! preg_match('/^[0-9]/', $input) )
        {
            $input = $this->_datetime($input);
        }

        // 5.3.5[added]
        if( $this->_classname() === 'ZN\DateTime\Time' && $output === 'Y-m-d' )
        {
            $output = '{Hour}:{minute}:{second}';
        }

        $output = $this->_convert($output);

        return $this->_datetime($output, strtotime($calculate, strtotime($input)));
    }

    //--------------------------------------------------------------------------------------------------------
    // Set
    //--------------------------------------------------------------------------------------------------------
    //
    // Tarih ve saat ayarlamaları yapmak için kullanılır.
    //
    // @param  string exp
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function set(String $exp) : String
    {
        return $this->_datetime($exp);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Convert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $config
    // @return string $change
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _convert($change)
    {
        $config = $this->_chartype();

        $chars  = Properties::${$config};

        $chars  = Arrays::multikey($chars);

        return str_ireplace(array_keys($chars), array_values($chars), $change);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Class Name
    //--------------------------------------------------------------------------------------------------------
    //
    // Sınıf adını verir.
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _classname()
    {
        return $className = str_ireplace(INTERNAL_ACCESS, '', get_called_class());
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Date Time
    //--------------------------------------------------------------------------------------------------------
    //
    // Kütüphane türüne göre çevrim yapar.
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _datetime($format, $timestamp = NULL)
    {
        if( $timestamp === NULL )
        {
            $timestamp = time();
        }

        $className = $this->_classname();

        $func = $className === $this->className ? 'date' : 'strftime';

        return $func($this->_convert($format), $timestamp);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Char Type
    //--------------------------------------------------------------------------------------------------------
    //
    // Sınıf türüne göre karaketer türünü verir.
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _chartype()
    {
        $className = $this->_classname();

        return $className === $this->className ? 'setDateFormatChars' : 'setTimeFormatChars';
    }
}
