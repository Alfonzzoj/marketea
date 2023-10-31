<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesNote extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'note_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
