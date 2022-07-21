<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Debtor
 *
 * @property $id
 * @property $status
 * @property $taken_time
 * @property $return_time
 * @property $returned_time
 * @property $count_prolong
 * @property $how_many_days
 * @property $reader_id
 * @property $book_id
 * @property $book_information_id
 * @property $book_inventar_id
 * @property $branch_id
 * @property $department_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property BookInformation $bookInformation
 * @property BookInventar $bookInventar
 * @property Branch $branch
 * @property Department $department
 * @property User $user
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Debtor extends Model
{
    public static $DELETED = 0;
    public static $GIVEN = 1;
    public static $TAKEN = 2;
    
    static $rules = [
		'status' => 'required',
		'taken_time' => 'required',
		'count_prolong' => 'required',
		'how_many_days' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status','taken_time','return_time','returned_time','count_prolong','how_many_days','reader_id','book_id','book_information_id','book_inventar_id','branch_id','department_id','created_by','updated_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function book()
    {
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookInformation()
    {
        return $this->hasOne('App\Models\BookInformation', 'id', 'book_information_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookInventar()
    {
        return $this->hasOne('App\Models\BookInventar', 'id', 'book_inventar_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reader()
    {
        return $this->hasOne('App\Models\User', 'id', 'reader_id');
    }
    
     
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function updatedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('isActive', 1);
    }
    /**
     * This is model Observer which helps to do the same actions automatically when you creating or updating models
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    } 
    public static function GetStatus($status)
    {
        if($status==self::$GIVEN){
            return "<span class='btn btn-sm btn-primary'>".__("GIVEN")."</span>"; 
        }elseif($status==self::$TAKEN){
            return "<span class='btn btn-sm btn-success'>".__("TAKEN")."</span>"; 
        }elseif($status==self::$DELETED){
            return __("DELETED");
        }
        return __("UNKNOWN");

    }
    


}
