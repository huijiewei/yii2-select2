<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 5/24/15
 * Time: 10:34
 */

namespace huijiewei\select2;

use yii\web\AssetBundle;

class Select2Bootstrap4Asset extends AssetBundle
{
    public $sourcePath = '@npm/ttskch--select2-bootstrap4-theme/dist';

    public $css = [
        'select2-bootstrap4.min.css',
    ];

    public $depends = [
        'yii\bootstrap4\BootstrapAsset',
        'huijiewei\fontawesome\FontAwesomeAsset',
    ];
}
