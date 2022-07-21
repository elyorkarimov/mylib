<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAccessType;
use App\Models\BookFileType;
use App\Models\BookLanguage;
use App\Models\BooksType;
use App\Models\BookSubject;
use App\Models\BookText;
use App\Models\BookTextType;
use App\Models\Import;
use Illuminate\Http\Request;

/**
 * Class ImportController
 * @package App\Http\Controllers
 */
class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
       
        $perPage = 20;
        $imports = Import::orderBy('id', 'desc')->paginate($perPage);

        return view('import.index', compact('imports'))
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
        request()->validate(Import::rules(),
        [
            'file.required' =>  __('The :attribute field is required.'),
        ],
        [
            'file' => __('Fayl'),
        ]);

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

        $book->price = 0;
        $book->betlar_soni = 0;

        return view('book.create', compact('import', 'book', 'bookSubjects', 'bookAuthors', 'bookTypes', 'bookLanguages', 'bookTexts', 'bookTextTypes', 'bookAccessTypes', 'bookFileTypes'));

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
        $import->status=0;
        $import->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('imports.index', app()->getLocale());
    }
}
