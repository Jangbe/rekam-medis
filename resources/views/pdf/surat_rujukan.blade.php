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
        }
        .dotted{
            border-bottom: 1px dotted black;
        }
        #detail tr td{
            line-height: 25px
        }
    </style>
</head>
<body>
    <center>
        <h2 style="font-size: 20px; margin-top: 10px">dr.H.Marte Robiul Sani, Sp.A,M.Kes</h2>
        <hr style="margin-top: 5px; margin-bottom: 5px">
        <p class="address">JL. RAYA BARAT PABRIK SINGAPARNA - TASIKMALAYA</p>
        <p class="address">TELP.(0265)7099370, HP. 0815 6022 530 - 0821 2972 7253</p>
        <hr style="margin-top: 5px">
        <hr style="border-width: .4px; margin-top: 2px;">
    </center>
    <div style="width: 50%; margin-left: 50%; margin-bottom: 10px;">
        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="width: 7%">Singaparna, </td>
                <td class="dotted">{{ Carbon\Carbon::now()->locale('id')->isoFormat('LL') }}</td>
            </tr>
            <tr>
                <td colspan="2">Kepada Yth, :</td>
            </tr>
            <tr>
                <td colspan="2" class="dotted">{{ $patient->rujukan('kepada')??'SMC Tasikmalaya' }}</td>
            </tr>
        </table>
    </div>
    <center>
        <h2 style="font-size: 20px; border-bottom: 1px solid black; display: inline; margin-bottom: 10px;">SURAT RUJUKAN</h2>
    </center>
    <p style="margin-top: 10px; line-height: 25px">Assalamu'alaikum Wr. Wb. <br> Bersama ini kami kirimkan seorang penderita :</p>
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
            <td style="width: 100px">Jenis Kelamin</td>
            <td style="width: 5px">:</td>
            <td>
                @if ($patient->patient->gender=='L')
                    L/<s>P</s>
                @else
                    <s>L</s>/P
                @endif
            </td>
        </tr>
        <tr>
            <td style="width: 100px">Alamat</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $patient->patient->address }}</td>
        </tr>
        <tr>
            <td style="width: 100px">Keluhan</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $patient->anamnesa }}</td>
        </tr>
        <tr>
            <td style="width: 100px">Diagnosa</td>
            <td style="width: 5px">:</td>
            <td class="dotted">{{ $patient->diagnose }}</td>
        </tr>
    </table>
    <p style="line-height: 25px">Untuk mendapatkan pemeriksaan, pengobatan, dan perawatan lebih lanjut <br> Demikian atas kerjasama dan bantuanya <br> kami ucapkan terima kasih <br> Keterangan : {{ $patient->rujukan('keterangan')??'' }}</p>
    <div style="width: 70%; margin-left: 30%">
        <center>
            <p style="margin-bottom: 100px">Wassalam,</p>
            <h5 style="display: inline; border-bottom: 1px solid black;">dr.H.Marte Robiul Sani, Sp.A,M.Kes</h5>
        </center>
    </div>
</body>
</html>
