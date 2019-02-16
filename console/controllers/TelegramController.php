<?php


namespace console\controllers;

use common\models\tables\TelegramOffset;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{
    /**@var Component*/
    private $bot;
    private $offset = 0;

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }

    public function actionIndex()
    {
        $updates = $this->bot->getUpdates($this->getOffset() +1);
        $updCount = count($updates);
        if($updCount > 0){
            foreach ($updates as $update){
                $this->updateOffset($update);
                $this->processCommand($update->getMessage());
            }
            echo "Новых сообщений: " . $updCount . PHP_EOL;
        } else {
            echo "Новых сообщений нет" . PHP_EOL;
        }
    }

    private function getOffset(){
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;
    }

    private function updateOffset(Update $update){
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'telegram_offset' => date('Y-m-d H:i:s'),
        ]);
        $model->save();
    }

    private function processCommand(Message $message){
        var_dump($message->getText());
    }
}