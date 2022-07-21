<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

/**
 * Class FacultyController
 * @package App\Http\Controllers
 */
class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $faculties = Faculty::orderBy('id', 'desc')->paginate($perPage);

        return view('faculty.index', compact('faculties'))
            ->with('i', (request()->input('page', 1) - 1) * $faculties->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculty = new Faculty();
        return view('faculty.create', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Faculty::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'organization_id' => __('Organization'), 
            'branch_id' => __('Branches'), 
        ]);

        $faculty = Faculty::create(Faculty::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('faculties.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $faculty = Faculty::find($id);

        return view('faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $faculty = Faculty::find($id);

        return view('faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Faculty $faculty
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Faculty $faculty)
    {

        request()->validate(Faculty::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'organization_id' => __('Organization'), 
            'branch_id' => __('Branches'), 
        ]);

        $faculty->update(Faculty::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('faculties.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $faculty = Faculty::find($id)->delete();
        $faculty = Faculty::find($id);
        $faculty->isActive=false;
        $faculty->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('faculties.index', app()->getLocale());
    }
}
