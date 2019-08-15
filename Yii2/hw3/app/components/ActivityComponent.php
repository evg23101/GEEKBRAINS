<?php


namespace app\components;


use yii\base\Component;

class ActivityComponent extends Component
{
    public $classModel;

    public function getModel()
    {
        return new $this->classModel();
    }

    public function createActivity(Activity &$activity): bool
    {
        if ($activity->validate()){
            return true;
        }

        return false;
    }
}