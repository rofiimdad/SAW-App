@extends('layouts.app')

@section('content')
    {{-- @dd($data) --}}
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Halaman Penilaian</h4> </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="row col-md-4">
                    <div class="col-md-12">
                        <div class="white-box">
                            <form class="form-horizontal form-material" action="{{url('variableProfil');}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-12">Pilih Mitra</label>
                                    <div class="col-sm-12">
                                        <select class="form-control form-control-line" name="data" >
                                            @foreach ($data->mitra as $mitra)
                                            <option value="{{$mitra->id}}" @if($data->selected == $mitra->id)
                                            selected
                                            @endif>{{$mitra->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-info">Pilih Mitra</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @foreach ($data->mitra as $mitraProfile)
                        @if ($mitraProfile->id == $data->selected)
                        <div class="white-box">
                            <h3 class="text-center">Profil Mitra</h3>
                            <hr>
                                <div class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Nama Perseorangan/Perusahaan</label>
                                        <div class="col-md-12">
                                        <input type="text" placeholder="Nama " class="form-control form-control-line" name='name' value="{{$mitraProfile->name}}" readonly></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Alamat Perseorangan/Perusahaan</label>
                                        <div class="col-md-12">
                                        <textarea type="text" rows="5" placeholder="Alamat " class="form-control form-control-line" name='address' readonly>{{$mitraProfile->address}}</textarea> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Kontak</label>
                                        <div class="col-md-12">
                                        <input type="number" placeholder="Kontak " class="form-control form-control-line" name='contact' value="{{ $mitraProfile->contact }}" readonly></div>
                                    </div>
                                </div>
                        </div>
                        @else
                         @continue
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="white-box">
                        <h3 class="box-title text-center">Data Kriteria</h3>
                        <hr>
                        @if ($data->selected != null)
                        <h3 class="box-title">List Kriteria</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr >
                                        <th>Kritetia</th>
                                        <th>Keterangan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->criteria as $criterias)
                                    <tr>
                                        <td>{{$criterias->name}}</td>
                                        @foreach ($data->storedData as $datas)
                                        @if ($datas->alternative_id != $data->selected)
                                        @continue
                                        @elseif($criterias->name == $datas->name)
                                        {{-- @dd($datas) --}}
                                        <td>{{$datas->values}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal" data-modal="{{json_encode(['image' => asset('storage/'. $datas->image ) , 'detail' => $datas->detail])}}">Details</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-whatever="{{$datas}}">Edit</button>
                                            <a href="{{url('variableDelete/'. $datas->variable_id)}}" type="button" class="btn btn-danger">delete</a>
                                        </td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h4>Pilih Mitra Terlebih dahulu</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('variableStore')}}">
                        <div class="modal-body">
                            @csrf
                            <input name="alternative" value="{{$data->selected}}" hidden/>
                            @foreach ($data->criteria as $criterias)
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">{{$criterias->name}} Bobot: {{$criterias->value}}</label>
                                <input type="text" class="form-control" id="{{$criterias->name}}-name"  name="{{$criterias->id}}">
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="Submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
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
});

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
