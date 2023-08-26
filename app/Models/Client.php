<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'name',
        'contact_info',
        'date_of_birth',
        'case_details',
        'case_status',
        'relevant_dates',
        'case_description',
        'notes',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advocate()
    {
        return $this->belongsTo(Advocate::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
