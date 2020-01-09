<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\Rule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = ['label' => 'Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


yii\bootstrap\Modal::begin([
        'id' => 'modalBox',
        'size' => 'modal-lg',
        'clientOptions' => ['show' => true],
        'options' => [
            ''
        ],
    ]);
?>    
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">

<div class="rule-view">
  
    <?=  \common\extensions\box\Box::widget([
       'name' => 'rule',
       'id' => 'rule_box_view',
       'info' => $this->title,
        'btn' => [
            Html::a('Управление', ['index'], ['data-pjax' => '0','class' => 'btn btn-primary']),
            Html::a('Добавить', ['create'], ['data-pjax' => '0','class' => 'btn btn-success']),
            Html::a('Изменить', ['update','id' => $model->id], ['data-pjax' => '0','class' => 'btn btn-warning']),
            Html::a('Просмотр', ['view', 'id' => $model->id], ['data-pjax' => '0','class' => 'btn btn-secondary']),
            Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Уверены что хотите удалить элемент?',
                    'method' => 'post',
                ],
            ])
        ],
       
       'is_collapsed' => false,
       'text' =>DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'class',
            ],
        ])
    ])?>

</div>
</div>
<div class="clearfix"></div>
 <?php
yii\bootstrap\Modal::end();
 
 