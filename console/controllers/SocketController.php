<?php
namespace console\controllers;

class SocketController extends \yii\console\Controller
{
    public function actionStartSocket($port=8080)
    {
        $server = \Ratchet\Server\IoServer::factory(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    new \console\components\Chat()
                )
            ),
            $port
        );
        $server->run();
    }

}