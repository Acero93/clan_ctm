<?php

use Controllers\HLLController;

$HLLController = new HLLController();


Flight::route('POST /get_hll_sv_status', [$HLLController, 'getSvStatus']);
Flight::route('POST /get_server_data', [$HLLController, 'getServerData']);
Flight::route('POST /get_player_list', [$HLLController, 'getPlayerList']);
Flight::route('POST /ban_player', [$HLLController, 'banPlayer']);
Flight::route('POST /kick_player', [$HLLController, 'kickPlayer']);
Flight::route('POST /kick_player_no_clan', [$HLLController, 'kickPlayersNoClan']);
Flight::route('POST /message_player', [$HLLController, 'sendBroadcastMessage']);
Flight::route('POST /message_masive_players', [$HLLController, 'sendMasiveBroadcastMessage']);
Flight::route('POST /rotate_map', [$HLLController, 'rotateMap']);


// rotar mapa