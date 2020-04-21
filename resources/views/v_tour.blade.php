@extends('layouts.admin_lte')
@section('style')
@endsection
@section('content')
<div class="container" id="app">
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
                        <h3 class="box-title">ตารางทัวร์</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th style="text-align: center;width:5%">#</th>
                                <th style="text-align: center;width:25%">ชื่อทัวร์</th>
                                <th style="text-align: center;width:15%">วันที่</th>
                                <th style="text-align: center;width:10%">สถานะ</th>
                                <th style="text-align: center;width:25%">ไกด์</th>
                                <th style="text-align: center;width:20%">ดำเนินการ</th>
                            </tr>
                            @foreach($task as $index => $value)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>{{$value->name }}</td>
                                <td style="text-align: center;">{{ date("d/m/Y", strtotime($value->date)) }}</td>
                                <td style="text-align: center;">
                                @if($value->status == 1)
                                <span class="label label-success">พร้อม</span>
                                @else
                                <span class="label label-danger">ไม่พร้อม</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                    @foreach($task_detail as $index_d => $value_d)
                                        @if($value_d->task_id == $value->id)
                                            @foreach($user as $index_u => $value_u)
                                                @if($value_d->user_id == $value_u->id)
                                                    {{$value_u->name ?? '-'}},
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                            </td>
                                <td style="text-align: center;">
                                <form method="post" action="/delete-tour">
                                @csrf
                                    @if($value->status == 1)
                                        <button type="button" class="btn btn-success waves-effect waves-light" @click="set_id({{$value->id}})" data-toggle="modal" data-target="#modal-search"><i class="fa fa-fw fa-plus"></i></button>
                                    @endif
                                    <button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#modal-edit-{{$value->id}}"><i class="fa fa-fw fa-edit"></i></button>  
                                    <button type="submit" name="id" value="{{$value->id}}" class="btn btn-danger waves-effect waves-light" data-tooltip="tooltip" title="ลบ"><i class="fa fa-fw fa-trash"></i></button>  
                                </form>  
                                <!-- <a href="update-tour/{{$value->id}}"><button type="button" class="btn btn-warning waves-effect waves-light" data-tooltip="tooltip" title="แก้ใข"><i class="fa fa-fw fa-edit"></i></button></a>                        -->
                                </td>
                            </tr>
                           @endforeach
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-add" style="display: none;">
    <div class="modal-dialog">
        <form method="post" action="/add-tour" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header" style="background-color:#004890">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="color:#fff">เพิ่มรายการทัวร์</h4>
            </div>
            <div class="modal-body form-horizontal">
              <div class="box-body ">
              <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">รูปภาพ</label>
                    <div class="col-sm-9">
                    <input type="file" name="image" class="form-control">
                    </div>
                </div>
              <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">ชื่อทัวร์</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อทัวร์ ชื่อท่องเที่ยว รายการ....">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">วันที่</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                                <input type="date" class="form-control pull-right" id="date" name="date"required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label for="name" class="col-sm-3 control-label">สถานะ</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="status" name="status" v-model="status">
                            <option selected value="0">ไม่พร้อม</option>
                            <option value="1">พร้อม</option>
                        </select>
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

<!--Modal: Name-->
<div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 100px;">
  <div class="modal-dialog modal-lg" role="document">
    <!--Content-->
    <form method="post" action="/update-tour_detail" >
        @csrf
    <div class="modal-content">
      <!--Body-->
      <div class="modal-body">
          <h3 style="text-align: center;">ค้นหาไกด์</h3>
                <div class="form-group">
                <select class="form-control input" name="type_card" id="type_card" v-model="type_card" >
                @foreach($card as $index_c => $value_c)
                            <option value="{{$value_c->id}}">{{$value_c->name}}</option>
                    @endforeach
                    </select>
                </div>
            <div class="form-group" style="text-align: center;">
                <input type="hidden" id="id" name="id" v-model="search_id">
            </div>
            <div class="input-group margin">
                <input class="form-control input" type="text" placeholder="ชื่อไกด์" v-model="guide_name"> 
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary btn-flat" @click = "search_guide()"><i class="fa fa-fw fa-search"></i> ค้นหา</button>
                    </span>
            </div>
            <div class="form-group" style="text-align: center;">
                <button type="submit" class="btn btn-success btn-rounded btn-md ml-4" >บันทึก</button>
            </div>
            <div class="form-group" >
            <div class="box">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">รายชื่อไกด์</h3>
                </div>
                        <table class="table table-striped table-bordered dataTable" role="grid"  >
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th style="width:10%;text-align:center">#</th>
                                    <th style="width:50%;text-align:center">ชื่อ</th>
                                    <th style="width:20%;text-align:center">จำนวนงาน</th>
                                    <th style="width:20%;text-align:center">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody v-show="loading">
                                <tr style="text-align:center">
                                    <th style="text-align:center" colspan="8">
                                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"></div>
                                    </th>
                                </tr>
                                <tr style="text-align:center">
                                    <th style="text-align:center" colspan="8">
                                        <span>Loading...</span>
                                    </th>
                                </tr> 
                            </tbody>
                            <tbody v-for="(row,index) in guide_list" v-show="showguide">
                            <tr @click='set_card(row.id)'>
                             <td style='text-align: center;'>@{{index+1}}</td>
                             <td style='text-align: center;'>@{{row.name}}</td>
                             <td style='text-align: center;'><span class='badge bg-red'></span>@{{row.task_number}}</td>
                             <td style='text-align: center;'><input type='checkbox' name='check[]' v-bind:value='row.id'></td>
                           </tr>
                            </tbody>
                        </table>
                        <div style="text-align:center" v-show="show_card" v-html="rs_card">

                        </div>
                </div>
            </div>
      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
    <!--/.Content-->
  </div>
