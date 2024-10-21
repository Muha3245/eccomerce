<?php

namespace App\Facades;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;

class facadeClass
{
     public  function greet()
     {
          return "Hello, Greetings";
     }
     public function index()
     {
        $user=User::get();
        return $user;
     }
     public function category()
     {
        return Category::with('subcategories')->get();
     }
     public function items()
     {
        return Item::with('itemImages')->get();
     }
     public function getItemById($id)
     {

         return Item::with('itemImages')->findOrFail($id); // Find the item by ID with its associated images
     }
}
