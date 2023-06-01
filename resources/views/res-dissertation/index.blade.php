@extends('layouts.app')

@section('template_title')
    {{ __('Dissertations') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Dissertations') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Dissertations') }}
                </p> 
            </div>
            <div>
                <a href="{{ route('res-dissertations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('res-dissertations.index', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="keyword"
                                        placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('res-dissertations.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                 
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $scientificPublications->total()]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Published Year') }}</th>
                                        <th>{{ __('Bar code') }}</th>
                                        <th>{{ __('Inventar Number') }}</th>
                                        <th>{{ __('Resource language') }}</th>
                                        <th>{{ __('Resource Type') }}</th>
                                        <th>{{ __('Resource Field') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Full Text Path') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scientificPublications as $scientificPublication)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{!! $scientificPublication->isActive == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $scientificPublication->title }}</td>
                                            <td>{{ $scientificPublication->publication_year }}</td>
                                            <td>{{ $scientificPublication->barcode }}</td>
                                            <td>{{ $scientificPublication->inventar_number }}</td>
                                            <td>
                                                {!! $scientificPublication->resTypeLang ? $scientificPublication->resTypeLang->title : '' !!}
                                            </td>
                                            <td>
                                                {!! $scientificPublication->resType ? $scientificPublication->resType->title : '' !!}
                                            </td>
                                            <td>
                                                {!! $scientificPublication->resField ? $scientificPublication->resField->title : '' !!}
                                            </td>
                                            <td>
                                                @if ($scientificPublication->image_path)
                                                    <img src="{{ asset('/storage/scientificPublications/photo/' . $scientificPublication->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($scientificPublication->file_path)
                                                    <a href="{{ asset('/storage/scientificPublications/full-text/' . $scientificPublication->file_path) }}"
                                                        target="__blank">{{ __('Download') }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('res-dissertations.destroy', [app()->getLocale(), $scientificPublication->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('res-dissertations.show', [app()->getLocale(), $scientificPublication->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('res-dissertations.edit', [app()->getLocale(), $scientificPublication->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($scientificPublications->count() > 0)
                            {!! $scientificPublications->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
