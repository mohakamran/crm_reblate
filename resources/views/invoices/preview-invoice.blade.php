<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Invoice</title>
    <style>
        * {
    border: 0;
    box-sizing: border-box;
    /* color: inherit; */
    /* font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; */
    list-style: none;
    margin: 0;
    padding: 0;
    text-decoration: none;

}
.logo {
    width: 250px;
    object-fit: contain;

}
.head{
    display: flex;
    justify-content: space-between;
    align-items:center ;
}
.storeName{
    display: flex;
    flex-direction: column;
    padding: 10px;
}
.title{
    text-transform: capitalize;
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 10px;
}
.desc{
    font-size: 15px;
}
.p-10{
    padding: 10px;
    margin-top: 15px;
}
.w-full{
    width: 100%;
}

.text-center{
    text-align: center;
}
h1 {
    font: bold 100% sans-serif;
    letter-spacing: 0.5em;
    text-align: center;
    text-transform: uppercase;
}
.border{
    border: 2px solid #14213d;
    background-color: white;
    color: #14213d;
}
.font-weight{
    font-weight: 500;
}
hr{
    width: 100%;
    border: 1px solid gray;
    border-radius: 100%;
}
.contact{
    padding: 20px;
    font-family: sans-serif;
}
.contact{
    padding: 20px;
    font-family: sans-serif;
}

.contact a{
    text-decoration: none;
    font-size: 15px;
    color: #14213d;
}
.add{
    padding: 10px;
}
.add h2{
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 10px;
}
.contact span{

    font-weight: 700;
}
.contact p{
    margin-bottom: 10px;
}
.mt-10{
    margin-top: 10px;
}
/* table */

table {
    font-size: 75%;
    table-layout: fixed;
    width: 100%;
}

table {
    border-collapse: separate;
    border-spacing: 2px;
}

th,
td {
    border-width: 2px;
    padding: 0.5em;
    position: relative;
    text-align: left;
}

th,
td {
    border-radius: 0.25em;
    border-style: solid;
}

th {
    background: #14213d;
    color: white;
    border-color: #14213d;
    padding: 10px;
    font-size: 15px;
}

td {
    border-color: #DDD;
    font-size: 14px;
}

/* page */

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
    background: #FFF;
    border-radius: 1px;
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
}


header {
    margin: 0 0 3em;
}
header h1 {
    background: #14213d;
    border-radius: 0.25em;
    color: #FFF;
    margin: 0 0 5px;
    padding:10px;
}
.main{
    background:none;
    color: #14213d;
    font-size: 20px;
    margin: 0 0 5px;
    letter-spacing: 2px;
    padding:10px;
}

/* article */

article,
article address,
table.meta,
table.inventory, table.details {
    margin: 0 0 1em;
}

article:after {
    clear: both;
    content: "";
    display: table;
}

article h1 {
    clip: rect(0 0 0 0);
    position: absolute;
}

article address {
    float: left;
    font-size: 125%;
    font-weight: bold;
}

/* table meta & balance */

table.meta,
table.balance {
    float: right;
    width: 36%;
}

table.meta:after,
table.balance:after {
    clear: both;
    content: "";
    display: table;
}

/* table meta */

table.meta th {
    width: 60%;
}

table.meta td {
    width: 60%;
}

/* table items */

table.inventory {
    clear: both;
    width: 100%;
}

table.inventory th {
    font-weight: bold;
    text-align: center;
}

table.inventory td:nth-child(1) {
    width: 26%;
}

table.inventory td:nth-child(2) {
    width: 38%;
}

table.inventory td:nth-child(3) {
    text-align: right;
    width: 12%;
}
.margin-top{
    margin-top: 60px
}

table.inventory td:nth-child(4) {
    text-align: right;
    width: 12%;
}

table.inventory td:nth-child(5) {
    text-align: right;
    width: 12%;
}

/* table balance */

table.balance th,
table.balance td {
    width: 50%;
}

table.balance td {
    text-align: right;
}

/* aside */

aside h1 {
    border: none;
    border-width: 0 0 1px;
    margin: 0 0 1em;
}

aside h1 {
    border-color: #999;
    border-bottom-style: solid;
}


    </style>
</head>
<body>
    <header>
        <h1 class="main">Reblate Solutions and Service Providers</h1>
        <h1>Invoice</h1>
    </header>
    <article>
        <div class="head">
            <address >
                {{-- <img class="logo" alt="reblate logo" src="{{url('reblat-logo.png')}}"/> --}}
            </address>

            <table class="meta">
                <tr>
                    <th><span>Invoice #</span></th>
                    <td class="p-10"><span> {{$invoice_number}}</span></td>
                </tr>
                <tr>
                    <th><span>Invoice Month</span></th>
                    <td class="p-10"><span>{{$invoice_month}}</span></td>
                </tr>
                <tr>
                    <th><span>Phone Number</span></th>
                    <td class="p-10"><span>+</span><span>16468148076</span></td>
                </tr>
            </table>
        </div>
        <table class="inventory">
            <tr>
                <th colspan="2"><span>BILL TO </span></th>
                <th colspan="2"><span>Due Date </span></th>
            </tr>

                <tr>
                    <td colspan="2" >
                        <div class="storeName">
                            <h2 class="title">{{$client_name}}</h2>
                            <p class="desc">{{$client_email}}</p>

                        </div>
                    </td>

                    <td colspan="2" class="w-full h-full text-center">
                    <p class="desc p-10"><strong>{{$invoice_due_date}}</strong></p>
                </td>

                </tr>


        </table>
        <table class="details">
            <tr>
                <th><span>Period</span></th>
                <th><span>Description </span></th>
                <th><span>Profit</span></th>
                <th><span>Amount</span></th>
            </tr>
            <tr>
                    <td class="p-10"><span class="desc">{{$invoice_month}}</span></td>
                    <td class="p-10"><span class="desc">{{$invoice_description}} <br>
                        </span></td>
                    <td class="p-10"><span class="desc">${{$invoice_profit}}</span></td>
                    <td class="p-10"><span class="desc">${{$invoice_amount}}</span></td>
                </tr>
        </table>

        <table class="balance">
            <tr>
                <th class="border p-10"><span class="title font-weight">Balance</span></th>
                <td class="border p-10"><span class="title font-weight">${{$invoice_amount}}</span></td>
            </tr>
        </table>
        <table class="margin-top">
            <tr>
                <td>
                    <div class="add">
                        <h2>
                            Additional Notes :
                        </h2>
                    @if ('invoice_notes')
                        <p class="notes">
                            {{$invoice_notes}}
                        </p>
                    @endif
                    </div>
                </td>
            </tr>
        </table>

    </article>
    <hr>
      <div class="contact">
        <p >
            <span>Website:</span> <a href="https://reblatesols.com"> https://reblatesols.com </a>
        </p>
      <p>
        <span>Address: </span>High End Plaza, MB1, Citi Housing, Jhelum, Punjab 46900
      </p>
      <p class="mt-10"> <span>Issue Date : </span>
        09 May 2023</p>
      <p><span>Payment Method : </span>Payoneer</p>
    </div>

</body>
</html>
