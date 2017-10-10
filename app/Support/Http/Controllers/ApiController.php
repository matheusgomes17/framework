<?php

namespace MVG\Support\Http\Controllers;

use MVG\Support\Http\Api\Response;
use MVG\Support\Http\Api\Parameters;

/**
 * Abstract Class ApiController
 *
 */
abstract class ApiController extends Controller
{
    /**
     * API response helper.
     *
     * @var \MVG\Support\Http\Api\Response
     */
    protected $response;
    /**
     * API parameters helper.
     *
     * @var \MVG\Support\Http\Api\Parameters
     */
    protected $parameters;

    /**
     * Creates a new class instance.
     *
     * @param Response $response
     * @param Parameters $parameters
     */
    public function __construct(Response $response, Parameters $parameters)
    {
        $this->response = $response;
        $this->parameters = $parameters;
    }
}
