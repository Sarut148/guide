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
                        <h3 class="box-title">ตารางบัตรของฉัน</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr style="text-align: center;">
                                <th style="text-align: center;width:5%">#</th>
                                <th style="text-align: center;width:10%">เลขที่บัตร</th>
                                <th style="text-align: center;width:40%">รูป</th>
                                <th style="text-align: center;width:10%">ประเภทบัตร</th>
                                <th style="text-align: center;width:15%">วันหมดอายุ</th>
                                <th style="text-align: center;width:20%">ดำเนินการ</th>
                            </tr>
                            @foreach($img as $index => $val)
                                <tr style="text-align: center;">
                                    <td>{{$index+1}}</td>
                                    <td>{{$val->card_no}}</td>
                                    <td><img src="../images/card/{{$val->img}}" width="250px" height="100px"></td>
                                    <td>{{$val->card_name}}</td>
                                    <td>{{$val->date}}</td>
                                    <td>
                                    <form method="post" action="/delete-card">
                                        @csrf
                                            <button type="submit" name="id" value="{{$val->id}}" class="btn btn-danger waves-effect waves-light" data-tooltip="tooltip" title="ลบ"><i class="fa fa-fw fa-trash"></i></button>  
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
        <form method="post" action="/add-card_detail" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header" style="background-color:#004890">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:#fff">เพิ่มบัตร</h4>
            </div>
            <div class="modal-body form-horizontal">
              <div class="box-body ">
                    <div class="col-sm-12 text-center">
                        <div class="form-group">
                            <div  class="image-preview">
                                <img id="imagePreview"  alt="รูปภาพ" class="image-preview__image" width="300px" height="150px">
                                    <span class="image-preview__default-text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <div class="form-group">
                            <label for="name" class="col-md-2 control-label">รูปบัตร</label>
                                <div class="col-md-8">
                                    <input onchange="preview_image(event)" type="file" id="image"  name="image" accept="image/*">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">เลขที่บัตร</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="card_no" name="card_no" placeholder="เลขที่บัตร" maxlength="10" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="col-md-2 control-label">วันที่บัตรหมดอายุ</label>
                            <div class="col-md-10">
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">ประเภท</label>
                            <div class="col-md-10">
                                <select class="form-control input" name="type_card" id="type_card">
                                    @foreach($card as $index_c => $value_c)
                                        <?php $check = false; ?>
                                        @foreach($img as $index => $value)
                                            @if($value_c->name == $value->card_name)
                                                <?php $check = true; ?>
                                            @endif
                                        @endforeach
                                        @if($check == false)
                                            <option value="{{$value_c->id}}">{{$value_c->name}}</option>
                                        @endif
                                    @endforeach
                                      
                                </select>
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
@endsection
@section('script')
<script>
  function preview_image(event)
	{
		var reader = new FileReader();
		var imageField = document.getElementById('imagePreview');
		reader.onload = function(){
			if(reader.readyState == 2){
				imageField.src = reader.result;
			}
		}
		console.log(event.target.files[0]);
		reader.readAsDataURL(event.target.files[0]);
		
	}
</script>
@endsection

