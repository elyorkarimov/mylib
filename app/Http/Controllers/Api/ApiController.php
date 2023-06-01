<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookFileType;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Subject;
use App\Models\Where;
use App\Models\Who;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Mixins\StoreCollection;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function books(Request $request)
    {
        $show_accardion=false;
        $q = Book::query();
 
        $book_bookType_id=trim($request->get('book_type_id'));
        $book_bookLanguage_id=trim($request->get('book_language_id'));
        $book_bookText_id=trim($request->get('book_text_id'));
        $book_bookTextType_id=trim($request->get('book_text_type_id'));
        $book_access_type_id=trim($request->get('book_access_type_id'));
        $book_file_type_id=trim($request->get('book_file_type_id'));
        $book_subject_id=trim($request->get('book_subject_id'));
        $book_author_id=trim($request->get('book_author_id'));
        $status=trim($request->get('status'));
        $keyword=trim($request->get('keyword'));
        $book_subject_id=trim($request->get('book_subject_id'));
        $id=trim($request->get('id'));
        $isbn=trim($request->get('isbn'));
        $title=trim($request->get('title'));
        $location_index=trim($request->get('location_index'));
        $perPage = 20;
        $sqlBuild='';
        if ($book_bookType_id != null && $book_bookType_id>0)
        {
            $show_accardion=true;
            $q->where('books_type_id', '=', $book_bookType_id);
        }

        if ($book_bookLanguage_id != null && $book_bookLanguage_id>0)
        {
            $show_accardion=true;
            $q->where('book_language_id', '=', $book_bookLanguage_id);
        }
        if ($book_bookText_id != null && $book_bookText_id>0)
        {
            $show_accardion=true;
            $q->where('book_text_id', '=', $book_bookText_id);
        }
        if ($book_bookTextType_id != null && $book_bookTextType_id>0)
        {
            $show_accardion=true;
            $q->where('book_text_type_id', '=', $book_bookTextType_id);
        }
        if ($book_access_type_id != null && $book_access_type_id>0)
        {
            $show_accardion=true;
            $q->where('book_access_type_id', '=', $book_access_type_id);
        }
        if ($book_file_type_id != null && $book_file_type_id>0)
        {
            $show_accardion=true;
            $q->where('book_file_type_id', '=', $book_file_type_id);
        }
        
        // if ($book_subject_id != null && $book_subject_id>0)
        // {
        //     $show_accardion=true;
        //     $q->where('subject_id', '=', $book_subject_id);
        // }

        if ($book_subject_id != null && $book_subject_id>0)
        {
            
            $dc_subjects = \App\Models\BookSubject::GetTitleById($book_subject_id);
            
            $q->whereJsonContains('dc_subjects', $dc_subjects);
        }
        
        if ($book_author_id != null && $book_author_id>0)
        {
             $author = \App\Models\Author::GetTitleById($book_author_id);
            $q->whereJsonContains('dc_authors', $author);
        }
        if ($status != null)
        {
             if($status>2){
                if($status==3){
                    $q->where('full_text_path', '<>', "");
                }
                if($status==4){
                    $q->where('dc_source', '<>', "");
                }

            }else{
                $q->where('status', '=', $status);
            }
        }else{
            $status=1;
        }
        if($keyword != null){
            $q->whereJsonContains('dc_authors',  [$keyword])
            ->orWhere('dc_title', 'LIKE', "%$keyword%")
            ->orWhere('location_index', 'LIKE', "%$keyword%")
            ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
            ->orWhere('dc_BBK', 'LIKE', "%$keyword%")
            ->orWhere('ISBN', 'LIKE', "%$keyword%")
            ->orWhere('published_year', 'LIKE', "%$keyword%");
        }

        if ($id != null && $id>0)
        {
            $q->where('id', '=', $id);
        }
        if ($isbn != null && $isbn>0)
        {
            $q->where('ISBN', 'LIKE', "%$isbn%");
        }
        if ($title != "")
        {
            $q->where('dc_title', 'LIKE', "%$title%");
        }
        if ($location_index != "")
        {
            $q->where('location_index', 'LIKE', "%$location_index%");
        }

      
        $stores = $q->with(['bookInventar', 'BooksType', 'BooksType.translations', 'BookLanguage', 'BookLanguage.translations'])->orderBy('id', 'desc')->paginate(20);
         




        // $stores = Book::active()->paginate(20);

        return response()->json($stores, 200);
    }
    
    public function bookTypes()
    {
        $stores = BooksType::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookLanguages()
    {
        $stores = BookLanguage::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookTexts()
    {
        $stores = BookText::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookTextType()
    {
        $stores = BookTextType::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function bookFileTypes()
    {
        $stores = BookFileType::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function subjects()
    {
        $stores = Subject::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function whos()
    {
        $stores = Who::active()->paginate(20);

        return response()->json($stores, 200);
    }
    public function wheres()
    {
        $stores = Where::active()->paginate(20);

        return response()->json($stores, 200);
    }

}
