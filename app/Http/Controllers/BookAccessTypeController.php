<?php

namespace App\Http\Controllers;

use App\Models\BookAccessType;
use Illuminate\Http\Request;

/**
 * Class BookAccessTypeController
 * @package App\Http\Controllers
 */
class BookAccessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookAccessTypes = BookAccessType::orderBy('id', 'desc')->paginate($perPage);

        return view('book-access-type.index', compact('bookAccessTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $bookAccessTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookAccessType = new BookAccessType();
        return view('book-access-type.create', compact('bookAccessType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookAccessType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'code.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'code' => __('Key'), 
        ]);

        $bookAccessType = BookAccessType::create(BookAccessType::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-access-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookAccessType = BookAccessType::find($id);

        return view('book-access-type.show', compact('bookAccessType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookAccessType = BookAccessType::find($id);

        return view('book-access-type.edit', compact('bookAccessType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookAccessType $bookAccessType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookAccessType $bookAccessType)
    {

        request()->validate(BookAccessType::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'code.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'code' => __('Key'), 
        ]);

        $bookAccessType->update(BookAccessType::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-access-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookAccessType = BookAccessType::find($id);
        $bookAccessType->isActive=false;
        $bookAccessType->Save();
// ->delete()

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('book-access-types.index', app()->getLocale());
    }
}
