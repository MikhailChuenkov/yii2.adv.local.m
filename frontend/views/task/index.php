<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\filters\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/*

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
*/
\frontend\assets\TaskAsset::register($this);
?>
    <p>
        <?= Html::a('Create Tasks', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

  <div>Выберите месяц deadline</div>
<?php $form = \yii\widgets\ActiveForm::begin(); ?>

  <div class="form-group">
      <?=
      Html::dropDownList('date',[],
          [
              '1' => 'январь',
              '2' => 'февраль',
              '3' => 'март',
              '4' => 'апрель',
              '5' => 'май',
              '6' => 'июнь',
              '7' => 'июль',
              '8' => 'август',
              '9' => 'сентябрь',
              '10' => 'октябрь',
              '11' => 'ноябрь',
              '12' => 'декабрь',
          ]);
 ?>
  </div>

  <div class="form-group">
      <?= Html::submitButton('Выбрать месяц', ['class' => 'btn btn-success']) ?>
  </div>

<?php \yii\widgets\ActiveForm::end(); ?>

<div>Выберите проект</div>
<?php $form = \yii\widgets\ActiveForm::begin(); ?>

  <div class="form-group">
      <?=
      Html::dropDownList('project',[], $queryProjectArray
      );
      ?>
  </div>

  <div class="form-group">
      <?= Html::submitButton('Выбрать проект', ['class' => 'btn btn-success']) ?>
  </div>

<?php \yii\widgets\ActiveForm::end(); ?>

<?php $form = \yii\widgets\ActiveForm::begin(); ?>

      <?= Html::input('date', 'dateNow', $dateNow, ['class' => 'no-view']) ?>

  <div class="form-group">
      <?= Html::submitButton('Показать просроченные задачи', ['class' => 'btn btn-success']) ?>
  </div>

<?php \yii\widgets\ActiveForm::end(); ?>

<div>Вы выбрали проект: <?=$queryProjectArray["$projectId"]?></div>
<?
echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    //'taskPreviewColor' => $taskPreviewColor,
    'itemView' => function($model){
  return \frontend\widgets\TaskPreview::widget([
      'model' => $model,
  ]);
    },
    'summary' => false,
    'options' => [
            'class' => 'preview-container'
    ]
  ]);

?>