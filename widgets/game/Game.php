<?php
namespace app\widgets\game;

use app\widgets\game\assets\GameAsset;

class Game extends \yii\base\Widget
{
    public function init()
    {
        parent::init();
        GameAsset::register($this->view);
    }

    public function run(): string
    {
        return $this->render('layout');
    }
}