<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components\rules;

/**
 * Description of newPHPClass1
 *
 * @author Gonnyh.I
 */
class VisibleTablesForAtolOnly extends \sinelnikof88\abac\components\BasicRule {

    public function pre(\yii\db\ActiveQuery $query) {
        $query->orWhere(['REQUEST.ID' => ['123', 1477733, 1477732, 1477731]]);
        return $query;
    }

}
