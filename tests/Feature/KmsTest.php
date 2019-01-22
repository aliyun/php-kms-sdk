<?php

namespace AlibabaCloud\Kms\Tests\Feature;

use AlibabaCloud\Kms\V20160120\Kms;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

/**
 * Class KmsTest
 *
 * @package AlibabaCloud\Kms\Tests\Feature
 */
class KmsTest extends TestCase
{
    /**
     * @var Kms
     */
    protected $client;

    /**
     * @var array
     */
    protected $runtime = [
        'connect_timeout' => 15,
        'timeout'         => 20,
    ];

    /**
     * @var string
     */
    protected static $keyId;

    /**
     * @var string
     */
    protected static $keyIdExternal;

    /**
     * @throws GuzzleException
     */
    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        self::deleteKeys(1);
        self::deleteKeys(2);
    }

    public function setUp()
    {
        parent::setUp();
        $this->client = new Kms(
            getenv('ACCESS_KEY_ID'),
            getenv('ACCESS_KEY_SECRET'),
            getenv('ENDPOINT')
        );
    }

    /**
     * @throws GuzzleException
     */
    public function testDescribeRegions()
    {
        $result = $this->client->describeRegions([], $this->runtime);
        self::assertArrayHasKey('Regions', $result);
    }

    /**
     * @throws GuzzleException
     */
    public function testCreateKey()
    {
        if (self::$keyId !== null) {
            return self::$keyId;
        }

        $result = $this->client->createKey(
            [
                'Origin'      => 'Aliyun_KMS',
                'Description' => 'unit test create key ' . time(),
                'KeyUsage'    => 'ENCRYPT/DECRYPT',
            ],
            $this->runtime
        );

        if ($result['Code'] === 'Rejected.LimitExceeded') {
            self::$keyId = getenv('KEY_ID');
        } else {
            self::assertArrayHasKey('KeyMetadata', $result);
            self::$keyId = $result['KeyMetadata']['KeyId'];
        }
    }

    /**
     * @throws GuzzleException
     */
    public function testCreateKeyExternal()
    {
        if (self::$keyIdExternal !== null) {
            return self::$keyIdExternal;
        }

        $result = $this->client->createKey(
            [
                'Origin'      => 'EXTERNAL',
                'Description' => 'unit test create key ' . time(),
                'KeyUsage'    => 'ENCRYPT/DECRYPT',
            ],
            $this->runtime
        );
        if ($result['Code'] === 'Rejected.LimitExceeded') {
            self::$keyIdExternal = getenv('EXTERNAL_KEY_ID');
        } else {
            self::assertArrayHasKey('KeyMetadata', $result);
            self::$keyIdExternal = $result['KeyMetadata']['KeyId'];
        }
    }

    /**
     * @throws GuzzleException
     */
    public function testListKeys()
    {
        $list = $this->client->listKeys(
            [
                'PageNumber' => 1,
                'PageSize'   => 1,
            ],
            $this->runtime
        );

        self::assertArrayHasKey('Keys', $list);
    }

    /**
     * @depends testCreateKey
     * @throws GuzzleException
     */
    public function testDescribeKey()
    {
        $result = $this->client->describeKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );
        self::assertArrayHasKey('KeyMetadata', $result);
    }

    /**
     * @depends testCreateKey
     * @throws GuzzleException
     */
    public function testEncrypt()
    {
        $result = $this->client->encrypt(
            [
                'KeyId'             => self::$keyId,
                'Plaintext'         => 'text',
                'EncryptionContext' => json_encode(['k' => 'v']),
            ],
            $this->runtime
        );
        self::assertArrayHasKey('CiphertextBlob', $result);
    }

    /**
     * @throws GuzzleException
     */
    public function testDecrypt()
    {
        $result = $this->client->decrypt(
            [
                'CiphertextBlob'    => getenv('CIPHER_TEXT_BLOB'),
                'EncryptionContext' => json_encode(['k' => 'v']),
            ],
            $this->runtime
        );

        self::assertArrayHasKey('Plaintext', $result);
    }

    /**
     * @depends testCreateKey
     * @throws GuzzleException
     */
    public function testDisableKey()
    {
        $this->client->disableKey([
                                      'KeyId' => self::$keyId,
                                  ]);
        $result = $this->client->describeKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );
        self::assertEquals(200, $result->getResponse()->getStatusCode());
        self::assertEquals('Disabled', $result['KeyMetadata']['KeyState']);
    }

    /**
     * @depends testDisableKey
     * @throws GuzzleException
     */
    public function testEnableKey()
    {
        $this->client->enableKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );

        $result = $this->client->describeKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );
        self::assertEquals(200, $result->getResponse()->getStatusCode());
        self::assertEquals('Enabled', $result['KeyMetadata']['KeyState']);
    }

    /**
     * @depends testEnableKey
     * @throws GuzzleException
     */
    public function testGenerateDataKey()
    {
        $result = $this->client->generateDataKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );
        self::assertEquals(200, $result->getResponse()->getStatusCode());
        self::assertNotEmpty($result['CiphertextBlob']);
    }

    /**
     * @depends testCreateKeyExternal
     * @return string
     * @throws GuzzleException
     */
    public function testGetParametersForImport()
    {
        $result = $this->client->getParametersForImport(
            [
                'KeyId'             => self::$keyIdExternal,
                'WrappingAlgorithm' => 'RSAES_OAEP_SHA_256',
                'WrappingKeySpec'   => 'RSA_2048',
            ],
            $this->runtime
        );

        self::assertEquals(200, $result->getResponse()->getStatusCode());
        self::assertArrayHasKey('ImportToken', $result);
        return $result['ImportToken'];
    }

    /**
     * @depends testGetParametersForImport
     *
     * @param $importToken
     *
     * @throws GuzzleException
     */
    public function testImportKeyMaterial($importToken)
    {
        $query = [
            'KeyId'                 => self::$keyIdExternal,
            'EncryptedKeyMaterial'  => base64_encode('test'),
            'ImportToken'           => $importToken,
            'KeyMaterialExpireUnix' => time() + 24 * 60 * 60 * 1000,
        ];

        $result = $this->client->importKeyMaterial(
            $query,
            $this->runtime
        );

        self::assertEquals(400, $result->getResponse()->getStatusCode());
        self::assertEquals('import token is invalid', $result['Message']);
    }

    /**
     * @depends testImportKeyMaterial
     * @throws GuzzleException
     */
    public function testDeleteKeyMaterial()
    {
        $result = $this->client->deleteKeyMaterial(
            [
                'KeyId' => self::$keyIdExternal,
            ],
            $this->runtime
        );
        self::assertEquals(200, $result->getResponse()->getStatusCode());
    }

    /**
     * @depends testCreateKey
     * @throws GuzzleException
     */
    public function testScheduleKeyDeletion()
    {
        $this->client->scheduleKeyDeletion(
            [
                'KeyId'               => self::$keyId,
                'PendingWindowInDays' => 7,
            ],
            $this->runtime
        );

        $result = $this->client->describeKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );

        self::assertEquals('PendingDeletion', $result['KeyMetadata']['KeyState']);
    }

    /**
     * @depends testScheduleKeyDeletion
     *
     * @throws GuzzleException
     */
    public function testCancelKeyDeletion()
    {
        $this->client->cancelKeyDeletion(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );

        $result = $this->client->describeKey(
            [
                'KeyId' => self::$keyId,
            ],
            $this->runtime
        );

        self::assertEquals('Enabled', $result['KeyMetadata']['KeyState']);
    }

    /**
     * @depends testCancelKeyDeletion
     * @return string
     * @throws GuzzleException
     */
    public function testCreateAlias()
    {
        $this->deleteAlias(self::$keyId);
        $alias = 'alias/unit-test-' . time();
        $this->client->createAlias(
            [
                'KeyId'     => self::$keyId,
                'AliasName' => $alias,
            ],
            $this->runtime
        );

        $result = $this->client->listAliases(
            [
                'PageNumber' => 1,
                'PageSize'   => 100,
            ],
            $this->runtime
        );

        $flag = false;
        foreach ($result['Aliases']['Alias'] as $item) {
            if ($item['AliasName'] === $alias) {
                $flag = true;
            }
        }
        self::assertTrue($flag);

        $result = $this->client->listAliasesByKeyId(
            [
                'KeyId'      => self::$keyId,
                'PageNumber' => 1,
                'PageSize'   => 100,
            ],
            $this->runtime
        );

        $flag = false;
        foreach ($result['Aliases']['Alias'] as $item) {
            if ($item['AliasName'] === $alias) {
                $flag = true;
            }
        }
        self::assertTrue($flag);

        $result = $this->client->updateAlias(
            [
                'KeyId'     => self::$keyId,
                'AliasName' => $alias,
            ],
            $this->runtime
        );

        self::assertEquals(200, $result->getResponse()->getStatusCode());

        return $alias;
    }

    /**
     * @depends testCreateAlias
     *
     * @param string $alias
     *
     * @throws GuzzleException
     */
    public function testDeleteAlias($alias)
    {
        $beforeDelete = $this->client->listAliasesByKeyId(
            [
                'KeyId'      => self::$keyId,
                'PageNumber' => 1,
                'PageSize'   => 100,
            ],
            $this->runtime
        );

        self::assertSame(count($beforeDelete['Aliases']['Alias']), 1);

        $this->client->deleteAlias(
            [
                'AliasName' => $alias,
            ],
            $this->runtime
        );
        $afterDelete = $this->client->listAliasesByKeyId(
            [
                'KeyId'      => self::$keyId,
                'PageNumber' => 1,
                'PageSize'   => 100,
            ],
            $this->runtime
        );

        self::assertSame(count($afterDelete['Aliases']['Alias']), 0);
    }

    /**
     * @param $KeyId
     *
     * @throws GuzzleException
     */
    private function deleteAlias($KeyId)
    {
        $result = $this->client->listAliasesByKeyId(
            [
                'KeyId'      => $KeyId,
                'PageNumber' => 1,
                'PageSize'   => 100,
            ],
            $this->runtime
        );
        foreach ($result['Aliases']['Alias'] as $item) {
            $this->client->deleteAlias(
                [
                    'AliasName' => $item['AliasName'],
                ],
                $this->runtime
            );
        }
    }

    /**
     * @param int $pageNumber
     *
     * @throws GuzzleException
     */
    private static function deleteKeys($pageNumber)
    {
        $client = new Kms(
            getenv('ACCESS_KEY_ID'),
            getenv('ACCESS_KEY_SECRET'),
            getenv('ENDPOINT')
        );
        $list   = $client->listKeys(
            [
                'PageNumber' => $pageNumber,
                'PageSize'   => 100,
            ]
        );
        foreach ($list['Keys']['Key'] as $item) {
            if (getenv('KEY_ID') === $item['KeyId']) {
                $client->cancelKeyDeletion([
                                               'KeyId' => $item['KeyId'],
                                           ]);
                break;
            }
            if (getenv('EXTERNAL_KEY_ID') === $item['KeyId']) {
                $client->cancelKeyDeletion([
                                               'KeyId' => $item['KeyId'],
                                           ]);
                break;
            }
            $client->scheduleKeyDeletion([
                                             'KeyId'               => $item['KeyId'],
                                             'PendingWindowInDays' => 7,
                                         ]);
        }
    }
}
