<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\TargetRule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'target_id')->dropDownList($model->targetList,['prompt'=>'--------'])  ?>

    <?= $form->field($model, 'policy_id')->dropDownList($model->ruleList,['prompt'=>'--------']) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
