<?php

namespace RonAppleton\PhpToXml;

class Config
{
    /**
     * @var bool
     */
    private $boolAsString = false;

    /**
     * @var bool
     */
    private $prependNumericKeys = false;

    /**
     * @var string
     */
    private $numericKeyPrefix = 'item';

    /**
     * @var bool
     */
    private $stringsAsCdata = false;

    /**
     * @var bool
     */
    private $numbersToStrings = false;

    /**
     * @var bool
     */
    private $htmlSpecialCharacters = true;

    /**
     * @return bool
     */
    public function isBoolAsString()
    {
        return $this->boolAsString;
    }

    /**
     * @param bool $boolAsString
     * @return Config
     */
    public function setBoolAsString($boolAsString)
    {
        $this->boolAsString = $boolAsString;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPrependNumericKeys()
    {
        return $this->prependNumericKeys;
    }

    /**
     * @param bool $prependNumericKeys
     * @return Config
     */
    public function setPrependNumericKeys($prependNumericKeys)
    {
        $this->prependNumericKeys = $prependNumericKeys;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumericKeyPrefix()
    {
        return $this->numericKeyPrefix;
    }

    /**
     * @param string $numericKeyPrefix
     * @return Config
     */
    public function setNumericKeyPrefix($numericKeyPrefix)
    {
        $this->numericKeyPrefix = $numericKeyPrefix;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStringsAsCdata()
    {
        return $this->stringsAsCdata;
    }

    /**
     * @param bool $stringsAsCdata
     * @return Config
     */
    public function setStringsAsCdata($stringsAsCdata)
    {
        $this->stringsAsCdata = $stringsAsCdata;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNumbersToStrings()
    {
        return $this->numbersToStrings;
    }

    /**
     * @param bool $numbersToStrings
     * @return Config
     */
    public function setNumbersToStrings($numbersToStrings)
    {
        $this->numbersToStrings = $numbersToStrings;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHtmlSpecialCharacters()
    {
        return $this->htmlSpecialCharacters;
    }

    /**
     * @param bool $htmlSpecialCharacters
     * @return Config
     */
    public function setHtmlSpecialCharacters($htmlSpecialCharacters)
    {
        $this->htmlSpecialCharacters = $htmlSpecialCharacters;
        return $this;
    }
}
