<?php
declare(strict_types=1);

namespace app\Domain;

interface PersistInterface
{
    public function persist(): void;
}