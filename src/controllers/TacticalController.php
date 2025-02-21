<?php

namespace Controllers;
use Models\TacticalModel;
use Flight;



class TacticalController {


    private $token;
    private $model;
    private $data;

    public function __construct() {
        // $this->token = $_ENV['TOKEN'];

        $this->model = new TacticalModel();
        $this->data  = Flight::request()->data->getData();
    }


    public function maplist() {

        Flight::json([
            "success" => true,
            "status" => "success",
            "message" => json_decode($this->model->getAll(), true)
        ]);
    }

    public function savemap() {

        Flight::json([
            "success" => true,
            "status" => "success",
            "message" => json_decode($this->model->save($this->data), true)
        ]);

    }

}