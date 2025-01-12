<?php

use Controllers\HLLController;

$HLLController = new HLLController();



Flight::route('POST /get_hll_sv_status', [$HLLController, 'getSvStatus']);
// Flight::route('/get_hll_sv_status/@id', [$HLLController, 'getSvStatus']);



// Flight::route('GET /get_hll_sv_status/@id_sv', function($id_sv, $HLLController) {

//     $HLLController->getSvStatus($id_sv);

// });


// Flight::route('GET /get_hll_sv_status', function (string $id) {
//     print_r($id);
// });