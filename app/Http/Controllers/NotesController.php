<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $customer = Note::create($request->all());
        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function edit(Note $customer)
    {
        return view('notes.edit', compact('customer'));
    }

    public function update(Request $request, Note $customer)
    {
        $customer->update($request->all());
        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $customer)
    {
        $customer->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
