English | [简体中文](./README-CN.md)


<p align="center"><img src="./src/AlibabaCloud.svg"></p>
<p align="center">
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/v/unstable" alt="Latest Unstable Version"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/composerlock" alt="composer.lock"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/license" alt="License"></a>
<br/>
<a href="https://codecov.io/gh/aliyun/php-kms-sdk"><img src="https://codecov.io/gh/aliyun/php-kms-sdk/branch/master/graph/badge.svg" alt="codecov"></a>
<a href="https://scrutinizer-ci.com/g/aliyun/php-kms-sdk"><img src="https://scrutinizer-ci.com/g/aliyun/php-kms-sdk/badges/quality-score.png" alt="Scrutinizer Code Quality"></a>
<a href="https://travis-ci.org/aliyun/php-kms-sdk"><img src="https://travis-ci.org/aliyun/php-kms-sdk.svg?branch=master" alt="Travis Build Status"></a>
<a href="https://ci.appveyor.com/project/songshenzong/php-kms-sdk/branch/master"><img src="https://ci.appveyor.com/api/projects/status/ttsf2ugc88dqyn1o/branch/master?svg=true" alt="Appveyor Build Status"></a>
<a href="https://scrutinizer-ci.com/code-intelligence"><img src="https://scrutinizer-ci.com/g/aliyun/php-kms-sdk/badges/code-intelligence.svg" alt="Code Intelligence Status"></a>
</p>


## About
**Alibaba Cloud KMS SDK for PHP** Supports PHP developers using Alibaba Cloud Key Management Service.


## Getting Started

