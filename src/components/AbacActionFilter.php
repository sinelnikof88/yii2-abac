<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components;

use Yii;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;

/**
 * Description of AbacActionFilter
 *
 *         throw new \sinelnikof88\abac\HttpABACException('Доступ запрещен');

 * @author Gonnyh.I
 */
class AbacActionFilter extends Behavior {

    public function events() {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    public function beforeAction($event) {
        try {
            
        $this->loadRules();

        $result = $this->checkPermission($event->action->controller->id, $event->action->id);

        if (!$result) {
            $event->isValid = false;
            throw new \sinelnikof88\abac\HttpABACException('Доступ запрещен');
        }
        return $event->isValid;
        } catch (\sinelnikof88\abac\ABACException $exc) {
            $event->isValid=false;
        }

    }

    protected $rules;

    protected function loadRules() {
        $policyCollection = \sinelnikof88\abac\components\ActionCollection::instance();
        $this->rules = $policyCollection->all();
    }

    protected function checkPermission($controller, $action) {
        $result = true;
        if($controller=='site'&& $action=='error'){
            return true;
        }
         foreach ($this->rules as $rule) {
            if ($rule->check($controller, $action) !== true) {
                \yii::warning('Пользователю запрещен доступ ' . implode('/', [$controller, $action]) . ' По правилу :' . get_class($rule));
                $result = false;
            };
        }
        return $result;
    }

}
