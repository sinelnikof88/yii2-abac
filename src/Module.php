<?php

/*
 * Gonnyh Ivan
 * sinelnikof88@gmail.com
 * Developing  by Yii
 * Each line should be prefixed with  * 
 */

namespace sinelnikof88\abac;

/**
 * Description of Module
 *
 * @author Gonnyh.I
 */
class Module extends \yii\base\Module {

    public $controllerNamespace = 'sinelnikof88\abac\controllers';
    public $defaultController = 'default';

    /**
     * Алиас с конфигами
     * @var type 
     */
    public $config;
    public $user;

    public function init() {
        $this->user = \Yii::setAlias('@abac', '@vendor/sinelnikof88/yii2-abac/src/');

        if ($this->config) {
            \Yii::configure($this, require \yii::getAlias($this->config));
        } else {
            \Yii::configure($this, require __DIR__ . '/config.php');
        }

        print_r($this->config);
        return parent::init();
    }

}
