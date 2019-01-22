[English](./README.md) | 简体中文


<p align="center"><img src="./src/Aliyun.svg"></p>
<p align="center">
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/v/stable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/v/unstable" alt="Latest Unstable Version"></a>
<a href="https://packagist.org/packages/alibabacloud/kms"><img src="https://poser.pugx.org/alibabacloud/kms/license" alt="License"></a>
<br/>
<a href="https://scrutinizer-ci.com/g/aliyun/php-kms-sdk"><img src="https://scrutinizer-ci.com/g/aliyun/php-kms-sdk/badges/quality-score.png" alt="Scrutinizer Code Quality"></a>
<a href="https://travis-ci.org/aliyun/php-kms-sdk"><img src="https://travis-ci.org/aliyun/php-kms-sdk.svg?branch=master" alt="Travis Build Status"></a>
<a href="https://ci.appveyor.com/project/songshenzong/php-kms-sdk/branch/master"><img src="https://ci.appveyor.com/api/projects/status/ttsf2ugc88dqyn1o/branch/master?svg=true" alt="Appveyor Build Status"></a>
<a href="https://codecov.io/gh/aliyun/php-kms-sdk"><img src="https://codecov.io/gh/aliyun/php-kms-sdk/branch/master/graph/badge.svg" alt="codecov"></a>
<a href="https://scrutinizer-ci.com/code-intelligence"><img src="https://scrutinizer-ci.com/g/aliyun/php-kms-sdk/badges/code-intelligence.svg" alt="Code Intelligence Status"></a>
</p> 


## 关于
**Alibaba Cloud KMS SDK for PHP** 支持 PHP 开发者使用阿里云密钥服务。


## 要求
- 您必须使用 PHP 5.5.0 或更高版本。


## 建议
- 使用 [Composer][composer] 并优化自动加载 `composer dump-autoload --optimize`
- 安装 [cURL][cURL] 7.16.2 或更高版本
- 使用 [OPCache][OPCache]
- 生产环境中不要使用 [Xdebug][xdebug]


## 安装
1. 下载并安装 Composer（Windows 用户请下载并运行 [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)）
```bash
curl -sS https://getcomposer.org/installer | php
```

2. 执行 Composer 命令安装 Alibaba Cloud KMS SDK for PHP 的最新稳定版本
```bash
php -d memory_limit=-1 composer.phar require alibabacloud/kms
```

3. 在代码中引入 Composer 自动加载工具
```php
<?php

require __DIR__ . '/vendor/autoload.php';
```


