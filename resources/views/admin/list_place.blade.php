@extends('layout/app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('add_data.get') }}" class="btn btn-primary">Add Data</a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Add From
                JSON
            </button>
            <a href="{{ route('delete_all') }}" class="btn btn-danger"
               onclick="return confirm('Are you sure to delete all data ?')">Delete All Data
            </a>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('print') }}" class="btn btn-outline-primary">Print to GeoJSON</a>
        </div>
        @if (session('status'))
            <div class="col-md-12 mt-3">
                <div class="alert alert-{{ session('class') }}" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">List of Places</h4>
                    <p class="card-category">Here is a list for this table</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Nama Toko
                                </th>
                                <th>
                                    Longitude
                                </th>
                                <th>
                                    Latitude
                                </th>
                                <th>
                                    Status resmi
                                </th>
                                <th>
                                    Alamat
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list as $l)
                                <tr>
                                    <td>
                                        {{ $l['id_feature'] }}
                                    </td>
                                    <td>
                                        {{ $l['property']['nama_toko'] }}
                                    </td>
                                    <td>
                                        {{ $l['geometry']['coordinates'][0] }}
                                    </td>
                                    <td>
                                        {{ $l['geometry']['coordinates'][1] }}
                                    </td>
                                    <td>
                                        {{ $l['property']['status_resmi'] }}
                                    </td>
                                    <td>
                                        {{ $l['property']['alamat'] }}
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm">
                                            <i class="material-icons text-white">search</i>
                                        </a>
                                        <a class="btn btn-warning btn-sm"
                                           href="{{ route('update_data.get', ['id' => $l['id_feature']]) }}">
                                            <i class="material-icons text-white">edit</i>
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="{{ route('delete', ['id' => $l['id_feature']]) }}">
                                            <i class="material-icons text-white">delete</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {{ $list->links() }}
        </div>
    </div>
    <form action="{{ route('add_json') }}" method="post" enctype="multipart/form-data">
        <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Choose File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group bmd-form-group">
                            <label>File</label>
                            <input type="file" name="json" id="json" class="form-control"
                                   style="position: initial; opacity: 1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        console.log(@json($list))
    </script>
@endpush
