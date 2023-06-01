<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class DocumentController
 * @package App\Http\Controllers
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 20;
        $documents = Document::orderBy('id', 'desc')->paginate($perPage);

        return view('document.index', compact('documents'))
            ->with('i', (request()->input('page', 1) - 1) * $documents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = new Document();
        return view('document.create', compact('document'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Document::rules());

       

        $document = Document::create(Document::GetData($request));

        toast(__('Created successfully.'), 'success');
                        

        return redirect()->route('documents.show', [app()->getLocale(), $document->id]);

        // return redirect()->route('documents.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $document = Document::find($id);
        
        return view('document.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
        $document = Document::find($id);

        return view('document.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    public function update($language, Request $request, Document $document)
    {

        request()->validate(Document::rules());

        $document->update(Document::GetData($request));
        toast(__('Updated successfully.'), 'success');

        return redirect()->route('documents.index', app()->getLocale());
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($language, $id)
    {
        $document = Document::find($id)->delete();
        toast(__('Deleted successfully.'), 'info');

        return redirect()->route('documents.index', app()->getLocale());
    }
}
