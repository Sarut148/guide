@extends('layouts.admin_lte')
@section('style')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-add">เพิ่ม</button>
                            </div>
                    </div>
                <div class="row">
                    <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        <h3 class="box-title">ตารางประเภทบัตร</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>ชื่อ</th>
                                <th>อัตราค่าจ้าง</th>
                                <th>ดำเนินการ</th>
                            </tr>
                            @foreach($card as $index => $val)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->price}}</td>
                                    <td>
                                    <form id="form_delete" method="post" action="/delete-typecard">
                                        @csrf
                                            <input type="hidden" name="id"  value="{{$val->id}}">
                                            <button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#modal-edit-{{$val->id}}"><i class="fa fa-fw fa-edit"></i></button>
                                            <button type="button" onclick="sure()" class="btn btn-danger waves-effect waves-light" data-tooltip="tooltip" title="ลบ"><i class="fa fa-fw fa-trash"></i></button>  
                                    </form>  
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-add" style="display: none;">
    <div class="modal-dialog">
        <form method="post" action="/add-card">
        @csrf
        <div class="modal-content">
            <div class="modal-header" style="background-color:#004890">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:#fff">เพิ่มประเภทบัตร</h4>
            </div>
            <div class="modal-body form-horizontal">
              <div class="box-body ">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">ชื่อบัตร</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อบัตร">
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">ค่าตอบแทน</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" placeholder="ค่าตอบแทน" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail" class="col-sm-3 control-label">รายละเอียด</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </div>
        </form>
    </div>
</div>

@foreach($card as $index => $val)
<div class="modal fade" id="modal-edit-{{$val->id}}" style="display: none;">
    <div class="modal-dialog">
        <form method="post" action="/update-card">
        @csrf
        <input type="hidden" value="{{$val->id}}" name="id">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#004890">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:#fff">แก้ไข</h4>
            </div>
            <div class="modal-body form-horizontal">
              <div class="box-body ">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">ชื่อบัตร</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อทัวร์ ชื่อท่องเที่ยว รายการ...." value="{{$val->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">ค่าตอบแทน</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" placeholder="ค่าตอบแทน" required value="{{$val->price}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail" class="col-sm-3 control-label">รายละเอียด</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Enter ...">{{$val->detail}}</textarea>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endforeach
@endsection
@section('script')
<script>
function sure() {
  var r = confirm("การลบข้อมูลประเภทบัตร อาจทำให้ข้อมูลมัคคุเทศคลาดเคลื่อนได้ คุณต้องการลบหรือไม่ ?");
  if (r == true) {
    $('#form_delete').submit();
  }
}
</script>
@endsection

