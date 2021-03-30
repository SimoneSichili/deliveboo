<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //Api restaurants with categories  
    public function restaurants() {
        $users = User::with(['categories'])->get();
        return response()->json($users);
    }

    //Api categories  
    public function categories() {
        $categories = Category::all();
        return response()->json($categories);
    }

    //Api filteredRestaurants
    public function filtered($category)
    {
        if($category != "all") {
            $restaurants = User::whereHas('categories', function($query) use($category) {
                $query->where('name', $category);
            })->get();
        } else {

            $restaurants = User::all();
        }
       

         foreach ($restaurants as $restaurant) {
             $categories = [];
             $categories = $restaurant->categories;
             $restaurant->categories = $categories;
         };

        return response()->json($restaurants);
    }

    public function getOrders($slug) {

        $restaurant = User::where('slug', $slug)->firstOrFail();
        $allOrders = Order::all();
        $orders = [];
    
        foreach ($allOrders as $order) {
            
          foreach ($order->dishes as $dish) {
    
            if ($dish->user_id === $restaurant->id && !in_array($order, $orders)) {
              
                $orders[] = $order;
    
            }
          }
        }
    
        return response()->json($orders);
    }
}