1. **Alibaba Cloud Account** – Before you begin, you need to sign up for an Alibaba Cloud account and retrieve your [Credentials](https://usercenter.console.aliyun.com/#/manage/ak).
1. **Requirements** – Your system will need to meet the [Requirements](docs/0-Requirements-EN.md), including having **PHP >= 5.5**. We highly recommend having it compiled with the cURL extension and cURL 7.16.2+.
1. **Install Dependency** – If Composer is installed globally on your system, you can run the following in the base directory of your project to add the Alibaba Cloud KMS SDK for PHP as a dependency:
   ```
   composer require alibabacloud/kms
   ```
   Please see the
   [Installation](docs/1-Installation-EN.md) for more detailed information about installing through Composer and other means.


## Setting up the client
Please pass in your `accessKeyId`, `accessKeySecret`, `endpoint`, [View the list of KMS endpoints](https://developer.aliyun.com/endpoints#service_kms).

```php
<?php

use AlibabaCloud\Kms\V20160120\Kms;

$client = new Kms('accessKeyId', 'accessKeySecret', 'kms.cn-hangzhou.aliyuncs.com');
```


## Set request options
Please refer to [Guzzle Request Options][guzzle-docs].

```php
<?php

$options = [];

```


## Cancel Key Deletion
Cancels the deletion of a CMK. When this operation is successful, the CMK is set to the Enabled state. [API Reference](https://www.alibabacloud.com/help/doc-detail/44197.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->cancelKeyDeletion(
        [
            'KeyId' => 'key_id',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Create Alias
Creates a display name for a CMK. [API Reference](https://www.alibabacloud.com/help/doc-detail/68624.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->createAlias(
        [
            'AliasName' => 'alias/1234',
            'KeyId'     => 'key_id',
        ]
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Create Key
Creates a customer master key (CMK). [API Reference](https://www.alibabacloud.com/help/doc-detail/28947.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->createKey(
        [
            'Origin'      => 'Aliyun_KMS',
            'Description' => 'test key',
            'KeyUsage'    => 'ENCRYPT/DECRYPT',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}
```


## Decrypt
Decrypts ciphertext. Ciphertext is plaintext that has been previously encrypted by using any of the following operations. [API Reference](https://www.alibabacloud.com/help/doc-detail/28950.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->decrypt(
        [
            'CiphertextBlob'    => 'CiphertextBlob',
            'EncryptionContext' => json_encode(['k' => 'v']),
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}
```


## Delete Alias
Deletes the specified alias. [API Reference](https://www.alibabacloud.com/help/doc-detail/68626.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->deleteAlias(
        [
            'AliasName' => 'alias/12345',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}


```

## Delete Key Material
Deletes the imported key material. [API Reference](https://www.alibabacloud.com/help/doc-detail/68623.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->deleteKeyMaterial(
        [
            'KeyId' => 'id',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Describe Key
Returns detailed information about the specified CMK. [API Reference](https://www.alibabacloud.com/help/doc-detail/28952.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->describeKey(
        [
            'KeyId' => 'id',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Describe Regions
Returns available regions for the specified account. [API Reference](https://www.alibabacloud.com/help/doc-detail/54560.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->describeRegions();
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Disable Key
Sets the state of a CMK to disabled, thereby preventing its use for cryptographic operations. The ciphertext encrypted using the CMK cannot be decrypted until the CMK is enabled again. [API Reference](https://www.alibabacloud.com/help/doc-detail/35151.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->disableKey(
        [
            'KeyId' => 'id',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Enable Key
Sets the state of the specified CMK to Enabled, thereby permitting its use for cryptographic operations. [API Reference](https://www.alibabacloud.com/help/doc-detail/35150.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->enableKey(
        [
            'KeyId' => 'id',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Encrypt
Encrypts plaintext into ciphertext by using a CMK. [API Reference](https://www.alibabacloud.com/help/doc-detail/28949.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->encrypt(
        [
            'KeyId'             => 'id',
            'Plaintext'         => 'text',
            'EncryptionContext' => json_encode(['k' => 'v']),
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Generate Data Key
Returns a data encryption key that you can use in your application to encrypt data locally. [API Reference](https://www.alibabacloud.com/help/doc-detail/28948.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->generateDataKey(
        [
            'KeyId' => 'id',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Get Parameters for Import
Returns the items you need in order to import key material into KMS from your existing key management infrastructure. The returned items are used in the subsequent ImportKeyMaterial request. [API Reference](https://www.alibabacloud.com/help/doc-detail/68621.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->getParametersForImport(
        [
            'KeyId'             => 'external_key_id',
            'WrappingAlgorithm' => 'RSAES_OAEP_SHA_256',
            'WrappingKeySpec'   => 'RSA_2048',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Import Key Material
Imports key material to an existing KMS CMK that was created without key material. [API Reference](https://www.alibabacloud.com/help/doc-detail/68622.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->importKeyMaterial(
        [
            'KeyId'                 => 'external_key_id',
            'EncryptedKeyMaterial'  => base64_encode('test'),
            'ImportToken'           => 'import_token',
            'KeyMaterialExpireUnix' => time() + 3600,
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## List Aliases
Gets a list of all aliases in the caller’s account and region. [API Reference](https://www.alibabacloud.com/help/doc-detail/68627.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->listAliases(
        [
            'PageNumber' => 1,
            'PageSize'   => 100,
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## List Aliases by KeyId
Lists all aliases associated with the CMK. [API Reference](https://www.alibabacloud.com/help/doc-detail/68628.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->listAliasesByKeyId(
        [
            'KeyId'      => 'key_id',
            'PageNumber' => 1,
            'PageSize'   => 100,
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## List Keys
Returns a list of all CMKs in the caller’s account and region. [API Reference](https://www.alibabacloud.com/help/doc-detail/28951.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->listKeys(
        [
            'PageNumber' => 1,
            'PageSize'   => 100,
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Schedule Key Deletion
Schedules the deletion of a CMK. [API Reference](https://www.alibabacloud.com/help/doc-detail/44196.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->scheduleKeyDeletion(
        [
            'KeyId'               => 'key_id',
            'PendingWindowInDays' => 7,
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## Update Alias
Associates an existing alias with a different CMK. [API Reference](https://www.alibabacloud.com/help/doc-detail/68625.htm)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->updateAlias(
        [
            'KeyId'     => 'key_id',
            'AliasName' => 'alias/12345',
        ],
        $options
    );
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## References
* [OpenAPI Explorer][open-api]
* [Packagist][packagist]
* [Composer][composer]
* [Guzzle Documentation][guzzle-docs]
* [Latest Release][latest-release]


[open-api]: https://api.aliyun.com
[latest-release]: https://github.com/aliyun/php-kms-sdk
[guzzle-docs]: https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html
[composer]: http://getcomposer.org
[packagist]: https://packagist.org/packages/alibabacloud/kms
[client]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md#alibaba-cloud-client-for-php
[clients]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/2-Client-EN.md
[request]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/3-Request-EN.md
[result]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/docs/4-Result-EN.md
[ak]: https://usercenter.console.aliyun.com/?spm=5176.doc52740.2.3.QKZk8w#/manage/ak
[home]: https://home.console.aliyun.com/?spm=5176.doc52740.2.4.QKZk8w
[cURL]: http://php.net/manual/en/book.curl.php
[OPCache]: http://php.net/manual/en/book.opcache.php
[xdebug]: http://xdebug.org
[OpenSSL]: http://php.net/manual/en/book.openssl.php
[aliyun]: https://www.aliyun.com
[alibabacloud]: https://www.alibabacloud.com
