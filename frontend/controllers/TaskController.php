<?php


namespace frontend\controllers;


use frontend\models\forms\TaskAttachmentsAddForm;
//use common\models\tables\TaskAttachments;
use common\models\tables\TaskComments;
use common\models\tables\Tasks;
use common\models\tables\TaskStatuses;
use common\models\tables\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
//use common\models\filters\TasksSearch;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;


class TaskController extends Controller
{
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $month = $request->post('date');
        $model = new Tasks();
        if($month != NULL){
            $query = Tasks::find()
                ->where(['MONTH(date)' => $month]);
        }else{
            $query = Tasks::find();
        }

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,

        ]);
    }

    public function actionTask($id)
    {
        /*if(!\Yii::$app->user->can('TaskEdit')){
            throw new ForbiddenHttpException();
        }*/
        return $this->render('one', [
            'model' => Tasks::findOne($id),
            'usersList' => Users::getUsersList(),
            'statusesList' => TaskStatuses::getList(),
            'userId' => \Yii::$app->user->id,
            'taskCommentForm' => new TaskComments(),
            'taskAttachmentForm' => new TaskAttachmentsAddForm(),

        ]);
    }

    public function actionAddComment()
    {
        if(\Yii::$app->user->can('TaskNotComment')){
            throw new ForbiddenHttpException();
        }
        $model = new TaskComments();
        if($model->load(\Yii::$app->request->post()) && $model->save()){
            \Yii::$app->session->setFlash('success', "Комментарий добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить комментарий");
        }
        $this->redirect(\Yii::$app->request->referrer);

    }

    public function actionAddAttachment()
    {
        if(\Yii::$app->user->can('TaskNotComment')){
            throw new ForbiddenHttpException();
        }
        $model = new TaskAttachmentsAddForm();
        $model->load(\Yii::$app->request->post());
        $model->file = UploadedFile::getInstance($model, 'file');
        if($model->save()){
            \Yii::$app->session->setFlash('success', "Файл добавлен");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось добавить файл");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionSave($id)
    {

        if($model = Tasks::findOne($id)){
            $model->load(\Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменеия сохранены");
        }else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!\Yii::$app->user->can('TaskCreate')){
            //$this->redirect('site/login');
            throw new ForbiddenHttpException();
        }
        $model = new Tasks();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'usersList' => Users::getUsersList(),
        ]);
    }
}