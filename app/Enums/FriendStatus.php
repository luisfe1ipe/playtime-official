<?php

namespace App\Enums;

enum FriendStatus: string
{
  case ACCEPTED = "Accepted";
  case REJECTED = "Rejected";
  case PENDING = "Pending";

  public function getName(): string
  {
    return match ($this) {
      self::ACCEPTED => 'Accepted',
      self::REJECTED => 'Rejected',
      self::PENDING => 'Pending',
      default => 'Status not found'
    };
  }

  public function getStyle(): string
  {
    return match ($this) {
      self::ACCEPTED => 'bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300',
      self::REJECTED => 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300',
      self::PENDING => 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300',
      default => 'bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300'
    };
  }
}
