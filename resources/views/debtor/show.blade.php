@extends('layouts.app')

@section('template_title')
    {{ $debtor->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Debtor') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/debtors') }}">{{ __('Debtor') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/debtors') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <strong>{{ __('Status') }}:</strong>
                                {!! \App\Models\Debtor::GetStatus($debtor->status) !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Taken Time') }}:</strong>
                                {{ $debtor->taken_time }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Return Time') }}:</strong>
                                {{ $debtor->return_time }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Returned Time') }}:</strong>
                                {{ $debtor->returned_time }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('How Many Days') }}:</strong>
                                {{ $debtor->how_many_days }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Reader') }}:</strong>
                                {!! $debtor->reader ? $debtor->reader->name : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Book') }}:</strong>
                                {!! $debtor->book ? $debtor->book->dc_title : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{__('Inventar Number')}}:</strong>
                                <div class="text-center">
                                    @php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($debtor->bookInventar->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                    @endphp
                                    <br>
                                    {{ $debtor->bookInventar->inventar_number }}

                                </div>
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Branch') }}:</strong>
                                {!! $debtor->branch ? $debtor->branch->title : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Department') }}:</strong>
                                {!! $debtor->department ? $debtor->department->title : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Created By') }}:</strong>
                                {!! $debtor->created_by ? $debtor->createdBy->name : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Updated By') }}:</strong>
                                {!! $debtor->updated_by ? $debtor->updatedBy->name : '' !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
