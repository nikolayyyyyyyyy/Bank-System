<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'position',
        'employee_number',
        'telephone_number'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
