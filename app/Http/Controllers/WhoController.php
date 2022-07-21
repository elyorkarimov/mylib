<?php

namespace App\Http\Controllers;

use App\Models\Who;
use Illuminate\Http\Request;

/**
 * Class WhoController
 * @package App\Http\Controllers
 */
class WhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $whos = Who::orderBy('id', 'desc')->paginate($perPage);

        return view('who.index', compact('whos'))
            ->with('i', (request()->input('page', 1) - 1) * $whos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $who = new Who();
        return view('who.create', compact('who'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Who::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $who = Who::create(Who::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('whos.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $who = Who::find($id);

        return view('who.show', compact('who'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $who = Who::find($id);

        return view('who.edit', compact('who'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Who $who
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Who $who)
    {

        request()->validate(Who::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $who->update(Who::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('whos.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $who = Who::find($id)->delete();
        $who = Who::find($id);
        $who->isActive=false;
        $who->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('whos.index', app()->getLocale());
    }
}
