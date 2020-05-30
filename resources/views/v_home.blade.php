@extends('layouts.app')
@section('content')
<?php
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
?>
<div class="container">
    <div class="row justify-content-between">
            @foreach($tour as $value)
                <div class="card" style="width:20rem;margin-bottom:2rem">
                    <img class="card-img-top"  src="images/task/{{$value->image}}" >
                        <div class="card-body row-content" style="background-color:#E7E5E5">
                            <h5 class="card-title" style="text-align:center;font-size:24px;color:#F53F3F; font-weight: bold;">{{$value->name}}</h5>
                            <p class="card-text" style="text-align:center;font-size:16px;font-weight: bold;">{{$value->description}}</p>
                            <span class="card-text badge badge-pill badge-secondary" style="text-align:center;font-size:14px;width:100%;font-weight: normal;">วันที่ : {{DateThai($value->date_start)}} - {{DateThai($value->date_end)}}</span>
                        </div>
                </div>
            @endforeach
    </div>
</div>
@endsection

