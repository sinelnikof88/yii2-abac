<?php

/*
 * Gonnyh Ivan
 * sinelnikof88@gmail.com
 * Developing  by Yii
 * Each line should be prefixed with  * 
 */

namespace sinelnikof88\abac\components;

/**
 * Description of Controller
 *
 * @author Gonnyh.I
 */
class Controller extends \yii\web\Controller {

    public function init() {
        try {
            if (class_exists(\common\models\CustomerSetting::class)) {
                $customer = \common\models\CustomerSetting::find()->where(['user_id' => \Yii::$app->user->id, 'name' => 'swtolbar'])->one(); // find by query
                $this->getView()->registerMetaTag([
                    'name' => 'showMenu',
                    'content' => $customer->value
                ]);
            }
        } catch (Exception $exc) {
            // Примочка для регистрации меты    
        }

        return parent::init();
    }

}
