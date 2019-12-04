<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Student
{
    public function getAllStudent(Request $request, Response $response, $args)
    {
        $fromedata = $request->getParams();
        $db = new \App\Tools\Database();
        $result = $db->query("SELECT * FROM `student`");
        $response->getBody()->write(\json_encode($result));
        return $response;
    }

}
