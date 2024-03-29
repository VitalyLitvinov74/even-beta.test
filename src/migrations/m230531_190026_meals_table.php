<?php

use yii\db\Migration;

/**
 * Class m230531_190026_meals_table
 */
class m230531_190026_meals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('meals', [
            'id'=>$this->primaryKey(),
            'name'=>$this->string(),
            'price'=>$this->integer()
        ]);

        $this->createTable('cafe_menu', [
            'id'=>$this->primaryKey(),
            'cook_id'=>$this->integer()
        ]);
        $this->createTable('cafe_menu_meals', [
            'id'=>$this->primaryKey(),
            'meal_id'=>$this->integer(),
            'cafe_menu_id'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('meals');
        $this->dropTable('cafe_menu_meals');
        $this->dropTable('cafe_menu');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230531_190026_meals_table cannot be reverted.\n";

        return false;
    }
    */
}
