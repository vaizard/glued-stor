<?php

declare(strict_types=1);

namespace Glued\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Glued\Classes\Exceptions\AuthTokenException;
use Glued\Classes\Exceptions\AuthJwtException;
use Glued\Classes\Exceptions\AuthOidcException;
use Glued\Classes\Exceptions\DbException;
use Glued\Classes\Exceptions\TransformException;

class ServiceController extends AbstractController
{

    /**
     * Returns an exception.
     * @param  Request  $request  
     * @param  Response $response 
     * @param  array    $args     
     * @return Response Json result set.
     */
    public function stub(Request $request, Response $response, array $args = []): Response {
        throw new \Exception('Stub method served where it shouldnt. Proxy misconfigured?');
    }

    /**
     * Returns a health status response.
     * @param  Request  $request  
     * @param  Response $response 
     * @param  array    $args     
     * @return Response Json result set.
     */
    public function health(Request $request, Response $response, array $args = []): Response {
        $params = $request->getQueryParams();
        $data = [
                'timestamp' => microtime(),
                'status' => 'OK',
                'params' => $params,
                'service' => basename(__ROOT__),
            ];
        return $response->withJson($data);
    }

    /**
     * List available drives
     * @param  Request  $request
     * @param  Response $response
     * @param  array    $args
     * @return Response Json result set.
     */
    public function spaces_r1(Request $request, Response $response, array $args = []): Response {
        $params = $request->getQueryParams();
        $data = [
                'timestamp' => microtime(),
                'status' => 'Spaces r1 OK',
                'params' => $params,
                'service' => basename(__ROOT__),
            ];
        return $response->withJson($data);
    }

    public function spaces_w1(Request $request, Response $response, array $args = []): Response {
        $params = $request->getQueryParams();
        $data = [
            'timestamp' => microtime(),
            'status' => 'Spaces w1 OK',
            'params' => $params,
            'service' => basename(__ROOT__),
        ];
        return $response->withJson($data);
    }

    /**
     * Gets all files in a space
     * @param  Request  $request
     * @param  Response $response
     * @param  array    $args
     * @return Response Json result set.
     */
    public function files_r1(Request $request, Response $response, array $args = []): Response {
        $params = $request->getQueryParams();
        $data = [
                'timestamp' => microtime(),
                'status' => 'Files r1 OK',
                'params' => $params,
                'service' => basename(__ROOT__),
            ];
        return $response->withJson($data);
    }

    public function files_w1(Request $request, Response $response, array $args = []): Response {
        $params = $request->getQueryParams();
        $data = [
            'timestamp' => microtime(),
            'status' => 'Files w1 OK',
            'params' => $params,
            'service' => basename(__ROOT__),
        ];
        return $response->withJson($data);
    }


    public function download(Request $request, Response $response, array $args = []): Response {
        $params = $request->getQueryParams();
        $data = [];

        $curl_handle = curl_init();
        $extra_opts[CURLOPT_URL] = $uri;
        $curl_options = array_replace( $this->settings['php']['curl'], $extra_opts );
        curl_setopt_array($curl_handle, $curl_options);
        $data = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $data;

        return $response->withJson($data);
    }

    public function annotations_r1(Request $request, Response $response, array $args = []): Response {
        $headers = '';
        foreach ($request->getHeaders() as $name => $values) {
            $headers .= $name . ": " . implode(", ", $values);
        }
        $r = [
            'qp' => $request->getQueryParams(),
            'pb' => $request->getParsedBody(),
            'fi' => $request->getUploadedFiles(),
            'hd' => $headers
        ];
        return $response->withJson($r);
    }

    public function annotations_w1(Request $request, Response $response, array $args = []): Response {
        $headers = '';
        foreach ($request->getHeaders() as $name => $values) {
            $headers .= $name . ": " . implode(", ", $values);
        }
        $r = [
            'qp' => $request->getQueryParams(),
            'pb' => $request->getParsedBody(),
            'fi' => $request->getUploadedFiles(),
            'hd' => $headers
        ];
        return $response->withJson($r);
    }

    public function annotations_d1(Request $request, Response $response, array $args = []): Response {
        $headers = '';
        foreach ($request->getHeaders() as $name => $values) {
            $headers .= $name . ": " . implode(", ", $values);
        }
        $r = [
            'qp' => $request->getQueryParams(),
            'pb' => $request->getParsedBody(),
            'fi' => $request->getUploadedFiles(),
            'hd' => $headers
        ];
        return $response->withJson($r);
    }
}