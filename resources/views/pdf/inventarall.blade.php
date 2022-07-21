<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            font-family: DejaVu Sans !important;
        }

    </style>
    <title>Template</title>

    <!-- Theme style -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- REQUIRED SCRIPTS -->
</head>
<body>
    <div class="card-body">
        <div class="row">


        @foreach ($bookInventars as $book_inventar)
            <div class="col">
                <div class="text-center">
                    @php
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book_inventar->inventar_number, $generator::TYPE_CODE_128)) . '">';
                @endphp
                <br>
                {{ $book_inventar->inventar_number }}
                </div>

            </div>
        @endforeach
    </div>
    </div>
    <script>
        window.onload = function() {
              window.print();
             setTimeout(function() {
                 window.close();
             }, 1);
         }
     </script>
</body>

</html>
