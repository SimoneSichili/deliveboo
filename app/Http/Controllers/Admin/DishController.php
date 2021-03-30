<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\User;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    private $dishValidation = [
        'name' => 'required',
        'img_path' => 'image',
        'price' => 'required | numeric | min:0',
        'visible' => 'boolean'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $dishes = Dish::where('user_id', Auth::id())->get();
        return view('admin.dishes.index', compact('dishes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data["user_id"]= Auth::id();
        $request->validate($this->dishValidation);
        $newDish = new Dish();

        if(!empty($data["img_path"])) {
            $data["img_path"] = Storage::disk('public')->put('dish_images', $data["img_path"]);
        }
        if(empty($data["visible"])) {
            $data["visible"] = 0;
        }
        $newDish->fill($data)->save();

        return redirect()->route('admin.dishes.index')->with('message',"Piatto creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $data = $request->all();
        $request->validate($this->dishValidation);
        if(!empty($data["img_path"])) {

            if(!empty($dish->img_path)) {

                Storage::disk('public')->delete($dish->img_path);
            }

            $data["img_path"] = Storage::disk('public')->put('dish_images', $data["img_path"]);
        }

        if(empty($data["visible"])) {
            $data["visible"] = 0;
        }

        $dish->update($data);
        return redirect()
        ->route('admin.dishes.index')
        ->with('message', 'Piatto ' . $dish->name . ' aggiornato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        if(!empty($dish->img_path)) {

            Storage::disk('public')->delete($dish->img_path);
        }
        $dish->delete();
        return redirect()
        ->route('admin.dishes.index')
        ->with('deleted', 'Piatto ' . $dish->name . ' eliminato correttamente');
    }
}
