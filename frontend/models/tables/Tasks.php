<?php

namespace frontend\models\tables;

use frontend\commands\TaskController;
use frontend\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $description
 * @property int $responsible_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 * @property string $date_end
 *
 * @property TaskAttachments[] $taskAttachments
 * @property TaskComments[] $taskComments
 * @property TaskStatuses $status0
 * @property Users $responsible
 */
class Tasks extends \yii\db\ActiveRecord
{
    const EVENT_SEND_EMAIL = 'sendEmail';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date'], 'required'],
            [['date'], 'safe'],
            [['description'], 'string'],
            [['responsible_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatuses::className(), 'targetAttribute' => ['status' => 'id']],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['responsible_id' => 'id']],
            [['date_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' =>  'task_name',//\Yii::t('main', 'task_name'),
            'date' => 'Date',
            'description' => 'task_description',//\Yii::t('main', 'task_description'),
            'responsible_id' => 'Responsible ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'date_end' => 'Date end',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskComments()
    {
        return $this->hasMany(TaskComments::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Users::class, ["id" => "responsible_id"]);
    }
/*
    public function sendEmail()
    {
        $this->trigger(static::EVENT_SEND_EMAIL);

    }
*/
}
