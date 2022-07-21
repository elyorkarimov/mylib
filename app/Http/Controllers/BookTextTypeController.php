<?php

namespace App\Http\Controllers;

use App\Models\BookTextType;
use Illuminate\Http\Request;

/**
 * Class BookTextTypeController
 * @package App\Http\Controllers
 */
class BookTextTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookTextTypes = BookTextType::orderBy('id', 'desc')->paginate($perPage);

        return view('book-text-type.index', compact('bookTextTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $bookTextTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookTextType = new BookTextType();
        return view('book-text-type.create', compact('bookTextType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookTextType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookTextType = BookTextType::create(BookTextType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-text-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookTextType = BookTextType::find($id);

        return view('book-text-type.show', compact('bookTextType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookTextType = BookTextType::find($id);

        return view('book-text-type.edit', compact('bookTextType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookTextType $bookTextType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookTextType $bookTextType)
    {

        request()->validate(BookTextType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookTextType->update(BookTextType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-text-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookTextType = BookTextType::find($id);
        $bookTextType->isActive=false;
        $bookTextType->Save();
// ->delete()
        toast(__('Deleted successfully.'), 'info');
        
        return redirect()->route('book-text-types.index', app()->getLocale());
    }
}
