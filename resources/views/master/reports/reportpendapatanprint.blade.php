<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <title>Report</title>
</head>
<body>
    <div class="d-flex flex-row-reverse" id="buttonContainer">
        <button id="print" class="ml-2 btn btn-info">&nbsp Print &nbsp</button>
        <button onclick="window.location.href='{{url('/admin/reports/reportpendapatan')}}';" class="btn btn-danger">&nbsp Back &nbsp</button>
    </div>  
    <div id="printArea">
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="4" style="border-bottom: 5px solid black;">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="/images/TAE Logo.png" style="width:100%; max-width:300px;">
                                </td>
                                <td>
                                    <h1> Laporan Pendapatan</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    <br>
                                    Kota : {{$kantor->kota}} <br>
                                    ID Kantor : {{$kantor->id}} <br>
                                    Alamat Kantor : {{$kantor->alamat}}<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                {{-- {{-- <tr class="heading">
                    <td>
                        Muatan
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                
                <tr class="details">
                    <td>
                        Isi
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        e colly
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="details">
                    <td>
                        Berat
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        e Kg
                    </td>
                </tr>

                <tr><td><br></td></tr> --}}
                <tr>
                    <td colspan="4">
                        <h4>Laporan Pendapatan Tahun {{$tahun}}
                        </h4>
                    </td>
                </tr>
                <tr class="heading">
                    <td class="text-center" style="border: 1px solid black;width: 5%">
                        No. 
                    </td>
                    <td class="text-center" class="text-left" style="border: 1px solid black;width: 20%">
                        Bulan 
                    </td>
                    <td class="text-center" style="border: 1px solid black;width: 25%">
                        Jumlah Resi
                    </td>
                    <td class="text-center" style="border: 1px solid black;width: 50%">
                        Pendapatan (Rp)
                    </td>
                </tr>
                @foreach ($data as $d) 
                    <tr class="details">
                        <td class="text-center" style="border: 1px solid black;"> {{$loop->index + 1}} </td>
                        <td class="text-center" style="border: 1px solid black;"> {{$labels[$loop->index]}}  </td>
                        <td  class="text-center" style="border: 1px solid black;"> {{$d['count']}} </td>
                        <td class="text-center" style="border: 1px solid black;"> {{number_format($d['sum'],0, ".", ",")}} </td>
                    </tr>
                @endforeach
                <tr class="heading">
                    <td class="text-center" colspan="3" style="border: 1px solid black;width: 5%">
                        Grandtotal
                    </td>
                    <td class="text-center" style="border: 1px solid black;width: 20%">
                        {{number_format($totalSum,0, ".", ",")}}
                    </td>
                </tr>
                {{--
                @foreach($bonmuat->resis as $i)
                    <tr class="details">
                        <td style="width: 5%">
                            e.
                        </td>
                        <td class="text-left" style="width: 70%">
                            e
                        </td>
                        <td style="width: 25%">
                            e Kg
                        </td>
                    </tr>
                @endforeach
                --}}
            </table>
            <br><br>
            {{-- <table>
                <tr>
                    <td style="width: 50%" class="text-center">
                        e, e<br>
                            Pengirim
                    </td>
                    <td style="width: 50%" class="text-center">
                        e, ..........................<br>
                        Penerima
                    </td>
                </tr>
                <tr><td><br></td></tr>
                <tr><td><br></td></tr>
                <tr><td><br></td></tr>
                <tr>
                    <td style="width: 50%" class="text-center">
                        ( e )<br>
                    </td>
                    <td style="width: 50%" class="text-center">
                        (...........................)<br>
                    </td>
                </tr>
            </table> --}}
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