<?php

namespace TheRealGambo\Kong;

use TheRealGambo\Kong\Apis\Api;
use TheRealGambo\Kong\Apis\Certificate;
use TheRealGambo\Kong\Apis\Cluster;
use TheRealGambo\Kong\Apis\Consumer;
use TheRealGambo\Kong\Apis\Node;
use TheRealGambo\Kong\Apis\Plugin;
use TheRealGambo\Kong\Apis\Plugins\KeyAuth;
use TheRealGambo\Kong\Apis\Sni;
use TheRealGambo\Kong\Apis\Upstream;
use TheRealGambo\Kong\Exceptions\InvalidUrlException;
use Unirest\Request;

class Kong
{
    /**
     * The base URL to the Kong Gateway
     *
     * @var string
     */
    protected $url;

    /**
     * The port that the Kong Admin API is listening on
     *
     * @var int
     */
    protected $port;

    /**
     * Kong Class constructor.
     *
     * @param string  $url
     * @param integer $port
     * @param boolean $return_json
     * @param integer $default_timeout
     * @param boolean $verify_ssl
     *
     * @throws InvalidUrlException
     */
    public function __construct($url, $port = 8001, $return_json = true, $default_timeout = 5, $verify_ssl = false)
    {
        // Validate that the URL
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException('The configured Kong Admin URL is invalid.');
        }

        // Store the port and url
        $this->port = $port;
        $this->url  = rtrim($url, '/');

        // Configure the response to be a JSON object instead of \StdClass
        if ($return_json) {
            Request::jsonOpts(true, 512, JSON_NUMERIC_CHECK & JSON_FORCE_OBJECT & JSON_UNESCAPED_SLASHES);
        }

        // Set the default timeout for all requests
        Request::timeout($default_timeout);

        // Verify SSL if configured
        Request::verifyPeer($verify_ssl);

        // Ensure we are always sending and receiving JSON
        $this->setDefaultHeader('Content-Type', 'application/json');
        $this->setDefaultHeader('Accept', 'application/json');
    }

    /**
     * Set default header to be used on all requests
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function setDefaultHeader($key, $value)
    {
        Request::defaultHeader($key, $value);
    }

    /**
     * Set default headers to be used on all requests
     *
     * @param array $headers
     *
     * @return void
     */
    public function setDefaultHeaders(array $headers = [])
    {
        Request::defaultHeaders($headers);
    }

    /**
     * Clear all default headers
     *
     * @return void
     */
    public function clearDefaultHeaders()
    {
        Request::clearDefaultHeaders();
    }

    /**
     * Returns a new instance of the Node endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Node
     */
    public function getNodeObject()
    {
        return new Node($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Cluster endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Cluster
     */
    public function getClusterObject()
    {
        return new Cluster($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Api endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Api
     */
    public function getApiObject()
    {
        return new Api($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Consumer endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Consumer
     */
    public function getConsumerObject()
    {
        return new Consumer($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Plugin endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Plugin
     */
    public function getPluginObject()
    {
        return new Plugin($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Certificate endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Certificate
     */
    public function getCertificateObject()
    {
        return new Certificate($this->url, $this->port);
    }

    /**
     * Returns a new instance of the SNI endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Sni
     */
    public function getSNIObject()
    {
        return new Sni($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Upstream endpoint
     *
     * @return \TheRealGambo\Kong\Apis\Upstream
     */
    public function getUpstreamObject()
    {
        return new Upstream($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Key Auth plugin
     *
     * @return \TheRealGambo\Kong\Apis\Plugins\KeyAuth
     */
    public function getPluginKeyAuth()
    {
        return new KeyAuth($this->url, $this->port);
    }

    /**
     * Returns a new instance of the Basic Auth Plugin
     *
     * @return BasicAuth
     */
    public function getPluginBasicAuth()
    {
        return new BasicAuth($this->url, $this->port);
    }
}
