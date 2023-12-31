<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'transaction_date', 'amount', 'description', 'user_id'];

    protected $casts = [
        'transaction_date' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function setTransactionDatetAttribute($value)
    {
        $this->attributes['transaction_date'] = Carbon::createFromFormat('m/d/y', $value)->format('y-m-d');
    }

    protected static function booted()
    {
        if (auth()->check()) {
            static::addGlobalScope('by_user', function (Builder $builder) {
                $builder->where('user_id', auth()->id());
            });
        }
    }
}