<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cake extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name',
        'weight',
        'price',
        'amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id'        => 'integer',
        'name'      => 'string',
        'weight'    => 'decimal:2',
        'price'     => 'decimal:2',
        'amount'    => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static array $rules = [
        'name'      => 'required|string|max:50',
        'weight'    => 'required|numeric',
        'price'     => 'required|numeric',
        'amount'    => 'required|integer',
    ];

    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'cake_lead');
    }
}
