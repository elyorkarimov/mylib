<?php

namespace App\Http\Controllers;

use App\Jobs\MarcImportProcess;
use App\Models\Author;
use App\Models\Bibliographicrecord;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Import;
use App\Models\Subject;
use App\Models\Where;
use App\Models\Who;
use Illuminate\Http\Request;
use Scriptotek\Marc\Collection;
use Scriptotek\Marc\Record;

/**
 * Class ImportController
 * @package App\Http\Controllers
 */
class ImportController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);

        // $this->middleware('permission:list|create|edit|delete|user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create|user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit|user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete|user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);
        //  $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        //  $this->middleware('permission:create', ['only' => ['create', 'store']]);
        //  $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        //  $this->middleware('permission:delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {


        // $biblioRecords = Bibliographicrecord::get();
      
        // $data=[];


        // foreach ($biblioRecords as $biblioRecord) {

        //     $res = getArrayFromArmatPlus($biblioRecord->record);
            
        //     if ($res === false) {
        //         $err = "INCORRECT_FORMAT";
        //         break;
        //     } 
        //     Import::importData($res, "irbis_2013");


        // }
        // MarcImportProcess::dispatch("str", "from_armatplus");



        $keyword = trim($request->get('keyword'));

        $perPage = 20;
        $id = trim($request->get('id'));
        $status = trim($request->get('status'));
        $name = trim($request->get('name'));
        $publisher = trim($request->get('publisher'));
        $publisher_city = trim($request->get('publisher_city'));
        $published_year = trim($request->get('date'));
        $isbn = trim($request->get('isbn'));

        $q = Import::query();

        if (!empty($id)) {
            $q->where('id', '=', $id);
        }
        if (!empty($status)) {
            $q->where('status', '=', $status);
        }

        if (!empty($name)) {
            $q->where('title', 'LIKE', "%$name%");
        }

        if (!empty($publisher)) {
            $q->where('publisher', 'LIKE', "%$publisher%");
        }

        if (!empty($publisher_city)) {
            $q->where('published_city', 'LIKE', "%$publisher_city%");
        }
        if (!empty($published_year)) {
            $q->where('published_year', '=', $published_year);
        }
        if (!empty($isbn)) {
            $q->where('ISBN', 'LIKE', "%$isbn%");
        }

        if ($keyword != null) {
            // $q->whereJsonContains('authors', 'LIKE', "%$keyword%");
            // $q->orWhereRaw("lower(authors) like ?", ['%'.strtolower($keyword).'%']);
            $q->where('authors', 'like', '%"' . $keyword . '"%');
            $q->orWhere('authors', 'like', "%$keyword%");
        }

        // $imports = Import::orderBy('status', 'asc')->paginate($perPage);
        $imports = $q->orderBy('id', 'desc')->paginate(20);

        return view('import.index', compact('imports', 'keyword', 'id', 'status', 'name', 'publisher', 'publisher_city', 'published_year', 'isbn'))
            ->with('i', (request()->input('page', 1) - 1) * $imports->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $import = new Import();
        return view('import.create', compact('import'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            Import::rules(),
            [
                'file.required' =>  __('The :attribute field is required.'),
            ],
            [
                'file' => __('Fayl'),
            ]
        );

        Import::GetData($request);
        // $import = Import::create(Import::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('imports.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $import = Import::find($id);

        return view('import.show', compact('import'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {

        $import = Import::find($id);
        
        $book = new Book();
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // $book->dc_authors = \App\Models\Author::GetIdByJsonName($import->authors);
        // $book->dc_subjects = \App\Models\BookSubject::GetIdByJsonName($book->dc_subjects);
        $subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $wheres = Where::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $whos  = Who::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // echo "<pre>";
        // print_r($import);
        // echo "</pre>";
        // dd(\App\Models\Author::GetIdByJsonName($import->authors));
        $book->dc_title = $import->title;
        $book->dc_UDK = $import->UDK;
        $book->dc_publisher = $import->publisher;
        $book->dc_published_city = $import->published_city;
        $book->dc_date = $import->published_year;
        $book->published_year = $import->published_year;
        $book->dc_description = $import->description;
        $book->authors_mark = $import->authors_mark;

        $book->ISBN = $import->ISBN;
        $book->full_text_path = $import->full_text_path;
        $book->file_format = $import->file_format;
        $book->file_format_type = $import->file_format_type;
        $book->file_size = $import->file_size;
        $book->betlar_soni = $import->betlar_soni;
        $book->price = $import->price;
        $book->dc_authors = \App\Models\Author::GetIdByJsonName($import->authors);

        // dd(\App\Models\Author::GetStringNameByJsonName($import->authors));
       
        // dd( $book->betlar_soni);
        // dd(\App\Models\Author::GetIdByJsonName($import->authors));
        return view('book.create', compact('import', 'book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'subjects', 'wheres', 'whos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Import $import
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Import $import)
    {

        request()->validate(Import::rules());

        $import->update(Import::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('imports.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $import = Import::find($id)->delete();
        $import = Import::find($id);
        $import->status = 0;
        $import->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('imports.index', app()->getLocale());
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id, Request $request)
    {
        $type=$request->input('type');
        
        // BooksType::find($id)->delete();
        $book= Import::find($id);
        if($type=='DELETE'){
            Import::find($id)->delete();
            // $booksType->isActive=false;
            // $booksType->Save();
            toast(__('Deleted successfully.'), 'info');
            return back();    
        }else{
            return view('imports.show', compact('book'));
        }
    }
}
