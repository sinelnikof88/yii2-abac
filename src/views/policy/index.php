<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel sinelnikof88\abac\models\PolicySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Policies';
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">
    <div class="policy-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?=
        \common\extensions\box\Box::widget([
            'name' => 'policy',
            'id' => 'policy_box_index',
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
                '----------',
                Html::a('Управление', ['index'], ['class' => 'btn btn-primary']),
                Html::a('Добавить', ['create'], ['class' => 'btn btn-success']),
            ],
            'is_collapsed' => false,
            'text' => GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "\n {pager}\n{summary}\n{items}\n{pager}",
//                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'name',
//                    'is_active',
                    [
                        'format' => 'raw',
                        'label' => 'К кому применимо',
                        'value' => function ($model) {
                            return yii\helpers\Html::button('<i class="fas fa-plus"></i>', [
                                        'size' => 'modal-lg',
                                        'class' => 'btn btn-xs btn-warning',
                                        'data-pjax' => '0',
                                        'title' => 'Добавление нового назначения',
                                        'onclick' => '
                                    $.pjax({
                                        type: "GET", 
                                        url: "/abac/policy/add-target/' . $model->id . '",
                                        container: "#pjaxModalUniversal",
                                        push: false,
                                        timeout: 10000,
                                        scrollTo: false
                                    })'
                                    ]) .
                                    GridView::widget([
                                        'layout' => " {items} ",
                                        'showHeader' => false,
                                        'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->target]),
                                        'columns' => [
//                                            'name',
                                            [
                                                'format' => 'raw',
                                                'value' => function ($param) {
                                                    return Html::a('<i class="fa fa-eye"></i>', 'javascript:void(0);', [
                                                                'class' => 'text-info',
                                                                'title' => Yii::t('app', 'Просмотр элемента'),
                                                                'onclick' => '
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to(['/abac/target-rule/view/', 'id' => $param->id]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                                                    ]);
                                                }
                                            ],
                                            [
                                                'format' => 'raw',
                                                'value' => function ($param) {
                                                    return Html::a('<i class="fas fa-satellite"></i>', 'javascript:void(0);', [
                                                                'class' => 'text-info',
                                                                'title' => Yii::t('app', 'Все правила для роли'),
                                                                'onclick' => '
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to(['/abac/target-rule/all-rules/', 'id' => $param->id]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                                                    ]);
                                                }
                                            ],
                                            'target.name',
                                            [
                                                'class' => yii\grid\ActionColumn::className(),
                                                'template' => '{delete}',
                                                'buttons' => [
                                                    'delete' => function ($url, $model, $key) {

                                                        return Html::a('<i class="fa fa-trash"></i>', ['/abac/target-rule/delete/', 'id' => $model['id']], [
                                                                    'class' => 'text-danger',
                                                                    'title' => Yii::t('app', 'Удалить элемент'),
                                                                    'data' => [
                                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                                        'method' => 'post',
                                                                    ],
                                                        ]);
                                                    },
                                                ]
                                            ]
                                        ]
                            ]);
                        }
                    ],
                    [
                        'format' => 'raw',
                        'label' => 'Правила построения запросов',
                        'value' => function ($model) {
                            return
                                    yii\helpers\Html::button('<i class="fas fa-plus"></i>', [
                                        'size' => 'modal-lg',
                                        'class' => 'btn btn-xs btn-info',
                                        'data-pjax' => '0',
                                        'title' => 'Добавление нового правила',
                                        'onclick' => '
                                    $.pjax({
                                        type: "GET",
                                         url: "/abac/policy/add-rule/' . $model->id . '",
                                        container: "#pjaxModalUniversal",
                                        push: false,
                                        timeout: 10000,
                                        scrollTo: false
                                    })'
                                    ])
                                    .
                                    GridView::widget([
                                        'layout' => " {items} ",
                                        'showHeader' => false,
                                        'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->policyRules]),
                                        'columns' => [
//                                            'name',
                                            [
                                                'format' => 'raw',
                                                'value' => function ($param) {
                                                    return Html::a('<i class="fa fa-eye"></i>', 'javascript:void(0);', [
                                                                'class' => 'text-info',
                                                                'title' => Yii::t('app', 'Просмотр элемента'),
                                                                'onclick' => '
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to(['/abac/policy-rule/view/', 'id' => $param->id]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                                                    ]);
                                                }
                                            ],
                                            'rule.name',
                                            [
                                                'class' => yii\grid\ActionColumn::className(),
                                                'template' => '{delete}',
                                                'buttons' => [
                                                    'delete' => function ($url, $model, $key) {

                                                        return Html::a('<i class="fa fa-trash"></i>', ['/abac/policy-rule/delete/', 'id' => $model['id']], [
                                                                    'class' => 'text-danger',
                                                                    'title' => Yii::t('app', 'Удалить элемент'),
                                                                    'data' => [
                                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                                        'method' => 'post',
                                                                    ],
                                                        ]);
                                                    },
                                                ]
                                            ]
                                        ]
                            ]);
                        }
                    ],
                    [
                        'format' => 'raw',
                        'label' => 'Правила отображения элементов на странице',
                        'value' => function ($model) {
                            return
                                    yii\helpers\Html::button('<i class="fas fa-plus"></i>', [
                                        'size' => 'modal-lg',
                                        'class' => 'btn btn-xs btn-info',
                                        'data-pjax' => '0',
                                        'title' => 'Добавление нового правила',
                                        'onclick' => '
                                    $.pjax({
                                        type: "GET",
                                         url: "/abac/policy/add-element/' . $model->id . '",
                                        container: "#pjaxModalUniversal",
                                        push: false,
                                        timeout: 10000,
                                        scrollTo: false
                                    })'
                                    ])
                                    .
                                    GridView::widget([
                                        'layout' => " {items} ",
                                        'showHeader' => false,
                                        'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->policyElements]),
                                        'columns' => [
//                                            'name',
                                            [
                                                'format' => 'raw',
                                                'value' => function ($param) {
                                                    return Html::a('<i class="fa fa-eye"></i>', 'javascript:void(0);', [
                                                                'class' => 'text-info',
                                                                'title' => Yii::t('app', 'Просмотр элемента'),
                                                                'onclick' => '
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to(['/abac/policy-element/view/', 'id' => $param->id]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                                                    ]);
                                                }
                                            ],
                                            'element.name',
                                            [
                                                'class' => yii\grid\ActionColumn::className(),
                                                'template' => '{delete}',
                                                'buttons' => [
                                                    'delete' => function ($url, $model, $key) {

                                                        return Html::a('<i class="fa fa-trash"></i>', ['/abac/policy-element/delete/', 'id' => $model['id']], [
                                                                    'class' => 'text-danger',
                                                                    'title' => Yii::t('app', 'Удалить элемент'),
                                                                    'data' => [
                                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                                        'method' => 'post',
                                                                    ],
                                                        ]);
                                                    },
                                                ]
                                            ]
                                        ]
                            ]);
                        }
                    ],
                    [
                        'format' => 'raw',
                        'label' => 'Доступ к дейставиям сайта URL',
                        'value' => function ($model) {
                            return
                                    yii\helpers\Html::button('<i class="fas fa-plus"></i>', [
                                        'size' => 'modal-lg',
                                        'class' => 'btn btn-xs btn-info',
                                        'data-pjax' => '0',
                                        'title' => 'Добавление нового правила',
                                        'onclick' => '
                                    $.pjax({
                                        type: "GET",
                                         url: "/abac/policy/add-action/' . $model->id . '",
                                        container: "#pjaxModalUniversal",
                                        push: false,
                                        timeout: 10000,
                                        scrollTo: false
                                    })'
                                    ])
                                    .
                                    GridView::widget([
                                        'layout' => " {items} ",
                                        'showHeader' => false,
                                        'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $model->policyActions]),
                                        'columns' => [
                                            [
                                                'format' => 'raw',
                                                'value' => function ($param) {
                                                    return Html::a('<i class="fa fa-eye"></i>', 'javascript:void(0);', [
                                                                'class' => 'text-info',
                                                                'title' => Yii::t('app', 'Просмотр элемента'),
                                                                'onclick' => '
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to(['/abac/policy-action/view/', 'id' => $param->id]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                                                    ]);
                                                }
                                            ],
                                            'action.name',
                                            [
                                                'class' => yii\grid\ActionColumn::className(),
                                                'template' => '{delete}',
                                                'buttons' => [
                                                    'delete' => function ($url, $model, $key) {

                                                        return Html::a('<i class="fa fa-trash"></i>', ['/abac/policy-action/delete/', 'id' => $model['id']], [
                                                                    'class' => 'text-danger',
                                                                    'title' => Yii::t('app', 'Удалить элемент'),
                                                                    'data' => [
                                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                                        'method' => 'post',
                                                                    ],
                                                        ]);
                                                    },
                                                ]
                                            ]
                                        ]
                            ]);
                        }
                    ],
                    [
                        'class' => yii\grid\ActionColumn::className(),
                        'template' => '  {view}  {update}  {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
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