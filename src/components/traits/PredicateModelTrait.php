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

    public function pre() {


        $policyCollection = new \sinelnikof88\abac\components\PolicyCollection();

        foreach ($policyCollection->all() as $value) {
             $value->pre($this);
        }
//        echo '<pre>';
//        print_r($this); 
//        exit;
//        
//        print_r($policyCollection->all()); exit; 
////        $this->andWhere('[[PARENT_ID]]!=0');
////        $this->andWhere('[[REQ_TYPE_ID]]=489');
//        $this->andWhere(['TIME_CREATE'=>'2019-12-27 13:13:52']);

        return $this ;
    }

}
