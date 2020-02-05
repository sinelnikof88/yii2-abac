<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model sinelnikof88\abac\models\TargetRule */
/* @var $form yii\widgets\ActiveForm */

yii\bootstrap\Modal::begin([
    'id' => 'modalBox',
    'size' => 'modal-lg',
    'clientOptions' => ['show' => true],
    'options' => [
        ''
    ],
]);
?>    
<div class="policy-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'action_id')->dropDownList($model->actionList, ['prompt' => '--------']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
yii\bootstrap\Modal::end();


