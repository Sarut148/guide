@extends('layouts.admin_lte')
@section('style')
@endsection
@section('content')
<div class="container">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box form-horizontal" style="text-align: center;">
                            <div class="box-header">
                                <h2>ข้อมูลส่วนตัว</h2>
                            </div>
                            <form method="post" action="/update-profile" enctype="multipart/form-data" >
                                 @csrf
                                <div class="row">
                                <div class="col-sm-12 text-center">
                                    <div  class="image-preview">
                                        <img id="imagePreview" src="images/user/{{$user[0]->img}}" alt="รูปภาพ" class="image-preview__image" width="100px" height="100px">
                                            <span class="image-preview__default-text"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                        <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">รูปประจำตัว</label>
                                            <div class="col-md-8">
                                                <input onchange="preview_image(event)" type="file" id="image" value="{{$user[0]->img}}" name="image" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="col-md-2 control-label">ชื่อ-นามสกุล</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อ-นามสกุล" value="{{$user[0]->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">E-mail</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{$user[0]->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">ที่อยู่</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="address" name="address" placeholder="ที่อยู่" value="{{$user[0]->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">เบอร์โทร</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์โทร" value="{{$user[0]->tel}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn-lg btn-success btn-rounded btn-md ml-4" >บันทึก</button>
                                </div>
                            </form>
                            <!-- /.box-body -->
                        </div>
                    <!-- /.box -->
                    </div>
                </div>
                </div>
            </div>
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

