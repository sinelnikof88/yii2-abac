<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\helpers;

/**
 * Description of Html
 *
 * @author Gonnyh.I
 */
class Html extends \yii\helpers\Html {

    protected static final function check($rule, $name, $content = '', $options = []) {
         return $rule->accsess($name, $content, $options);
    }

    public static function tag($name, $content = '', $options = []) {


        $ruleSingletone = RuleSingleton::getInstance();
        $rules = $ruleSingletone->getData();
        if ($rules === null) {
            $policyCollection = \sinelnikof88\abac\components\ElementCollection::instance();
            $rules = $policyCollection->all();
            $ruleSingletone->setData($rules);
        }
        if ($name === null || $name === false) {
            return $content;
        }
        $check = false;
        foreach ($rules as $rule) {
             if (self::check($rule, $name, $content, $options)==true) {
                $check = true;
            };
        }
        if ($check == false) {
            return;
        }
        $html = "<$name" . static::renderTagAttributes($options) . '>';
        return isset(static::$voidElements[strtolower($name)]) ? $html : "$html$content</$name>";
    }

}
