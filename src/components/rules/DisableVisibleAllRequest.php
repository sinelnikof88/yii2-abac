<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components\rules;

/**
 * Description of newPHPClass
 *
 * @author Gonnyh.I
 */
class DisableVisibleAllRequest extends \sinelnikof88\abac\components\BasicRule {

    public function pre(\yii\db\ActiveQuery $query) {
        $query->orWhere(['REQUEST.ID' => [1477755, 1477754, 1477753]]);
        return $query;
    }

}
