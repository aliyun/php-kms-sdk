<?php

namespace AlibabaCloud\Kms;

use AlibabaCloud\Client\Result\Result;
use AlibabaCloud\Client\Signature\ShaHmac1Signature;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;

/**
 * Class Base
 *
 * @package AlibabaCloud\Kms
 */
class Base
{
    /**
     * @var string
     */
    protected $version = '';

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var string
     */
    protected $accessKeySecret;

    /**
     * @var string
     */
    protected $accessKeyId;

    /**
     * @var Uri
     */
    protected $uri;

    /**
     * Base constructor.
     *
     * @param $accessKeyId
     * @param $accessKeySecret
     * @param $endpoint
     */
    public function __construct($accessKeyId, $accessKeySecret, $endpoint)
    {
        $this->accessKeyId     = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
        $this->endpoint        = $endpoint;
        $this->uri             = new Uri();
    }

    /**
     * @param array $request
     * @param array $runtime
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(array $request, array $runtime)
    {
        $options = [
            'verify'      => isset($runtime['ignoreSSL']) ? (boolean)$runtime['ignoreSSL'] : false,
            'http_errors' => isset($runtime['http_errors']) ? (boolean)$runtime['http_errors'] : false,
        ];

        $options = \AlibabaCloud\Client\arrayMerge([$options, $runtime]);

        $this->uri = $this->uri->withScheme($request['protocol']);
        $this->uri = $this->uri->withPath($request['pathname']);
        $this->uri = $this->uri->withQuery($request['query']);
        $this->uri = $this->uri->withHost($request['headers']['host']);
        return (new Client())->request($request['method'], (string)$this->uri, $options);
    }

    /**
     * @param $response
     *
     * @return Result
     */
    protected function json($response)
    {
        return new Result($response);
    }

    /**
     * @param array $query
     *
     * @param array $request
     *
     * @return string
     */
    protected function getQuery(array $query, array $request)
    {
        $sign                      = new ShaHmac1Signature();
        $query['Format']           = 'json';
        $query['Version']          = $this->version;
        $query['AccessKeyId']      = $this->accessKeyId;
        $query['SignatureMethod']  = $sign->getMethod();
        $query['Timestamp']        = gmdate('Y-m-d\TH:i:s\Z');
        $query['SignatureVersion'] = $sign->getVersion();
        $query['SignatureNonce']   = md5(uniqid(mt_rand(), true));
        $query['Signature']        = $sign->sign(
            $this->prepareStringToSigned($query, $request),
            $this->accessKeySecret . '&'
        );

        return http_build_query($query);
    }

    /**
     * @param $query
     * @param $request
     *
     * @return string
     */
    protected function prepareStringToSigned($query, $request)
    {
        ksort($query, SORT_STRING);
        $canonicalizedQuery = '';
        foreach ($query as $key => $value) {
            $canonicalizedQuery .= '&' . $this->percentEncode($key) . '=' . $this->percentEncode($value);
        }

        return $request['method']
               . '&%2F&'
               . $this->percentEncode(substr($canonicalizedQuery, 1));
    }

    /**
     * @param string $string
     *
     * @return null|string|string[]
     */
    protected function percentEncode($string)
    {
        $result = urlencode($string);
        $result = str_replace(['+', '*'], ['%20', '%2A'], $result);
        $result = preg_replace('/%7E/', '~', $result);
        return $result;
    }
}
