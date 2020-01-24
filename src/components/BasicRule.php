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
 * 
 * 
 *  public function pre(\yii\db\ActiveQuery $query) {
  return $query;
  }
 */
abstract class BasicRule implements \sinelnikof88\abac\interfaces\IRule {

     

    public function pre(\yii\db\ActiveQuery $query) {
        return $query;
    }

}
