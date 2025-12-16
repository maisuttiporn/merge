@extends('theme.app')



@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h4><strong>
                        <i class="fa-solid fa-sack-dollar"></i> เคลียร์ตัง
                    </strong></h4>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 text-center">
                @foreach ($checkins->unique('checkin_payerid') as $checkin)
                    <h4>
                        <i class="fa-solid fa-money-bill-wave"></i> 
                        {{ $users->where('id', $checkin->checkin_payerid)->first()->fname }} 
                        {{ $users->where('id', $checkin->checkin_payerid)->first()->lname }}  
                        ถือเงินค้างจ่าย : 
                    
                    @php
                        $total = 0;
                    @endphp

                    @foreach ($checkins->where('checkin_payerid', $checkin->checkin_payerid) as $item1)

                        @foreach ($checkindescs as $itemdesc)
                            @if ($item1->id == $itemdesc->checkin_id)
                                @php
                                    $total += $itemdesc->amount;
                                @endphp
                            @endif


                        @endforeach

                    @endforeach

                    {{ number_format($total, 0) }} <i class="fa-solid fa-money-bill-wave"></i>
                    </h4>
                @endforeach
            </div>

            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <th>ลำดับ</th>
                        <th>ชื่อสกุล</th>
                        <th>ค้างจ่าย</th>
                        <th>จำนวนเงิน</th>
                        <th></th>
                    </thead>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->fname }} {{ $user->lname }}</td>
                            <td>
                                @if ($checkindescs->where('user_id', $user->id)->count() > 0)
                                    {{ $checkindescs->where('user_id', $user->id)->count() }}
                                    กิจกรรม
                                @endif
                            </td>
                            <td>
                                @if ($checkindescs->where('user_id', $user->id)->count() > 0)
                                    {{ number_format($checkindescs->where('user_id', $user->id)->sum('amount')) }}
                                @endif
                            </td>
                            <td>
                                @if ($checkindescs->where('user_id', $user->id)->count() > -1)
                                        <a href="{{ route('payment.desc', $user->id) }}">
                                            <span class="text-orange">
                                                <i class="fa-solid fa-file-lines fa-2x"></i>

                                            </span>
                                        </a>
                                    </td>
                                @endif

                        </tr>
                    @endforeach
                </table>
            </div>


        </div>


    </div>
@endsection