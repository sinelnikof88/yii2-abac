<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\TargetRule */

$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = ['label' => 'Target Rules', 'url' => ['index']];
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

    <div class="target-rule-view">

        <?=
        \common\extensions\box\Box::widget([
            'name' => 'target-rule',
            'id' => 'target-rule_box_view',
            'info' => $this->title,
            'btn' => [
                Html::a('Управление', ['index'], ['data-pjax' => '0', 'class' => 'btn btn-primary']),
                Html::a('Добавить', ['create'], ['data-pjax' => '0', 'class' => 'btn btn-success']),
            ],
            'is_collapsed' => false,
            'text' => yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "\n {pager}\n{summary}\n{items}\n{pager}",
                'columns' => [
                    'id',
                    [
                        'format' => 'raw',
                        'value' => function ($model) {

                            return $model->name.'<br>' . PHP_EOL . $model->class . PHP_EOL . $model->code;
                        }
                    ],
                ],
            ])
        ])
        ?>

    </div>
</div>
<div class="clearfix"></div>
<?php
yii\bootstrap\Modal::end();

