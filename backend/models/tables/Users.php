<?php

namespace backend\models\tables;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $password
 *
 * @property Tasks $id0
 * @property string Users $user

 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash'], 'required'],
            [['username', 'password_hash'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['id' => 'responsible_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Name',
            'password_hash' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId()
    {
        return $this->hasOne(Tasks::className(), ['responsible_id' => 'id']);
    }

    public function getUser()
    {
        return //"Привет";
            $this->hasOne(Tasks::className(), ['responsible_id' => 'id']);

    }

    public function fields()
    {
        return [
            'id',
            'username' => 'name',
            'password_hash',
        ];

    }

    public static function getUsersList()
    {
        $users = static::find()
            ->select(['id', 'username'])
            ->asArray()
            ->all();
        return ArrayHelper::map($users, 'id', 'name');
    }
}
