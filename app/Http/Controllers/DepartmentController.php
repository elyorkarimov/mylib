<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Http\Request;

/**
 * Class DepartmentController
 * @package App\Http\Controllers
 */
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $departments = Department::orderBy('id', 'desc')->paginate($perPage);

        return view('department.index', compact('departments'))
            ->with('i', (request()->input('page', 1) - 1) * $departments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = new Department();
        // $branches = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        // $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        

        return view('department.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Department::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
            'branch_id.required' =>  __('The :attribute field is required.'),
            'organization_id.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
            'branch_id' => __('Branch'), 
            'organization_id' => __('Organization'), 
        ]);

        $department = Department::create(Department::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('departments.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $department = Department::find($id);

        return view('department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $department = Department::find($id);
        $branches = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        return view('department.edit', compact('department', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Department $department
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Department $department)
    {

        request()->validate(Department::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $department->update(Department::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('departments.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $department = Department::find($id)->delete();
        $department = Department::find($id);
        $department->isActive=false;
        $department->save();
        toast(__('Deleted successfully.'), 'info');
 
        return redirect()->route('departments.index', app()->getLocale());
    }
}
