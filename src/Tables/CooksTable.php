<?php
declare(strict_types=1);

namespace app\Tables;

use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string name
 */
final class CooksTable extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'cooks';
    }
}