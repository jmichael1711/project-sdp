<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}

</style>

<body>
    <div id="invoice">
        <div class="toolbar hidden-print">
            <div class="text-right">
                <button onclick="window.location.href='{{url('/admin/resi/edit/'.$resi->id)}}';" class="btn btn-danger ">&nbsp Back &nbsp</button>
                <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> &nbsp Print &nbsp</button>
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto" id="printArea" style="max-height: 1000px;">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <img src="/images/TAE Logo.png" alt="" data-holder-rendered="true">
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                TAE {{$user->kantor->getKota->nama}}
                            </h2>
                            <div>{{$user->kantor->alamat}},{{$user->kantor->getKota->nama}}</div>
                            <div>{{$user->kantor->no_telp}}</div>
                            <div>4team.ate@gmail.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">PENGIRIM:</div>
                            <h2 class="to">{{$resi->nama_pengirim}}</h2>
                            <div class="address">{{$resi->alamat_asal}},</div>
                            <div class="address">{{$resi->kota_asal}}, {{$resi->kode_pos_pengirim}}</div>
                            <div class="address">{{$resi->no_telp_pengirim}}</div>
                            <div class="email">{{$resi->email_pengirim}}</div>
                            <br><br>
                            <div class="text-gray-light">PENERIMA:</div>
                            <h2 class="to">{{$resi->nama_penerima}}</h2>
                            <div class="address">{{$resi->alamat_tujuan}}, </div>
                            <div class="address">{{$resi->kota_tujuan}}, {{$resi->kode_pos_penerima}}</div>
                            <div class="address">{{$resi->no_telp_penerima}}</div>
                            <div class="email">{{$resi->email_penerima}}</div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">{{$resi->id}}</h1>
                            <img style="border: 1px solid black" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$resi->id}}&choe=UTF-8"/>
                            <div class="date">Tanggal dibuat: {{date('d/m/Y H:i:s',strtotime($resi->created_at))}}</div>
                            <div class="date">Dibuat Oleh: {{$user->nama}}</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0" style="max-width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50%">KETERANGAN</th>
                                <th class="text-center" style="width: 25%">DIMENSI</th>
                                <th class="text-center" style="width: 25%">BERAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" style="width: 50%;">
                                    <div style="width: 100%;word-break: break-all;">
                                    {{$resi->keterangan}}     
                                    </div>
                                </td>
                                <td class="unit text-center" style="width: 25%">
                                    {{$resi->panjang}}cm X {{$resi->lebar}}cm X {{$resi->tinggi}}cm
                                </td>
                                <td class="qty text-center" style="width: 25%">
                                    {{$resi->berat_barang}} Kg
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td style="width: 30%">TOTAL BIAYA &emsp;&emsp; {{$harga}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </main>
                <footer>
                    Hak Cipta Oleh Team Ate Expedition
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
    <input type="hidden" id="resi_id" value="{{$resi->id}}">
</body>
<script>
    $('#printInvoice').click(function(){
            var printContents = document.getElementById("printArea").outerHTML;
            var originalContents = document.getElementById("invoice").outerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload();
    });
</script>