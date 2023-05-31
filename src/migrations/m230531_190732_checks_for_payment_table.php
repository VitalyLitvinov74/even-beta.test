<?php

use yii\db\Migration;

/**
 * Class m230531_190732_checks_for_payment_table
 */
class m230531_190732_checks_for_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'visitor_orders',
            [
                'id' => $this->primaryKey(),
                'visitor_id' => $this->integer(),
                'summary_price' => $this->integer()
            ]
        );

        $this->createTable(
            'visitor_order_items',
            [
                'id' => $this->primaryKey(),
                'order_id' => $this->integer(),
                'meal_id' => $this->integer(),
                'count' => $this->integer(),
                'price' => $this->integer(),
                'summary_price' => $this->integer()
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('visitor_orders');
        $this->dropTable('visitor_order_items');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230531_190732_checks_for_payment_table cannot be reverted.\n";

        return false;
    }
    */
}
