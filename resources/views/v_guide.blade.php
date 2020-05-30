@extends('layouts.admin_lte')
@section('style')
<link href='../fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='../fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
<style>
.calendar {
  max-width: 900px;
  margin: 40px auto;
}
</style>
@endsection
@section('content')
<div class="container" id="app">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        <h3 class="box-title">ตารางรายชื่อมัคคุเทศน์</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>ชื่อ</th>
                                <th>จำนวนงาน</th>
                                <th>ดำเนินการ</th>
                            </tr>
                            @foreach($user as $index => $val)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->task_number}}</td>
                                    <td>
                                        <!-- <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#modal-search"><i class="fa fa-fw fa-search"></i></button>   -->
                                        <button type="button" class="btn btn-info waves-effect waves-light" @click='search({{$val->id}})'><i class="fa fa-fw fa-search"></i></button>  
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

<div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <div class="calendar" id="calendar">

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="../js/vue.js"></script>
<script src="../js/axios.min.js"></script>
<script src='../fullcalendar/packages/core/main.js'></script>
<script src='../fullcalendar/packages/daygrid/main.js'></script>
<script src='../fullcalendar/packages/core/locales-all.js'></script>

<script>
</script>
<script>
var app = new Vue({
  el: '#app',
  data: {
      key_id:'',
  },
  methods:{
    search:function(id){
        this.key_id = id;
        search.key_id = id;
        search.open_modal(id);
    }
  },
})
var search = new Vue({
  el: '#modal-search',
  data: {
      key_id:'',
  },
  methods:{
    open_modal:function(id){
        var self = this
            axios.post("/search_task_user", {
                    user_id: id,
                })
                .then(function(response) {
                    self.loading = false;
                    self.showguide = true;
                    var Task = response.data.Task;
                    console.log(Task);
                    var Task_user = [];
                        for(var i = 0;i<Task.length; i++){
                            Task_user.push({
                                title:Task[i].name,
                                start:Task[i].date_start,
                                end:Task[i].date_end,
                                color  : '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6)
                                
                            });
                            }
                return Task_user;
                }).then(function(Task_user) {
                    $("#calendar").html('');
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
                            defaultView: 'dayGridMonth',
                            defaultDate: new Date(),
                            locale: 'th',
                            header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            events: Task_user,
                        });
                        calendar.render();
                        var gg = '1234';
                        return gg; 
                })
                .catch(function(error) {
                    
                })
                $("#modal-search").modal();

    }
  },
  watch:{
    key_id:function(){


    },
  },
})
</script>

@endsection


