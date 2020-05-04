<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bon Muat {{$bonmuat->id}} dan Surat Jalan</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    #buttonContainer{
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>
<body>
    <div class="d-flex flex-row-reverse" id="buttonContainer">
    <button id="print" class="ml-2 btn btn-info">&nbsp Print &nbsp</button>
    <button onclick="window.location.href='{{url('/admin/bonmuat/edit/'.$bonmuat->id)}}';" class="btn btn-danger">&nbsp Back &nbsp</button>
    </div>  
    <div id="printArea">

        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2" style="border-bottom: 5px solid black;">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="/images/TAE Logo.png" style="width:100%; max-width:300px;">
                                </td>
                                <td>
                                    <h1> Bon Muat</h1>
                                    <h4>{{$bonmuat->id}}</h4>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <br>
                                    Gudang : {{$bonmuat->kantor_asal->alamat}}, {{$bonmuat->kantor_asal->kota}} <br>
                                    Pengangkut : {{$bonmuat->kurir_non_customer->nama}}<br>
                                    No. Truk : {{$bonmuat->kendaraan->nopol}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="heading">
                    <td>
                        Muatan
                    </td>
                    
                    <td>
                        
                    </td>
                </tr>
                
                <tr class="details">
                    <td>
                        Isi
                    </td>
                    
                    <td>
                        {{$bonmuat->resis()->count()}} colly
                    </td>
                </tr>
                <tr class="details">
                    <td>
                        Berat
                    </td>
                    
                    <td>
                        {{$bonmuat->total_muatan}} Kg
                    </td>
                </tr>
            </table>
            <br><br>
            <table>
                <tr>
                    <td style="width: 50%"></td>
                    <td style="width: 50%" class="text-center">
                        {{$bonmuat->kantor_asal->kota}}, {{date('d-m-Y',strtotime($bonmuat->created_at))}}<br>
                    </td>
                </tr>
                <tr><td><br></td></tr>
                <tr><td><br></td></tr>
                <tr><td><br></td></tr>
                <tr>
                    <td style="width: 50%"></td>
                    <td style="width: 50%" class="text-center">
                        ( {{$user->nama}} )<br>
                    </td>
                </tr>
            </table>
        </div>

        <br><br>
        <hr style="border-top: 1px dashed black">
        <br><br>

        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="3" style="border-bottom: 5px solid black;">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="/images/TAE Logo.png" style="width:100%; max-width:300px;">
                                </td>
                                <td>
                                    <br>
                                    <h1> Surat Jalan</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <br>
                                    <span class="font-weight-bold"> Kepada Yth, </span><br>
                                    {{$bonmuat->kantor_tujuan->alamat}}, {{$bonmuat->kantor_tujuan->kota}} <br>
                                    {{$bonmuat->kantor_tujuan->no_telp}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Tanggal : {{date('d-m-Y',strtotime($bonmuat->created_at))}} <br>
                                    No. Bon Muat: {{$bonmuat->id}}<br>
                                    Pengangkut : {{$bonmuat->kurir_non_customer->nama}}<br>
                                    No. Truk : {{$bonmuat->kendaraan->nopol}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td style="width: 5%">
                        No. 
                    </td>
                    <td class="text-left" style="width: 70%">
                        Resi 
                    </td>
                    <td style="width: 25%">
                        Berat
                    </td>
                </tr>
                @foreach($bonmuat->resis as $i)
                    <tr class="details">
                        <td style="width: 5%">
                            {{$loop->iteration}}.
                        </td>
                        <td class="text-left" style="width: 70%">
                            {{$i->id}}
                        </td>
                        <td style="width: 25%">
                            {{$i->berat_barang}} Kg
                        </td>
                    </tr>
                @endforeach
            </table>
            <br><br>
            <table>
                <tr>
                    <td style="width: 50%" class="text-center">
                        Penerima<br>
                    </td>
                    <td style="width: 50%" class="text-center">
                        Pengirim<br>
                    </td>
                </tr>
                <tr><td><br></td></tr>
                <tr><td><br></td></tr>
                <tr><td><br></td></tr>
                <tr>
                    <td style="width: 50%" class="text-center">
                        (.........................)<br>
                    </td>
                    <td style="width: 50%" class="text-center">
                        ( {{$user->nama}} )<br>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</body>
</html>

<script>
    $('#print').click(function(){
        var printContents = document.getElementById("printArea").outerHTML;
        var originalContents = document.body.outerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    });
</script>
