<?php

use yii\db\Migration;

/**
 * Class m190818_195144_CreateTables
 */
class m190818_195144_CreateTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'body'=>$this->text(),
            'startDay'=>$this->date()->notNull(),
            'endDay'=>$this->date()->notNull(),
            'isBlocked'=>$this->boolean()->notNull()->defaultValue(0),
            'useNotification'=>$this->boolean()->notNull()->defaultValue(0),
            'email'=>$this->string(150),
            'createAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'isDeleted'=>$this->boolean()->notNull()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190818_195144_CreateTables cannot be reverted.\n";

        return false;
    }
    */
}
