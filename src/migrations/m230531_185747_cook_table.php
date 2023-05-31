<?php

use yii\db\Migration;

/**
 * Class m230531_185747_cook_table
 */
class m230531_185747_cook_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cooks',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'uuid'=>$this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cooks');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230531_185747_cook_table cannot be reverted.\n";

        return false;
    }
    */
}
