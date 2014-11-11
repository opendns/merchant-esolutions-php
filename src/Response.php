<?php
namespace OpenDNS\MES;

/**
 * Base class for API responses.
 *
 * Accessible as an array, but you can't change any values.
 */
class Response implements \ArrayAccess
{
    /** @var Guzzle\Http\Message\Response Raw Guzzle response from the contructor args */
    protected $guzzleResponse;

    /** @var string[] Parsed keys/values from the MeS response body */
    protected $fields = array();

    /**
     *  @param Guzzle\Http\Message\Response $guzzleResponse Raw Guzzle response from the contructor args
     */
    public function __construct($guzzleResponse)
    {
        $this->guzzleResponse = $guzzleResponse;
        parse_str((string) $this->guzzleResponse, $this->fields);
    }

    /**
     * Get the response body as a JSON object
     *
     * @return string JSON string representing the MeS API response
     */
    public function json()
    {
        return json_encode($this->fields);
    }

    /**
     * Get the response body as a stream resource
     *
     * This is mostly useful for the reporting API, which returns CSV. You can use this together with fgetcsv().
     *
     * @return resource PHP stream resource representing the MeS response body
     */
    public function getResponseBodyStream()
    {
        $stream = $this->guzzleResponse->getStream();
        rewind($stream);
        return $stream;
    }

    /**
     * Test whether a key exists in the response object
     *
     * @internal Exists mainly for ArrayAccess.
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->fields[$offset]);
    }

    /**
     * Get a response value by its key
     *
     * @internal Exists mainly for ArrayAccess.
     * @param string|int $offset
     * @return string
     */
    public function offsetGet($offset) {
        return $this->fields[$offset];
    }

    /**
     * Literally does nothing.
     *
     * @internal Exists mainly for ArrayAccess.
     * @ignore
     * @codeCoverageIgnore
     * @param string|int $offset
     * @param mixed value
     * @return void
     */
    public function offsetSet($offset, $value) {}

    /**
     * Literally does nothing.
     *
     * @internal Exists mainly for ArrayAccess.
     * @ignore
     * @codeCoverageIgnore
     * @param string|int $offset
     * @return void
     */
    public function offsetUnset($offset) {}

}
