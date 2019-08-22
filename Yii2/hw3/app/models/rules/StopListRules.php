<?php


namespace app\models\rules;


use yii\validators\Validator;

class StopListRules extends Validator
{
    public $stopList=[];

    public function validateAttribute($model, $attribute)
    {
        if (!is_array($this->stopList)){
            return false;
        }

        if (in_array($model->$attribute,$this->stopList)) {
            $model->addError($attribute,'Значение находится в стоп-листе');
            }
    }
}