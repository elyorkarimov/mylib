<?php

namespace App\Http\Controllers;

use App\Models\BookSubject;
use Illuminate\Http\Request;

/**
 * Class BookSubjectController
 * @package App\Http\Controllers
 */
class BookSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $bookSubjects = BookSubject::orderBy('id', 'desc')->paginate($perPage);

        return view('book-subject.index', compact('bookSubjects'))
            ->with('i', (request()->input('page', 1) - 1) * $bookSubjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookSubject = new BookSubject();
        return view('book-subject.create', compact('bookSubject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BookSubject::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookSubject = BookSubject::create(BookSubject::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('book-subjects.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $bookSubject = BookSubject::find($id);

        return view('book-subject.show', compact('bookSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $bookSubject = BookSubject::find($id);

        return view('book-subject.edit', compact('bookSubject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BookSubject $bookSubject
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BookSubject $bookSubject)
    {

        request()->validate(BookSubject::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $bookSubject->update(BookSubject::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('book-subjects.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $bookSubject = BookSubject::find($id);
        $bookSubject->isActive=false;
        $bookSubject->Save();

        toast(__('Deleted successfully.'), 'info');
        // ->delete()
        return redirect()->route('book-subjects.index', app()->getLocale());
    }
}
