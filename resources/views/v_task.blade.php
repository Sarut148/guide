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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->
                <div class="card-body">
                <div class="row">
                    <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        <h3 class="box-title">ตารางงาน</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div class="calendar" id="calendar">

                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="../js/vue.js"></script>
<script src="../js/axios.min.js"></script>
<script src='../fullcalendar/packages/core/main.js'></script>
<script src='../fullcalendar/packages/core/locales-all.js'></script>
<script src='../fullcalendar/packages/daygrid/main.js'></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var Task_user =[];
                    var task = JSON.parse(JSON.stringify( <?php echo json_encode($Task) ?> ));
                    for(var i = 0;i< task.length; i++){
                        Task_user.push({
                                title:task[i].name,
                                start:task[i].date,
                            });
                    }
                    $("#calendar").html('');
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
                        defaultView: 'dayGridMonth',
                        defaultDate: '2020-04-07',
                        locale: 'th',
                        header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: Task_user
                    });

    calendar.render();
});
</script>
@endsection

