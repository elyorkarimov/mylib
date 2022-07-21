<?php

namespace App\Http\Controllers;

use App\Models\BooksType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


/**
 * Class BooksTypeController
 * @package App\Http\Controllers
 */
class BooksTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $booksTypes = BooksType::orderBy('id', 'desc')->paginate($perPage);

        return view('books-type.index', compact('booksTypes'))
            ->with('i', (request()->input('page', 1) - 1) * $booksTypes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $booksType = new BooksType();
        return view('books-type.create', compact('booksType'));
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
            BooksType::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]
        );
        $booksTypeOld = new BooksType();

        $booksType = BooksType::create(BooksType::GetData($request, $booksTypeOld));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('books-types.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $booksType = BooksType::find($id);

        return view('books-type.show', compact('booksType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $booksType = BooksType::find($id);

        return view('books-type.edit', compact('booksType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BooksType $booksType
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, BooksType $booksType)
    {

        request()->validate(
            BooksType::rules(),
            [
                'title_en.required' =>  __('The :attribute field is required.'),
                'title_uz.required' =>  __('The :attribute field is required.'),
            ],
            [
                'title_en' => __('Title EN'),
                'title_uz' => __('Title UZ'),
            ]
        );

        $booksType->update(BooksType::GetData($request, $booksType));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('books-types.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $booksType = BooksType::find($id);
        $booksType->isActive = false;
        $booksType->Save();
        // dd($booksType);


        // ->delete()
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('books-types.index', app()->getLocale());
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($language, $id)
    {

        // BooksType::find($id)->delete();
       $booksType= BooksType::find($id);
        $booksType->isActive=false;
        $booksType->Save();
        toast(__('Deleted successfully.'), 'info');
        return back();
    }
}
