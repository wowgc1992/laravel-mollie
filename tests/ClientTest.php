<?php

namespace PeterIcebear\Tests\Mollie;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Foundation\Application;
use Mockery;
use PeterIcebear\Mollie\MollieApiClientManager;

class ClientTest extends AbstractTestBenchTestCase
{
    protected $application_mock;
    protected $application_config;
    protected $client;

    protected function setUp()
    {
        $this->setUpMocks();

        $this->client = new MollieApiClientManager($this->application_mock, $this->application_config);

        parent::setUp();
    }

    protected function setUpMocks()
    {
        $this->application_mock = Mockery::mock(Application::class);
        $this->application_config = [
            'test_mode' => true,

            'api_keys' => [
                'test' => 'test_dummy',
                'live' => 'live_dummy',
            ],
        ];
    }

    /**
     * Test if the MollieApiClientManager can be constructed.
     */
    public function test_it_can_be_constructed()
    {
        $this->assertInstanceOf(MollieApiClientManager::class, $this->client);
    }

    public function testClientMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Client::class, $this->client->client());
    }

    public function testGetPaymentsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Payments::class, $this->client->getPayments());
    }

    public function testGetPaymentRefundsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Payments_Refunds::class, $this->client->getPaymentRefunds());
    }

    public function testGetIssuersMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Issuers::class, $this->client->getIssuers());
    }

    public function testGetMethodsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Methods::class, $this->client->getMethods());
    }
}
