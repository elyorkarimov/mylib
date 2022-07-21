<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Scriptotek\Marc\Collection;

/**
 * Class Import
 *
 * @property $id
 * @property $title
 * @property $authors
 * @property $UDK
 * @property $BBK
 * @property $publisher
 * @property $published_city
 * @property $published_year
 * @property $ISBN
 * @property $description
 * @property $published_date
 * @property $authors_mark
 * @property $from_what_system
 * @property $betlar_soni
 * @property $price
 * @property $status
 * @property $extra1
 * @property $extra2
 * @property $extra3
 * @property $extra4
 * @property $created_by
 * @property $updated_by
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Import extends Model
{




    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'authors', 'UDK', 'BBK', 'publisher', 'published_city', 'published_year', 'ISBN', 'description', 'published_date', 'authors_mark', 'from_what_system', 'betlar_soni', 'price', 'status', 'extra1', 'extra2', 'extra3', 'extra4', 'created_by', 'updated_by'];



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

    public static function converting($string){
        $charset = mb_detect_encoding($string);
        // dd($charset);
        if($charset=='ASCII'){
            // return $string;
            return mb_convert_encoding($string, "ASCII", "windows-1251");
        }else{
            return mb_convert_encoding($string, "utf-8", "windows-1251");
        }
        // return $string;

    }
    public static function GetData(Request $request)
    {
        $data = [];
        $type_import = $request->input('type_import');
        $booksType_coverage_image_name = "myimported" . '.' . $request->file('file')->getClientOriginalExtension();
        $filePath = '/storage/' . $request->file('file')->storeAs('books/imported', $booksType_coverage_image_name, 'public');
        $collection = Collection::fromFile(public_path($filePath));
        // foreach ($collection as $k=> $record) { 

        //     dd($record);
        // }
        if($type_import=="armat_marc21"){
            foreach ($collection as $k=> $record) { 
                 // if($k==2){
                //     dd(self::converting($record->getField('245')->getSubfield('a')->getData()));
                // }
                if($record->getField('020')!=null){
                    if($record->getField('020')->getSubfield('a'))
                        $data['isbn'] = self::converting($record->getField('020')->getSubfield('a')->getData());
                }


                if($record->getField('090')!=null){
                    if($record->getField('090')->getSubfield('x'))
                        $data['authors_mark'] = self::converting($record->getField('090')->getSubfield('x')->getData());
                }
                if($record->getField('100')!=null){
                    $data['authors'] = self::converting($record->getField('100')->getSubfield('a')->getData());
                }


                 if($record->getField('245')!=null){
                    $data['title'] = self::converting($record->getField('245')->getSubfield('a')->getData());
                }
                if($record->getField('260')!=null){
                    if($record->getField('260')->getSubfield('a'))
                        $data['published_city'] = self::converting($record->getField('260')->getSubfield('a')->getData());
                    if($record->getField('260')->getSubfield('b'))
                        $data['publisher'] = self::converting($record->getField('260')->getSubfield('b')->getData());
                    if($record->getField('260')->getSubfield('c'))
                        $data['published_year'] = self::converting($record->getField('260')->getSubfield('c')->getData());
                }
                if($record->getField('300')!=null){
                    if($record->getField('300')->getSubfield('a'))
                        $data['betlar_soni'] = self::converting($record->getField('300')->getSubfield('a')->getData());
                }
                if($record->getField('520')!=null){
                    $data['description'] = self::converting($record->getField('520')->getSubfield('a')->getData());
                }
                
                if($record->getField('700')!=null){
                    $data['authors'] = self::converting($record->getField('700')->getSubfield('a')->getData());
                }
                $data['price'] = 0;
                $data['status'] = 1;
                 
                // dd($data);
                $import = Import::create($data);
                // dd($record->getField('100')->getSubfield('a')->getData());
                // dd($record->getField('245')->getSubfield('a')->getData());
            }
        }
        if ($type_import == "irbis_utf_8_marc21") {

            // $fn_name  = $_REQUEST['file_name'];
            $from     = 0;
            // $format   = $_REQUEST['format'];
            // $db_url   = $_REQUEST['db_url'];

            $handle          = @fopen(public_path($filePath), "r");
            $ind             = 0;
            $err             = "";

            // global $__vw_p, $__io_r;

            // $html = implode('', file('vw/uni2us.io.php'));
            // $html = str_replace("<?php", "", $html);
            // error_reporting(E_ERROR);

            while (!feof($handle)) {
                $rec      = fgets($handle, 6);
                $rec_len  = intval($rec);

                if (!($rec_len > 0))
                    continue;
                $rec_full = @fgets($handle, $rec_len - 4);
                $ind++;
                if ($ind < $from)
                    continue;

                if ($ind > ($from + 100))
                    break;

                // $res = getArrayFromIso($rec_full);
                $res = getArrayFromIso($rec_full);
                

                if ($res === false) {
                    $err = "INCORRECT_FORMAT";
                    break;
                }

                $__vw_p = $res;
                $__io_r = array(); // set 
                // $book = new Book('', $__io_r);
                // $book->add('', true);
                // Loading copies
                $data['price'] = 0;
                $data['status'] = 1;
                if (isset($res['010']) && isset($res['010']['^'])){
                    $price=substr(self::converting($res['010']['^'][0]), 1);
                    $data['price'] = $price;
                }
                // dd($res['908']);
                // if (isset($res['908'])){
                //     $price=substr(self::converting($res['908']), 1);
                //     $data['authors_mark'] = $price;
                // }
                if (isset($res['200']) && isset($res['200']['^'])){
                    $title=substr(self::converting($res['200']['^'][0]), 1);
                    $title=explode("^F", $title);
                    
                    $data['title'] = $title[0];
                }
                if (isset($res['210']) && isset($res['210']['^'])){
                    $publisher=self::converting($res['210']['^'][0]);
                    $publisher=explode("^", $publisher);
                    if(array_key_exists(2, $publisher))
                        $data['published_city'] = $publisher[2];
                    if(array_key_exists(1, $publisher))
                        $data['publisher'] = $publisher[1];
                    if(array_key_exists(0, $publisher))
                        $data['published_year'] =substr($publisher[0], 1);
                    
                }
                if (isset($res['702'])){
                    $data['authors'] = substr(self::converting($res['702']['^'][0]), 1);
                }
                // echo "<pre>";
                // print_r($data);
                // dd($res);
                // echo mb_detect_encoding($res['702']['^'][0]);
                // dd($data);
                
                // if (isset($res['910']['^'])) {
                    
                //     foreach ($res['910']['^'] as $subInd => $val) {
                //         $_items = array();
                //         $_items['INVMODE']  = $val;

                //         if (isset($res['910']['C'][$subInd]))
                //             $_items['REGDATE'] = $res['910']['C'][$subInd];
                //         else
                //             $_items['REGDATE'] = date("Ymd");

                //         if (isset($res['910']['B'][$subInd]))
                //             $_items['T090E'] = $res['910']['B'][$subInd];
                //         else
                //             $_items['T090E'] = '';

                //         if (isset($res['910']['D'][$subInd]))
                //             $_items['CUSTOM1'] = $res['910']['D'][$subInd];
                //         else
                //             $_items['CUSTOM1'] = '';

                //         if (isset($res['910']['E'][$subInd]))
                //             $_items['T876C'] = $res['910']['E'][$subInd];
                //         else
                //             $_items['T876C'] = '';

                //         if (isset($res['910']['H'][$subInd]))
                //             $_items['T876P'] = $res['910']['H'][$subInd];
                //         else
                //             $_items['T876P'] = '';

                //         if (isset($res['910']['U'][$subInd]))
                //             $_items['T990T'] = $res['910']['U'][$subInd];
                //         else
                //             $_items['T990T'] = '';

                //         if (isset($res['910']['1'][$subInd]))
                //             $_items['CNT'] = intval($res['910']['1'][$subInd]);
                //         else
                //             $_items['CNT'] = 1;
                //         // $book->addCopy($_items, false);
                //     }
                // }

                // Loading full text
                // if (isset($res['856']['U'])) {
                //     $_file = $res['856']['U'];
                //     // foreach ($_file as $key => $val)
                //         // if (file_exists($db_url . $val))
                //         //     $book->addFile($db_url . $val);
                // }
                // unset($book);
                $import = Import::create($data);
            }
            
            fclose($handle);

            // echo "<pre>";
            // foreach ($collection as $record) {
            //     print_r($record);
            //     if($record->getField('100')!=null){
            //         echo $record->getField('100')->getSubfield('a')->getData()."<br>";
            //     }
            //     // dd($record->getField('100')->getSubfield('a')->getData());
            //     // dd($record->getField('245')->getSubfield('a')->getData());
            // }
        }
        
        if ($type_import == "irbis_windows_marc21") {
             foreach ($collection as $record) {
                print_r($record->getField('702'));
                if ($record->getField('100') != null) {
                    echo $record->getField('100')->getSubfield('a')->getData() ;
                }

                if (isset($res['260'])){
                    if(isset($res['260']['A']))
                        $data['published_city'] = self::converting($res['260']['A'][0]);
                    if(isset($res['260']['B']))
                        $data['publisher'] = self::converting($res['260']['B'][0]);
                    if(isset($res['260']['C']))
                        $data['published_year'] = self::converting($res['260']['C'][0]);
                }
                // dd($record->getField('100')->getSubfield('a')->getData());
                // dd($record->getField('245')->getSubfield('a')->getData());
            }
        }
       


        return $data;
    }

    public static function rules()
    {
        $rules = [
            'file' => 'required',
        ];

        return $rules;
    }
}
