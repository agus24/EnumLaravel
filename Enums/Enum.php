<?php
namespace App\Enums;

class Enum 
{
    const DATA = [];

    /**
     * GET DISPLAY OF ENUM
     *
     * @param int $key
     * @return String
     */
    public static function DISPLAY(int $key): string
    {
        if (!array_key_exists($key, static::DATA)) 
        {
            $class = get_called_class();
            throw new EnumNotFoundException("Key {$key} not found in {$class}.");
        }
        return (string) static::DATA[$key];
    }

    /**
     * Get value of enum
     *
     * @param string $value
     * @return integer
     */
    public static function VALUE(string $value, Bool $caseSensitive = false): int
    {
        $data = static::DATA;
        if($caseSensitive) 
        {
            $data = array_map('strtolower', $data);
            $value = strtolower($value);
        }

        $result = array_search($value, $data);

        if(!is_integer($result)) 
        {
            $class = get_called_class();
            throw new EnumNotFoundException("Value `{$value}` not found in {$class}.");
        }
        return (int) $result;
    }
}