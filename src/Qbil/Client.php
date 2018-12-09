<?php
/**
 * Created by PhpStorm.
 * User: Faizan Akram <hello@faizanakram.me>
 * Date: 7/12/18
 * Time: 8:09 PM
 */

namespace Qbil\ReadSoftOnline;

use Psr\Http\Message\ResponseInterface;
use Qbil\ReadSoftOnline\Models\Buyer;
use Qbil\ReadSoftOnline\Models\Customer;
use Qbil\ReadSoftOnline\Models\Supplier;

class Client
{
    private $client;

    private $headers = [
        "Accept" => "application/json",
        "Content-Type" => "application/json",
        "x-rs-culture" => "en-US",
        "x-rs-uiculture" => "en-US",
        "x-rs-version" => "2018-12-05",
    ];

    /** @var Customer[] */
    private $customers;

    /** @var Buyer[] */
    private $buyers;

    public function __construct(string $apiKey)
    {
        $this->headers['x-rs-key'] = $apiKey;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'https://services.readsoftonline.com',
            'cookies' => true,
        ]);
    }

    public function setHeaders($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    public function isAuthenticated(): bool
    {
        return json_decode($this->request('GET', '/authentication/rest/isauthenticated')->getBody()->getContents())->Value;
    }

    public function authenticate(string $userName, string $password)
    {
        return $this
            ->request('POST', '/authentication/rest/authenticate', [
                    'json' => [
                        "UserName" => $userName,
                        "Password" => $password,
                        "AuthenticationType" => 0,
                        "AuthenticationOptions" => 0,
                        "AuthenticationChallangeResponse" => null,
                        "ClientDeviceDescription" => null,
                    ],
                ]
            )
            ->getStatusCode();
    }

    /**
     * @return Customer[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->customers = array_map(
                function ($customer) {
                    return new Customer($customer);
                },
                json_decode(
                    $this
                        ->request('GET', '/accounts/rest/customers')
                        ->getBody()
                        ->getContents(),
                    true
                )
            );
        }

        return $this->customers;
    }

    /**
     * @param Customer $customer
     * @return Buyer[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBuyers(Customer $customer)
    {
        if (!$this->buyers) {
            $this->buyers = array_map(
                function ($buyer) {
                    return new Buyer($buyer);
                },
                json_decode(
                    $this
                        ->request('GET', "/accounts/rest/customers/{$customer->getId()}/buyers")
                        ->getBody()
                        ->getContents(),
                    true
                )
            );
        }

        return $this->buyers;
    }

    /**
     * @param string $organizationId (Buyer id or Customer id) depends upon setting enabled in RSO
     * @param Supplier[] $suppliers
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setSuppliers($organizationId, array $suppliers)
    {
        return $this
            ->request('PUT', "/masterdata/rest/{$organizationId}/suppliers", [
                'json' => json_decode(json_encode($suppliers), true)
            ])
            ->getBody()
            ->getContents();
    }

    /**
     * @param string $method
     * @param string $route
     * @param array $options
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request(string $method, string $route, array $options = [])
    {
        return $this->client->request($method, $route, array_merge($options, ['headers' => $this->headers]));
    }
}