<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\SalesNote;
use Illuminate\Http\Request;

class SalesNoteController extends Controller
{
    public function index()
    {
        $sales_notes = SalesNote::all();
        return view('salesnotes.index', compact('sales_notes'));
    }

    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('salesnotes.create', compact('customers', 'items'));
    }

    public function store(Request $request)
    {
        $sale_note = SalesNote::create($request->all());
        return redirect()->route('salesnotes.index')->with('success', 'SalesNote created successfully.');
    }

    public function edit(SalesNote $sale_note)
    {
        return view('salesnotes.edit', compact('sale_note'));
    }

    public function update(Request $request, SalesNote $sale_note)
    {
        $sale_note->update($request->all());
        return redirect()->route('salesnotes.index')->with('success', 'SalesNote updated successfully.');
    }

    public function destroy(SalesNote $sale_note)
    {
        $sale_note->delete();
        return redirect()->route('salesnotes.index')->with('success', 'SalesNote deleted successfully.');
    }
}
