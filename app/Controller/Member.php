<?php
namespace App\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
class Member
{
    public function login(Request $request, Response $response, $args)
    {
      $fromedata = $request->getParams();
      $db = new \App\Tools\Database();
      $responseData = null;
      $result = $db->query("SELECT * FROM user WHERE username='".$fromedata['username']."' LIMIT 1 ");
      if($result['rowCount']>0){
        if($result['result'][0]['password']==$fromedata['password']){
           $responseData = array(
          "message" => "สวยงาม",
          "success" => true,
          "data" => $result['result'][0],
           );
          }
        else{
        $responseData = array(
          "message" => "รหัสผ่านไม่ถูกต้อง",
          "success" => false,
        );

      }
    }
      else{
        $responseData = array(
          "message" => "ไม่พบผู้ใช้งานนี้",
          "success" => false,
        );

      }
        $response->getBody()->write(\json_encode($responseData ));
        return $response;
    }
}