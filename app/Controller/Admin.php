<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Admin
{
    public function ongetgroupchange(Request $request, Response $response, $args)
    {
        $fromedata = $request->getParams();
        $db = new \App\Tools\Database();
        $result = $db->query("SELECT* FROM s_organization, (SELECT * FROM study_group LEFT JOIN advisors  ON advisors.id_group = study_group.study_group_id) as sa WHERE s_organization.code=sa.mj_code AND sa.id_ad is NULL");
        $response->getBody()->write(\json_encode($result));
        return $response;
    }

    public function ongetmajor(Request $request, Response $response, $args)
    {
        $fromedata = $request->getParams();
        if (isset($fromedata["data"])) {
            $dataReceive = json_decode($fromedata["data"], true);
        }
        $db = new \App\Tools\Database();
        $result = $db->query("SELECT acronym,code,name_th  FROM s_organization ");
        $response->getBody()->write(\json_encode($result));
        return $response;
    }

    public function ondeletegroup(Request $request, Response $response, $args)
    {
        $fromedata = $request->getParams();
        $delgroup = $args["delete_group"];
        if (isset($fromedata["study_group_id"])) {
            $dataReceive = json_decode($fromedata["study_group_id"], true);
        }
        $db = new \App\Tools\Database();
        $result = $db->query("DELETE FROM study_group WHERE study_group_id='" . $args["delete_group"] . "'");
        $response->getBody()->write(\json_encode($result));
        return $response;
    }

    public function ongetgroup_teacher(Request $request, Response $response, $args)
    {
        $fromedata = $request->getParams();
        if (isset($fromedata["data"])) {
            $dataReceive = json_decode($fromedata["data"], true);
        }
        $db = new \App\Tools\Database();
        $result = $db->query("SELECT * FROM advisors LEFT JOIN study_group  ON advisors.id_group = study_group.study_group_id");
        $response->getBody()->write(\json_encode($result));
        return $response;
    }

    public function ongetgroup_notNULL(Request $request, Response $response, $args)
    {
        $fromedata = $request->getParams();
        if (isset($fromedata["data"])) {
            $dataReceive = json_decode($fromedata["data"], true);
        }
        $db = new \App\Tools\Database();
        $result = $db->query("SELECT * FROM advisors,s_organization,study_group WHERE advisors.id_group=study_group.study_group_id AND study_group.mj_code = s_organization.code");
        $response->getBody()->write(\json_encode($result));
        return $response;
    }

}
