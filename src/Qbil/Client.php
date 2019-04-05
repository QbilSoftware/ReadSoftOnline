<?php
/**
 * Created by PhpStorm.
 * User: Faizan Akram <hello@faizanakram.me>
 * Date: 7/12/18
 * Time: 8:09 PM.
 */

namespace Qbil\ReadSoftOnline;

use Psr\Http\Message\ResponseInterface;
use Qbil\ReadSoftOnline\Models\Buyer;
use Qbil\ReadSoftOnline\Models\Customer;
use Qbil\ReadSoftOnline\Models\Document;
use Qbil\ReadSoftOnline\Models\Invoice;
use Qbil\ReadSoftOnline\Models\OutputDocument;
use Qbil\ReadSoftOnline\Models\Supplier;

class Client
{
    const STATUS_SUCCESS = 1;
    const STATUS_REJECTED = 0;

    private $client;

    private $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
        'x-rs-culture' => 'en-US',
        'x-rs-uiculture' => 'en-US',
        'x-rs-version' => '2018-12-05',
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
                        'UserName' => $userName,
                        'Password' => $password,
                        'AuthenticationType' => 0,
                        'AuthenticationOptions' => 0,
                        'AuthenticationChallangeResponse' => null,
                        'ClientDeviceDescription' => null,
                    ],
                ]
            )
            ->getStatusCode();
    }

    /**
     * @return Customer[]
     *
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
     *
     * @return Buyer[]
     *
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
     * @param Customer $customer
     *
     * @return OutputDocument[]
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOutputDocuments(Customer $customer)
    {
        return
            array_map(
                function ($document) {
                    return new OutputDocument($document);
                },
                json_decode(
                    $this
                        ->request('GET', "/documents/rest/customers/{$customer->getId()}/outputdocuments")
                        ->getBody()
                        ->getContents(),
                    true
                )
            );
    }

    /**
     * @param OutputDocument $document
     *
     * @return Document
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDocument(OutputDocument $document)
    {
        return new Document(
            json_decode(
                $this
                    ->request('GET', "/documents/rest/{$document->getDocumentId()}")
                    ->getBody()
                    ->getContents(),
                true
            )
        );
    }

    /**
     * @param Document $document
     *
     * @return Invoice
     */
    public function getProcessedInvoice(Document $document)
    {
        return new Invoice($document);
    }

    /**
     * @param Document $document
     * @param $status
     *
     * @return bool
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setDocumentStatus(Document $document, $status)
    {
        return json_decode(
            $this
                ->request(
                    'PUT',
                    "/documents/rest/{$document->Id}/documentstatus",
                    [
                        'json' => [
                            'Status' => $status,
                            'Message' => null,
                            'CodingLines' => null,
                            'CorrelationData' => null,
                            'ExternalId' => null,
                            'ValidationInfoCollection' => null,
                        ],
                    ]
                )
                ->getBody()
                ->getContents()
        )->Value;
    }

    /**
     * @param string     $organizationId (Buyer id or Customer id) depends upon setting enabled in RSO
     * @param Supplier[] $suppliers
     *
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setSuppliers($organizationId, array $suppliers)
    {
        return $this
            ->request('PUT', "/masterdata/rest/{$organizationId}/suppliers", [
                'json' => json_decode(json_encode($suppliers), true),
            ])
            ->getBody()
            ->getContents();
    }

    /**
     * @param string $method
     * @param string $route
     * @param array  $options
     *
     * @return ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $method, string $route, array $options = [])
    {
        return $this->client->request($method, $route, array_merge($options, ['headers' => $this->headers]));
    }

    /**
     * @param array $property
     * @param $key
     * @param string $subKey
     *
     * @return mixed
     *
     * @deprecated This method is only for backward compatibility and will be removed in v2.0, use Util::extract() instead
     */
    protected function extract(array $property, $key, $subKey = 'Text')
    {
        return Util::extract($property, $key, $subKey);
    }
}
