<?php

/*
 * Gonnyh Ivan
 * sinelnikof88@gmail.com
 * Developing  by Yii
 * Each line should be prefixed with  * 
 */

namespace sinelnikof88\abac\assets;

use yii\web\AssetBundle;

/**
 * Description of AbacAssets
 *
 * @author Gonnyh.I
 */
class AbacAssets extends AssetBundle {

    public $sourcePath = '@abac/assets';
    public $css = [
        'css/abac.css',
    ];
    public $js = [
        'js/abac.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
