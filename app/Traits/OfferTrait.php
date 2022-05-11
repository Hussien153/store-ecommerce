<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use PhpParser\Builder\Trait_;

Trait OfferTrait
{
    
     function saveImage($photo, $folder)
    {
      $file_extension = $photo -> getClientOriginalExtension();
      $file_name = time().'.'.$file_extension;
      $path = $folder;
      $photo -> move($path,$file_name);

      return $file_name;
    }
    
}
