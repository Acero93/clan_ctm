<?php

use Controllers\TacticalController;

$TacticalController = new TacticalController();


Flight::route('POST /viewmap', [$TacticalController, 'maplist']);
Flight::route('POST /savemap', [$TacticalController, 'savemap']);
