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
        $this->createTable('cook_meal', [
            'id'=>$this->primaryKey(),
            'cook_id'=>$this->integer()->notNull(),
            'meal_id'=>$this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'link_cook-fk',
            'cook_meal',
            'cook_id',
            'cooks',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'link_meal-fk',
            'cook_meal',
            'cook_id',
            'meals',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cook_meal');
        $this->dropTable('meals');
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
