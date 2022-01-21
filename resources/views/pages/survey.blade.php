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
                <div class="col-md-4">
                    <div class="white-box">
                        <form class="form-horizontal form-material" action="{{route('updateSurvey')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Nama Mitra</label>
                                <div class="col-md-12">
                                        <select class="form-control form-control-line" name="alternative_id" >
                                            @foreach ($data->mitra as $mitra)
                                            <option value="{{$mitra->id}}">{{$mitra->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Nama Kriteria</label>
                                <div class="col-md-12">
                                    <select class="form-control form-control-line" name="criteria_id" >
                                        @foreach ($data->criteria as $criterias)
                                        <option value="{{$criterias->id}}">{{$criterias->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Upload Gambar</label>
                                <div class="col-md-12">
                                <input type="file" step=0.01 class="form-control form-control-line" name='image' value="{{ old('image') }}"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Keterangan</label>
                                <div class="col-md-12">
                                    <textarea type="text" step=0.01 placeholder="Keterangan gambar" class="form-control form-control-line" name='detail' value="{{ old('details') }}"></textarea></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Nilai Survei</label>
                                <div class="col-md-12">
                                <input type="number" step=0.01 class="form-control form-control-line" placeholder="Masukan Nilai"  name='value' value="{{ old('image') }}"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="white-box">
                        <h3 class="box-title">Histori Survey</h3>
                        <div class="table-responsive">
                            <table id="table-data" class="table">
                                <thead>
                                    <tr >
                                        <th>Mitra</th>
                                        <th>Kriteria</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->survey as  $surveys)
                                    <tr>
                                        <td>{{$surveys->altName}}</td>
                                        <td>{{$surveys->critName}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal" data-modal='{{json_encode(['image' => asset('storage/'. $surveys->path ) , 'detail' => $surveys->detail])}}'>Detail</button>
                                            <a href="#" type="button" class="btn btn-danger">delete</a>
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

        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="" class="rounded img-thumbnail" alt="preview">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
@endsection
        <!-- /.container-fluid -->

@section('addJs')

<script>
$('#detailModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var data = button.data('modal')
  console.log(data.detail)
  var modal = $(this)
  modal.find('.modal-title').text('Image Preview');
  modal.find('.modal-body img').attr('src', data.image);
  modal.find('.modal-footer p').text(data.detail);
})

</script>
@endsection
