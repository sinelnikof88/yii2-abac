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
class HttpABACException extends \yii\web\HttpException {

    /**
     * @return string the user-friendly name of this exception
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null) {
        parent::__construct(403, $message, $code, $previous);
    }

}
