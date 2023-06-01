@extends('layouts.app')

@section('template_title')
    {{ __('Debtors') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Debtors') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Debtor') }}
                </p>
            </div>
            <div>
                {{-- <a href="{{ route('debtors.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a> --}}
            </div>
        </div>
        {{-- <livewire:admin.qarzdorlar.ruyhat /> --}}
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">

                                <a class="btn btn-sm btn-warning "
                                    href="{{ route('debtors.index', [app()->getLocale(), 'status' => 99]) }}">{{ __('ALL') }}</a>

                                <a class="btn btn-sm btn-primary "
                                    href="{{ route('debtors.index', [app()->getLocale(), 'status' => 1]) }}">{{ __('GIVEN') }}</a>
                                <a class="btn btn-sm btn-primary "
                                    href="{{ route('debtors.index', [app()->getLocale(), 'status' => 2]) }}">{{ __('TAKEN') }}</a>
                                <a class="btn btn-sm btn-success "
                                    href="{{ route('debtors.index', [app()->getLocale(), 'status' => 98]) }}">{{ __('Debtors') }}</a>
                                <a class="btn btn-sm btn-danger "
                                    href="{{ route('debtors.index', [app()->getLocale(), 'status' => 0]) }}">{{ __('DELETED') }}</a>

                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $debtors->total()]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Reader') }}</th>
                                        <th>{{ __('GIVEN') }}</th>
                                        <th>{{ __('TAKEN') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <form action="{{ route('debtors.index', app()->getLocale()) }}" method="GET"
                                        accept-charset="UTF-8" role="search">
                                        <tr>
                                            <td></td>
                                            <td>

                                                <input type="text" class="form-control" name="keyword"
                                                    placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">

                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>
                                                <a href="{{ route('debtors.index', app()->getLocale()) }}"
                                                    class="btn btn-sm btn-info float-right">{{ __('Clear') }}</a>

                                            </td>
                                        </tr>
                                    </form> --}}
                                    @foreach ($debtors as $debtor)
                                    @if (isset($debtor->reader))
                                        

                                        <tr>
                                            <td>{{ $debtor->id }}</td>
                                            <td>
                                                {!! $debtor->reader ? $debtor->reader->name : '' !!}
                                                <br>
                                                {{ __('Email') }} : <a
                                                    href="mailTo:{!! $debtor->reader ? $debtor->reader->email : '' !!}">{!! $debtor->reader ? $debtor->reader->email : '' !!}</a> <br>
                                                {{ __('Phone Number') }} : <a
                                                    href="tel:{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}">{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}</a> <br>
                                                {{ __('Inventar Number') }} :
                                                <div class="text-left">
                                                    @if ( $debtor->reader->inventar_number)
                                                    @php
                                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($debtor->reader->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                                    @endphp
                                                    <br>
                                                    {{ $debtor->reader->inventar_number }}
                                                      
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{!! \App\Models\Debtor::GetStatusCountById($debtor->reader_id, \App\Models\Debtor::$GIVEN) !!} </td>
                                            <td>{!! \App\Models\Debtor::GetStatusCountById($debtor->reader_id, \App\Models\Debtor::$TAKEN) !!} </td>

                                            <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('debtors.show', [app()->getLocale(), $debtor->reader_id, 'status' => $status]) }}">
                                                    {{ __('Show') }}</a>
                                                {{-- <a class="btn btn-sm btn-success" href="{{ route('debtors.edit', [app()->getLocale(), $debtor->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button> --}}
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($debtors->count() > 0)
                            {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
