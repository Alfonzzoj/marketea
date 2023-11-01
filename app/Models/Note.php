<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'date', 'total'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function salesNote()
    {
        return $this->hasOne(SalesNote::class);
    }

    public function noteItems()
    {
        return $this->hasMany(NoteItem::class);
    }
}
