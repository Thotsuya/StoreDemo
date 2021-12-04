<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    const PENDING = 0;
    const DELIVERED = 1;
    const IN_PROGRESS = 2;

    protected $fillable = [
      'client_id',
      'address_id'
    ];

    protected $appends = [
      'formatted_date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->order_number = rand(10000000,99999999);
        });
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot(['amount']);
    }

    public function getFormattedDateAttribute(){
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d M Y h:i A');
    }

}
