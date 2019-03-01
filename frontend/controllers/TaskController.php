<?php


namespace frontend\controllers;


use common\models\tables\Project;
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
        $projectId = $request->post('project');
        $dateNow = date('Y-m-d');
        $model = new Tasks();

        $dateNowRequest = $request->post('dateNow');


        //var_dump($model); exit;
        if(($month != NULL) || ($projectId != NULL)){
            $query = Tasks::find()
                ->where(['MONTH(date)' => $month])
                ->orWhere(['project_id' => $projectId]);
        }else if ($dateNowRequest != NULL){
            $query = Tasks::find()
                ->where('date < NOW()');
        }else{
            $query = Tasks::find();
        }

        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);

        $queryProjects = Project::find()
            ->all();

        $queryProjectArray = [];
        foreach ($queryProjects as $key => $queryProject){
            $queryProjectArray[$key + 1] = $queryProject->title;
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'queryProjectArray' => $queryProjectArray,
            'projectId' => $projectId,
            'dateNow' => $dateNow,
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
            'channel' => 'Task_' . $id,
        ]);
    }

    public function actionAddComment()
    {
        if(\Yii::$app->user->can('TaskNotComment')){
            throw new ForbiddenHttpException();
        }
        $model = new TaskComments();
        if($model->load(\Yii::$app->request->post()) && $model->save()) {
            $id = $model->task_id;
            return $this->render('_comment', [
                'model' => Tasks::findOne($id),
                'userId' => \Yii::$app->user->id,
                'taskCommentForm' => new TaskComments(),
            ]);
        }

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
            if($model->status == 6){
                $dateEnd = date("Y-m-d");
                $model->date_end = $dateEnd;
            }
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
        /*
        if(!\Yii::$app->user->can('TaskCreate')){
            //$this->redirect('site/login');
            throw new ForbiddenHttpException();
        }
        */
        $model = new Tasks();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['task', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'usersList' => Users::getUsersList(),
        ]);
    }
}