<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    // Add item hierarchically
    public function addItem(Request $request, $menuId)
    {
        $request->validate(['name' => 'required|string', 'parent_id' => 'nullable|string']);

        $parent = MenuItem::findOrFail($request->parent_id);
        $depth = $parent->depth + 1;

        MenuItem::create([
            'id' => Str::uuid(),
            'menu_id' => $menuId,
            'parent_id' => $parent->id,
            'name' => $request->name,
            'depth' => $depth,
        ]);

        return response()->json(['message' => 'Item added successfully'], 201);
    }

    // Update an item
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string']);
        $item = MenuItem::findOrFail($id);
        $item->name = $request->name;
        $item->save();

        return response()->json(['message' => 'Item updated successfully']);
    }

    // Delete an item
    public function destroy($id)
    {
        $item = MenuItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }

    // Get menu items hierarchically
    public function getMenuItems($id)
    {
        $menuItems = MenuItem::where('menu_id', $id)->get()->toArray();
        return $this->buildHierarchy($menuItems);
    }

    // Helper function to build hierarchical structure
    private function buildHierarchy(array $elements, $parentId = null)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildHierarchy($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
