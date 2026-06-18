@extends('theme.app')

@section('js')
<script>
    $('#changeyear').on('change', function() {
        window.location = "{{ route('main.airdrop') }}/"+ $(this).val();
    });
</script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h5><strong>Airdrop {{ $yyyy }}</strong></h5>  
                <select name="" id="changeyear" class="form-control">
                    <option  value="{{ date('Y') }}">{{ date('Y') }}</option>

                    <option @if($yyyy == date('Y')-1) selected @endif 
                    value="{{ date('Y')-1 }}">
                        {{ date('Y')-1 }}
                    </option>
                </select>

                <table class="table">
                    <thead>
                        <th>เดือน</th>
                        <th>รายชื่อ Top 5 เข้าแอร์ดรอบ</th>
                    </thead>
                    @for ($i=1; $i<=12; $i++)
                        <tr>
                            <td>{{ thaidate('F', "$yyyy-$i-01") }}</td>
                            <td>
                                {{-- @php
                                $pr = [$i, $yyyy];
                                @endphp

                                @foreach (\App\Models\Checkindesc::whereHas('checkin', function ($q) use ($pr)  {
                                    $q->where('checkin_date', '>=', $pr[1] . "-$pr[0]-01");
                                    $q->where('checkin_date', '<=', $pr[1] . "-$pr[0]-31");
                                })
                                ->where('check', '1')
                                ->get() as $checkindesc )
                                    <h5>{{ $checkindesc->user->fname }}</h5>
                                @endforeach --}}


                                @php  $top5 = []; @endphp
                                @foreach (\App\Models\User::where('slotactive', '1')->get() as $user)
                                    
                                    @php
                                        $top5[] =  ['name' => $user->fname , 'airdrop' => 
                                        \App\Models\Checkin::where('checkin_date', '>=', date("$yyyy-$i-01"))
                                            ->where('checkin_date', '<=', date("$yyyy-$i-31"))
                                            ->whereHas('checkindesc', function ($q) use ($user)  {
                                            $q->where('check', '1');
                                            $q->where('user_id', $user->id);
                                        })
                                        // ->orwhere('checkin_desc', 'แอร์ดรอบ 00.00')
                                        ->where('checkin_desc', 'แอร์ดรอบ 21.00')
                                        ->count()
                                        +
                                        \App\Models\Checkin::where('checkin_date', '>=', date("$yyyy-$i-01"))
                                            ->where('checkin_date', '<=', date("$yyyy-$i-31"))
                                            ->whereHas('checkindesc', function ($q) use ($user)  {
                                            $q->where('check', '1');
                                            $q->where('user_id', $user->id);
                                        })
                                        ->where('checkin_desc', 'แอร์ดรอบ 00.00')
                                        // ->where('checkin_desc', 'แอร์ดรอบ 21.00')
                                        ->count()]; 
                                    @endphp


                                @endforeach
                                
                                @php 
                                $j=0
                                @endphp

                                @foreach (collect($top5)->sortByDesc('airdrop')->values()->all() as $item)
                                        @if ($yyyy.sprintf("%02d", $i) <= date('Ym'))
                                            <span class="@if($j<5) text-danger @endif">
                                                {{ $item['name'] }} : {{ $item['airdrop'] }}
                                            </span> &nbsp;&nbsp;
                                            @php
                                            $j++;
                                            if($j==10) {
                                                echo '<br>';
                                            }
                                            @endphp
                                        @endif

                                @endforeach
                                

                            </td>
                        </tr>
                    @endfor

                </table>


            </div>


        </div>
        <div class="row">

        </div>
    </div>
@endsection