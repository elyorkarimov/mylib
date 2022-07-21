<?php

namespace App\Http\Controllers;

use App\Models\BookFileType;
use Illuminate\Http\Request;

/**
 * Class BookFileTypeController
 * @package App\Http\Controllers
 */
class BookFileTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookFileTypes = BookFileType::orderBy('id', 'desc')->paginate($perPage);

        return view('book-file-type.index', compact('bookFileTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $bookFileTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookFileType = new BookFileType();
        return view('book-file-type.create', compact('bookFileType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookFileType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'),  
        ]);

        $bookFileType = BookFileType::create(BookFileType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-file-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookFileType = BookFileType::find($id);

        return view('book-file-type.show', compact('bookFileType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookFileType = BookFileType::find($id);

        return view('book-file-type.edit', compact('bookFileType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookFileType $bookFileType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookFileType $bookFileType)
    {

        request()->validate(BookFileType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookFileType->update(BookFileType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-file-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookFileType = BookFileType::find($id);
        $bookFileType->isActive=false;
        $bookFileType->Save();
// ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-file-types.index', app()->getLocale());
    }
}
