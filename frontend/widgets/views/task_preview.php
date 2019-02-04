<?php

/**
 * @var $model \common\models\tables\Tasks
 */
?>

<div class="task-container">
    <a href="<?= \yii\helpers\Url::to(['task', 'id' => $model->id])?>" class="task-preview-link">
        <div class="task-preview">
            <div class="task-preview-header"><?= $model->name?></div>
            <div class="task-preview-content"><?= $model->description?></div>
            <div class="task-preview-user"><?= $model->responsible->username?></div>
        </div>
    </a>
</div>

