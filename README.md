# Utils for HOB micro services 

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/99f5d9c0-4be8-4aa2-975c-f9859785c498/big.png)](https://insight.sensiolabs.com/projects/99f5d9c0-4be8-4aa2-975c-f9859785c498)

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
