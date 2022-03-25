@extends('layouts.app')

@section('content')
    <div class="card my-4">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title my-auto"> Data Pasien </h3>
            <a class="btn btn-success mb-0 pr-3" href="{{ route('patients.create') }}">
                <i class="fa fa-circle-plus" style="margin-right: 5px"></i> Tambah
            </a>
        </div>
        <hr class="my-0">
        <div class="card-body pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="table-patient">
                    <thead>
                        <tr>
                            <th class="bg-primary text-uppercase text-white text-sm font-weight-bolder opacity-7">NO RM</th>
                            <th class="bg-primary text-uppercase text-white text-sm font-weight-bolder opacity-7 ps-2">Nama</th>
                            <th class="bg-primary text-center text-uppercase text-white text-sm font-weight-bolder opacity-7">Tgl
                                Lahir</th>
                            <th class="bg-primary text-center text-uppercase text-white text-sm font-weight-bolder opacity-7">Ortu
                            </th>
                            <th class="bg-primary text-white opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->no_rm }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->date_birth }}</td>
                                <td>{{ $patient->parent }}</td>
                                <td>
                                    <a href="{{ route('patients.edit', $patient) }}"
                                        class="btn btn-sm btn-dark text-warning font-weight-bold text-xs mr-3"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-dark text-danger delete-data font-weight-bold text-xs"
                                            data-toggle="tooltip" data-original-title="Edit user">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var table = $('#table-patient').DataTable({
            'columnDefs': [{
                'targets': [4],
                'orderable' : false
            }]
        })
    </script>
@endpush
