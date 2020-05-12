<?php
/**
 * IcecatBase
 *
 * @copyright Copyright © 2020 Firebear Studio. All rights reserved.
 * @author    fbeardev@gmail.com
 */

namespace Rapiddive\Icecat;


use GuzzleHttp\Client;
use SimpleXMLElement;

class IcecatBase
{
    /**
     * The base URL used for all requests
     *
     * @var string
     */
    public $apiBaseUrl = 'https://data.icecat.biz';

    /**
     * The endpoint relative to base URL for all XML requests
     *
     * @var string
     */
    public $xmlEndpoint = 'xml_s3/xml_server3.cgi';

    /**
     * The endpoint relative to base URL for direct ID request
     *
     * @var string
     */
    public $idEndpoint = 'export/level4';

    /**
     * @var Client
     */
    protected $guzzle;

    /**
     * @var array
     */
    protected $headers = array(
        'Accept-Encoding: gzip'
    );

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * IcecatBase constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $username = '',
        string $password = ''
    ) {
        $this->username = $username;
        $this->password = $password;

        $this->init();
    }

    /**
     * Init Guzzle Instance
     */
    protected function init()
    {
        if (!$this->guzzle) {
            $this->guzzle = new Client(array(
                'base_uri' => $this->apiBaseUrl,
                'auth' => [$this->getUsername(), $this->getPassword()],
                'headers' => $this->headers,
                'decode_content' => true
            ));
        }
        return $this->guzzle;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return Client
     */
    public function getGuzzle(): Client
    {
        return $this->guzzle;
    }

    /**
     * @param $endpoint
     * @param $params
     * @return bool|string
     */
    public function request($endpoint, $params)
    {
        try {
            $response = $this->guzzle->get($endpoint,
                array(
                    'query' => $params
                ));
        } catch (RequestException $e) {
            if ($this->debug) {
                print $e->getMessage() . "\n";
                if ($e->hasResponse()) {
                    print $e->getResponse()->getBody()->getContents() . "\n";
                }
            }

            return false;
        }

        return $response->getBody()->getContents();
    }
}