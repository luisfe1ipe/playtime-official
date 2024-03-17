<?php

namespace App\Enums;

use Illuminate\Support\Enum;

enum FindPlayerStatus: string
{
  case PENDING = 'pending';
  case ACCEPTED = 'accepted';
  case REJECTED = 'rejected';
}
