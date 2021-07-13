<?php

namespace App\Controllers;

use App\Components\Database;
use App\Components\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdsController
{
    /**
     * Create new ads
     *
     * @return void
     */
    public function store()
    {
        $request = Request::createFromGlobals();
        $validator = new Validator();
        if (!$validator->validateAds($request->request->all())) {
            $response = new JsonResponse(['message' => $validator->getErrors(), 'code' => 400, 'data' => []]);
            return $response->send();
        }
        $db = new Database();
        $db->createAds('ads', $request->request->all());
        $response = new JsonResponse([
            "message" => "OK",
            "code" => 200,
            "data" => [
                "id" => $db->lastId,
                "text" => $request->request->get('text'),
                "banner" => $request->request->get('banner')
            ],
        ]);
        return $response->send();
    }
    public function update(int $id)
    {
        var_dump(dirname(dirname(__DIR__)));
    }

    public function show()
    {
    }
}
