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
    protected $application_live_config;
    protected $client;
    protected $client_live;

    protected function setUp()
    {
        $this->setUpMocks();

        $this->client = new MollieApiClientManager($this->application_mock, $this->application_config);
        $this->client_live = new MollieApiClientManager($this->application_mock, $this->application_live_config);

        parent::setUp();
    }

    protected function setUpMocks()
    {
        $this->application_mock = Mockery::mock(Application::class);
        $this->application_config = [
            'test_mode' => true,

            'api_keys' => [
                'test' => 'test_111111111111111111111111111111',
                'live' => 'live_111111111111111111111111111111',
            ],
        ];
        $this->application_live_config = [
            'test_mode' => false,

            'api_keys' => [
                'test' => 'test_222222222222222222222222222222',
                'live' => 'live_222222222222222222222222222222',
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

    public function testLiveClientMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Client::class, $this->client_live->client());
    }

    public function testGetPaymentsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Payments::class, $this->client->getPayments());
    }

    public function testGetPaymentsRefundsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Payments_Refunds::class, $this->client->getPaymentsRefunds());
    }

    public function testGetIssuersMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Issuers::class, $this->client->getIssuers());
    }

    public function testGetCustomersMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Customers::class, $this->client->getCustomers());
    }

    public function testGetCustomersPaymentsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Customers_Payments::class, $this->client->getCustomersPayments());
    }

    public function testGetCustomersMandatesMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Customers_Mandates::class, $this->client->getCustomersMandates());
    }

    public function testGetCustomersSubscriptionsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Customers_Subscriptions::class, $this->client->getCustomersSubscriptions());
    }

    public function testGetMethodsMethod()
    {
        $this->assertInstanceOf(\Mollie_API_Resource_Methods::class, $this->client->getMethods());
    }
}
