<?php

namespace Controllers;
// use Models\ClientModel;
use Flight;


class HLLController {

    public function getSvStatus () {


        $data = Flight::request()->data;
        $id_sv = $data["id_sv"];

        $url = "http://server{$id_sv}.rconctm.xyz/api/get_public_info";
        $response = file_get_contents($url);
        
        if ($response !== false) {
            Flight::json(["success" => true, "status" => "success","message" => json_decode($response,true)]);
        }

    }

}
