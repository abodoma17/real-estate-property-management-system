<?php

namespace App\Enums;

enum PropertyStatusEnum: string
{
    case AVAILABLE = "available";
    case UNDER_REVIEW = "under_review";
    case APPROVED = "approved";
    case SOLD = "sold";

    public static function getStatuses(): array
    {
        return [
          self::AVAILABLE->value,
          self::UNDER_REVIEW->value,
          self::APPROVED->value,
          self::SOLD->value
        ];
    }
}
