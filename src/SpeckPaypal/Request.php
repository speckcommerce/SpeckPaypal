<?php
namespace SpeckPaypal;

use Zend\Http\Client;
use Zend\Config\Config;

class Request
{
    const VERSION = '58.0';

    /*
     * @var \Zend\Http\Client
     */
    protected $client;

    /*
     * @var array
     */
    protected $config;

    /**
     * Make the paypal request and return a Response object
     *
     * @param AbstractModel $model
     * @return Response
     * @throws Exception
     */
    public function send(AbstractModel $model)
    {
        try {

            $client = $this->client;
            $config = $this->config;

            if(is_null($client)) {
                throw new Exception('Zend\Http\Client must be set.');
            }

            $client->setUri(new \Zend\Uri\Http($config->getEndpoint()));
            $client->setRawBody($config . $model);

            $httpResponse = $client->send();
            $response = new Response($httpResponse->getBody());

        } catch(Exception $e) {

            $response = new Response();
            $response->addError($e->getMessage());
        }

        return $response;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function setConfig(\SpeckPaypal\Element\Config $config)
    {
        $this->config = $config;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getConfig()
    {
        return $this->config;
    }
}