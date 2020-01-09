<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\behaviors;

/**
 * Description of DeleteBehavior
 *
 * @author sinelnikof
 */
class DeleteBehavior extends \yii\base\Behavior {

    public function events() {
        return [
            \yii\db\ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }

    public function beforeDelete($event) {

        $this->owner->is_delete = 1;
        if (!$this->owner->save()) {
            print_r($this->owner->getErrors());
            exit;
        };
        $event->isValid = false;
        return $event->isValid;
    }

}
