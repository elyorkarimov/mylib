<div class="row">

    <div class="col-xl-7 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">

                <div class="box box-info padding-1">
                    <div class="box-body">
                        <div class="form-group">
                            {{ Form::label(__('Dc Title')) }}
                            {{ Form::text('dc_title', $book->dc_title, ['class' => 'form-control' . ($errors->has('dc_title') ? ' is-invalid' : ''), 'placeholder' => __('Dc Title')]) }}
                            {!! $errors->first('dc_title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        {{-- <div class="form-group">     
                            <label for="dc_title">{{__('Dc Title')}}</label>
                            <input type="text"  class="form-control  {{($errors->has('dc_title') ? ' is-invalid' : '')}}" placeholder="{{__('Dc Title')}}" name="dc_title" id="dc_title" wire:model="dc_title">
                            {!! $errors->first('dc_title', '<div class="invalid-feedback">:message</div>') !!}
                        </div> --}}

                        <div class="form-group">
                            {{ Form::label(__('Dc Authors')) }}
                            {!! Form::select('dc_authors[]', $bookAuthors, $book->dc_authors, ['class' => 'js-example-basic-single-with-tags form-control ' . ($errors->has('dc_authors') ? ' is-invalid' : ''), 'multiple']) !!}
                            {!! $errors->first('dc_authors', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Published City')) }}
                            {{ Form::text('dc_published_city', $book->dc_published_city, ['class' => 'form-control' . ($errors->has('dc_published_city') ? ' is-invalid' : ''), 'placeholder' => __('Dc Published City')]) }}
                            {!! $errors->first('dc_published_city', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Publisher')) }}
                            {{ Form::text('dc_publisher', $book->dc_publisher, ['class' => 'form-control' . ($errors->has('dc_publisher') ? ' is-invalid' : ''), 'placeholder' => __('Dc Publisher')]) }}
                            {!! $errors->first('dc_publisher', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc UDK')) }}
                            {{ Form::text('dc_UDK', $book->dc_UDK, ['class' => 'form-control' . ($errors->has('dc_UDK') ? ' is-invalid' : ''), 'placeholder' => __('Dc UDK')]) }}
                            {!! $errors->first('dc_UDK', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label(__('ISBN')) }}
                            {{ Form::text('ISBN', $book->ISBN, ['class' => 'form-control' . ($errors->has('ISBN') ? ' is-invalid' : ''), 'placeholder' => __('ISBN')]) }}
                            {!! $errors->first('ISBN', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Description')) }}
                            {{ Form::textarea('dc_description', $book->dc_description, ['class' => 'form-control' . ($errors->has('dc_description') ? ' is-invalid' : ''), 'placeholder' => __('Dc Description'), 'rows' => '3']) }}
                            {!! $errors->first('dc_description', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Source')) }}
                            {{ Form::text('dc_source', $book->dc_source, ['class' => 'form-control' . ($errors->has('dc_source') ? ' is-invalid' : ''), 'placeholder' => __('Dc Source')]) }}
                            {!! $errors->first('dc_source', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Date')) }}
                            {{ Form::number('dc_date', $book->dc_date, ['class' => 'form-control' . ($errors->has('dc_date') ? ' is-invalid' : ''), 'placeholder' => __('Dc Date')]) }}
                            {!! $errors->first('dc_date', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Betlar Soni')) }}
                            {{ Form::number('betlar_soni', $book->betlar_soni, ['class' => 'form-control' . ($errors->has('betlar_soni') ? ' is-invalid' : ''), 'placeholder' => __('Betlar Soni')]) }}
                            {!! $errors->first('betlar_soni', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Price')) }}
                            {{ Form::number('price', $book->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => __('Price')]) }}
                            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    @php
                        $status = 1;
                        if ($book->count() > 0 && isset($book->status)) {
                            $status = $book->status;
                        }
                    @endphp

                    <div class="form-group">

                        <label for="status" class="form-label">{{ __('IsActive') }}</label>
                        <select class="form-select" id="status" name="status">
                            <option value='0' {{ $status ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $status ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Dc Subjects')) }}
                        {!! Form::select('dc_subjects[]', $bookSubjects, $book->dc_subjects, ['class' => 'js-example-basic-single-with-tags form-control ' . ($errors->has('dc_subjects') ? ' is-invalid' : ''), 'multiple']) !!}
                        {!! $errors->first('dc_subjects', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label(__('Books Type', ['class' => 'form-label', 'for' => 'books_type_id'])) }}
                        {!! Form::select('books_type_id', $bookTypes, $book->books_type_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('books_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('books_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Language')) }}
                        {!! Form::select('book_language_id', $bookLanguages, $book->book_language_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('book_language_id') ? ' is-invalid' : '')]) !!}

                        {!! $errors->first('book_language_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Text')) }}
                        {!! Form::select('book_text_id', $bookTexts, $book->book_text_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('book_text_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_text_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Text Type')) }}
                        {!! Form::select('book_text_type_id', $bookTextTypes, $book->book_text_type_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('book_text_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_text_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Access Type')) }}
                        {!! Form::select('book_access_type_id', $bookAccessTypes, $book->book_access_type_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('book_access_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_access_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book File Type')) }}
                        {!! Form::select('book_file_type_id', $bookFileTypes, $book->book_file_type_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('book_file_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_file_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Image')) }}
                        <input type="file" name="file" class='form-control' />
                        @if ($book->image_path)
                            <img src="{{ asset('/storage/' . $book->image_path) }}" width="100px">
                        @endif
                        {!! $errors->first('image_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                     
                    <div class="form-group">
                        {{ Form::label(__('Book file')) }}
                        <input type="file" name="full_text" class='form-control' />
                        @if ($book->full_text_path)
                            <a href="/storage/{{$book->full_text_path}}" target="__blank">{{__('Download')}}</a>
                        @endif
                        {!! $errors->first('full_text_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    {{-- <div class="form-group">
                        <div class="dropzone" id="file-dropzone"></div>
                    </div> --}}

                    <div class="row">
                        <div class="col-12 box-footer mt20">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileDropzone = {
        url: '{{ route('file.store', app()->getLocale()) }}',
        // acceptedFiles: ".pdf",
        // addRemoveLinks: true,
        dictDefaultMessage: "Файлни шу ерга юкланг",
        // dictFallbackMessage = "Браузерингиз драг н дроп файлларни юклашни қўллаб-қувватламайди.",
        // dictInvalidFileType = "Бундай турдаги файлларни юклай олмайсиз.",
        // dictCancelUpload = "Юклашни бекор қилиш",
        // dictCancelUploadConfirmation = "Ҳақиқатан ҳам бу юклашни бекор қилмоқчимисиз?",
        // dictRemoveFile = "Файлни олиб ташланг",
        // dictMaxFilesExceeded = "Сиз бошқа файл юклай олмайсиз.",
        timeout: 180000,

        maxFilesize: 50,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'POST',
                url: '{{ route('file.remove', app()->getLocale()) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
                },
                success: function(data) {
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            console.log(response.success);
            console.log(file);
        },
    }
</script>
    <script>
        $(document).ready(function() {
            $('#author-dropdown').select2({
                tags: true,
            });

            $('#subject-dropdown').select2({
                tags: true,
            });

        });
    </script>
@endpush
