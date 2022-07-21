<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #invoice-POS {
            /* position: absolute;   */
            /* left: 50%;
            top: 100%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%); */
            /* padding-top: 90%; */
            width: 5cm;
            height: 3cm;
            background: #FFF;

            ::selection {
                background: #f31544;
                color: #FFF;
            }

            ::moz-selection {
                background: #f31544;
                color: #FFF;
            }

            #top,
            #mid,
            #bot {
                /* Targets all id with 'col-' */
                border-bottom: 1px solid #EEE;
            }

            #top {
                min-height: 100px;
            }

            #mid {
                min-height: 80px;
            }


            .info {
                display: block;
                //float:left;
                margin-left: 0;
            }

            .title {
                float: right;
            }

            .title p {
                text-align: right;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            td {
                //padding: 5px 0 5px 15px;
                //border: 1px solid #EEE
            }

            .tabletitle {
                //padding: 5px;
                font-size: .5em;
                background: #EEE;
            }

            .service {
                border-bottom: 1px solid #EEE;
            }

            .item {
                width: 24mm;
            }

            .itemtext {
                font-size: .5em;
            }

            #legalcopy {
                margin-top: 5mm;
            }

        }

        #legalcopy{
            text-align: center;
        }
        .legal {
            text-align: center;
        }

        #p_title {
            font-size: 14px;
        }

        #bot {
            position: absolute;

            bottom: 0;

            left: 0;

        }

    </style>
    <style type="text/css" media="print">
        @page { size: portable; }
      </style>
</head>

<body>
    <div id="invoice-POS">
        <div id="bot">
            <div id="legalcopy"> 
                
            <span class="legal">
                @php
                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($bookInventar->inventar_number, $generator::TYPE_CODE_128)) . '">';
                @endphp
                <center>{{ $bookInventar->inventar_number }}</center>
            </span>
            </div>
        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->
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
