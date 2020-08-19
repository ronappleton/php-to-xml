<?php

namespace RonAppleton\PhpToXml;

use RuntimeException;
use SimpleXMLElement;

class PhpToXml
{
    /**
     * Convert an array, json object or json string to xml.
     *
     * @param $object
     * @param $config
     * @return string
     */
    public static function convert($object, Config $config = null)
    {
        if ($config === null) {
            $config = new Config();
        }

        $array = static::getArray($object);

        if ($array === null) {
            throw new RuntimeException(
                'Unable to convert object type for conversion [' . getType($object) . ']'
            );
        }

        static::validateKeys($array, $config);

        return static::makeXml($array, $config);
    }

    /**
     * Check for numeric keys and if required replace them.
     *
     * @param array $array
     * @param Config $config
     *
     * @throws RuntimeException
     */
    private static function validateKeys(array &$array, Config $config)
    {
        foreach ($array as $key => &$value) {
            if (is_numeric($key)) {
                if ($config->isPrependNumericKeys()) {
                    $newKey = $config->getNumericKeyPrefix() . $key;
                    $array[$newKey] = $value;
                    unset($array[$key]);
                } else {
                    throw new RuntimeException(
                        'Array keys cannot be numeric, use a key name appended with a digit,
                     like Address1, Address2, the numbers will be removed.'
                    );
                }
            }
            if (is_array($value)) {
                static::validateKeys($value, $config);
            }
        }
    }


    /**
     * Recursively Convert our array to xml.
     *
     * @param array $array
     * @param Config $config
     * @param null $xml
     *
     * @return mixed
     */
    private static function makeXml(array $array, Config $config = null, &$xml = null)
    {
        if ($xml === null) {
            $rootElement = key($array);
            $array = $array[$rootElement];
            $xml = new SimpleXMLElement("<{$rootElement}/>");
        }

        foreach($array as $key => $value ) {
            if ($key === 'attributes' && is_array($value)) {
                foreach($value as $attributeKey => $attributeValue) {
                    $attributeValue = static::formatValue($attributeValue, $config);
                    $xml->addAttribute($attributeKey, $attributeValue);
                }
            } elseif(is_array($value)) {
                $key = preg_replace('/\d+/u', '', $key);
                $subNode = $xml->addChild($key);
                static::makeXml($value, $config, $subNode);
            } else {
                $value = static::formatValue($value, $config);
                $xml->addChild("$key", $value);
            }
        }

        return str_replace(['&lt;', '&gt;'], ['<', '>'], $xml->asXML());
    }

    /**
     * Get array from given object.
     *
     * @param $object
     * @param string $type
     *
     * @return array|null
     */
    private static function getArray($object)
    {
        $type = gettype($object);

        if ($type === 'object') {
            return json_decode(json_encode($object), true);
        }

        if ($type === 'string') {
            return json_decode($object, true);
        }

        return gettype($object) === 'array' ? $object : null;
    }

    /**
     * Format value based on configuration.
     *
     * @param $value
     * @param Config $config
     *
     * @return string
     */
    private static function formatValue($value, Config $config)
    {
        if ($config->isBoolAsString() && is_bool($value)) {
            $value = $value ? 'true' : 'false';
        }

        if ($config->isNumbersToStrings() && is_numeric($value)) {
            $value = "$value";
        }

        if ($config->isHtmlSpecialCharacters() && is_string($value)) {
            $value = htmlspecialchars($value);
        }

        if ($config->isStringsAsCdata() && is_string($value)) {
            $value = "<![CDATA[{$value}]]>";
        }

        return $value;
    }
}
