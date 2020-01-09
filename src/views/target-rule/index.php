<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel sinelnikof88\abac\models\TargetRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Target Rules';
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">
    <div class="target-rule-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?=
        \common\extensions\box\Box::widget([
            'name' => 'target-rule',
            'id' => 'target-rule_box_index',
            'info' => $this->title,
            'btn' => [
                Html::a('Управление', ['index'], ['class' => 'btn btn-primary']),
                Html::a('Добавить', ['create'], ['class' => 'btn btn-success']),
            ],
            'is_collapsed' => false,
            'text' => GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "\n {pager}\n{summary}\n{items}\n{pager}",
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'target_id',
                    'target.name',
                    [
                        'label' => 'Правило',
                        'format' => 'raw',
                        'value' => function ($param) {
                            return @Html::a($param->policy->name, Url::to(['/abac/policy/index/', 'PolicySearch' => ['name' => $param->policy->name]]), [
                                        'class' => 'text-info',
                                        'title' => Yii::t('app', 'Просмотр элемента'),
                            ]);
                        }
                    ],
                    'date_create',
                    'date_update',
                    //'is_delete',
                    [
                        'class' => yii\grid\ActionColumn::className(),
                        'template' => '{view}  {update}  {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                //return Html::a('<i style="color:#333333" class="fas fa-eye"></i>', $url, [
                                //            'title' => Yii::t('yii', 'View'),
                                //         //   'data-pjax' => '0',
                                //]);
                                return yii\helpers\Html::button('<i class="fas fa-eye"></i>', [
                                            'size' => 'modal-lg',
                                            'class' => 'btn btn-xs btn-success',
                                            'data-pjax' => '0',
                                            'onclick' => '
                                    $.pjax({
                                        type: "GET",
                                        url: "' . $url . '",
                                        container: "#pjaxModalUniversal",
                                        push: false,
                                        timeout: 10000,
                                        scrollTo: false
                                    })'
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i style="color:#333333" class="fas fa-pencil-alt"></i>', $url, [
                                            'title' => Yii::t('yii', 'Update'),
                                            'data-pjax' => '0',
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i style="color:#cc5555" class="fas fa-trash"></i>', $url, [
                                            'title' => Yii::t('yii', 'Delete'),
                                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                            'data-method' => 'post',
                                            'data-pjax' => '0',
                                ]);
                            },
                        ],
                    ],
                ],
            ])
        ]);
        ?>
    </div>
</div>