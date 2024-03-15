<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait CustomGetImage
{
  public function getImage($image)
  {
    if (str_contains($image, "http")) {
      return $image;
    }

    return Storage::url($image);
  }
}
