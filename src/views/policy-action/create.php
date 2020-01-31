<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\PolicyRule */

$this->title = 'Create Policy Rule';
$this->params['breadcrumbs'][] = ['label' => 'ABAC', 'url' => ['/abac/default/index']];

$this->params['breadcrumbs'][] = ['label' => 'Policy Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">

<div class="policy-rule-create">

     <?=  \common\extensions\box\Box::widget([
       'name' => 'policy-rule',
       'id' => 'policy-rule_box_create',
       'info' => $this->title,
       'btn' => [
            Html::a('Управление', ['index'], ['class' => 'btn btn-primary']),
          ],
       'is_collapsed' => false,
       'text' =>$this->render('_form', [
        'model' => $model,
    
        ])
    ])
    ?>

</div>
</div>
