<html>
    <style>
        tr td{
            border: 1px solid black;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <table border="1">
        <thead>
            <tr>
                <td style="background-color: #ffff00" colspan="5" align="center">{{ $title }}</td>
            </tr>
            <tr>
                <td style="background-color: #ffff00" align="center"><b>Tanggal</b></td>
                <td style="background-color: #ffff00" align="center"><b>NO RM</b></td>
                <td style="background-color: #ffff00" align="center"><b>Nama</b></td>
                <td style="background-color: #ffff00" align="center"><b>Tanggal Lahir</b></td>
                <td style="background-color: #ffff00" align="center"><b>Nama Ortu</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $m)
                <tr>
                    <td>{{ $m->created_at }}</td>
                    <td>{{ $m->patient->no_rm }}</td>
                    <td>{{ $m->patient->name }}</td>
                    <td>{{ $m->patient->birth }}</td>
                    <td>{{ $m->patient->parent }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</html>
