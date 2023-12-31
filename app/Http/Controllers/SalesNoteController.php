<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Note;
use App\Models\NoteItem;
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
        // Obtener los datos del formulario
        $items = $request->input('items');
        $quantities = $request->input('quantities');
        // return $items;

        $note = Note::create([
            'customer_id' => $request->customer_id,
            'date' => date('Y-m-d'),
            'total' => $request->total,
        ]);

        $sale_note = SalesNote::create([
            'customer_id' => $request->customer_id,
            'note_id' => $note->id,
        ]);


        for ($i = 0; $i < count($items); $i++) {
            $item = Item::find($items[$i]);
            $quantity = $quantities[$i];

            NoteItem::create([
                'note_id' => $note->id,
                'item_id' => $item->id,
                'quantity' => $quantity,
                'price' => $item->price,
                'total' => $item->price * $quantity,
                'attach' => null
            ]);
        }
        return redirect()->route('salesnotes.index')->with('success', 'SalesNote created successfully.');
    }

    public function show($sale_note_id)
    {
        $sale_note = SalesNote::find($sale_note_id);
        return view('salesnotes.show', compact('sale_note'));
    }

    public function edit($sale_note)
    {
        $sale_note = SalesNote::find($sale_note);
        // return $sale_note->note->noteItems;
        $customers = Customer::all();
        $items = Item::all();
        return view('salesnotes.edit', compact('sale_note', 'customers', 'items'));
    }

    public function update(Request $request, $sale_note_id)
    {
        $sale_note = SalesNote::find($sale_note_id);

        $note_old = Note::find($sale_note->note_id);

        $note_new = Note::create([
            'customer_id' => $request->customer_id,
            'date' => date('Y-m-d'),
            'total' => $request->total,
        ]);

        $sale_note->update([
            'customer_id' => $request->customer_id,
            'note_id' => $note_new->id,
        ]);

        $note_old->delete();


        $items = $request->input('items');
        $quantities = $request->input('quantities');
        for ($i = 0; $i < count($items); $i++) {
            $item = Item::find($items[$i]);
            $quantity = $quantities[$i];

            NoteItem::create([
                'note_id' => $note_new->id,
                'item_id' => $item->id,
                'quantity' => $quantity,
                'price' => $item->price,
                'total' => $item->price * $quantity,
                'attach' => null
            ]);
        }
        return redirect()->route('salesnotes.index')->with('success', 'SalesNote updated successfully.');
    }

    public function destroy($sale_note_id)
    {
        $sale_note = SalesNote::find($sale_note_id);
        $sale_note->delete();
        return redirect()->route('salesnotes.index')->with('success', 'SalesNote deleted successfully.');
    }
}
