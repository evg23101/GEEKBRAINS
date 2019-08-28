<?php


namespace app\models;


use app\behaviors\GetDateCreatedBehavior;
use app\models\rules\StopListRules;
use phpDocumentor\Reflection\Types\Self_;
use yii\base\Model;

/**
 * Class Activity
 * @package app\models
 * @mixin GetDateCreatedBehavior
 */

class Activity extends ActivityBase
{

//    public $title;
//    public $startDay;
//    public $endDay;
//    public $body;
//    public $isBlocked;
    public $isRepeated;
    public $repeatedType;

    const EVENT_MY_EVENT='my_event';

    public function behaviors()
    {
        return [
            ['class'=>GetDateCreatedBehavior::class,'attributeName' => 'createAt']
        ];
    }

    public const REPEATED_TYPE = [
        '1'=>'каждый день',
        '2'=>'каждую неделю',
        '3'=>'каждый месяц'
    ];

//    public $useNotification;
//    public $email;
    public $file;

    public function beforeValidate()
    {
        $date=\DateTime::createFromFormat('d.m.Y',$this->startDay);
        if ($date){
            $this->startDay = $date->format('Y-m-d');
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return array_merge([
            ['title','trim'],
            [['title','startDay'],'required'],
            [['startDay','endDay'],'string'],
            ['startDay','date', 'format'=>'php:Y-m-d'],
            ['endDay', 'compare', 'compareAttribute' => 'startDay',
                'operator' => '>=',
                'message' => 'Событие не может закончиться раньше его начала'
            ],
            ['file','file','extensions'=>['jpg', 'png']],
            ['body','string','min' => 5,'max' => 150],
            [['isBlocked', 'useNotification'],'boolean'],
            ['repeatedType', 'in','range'=> array_keys(self::REPEATED_TYPE)],
            ['email','email'],
      //      ['title','titleStopRule'],
            ['title',StopListRules::class,'stopList' => ['шаурма','бордюр']],
            ['email','required','when'=> function($model){
                return $model->useNotification?true:false;
            }]
        ],parent::rules());
    }

    public function titleStopRule($attr){
        $arr=['шаурма','бордюр'];
        if(in_array($this->title,$arr)){
            $this->addError('title','Значение заголовка находится в стоп-листе');
        }
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название события',
            'startDay' => 'Дата начала',
            'endDay' => 'Дата завершения',
            'body' => 'Описание события',
            'isBlocked' => 'Событие на целый день',
            'isRepeated'=>'Повторять',
            'repeatedType'=>'Частота повтора',
            'useNotification'=>'Уведомлять по почте',
            'file'=>'Файл для загрузки'
        ];
    }
}