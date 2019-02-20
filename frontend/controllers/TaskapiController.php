<?php


namespace frontend\controllers;


use frontend\models\tables\Tasks;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class TaskapiController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $filter = \Yii::$app->request->get('filter');
        $query = Tasks::find();

        if($filter){
            $query->filterWhere($filter);
        }

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}