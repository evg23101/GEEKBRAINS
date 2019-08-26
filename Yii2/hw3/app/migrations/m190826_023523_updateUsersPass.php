<?php

use yii\db\Migration;

/**
 * Class m190826_023523_updateUsersPass
 */
class m190826_023523_updateUsersPass extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('users', ['password_hash' => \Yii::$app->security->generatePasswordHash('123456'),
        ], 'id' == 1);

        $this->update('users', ['password_hash' => \Yii::$app->security->generatePasswordHash('123456'),
        ], 'id' == 2);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190826_023523_updateUsersPass cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190826_023523_updateUsersPass cannot be reverted.\n";

        return false;
    }
    */
}
