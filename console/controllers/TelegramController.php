<?php


namespace console\controllers;

use backend\models\tables\Tasks;
use common\models\tables\TelegramOffset;
use common\models\tables\TelegramSubscribe;
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
        $params = explode(" ", $message->getText());
        $command = $params[0];
        $response = "Unknown Command";
        switch ($command){
            case '/help':
                $response = "Доступные команды: \n";
                $response .= "/help - список команд \n";
                $response .= "/project_create ##project_name## - создание команды \n";
                $response .= "/task_create ##task_name## ##date_deadline## ##description## ##responsible_id## - создание команды \n";
                $response .= "/sp_create - подписка на созданные проекты \n";
                break;
            case '/sp_create':
                $model = new TelegramSubscribe([
                    'chat_id' => $message->getFrom()->getId(),
                    'channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE,
                ]);
                if ($model->save()) {
                    $response = 'Вы подписаны на оповещение о создании новых проектов';
                }else{
                    $response = 'Ошибка';
                }
            case '/task_create':
                $modelTasks = new Tasks([
                    'name' => $params[1],
                    'date' => $params[2],
                    'description' => $params[3],
                    'responsible_id' => $params[4],
                    'created_at' => date('Y-m-d'),
                ]);
                if ($modelTasks->save()) {
                    $response = "Задача {$params[1]} создана.";
                }else{
                    $response = 'Что-то пошло не так...';
                }
        }
        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }
}