<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

/**
 * Class GroupController
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $groups = Group::orderBy('id', 'desc')->paginate($perPage);

        return view('group.index', compact('groups'))
            ->with('i', (request()->input('page', 1) - 1) * $groups->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group();
        return view('group.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Group::rules());
        
        $group = Group::create(Group::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('groups.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $group = Group::find($id);

        return view('group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $group = Group::find($id);

        return view('group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Group $group)
    {

        request()->validate(Group::rules());

        $group->update(Group::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('groups.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $group = Group::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('groups.index', app()->getLocale());
    }
}
