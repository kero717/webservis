<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);


        $item = Item::create($validated);


        return response()->json([
            'success' => true,
            'message' => 'Запись успешно создана',
            'data' => $item
        ], 201);
    }
}