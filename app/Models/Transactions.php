<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Transactions extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['title', 'amount', 'is_income', 'remarks', 'status'];
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        // Generate UUID for the 'id' field when creating a new record.
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            $model->expiry = Carbon::now()->addHour();
        });
    }

}
