<?php

namespace Sweepo\CoreBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class ApiResponse
{
    public function __construct() {

    }

    /**
     * Return array data in a Json response
     * @param  array $data
     * @return Response
     */
    public function jsonResponse($data)
    {
        $response = $this->generateResponse();
        $response->setContent(json_encode($data));

        return $response;
    }

    /**
     * Serialize an Entity an return json Response
     * @param  Entity    $entity  An entity
     * @return Response
     */
    public function jsonSerializerResponse($entity)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $data = $serializer->serialize($entity, 'json');

        $response = $this->generateResponse();
        $response->setContent($data);

        return $response;
    }

    /**
     * Generate a standard response
     * @return Response
     */
    public function generateResponse()
    {
        $response = new Response();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}