<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\oracle\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12">
        <?= $form->field($model, 'target')->textInput()->hint('Класс на который будут распростроняться политики (либо класс пользователя либо класс роли )') ?>
    </div>

    <div class="col-lg-12">
        <div class="col-lg-12">
            <?= $form->field($model, 'rule_namespace')->textInput()->hint('Пространство имен классов для проверок') ?>
        </div>
        <div class="col-lg-12">
            <?= $form->field($model, 'rule_directory')->textInput()->hint('Местоположение на сервере (путь до директории вкоторой лежат классы для проверки) /var/www/....') ?>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="col-lg-12">
            <?= $form->field($model, 'action_namespace')->textInput()->hint('Пространство имен классов для проверок') ?>
        </div>
        <div class="col-lg-12">
            <?= $form->field($model, 'action_directory')->textInput()->hint('Местоположение на сервере (путь до директории вкоторой лежат классы для проверки) /var/www/....') ?>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <?= $form->field($model, 'element_namespace')->textInput()->hint('Пространство имен классов для проверок') ?>
        </div>
        <div class="col-lg-12">
            <?= $form->field($model, 'element_directory')->textInput()->hint('Местоположение на сервере (путь до директории вкоторой лежат классы для проверки) /var/www/....') ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
