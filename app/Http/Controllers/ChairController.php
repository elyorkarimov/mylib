<?php

namespace App\Http\Controllers;

use App\Models\Chair;
use Illuminate\Http\Request;

/**
 * Class ChairController
 * @package App\Http\Controllers
 */
class ChairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $chairs = Chair::orderBy('id', 'desc')->paginate($perPage);

        return view('chair.index', compact('chairs'))
            ->with('i', (request()->input('page', 1) - 1) * $chairs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chair = new Chair();
        return view('chair.create', compact('chair'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Chair::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
            'faculty_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'organization_id' => __('Organization'), 
            'branch_id' => __('Branches'), 
            'faculty_id' => __('Faculties'), 
        ]);
 
        $chair = Chair::create(Chair::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('chairs.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $chair = Chair::find($id);

        return view('chair.show', compact('chair'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $chair = Chair::find($id);

        return view('chair.edit', compact('chair'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Chair $chair
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Chair $chair)
    {

        request()->validate(Chair::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
            'faculty_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'organization_id' => __('Organization'), 
            'branch_id' => __('Branches'), 
            'faculty_id' => __('Faculties'), 
        ]);

        $chair->update(Chair::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('chairs.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $chair = Chair::find($id)->delete();
        $chair = Chair::find($id);
        $chair->isActive=false;
        $chair->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('chairs.index', app()->getLocale());
    }
}
