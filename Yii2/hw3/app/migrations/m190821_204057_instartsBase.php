<?php

use yii\db\Migration;

/**
 * Class m190821_204057_instartsBase
 */
class m190821_204057_instartsBase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'password_hash'=>'qwerqwer',
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test2@test.ru',
            'password_hash'=>'qwerqwer',
        ]);
        $this->batchInsert('activity',['title','startDay','endDay','user_id','useNotification'],[
            [Yii::$app->security->generateRandomString(),date('Y-m-d'),date('Y-m-d'),1,0],
            [Yii::$app->security->generateRandomString(),date('Y-m-d'),date('Y-m-d'),1,0],
            [Yii::$app->security->generateRandomString(),date('Y-m-d'),date('Y-m-d'),2,0],
            [Yii::$app->security->generateRandomString(),date('Y-m-d'),date('Y-m-d'),2,1],
            [Yii::$app->security->generateRandomString(),'2019-08-14','2019-08-15',2,1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('activity');
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190821_204057_instartsBase cannot be reverted.\n";

        return false;
    }
    */
}
