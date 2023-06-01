<div class="row">

    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body"> 
                <div class="ec-cat-form">
                    <div class="form-group">
                        {{ Form::label(__('Title')) }}
                        {{ Form::text('title', $document->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
                        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Number')) }}
                        {{ Form::text('number', $document->number, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : ''), 'placeholder' => 'Number']) }}
                        {!! $errors->first('number', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Date')) }}
                        {{ Form::date('arrived_date', $document->arrived_date, ['class' => 'form-control' . ($errors->has('arrived_date') ? ' is-invalid' : ''), 'placeholder' => __('Arrived Year') ]) }}
                        {!! $errors->first('arrived_date', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        @if ($document->file)
                            <input type="file" name="file" class='form-control'
                                value="{{ $document->file }}" />
                            <a href="/storage/{{ $document->file }}" target="__blank">{{ __('Download') }}</a>
                        @else
                            <input type="file" name="file" class='form-control' />
                        @endif
                        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label(__('Consignment Note')) }}
                        {{ Form::text('consignment_note', $document->consignment_note, ['class' => 'form-control' . ($errors->has('consignment_note') ? ' is-invalid' : ''), 'placeholder' => 'Consignment Note']) }}
                        {!! $errors->first('consignment_note', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Act Number')) }}
                        {{ Form::text('act_number', $document->act_number, ['class' => 'form-control' . ($errors->has('act_number') ? ' is-invalid' : ''), 'placeholder' => 'Act Number']) }}
                        {!! $errors->first('act_number', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('KSU')) }}
                        {{ Form::text('ksu', $document->ksu, ['class' => 'form-control' . ($errors->has('ksu') ? ' is-invalid' : ''), 'placeholder' => 'Ksu']) }}
                        {!! $errors->first('ksu', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Comment')) }}
                        {{ Form::text('comment', $document->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
                        {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
               

                <div class="box-footer mt20">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>



</div>
