<?php

namespace App\Http\Controllers;

use App\Models\BookText;
use Illuminate\Http\Request;

/**
 * Class BookTextController
 * @package App\Http\Controllers
 */
class BookTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookTexts = BookText::orderBy('id', 'desc')->paginate($perPage);

        return view('book-text.index', compact('bookTexts'))
            ->with('i', (request()->input('page', 1) - 1) * $bookTexts->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookText = new BookText();
        return view('book-text.create', compact('bookText'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookText::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookText = BookText::create(BookText::GetData($request));
        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-texts.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookText = BookText::find($id);

        return view('book-text.show', compact('bookText'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookText = BookText::find($id);

        return view('book-text.edit', compact('bookText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookText $bookText
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookText $bookText)
    {

        request()->validate(BookText::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookText->update(BookText::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-texts.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookText = BookText::find($id);
        
        $bookText->isActive=false;
        $bookText->Save();
// ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-texts.index', app()->getLocale());
    }
}
