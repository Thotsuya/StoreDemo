<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,softDeletes;

    protected $appends = [
        'short_description',
        'total'
    ];

    protected $fillable = [
      'name',
      'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->product_number = rand(10000000,99999999);
        });
    }

    public function getShortDescriptionAttribute(){
        return Str::words($this->attributes['description'],10);
    }

    public function factories(){
        return $this->belongsToMany(Factory::class)->withPivot(['amount']);
    }

    public function getTotalAttribute(){
        return $this->factories()->sum('amount');
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot(['amount']);
    }


}
