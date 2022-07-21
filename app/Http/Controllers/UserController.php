<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use DB;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware(['role:SuperAdmin|Admin|Manager']);

        // $this->middleware('permission:list|create|edit|delete|user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:create|user-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:edit|user-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:delete|user-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);
        //  $this->middleware('permission:list|create|edit|delete', ['only' => ['index', 'store']]);
        //  $this->middleware('permission:create', ['only' => ['create', 'store']]);
        //  $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        //  $this->middleware('permission:delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:deletedb', ['only' => ['destroyDB']]);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language, Request $request)
    {
        $show_accardion=false; 



        // $roles = Auth::user()
        //     ->getRoleNames()
        //     ->toArray();
        // if (in_array('SuperAdmin', $roles)) {
        //     $data = User::orderBy('id', 'desc')->paginate(20);
        // }
        // if (in_array('Manager', $roles)) {

        //     $data = User::with('profile')->orderBy('id', 'desc')->paginate(20);
        //     // dd($data);
        //     // dd(Auth::user()->profile);
        // }
        $keyword = trim($request->get('keyword'));
        $inventar_number = trim($request->get('inventar_number'));
        $name = trim($request->get('name'));
        $email = trim($request->get('email'));
        $role_id = trim($request->get('role_id'));
        $organization_id = trim($request->get('organization_id'));
        $branch_id = trim($request->get('branch_id'));
        $department_id = trim($request->get('department_id'));
        $roles = Role::all();
        
        $organizations = Organization::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $branches = Branch::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');
        $departments = Department::active()->translatedIn(app()->getLocale())->listsTranslations('title')->pluck('title', 'id');

        // $data = User::orderBy('id', 'desc')->paginate(20);
        $q = User::query();
        if($name != null){
            $q->orWhere('name', 'LIKE', "%$name%");
        }
        if($email != null){
            $q->orWhere('email', 'LIKE', "%$email%");
        }
        if($inventar_number != null){
            $q->orWhere('inventar_number', 'LIKE', "%$inventar_number%");
        }

        if (!empty($role_id)) {
            $model_roles = DB::table('model_has_roles')->select('model_id')->where('role_id', $role_id)->get();
            $user_id = [];
            foreach ($model_roles as $k => $v) {
                $user_id[$k] = $v->model_id;
            }
            $users = $q->whereIn('id', $user_id);
        }
        if($keyword != null){
            $show_accardion=true;
            $q->where('inventar_number', 'LIKE', "%$keyword%")
            ->orWhere('email', 'LIKE', "%$keyword%")
            ->orWhere('name', 'LIKE', "%$keyword%");
        }
        $data = $q->with('profile')->orderBy('id', 'desc')->paginate(20);
        

        return view('users.index', compact('data', 'name', 'email', 'roles', 'role_id', 'inventar_number', 'show_accardion', 'keyword', 'organizations', 'branches', 'departments', 'department_id', 'organization_id', 'branch_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $user = new User();
        $userRole = null;

        return view('users.create', compact('roles', 'user', 'userRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'inventar_number' => 'required|unique:users,inventar_number',
                'password' => 'required|confirmed',
                'roles' => 'required'
            ],
            [
                'name.required' =>  __('The :attribute field is required.'),
                'password.required' =>  __('The :attribute field is required.'),
                'email.required' =>  __('The :attribute field is required.'),
                'roles.required' =>  __('The :attribute field is required.'),
                'inventar_number.required' =>  __('The :attribute field is required.'),
                'inventar_number.unique' =>  __('The :attribute has already been taken.'),
                'password.confirmed' =>  __('The :attribute confirmation does not match.'),
                'email.unique' =>  __('The :attribute has already been taken.'),
            ],
            [
                'inventar_number' => __('Inventar Number'),
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'roles' => __('Role'),
            ]
        );

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = $input['status'];

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function card($language, Request $request)
    {
        $id = trim($request->get('userid'));

        $from = trim($request->get('from'));
        $to = trim($request->get('to'));
        if (!empty($from) && !empty($to)) {
            $user = User::with(['profile'])
                ->whereHas('profile', function ($q) use ($from, $to) {
                    $q->whereBetween('raqami', [intval(substr('' . $from, -4)), intval(substr('' . $to, -4))]); // '=' is optional
                })->get();
        }
        if (!empty($id)) {
            $user = User::where('id', '=', $id)->get();
            // $user = User::find($id);
        }

        return view('pdf.usercard', array('users' => $user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $input['status'] = $input['status'];

        $user = User::find($user->id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index', app()->getLocale())
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::find($id)->delete();
        $user = User::find($id);
        $user->status = false;
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
