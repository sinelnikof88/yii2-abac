<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\TargetRule */

$this->title = 'Update Target Rule: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = ['label' => 'Target Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">

<div class="target-rule-update">
 
  <?=  \common\extensions\box\Box::widget([
       'name' => 'target-rule',
       'id' => 'target-rule_box_update',
       'info' => $this->title,
       'btn' => [
            Html::a('Управление', ['index'], ['class' => 'btn btn-primary']),
            Html::a('Добавить', ['create'], ['class' => 'btn btn-success']),
            Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-secondary']),
            Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Уверены что хотите удалить элемент?',
                    'method' => 'post',
                ],
            ])
        ],
        'is_collapsed' => false,
        'text' =>$this->render('_form', [
        'model' => $model,
        ])
     ])?>

</div>
</div>
