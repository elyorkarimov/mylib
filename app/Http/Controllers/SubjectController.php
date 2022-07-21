<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

/**
 * Class SubjectController
 * @package App\Http\Controllers
 */
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $subjects = Subject::orderBy('id', 'desc')->paginate($perPage);

        return view('subject.index', compact('subjects'))
            ->with('i', (request()->input('page', 1) - 1) * $subjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        return view('subject.create', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Subject::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);
 
        $subject = Subject::create(Subject::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('subjects.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $subject = Subject::find($id);

        return view('subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $subject = Subject::find($id);

        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Subject $subject)
    {

        request()->validate(Subject::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $subject->update(Subject::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('subjects.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $subject = Subject::find($id)->delete();

        $subject = Subject::find($id);
        $subject->isActive=false;
        $subject->save();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('subjects.index', app()->getLocale());
    }
}
