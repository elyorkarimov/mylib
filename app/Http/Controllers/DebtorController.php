<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use Illuminate\Http\Request;

/**
 * Class DebtorController
 * @package App\Http\Controllers
 */
class DebtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $debtors = Debtor::orderBy('return_time', 'ASC')->paginate($perPage);
        // $debtors = Debtor::whereNull('qaytargan_vaqti')->groupBy('kitobxon_id')->orderBy('qaytarish_vaqti', 'asc')->paginate();

// dd($debtors);groupBy('reader_id')->
        return view('debtor.index', compact('debtors'))
            ->with('i', (request()->input('page', 1) - 1) * $debtors->perPage());
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
    public function show($language, $id)
    {
        $debtor = Debtor::find($id);

        return view('debtor.show', compact('debtor'));
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
