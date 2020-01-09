<?php

/*
 * Gonnyh Ivan
 * sinelnikof88@gmail.com
 * Developing  by Yii
 * Each line should be prefixed with  * 
 */

namespace sinelnikof88\abac;

/**
 * Исключение модуля
 *
 * @author Gonnyh.I
 *   throw new ABACException('Invalid or no primary key found for the grid data.');
 */
class ABACException extends \Exception {

    /**
     * @return string the user-friendly name of this exception
     */
    public function getName() {
        return 'Ошибка';
    }

}
