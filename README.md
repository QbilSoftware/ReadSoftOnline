# ReadSoftOnline (RSO) PHP Client
ReadSoftOnline PHP client (RSO PHP Client)

What is ReadSoft Online ?

>From https://www.kofax.com/Products/Financial-Process-Automation/ReadSoft-Online/Overview/

> ReadSoft Online leads the industry in capture, extraction and validation of invoices in the cloud. Process your invoices seamlessly and affordably and for free. Download your free trial version and experience how easy ReadSoft Online solution easily integrates into your existing ERP system.

This package uses [Guzzle PHP Http Client](https://github.com/guzzle/guzzle) to make API requests to [services.readsoftonline.com](https://services.readsoftonline.com) and provides some easy methods for interacting with ReadSoftOnline.

[Click here](https://docs.readsoftonline.com/help/eng/office/integration/API-user-guide/c_introduction.html) for more information about [ReadSoftOnline API](https://services.readsoftonline.com/documentation/rest).

The package is fairly simple. All you need to do is install this package via [composer](https://getcomposer.org), require `autoload.php` file and create instance of `Qbil\ReadSoftOnline\Client` class, it expects one parameter (API key).

**Installation**
1. `composer require qbil-software/read-soft-online`
2. `require_once 'vendor/autoload.php';`
3. `$client = new Client('insert_api_key_here');`
4. Authenticate using `$client->authenticate('rso username here', 'rso password here')`


`Qbil\ReadSoftOnline\Client` has following public methods

1. `setHeaders()`: Set additional headers or modify existing header information.
2. `isAuthenticated()`: Check whether client is authenticated or not.
3. `authenticate($userName, $password)`: Authenticate client with username and password.
4. `getCustomers()`: Return array of `Models\Customer` with all customers associated with current account
5. `getBuyers(Customer $customer)`: Return array of `Models\Buyer` with all buyers associated with passed customer.
6. `getOutputDocuments(Customer $customer)`: Return array of `Models\OutputDocument` with all processed documents associated with passed customer. The `OutputDocument` class contains mostly meta data about Document like DocumentId, BatchId, BuyerId, etc.
7. `getDocument(OutputDocument $document)`: Return whole processed document info (instance of `Models\Document` class) including meta data, buyer and customer info. etc.
8. `getProcessedInvoice(Document $document)`: Return instance of `Models\Invoice` containing only relevant data of processed invoice (without any meta data).
9. `setDocumentStatus(Document $document, $status)`: Set status of processed document (`STATUS_SUCCESS` or `STATUS_REJECTED`)
10. `setSuppliers($organizationId, array $suppliers)`: Upload suppliers to ReadSoftOnline. `$organizationId` is either Buyer Id or Customer Id (depends upon settings of RSO)



and one protected method:

`request(string $method, string $route, array $options = [])`: This method is mostly internally used to make request via GuzzleHttp/Client. You may extend the class to implement more methods from RSO API and use this method for making proper requests.

See `Qbil\ReadSoftOnline\Client` for definition of each method

