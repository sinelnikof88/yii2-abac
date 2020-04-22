<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\models;

/**
 * Description of SettingsForm
 *
 * @author Gonnyh.I
 */
class SettingsForm extends \yii\base\Model {

    public $rule_namespace, $rule_directory, $target, $action_namespace, $action_directory, $element_namespace, $element_directory;

    public function rules() {
        return [
            [['target'], 'safe'],
            [['rule_namespace', 'rule_directory'], 'safe'],
            [['action_namespace', 'action_directory'], 'safe'],
            [['element_namespace', 'element_directory'], 'safe'],
        ];
    }

    public function attributeLabels() {
        return [
            'rule_namespace' => 'правила',
            'rule_directory' => 'правила',
            'action_namespace' => 'пространство имен классов с действиями',
            'action_directory' => 'Директория с классами действий',
            'element_namespace' => 'Элементы на страницах',
            'element_directory' => 'Элементы на страницах',
            'target' => 'целевой класс',
        ];
    }

    public function save() {
        $model = serialize($this);
        \yii::$app->abac->createCommand('TRUNCATE `settings`')->execute();
        $data = [];
        foreach ($this->attributes as $name => $value) {
            $data [] = [$name, $value];
        }
        \Yii::$app->abac->createCommand()->batchInsert('settings', ['name', 'value'], $data)->execute();
    }

    public static function getConfig() {
        $model = new SettingsForm;
        $data = \Yii::$app->abac->createCommand('select * from settings')->queryAll();
        $modelData = \yii\helpers\ArrayHelper::map($data, 'name', 'value');
        $model->attributes = $modelData;
        return $model;

    }

}
