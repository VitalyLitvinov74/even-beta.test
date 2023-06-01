<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveRecord;

final class CookCafeMenuTable extends ActiveRecord
{
    public static function tableName():string
    {
        return 'cook_cafe_menu';
    }
}