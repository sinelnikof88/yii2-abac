<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\interfaces;

/**
 *
 * @author Gonnyh.I
 */
interface IUser {

    /**
     * @return array массив id для на которые будут применяться правила помещать в identity класс
     */
    public function getFiltredAttributes(): array;
}
