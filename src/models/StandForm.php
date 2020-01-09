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
class StandForm extends \yii\base\Model {

    public $variables;
    public $report;

    public function rules() {
        return [
            [['variables'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'variables' => 'Переменные',
        ];
    }

    public function execute() {

        $data = [];

        foreach ($this->variables as $value) {
            $data [] = $value['name'] . '-' . $value['value'];
        }

        $this->report = 'результат выполнения проверок!!!'
                . '<hr>' . implode('<br>', $data);
    }

}
