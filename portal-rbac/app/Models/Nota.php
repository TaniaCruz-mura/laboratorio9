<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class Nota extends Model
{
    protected $fillable = ['titulo', 'contenido'];
 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
