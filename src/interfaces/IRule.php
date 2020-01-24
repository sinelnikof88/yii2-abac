<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\interfaces;

/**
 * Description of IRule
 *
 * @author Gonnyh.I
 */
interface IRule {

    public function pre(\yii\db\ActiveQuery $query);
}
