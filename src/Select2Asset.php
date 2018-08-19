<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 5/24/15
 * Time: 10:34
 */

namespace huijiewei\select2;

use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $sourcePath = '@npm/select2/dist';

    public $js = [
        'js/select2.full.min.js',
    ];

    public $css = [
        'css/select2.min.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
