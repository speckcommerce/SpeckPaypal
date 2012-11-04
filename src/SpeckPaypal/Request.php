<?php
namespace SpeckPaypal;

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
                throw new \Exception('Zend\Http\Client must be set.');
            }

            if(false === $model->isValid()) {
                throw new \Exception(get_class($model) . " is invalid.");
            }

            $client->setUri(new \Zend\Uri\Http($config->getEndpoint()));
            $client->setRawBody($config . $model);

            $httpResponse = $client->send();
            $response = new Response($httpResponse->getBody());

        } catch(\Exception $e) {

            $response = new Response();
            $response->addError($e->getMessage());
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