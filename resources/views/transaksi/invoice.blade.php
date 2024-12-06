<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        *,
        *::after,
        *::before {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        ul {
            list-style-type: none;
        }

        ul li {
            margin: 2px 0;
        }

        /* text colors */
        .text-dark {
            color: var(--dark-color);
        }

        .text-blue {
            color: var(--blue-color);
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-start {
            text-align: left;
        }

        .text-bold {
            font-weight: 700;
        }

        /* hr line */
        .hr {
            height: 1px;
        }

        /* border-bottom */
        .border-bottom {
            border-bottom: 1px solid black;
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        .invoice-wrapper {
            min-height: 100vh;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .invoice {
            max-width: 850px;
            margin-right: auto;
            margin-left: auto;
            padding: 70px;
            border-radius: 5px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            min-height: 920px;
        }

        .invoice-head-top-left img {
            width: 130px;
        }

        .invoice-head-top-right h3 {
            font-weight: 500;
            font-size: 27px;
            /* color: var(--blue-color); */
        }

        .invoice-head-middle,
        .invoice-head-bottom {
            padding: 8px 0;
        }

        .invoice-body {
            border: 1px solid black;
            border-radius: 4px;
            overflow: hidden;
        }

        .invoice-body table {
            border-collapse: collapse;
            border-radius: 4px;
            width: 100%;
        }

        .invoice-body table td,
        .invoice-body table th {
            padding: 5px;
        }

        .invoice-body table tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .invoice-body-info-item {
            display: grid;
            grid-template-columns: 80% 20%;
        }

        .invoice-body-info-item .info-item-td {
            padding: 5px;
        }

        .invoice-foot {
            padding: 10px 0;
        }

        .invoice-foot p {
            font-size: 8px;
        }

        .foot {

            border-radius: 5px;
            border-top: 1px solid black;
        }

        .invoice-head-top,
        .invoice-head-middle,
        .invoice-head-bottom {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding-bottom: 10px;
        }

        @media screen and (max-width: 992px) {
            .invoice {
                padding: 40px;
            }
        }

        @media screen and (max-width: 576px) {

            .invoice-head-top,
            .invoice-head-middle,
            .invoice-head-bottom {
                grid-template-columns: repeat(1, 1fr);
            }

            .invoice-head-bottom-right {
                margin-top: 12px;
                margin-bottom: 12px;
            }

            .invoice * {
                text-align: left;
            }

            .invoice {
                padding: 10px;
            }
        }

        .invoice-body {
            min-width: 600px;
        }
    </style>

    <body>

        <div class = "invoice-wrapper" id = "print-area">
            <div class = "invoice">
                <div class = "invoice-container">
                    <div class = "invoice-head">
                        <div class = "invoice-head-top">
                            <div class = "invoice-head-top-left text-start">
                                <img src = "img/images/logoin.png" width="200">
                            </div>
                        </div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'>Invoice:</li>
                                    <li>Laptop Second Parung</li>
                                    <li>{{ $tanggal }}</li>
                                    <li>Alamat</li>
                                    <li>Invoice No.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td class = "text-bold">no</td>
                                        <td class = "text-bold">Produk</td>
                                        <td class = "text-bold">Harga</td>
                                        <td class = "text-bold">Qty</td>
                                        <td class = "text-bold">Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($td as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->produk->merk }}</td>
                                            <td>{{ rupiah($item->produk->harga_beli) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td class = "text-end">{{ rupiah($item->subtotal) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="foot">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Diskon</td>
                                    <td class="text-end"> {{ $transaksi->diskon }} %</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total:</td>
                                    <td class="text-end">{{ rupiah($transaksi->total) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class = "invoice-foot text-center">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt
                            and does not require physical signature.</p>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </body>

</html>
