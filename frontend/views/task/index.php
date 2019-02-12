<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\UsersSearch */
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
      <?= Html::submitButton('Выбрать', ['class' => 'btn btn-success']) ?>
  </div>

<?php \yii\widgets\ActiveForm::end(); ?>


<?

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function($model){
  return \frontend\widgets\TaskPreview::widget([
      'model' => $model
  ]);
    },
    'summary' => false,
    'options' => [
            'class' => 'preview-container'
    ]
  ]);

?>