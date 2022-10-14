<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id'        => 'integer',
        'name'      => 'string',
        'email'     => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'name'      => 'nullable|string|max:255',
        'email'     => 'required|email',
        'cakes.*'     => 'required|exists:App\Models\Cake,id',
    ];

    public function cakes()
    {
        return $this->belongsToMany(Cake::class, 'cake_lead');
    }
}