## 设置客户端
请传入您的 `accessKeyId`、 `accessKeySecret`、 `endpoint`，[KMS 可用的 Endpoint 列表](https://developer.aliyun.com/endpoints#service_kms)。

```php
<?php

use AlibabaCloud\Kms\V20160120\Kms;

$client = new Kms('accessKeyId', 'accessKeySecret', 'kms.cn-hangzhou.aliyuncs.com');
```


## 设置请求选项
请参考 [请求选项 Guzzle中文文档][guzzle-docs]

```php
<?php

$options = [];

```


## 撤销密钥删除
撤销密钥删除。当密钥删除的申请撤销成功以后，密钥会处于启用状态。[接口和参数说明](https://help.aliyun.com/document_detail/44197.html)

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


## 给主密钥创建别名
给主密钥（CMK）创建一个别名。[接口和参数说明](https://help.aliyun.com/document_detail/68624.html)

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


## 创建主密钥
创建一个主密钥。[接口和参数说明](https://help.aliyun.com/document_detail/28947.html)

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


## 解密
解密 CiphertextBlob 中的密文。[接口和参数说明](https://help.aliyun.com/document_detail/28950.html)

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


## 删除别名
删除别名。[接口和参数说明](https://help.aliyun.com/document_detail/68626.html)

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


## 删除已导入的密钥材料
删除已导入的密钥材料。[接口和参数说明](https://help.aliyun.com/document_detail/68623.html)

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


## 返回指定主密钥的相关信息
返回指定主密钥（CMK）的相关信息。[接口和参数说明](https://help.aliyun.com/document_detail/28952.html)

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


## 查询当前账户的可用地域列表
查询当前账户的可用地域列表。[接口和参数说明](https://help.aliyun.com/document_detail/54560.html)

```php
<?php

use GuzzleHttp\Exception\GuzzleException;

try {
    $result = $client->describeRegions();
} catch (GuzzleException $e) {
    echo $e->getMessage();
}

```


## 禁用指定主密钥
将一个指定的主密钥（CMK）标记为禁用状态。[接口和参数说明](https://help.aliyun.com/document_detail/35151.html)

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


## 启用指定主密钥
将一个指定的CMK标记为启用状态。[接口和参数说明](https://help.aliyun.com/document_detail/35150.html)

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



## 通过使用主密钥将明文加密为密文
通过使用主密钥（CMK）将明文加密为密文。[接口和参数说明](https://help.aliyun.com/document_detail/28949.html)

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


## 生成密钥
生成一个密钥。[接口和参数说明](https://help.aliyun.com/document_detail/28948.html)

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


## 获取导入主密钥材料的参数
获取导入主密钥（CMK）材料的参数。[接口和参数说明](https://help.aliyun.com/document_detail/68621.html)

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


## 将密钥材料导入符合上述描述的CMK中
将密钥材料导入符合上述描述的CMK中。[接口和参数说明](https://help.aliyun.com/document_detail/68622.html)

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


## 返回当前用户在当前区域的所有别名
返回当前用户在当前区域的所有别名。[接口和参数说明](https://help.aliyun.com/document_detail/68627.html)

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


## 列出与指定主密钥对应的所有别名
列出与指定主密钥（CMK）对应的所有别名。[接口和参数说明](https://help.aliyun.com/document_detail/68628.html)

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


## 返回在调用区域的所有的主密钥
返回调用者在调用区域的所有的主密钥ID。[接口和参数说明](https://help.aliyun.com/document_detail/28951.html)

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



## 申请删除指定主密钥
申请删除一个指定的主密钥。[接口和参数说明](https://help.aliyun.com/document_detail/44196.html)

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


## 更新已存在的别名所代表的主密钥
更新已存在的别名所代表的主密钥。[接口和参数说明](https://help.aliyun.com/document_detail/68625.html)

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


## 相关
* [OpenAPI Explorer][open-api]
* [Packagist][packagist]
* [Composer][composer]
* [Guzzle中文文档][guzzle-docs]
* [Latest Release][latest-release]


[open-api]: https://api.aliyun.com
[latest-release]: https://github.com/aliyun/php-kms-sdk
[guzzle-docs]: https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html
[composer]: http://getcomposer.org
[packagist]: https://packagist.org/packages/alibabacloud/kms
[client]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md#alibaba-cloud-client-for-php
[clients]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md#%E5%AE%A2%E6%88%B7%E7%AB%AF
[request]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md#%E8%AF%B7%E6%B1%82
[result]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md#%E7%BB%93%E6%9E%9C
[ak]: https://usercenter.console.aliyun.com/?spm=5176.doc52740.2.3.QKZk8w#/manage/ak
[home]: https://home.console.aliyun.com/?spm=5176.doc52740.2.4.QKZk8w
[cURL]: http://php.net/manual/en/book.curl.php
[OPCache]: http://php.net/manual/en/book.opcache.php
[xdebug]: http://xdebug.org
[OpenSSL]: http://php.net/manual/en/book.openssl.php
[aliyun]: https://www.aliyun.com
[alibabacloud]: https://www.alibabacloud.com
[request]: https://github.com/aliyun/openapi-sdk-php-client/blob/master/README-CN.md#%E8%AF%B7%E6%B1%82
