@extends('theme.app')



@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-5">
                <h4>
                    <i class="fa-regular fa-calendar-check"></i> รายการกิจกรรม
                    <!-- <a class="btn btn-primary btn-sm" href="">+ เพิ่มสมาชิก</a> -->
                </h4>
            </div>

            <div class="col-md-12">
                <hr>
                <h5>เพิ่มกิจกรรม</h5>
            </div>

            <form action="{{ route('checkin.checksave2') }}" style="display: contents;" method="post">
                @csrf

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ชื่อกิจกรรม</label>
                        <input type="text" class="form-control" name="checkin_desc" value="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">วัน/เดือน/ปี</label>
                        <input type="text" id="pickdate" class="form-control" value="{{ date('Y-m-d') }}" name="checkin_date">
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">ชม. HH</label>
                        <select name="checkin_datehh" id="" class="form-control">
                            @for ($i = 23; $i >= 0; $i--)
                                <option value="{{ sprintf("%02d", $i) }}">{{ sprintf("%02d", $i) }}</option>
                            @endfor
                        </select> 
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">นาที. MM</label>
                        <select name="checkin_datemm" id="" class="form-control">
                            @for ($j = 59; $j >= 0; $j--)
                                <option value="{{ sprintf("%02d", $j) }}">{{ sprintf("%02d", $j) }}</option>
                            @endfor
                        </select> 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        
                       <button class="btn btn-lg btn-orange" style="    display: block; margin-top: 25px;">
                        <i class="fa-solid fa-floppy-disk"></i>
                        บันทึก</button>
                    </div>
                </div>


            </form>

            <div class="col-md-6 mt-5">
                <h5><u>กิจกรรมประจำวันที่ {{ thaidate('j F Y', $date, false) }}</u></h5>
            </div>
            <div class="col-md-6  mt-5 text-right">
                <input type="text" id="pickdate2" class="form-group " placeholder="เลือกวันที่แสดง">
            </div>

            <div class="col-md-12">



                <table class="table">
                    <thead>
                        <th>date</th>
                        <th>desc</th>
                        <th>items</th>
                        <th width="20%">ผู้เข้าร่วม</th>
                        <th>จำนวนคน</th>
                        <th>เช็คชื่อ</th>
                        <th>จ่ายเงิน</th>
                        <th>จำนวนเงิน</th>
                        <th>สถานะ</th>
                        <th width="15%"></th>
                    </thead>

                    @foreach ($checkins as $item)
                        {{-- 
                        @if ($item->checkindesc()->where('check', 1)->count() > 0)

                         --}}
                            <tr 
                            {{--  --}}
                            @if($item->checkin_payment == '1')                            
                                style="background-color: lightgreen;" 
                            @elseif($item->checkin_win == '1')
                                style="background-color: coral;" 
                            @endif
                             
                            >
                                <td>
                                    <strong>{{ thaidate('d-m-Y H:i', $item->checkin_date, false) }}</strong>
                                </td>
                                <td>
                                    
                                    @if ($item->checkin_desc == 'แอร์ดรอบ 21.00' || $item->checkin_desc == 'แอร์ดรอบ 00.00' || $item->checkin_desc == 'สกายฟอล 22.00')
                                        {{ $item->checkin_desc }}
                                    @else
                                        {{ $item->checkin_desc }} {{ \Carbon\Carbon::parse($item->checkin_date)->format('H:i')}}
                                    @endif
                                    @if($item->checkin_win == '1')
                                        ({{ $item->win() }})
                                    @endif
                                    @if (\App\Models\User::find($item->checkin_payerid))
                                    
                                    {{ \App\Models\User::find($item->checkin_payerid)->fname }}
                                    @endif
                                </td>
                                <td>
                                    {{ $item->checkin_itemdesc }}
                                </td>
                                <td style="font-size: 13px;">
                                    @php $i = 0; @endphp
                                    @foreach ($item->checkindesc->where('check', '1')->sortBy('homenumber') as $checkindesc)
                                        @if($i != $checkindesc->homenumber)
                                            <u class="mb-1">
                                                @if ($i > 0)
                                                    <br>
                                                @endif
                                                <small class="mb-0 ">
                                                    บ้าน {{ $checkindesc->homenumber }}</small>
                                            </u>
                                            @php $i = $checkindesc->homenumber;  @endphp
                                        @endif
                                        {{ $loop->iteration }}.{{ $checkindesc->fname }}
                                    @endforeach

                                </td>
                                <td>{{ $item->checkindesc()->where('check', 1)->count() }}</td>
                                <td>
                                    <strong @if($item->checkin_lock == '1') class="badge badge-danger" style="font-size: 100%" @else
                                    class="badge badge-success" style="font-size: 100%" @endif>
                                        {{ $item->lock() }}
                                    </strong>
                                </td>
                                <td>{{ $item->paid() }}</td>
                                <td>
                                    @if ($item->checkin_total > 0)
                                        {{ number_format($item->checkin_total, 0) }}
                                        / {{ number_format($item->checkin_total / $item->checkindesc()->where('check', 1)->count(), 0) }}
                                    @endif
                                </td>
                                <td>
                                    {{ $item->paid() }}
                                </td>
                                <td>
                                    <a href="{{ route('checkin.payment', [$item->id, $date]) }}" class=" btn btn-orange btn-sm ">
                                        <i class="fa-solid fa-file-invoice-dollar "></i> แก้ไข
                                    </a>

                                    <form style="display: inline-block;" method="post"
                                        action="{{ route('checkin.destroy', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('ลบ ?')"
                                        @if ($item->checkindesc->where('check', '1')->count() > 0) 
                                        disabled 
                                        @else 
                                        

                                        @endif
                                        
                                        >
                                            <i class="fa-solid fa-trash-can"></i> ลบ
                                        </button>
                                    </form>


                                </td>
                            </tr>

                       {{--  @endif  --}}
                    @endforeach
                </table>

            </div>


        </div>
    </div>

@endsection


@section('js')
    <script>


        $('#pickdate').datepicker({
            // todayBtn: true,
            daysOfWeekHighlighted: "0,6",
            weekStart: 1,
            language: "th",
            format: "yyyy-mm-dd",
            todayHighlight: true,
        }).on('changeDate', function (e) {
            // alert($(this).val());
            // window.location = '';
        });


        $('#pickdate2').datepicker({
            // todayBtn: true,
            daysOfWeekHighlighted: "0,6",
            weekStart: 1,
            language: "th",
            format: "yyyy-mm-dd",
            todayHighlight: true,
        }).on('changeDate', function(e) {
            // alert($(this).val());
            window.location = '{{ route("checkin.index") }}/' +$(this).val() ;
        });


    </script>
@endsection



