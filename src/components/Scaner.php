<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof88\abac\components;

/**
 * Description of Scaner
 *
 * @author Gonnyh.I
 */
class Scaner {

    public static function classList(string $path = '', string $namespace = '') {

        $files = \yii\helpers\FileHelper::findFiles($path);
        $classList = [];
        foreach ($files as $file) {
            $filename = pathinfo($file);
            $classname = $namespace . '\\' . $filename['filename'];
            $classList[] = $classname;
        }
        return $classList;
    }

}
