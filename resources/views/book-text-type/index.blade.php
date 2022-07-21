@extends('layouts.app')

@section('template_title')
    {{ __('Book Text Type') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Text Type') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Text Type') }}
            </p>
        </div>
        <div>
            <a href="{{ route('book-text-types.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
                                    <th>{{ __('IsActive') }}</th> 
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Bibliographic record') }}</th>



                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookTextTypes as $bookTextType)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
                                        <td>{!! $bookTextType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $bookTextType->title }}</td>
                                            <td>{{ $bookTextType->books->count() }}</td>

                                        <td>
                                            <form action="{{ route('book-text-types.destroy',[app()->getLocale(), $bookTextType->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('book-text-types.show', [app()->getLocale(), $bookTextType->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('book-text-types.edit', [app()->getLocale(), $bookTextType->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($bookTextTypes->count() > 0)
                        {!! $bookTextTypes->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
