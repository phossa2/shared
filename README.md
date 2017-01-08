# phossa2/shared
[![Build Status](https://travis-ci.org/phossa2/shared.svg?branch=master)](https://travis-ci.org/phossa2/shared)
[![Code Quality](https://scrutinizer-ci.com/g/phossa2/shared/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phossa2/shared/)
[![Code Climate](https://codeclimate.com/github/phossa2/shared/badges/gpa.svg)](https://codeclimate.com/github/phossa2/shared)
[![PHP 7 ready](http://php7ready.timesplinter.ch/phossa2/shared/master/badge.svg)](https://travis-ci.org/phossa2/shared)
[![HHVM](https://img.shields.io/hhvm/phossa2/shared.svg?style=flat)](http://hhvm.h4cc.de/package/phossa2/shared)
[![Latest Stable Version](https://img.shields.io/packagist/vpre/phossa2/shared.svg?style=flat)](https://packagist.org/packages/phossa2/shared)
[![License](https://img.shields.io/:license-mit-blue.svg)](http://mit-license.org/)

**phossa2/shared** is the shared library for other phossa2 libraries.

It requires PHP 5.4, supports PHP 7.0+ and HHVM. It is compliant with
[PSR-1][PSR-1], [PSR-2][PSR-2], [PSR-4][PSR-4].

[PSR-1]: http://www.php-fig.org/psr/psr-1/ "PSR-1: Basic Coding Standard"
[PSR-2]: http://www.php-fig.org/psr/psr-2/ "PSR-2: Coding Style Guide"
[PSR-4]: http://www.php-fig.org/psr/psr-4/ "PSR-4: Autoloader"

Installation
---
Install via the `composer` utility.

```
composer require "phossa2/shared=2.*"
```

or add the following lines to your `composer.json`

```json
{
    "require": {
       "phossa2/shared": "2.*"
    }
}
```

Features
---

- **Exception**

  All phossa2 exceptions implement `Phossa2\Shared\Exception\ExceptionInterface`.

  To implment phossa2 exception interface,

  ```php
  <?php
  namespace Phossa2\Cache\Exception;

  use Phossa2\Shared\Exception\ExceptionInterface;

  class BadMethodCallException extends \BadMethodCallException implements ExceptionInterface
  {
  }
  ```

- **Message**

  `Phossa2\Shared\Message\Message` class is the base class for all message
  classes in all phossa2 packages.

  - Define package related `Message` class

    Message class is used to convert message code into human-readable messages,
    and *MUST* define its own property `$messages`.

    ```php
    <?php
    namespace Phossa2\Cache\Message;

    use Phossa2\Shared\Message\Message;

    class CacheMessage extends Message
    {
        // use current year_month_date_hour_minute
        const CACHE_MESSAGE     = 1512220901;

        // driver failed
        const CACHE_DRIVER_FAIL = 1512220902;

        protected static $messages = [
            self::CACHE_MESSAGE      => 'cache %s',
            self::CACHE_DRIVER_FAILT => 'cache driver %s failed',
        ];
    }
    ```

  - Using message class

    Usually only `Message::get()` and `Message::CONST_VALUE` are used.

    ```php
    use Phossa2\Cache\Message\CaseMessage;
    ...
    // throw exception
    throw new \RuntimeException(
        CacheMessage::get(CacheMessage::CACHE_DRIVER_FAIL, get_class($driver)),
        CacheMessage::CACHE_DRIVER_FAIL
    );
    ```

  - Message loader

    Used for loading different code to message mapping such as language files.

    ```php
    namespace Phossa2\Cache;

    use Phossa2\Cache\Message\CaseMessage;
    use Phossa2\Shared\Message\Loader\LanguageLoader;

    // set language to 'zh_CN'
    $langLoader = new LanguageLoader('zh_CN');

    // will load `CacheMessage.zh_CN.php` in the same dir as `CacheMessage.php`
    CacheMessage::setLoader($langLoader);

    // print message in chinese
    echo CacheMessage::get(
        CacheMessage::CACHE_MESSAGE, get_class($object)
    );
    ```

  - Message formatter

    Used for formatting messages for different devices such as HTML page.
    Formatter is shared among all siblings of `Phossa2\Shared\Message\Message`

    ```php
    namespace Phossa2\Cache;

    use Phossa2\Cache\Message\CaseMessage;
    use Phossa2\Shared\Message\Formatter\HtmlFormatter;

    // format message as HTML
    $formatter = new HtmlFormatter();

    CacheMessage::setFormatter($formatter);

    // print as HTML
    echo CacheMessage::get(
        CacheMessage::CACHE_MESSAGE, get_class($object)
    );
    ```

- **Utility**

  Some useful utilities here.

  - `ClassNameTrait`

    PHP 5.4 has `::class` feature missing. `ClassNameTrait` provides three
    static methods `::getClassName()`, `::getShortName()`, `::getNameSpace()`

  - `StaticAbstract`

    Used to be extended by other **STATIC** classes.

    ```php
    <?php
    namespace Phossa2\MyPackage;

    class MyStaticClass extends \Phossa2\Shared\Base\StaticAbstract
    {
        ...
    }
    ```
- **Trait*

  Some useful traits in the `Aware/` directory

  - `TagAwareTrait` adding tag support

- **Interface**

  Some useful interfaces are in the `Contract/` directory.

  - `ArrayableInterface`

- Support PHP 5.4+, PHP 7.0+, HHVM

- PHP7 ready for return type declarations and argument type declarations.

- PSR-1, PSR-2, PSR-4 compliant.

- Decoupled packages can be used seperately without the framework.

Change log
---

Please see [CHANGELOG](CHANGELOG.md) from more information.

Testing
---

```bash
$ composer test
```

Contributing
---

Please see [CONTRIBUTE](CONTRIBUTE.md) for more information.

Dependencies
---

- PHP >= 5.4.0

License
---

[MIT License](http://mit-license.org/)
