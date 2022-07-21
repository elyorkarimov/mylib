@extends('layouts.app')

@section('template_title')
    {{ __('Inventar Number') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Inventar Numbers') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/books') }}">{{ __('Books') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/books') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    {{-- <livewire:admin.books.inventar-list  /> --}}
                    <div class="card">
                        <div class="container">
                            <div class="row" style="padding: 20px 20px 0px 20px">
                                <form action="{{ route('admin.inventar', app()->getLocale()) }}" method="GET"
                                    accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="from" id="from"
                                                    value="{{ $from }}"
                                                    placeholder="{{ __('from') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="to" id="to"
                                                    value="{{ $to }}" placeholder="{{ __('to') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn  btn-primary">{{ __('Search') }}</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                     <a href="{{ url(app()->getLocale() . '/admin/books/inventar') }}" class="btn btn-success">{{ __('Clear') }}</a>
                                             </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if ($from && $to)
                                                <a href="{{ route('books.inventarone', [app()->getLocale(), '0', "from"=>$from, "to"=>$to]) }}"
                                                    class="btn btn-primary float-right" data-placement="left" target="_blank">
                                                    <i class="mdi mdi-18px mdi-printer"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('books.inventarone', [app()->getLocale(), 'all']) }}"
                                                    class="btn   btn-primary float-right" data-placement="left" target="_blank">
                                                    <i class="mdi mdi-18px mdi-printer"></i>
                                                </a>
                                            @endif
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>{{ __('IsActive') }}</th>
                                            <th>
                                                {{ __('Dc Title') }}
                                            </th>
                                            <th>
                                                {{ __('Branches') }}
                                                <br>
                                                {{ __('Departments') }}
                                            </th>
                                           
                                            <th class="text-center">{{ __('Inventar Number') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barcodes as $book_inventar)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>                                                    
                                                    {!! \App\Models\BookInventar::GetStatus($book_inventar->isActive) !!}
                                                </td>
                                                <td>
                                                    {!! $book_inventar->book ? $book_inventar->book->dc_title : '' !!}
                                                </td>
                                                <td>
                                                    {!! $book_inventar->branch ? $book_inventar->branch->title : '' !!}
                                                    <br>
                                                    {!! $book_inventar->department ? $book_inventar->department->title : '' !!}
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book_inventar->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                                    @endphp
                                                    <br>
                                                    {{ $book_inventar->inventar_number }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('books.inventarone', [app()->getLocale(), $book_inventar->id]) }}"
                                                        rel="noopener" target="_blank" class="btn-sm btn btn-success "
                                                        target="__blank"><i class="mdi mdi-18px mdi-printer"></i></a>
                                                    
                                                    <a href="{{ route('books.inventarshow', [app()->getLocale(), $book_inventar->id,  "book_id"=>$book_inventar->book_id]) }}"
                                                        rel="noopener"   class="btn-sm btn btn-success "
                                                        ><i class="mdi mdi-18px mdi-eye"></i></a>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            @if ($barcodes->count() > 0)
                                {!! $barcodes->appends(Request::all())->links('vendor.pagination.default') !!}
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
