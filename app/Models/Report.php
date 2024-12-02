<?php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'generated_by',
        'content',
    ];

    public function session()
    {
        return $this->belongsTo(Sessions::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
