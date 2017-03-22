<?php

namespace TheRealGambo\Kong\Apis;

use TheRealGambo\Kong\Exceptions\InvalidHttpMethodException;
use TheRealGambo\Kong\Exceptions\KongHttpException;
use Unirest\Request;
use Unirest\Method;
use Unirest\Response;

class AbstractApi
{
    /**
     * The URL to the Kong Admin API
     *
     * @var string
     */
    protected $url;

    /**
     * The port the Kong Admin API is listening on
     *
     * @var integer
     */
    protected $port;

    /**
     * The response object after each request
     *
     * @var Response
     */
    protected $response;

    /**
     * An array of allowed options for the current request
     *
     * @var array
     */
    protected $allowedOptions = [];

    /**
     * AbstractApi constructor.
     *
     * @param string  $url
     * @param integer $port
     */
    public function __construct($url, $port)
    {
        $this->url  = $url;
        $this->port = $port;
    }

    /**
     * Make a delete request
     *
     * @param string $uri
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function deleteRequest($uri, array $headers = [])
    {
        return $this->request(Method::DELETE, $uri, [], [], $headers);
    }

    /**
     * Make a get request
     *
     * @param string $uri
     * @param array  $params
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function getRequest($uri, array $params = [], array $headers = [])
    {
        return $this->request(Method::GET, $uri, $params, [], $headers);
    }

    /**
     * Make a patch request
     *
     * @param string $uri
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function patchRequest($uri, array $body = [], array $headers = [])
    {
        return $this->request(Method::PATCH, $uri, [], $body, $headers);
    }

    /**
     * Make a post request
     *
     * @param string $uri
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function postRequest($uri, array $body = [], array $headers = [])
    {
        return $this->request(Method::POST, $uri, [], $body, $headers);
    }

    /**
     * Make a put request
     *
     * @param string $uri
     * @param array  $body
     * @param array  $headers
     *
     * @return array|\stdClass
     */
    public function putRequest($uri, array $body = [], array $headers = [])
    {
        return $this->request(Method::PUT, $uri, [], $body, $headers);
    }

    /**
     * Make a request to the Kong Admin API
     *
     * @param string $http_verb
     * @param string $uri
     * @param array  $params
     * @param array  $body
     * @param array  $headers
     *
     * @throws InvalidHttpMethodException
     * @throws KongHttpException
     *
     * @return array|\stdClass
     */
    private function request($http_verb, $uri, array $params = [], array $body = [], array $headers = [])
    {
        // Format the URL for the API request
        $api = $this->url . ':' . $this->port . '/' . $uri;

        try {
            switch ($http_verb) {
                case Method::GET:
                    $request = Request::get($api, $headers, $params);
                    break;
                case Method::POST:
                    $request = Request::post($api, $headers, $body);
                    break;
                case Method::PUT:
                    $request = Request::put($api, $headers, $body);
                    break;
                case Method::PATCH:
                    $request = Request::patch($api, $headers, $body);
                    break;
                case Method::DELETE:
                    $request = Request::delete($api, $headers);
                    break;
                default:
                    throw new InvalidHttpMethodException('Invalid HTTP request method');
            }
        } catch (\Exception $e) {
            throw new KongHttpException($e->getMessage());
        }

        // Store the response object
        $this->response = $request;

        // Return the body response
        return $request->body;
    }

    /**
     * Return the response object for the last request
     *
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * Create a valid request body, removing all non valid options
     *
     * @param array $body
     * @param array $merge
     *
     * @return array
     */
    public function createRequestBody(array $body, array $merge = [])
    {
        $result = [];

        foreach ($body as $key => $value) {
            if (!in_array($key, $this->allowedOptions) && strpos($key, 'config.') < 0) {
                continue;
            }

            $result[$key] = $value;
        }

        return array_merge($result, $merge);
    }

    /**
     * Set the array of allowed options for each request
     *
     * @param array $options
     *
     * @return void
     */
    public function setAllowedOptions(array $options = [])
    {
        $this->allowedOptions = $options;
    }
}
