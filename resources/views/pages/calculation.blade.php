@extends('layouts.app')

@section('content')
    {{-- @dd($data[0]) --}}
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Halaman Penilaian</h4> </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3>List Data Kriteria</h3>
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                @foreach ($data['max'] as $criteria => $values)
                                <th>{{$criteria}}</th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['raw'] as $criteria => $values)
                                <tr>
                                    <th>
                                        {{$criteria}}
                                    </th>
                                    @foreach ( $values as $key => $datas)
                                    <td>
                                        {{$datas}}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3>Data Kriteria Tertinggi</h3>
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                @foreach ($data['max'] as $criteria => $values)
                                <th>{{$criteria}}</th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Maximum</th>
                                    @foreach ($data['max'] as $criteria => $values)
                                    <td>
                                        {{$values}}
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3>Normalisasi Data Kriteria</h3>
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                @foreach ($data['max'] as $criteria => $values)
                                <th>{{$criteria}}</th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['normalisasi'] as $criteria => $values)
                                <tr>
                                    <th>
                                        {{$criteria}}
                                    </th>
                                    @foreach ( $values as $key => $datas)
                                    <td>
                                        {{$datas}}
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3>Perangkingan Mitra</h3>
                            <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Poin</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data['rangking'] as $rangking => $values)
                                <tr>
                                    <th>
                                        {{$loop->iteration}}
                                    </th>
                                    <th>
                                        {{$rangking}}
                                    </th>
                                    <th>
                                        {{$values}}
                                    </th>
                                </tr>
                                    @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('addJs')
<script>
$('#editModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever')
  console.log(recipient)
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>
@endsection
