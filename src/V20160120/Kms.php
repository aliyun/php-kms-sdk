<?php

namespace AlibabaCloud\Kms\V20160120;

use AlibabaCloud\Client\Result\Result;
use AlibabaCloud\Kms\Base;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Kms
 *
 * @package AlibabaCloud\V20160120\\Kms
 */
class Kms extends Base
{
    /**
     * @var string
     */
    protected $version = '2016-01-20';

    /**
     * @description cancel key deletion which can enable this key
     * @see         https://help.aliyun.com/document_detail/44197.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function cancelKeyDeletion($query = [], $runtime = [])
    {
        $query['Action']     = 'CancelKeyDeletion';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description make alias to key
     * @see         https://help.aliyun.com/document_detail/68624.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - AliasName string required: cmk alias, prefix must be 'alias/'
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function createAlias($query = [], $runtime = [])
    {
        $query['Action']     = 'CreateAlias';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description create new key
     * @see         https://help.aliyun.com/document_detail/28947.html
     *
     * @param $query
     *   - Action string required
     *   - Origin string optional: Aliyun_KMS (default) or EXTERNAL
     *   - Description string optional: description of key
     *   - KeyUsage string optional: usage of key, default is ENCRYPT/DECRYPT
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function createKey($query = [], $runtime = [])
    {
        $query['Action']     = 'CreateKey';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description decrypt body of CiphertextBlob
     * @see         https://help.aliyun.com/document_detail/28950.html
     *
     * @param $query
     *   - Action string required
     *   - CiphertextBlob string required: ciphertext to be decrypted.
     *   - EncryptionContext string optional: key/value string, must be {string: string}
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function decrypt($query = [], $runtime = [])
    {
        $query['Action']     = 'Decrypt';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description delete alias
     * @see         https://help.aliyun.com/document_detail/68626.html
     *
     * @param $query
     *   - Action string required
     *   - AliasName string required: alias name, prefix must be 'alias/'
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function deleteAlias($query = [], $runtime = [])
    {
        $query['Action']     = 'DeleteAlias';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description delete key material
     * @see         https://help.aliyun.com/document_detail/68623.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function deleteKeyMaterial($query = [], $runtime = [])
    {
        $query['Action']     = 'DeleteKeyMaterial';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description get description of main key
     * @see         https://help.aliyun.com/document_detail/28952.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function describeKey($query = [], $runtime = [])
    {
        $query['Action']     = 'DescribeKey';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description query available regions
     * @see         https://help.aliyun.com/document_detail/54560.html
     *
     * @param $query
     *   - Action string required
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function describeRegions($query = [], $runtime = [])
    {
        $query['Action']     = 'DescribeRegions';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description disable key
     * @see         https://help.aliyun.com/document_detail/35151.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function disableKey($query = [], $runtime = [])
    {
        $query['Action']     = 'DisableKey';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description enable key
     * @see         https://help.aliyun.com/document_detail/35150.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function enableKey($query = [], $runtime = [])
    {
        $query['Action']     = 'EnableKey';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description encrypt content
     * @see         https://help.aliyun.com/document_detail/28949.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - Plaintext string required: plaintext to be encrypted (must be Base64 encoded)
     *   - EncryptionContext string optional: key/value string, must be {string: string}
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function encrypt($query = [], $runtime = [])
    {
        $query['Action']     = 'Encrypt';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description generate local data key
     * @see         https://help.aliyun.com/document_detail/28948.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - KeySpec string optional: AES_256 or AES_128
     *   - NumberOfBytes int optional: length of key
     *   - EncryptionContext string optional: key/value string, must be {string: string}
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function generateDataKey($query = [], $runtime = [])
    {
        $query['Action']     = 'GenerateDataKey';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description get the imported master key (CMK) material
     * @see         https://help.aliyun.com/document_detail/68621.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - WrappingAlgorithm string required: algorithm for encrypting key material, RSAES_PKCS1_V1_5, RSAES_OAEP_SHA_1
     *   or RSAES_OAEP_SHA_256
     *   - WrappingKeySpec string required: public key type used to encrypt key material, RSA_2048
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function getParametersForImport($query = [], $runtime = [])
    {
        $query['Action']     = 'GetParametersForImport';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description
     * @see https://help.aliyun.com/document_detail/68622.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - EncryptedKeyMaterial string required: key material encrypted with base64
     *   - ImportToken string required: obtained by calling GetParametersForImport
     *   - KeyMaterialExpireUnix {timestamp} optional: Key material expiration time
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function importKeyMaterial($query = [], $runtime = [])
    {
        $query['Action']     = 'ImportKeyMaterial';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description returns all aliases of the current user in the current zone
     * @see         https://help.aliyun.com/document_detail/68627.html
     *
     * @param $query
     *   - Action string required
     *   - PageNumber int optional: current page, default 1
     *   - PageSize int optional: result count (0 - 100), default 10
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function listAliases($query = [], $runtime = [])
    {
        $query['Action']     = 'ListAliases';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description list all aliases corresponding to the specified master key (CMK)
     * @see         https://help.aliyun.com/document_detail/68628.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - PageNumber int optional: current page, default 1
     *   - PageSize int optional: result count (0 - 100), default 10
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function listAliasesByKeyId($query = [], $runtime = [])
    {
        $query['Action']     = 'ListAliasesByKeyId';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description Returns all the master key IDs of the caller in the calling area
     * @see         https://help.aliyun.com/document_detail/28951.html
     *
     * @param $query
     *   - Action string required
     *   - PageNumber int optional: current page, default 1
     *   - PageSize int optional: result count (0 - 100), default 10
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function listKeys($query = [], $runtime = [])
    {
        $query['Action']     = 'ListKeys';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description request to delete a specified master key (CMK)
     * @see         https://help.aliyun.com/document_detail/44196.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - PendingWindowInDays int required: key pre-delete cycle, [7, 30]
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function scheduleKeyDeletion($query = [], $runtime = [])
    {
        $query['Action']     = 'ScheduleKeyDeletion';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }

    /**
     * @description update the master key (CMK) represented by an existing alias
     * @see         https://help.aliyun.com/document_detail/68625.html
     *
     * @param $query
     *   - Action string required
     *   - KeyId string required: global unique identifier
     *   - AliasName string required: the alias to be operated, prefix must be 'alias/'
     * @param $runtime
     *
     * @return Result
     * @throws GuzzleException
     */
    public function updateAlias($query = [], $runtime = [])
    {
        $query['Action']     = 'UpdateAlias';
        $request['protocol'] = 'https';
        $request['method']   = 'GET';
        $request['pathname'] = '/';
        $request['query']    = $this->getQuery($query, $request);
        $request['headers']  = [
            'host' => $this->endpoint,
        ];

        $response = $this->request($request, $runtime);

        return $this->json($response);
    }
}
