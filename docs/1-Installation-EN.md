[← Requirements](0-Prerequisites-EN.md) | Installation[(中文)](1-Installation-CN.md) | [Home →](../README.md)
***

# Installation
There are ways to install Alibaba Cloud KMS SDK for PHP:

- [As a dependency via Composer](#as-a-dependency-via-composer)
- [Installing by Using the ZIP file](#installing-by-using-the-zip-file)

Before you install ensure your environment is using PHP version 5.5 or later. Learn more about [environment requirements and recommendations](0-Prerequisites-EN.md).

## As a dependency via Composer
Composer is the recommended way to install. Composer is a tool for PHP that manages and installs the dependencies of your project. For more information on how to install Composer, configure autoloading, and follow other best practices for defining dependencies, see [getcomposer.org](https://getcomposer.org).

### Install
If Composer is already [installed globally on your system](https://getcomposer.org/doc/00-intro.md#globally), run the following in the base directory of your project to install Alibaba Cloud KMS SDK for PHP as a dependency:
```bash
composer require alibabacloud/kms
```

Otherwise, download and install Composer (Windows users please download and run [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)):
```bash
curl -sS https://getcomposer.org/installer | php
```

Then type this Composer command to install the latest version of the Alibaba Cloud KMS SDK for PHP as a dependency:
```bash
php -d memory_limit=-1 composer.phar require alibabacloud/kms
```

> Some users may not be able to install due to network problems, you can try to switch the Composer mirror.

### Add autoloader to your PHP scripts
To utilize the Alibaba Cloud KMS SDK for PHP in your scripts, include the autoloader in your scripts, as follows.
```php
<?php

require __DIR__ . '/vendor/autoload.php'; 
```

## Installing by Using the ZIP file
We strongly recommend that you install with Composer, but also provide a ZIP file with all classes and dependencies for users who cannot use Composer.

Download the [.zip file](http://aliyunsdk-pages.alicdn.com/php-sdk/kms.zip), and then extract it into your project at a location you choose. Finally, include the autoloader in your scripts, as follows:


```php
<?php

require __DIR__ . '/vendor/autoload.php'; 
```

***
[← Requirements](0-Prerequisites-EN.md) | Installation[(中文)](1-Installation-CN.md) | [Home →](../README.md)
