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

    public $rule_namespace, $rule_directory, $target, $action_namespace, $action_directory;

    public function rules() {
        return [
            [['target'], 'safe'],
            [['rule_namespace', 'rule_directory'], 'safe'],
            [['action_namespace', 'action_directory'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'rule_namespace' => 'правила',
            'rule_directory' => 'правила',
            'action_namespace' => 'пространство имен классов с действиями',
            'action_directory' => 'Директория с классами действий',
            'target' => 'целевой класс',
        ];
    }

    public function save() {
        $model = serialize($this);
        file_put_contents(__dir__ . '/conf.conf', $model);
    }

    public static function getConfig() {
        $str = @file_get_contents(__dir__ . '/conf.conf');
        if (!$str) {
            return new SettingsForm;
        }
        return unserialize($str);
    }

}
