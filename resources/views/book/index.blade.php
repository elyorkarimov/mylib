@extends('layouts.app')

@section('template_title')
    {{ __('Books') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Books') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Books') }}
                </p>
            </div>
            <div>
                <a href="{{ route('books.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">

                    <div class="card-header">
                        <div class="accordion" id="accordionExample" style="width: 100%;">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        {{ __('Advanced search') }}
                                    </button>
                                </h2>
                                <div id="collapseOne"
                                    class="accordion-collapse collapse  @if ($show_accardion) show @endif"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('books.index', app()->getLocale()) }}" method="GET"
                                            accept-charset="UTF-8" role="search">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    @if ($bookTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_types', __('Books Type')) !!} :
                                                            {!! Form::select('book_type_id', $bookTypes, $book_bookType_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookLanguages->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_languages', __('Book Language')) !!} :
                                                            {!! Form::select('book_language_id', $bookLanguages, $book_bookLanguage_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookTexts->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_texts', __('Book Text')) !!} :
                                                            {!! Form::select('book_text_id', $bookTexts, $book_bookText_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookTextTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_text_type_id', __('Book Text Type')) !!} :
                                                            {!! Form::select('book_text_type_id', $bookTextTypes, $book_bookTextType_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    @if ($bookAccessTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_access_type_id', __('Book Access Type')) !!} :
                                                            {!! Form::select('book_access_type_id', $bookAccessTypes, $book_access_type_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookFileTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_file_type_id', __('Book File Type')) !!} :
                                                            {!! Form::select('book_file_type_id', $bookFileTypes, $book_file_type_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($bookSubjects->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_subject_id', __('Dc Subjects')) !!} :
                                                            {!! Form::select('book_subject_id', $bookSubjects, $book_subject_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if ($bookAuthors->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_author_id', __('Dc Authors')) !!} :
                                                            {!! Form::select('book_author_id', $bookAuthors, $book_author_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($subjects->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_subject_id', __('Subjects')) !!} :
                                                            {!! Form::select('book_subject_id', $subjects, $book_subject_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="keyword"
                                                        placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">

                                                        <select class="form-select" id="status" name="status">
                                                            <option value='0' {{ $status ? '' : 'selected' }}>
                                                                {{ __('Passive') }}</option>
                                                            <option value='1' {{ $status ? 'selected' : '' }}>
                                                                {{ __('Active') }}</option>
                                                        </select>
                                                        @error('status')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <a href="{{ route('books.index', app()->getLocale()) }}"
                                                    class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of bibliographic records is :attribute', ['attribute' => $books->total()]) !!}
                                {{-- , | {!!__("Number of books is :attribute",['attribute' => $books->total() ])!!} --}}
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
                                        <th>{{ __('ISBN') }}</th>
                                        <th>{{ __('Dc Title') }}</th>
                                        <th>{{ __('Dc Authors') }}</th>
                                        <th>{{ __('Books Type') }}</th>
                                        <th>{{ __('Book Language') }}</th>

                                        <th>{{ __('Book face image') }}</th>
                                        <th>{{ __('Book file') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td>{!! $book->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $book->ISBN }}</td>
                                            <td>{{ $book->dc_title }}</td>
                                            <td>
                                                @php
                                                    if ($book->dc_authors) {
                                                        foreach (json_decode($book->dc_authors) as $key => $value) {
                                                            echo $key + 1 . ') ' . $value . '<br>';
                                                        }
                                                    }
                                                @endphp
                                            </td>
                                            <td>{!! $book->BooksType ? $book->BooksType->title : '' !!}</td>
                                            <td>{!! $book->BookLanguage ? $book->BookLanguage->title : '' !!}</td>


                                            <td>

                                                @if ($book->image_path)
                                                    <img src="/storage/{{ $book->image_path }}" width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($book->full_text_path)
                                                    <a href="/storage/{{ $book->full_text_path }}"
                                                        target="__blank">{{ __('Download') }}</a>
                                                @endif
                                            </td>

                                            <td>

                                                <form
                                                    action="{{ route('books.destroy', [app()->getLocale(), $book->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('books.show', [app()->getLocale(), $book->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    @if ($current_user->organization_id == $book->organization_id || $current_user->branch_id == $book->branch_id)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('books.edit', [app()->getLocale(), $book->id]) }}">
                                                            {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                    @endif

                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($books->count() > 0)
                            {!! $books->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            // $('#book_author_id').select2({
            //     tags: true,
            // });

        });
    </script>
@endpush
