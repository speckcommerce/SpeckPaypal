<?php
namespace SpeckPaypal\Service;

use SpeckPaypal\Request\AbstractRequest;
use SpeckPaypal\Response\Response;

class Request
{
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
     * @param AbstractRequest $model
     * @return Response
     * @throws Exception
     */
    public function send(AbstractRequest $request)
    {
        try {

            $client = $this->client;
            $config = $this->config;

            if(false === $config->isValid()) {
                throw new \Exception("Configuration is not valid.");
            }

            if(is_null($client)) {
                throw new \Exception('Zend\Http\Client must be set and must be valid.');
            }

            if(false === $request->isValid()) {
                throw new \Exception(get_class($request) . " is invalid.");
            }

            $client->setMethod('POST');
            $client->setUri(new \Zend\Uri\Http($config->getEndpoint()));
            $client->setRawBody($config . $request);

            $httpResponse = $client->send();

            $response = new Response($httpResponse->getBody());

        } catch(\Exception $e) {

            $response = new Response();
            $response->addErrorMessage($e->getMessage());
        }

        return $response;
    }

    public function setClient(\Zend\Http\Client $client)
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