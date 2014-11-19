<?php
namespace OpenDNS\MES;
use Guzzle\Http\Client;
use Guzzle\Http\QueryString;

/**
 * Base abstract for all MeS APIs
 */
abstract class Request
{
    const ENV_PROD = 'api';
    const ENV_CERT = 'cert';
    const ENV_TEST = 'test';

    /** @var string HTTP Method to use for the request */
    protected $httpMethod = 'POST';

    /** @var string Base domain name for the API as a whole */
    protected $apiBaseDomain = 'merchante-solutions.com';

    /** @var string Environment subdomain for the api */
    protected $apiEnvironment;

    /** @var string The path to an API's endpoints on the server */
    protected $apiBasePath;

    /** @var string The name of a specific endpoint within the api base path */
    protected $apiEndpointPath;

    /** @var string[] key/value pairs to be set by default on new requests */
    protected $defaultFieldValues = array();

    /** @var Guzzle\Http\Client Guzzle HTTP client instance */
    private $httpClient;

    /** @var Guzzle\Http\Message\Request Guzzle request object */
    private $request;

    /** @var Guzzle\Http\Message\Response Guzzle response object */
    private $response;

    private $requestFields = array();

    /**
     * Constructor, for constructing new instances
     *
     * @param string $environment One of the ENV consts for API environment
     * @return void
     */
    public function __construct($environment)
    {
        $this->apiEnvironment = $environment;
        $this->setDefaults();
    }

    /**
     * Factory method for convenient chaining
     *
     * @param string $environment One of the ENV consts for API environment
     * @return self A new instance
     */
    public static function factory($environment)
    {
        return new static($environment);
    }

    /**
     * Run the request and return the response body
     *
     * @return Guzzle\Http\Stream\StreamInterface A Guzzle stream object representing the response body
     */
    public function execute()
    {
        $this->response = null;
        $httpMethod = strtolower($this->httpMethod);

        $dataParam = $this->httpMethod === 'GET' ? 'query' : 'body';

        $request = $this->getClient()
                        ->$httpMethod($this->getApiUrl());

        if ($this->httpMethod === 'GET' || $this->httpMethod === 'HEAD') {
            $request->getQuery()
                    ->replace($this->requestFields);
        } else {
            $request = $request->setBody($this->requestFields);
        }

        $this->response = $request->send();

        return $this->processResponse($this->response->getBody());
    }

    /**
     * Attach a request subscriber for unit testing.
     *
     * @internal For unit testing only
     * @ignore
     */
    public function addClientSubscriber($subscriber)
    {
        return $this->getClient()->addSubscriber($subscriber);
    }

    /**
     * Assemble a full API url out of class properties
     *
     * @return string the combined API url
     */
    protected function getApiUrl()
    {
        $url = 'https://' . $this->apiEnvironment . '.' . $this->apiBaseDomain;

        if ($this->apiBasePath !== null) {
            $url .= $this->apiBasePath;
        }

        if ($this->apiEndpointPath) {
            $url .= '/' . $this->apiEndpointPath;
        }

        return $url;
    }

    /**
     * Return a singleton Guzzle HTTP client
     *
     * @return Guzzle\Http\Client
     */
    protected function getClient()
    {
        if ($this->httpClient === null) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }

    /**
     * Remove a set field from the current request
     *
     * @param string $field Field name to unset from the request
     * @return self The current class instance for chaining
     */
    protected function removeField($field)
    {
        unset($this->requestFields[$field]);
        return $this;
    }

    /**
     * Set a new field on the current request
     *
     * @param string $field The field name to set
     * @param int|string The value of the field (will be cast to string)
     * @return self The current class instance for chaining
     */
    protected function setField($field, $value)
    {
        $this->requestFields[$field] = $value;
        return $this;
    }

    /**
     * Set any defined default fields on the request
     * @return self The current class instance for chaining
     */
    protected function setDefaults()
    {
        foreach ($this->defaultFieldValues as $field => $value) {
            $this->setField($field, $value);
        }

        return $this;
    }

    /**
     * Allows child classes to post-process the results before returning them
     *
     * @param Guzzle\Http\Stream\StreamInterface $response The Guzzle stream object returned by execute()
     * @return Response An object representing the MeS response
     */
    protected function processResponse($response)
    {
        return new Response($response);
    }

}
