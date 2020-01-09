<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \yii;
/**
 * Description of RulesCollection
 * коллекция правил для определенной роли пользователяы
 * @author Gonnyh.I
 */
class RulesCollection {

    function all() {
        \yii::$app->user->id
    }

}
