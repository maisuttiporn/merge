@extends('theme.app')



@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-5">
                <h4>
                    <i class="fa-solid fa-list-check"></i> เช็คชื่อลงเวลากิจกรรม

                    เลือกวันที่

                    <input type="text"  id="pickdate" placeholder="เลือกวันที่" 
                    value="{{ \Carbon\Carbon::parse($date)->format('Y-m-d')}}">
                    <!-- <a class="btn btn-primary btn-sm" href="">+ เพิ่มสมาชิก</a> -->
                </h4>
                
            </div>
        </div>
        <div class="row container">

        
            @foreach ($homelist->unique('homenumber') as $item)


            <!-- <div class="col-sm-6 mb-1"> -->
                <a href="{{ route('checkin.check', [$item->homenumber, $date]) }}" class="btn  btn-orange mr-1">
                    <i class="fa-solid fa-house-user"></i> บ้าน {{ $item->homenumber }}
                    {{ $homelist->where('homesup', '1')->where('homenumber', $item->homenumber)->first()->fname }}
                </a>
            <!-- </div> -->

            
            
            @endforeach

        </div>      

          <div class="row">  

            <div class="col-md-12">
                <!-- <div class="btn-group btn-group-lg" role="group" aria-label="Large button group"> -->
                
                <!-- </div> -->

                
                <h5 class="mt-3">
                    <i class="fa-solid fa-angles-right"></i>
                    เข้าร่วมแอร์ดรอบ 21.00 
                    @if(count($checkin21) == 0)
                    0
                    @else
                    {{ $checkin21->first()->checkindesc()->where('check', '1')->count() }} 
                    @endif
                    คน 
                </h5>
                <h5>
                    <i class="fa-solid fa-angles-right"></i>
                    เข้าร่วมแอร์ดรอบ 00.00 
                    @if(count($checkin00) == 0)
                    0
                    @else
                    {{ $checkin00->first()->checkindesc()->where('check', '1')->count() }} 
                    @endif
                    คน 
                </h5>
                 
            </div>

            <div class="col-md-12 mt-3">
                <h3><strong><i class="fa-solid fa-house-user"></i>
                        บ้าน {{ $homenumber }}
                        : หัวบ้าน
                        {{ $homelist->where('homesup', '1')->where('homenumber', $homenumber)->first()->fname }}
                        {{ $homelist->where('homesup', '1')->where('homenumber', $homenumber)->first()->lname }}
                    </strong></h3>
                    <h4>{{ thaidate('l ที่ j F Y', $date, false) }}</h4>
                    @if(count($checkin21) != 0) 
                        @if($checkin21->first()->checkin_lock == '1')
                            <div class="alert alert-danger" role="alert">
                                {{ $checkin21->first()->checkin_desc }} ปิดเช็คชื่อแล้ว
                            </div>
                        @endif
                    @endif
                    @if(count($checkin00) != 0) 
                        @if($checkin00->first()->checkin_lock == '1')
                            <div class="alert alert-danger" role="alert">
                                {{ $checkin00->first()->checkin_desc }} ปิดเช็คชื่อแล้ว
                            </div>
                        @endif
                    @endif
                <hr>
            </div>

            <form method="post" action="{{ route('checkin.checksave', [$homenumber, $date]) }}" style="display: contents;">
                @csrf

                @foreach ($homelist->where('homenumber', $homenumber)->sortBy('fname') as $user)
                    <div class="col-md-4 mb-5">
                        <h5><strong>{{ $user->fname }} {{ $user->lname }}</strong></h5>


                        <div class="switchToggle">
                            Airdrop 21.00 {{ '' }}

                            <input type="checkbox" id="switch{{ $user->id }}0"
                            @if($checkindesc21->where('user_id', $user->id)->count() != 0)
                                
                                @if($checkindesc21->where('user_id', $user->id)->first()->check == '1')
                                    checked
                                @endif
                            @endif
                            @if(count($checkin21) != 0) 
                                @if ($checkin21->first()->checkin_lock == 1)
                                    disabled
                                @endif
                            @endif
                            >

                            <input type="hidden" name="userid_{{ $user->id }}_0" 
                            @if(count($checkindesc21->where('user_id', $user->id)))
                                @if($checkindesc21->where('user_id', $user->id)->first()->check == '1')
                                    value="1"
                                @else
                                    value="0"
                                @endif
                            @else 
                                value="0"
                            @endif
                            
                            >
                            <label for="switch{{ $user->id }}0">Toggle</label>

                            <!-- @if(count($checkindesc21->where('user_id', $user->id)))
                                @if($checkindesc21->where('user_id', $user->id)->first()->check == '1')
                                    value="1"
                                @else
                                    value="0"
                                @endif
                            @else 
                                value="0"
                            @endif -->
                            
                            
                                
                                
                            

                        </div>

                        <div class="switchToggle">
                            Airdrop 00.00
                             @php echo $checkindesc00->count() @endphp
                            <input type="checkbox" id="switch{{ $user->id }}1" 
                            @if($checkindesc00->count() != 0)
                               @if(count($checkindesc00->where('user_id', $user->id)) > '0')
                            
                                    @if($checkindesc00->where('user_id', $user->id)->first()->check == '1')
                                        checked
                                    @endif
                                
                                @endif
                            @endif

                            @if(count($checkin00) != 0) 
                                @if ($checkin00->first()->checkin_lock == 1)
                                    disabled
                                @endif
                            @endif
                            >

                            <input type="hidden" name="userid_{{ $user->id }}_1" 

                            @if($checkindesc00->count() != 0)
                                @if(count($checkindesc00->where('user_id', $user->id)) > '0')
                                    
                                    @if($checkindesc00->where('user_id', $user->id)->first()->check == '1')
                                        value="1"
                                    @else
                                        value="0"
                                    @endif
                                @else
                                value="0"
                                @endif
                            @else 
                                value="0"
                            @endif

                            >
                            <label for="switch{{ $user->id }}1">Toggle</label>

                            <!-- @if(count($checkindesc00->where('user_id', $user->id)))
                                @if($checkindesc00->where('user_id', $user->id)->first()->check == '1')
                                    value="1"
                                @else
                                    value="0"
                                @endif
                            @else 
                                value="0"
                            @endif -->

                            
                        </div>

                    </div>
                @endforeach

                <div class="col-md-12">
                    <button class="btn btn-lg btn-orange btn-block">
                        <i class="fa-solid fa-floppy-disk"></i>
                        บันทึก</button>
                </div>
            </form>

        </div>
    </div>

@endsection


@section('js')
    <script>
        $('input:checkbox').change(function (ev) {
            console.log($(this).is(':checked'));
            // console.log($(this).attr('id'));
            // console.log($(this).next().val());

            var checked = $(this).is(':checked');
            if (checked) {
                $(this).next().val('1');
            } else {
                $(this).next().val('0');
            }

        });

        $('#pickdate').datepicker({
            // todayBtn: true,
            daysOfWeekHighlighted: "0,6",
            weekStart: 1,
            language: "th",
            format: "yyyy-mm-dd",
            todayHighlight: true,
        }).on('changeDate', function(e) {
            // alert($(this).val());
            window.location = '{{ route("checkin.check", [$homenumber]) }}/'+$(this).val();
        });
        
        



    </script>
@endsection