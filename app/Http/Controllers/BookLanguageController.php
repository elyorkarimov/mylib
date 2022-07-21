<?php

namespace App\Http\Controllers;

use App\Models\BookLanguage;
use Illuminate\Http\Request;

/**
 * Class BookLanguageController
 * @package App\Http\Controllers
 */
class BookLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookLanguages = BookLanguage::orderBy('id', 'desc')->paginate($perPage);

        return view('book-language.index', compact('bookLanguages'))
            ->with('i', (request()->input('page', 1) - 1) * $bookLanguages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookLanguage = new BookLanguage();
        return view('book-language.create', compact('bookLanguage'));
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
            BookLanguage::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'code.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'code' => __('Code'),
            ]
        );

        $bookLanguage = BookLanguage::create(BookLanguage::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-languages.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookLanguage = BookLanguage::find($id);

        return view('book-language.show', compact('bookLanguage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookLanguage = BookLanguage::find($id);

        return view('book-language.edit', compact('bookLanguage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookLanguage $bookLanguage
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookLanguage $bookLanguage)
    {

        request()->validate(
            BookLanguage::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
                'code.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
                'code' => __('Code'),
            ]
        );

        $bookLanguage->update(BookLanguage::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-languages.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookLanguage = BookLanguage::find($id);

        $bookLanguage->isActive = false;
        $bookLanguage->Save();

        // ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-languages.index', app()->getLocale());
    }
}
