<?php
namespace console\controllers;

class SocketController extends \yii\console\Controller
{
    public function actionRun()
    {
        $server = \Ratchet\Server\IoServer::factory(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    new \console\components\Chat()
                )
            ),
            8080
        );
        $server->run();
    }

}