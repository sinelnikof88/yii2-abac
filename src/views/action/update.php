<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\Action */

$this->title = 'Update Action: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = ['label' => 'Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">

<div class="action-update">
 
  <?=  \common\extensions\box\Box::widget([
       'name' => 'action',
       'id' => 'action_box_update',
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
