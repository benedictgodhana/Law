<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'client_id',
        'advocate_id',
        'document_name',
        'document_type',
        'status',
        'notes',
        'file_path',
        'upload_date',
        'document_file',
        // Add other columns here
    ];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function advocate()
    {
        return $this->belongsTo(Advocate::class);
    }
}
