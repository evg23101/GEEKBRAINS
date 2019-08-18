<?php


namespace app\models;


use app\models\rules\StopListRules;
use phpDocumentor\Reflection\Types\Self_;
use yii\base\Model;

class Activity extends Model
{
    /**
     * Название события
     *
     * @var string
     */
    public $title;

    /**
     * День начала события. Хранится в Unix timestamp
     *
     * @var int
     */
    public $startDay;

    /**
     * День завершения события. Хранится в Unix timestamp
     *
     * @var int
     */
    public $endDay;

    /**
     * ID автора, создавшего события
     *
     * @var int
     */
    public $idAuthor;

    /**
     * Описание события
     *
     * @var string
     */
    public $body;

    /**
     * @var bool
     */
    public $isBlocked;

    public $isRepeated;

    public $repeatedType;

    public const REPEATED_TYPE = [
        '1'=>'каждый день',
        '2'=>'каждую неделю',
        '3'=>'каждый месяц'
    ];

    public $useNotification;

    public $email;

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
        return [
            ['title','trim'],
            [['title','startDay'],'required'],
            [['startDay','endDay'],'string'],
            ['startDay','date', 'format'=>'php:Y-m-d'],
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
        ];
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
            'useNotification'=>'уведомлять по почте'
        ];
    }
}