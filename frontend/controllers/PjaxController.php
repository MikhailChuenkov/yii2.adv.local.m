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

    public function actionAddComment($id)
    {
        if(\Yii::$app->user->can('TaskNotComment')){
            throw new ForbiddenHttpException();
        }
        $modelComments = new TaskComments();
        if($modelComments->load(\Yii::$app->request->post()) && $modelComments->save()){
            \Yii::$app->session->setFlash('success', "Комментарий добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        return $this->render('comment', [
            'model' => Tasks::findOne($id),
            'usersList' => Users::getUsersList(),
            'statusesList' => TaskStatuses::getList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),
            'channel' => 'Task_' . $id,
        ]);
    }
}