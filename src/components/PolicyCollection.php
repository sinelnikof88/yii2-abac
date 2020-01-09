<?php

namespace sinelnikof88\abac\components;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \yii;

/**
 * Description of RulesCollection
 * коллекция правил для определенной роли пользователяы
 * @author Gonnyh.I
 */
class PolicyCollection {

    public $user;

    public function __construct() {
        $this->user = \Yii::$app->user->identity;
    }

    function all() {
        $attr = \yii\helpers\ArrayHelper::getColumn($this->user->roles, 'ROLE_ID', true);

        $targets = \sinelnikof88\abac\models\TargetRule::find()->with('policy')->with('policy.rules')->asArray()->where(['target_id' => $attr])->all();

        $classesNames = [];
        try {
            foreach ($targets as $policy) {
                foreach ($policy['policy']['rules'] as $rules) {
                    $classesNames[] = $rules['class'];
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            
        }
        $classes = [];
        if (!empty($classesNames)) {
            foreach ($classesNames as $value) {

                $classes[] = new $value;
            }
        }
        return $classes;
    }

}
