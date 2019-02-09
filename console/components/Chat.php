<?php
namespace console\components;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{

    protected $clients;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
        echo "server started\n";
    }


    function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection : {$conn->resourceId}\n";
    }

    function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "user {$conn->resourceId} disconect!";
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "\nconn {$conn->resourceId} closed with error\n";
        $conn->close();
        $this->clients->detach($conn);
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        $userId = \Yii::$app->user->id;
        var_dump($userId); //exit;
        echo "{$userId}: {$msg}\n";
        foreach ($this->clients as $client){
            $client->send($msg);
        }
    }


}