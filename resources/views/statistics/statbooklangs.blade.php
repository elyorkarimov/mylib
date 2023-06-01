@extends('layouts.app')

@section('template_title')
    {{ __('Book Language') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Monthly statistics on language of literature') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Language') }}
                </p>
            </div>
             
        </div>

        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">

                    <div class="card-header">
                        <form action="{{ route('admin.statbooklangs', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-daterange">

                                        <select class="form-control" name="year">
                                            <option>{{ __('Select Year') }}</option>
                                            @foreach ($years as $y)
                                                @if ($year==$y)
                                                    <option value="{{$y}}" selected> {{$y}} </option>
                                                @else
                                                    <option value="{{$y}}"> {{$y}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('admin.statbooklangs', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>

                            </div>
                        </form>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Title') }}</th>
                                        @foreach ($months as $k => $month)
                                            <th>{{ $month }}                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookLanguages as $booksType)
                                        {{-- <tr class="clickable-row" data-href="{{ route('book-types.show', [app()->getLocale(), $booksType->id]) }}"> --}}
                                        <tr>
                                            <td>{{ $booksType->id }}</td>
                                            <td class="text text-right">
                                                {{ $booksType->title }} <br> Nomda:<br>
                                                Nusxada
                                            </td>
                                            @foreach ($months as $k => $month)
                                                <td>
                                                    <br>
                                                    {{-- {{ $booksType->id }} {{ $k }}, {{ $month }} --}} 
                                                    <b>{!! \App\Models\BookLanguage::GetCountBookByBookTypeByMonthAndId($booksType->id, $year, $k)!!}</b> <br>
                                                    <b>{!! \App\Models\BookLanguage::GetCountBookCopiesByBookTypeByMonthAndId($booksType->id, $year, $k)!!}</b>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="clear"></div>
                        @if ($bookLanguages->count() > 0)
                            {!! $bookLanguages->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
