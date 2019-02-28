<?php


namespace frontend\modules\v1\controllers;


use common\models\tables\Message;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class MessageController extends ActiveController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] =[
            'class' => HttpBearerAuth::class,
            /*'auth' => function($username, $password){
                $user = User::findByUsername($username);
                if($user !== null && $user->validatePassword($password)){
                    return $user;
                }
                return null;
            }*/
        ];
        return $behaviors;
    }


    public $modelClass = Message::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $filter = \Yii::$app->request->get('filter');
        $query = Message::find();

        if($filter){
            $query->filterWhere($filter);
        }

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}