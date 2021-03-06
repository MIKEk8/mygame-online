<?php

namespace app\widgets\game\assets;

use Yii;
use yii\helpers\FileHelper;

class GameAsset extends \yii\web\AssetBundle
{
    public $basePath = '@app/widgets/game/assets';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];

    public function init()
    {
        $this->js = [
            ...FileHelper::findFiles(Yii::getAlias($this->basePath . '/js/types/')),
            ...FileHelper::findFiles(Yii::getAlias($this->basePath . '/js/tools/')),
            ...FileHelper::findFiles(Yii::getAlias($this->basePath . '/js/'), ['recursive'=>false]),
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }
}