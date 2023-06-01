<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class BookInventar
 *
 * @property $id
 * @property $isActive
 * @property $comment
 * @property $inventar_number
 * @property $book_id
 * @property $book_information_id
 * @property $organization_id
 * @property $branch_id
 * @property $deportmetn_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property Book $book
 * @property BookInformation $bookInformation
 * @property Branch $branch
 * @property Department $department
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookInventar extends Model
{
    public static $DELETED = 0;
    public static $ACTIVE = 1;
    public static $GIVEN = 2;
    // depozitoriyaga depozitariyga
    public static $WAREHOUSE = 3;

    public static $TYPE_UK = 0;
    public static $TYPE_SOVGA = 1;//sovg'a kitoblar
    public static $TYPE_INVENTAR = 2;//inventar kitoblar
    public static $TYPE_DROP = 3;//dropli kitoblar
    public static $TYPE_NUMLESS = 4;//raqamsiz kitoblar
    public static $TYPE_NUMLESS_SECOND = 5;//raqamsiz kitoblar

    static $rules = [
        'inventar_number' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['isActive', 'comment', 'inventar_number', 'book_id', 'book_information_id', 'organization_id', 'branch_id', 'deportmetn_id', 'created_by', 'updated_by', 'key', 'bar_code', 'inventar'];


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
    public function organization()
    {
        return $this->hasOne('App\Models\Organization', 'id', 'organization_id');
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
        return $this->hasOne('App\Models\Department', 'id', 'deportmetn_id');
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

    public static function changeStatus($id, $status = null)
    {

        $model = self::find($id);
        $model->isActive = $status;
        $model->save();
        return $model;
    }

    public static function generateInventars($book_id, $book_information_id, $branch_id, $deportmetn_id, $organization_id, $copies = 0)
    {
        if ($copies > 0) {
            $last = self::orderBy('id', 'desc')->limit(1)->firstOrFail();
             
            $lN =filter_var($last->bar_code, FILTER_SANITIZE_NUMBER_INT);
           
            for($i=1; $i<=$copies; $i++){
                $lN +=1;
                $inventarData = [
                    'isActive' => true,
                    'book_id' => $book_id,
                    'book_information_id' => $book_information_id,
                    'organization_id' => $organization_id,
                    'branch_id' => $branch_id,
                    'deportmetn_id' => $deportmetn_id,
                    'key' => null,
                    'bar_code' => $lN,
                    'inventar_number' => $lN,
                    'inventar' => $lN,
                ];
                 $bookInventar = BookInventar::where('bar_code', '=', $lN)->first();

                if ($bookInventar == null) {
                    $bookInventar = BookInventar::create($inventarData);
                }

            }
        }
    }

    public static function GetStatus($status)
    {

        if ($status == self::$GIVEN) {
            return "<span class='btn btn-sm btn-primary'>" . __("GIVEN") . "</span>";
        } elseif ($status == self::$ACTIVE) {
            return "<span class='btn btn-sm btn-success'>" . __("Active") . "</span>";
        } elseif ($status == self::$DELETED) {
            return '<span class="badge badge-danger">' . __("DELETED") . '</span>';
        } elseif ($status == self::$WAREHOUSE) {
            return '<span class="badge badge-danger">' . __("WAREHOUSED") . '</span>';
        }
        return __("UNKNOWN");
    }


    
    public static function GetInventarsByBookId($id)
    {
        $inventars = self::where('book_id', '=', $id)->get();
        
        if ($inventars != null) {
            $data="";
            foreach($inventars as $k=>$inventar){
                $data.=$inventar->bar_code.', ';
            }
            return rtrim($data, ', ');
        }
        return null;
    } 
    public static function GetInventarsCountByBookId($id)
    {
        $inventars = self::where('book_id', '=', $id)->get();
        
        
        return $inventars->count();
    }
}
