<?php
/**@var \common\models\tables\Tasks $model */
/**@var integer $userId */
/**@var \common\models\tables\TaskStatuses[] $statusesList */
/**@var \common\models\tables\Users[] $usersList */
/**@var \common\models\tables\TaskComments $taskCommentForm */
/**@var \common\models\tables\TaskAttachments $taskAttachmentForm */
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;
use \yii\widgets\Pjax;

\frontend\assets\TaskOneAsset::register($this);
?>
  <?php Pjax::begin()?>
    <div class="comments">
      <h3>Комментарии</h3>
      <form action="#" method="post">
        <input type="hidden" name="user_id" value="<?=$userId?>"/>
        <input type="hidden" name="task_id" value="<?=$model->id?>"/>
        <input type="text" name="content"/>
          <?= \yii\helpers\Html::a("Добавить", ['pjax/add-comment'], ['id'=> 'btn-refresh','class' => 'btn btn-default']);?>
        <hr>
      </form>
      <div class="comment-history">
          <?foreach ($model->taskComments as $comment):?>
            <p><strong><?=$comment->user->username?></strong>: <?=$comment->content?></p>
          <?php endforeach;?>
      </div>
    </div>
  <?php Pjax::end()?>
