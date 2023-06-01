<?php
declare(strict_types=1);

namespace app\DDD\Order;

use app\Domain\PersistInterface;
use app\Tables\VisitorOrderItemsTable;

final class Item implements PersistInterface
{
    public function __construct(
        private int $itemPrice,
        private string $mealName,
        private int $count,
        private string $visitorUuid
    )
    {
    }

    public function persist(): VisitorOrderItemsTable
    {

    }
}