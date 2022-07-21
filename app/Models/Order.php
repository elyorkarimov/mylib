<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Order
 *
 * @property $id
 * @property $order_date
 * @property $order_number
 * @property $type
 * @property $status
 * @property $reader_id
 * @property $created_at
 * @property $updated_at
 *
 * @property OrderDetail[] $orderDetails
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Order extends Model
{
    public static $DELETED = 0;
    public static $SENT = 1;
    public static $ACCEPTED = 2;
    public static $READY = 3;
    public static $TAKEN_BY_READER = 3;

    static $rules = [
		'order_date' => 'required',
		'order_number' => 'required',
		'status' => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['order_date','order_number','type','status','reader_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reader()
    {
        return $this->hasOne('App\Models\User', 'id', 'reader_id');
    }
     

    public static function GetOrderNumber()
    {
        return str_pad(self::select('order_number', DB::raw('count(*) as total'))->groupBy('order_number')->get()->count() + 1, 4, '0', STR_PAD_LEFT);
    }



}
