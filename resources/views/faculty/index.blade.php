@extends('layouts.app')

@section('template_title')
    {{ __('Faculties') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Faculties') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Faculties') }}
            </p>
        </div>
        <div>
            <a href="{{ route('faculties.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
                                    <th>{{ __('Organization') }}</th>
                                    <th>{{ __('Branch') }}</th> 

                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('IsActive') }}</th> 


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($faculties as $faculty)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $faculty->organization_id ? $faculty->organization->title : '' !!}</td>
                                        <td>{!! $faculty->branch_id ? $faculty->branch->title:''!!}</td>

                                        <td>{{ $faculty->title }}</td>
                                        <td>{!! $faculty->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

 
                                        <td>
                                            <form action="{{ route('faculties.destroy',[app()->getLocale(), $faculty->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('faculties.show', [app()->getLocale(), $faculty->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('faculties.edit', [app()->getLocale(), $faculty->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($faculties->count() > 0)
                        {!! $faculties->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
