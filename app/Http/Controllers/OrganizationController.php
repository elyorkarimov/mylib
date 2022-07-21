<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

/**
 * Class OrganizationController
 * @package App\Http\Controllers
 */
class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $organizations = Organization::orderBy('id', 'desc')->paginate($perPage);

        return view('organization.index', compact('organizations'))
            ->with('i', (request()->input('page', 1) - 1) * $organizations->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organization = new Organization();
        return view('organization.create', compact('organization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Organization::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $organization = Organization::create(Organization::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('organizations.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $organization = Organization::find($id);

        return view('organization.show', compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $organization = Organization::find($id);

        return view('organization.edit', compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Organization $organization
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Organization $organization)
    {

        request()->validate(Organization::rules(),
        [
            'title_en.required' =>  __('The :attribute field is required.'),
            'title_uz.required' =>  __('The :attribute field is required.'),
        ],
        [
            'title_en' => __('Title EN'),
            'title_uz' => __('Title UZ'), 
        ]);

        $organization->update(Organization::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('organizations.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        // $organization = Organization::find($id)->delete();
        $organization = Organization::find($id);
        $organization->isActive=false;
        $organization->save();

        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('organizations.index', app()->getLocale());
    }
}
