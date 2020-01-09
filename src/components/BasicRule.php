<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components;

/**
 * Description of BasicRule
 *
 * @author Gonnyh.I
 */
class BasicRule {

    public $user = false;

    public function __construct() {
        $this->user = \Yii::$app->user->identity;
    }

    /**
     *  тут будем собирать трейты для придектов 
     * @param \yii\db\ActiveQuery $query
     * @return \yii\db\ActiveQuery
     * @example $query->where(['>', 'REQ_R_ID', '123']);
     */
    public function pre(\yii\db\ActiveQuery $query) {
        return $query;
    }

}
