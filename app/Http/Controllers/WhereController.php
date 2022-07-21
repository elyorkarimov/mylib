<?php

namespace App\Http\Controllers;

use App\Models\Where;
use Illuminate\Http\Request;

/**
 * Class WhereController
 * @package App\Http\Controllers
 */
class WhereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $wheres = Where::orderBy('id', 'desc')->paginate($perPage);

        return view('where.index', compact('wheres'))
            ->with('i', (request()->input('page', 1) - 1) * $wheres->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $where = new Where();
        return view('where.create', compact('where'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Where::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $where = Where::create(Where::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('wheres.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $where = Where::find($id);

        return view('where.show', compact('where'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $where = Where::find($id);

        return view('where.edit', compact('where'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Where $where
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Where $where)
    {

        request()->validate(Where::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $where->update(Where::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('wheres.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $where = Where::find($id)->delete();
        $where = Where::find($id);
        $where->isActive=false;
        $where->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('wheres.index', app()->getLocale());
    }
}
