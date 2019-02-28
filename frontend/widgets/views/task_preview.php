<?php

/**
 * @var $model \common\models\tables\Tasks
 */
?>
<?//var_dump($model); exit;?>
<div class="task-container">
    <a href="<?= \yii\helpers\Url::to(['task', 'id' => $model->id])?>" class="task-preview-link">
        <div class="task-preview <?=$taskPreviewColor//var_dump($taskPreviewColor);?>">
            <div class="task-preview-header">
              <span>Название задачи: </span>
                <?= $model->name?>
            </div>
            <div class="task-preview-content">
              <span>Описание задачи: </span>
                <?= $model->description?>
            </div>
            <div class="task-preview-content">
              <span>Задача поставлена: </span>
                <?= $model->created_at?>
            </div>
            <div class="task-preview-content">
              <span>Deadline: </span>
                <?= $model->date?>
            </div>
            <div class="task-preview-user">
              <span>Ответственный: </span>
                <?= $model->responsible->username?>
            </div>
            <div class="<?=$dateTimeEndView?>">
              <span>Задача выполнена: </span>
                <?=$dateTimeEnd?>
            </div>
        </div>
    </a>
</div>

