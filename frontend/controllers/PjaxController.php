<?php


namespace frontend\controllers;


use common\models\tables\TaskComments;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\tables\Users;
use frontend\models\forms\TaskAttachmentsAddForm;
use yii\web\Controller;

/**@var \common\models\tables\Tasks $model */

class PjaxController extends Controller
{
    public function actionTime()
    {
        $time = date("H:i:s");
        return $this->render(
            'time',
            ['time' => $time]
        );
    }

    public function actionHours()
    {
        $time = date("H:i:s");
        return $this->render(
            'date',
            ['time' => $time]
        );
    }

    public function actionMinutes()
    {
        $time = date("i:s");
        return $this->render(
            'date',
            ['time' => $time]
        );
    }

    public function actionMultiple()
    {
        $time = date("H:i:s");
        $hash = md5($time);
        return $this->render('multiple', [
            'time' => $time,
            'hash' => $hash,
        ]);
    }

}