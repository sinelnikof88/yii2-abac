<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel sinelnikof88\abac\models\ActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Управление доступом';
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">
    <div class="action-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

        <?=
        \common\extensions\box\Box::widget([
            'name' => 'Настройки',
            'id' => 'action_box_index',
            'info' => $this->title,
            'btn' => [
                   Html::a('Настройки', \yii\helpers\Url::to(['./setting']), ['class' => 'btn btn-warning']),
                Html::a('Политики', \yii\helpers\Url::to(['./policy']), ['class' => 'btn btn-primary']),
                Html::a('Связи политики и правил', \yii\helpers\Url::to(['./policy-rule']), ['class' => 'btn btn-primary']),
                Html::a('Правила', \yii\helpers\Url::to(['./rule']), ['class' => 'btn btn-primary']),
                Html::a('Назначения', \yii\helpers\Url::to(['./target-rule']), ['class' => 'btn btn-success']),
                Html::a('Действия', \yii\helpers\Url::to(['./action']), ['class' => 'btn btn-primary']),
                Html::a('Элементы', \yii\helpers\Url::to(['./element']), ['class' => 'btn btn-primary']),
                Html::a('Стенд', \yii\helpers\Url::to(['stand']), ['class' => 'btn btn-danger']),
            ],
            'is_collapsed' => false,
            'text' => $this->render('_form', ['model' => $model])
        ]);
        ?>
    </div>
</div>