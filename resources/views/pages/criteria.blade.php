@extends('layouts.app')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Halaman Kriteria</h4> </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="white-box">
                        <form class="form-horizontal form-material" action="{{route('tambahCriteria')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Nama Kriteria</label>
                                <div class="col-md-12">
                                <input type="text" placeholder="Nama Kriteria" class="form-control form-control-line" name='name' value="{{ old('name') }}"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Bobot Kriteria</label>
                                <div class="col-md-12">
                                <input type="number" step=0.01 placeholder="Bobot Kriteria" class="form-control form-control-line" name='value' value="{{ old('value') }}"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Tambah Kriteria</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="white-box">
                        <h3 class="box-title">List Kriteria</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr >
                                        <th>No</th>
                                        <th>Kritetia</th>
                                        <th>Bobot</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $datas)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$datas->name}}</td>
                                        <td>{{$datas->value}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-whatever="{{json_encode($datas)}}">Edit</button>
                                            <a href="{{route('deleteCriteria', ['id' => $datas->id])}}" type="button" class="btn btn-danger ">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
            <form method="POST" action="{{ route('editCriteria')}}">
                @csrf
                    <input id="id" name="id" hidden/>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Kriteria:</label>
                        <input type="text" class="form-control" id="name"  name="name">

                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Bobot:</label>
                        <input type="text" class="form-control" id="value"  name="value">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
                </div>
            </div>
        </div>
@endsection
        <!-- /.container-fluid -->

@section('addJs')
<script>
$('#editModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever')
  console.log(recipient.value)
  var modal = $(this)
  modal.find('.modal-title').text('Edit Profil = ' + recipient.name)
  modal.find('.modal-body #id').val(recipient.id)
  modal.find('.modal-body #name').val(recipient.name)
  modal.find('.modal-body #value').val(recipient.value)
})
</script>
@endsection
