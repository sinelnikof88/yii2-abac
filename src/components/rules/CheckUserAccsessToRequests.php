<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components\rules;

/**
 * Description of CheckUserAccsessToRequests
 *
 * @author Gonnyh.I
 */
class CheckUserAccsessToRequests extends \sinelnikof88\abac\components\BasicRule {

    public function pre(\yii\db\ActiveQuery $query) {
        exit;print_r($this->user->roles); exit; 
        $query->where(['>', 'REQ_R_ID', '123']);
        return $query;
    }

}
