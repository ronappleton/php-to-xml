# What is it?

Php to xml is a simple package to allow the conversion of Json strings, Json objects and Php Arrays into valid XML.

The idea for this package is to reduce the building of XML within views. The package should allow for much cleaner code when producing XML to send,
it also bridges a gap in respect to those that like to build in json or by using arrays.

Attributes are supported by adding an array called `attributes` to as a node, populated with the attribute names and values.

## Installation

`composer require ronappleton/php-to-xml`

## Usage

The converter can be configured by using `RonAppleton\PhpToXml\Config` although a default configuration will be used if one is not passed.

To use the converter add a use statement for `RonAppleton\PhpToXml\PhpToXml` and use statically `PhpToXml::convert($array, $config)` where $config is optional.

```
$array = [
    'RootNode' => [
        'SecondaryNode' => [
            'attributes' => [
                'firstAttribute' => 'firstAttributeValue',
                'secondAttribute' => 'secondAttributeValue',
            ],
            'SecondaryChildValueKey' => 'SecondaryChildValue',
            'SecondaryChildValueKey2' => 'SecondaryChildValue2',
        ]
    ]
];
```
```
{
    "RootNode": {
        "SecondaryNode": {
            "attributes": {
                "firstAttribute": "firstAttributeValue",
                "secondAttribute": "secondAttributeValue"
            },
            "SecondaryChildValueKey": "SecondaryChildValue",
            "SecondaryChildValueKey2": "SecondaryChildValue2"
        }
    }
}
```

By default numeric keys are not allowed and will throw an exception, this can be configured using `$config->setPrependNumericKeys(true)`, this will prepend
by default the word `item` to any numeric keys, so 0 becomes item0, 1 becomes item1 and so on. The numerical digits are then removed during conversion thereby
adding multiple same named nodes. The prefix can be changed using `$config->setNumericKeyIndex('name');` where name is the node name you wish to use.

The following methods also exist for configuration.

`setBoolAsString()` to produce true instead of 1 in the xml for eaxmple.

`setNumbersToStrings()` to convert digits to strings.

`setHtmlSpecialCharacters()` to encode strings.

`setStringsAsCdata()` to wrap all strings in CDATA tags.


