<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components\traits;

/**
 * Трейт который будет свтраиваться в классы для использования функции activeQuery  для реализации ->pre()->
 * @extends \yii\db\ActiveQuery
 * @author Gonnyh.I
 */
trait PredicateModelTrait {

    private $traitRules = [];

    private function loadTraitRules() {
        $policyCollection = \sinelnikof88\abac\components\PolicyCollection::instance();
        $this->traitRules = $policyCollection->all();
    }

    public function pre() {
        $this->loadTraitRules();
        foreach ($this->traitRules as $value) {
            $value->pre($this);
        }
        return $this;
    }

}
