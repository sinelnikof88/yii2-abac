<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\PolicyRule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="policy-rule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rule_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'policy_id')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'is_active')->checkbox() ?>
    
     <?= $form->field($model, 'variables[name]')->textInput()?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
