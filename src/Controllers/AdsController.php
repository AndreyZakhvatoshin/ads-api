<?php

namespace App\Controllers;

use App\Components\Database;
use App\Components\Validator;
use Symfony\Component\HttpFoundation\Request;

class AdsController
{
    public function index()
    {
        $db = new Database();
        var_dump($db);
    }

    public function store()
    {
        $request = Request::createFromGlobals();
        $validator = new Validator();
        if (!$validator->validateAds($request->request->all())) {
            header('Content-Type: application/json');
            echo json_encode(['errors' => $validator->getErrors(), 'code' => 400, 'data' => []]);
        }
        
    }

    public function update(int $id)
    {
        var_dump(dirname(dirname(__DIR__)));
    }

    public function show()
    {}
}
