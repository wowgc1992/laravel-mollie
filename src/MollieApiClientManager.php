<?php

namespace PeterIcebear\Mollie;

class MollieApiClientManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * The default settings.
     */
    protected $config;

    /**
     * Create a new Mollie instance.
     *
     * @param \Illuminate\Foundation\Application $app
     * @param array                              $config
     */
    public function __construct($app, $config = [])
    {
        $this->app = $app;
        $this->config = $config;
    }

    /**
     * @throws \Mollie_API_Exception
     *
     * @return \Mollie_API_Client
     */
    public function client()
    {
        $mollie = new \Mollie_API_Client();

        if ($this->config['test_mode']) {
            $mollie->setApiKey($this->config['api_keys']['test']);
        } else {
            $mollie->setApiKey($this->config['api_keys']['live']);
        }

        return $mollie;
    }

    /**
     * @return \Mollie_API_Resource_Payments
     */
    public function getPayments()
    {
        return $this->client()->payments;
    }

    /**
     * @return \Mollie_API_Resource_Payments_Refunds
     */
    public function getPaymentsRefunds()
    {
        return $this->client()->payments_refunds;
    }

    /**
     * @return \Mollie_API_Resource_Issuers
     */
    public function getIssuers()
    {
        return $this->client()->issuers;
    }

    /**
     * @return \Mollie_API_Resource_Methods
     */
    public function getMethods()
    {
        return $this->client()->methods;
    }

    /**
     * @return \Mollie_API_Resource_Customers
     */
    public function getCustomers()
    {
        return $this->client()->customers;
    }

    /**
     * @return \Mollie_API_Resource_Customers_Payments
     */
    public function getCustomersPayments()
    {
        return $this->client()->customers_payments;
    }

    /**
     * @return \Mollie_API_Resource_Customers_Mandates
     */
    public function getCustomersMandates()
    {
        return $this->client()->customers_mandates;
    }

    /**
     * @return \Mollie_API_Resource_Customers_Subscriptions
     */
    public function getCustomersSubscriptions()
    {
        return $this->client()->customers_subscriptions;
    }
}
