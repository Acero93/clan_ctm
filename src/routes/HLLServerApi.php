<?php

use Controllers\HLLController;

$HLLController = new HLLController();



Flight::route('POST /get_hll_sv_status', [$HLLController, 'getSvStatus']);
