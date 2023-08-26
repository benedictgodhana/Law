<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
use HasFactory;

protected $guarded = [];

// Define a relationship to the user who performed the activity
public function user()
{
return $this->belongsTo(User::class);
}

// Define a polymorphic relationship to the subject of the activity (client, advocate, etc.)
public function subject()
{
return $this->morphTo();
}

// Define a scope to retrieve activities performed by a specific user
public function scopeByUser($query, $userId)
{
return $query->where('user_id', $userId);
}

// Define a scope to retrieve activities related to a specific subject
public function scopeForSubject($query, $subjectId, $subjectType)
{
return $query->where('subject_id', $subjectId)
->where('subject_type', $subjectType);
}

// Define a custom method to get a formatted timestamp
public function getFormattedTimestampAttribute()
{
return $this->created_at->format('Y-m-d H:i:s');
}
}