<?php

namespace App\Controllers;

use App\Components\Database;
use App\Components\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AdsController
{
    /**
     * Create new advertisements
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
                "banner" => $request->request->get('banner'),
            ],
        ]);
        return $response->send();
    }

    /**
     * Updating advertisements
     *
     * @param integer $id
     * @return void
     */
    public function update(int $id)
    {
        $request = Request::createFromGlobals();
        $validator = new Validator();
        if (!$validator->validateUpdateAds($request->request->all())) {
            $response = new JsonResponse(['message' => $validator->getErrors(), 'code' => 400, 'data' => []]);
            return $response->send();
        }
        $db = new Database();
        $db->updateAds('ads', $id, $request->request->all());
        $ads = $db->getUpdatingAds();
        $response = new JsonResponse([
            "message" => "OK",
            "code" => 200,
            "data" => [
                "id" => $ads['id'],
                "text" => $ads['text'],
                "banner" => $ads['banner'],
            ],
        ]);
        return $response->send();
    }

    /**
     * Show advertisements with max price
     *
     * @return void
     */
    public function relevant()
    {
        $db = new Database();
        $ads = $db->relevant('ads');
        $response = new JsonResponse([
            "message" => "OK",
            "code" => 200,
            "data" => [
                "id" => $ads['id'],
                "text" => $ads['text'],
                "banner" => $ads['banner'],
            ],
        ]);
        return $response->send();
    }
}
