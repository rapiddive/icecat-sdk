<?php

declare(strict_types=1);
/**
 * IcecatBase
 *
 * @copyright Copyright © 2020 Rapid dive. All rights reserved.
 * @author    Rapid Dive <rapiddive1@gmail.com>
 */

namespace Rapiddive\Icecat;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use Kevinrob\GuzzleCache\CacheMiddleware;
use Kevinrob\GuzzleCache\Storage\Psr6CacheStorage;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class IcecatBase
 * @package Rapiddive\Icecat
 */
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
     * @var string
     */
    private $cacheDir;

    /**
     * @var bool
     */
    private $debug = false;

    /**
     * IcecatBase constructor.
     *
     * @param string $username
     * @param string $password
     * @param string $cacheDir
     */
    public function __construct(
        string $username = '',
        string $password = '',
        string $cacheDir = ''
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->setCachePath($cacheDir);
        $this->init();
    }

    public function setCachePath($dir)
    {
        $this->cacheDir = $dir . '/var/cache/icecat/';
    }

    /**
     * Init Guzzle Instance
     */
    protected function init()
    {
        if (!$this->guzzle) {
            // Create a HandlerStack
            $stack = HandlerStack::create();
            $cache_strategy_class = '\\Kevinrob\\GuzzleCache\\Strategy\\PrivateCacheStrategy';
            $cache_storage =
                new Psr6CacheStorage(
                    new FilesystemAdapter('', 0, $this->cacheDir)
                );
            $stack->push(
                new CacheMiddleware(
                    new $cache_strategy_class(
                        $cache_storage
                    )
                ),
                'cache'
            );
            $this->guzzle = new Client(
                [
                    'base_uri' => $this->apiBaseUrl,
                    'auth' => [$this->getUsername(), $this->getPassword()],
                    'headers' => $this->headers,
                    'decode_content' => true,
                    'handler' => $stack
                ]
            );
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
     * @param bool $bool
     */
    public function setDebug(bool $bool)
    {
        $this->debug = $bool;
    }

    /**
     * @return Client
     */
    public function getGuzzle(): Client
    {
        return $this->guzzle;
    }

    /**
     * @param  $endpoint
     * @param  $params
     * @return bool|string
     */
    public function request($endpoint, $params)
    {
        try {
            $response = $this->guzzle->get(
                $endpoint,
                [
                    'query' => $params
                ]
            );
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
