<?php

namespace sinelnikof88\abac\components\rules;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultRule
 *
 * @author Gonnyh.I
 */
class DefaultRule extends \sinelnikof88\abac\components\BasicRule {

    public function pre(\yii\db\ActiveQuery $query) {
        parent::pre($query);
    }

}
