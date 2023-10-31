<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteItem extends Model
{
    use HasFactory;
    protected $fillable = ['note_id', 'item_id', 'quantity', 'total', 'attach'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
