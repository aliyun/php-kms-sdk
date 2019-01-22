<?php

namespace AlibabaCloud\Kms\Tests\Feature;

use AlibabaCloud\Kms\V20160120\Kms;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

/**
 * Class KmsWithOptionsTest
 *
 * @package AlibabaCloud\Kms\Tests\Feature
 */
class KmsWithOptionsTest extends TestCase
{
    /**
     * @var Kms
     */
    protected $client;

    /**
     * @var array
     */
    protected $runtime = [
        'connect_timeout' => 0.1,
        'timeout'         => 0.1,
    ];

    public function setUp()
    {
        parent::setUp();
        $this->client = new Kms(
            getenv('ACCESS_KEY_ID'),
            getenv('ACCESS_KEY_SECRET'),
            getenv('ENDPOINT')
        );
    }

    public function testDescribeRegions()
    {
        try {
            $this->client->describeRegions([], $this->runtime);
        } catch (GuzzleException $e) {
            self::assertStringStartsWith('cURL error', $e->getMessage());
        }
    }
}
