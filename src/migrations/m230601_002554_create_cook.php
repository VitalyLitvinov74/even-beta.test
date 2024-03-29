<?php

use app\DDD\Cook;
use app\Tables\CooksTable;
use yii\db\Migration;

/**
 * Class m230601_002554_create_cook
 */
class m230601_002554_create_cook extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Cook::initial(
            "тестовый повар",
            "1234567"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        CooksTable::deleteAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230601_002554_create_cook cannot be reverted.\n";

        return false;
    }
    */
}
