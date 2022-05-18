<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'practice_id', 'email', 'phone'];

         /**
     * Get the user that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function practice(): BelongsTo
    {
        return $this->belongsTo(Practice::class, 'practice_id',);
    }

}
