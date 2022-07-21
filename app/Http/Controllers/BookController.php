<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookInformation;
use App\Models\BookInventar;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Debtor;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
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
        
        if ($book_subject_id != null && $book_subject_id>0)
        {
            $show_accardion=true;
            $q->where('subject_id', '=', $book_subject_id);
        }

        if ($book_subject_id != null && $book_subject_id>0)
        {
            $show_accardion=true;
            $dc_subjects = \App\Models\BookSubject::GetTitleById($book_subject_id);
            $q->whereJsonContains('dc_subjects', $dc_subjects);
        }
        
        if ($book_author_id != null && $book_author_id>0)
        {
            $show_accardion=true;
            $author = \App\Models\Author::GetTitleById($book_author_id);
            $q->whereJsonContains('dc_authors', $author);
        }
        if ($status != null)
        {
            $show_accardion=true;
            $q->where('status', '=', $status);
        }else{
            $status=1;
        }
        if($keyword != null){
            $show_accardion=true;
            
            $q->whereJsonContains('dc_authors',  [$keyword])
            ->orWhere('dc_title', 'LIKE', "%$keyword%")
            ->orWhere('dc_UDK', 'LIKE', "%$keyword%")
            ->orWhere('ISBN', 'LIKE', "%$keyword%")
            ->orWhere('published_year', 'LIKE', "%$keyword%");
        }
        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $subjects = Subject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $books = $q->with('bookInventar')->orderBy('id', 'desc')->paginate($perPage);
        // dd($books[0]->bookInventar->count());
        $current_roles = Auth::user()->getRoleNames()->toArray();
        $current_user = Auth::user()->profile;

        return view('book.index', compact('books','bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes', 'book_bookType_id', 'book_bookLanguage_id', 'book_bookText_id', 'book_bookTextType_id', 'book_access_type_id', 'book_file_type_id', 'book_subject_id', 'status', 'keyword', 'show_accardion', 'book_author_id', 'subjects', 'book_subject_id', 'current_roles', 'current_user'))
            ->with('i', (request()->input('page', 1) - 1) * $books->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book();
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        $book->price = 0;
        $book->betlar_soni = 0;
        $import = null;
        return view('book.create', compact('import', 'book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes'));
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
            [
                'dc_title' => 'required|min:3',
                'dc_authors' => 'required',
                'dc_date' => 'required',
                'betlar_soni' => 'required',
                'betlar_soni' => 'required',
                'books_type_id' => 'required',
                'price' => 'required',
            ],
            [
                'dc_title.required' =>  __('The :attribute field is required.'),
                'dc_authors.required' =>  __('The :attribute field is required.'),
                'dc_date.required' =>  __('The :attribute field is required.'),
                'betlar_soni.required' =>  __('The :attribute field is required.'),
                'books_type_id.required' =>  __('The :attribute field is required.'),
                'price.required' =>  __('The :attribute field is required.'),
            ],
            [
                'dc_title' => __('Dc Title'),
                'dc_authors' => __('Dc Authors'),
                'dc_date' => __('Dc Date'),
                'betlar_soni' => __('Betlar Soni'),
                'books_type_id' => __('Books Type'),
                'price' => __('Price'),
            ]
        );
        $subjectsAll = [];
        if ($request->input('dc_subjects') != null && count($request->input('dc_subjects')) > 0) {
            foreach ($request->input('dc_subjects') as $k => $v) {
                $book_subjects = BookSubject::find($v);

                if ($book_subjects == null) {
                    $data = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $data[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    BookSubject::create($data);
                    $subjectsAll[$k] = $v;
                } else {
                    $subjectsAll[$k] = $book_subjects->title;
                }
            }
        }
        $authorsAll = [];
        if ($request->input('dc_authors') != null && count($request->input('dc_authors')) > 0) {
            foreach ($request->input('dc_authors') as $k => $v) {
                $author = Author::find($v);
                if ($author == null) {
                    $authorData = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    Author::create($authorData);
                    $authorsAll[$k] = $v;
                } else {
                    $authorsAll[$k] = $author->title;
                }
            }
        }

        $image_path = null;
        if ($request->file('file')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $up = $request->file('file')->storeAs('books/face/images', $filePath, 'public');
            $image_path = "books/face/images/" . $filePath;
        }

        $full_text_path = null;
        $file_format = null;
        $file_format_type = null;
        $file_size = null;
        if ($request->file('full_text')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('full_text')->getClientOriginalExtension();
            $up = $request->file('full_text')->storeAs('books/fulltext', $filePath, 'public');
            $full_text_path = "books/fulltext/" . $filePath;
            $file_format = $request->file('full_text')->getClientOriginalExtension();
            $file_format_type = $request->file('full_text')->getMimeType();
            $file_size = $request->file('full_text')->getSize();
        }

        $input = [
            'dc_title' => $request->input('dc_title'),
            'dc_subjects' => json_encode($subjectsAll),
            'dc_creators' => json_encode($authorsAll),
            'dc_authors' => json_encode($authorsAll),
            'dc_UDK' => $request->input('dc_UDK'),
            'dc_source' => $request->input('dc_source'),
            'dc_publisher' => $request->input('dc_publisher'),
            'dc_published_city' => $request->input('dc_published_city'),
            'ISBN' => $request->input('ISBN'),
            'dc_description' => $request->input('dc_description'),
            'dc_date' => $request->input('dc_date'),
            'betlar_soni' => $request->input('betlar_soni'),
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'published_year' => $request->input('dc_date'),
            'image_path' => $image_path,
            'books_type_id' =>  $request->input('books_type_id'),
            'book_language_id' =>  $request->input('book_language_id'),
            'book_text_id' =>  $request->input('book_text_id'),
            'book_text_type_id' => $request->input('book_text_type_id'),
            'book_access_type_id' =>  $request->input('book_access_type_id'),
            'book_file_type_id' =>  $request->input('book_file_type_id'),
            'full_text_path' => $full_text_path,
            'file_format' => $file_format,
            'file_format_type' => $file_format_type,
            'file_size' => $file_size,
        ];

        DB::beginTransaction();

        try {
            $book = Book::create($input);

            DB::commit();
            toast(__('Successfully saved'), 'success');
            // return redirect()->route('books.index', app()->getLocale());
            // return redirect()->route('dashboard');
            return redirect()->to(app()->getLocale() . '/admin/books/' . $book->id);
        } catch (\Exception $e) {
            DB::rollback();
            // Send error back to user
        }

        // dd($request->all());
        // request()->validate(Book::rules());

        // $book = Book::create(Book::GetData($request));

        // toast(__('Created successfully.'), 'success');

        // return redirect()->route('books.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $book = Book::find($id);

        return view('book.show', compact('book'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inventarshow($language, $id, Request $request)
    {
        $perPage = 20;
        $bookInventar = BookInventar::find($id);
        $book_id = trim($request->get('book_id'));
        
        if($bookInventar != null){
            $debtors = Debtor::where('book_inventar_id','=',$bookInventar->id)->orderBy('status', 'asc')->paginate($perPage);
            $book = Book::find($book_id);
            $book_information = BookInformation::where('book_id', '=', $book_id)->first();
            
            return view('book.debtors', compact('bookInventar','debtors', 'book', 'book_information'));
        }else{
            abort(404);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function printinventar($language, $id,  Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        if ($id == 'all') {
            $bookInventars = BookInventar::active()->orderBy('id', 'desc')->get();
            return view('pdf.inventarall', compact('bookInventars'));
        }elseif (!empty($from) && !empty($to)) {
            // intval(substr('' . trim($request->get('from'))
            $bookInventars = BookInventar::whereBetween('inventar_number', [intval($from), intval($to)])
                ->get();
                return view('pdf.inventarall', compact('bookInventars'));

        } else {
            $bookInventar = BookInventar::find($id);
            return view('pdf.inventarone', compact('bookInventar'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inventar($language, Request $request)
    {
        $from = trim($request->get('from'));
        $to = trim($request->get('to'));

        $perPage = 20;
        if (!empty($from) && !empty($to)) {
            // intval(substr('' . trim($request->get('from'))
            $barcodes =BookInventar::whereBetween('inventar_number', [intval($from), intval($to)])
                ->paginate($perPage);
        } elseif (!empty($from)) {
            $barcodes = BookInventar::where('inventar_number', '=', $from)
                ->paginate($perPage);
        } elseif (!empty($to)) {
            $barcodes = BookInventar::where('inventar_number', '=', $to)
                ->paginate($perPage);
        } else {
            $barcodes = BookInventar::orderBy('inventar_number', 'desc')->paginate($perPage);
        }


        return view('book.inventar', compact('barcodes', 'from', 'to'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function addinventar($language, $id, $book_information_id)
    {
        $book = Book::find($id);

        return view('book.addinventar', compact('book', 'book_information_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $book = Book::find($id);
        $bookSubjects = BookSubject::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAuthors = Author::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTypes = BooksType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookLanguages = BookLanguage::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTexts = BookText::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookTextTypes = BookTextType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookAccessTypes = BookAccessType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $bookFileTypes = BookFileType::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $book->dc_authors = \App\Models\Author::GetIdByJsonName($book->dc_authors);
        $book->dc_subjects = \App\Models\BookSubject::GetIdByJsonName($book->dc_subjects);

        return view('book.edit', compact('book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes'));
        // return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Book $book)
    {

        request()->validate(
            [
                'dc_title' => 'required|min:3',
                'dc_authors' => 'required',
                'dc_date' => 'required',
                'betlar_soni' => 'required',
                'betlar_soni' => 'required',
                'books_type_id' => 'required',
                'price' => 'required',
            ],
            [
                'dc_title.required' =>  __('The :attribute field is required.'),
                'dc_authors.required' =>  __('The :attribute field is required.'),
                'dc_date.required' =>  __('The :attribute field is required.'),
                'betlar_soni.required' =>  __('The :attribute field is required.'),
                'books_type_id.required' =>  __('The :attribute field is required.'),
                'price.required' =>  __('The :attribute field is required.'),
            ],
            [
                'dc_title' => __('Dc Title'),
                'dc_authors' => __('Dc Authors'),
                'dc_date' => __('Dc Date'),
                'betlar_soni' => __('Betlar Soni'),
                'books_type_id' => __('Books Type'),
                'price' => __('Price'),
            ]
        );
        $subjectsAll = [];
        if ($request->input('dc_subjects') != null && count($request->input('dc_subjects')) > 0) {
            foreach ($request->input('dc_subjects') as $k => $v) {
                $book_subjects = BookSubject::find($v);

                if ($book_subjects == null) {
                    $data = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $data[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    BookSubject::create($data);
                    $subjectsAll[$k] = $v;
                } else {
                    $subjectsAll[$k] = $book_subjects->title;
                }
            }
        }
        $authorsAll = [];
        if ($request->input('dc_authors') != null && count($request->input('dc_authors')) > 0) {
            foreach ($request->input('dc_authors') as $k => $v) {
                $author = Author::find($v);
                if ($author == null) {
                    $authorData = null;
                    $count = 0;
                    foreach (config('app.locales') as $til_code => $locale) {
                        $authorData[$til_code] = [
                            'title' => $v
                        ];
                        $count += 1;
                    }
                    Author::create($authorData);
                    $authorsAll[$k] = $v;
                } else {
                    $authorsAll[$k] = $author->title;
                }
            }
        }

        $image_path = null;
        if ($request->file('file')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $up = $request->file('file')->storeAs('books/face/images', $filePath, 'public');
            $image_path = "books/face/images/" . $filePath;
            if ($book->image_path != null) {
                $path = public_path('storage/' . $book->image_path);
                $isExists = file_exists($path);
                if ($isExists && is_file($path)) {
                    unlink($path);
                }
            }
        } else {
            $image_path = $book->image_path;
        }


        $full_text_path = null;
        $file_format = null;
        $file_format_type = null;
        $file_size = null;
        if ($request->file('full_text')) {
            $filePath = Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('full_text')->getClientOriginalExtension();
            $up = $request->file('full_text')->storeAs('books/fulltext', $filePath, 'public');
            $full_text_path = "books/fulltext/" . $filePath;
            $file_format = $request->file('full_text')->getClientOriginalExtension();
            $file_format_type = $request->file('full_text')->getMimeType();
            $file_size = $request->file('full_text')->getSize();
            if ($book->full_text_path != null) {
                $path = public_path('storage/' . $book->full_text_path);
                $isExists = file_exists($path);
                if ($isExists && is_file($path)) {
                    unlink($path);
                }
            }
        } else {
            $full_text_path = $book->full_text_path;
            $file_format = $book->file_format;
            $file_format_type = $book->file_format_type;
            $file_size = $book->file_size;
        }
        $input = [
            'dc_title' => $request->input('dc_title'),
            'dc_subjects' => json_encode($subjectsAll),
            'dc_creators' => json_encode($authorsAll),
            'dc_authors' => json_encode($authorsAll),
            'dc_UDK' => $request->input('dc_UDK'),
            'dc_source' => $request->input('dc_source'),
            'dc_publisher' => $request->input('dc_publisher'),
            'dc_published_city' => $request->input('dc_published_city'),
            'ISBN' => $request->input('ISBN'),
            'dc_description' => $request->input('dc_description'),
            'dc_date' => $request->input('dc_date'),
            'betlar_soni' => $request->input('betlar_soni'),
            'price' => $request->input('price'),
            'status' => $request->input('status'),
            'published_year' => $request->input('dc_date'),
            'image_path' => $image_path,
            'books_type_id' =>  $request->input('books_type_id'),
            'book_language_id' =>  $request->input('book_language_id'),
            'book_text_id' =>  $request->input('book_text_id'),
            'book_text_type_id' => $request->input('book_text_type_id'),
            'book_access_type_id' =>  $request->input('book_access_type_id'),
            'book_file_type_id' =>  $request->input('book_file_type_id'),
            'full_text_path' => $full_text_path,
            'file_format' => $file_format,
            'file_format_type' => $file_format_type,
            'file_size' => $file_size,
        ];

        DB::beginTransaction();

        try {
            $new_book = Book::find($book->id);
            $new_book->update($input);
            DB::commit();
            toast(__('Successfully saved'), 'success');
            // return redirect()->route('books.index', app()->getLocale());
            // return redirect()->route('dashboard');
            return redirect()->to(app()->getLocale() . '/admin/books/' . $book->id);
        } catch (\Exception $e) {
            DB::rollback();
            // Send error back to user
        }

        // request()->validate(Book::rules());

        // $book->update(Book::GetData($request));
        // toast(__('Updated successfully.'), 'success');

        // return redirect()->route('books.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $book = Book::find($id)->delete();
        $book = Book::find($id);
        $book->status = false;
        $book->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('books.index', app()->getLocale());
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deletedb($language, $id)
    {
        // $book = Book::find($id)->delete();
        $book = Book::find($id);
        $book->status = false;
        $book->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('books.index', app()->getLocale());
    }
}
