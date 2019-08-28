<?php


namespace app\behaviors;


use yii\base\Behavior;

class GetDateCreatedBehavior extends Behavior
{
    public $attributeName;

    public function getDateCreated():?string
    {
        $owner=$this->owner;
        return \Yii::$app->formatter->asDatetime($owner->{$this->attributeName},'php:d.m.Y H:i');
    }
}