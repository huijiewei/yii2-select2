<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 5/24/15
 * Time: 10:34
 */

namespace huijiewei\select2;

use yii\web\AssetBundle;

class Select2BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@npm/select2-bootstrap-theme/dist';

    public $css = [
        'select2-bootstrap.min.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'huijiewei\fontawesome\FontAwesomeAsset',
    ];
}
