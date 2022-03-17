<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Rujukan</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            margin: 10px;
        }
        .address{
            font-family: sans-serif;
            font-size: 12px;
            font-weight: bold;
        }
        .dotted{
            border-bottom: 1px dotted black;
        }
        .p-dotted{
            padding: 54px;
            border-bottom: 1px dotted black
        }
        #detail tr td{
            line-height: 35px
        }
        #title{
            font-size: 20px;
            border-bottom: 1px solid black;
            font-weight: bold;
            display: inline;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }
    </style>
</head>
<body>
    <center>
        <h2 style="font-size: 20px; margin-top: 10px; font-family: sans-serif">dr.H.Marte Robiul Sani, Sp.A,M.Kes</h2>
        <hr style="margin-top: 5px; margin-bottom: 5px">
        <p class="address">JL. RAYA BARAT PABRIK SINGAPARNA - TASIKMALAYA</p>
        <p class="address">TELP.0821 2912 6022</p>
        <hr style="margin-top: 5px; margin-bottom: 20px;">

        <p id="title">SURAT KETERANGAN SAKIT</p>
    </center>
    <p style="margin-top: 10px; line-height: 35px;">Yang bertanda tangan dibawah ini menerangkan bahwa :</p>
    <table style="width: 100%" id="detail">
        <tr>
            <td style="width: 100px">Nama</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $patient->patient->name }}</td>
        </tr>
        <tr>
            <td style="width: 100px">Umur</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $patient->patient->age }}</td>
        </tr>
        <tr>
            <td style="width: 100px">Pekerjaan</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $pekerjaan }}</td>
        </tr>
        <tr>
            <td style="width: 100px">Alamat</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $patient->patient->address }}</td>
        </tr>
    </table>
    <p style="line-height: 35px">Perlu istirahat selama <span class="p-dotted" style="padding: 0 60px">{{ $hari }}</span> hari, dari tanggal <span class="p-dotted">{{ $from->format('d-m-Y') }}</span> s/d <span class="p-dotted">{{ $to->format('d-m-Y') }}</span> <br>
        Karena sakit <br>
        Kepada yang berkepentingan harap maklum.</p>
    <div style="width: 70%; margin-left: 30%">
        <center>
            <p class="p-dotted" style="margin-top: 30px; padding: 0 10px;">Singaparna, {{ Carbon\Carbon::now()->isoFormat('LL') }}</p>
            <p style="margin-bottom: 100px">Dokter yang memeriksa,</p>
            <h5 style="display: inline; border-bottom: 1px solid black;">dr.H.Marte Robiul Sani, Sp.A,M.Kes</h5>
        </center>
    </div>
</body>
</html>
