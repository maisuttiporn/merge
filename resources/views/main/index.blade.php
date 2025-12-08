@extends('theme.app')


@section('content')

    <div class="container">
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
                        <option value="{{ $user->id }}"
                        @if ($user_id == $user->id)
                        selected
                        @endif
                        >
                            {{ $user->fname }}
                        </option>

                    @endforeach
                </select>
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
                initialView: 'dayGridMonth',
                editable: true,
                // events: 'https://fullcalendar.io/api/demo-feeds/events.json'
                events: 'http://localhost:8074/merge/api/event/{{ $user_id }}',
                eventOrder: ['-start'],
                displayEventTime: false,
                // locale: 'th',
            });

            calendar.render();
        });


        $('#userid').on('change', function() {
            // alert($(this).val());
            window.location = '{{ route("main") }}/'+$(this).val();
        });

    </script>
@endsection