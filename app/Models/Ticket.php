<?php

namespace App\Models;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'message',
        'label',
        'category',
        'priority'
    ];

    public function labels() {
        return $this->belongsTo(Label::class, 'label', 'id');
    }

    public function categories() {
        return $this->belongsTo(Category::class,  'category', 'id');
    }

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function assignedToAgent() {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}
