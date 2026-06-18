@extends('theme.app')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <br>
                <!-- <h5><strong>Airdrop</strong></h5> -->





            </div>


        </div>
        <div class="row">
            <div class="col-md-12 form-inline">
                <label for=""><strong>โปรดเลือก : </strong> </label>
                <select name="" id="userid" class="form-control" style="width: 300px; font-size: 20px;">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user_id == $user->id) selected @endif>
                            {{ $user->fname }} 
                        {{ thaidate('M') }}
                        
                        (all {{ \App\Models\Checkindesc::where('user_id', $user->id)->where('check', '1')->where('created_at', '>=', date('Y-m-01'))->count() }})
                        
                    
                        aridrop : 
                        {{ 
                        
                        \App\Models\Checkin::where('checkin_date', '>=', date('Y-m-01'))
                            ->whereHas('checkindesc', function ($q) use ($user)  {
                            $q->where('check', '1');
                            $q->where('user_id', $user->id);
                        })
                        // ->orwhere('checkin_desc', 'แอร์ดรอบ 00.00')
                        ->where('checkin_desc', 'แอร์ดรอบ 21.00')
                        ->count()
                        +
                        \App\Models\Checkin::where('checkin_date', '>=', date('Y-m-01'))
                            ->whereHas('checkindesc', function ($q) use ($user)  {
                            $q->where('check', '1');
                            $q->where('user_id', $user->id);
                        })
                        ->where('checkin_desc', 'แอร์ดรอบ 00.00')
                        // ->where('checkin_desc', 'แอร์ดรอบ 21.00')
                        ->count() }}

                        </option>

                    @endforeach
                </select>

                &nbsp;  &nbsp; &nbsp;<a href="{{ route('main.airdrop') }}" class="btn btn-orange">สรุป Top5</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    <script>


        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                // initialView: 'dayGridMonth',
                editable: false,
                eventStartEditable: false,
                initialView: 'multiMonthYear',
                editable: true,
                // events: 'https://fullcalendar.io/api/demo-feeds/events.json'
                events: '{{ asset("") }}api/event/{{ $user_id }}',
                eventOrder: ['-start'],
                displayEventTime: false,
                // locale: 'th',
            });

            calendar.render();
        });


        $('#userid').on('change', function () {
            // alert($(this).val());
            window.location = '{{ route("main") }}/' + $(this).val();
        });

    </script>
@endsection