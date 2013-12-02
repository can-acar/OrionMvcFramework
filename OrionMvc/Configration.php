<?php
namespace OrionMvc;

class Configration{
	
	
	
	
	private static $_config = false;

    public static function read($key = 'debug')
    {
        Configration::readConfig();
        return isset(self::$_config[$key])?self::$_config[$key]:false;
    }

    public static function write($key,$value = false)
    {
       Configration::readConfig();
        self::set($key,$value);
        return Configration::writeConfig();
    }

    public static function set($key,$value = false)
    {
        if (is_array($key))
        {
            foreach ($key as $var=>$val)
            {
                self::$_config[$var] = $val;
            }
        }
        else
        {
            self::$_config[$key] = $value;
        }
    }

    public static function delete($key)
    {
        Configure::readConfig();
        unset(self::$_config[$key]);
        Configure::writeConfig();
    }

    public static function readConfig($reset = false)
    {
        if (!self::$_config || $reset)
        {
            include(CONFIG_FILE);
            self::$_config = $config;
        }
        return self::$_config;
    }

    public static function writeConfig()
    {
        $fileData = "";

        foreach (self::$_config as $key=>$value)
        $fileData.= (!empty($fileData)?',':'')."\n'$key' => safeDecode('".safeEncode($value)."')";

        $fileData = '<?php $config = array('.$fileData.");";

        $fp =fopen(CONFIG_FILE,"w");
        if (!$fp)
        {
            return false;
        }
        fwrite($fp,$fileData);
        fclose($fp);
        return true;
    }
    
    function __get($var)
    {
        return Configure::read($var);
    }
}
?>