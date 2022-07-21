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
            <a href="{{ route('debtors.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div>
    <livewire:admin.qarzdorlar.ruyhat />
</div>
@endsection 
