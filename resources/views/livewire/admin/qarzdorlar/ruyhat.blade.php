<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
     
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Reader') }}</th>
                                    <th>{{ __('Book') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Taken Time') }}</th>
                                    <th>{{ __('Return Time') }}</th>
                                    <th>{{ __('Returned Time') }}</th>
                                    <th>{{ __('How Many Days') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debtors as $debtor)
                                    <tr>
                                        <td>{{ $debtor->id }}</td>
                                        <td >
                                            
                                            {!! $debtor->reader ? $debtor->reader->name : '' !!} <br>
                                            <a href="mailTo:{!! $debtor->reader ? $debtor->reader->email : '' !!}">{!! $debtor->reader ? $debtor->reader->email : '' !!}</a> <br>
                                            <a href="tel:{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}">{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}</a>
                                            <br>
                                           <div class="text-center">
                                            @php
                                                if ($debtor->reader->inventar_number) {
                                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($debtor->reader->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                                }
                                            @endphp
                                            <br>
                                            {{ $debtor->reader->inventar_number }}
                                           </div>
                                        
                                        </td>
                                        <td>{!! $debtor->book ? $debtor->book->dc_title : '' !!}</td>

                                        <td>{!! \App\Models\Debtor::GetStatus($debtor->status) !!}</td>
                                        <td>{{ $debtor->taken_time }}</td>
                                        <td>{{ $debtor->return_time }}</td>
                                        <td>{{ $debtor->returned_time }}</td>
                                        <td>{{ $debtor->how_many_days }}</td>


                                        <td>
                                            <form
                                                action="{{ route('debtors.destroy', [app()->getLocale(), $debtor->id]) }}"
                                                method="POST">
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('debtors.show', [app()->getLocale(), $debtor->id]) }}">
                                                    {{ __('Show') }}</a>
                                                {{-- <a class="btn btn-sm btn-success" href="{{ route('debtors.edit', [app()->getLocale(), $debtor->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button> --}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @if ($debtors->count() > 0)
                        {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif --}}
                </div>
            </div>
        </div>
    </div>


</div>
