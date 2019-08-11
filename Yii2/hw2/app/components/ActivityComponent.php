<?php


namespace app\components;


use yii\base\Component;

class ActivityComponent extends Component
{


    public function createActivity(Activity &$activity):bool
    {
        if ($activity->validate()){
            return true;
        }

        return false;
    }
}