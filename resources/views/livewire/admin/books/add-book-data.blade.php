<div>
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card-header card-header-border-bottom d-flex justify-content-between">
        </div>
        <div class="card-body">

            <div class="box box-info padding-1">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>{{ __('Bibliographic record') }}:</th>
                    </tr>
                    <tr>
                        <td>
                            {!!\App\Models\Book::GetBibliographicById($book->id)!!}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <hr>
    @if ($updateMode)
        <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h2 class="ec-odr">{{ __('Update attached book to Branch and department') }}</h2>
        </div>
        @include('livewire.admin.books.partials.update-book-data')
    @else
        <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h2 class="ec-odr">{{ __('Attach book to Branch and department') }}</h2>
        </div>
        @include('livewire.admin.books.partials.create-book-data')
    @endif
    <div class="col-12 col-sm-12 col-lg-12">

        @if ($book_informations->count() > 0)
            <div class="table-responsive">

                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No </th>
                            <th>{{ __('IsActive') }}</th>
                            <th>{{ __('Organization') }}</th>
                            <th>{{ __('Branches') }}</th>
                            <th>{{ __('Departments') }}</th>

                            <th>{{ __('Arrived Year') }}</th>
                            <th>{{ __('Copy count') }}</th>

                            <th>{{ __('Is it in the library?') }}</th>
                            <th>{{ __('Is it in electronic format?') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($book_informations as $k => $item)
                            <tr>
                                <td>
                                    {{ $k + 1 }}
                                </td>
                                <td>
                                    
                                    {!! $item->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                                
                                </td>
                                <td>{!! $item->organization ? $item->organization->title : '' !!}</td>
                                <td>{!! $item->branch ? $item->branch->title : '' !!}</td>
                                <td>{!! $item->department ? $item->department->title : '' !!}</td>

                                <td>{{ $item->arrived_year }}</td>
                                @php
                                    $total += $item->bookInventar->count();
                                @endphp
                                <td>{{ $item->bookInventar->count() }}</td>

                                <td>{!! $item->kutubxonada_bor == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                <td>{!! $item->elektronni_bor == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url(app()->getLocale() . '/admin/books/') }}/{{ $book_id }}/{{ $item->id }}"
                                            class="btn btn-outline-success">{{ __('Add inventar') }}</a>
                                        <button class="btn btn-sm btn-success" wire:click="edit({{ $item->id }})">
                                            {{ __('Edit') }}</button>

                                        <button class="btn btn-danger btn-sm"
                                            wire:click="destroy({{ $item->id }})">{{ __('Delete') }}</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">{{ __('Total') }}:</td>
                            <td>
                                {{ $total }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <hr>
        @endif
    </div>
    @if ($book_inventars->count() > 0)
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>{{ __('IsActive') }}</th>
                            <th>{{ __('Organization') }}</th>
                            <th>{{ __('Branches') }}</th>
                            <th>{{ __('Departments') }}</th>
                            <th>{{ __('Reason for shutdown') }}</th>
                            <th class="text-center">{{ __('Bar code') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($book_inventars as $book_inventar)
                            <tr>
                                <td>
                                    {{ $book_inventar->id }}
                                </td>


                                <td>
                                    {{-- {!! $book_inventar->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!} --}}
                                    {!! \App\Models\BookInventar::GetStatus($book_inventar->isActive) !!}

                                </td>
                                <td>{!! $book_inventar->organization ? $book_inventar->organization->title : '' !!}</td>
                                <td>{!! $book_inventar->branch ? $book_inventar->branch->title : '' !!}</td>
                                <td>{!! $book_inventar->department ? $book_inventar->department->title : '' !!}</td>
                                <td>{{ $book_inventar->comment }}</td>
                                <td class="text-center">
                                    @php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book_inventar->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                    @endphp
                                    <br>
                                    {{ $book_inventar->inventar_number }}
                                </td>
                                
                                <td>
                                    {{-- <div class="btn-group mb-1">
                                        <button class="btn btn-sm btn-success"
                                            wire:click="edit({{ $book_inventar->id }})">
                                            {{ __('Edit') }}</button>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="removeInventar({{ $book_inventar->id }})">{{ __('Delete') }}
                                        </button>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


</div>
