<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    // Get all menus
    public function index()
    {
        return Menu::all();
    }

    // Create a new menu
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        $menu = Menu::create([
            'id' => Str::uuid(),
            'name' => $request->name,
        ]);

        // Create root menu item
        $menu->items()->create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'parent_id' => null,
            'depth' => 0,
        ]);

        return response()->json($menu, 201);
    }

    // Get a specific menu
    public function show($id)
    {
        return Menu::with('items')->findOrFail($id);
    }
}
