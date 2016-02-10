# Utils for HOB micro services 

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/7bd27a8a-2f53-4f54-b96b-1ab4e7aadb93/big.png)](https://insight.sensiolabs.com/projects/7bd27a8a-2f53-4f54-b96b-1ab4e7aadb93)

## Installation
To install this bundle, run the command below and you will get the latest version.

``` bash
composer require hob/common-bundle
```

To use the newest (maybe unstable) version please add following into your composer.json:

``` json
{
    "require": {
        "hob/common-bundle": "dev-master"
    }
}
```


## Usage
Load bundle in AppKernel.php:
``` php
new HOB\CommonBundle\CommonBundle()
```

Configuration in config.yml:
``` yaml
common_bundle: ~
```
