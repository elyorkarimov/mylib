<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class DebtorController
 * @package App\Http\Controllers
 */
class DebtorController extends Controller
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
        $status = trim($request->get('status'));
        $keyword = trim($request->get('keyword'));
        if($status==null){
            $status=99;
        }

        if ($status == 99) {
            $debtors = Debtor::with(['reader', 'reader.profile'])->orderBy('return_time', 'asc')->orderBy('status', 'ASC')->distinct()->paginate(20,['reader_id']);
        }elseif($status == 98){
            $debtors = Debtor::with(['reader', 'reader.profile'])->whereNull('returned_time')->where('return_time', '<', date("Y-m-d"))->orderBy('return_time', 'asc')->distinct()->paginate(20,['reader_id']);
        } else {
            $debtors = Debtor::with(['reader', 'reader.profile'])->where('status', '=', $status)->orderBy('return_time', 'asc')->distinct()->paginate(20,['reader_id']);
        } 

        
        return view('debtor.index', compact('debtors', 'status', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $debtor = new Debtor();
        return view('debtor.create', compact('debtor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Debtor::rules());

        $debtor = Debtor::create(Debtor::GetData($request));

        toast(__('Created successfully.'), 'success');

        return redirect()->route('debtors.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id, Request $request)
    {
        $status=trim($request->get('status'));
        $perPage = 20;

        $user = User::find($id);
        if($status==99){
            $debtors = Debtor::where('reader_id', $id)->orderBy('return_time', 'asc')->orderBy('status', 'ASC')->paginate($perPage);
        }elseif($status==98){
            $debtors = Debtor::whereNull('returned_time')->where('reader_id', $id)->where('return_time', '<', date("Y-m-d"))->orderBy('return_time', 'desc')->paginate($perPage);
        }else{
            $debtors = Debtor::where('reader_id', $id)->where('status', $status)->orderBy('return_time', 'asc')->paginate($perPage);
        }
        return view('debtor.show', compact('debtors', 'user'))->with('i', (request()->input('page', 1) - 1) * $debtors->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $debtor = Debtor::find($id);

        return view('debtor.edit', compact('debtor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Debtor $debtor
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Debtor $debtor)
    {

        request()->validate(Debtor::rules());

        $debtor->update(Debtor::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('debtors.index', app()->getLocale());
    }

    // /**
    //  * @param int $id
    //  * @return \Illuminate\Http\RedirectResponse
    //  * @throws \Exception
    //  */
    // public function destroy($language, $id)
    // {
    //     $debtor = Debtor::find($id)->delete();
    //     toast(__('Deleted successfully.'), 'info');

    //     return redirect()->route('debtors.index', app()->getLocale());
    // }
}
