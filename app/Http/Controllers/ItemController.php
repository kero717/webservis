<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // ПОКАЗАТЬ ВСЕ ЗАПИСИ
    public function index()
    {
        $items = Item::latest()->get(); // все записи, свежие сверху
        return response()->json($items);
    }

    // СОХРАНИТЬ НОВУЮ ЗАПИСЬ
    public function store(Request $request)
    {
        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json($item);
    }
}