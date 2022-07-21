<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

/**
 * Class Book
 *
 * @property $id
 * @property $dc_title
 * @property $authors_mark
 * @property $slug
 * @property $dc_subjects
 * @property $dc_creators
 * @property $dc_authors
 * @property $dc_UDK
 * @property $dc_BBK
 * @property $dc_source
 * @property $dc_rights
 * @property $dc_relation
 * @property $dc_publisher
 * @property $dc_identifier
 * @property $dc_published_city
 * @property $ISBN
 * @property $dc_description
 * @property $dc_date
 * @property $dc_coverage
 * @property $dc_contributor
 * @property $image_path
 * @property $full_text_path
 * @property $file_format
 * @property $file_format_type
 * @property $file_size
 * @property $betlar_soni
 * @property $price
 * @property $status
 * @property $published_year
 * @property $extra1
 * @property $extra2
 * @property $extra3
 * @property $extra4
 * @property $books_type_id
 * @property $book_language_id
 * @property $book_text_id
 * @property $book_text_type_id
 * @property $book_access_type_id
 * @property $book_file_type_id
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property BooksType $booksType
 * @property BookAccessType $bookAccessType
 * @property BookFileType $bookFileType
 * @property BookLanguage $bookLanguage
 * @property BookText $bookText
 * @property BookTextType $bookTextType
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Book extends Model
{
    use Sluggable;
    static $rules = [
        'dc_title' => 'required',
        'betlar_soni' => 'required',
        'price' => 'required',
        'status' => 'required',
        'slug' => 'required',

    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['dc_title', 'authors_mark', 'slug', 'dc_subjects', 'dc_creators', 'dc_authors', 'dc_UDK', 'dc_BBK', 'dc_source', 'dc_rights', 'dc_relation', 'dc_publisher', 'dc_identifier', 'dc_published_city', 'ISBN', 'dc_description', 'dc_date', 'dc_coverage', 'dc_contributor', 'image_path', 'full_text_path', 'file_format', 'file_format_type', 'file_size', 'betlar_soni', 'price', 'status', 'published_year', 'extra1', 'extra2', 'extra3', 'extra4', 'books_type_id', 'book_language_id', 'book_text_id', 'book_text_type_id', 'book_access_type_id', 'book_file_type_id', 'created_by', 'updated_by', 'where_id', 'who_id', 'subject_id'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'dc_title'
            ]
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function booksType()
    {
        return $this->hasOne('App\Models\BooksType', 'id', 'books_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookAccessType()
    {
        return $this->hasOne('App\Models\BookAccessType', 'id', 'book_access_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookFileType()
    {
        return $this->hasOne('App\Models\BookFileType', 'id', 'book_file_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function whos()
    {
        return $this->hasOne('App\Models\Who', 'id', 'who_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wheres()
    {
        return $this->hasOne('App\Models\Where', 'id', 'where_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookInventar()
    {
        return $this->hasMany('App\Models\BookInventar', 'book_id', 'id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookLanguage()
    {
        return $this->hasOne('App\Models\BookLanguage', 'id', 'book_language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookText()
    {
        return $this->hasOne('App\Models\BookText', 'id', 'book_text_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bookTextType()
    {
        return $this->hasOne('App\Models\BookTextType', 'id', 'book_text_type_id');
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
        return $query->where('status', 1);
    }

    public function scopeTotalAll()
    {
        $books = DB::select("SELECT COUNT( DISTINCT book_id) as total_all FROM `book_inventars` WHERE isActive=1");
        if (count($books) > 0) {
            return $books[0]->total_all;
        }
        return 0;
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

            $roles = Auth::user()->getRoleNames()->toArray();
            if (count($roles) > 0) {
                $user = Auth::user()->profile;
                $model->organization_id = $user->organization_id;
                $model->branch_id  = $user->branch_id;
            }
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public static function GetData(Request $request)
    {
        $data = [];
        foreach (config('app.locales') as $k => $locale) {
            $type = new self();
            foreach ($type->translatedAttributes as $key => $val) {
                $data[$k][$val] = $request->input($val . '_' . $k);
            }
        }

        $data['isActive'] = $request->input('isActive');
        return $data;
    }
    public static function rules()
    {

        foreach (config('app.locales') as $k => $locale) {
            $rules['title_' . $k] = 'required';
        }
        return $rules;
    }

    public static function GetBibliographicById($id)
    {
        $book = self::find($id);
        if ($book != null) {
            $bibliographicdata = '';
            if ($book->dc_authors) {
                $all_authors = '';
                foreach (json_decode($book->dc_authors) as $key => $value) {
                    $all_authors .= $value . ' ';
                }
                $bibliographicdata .= '<b>' . $all_authors . '</b><br>';
            }
            if ($book->dc_title) {
                $bibliographicdata .= $book->dc_title . ' ';
            }

            if ($book->book_file_type_id) {
                $bibliographicdata .= '[' . $book->bookFileType->title . ']: ';
            }
            if ($book->dc_authors) {
                $all_authors = '';
                foreach (json_decode($book->dc_authors) as $key => $value) {
                    $all_authors .= $value . ' ';
                }
                $bibliographicdata .= ' / ' . $all_authors . '.';
            }
            if ($book->dc_published_city) {
                // $bibliographicdata.='<span class="dashes">-</span>'.strtoupper(substr($book->dc_published_city, 0, 1)).'.:';
                $bibliographicdata .= '<span class="dashes">-</span>' . $book->dc_published_city . '.:';
            }
            if ($book->dc_publisher) {
                $bibliographicdata .= ' ' . $book->dc_publisher . ', ' . $book->published_year ?? $book->published_year;
            }
            if ($book->betlar_soni) {
                $bibliographicdata .= '. <span class="dashes">-</span>' . $book->betlar_soni . ' bet.';
            }




            return $bibliographicdata;
        }
        return null;
    }
}
