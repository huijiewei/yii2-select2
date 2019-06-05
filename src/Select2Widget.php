<?php
/**
 * Created by PhpStorm.
 * User: huijiewei
 * Date: 5/24/15
 * Time: 10:48
 */

namespace huijiewei\select2;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\AssetBundle;
use yii\widgets\InputWidget;

class Select2Widget extends InputWidget
{
    public $data = [];

    public $clientOptions = [];

    public $defaultValue = '';

    /* @var $_assetBundle AssetBundle */
    private $_assetBundle;

    public function init()
    {
        parent::init();

        $this->options = ArrayHelper::merge([
            'class' => 'form-control',
            'data-default-value' => $this->defaultValue,
        ], $this->options);

        $this->clientOptions = ArrayHelper::merge([
            'language' => 'zh-CN',
            'theme' => 'bootstrap',
        ], $this->clientOptions);

        if ($this->value != null && count($this->data) == 0) {
            $this->data[$this->value] = '';
        }

        $this->registerAssetBundle();
        $this->registerLanguage();
        $this->registerScript();
    }

    public function registerAssetBundle()
    {
        $this->_assetBundle = Select2Asset::register($this->getView());

        if ($this->clientOptions['theme'] == 'bootstrap') {
            Select2BootstrapAsset::register($this->getView());
        }

        if ($this->clientOptions['theme'] == 'bootstrap4') {
            Select2Bootstrap4Asset::register($this->getView());
        }
    }

    public function registerLanguage()
    {
        if (!isset($this->clientOptions['language']) || !strlen($this->clientOptions['language'])) {
            return;
        }

        $langAsset = 'js/i18n/' . $this->clientOptions['language'] . '.js';

        if (file_exists(\Yii::getAlias($this->_assetBundle->sourcePath . DIRECTORY_SEPARATOR . $langAsset))) {
            $this->_assetBundle->js[] = $langAsset;
        } else {
            unset($this->clientOptions['language']);
        }
    }

    public function registerScript()
    {
        $clientOptions = Json::encode($this->clientOptions);

        $js = <<<EOD
$('#{$this->options['id']}').select2({$clientOptions});
EOD;

        $this->getView()->registerJs($js);
    }

    public function run()
    {
        $html = '<div class="select2-wrap">';

        if ($this->hasModel()) {
            $html .= Html::activeDropDownList($this->model, $this->attribute, $this->data, $this->options);
        } else {
            $html .= Html::dropDownList($this->name, $this->value, $this->data, $this->options);
        }

        $html .= '</div>';

        return $html;
    }

    public function getAssetBundle()
    {
        if (!($this->_assetBundle instanceof AssetBundle)) {
            $this->registerAssetBundle();
        }

        return $this->_assetBundle;
    }
}
