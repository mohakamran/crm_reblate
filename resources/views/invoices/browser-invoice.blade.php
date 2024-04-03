@extends('layouts.master')
@section('title')
     Invoice
@endsection
@section('page-title')
    Invoice
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')

    <style>
        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }
        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;

        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }
        .logoHeader{
            /* display: flex;
            align-items: center; */
            /* float: right; */
            /* justify-content: space-between; */
            /* margin-bottom: 20px; */
        }
        .invoice{
            padding: 10px;
            border-bottom: 1px solid #c2c6ce;
        }
        .invoice p{
            color: gray;
        }
        .invoice-color{
            margin-right: 5px;
            font-weight: 700;
            color: black;
        }
        .header-bottom {
            margin-top: 22px;
            margin-bottom: 19px;
        }
        .header-bottom_left, .header-bottom_right {
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }
        .header-bottom_left p, .header-bottom_right p {
            margin-bottom: 0;
            background-color: #14213d29;
            padding: 11px 20px;
            width: 270px;
            position: relative;
            z-index: 2;
        }
        .header-bottom_left p {
            /* -webkit-clip-path: polygon(0 0, calc(100% - 30px) 0%, 100% 100%, 0% 100%); */
            clip-path: polygon(0 0, calc(100% - 30px) 0%, 100% 100%, 0% 100%);
        }
        .header-bottom_right p {
            text-align: right;
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 30px 100%);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 30px 100%);
        }
        .darkcolor {
            display: inline-block;
            min-height: 44px;
            height: 100%;
            width: 10px;
            background-color: #14213d;
            margin-left: 6px;
            -webkit-transform: skewX(33deg);
            -ms-transform: skewX(33deg);
            transform: skewX(33deg);
        }
        .flexing{
            display: flex;
            align-items: center;
        }
        .justify-content-end{
            justify-content: end;
        }
        .addresslane{
            display: flex;
            align-items: center;
            justify-content: center;
            /* width: 100%; */
        }
        .address-left {
            border-right: none;
            border-radius: 10px;
        }
        .address-box {
            margin-bottom: 40px;
            padding: 25px 30px;
            border: 1px solid #c2c6ce;
            /* width: 200px; */
        }
        .address-right {
            border-radius: 10px;
        }
        .big{
            font-size: 18px !important;
        }
        .mb-5{
            margin-bottom: 20px !important;
        }
        .address-box address{
            margin-top: 10px;
            font-size: 16px;
            color: gray;
        }
        .invoice-table {
            border: none;
            margin-bottom: 20px;
        }
        table {
            margin: 0 0 1.5em;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #c2c6ce;
        }
        .invoice-table thead tr {
            border-bottom: none;
        }

        .invoice-table tr {


        }
        .invoice-table thead th:first-child, .invoice-table thead td:first-child {
            border-radius: 0;
        }

        .invoice-table thead th, .invoice-table thead td {
            background-color: #E1ECFF;
        }
        .invoice-table thead th{
            font-weight: 600;
        }
        .invoice-table th, .invoice-table td {
            padding: 11px 20px;
            border: none;
        }
        .invoice-table th {
            color: #111111;
        }
        .invoice_style2 .invoice-table th:nth-child(2), .invoice_style2 .invoice-table td:nth-child(2) {
            text-align: center;
        }
        .invoice_style2 .invoice-table th:nth-child(2), .invoice_style2 .invoice-table td:nth-child(2) {
            text-align: center;
        }
        .mt-4{
            margin-top: 12px;
            color: darkgray;
        }
        .total-table {
            border: none;
            margin-bottom: 0;
            margin-top: -4px;
        }
        .total-table th, .total-table td {
            border: none;
            padding: 4px 20px;
        }
        .total-table th, .total-table td {
            border: none;
            padding: 10px 20px;
        }
        .total-table tr:last-child {
            border-top: 1px solid gray;
        }
        .total-table th:nth-child(2), .total-table td:nth-child(2) {
            text-align: right;
        }
        .company-address {
            text-align: center;
            background-color: #14213d29;
            padding: 20px 30px;
            border-radius: 999px;
            margin-top: 25px;
            margin-bottom: 30px;
        }
        .company-address span{
            font-size: 20px;
            font-weight: 600;
        }
        .padding{
          margin-top: 10px;
        }
        .invoiceNote {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 15px;
        }
        .note {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .invoice-note {
            padding-top: 0;
            padding-bottom: 0;
            border-top: none;
            border-bottom: 1px solid #14213d;
            padding-bottom: 20px;
            margin-bottom: 25px;
            margin-top: 25px;
            text-align: center;
        }
            </style>



    <header style="margin-bottom: 20px;">
        <div class="logoHeader" style="margin-bottom: 20px;">
                <div class="header-logo" style="float: left">
                     <span style="color:#14213d;font-size:30px;">Reblate</span>
                     <span style="color:#fca311;font-size:30px;">Solutions</span>
                     <br>
                     <span style="color:black;font-size:20px;letter-spacing:3px;">& Service Providers</span>
                    {{-- <img style="width: 250px; object-fit: contain;" src="{{$logo_path}}" alt="ReblateSols Logo"> --}}
                </div>
            <div class="invoice" style="float:right;">
                <p class="mb-0"><span class="invoice-color"><b> INVOICE NO :</b> </span> {{$invoice_number}}</b></p>
            </div>
        </div>
        <div class="header-bottom" style="margin-top: 60px;">
            <div class="logoHeader" style="margin-bottom: 40px;">

                    <div class="header-bottom_left" style="float: left; position: relative;">
                        <p style="width: 200px" class="flexing"> <span class="invoice-color">Name :</span>{{$client_name}}</p>
                        {{-- <div class=" darkcolor"></div>
                        <div class="darkcolor"></div> --}}
                    </div>


                    <div class="header-bottom_right" style="float: right; position: relative;">
                        {{-- <div class="darkcolor"></div>
                        <div class="darkcolor"></div> --}}
                        <p style="width: 200px;" class="flexing justify-content-end"><span class="invoice-color">Date: </span>{{$invoice_month}}</p>
                    </div>

            </div>
        </div>
    </header>
    <div class="addresslane">

            <div class="address-box address-left">
                <span class="invoice-color mb-5 big">Bill From:</span>
                <address style="margin-top: 10px;font-size: 16px;color: gray;">
                    <span style="font-weight: 700; color: black;">Reblate Solutions</span> <br>
                    Phone: +1(646) 814-8076 <br>
                    Email: info@reblatesols.com <br>
                </address>
            </div>


            <div class="address-box address-right">
                <span class="invoice-color mb-5 big">Bill To:</span>
                <address style="margin-top: 10px;font-size: 16px;color: gray;">
                    <span style="font-weight: 700; color: black;">{{$client_name}}</span>
                     <br>
                     {{$client_phone}} <br>
                     {{$client_email}}<br>

                </address>
            </div>

    </div>
    <table class="invoice-table">
        <thead>
            <tr >
                <th>Name</th>
                <th>Service</th>
                @if ($invoice_profit != "")
                  <th>Profit</th>
                @endif
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr style="width: auto; ">
                <td style="text-align: center;">{{$client_name}}</td>
                <td style="text-align: center;">{{$invoice_description}}</td>
                @if ($invoice_profit != "")
                  <td>{{$invoice_profit}}</td>
                @endif
                <td style="text-align: center;">${{$invoice_amount}}</td>
            </tr>

            <tr style="">
                <td colspan="3">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <div class="logoHeader">

            <div class="invoice-left" style="float: left;">
                <span class="invoice-color mb-5 big">Please Note:</span>
                <div class="invoice-left" style="float: left;">
                    <span class="invoice-color mb-5 big">Please Note:</span>
                    </p>
                    @if($invoice_notes!="")
                        <p class="mt-4">{{$invoice_notes}}</p>
                        @else
                        <p class="mt-4">
                            Total amount payable includes applicable central <br> and state Goods & Services Tax (GST) rates

                        </p>
                    @endif
                </div>
            </div>


            <table class="total-table" style="float: right; width: 300px;">
                <tr>
                    <th style="font-weight: 600;">Sub Total</th>
                    <td style="color: gray;">{{$invoice_amount}}</td>
                </tr>
                {{-- <tr>
                    <th style="font-weight: 600;">Tax</th>
                    <td style="color: gray;">$60.00</td>
                </tr> --}}
                <tr>
                    <th style="font-weight: 600;">Total</th>
                    <td style="color: gray;">${{$invoice_amount}}</td>
                </tr>
            </table>

    </div>
    <div class="company-address" style="width:650px; margin-top:150px;">
        <span>Head Office</span> <br>
        <p class="padding">
            High End Plaza, MB1, Citi Housing, Jhelum, Punjab 46900
        </p>
    </div>
    <div class="invoiceNote">
    <div class="note" style="text-align: center;">
        <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.64581 13.7917H10.3541V12.5417H3.64581V13.7917ZM3.64581 10.25H10.3541V9.00002H3.64581V10.25ZM1.58331 17.3334C1.24998 17.3334 0.958313 17.2084 0.708313 16.9584C0.458313 16.7084 0.333313 16.4167 0.333313 16.0834V1.91669C0.333313 1.58335 0.458313 1.29169 0.708313 1.04169C0.958313 0.791687 1.24998 0.666687 1.58331 0.666687H9.10415L13.6666 5.22919V16.0834C13.6666 16.4167 13.5416 16.7084 13.2916 16.9584C13.0416 17.2084 12.75 17.3334 12.4166 17.3334H1.58331ZM8.47915 5.79169V1.91669H1.58331V16.0834H12.4166V5.79169H8.47915ZM1.58331 1.91669V5.79169V1.91669V16.0834V1.91669Z" fill="#2D7CFE" />
        </svg>
        <span style="font-weight: 600;">Note</span>
    </div>
        <p class="invoice-note">
            Thank you for choosing Reblate Solutions! We value your business and look forward to serving you again soon.
        </p>
    </div>

    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