</div>


<!--Modal: Name-->
@foreach($task as $index => $value)
<div class="modal fade" id="modal-edit-{{$value->id}}" style="display: none;">
    <div class="modal-dialog">
        <form method="post" action="/update-tour" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$value->id}}">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#004890">
                <button type="button"  style="color:#fff" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"  style="color:#fff">แก้ไขรายการทัวร์ [{{$value->name}}]</h4>
            </div>
            <div class="modal-body form-horizontal">
              <div class="box-body ">
              <!-- <div class="form-group text-center">
                    <img src="/images/task/{{$value->image}}" width="100px" height="100px">
              </div> -->
                <div class="form-group text-center">
                    <div  class="image-preview">
                        <img id="imagePreview" src="images/task/{{$value->image}}" alt="รูปภาพ" class="image-preview__image" width="200px" height="150px" >
                            <span class="image-preview__default-text"></span>
                    </div>
                </div>
              <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">รูปภาพ</label>
                    <div class="col-sm-9">
                    <input onchange="preview_image(event)" type="file" name="image" class="form-control" value="{{$value->image}}" accept="image/*">
                    </div>
                </div>
              <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">ชื่อทัวร์</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อทัวร์ ชื่อท่องเที่ยว รายการ...." value="{{$value->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">วันที่</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                                <input type="date" class="form-control pull-right" id="date" name="date" value="{{$value->date}}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label for="name" class="col-sm-3 control-label">สถานะ</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="status" name="status" value="{{$value->status}}">
                            @if($value->status == 1)
                            <option  value="0">ไม่พร้อม</option>
                            <option selected value="1">พร้อม</option>
                            @else
                            <option selected value="0">ไม่พร้อม</option>
                            <option  value="1">พร้อม</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">ค่าตอบแทน</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" placeholder="ค่าตอบแทน" value="{{$value->price}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">รายละเอียด</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Enter ...">{{$value->description}}</textarea>
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
<script src="../js/vue.js"></script>
<script src="../js/axios.min.js"></script>
<script>
var app = new Vue({
  el: '#app',
  data: {
  },
  methods:{
    set_id:function(id){
        search.search_id = id;
    }
  },

})
var add = new Vue({
  el: '#modal-add',
  data: {
    status:0,
    guide_disable:false,
    guide_vue:0,
    cardList: JSON.parse(JSON.stringify( <?php echo json_encode($card) ?>)),
  },
  watch:{
    status:function(){
       if(this.status == 0){
       this.guide_vue = 0;
           this.guide_disable = true}
       else{
        this.guide_disable = false
       }
    }
  },

})
var search = new Vue({
  el: '#modal-search',
  data: {
    loading:false,
    showguide:true,
    guide_name:'',
    show_card:true,
    rs_card:'',
    rs:'',
    type_card:1,
    search_id:'',
    guide_list:[],
    cardList: JSON.parse(JSON.stringify( <?php echo json_encode($card) ?>)),
  },
  watch:{
    status:function(){
       if(this.status == 0){
       this.guide_vue = 0;
           this.guide_disable = true}
       else{
        this.guide_disable = false
       }
    }
  },
  methods:{
    search_guide(){
        this.loading = true;
        this.showguide = false;
        this.rs = '';
        var self = this
            axios.post("/search_guide", {
                    type_card: self.type_card,
                    name_guide: self.guide_name,
                })
                .then(function(response) {
                    self.loading = false;
                    self.showguide = true;
                    var gg = response.data.Task;
                    console.log(gg);
                    self.guide_list = gg;
                })
                .catch(function(error) {
                    
                })
    },
    set_card(id){
       console.log(id);
            var self = this
                    axios.post("/search_card", {
                            type_card: self.type_card,
                            user_id: id,
                        })
                        .then(function(response) {
                            // console.log(response.data.img[0].img);
                            self.rs_card = "<img src='../images/card/"+response.data.img[0].img+"' style='border-style: solid;border-width: thin;'  width='400px' height='200px'>";
                        })
                        .catch(function(error) {
                        })
    }
  },
})
</script>
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


