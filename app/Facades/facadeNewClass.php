<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
class facadeNewClass extends Facade
{
     protected static function getFacadeAccessor()
     {
          return 'facadeClass';
     }
}
