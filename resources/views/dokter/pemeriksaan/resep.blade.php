<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script type='text/javascript'>
        window.addEventListener('load', function() {
            // get the canvas element and its context
            var canvas = document.getElementById('sketchpad');
            if(canvas){
                canvas.width = $('.container').width()
                canvas.height = $('.container').height() - 200;
                var context = canvas.getContext('2d');
                var isIdle = true;
            }

            function drawstart(event) {
                context.beginPath();
                context.moveTo(event.pageX - canvas.offsetLeft, event.pageY - canvas.offsetTop);
                isIdle = false;
            }

            function drawmove(event) {
                if (isIdle) return;
                context.lineTo(event.pageX - canvas.offsetLeft, event.pageY - canvas.offsetTop);
                context.stroke();
            }

            function drawend(event) {
                if (isIdle) return;
                drawmove(event);
                isIdle = true;
            }

            function touchstart(event) {
                drawstart(event.touches[0])
            }

            function touchmove(event) {
                drawmove(event.touches[0]);
                event.preventDefault();
            }

            function touchend(event) {
                drawend(event.changedTouches[0])
            }

            if(canvas){
                canvas.addEventListener('touchstart', touchstart, false);
                canvas.addEventListener('touchmove', touchmove, false);
                canvas.addEventListener('touchend', touchend, false);
    
                canvas.addEventListener('mousedown', drawstart, false);
                canvas.addEventListener('mousemove', drawmove, false);
                canvas.addEventListener('mouseup', drawend, false);
            }

            $('#simpan').on('click', function() {
                if(canvas){
                    let data = canvas.toDataURL()
                    $('#receipt').val(data)
                }else{
                    $('#receipt').val($('textarea[name=receipt]').val())
                }
                $('form').submit();
            })
        }, false); // end window.onLoad
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: #525151;
            /* overflow: hidden; */
            overflow-x: hidden;
        }

        .container {
            width: 40%;
            background: white;
            min-height: 100vh;
        }

        .klinik {
            padding-top: 7px;
            font-size: 20px;
        }

        .text-center {
            font-size: 14px;
            text-align: center;
        }

        .dotted {
            border-bottom: 1px dotted black;
        }

        .btn {
            display: inline-block;
            font-weight: 700;
            line-height: 1.667;
            color: #7b809a;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.625rem 1.5rem;
            font-size: 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.15s ease-in;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .btn-primary {
            color: #fff;
            background-color: #e91e63;
            border-color: #e91e63;
        }

        .btn-primary:hover {
            color: #000;
            background-color: #ec407a;
            border-color: #eb3573;
        }

        .btn-primary:focus {
            color: #000;
            background-color: #ec407a;
            border-color: #eb3573;
            box-shadow: 0 0 0 0.2rem rgba(198, 26, 84, 0.5);
        }

        @media only screen and (max-width: 1000px) {
            .container {
                width: 100%;
            }
        }

    </style>
    <title>Pemberian Resep Obat</title>
</head>

<body encoding='utf8'>
    <form action="{{ route('pemeriksaan.update', $pemeriksaan) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="receipt" id="receipt">
    </form>
    <center>
        <div class="container">
            <h1 class="klinik">dr. H. Marte Robiul Sani, Sp.A,M.Kes</h1>
            <hr style="margin-bottom: 10px">
            <p class="text-center">JL. RAYA BARAT PABRIK SINGAPARNA - TASIKMALAYA</p>
            <p class="text-center">TELP. 0851 0009 9370 HP. 0815 6022 530 - 0821 2972 7253</p>
            <hr style="border-width: 2px; margin-bottom: 2px; margin-top: 10px">
            <hr style="border-width: 1px; margin-bottom: 2px">
            @if ($type=='canvas')
                <canvas id='sketchpad' width='500' height='500'></canvas>
            @else
                <textarea name="receipt" id="" style="width: 90% !important" rows="10"></textarea>            
            @endif
            <table style="width: 90%">
                <tr>
                    <td style="width: 80px">Pro.</td>
                    <td style="width: 1px">:</td>
                    <td class="dotted">{{ $pemeriksaan->patient->name }}</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td class="dotted">{{ $pemeriksaan->patient->age }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top">Alamat</td>
                    <td style="vertical-align: top">:</td>
                    <td class="dotted">{{ $pemeriksaan->patient->address }}</td>
                </tr>
            </table>
            <button class="btn btn-primary" id="simpan">Simpan</button>
        </div>
    </center>
</body>

</html>
