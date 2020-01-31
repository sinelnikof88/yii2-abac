<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\oracle\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-3">
        <?= $form->field($model, 'variables[1][name]') ?>
        <?= $form->field($model, 'variables[1][value]') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'variables[2][name]') ?>
        <?= $form->field($model, 'variables[2][value]') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'variables[3][name]') ?>
        <?= $form->field($model, 'variables[3][value]') ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'variables[4][name]') ?>
        <?= $form->field($model, 'variables[4][value]') ?>
    </div>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Выолнить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="report-stand">
    <?php echo $model->report; ?>
</div>
