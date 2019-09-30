<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $startDay
 * @property string $endDay
 * @property string $body
 * @property int $isBlocked
 * @property int $useNotification
 * @property string $email
 * @property string $createAt
 * @property int $isDeleted
 * @property int $user_id
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'startDay', 'endDay', 'user_id'], 'required'],
            [['startDay', 'endDay', 'createAt'], 'safe'],
            [['body'], 'string'],
            [['isBlocked', 'useNotification', 'isDeleted', 'user_id'], 'integer'],
            [['title', 'email'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'startDay' => Yii::t('app', 'Start Day'),
            'endDay' => Yii::t('app', 'End Day'),
            'body' => Yii::t('app', 'Body'),
            'isBlocked' => Yii::t('app', 'Is Blocked'),
            'useNotification' => Yii::t('app', 'Use Notification'),
            'isRepeated' => Yii::t('app','Is Repeated'),
            'repeatedType' => Yii::t('app','Repeated Type'),
            'email' => Yii::t('app', 'Email'),
            'createAt' => Yii::t('app', 'Create At'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'user_id' => Yii::t('app', 'User ID'),
            'file' => Yii::t('app','File'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
