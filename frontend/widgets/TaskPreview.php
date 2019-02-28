<?php


namespace frontend\widgets;


use common\models\tables\Tasks;
use yii\base\Widget;

class TaskPreview extends Widget
{
    public $model;

    public function run()
    {
        if(is_a($this->model, Tasks::class)){

            $taskPreviewColor = 'task-preview-green';

            switch ($this->model->status) {
                case 2:
                    $taskPreviewColor = 'task-preview-blue';
                    break;
                case 3:
                    $taskPreviewColor = 'task-preview-pink';
                    break;
                case 4:
                    $taskPreviewColor = 'task-preview-orange';
                    break;
                case 5:
                    $taskPreviewColor = 'task-preview-red';
                    break;
                case 6:
                    $taskPreviewColor = 'task-preview-grey';
                    break;
            }

            $dateTimeEndView = "no-view";
            $dateTimeEnd = "";

            if(!is_null($this->model->date_end)){
                $dateTimeEndView = "view";
                $dateTimeEnd = $this->model->date_end;
            }


            return $this->render('task_preview',[
                'model' => $this->model,
                'taskPreviewColor' => $taskPreviewColor,
                'dateTimeEndView' => $dateTimeEndView,
                'dateTimeEnd' => $dateTimeEnd,
            ]);
        }
        throw new \Exception("Невозможно отобразить модель.");
    }

}