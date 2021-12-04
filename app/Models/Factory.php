<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->factory_number = rand(10000000,99999999);
        });
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot(['amount']);
    }

}
