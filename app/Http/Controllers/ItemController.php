<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $customer = Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(Item $customer)
    {
        return view('items.edit', compact('customer'));
    }

    public function update(Request $request, Item $customer)
    {
        $customer->update($request->all());
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $customer)
    {
        $customer->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
