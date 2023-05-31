<?php
declare(strict_types=1);

namespace app\Domain;

use yii\db\ActiveRecord;

interface PersistInterface
{
    public function persist(): ActiveRecord;
}