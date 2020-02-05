<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\Element */

$this->title = 'Create Element';
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = ['label' => 'Policies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">

    <div class="policy-create">

        <?=
        \common\extensions\box\Box::widget([
            'name' => 'policy',
            'id' => 'policy_box_create',
            'info' => $this->title,
            'btn' => [
                Html::a('Управление', ['index'], ['class' => 'btn btn-primary']),
            ],
            'is_collapsed' => false,
            'text' => $this->render('_form', [
                'model' => $model,
            ])
        ])
        ?>

    </div>
</div>
