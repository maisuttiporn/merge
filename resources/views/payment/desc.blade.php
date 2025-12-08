@extends('theme.app')



@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-5">
                <h4><strong>
                        <i class="fa-solid fa-sack-dollar"></i> เคลียร์ตัง
                        - {{ $user->fname }} {{ $user->lname }}
                    </strong></h4>

                <a class="btn btn-orange btn-sm " href="{{ route('payment.index') }}"> <i
                        class="fa-solid fa-circle-left"></i> กลับ</a>
                </h4>
                <hr>
            </div>

            @if ($payerid == null)
                <div class="col-md-12 text-center">
                    <h3> <i class=" fa-2x fa-solid fa-triangle-exclamation"></i>
                    </h3>
                    <h2>ไม่มีรายการ</h2>
                </div>
            @endif

            @foreach ($checkins->unique('checkin_payerid') as $checkin)
                <div class="col-md-12 mb-3">
                    <h4>
                        <strong>คนจ่ายเงิน : </strong>
                        {{ $user->where('id', $checkin->checkin_payerid)->first()->fname }}
                        {{ $user->where('id', $checkin->checkin_payerid)->first()->lname }}
                    </h4>
                    <h5>
                        <strong>ยอดรวม : </strong>
                        @php
                            $total = 0;
                           @endphp
                        @foreach ($checkins->where('checkin_payerid', $checkin->checkin_payerid) as $item)
                            @php
                                $total += $item->checkindesc->first()->amount;
                            @endphp
                        @endforeach
                        {{ number_format($total, 0) }} ({{ number_format($total, 0,'','') }})

                        <form name="xxxx" action="{{ route('payment.update', [$user->id, $checkin->checkin_payerid]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-orange">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                จ่ายตัง</button>
                        </form>
                    </h5>


                </div>

                <div class="col-md-12 mb-3">
                    <table class="table table-strip">
                        <thead>
                            <th>ลำดับ</th>
                            <th>วันที่</th>
                            <th>กิจกรรม</th>
                            <th>items</th>
                            <th>คนจ่าย</th>
                            <th>รวมเงิน</th>
                            <th>เข้าร่วม</th>
                            <th>ต่อคน</th>
                        </thead>


                        @foreach ($checkins->where('checkin_payerid', $checkin->checkin_payerid) as $checkintable)




                            <tr>
                                <td>{{ $loop->iteration }} {{ $payerid }} : {{ $checkintable->checkin_payerid }}</td>
                                <td>{{ thaidate('d-m-Y', $checkintable->checkin_date, false) }}</td>
                                <td>{{ $checkintable->checkin_desc }}</td>
                                <td>{{ $checkintable->checkin_itemdesc }}</td>
                                <td>{{ $user->where('id', $checkintable->checkin_payerid)->first()->fname }}</td>
                                <td>{{ number_format($checkintable->checkin_total, 0) }}</td>
                                <td>
                                    {{ $checkintable->Checkindesc->where('check', '1')->count() }}
                                </td>
                                <td>
                                    {{ number_format($checkintable->Checkindesc->where('user_id', $user_id)->first()->amount, 0) }}
                                </td>
                            </tr>




                        @endforeach

                    </table>
                </div>
            @endforeach

            @if (count($checkinpaids) > 0)


                <div class="col-md-12">
                    <hr>
                    <h4><strong>ประวัติการจ่ายเงิน</strong></h4>
                    <table class="table table-strip">
                        <thead>
                            <th>ลำดับ</th>
                            <th>วันที่</th>
                            <th>กิจกรรม</th>
                            <th>items</th>
                            <th>คนจ่าย</th>
                            <th>รวมเงิน</th>
                            <th>เข้าร่วม</th>
                            <th>ต่อคน</th>
                            <th></th>
                        </thead>

                        @foreach ($checkinpaids as $checkintable)




                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ thaidate('d-m-Y', $checkintable->checkin_date, false) }}</td>
                                <td>{{ $checkintable->checkin_desc }}</td>
                                <td>{{ $checkintable->checkin_itemdesc }}</td>
                                <td>{{ $user->where('id', $checkintable->checkin_payerid)->first()->fname }}</td>
                                <td>{{ number_format($checkintable->checkin_total, 0) }}</td>
                                <td>
                                    {{ $checkintable->Checkindesc->where('check', '1')->count() }}
                                </td>
                                <td>
                                    {{ number_format($checkintable->Checkindesc->where('user_id', $user_id)->first()->amount, 0) }}
                                </td>
                                <td>{{ $checkintable->updated_at }}</td>
                            </tr>




                        @endforeach

                    </table>





                </div>

            @endif

        </div>
    </div>

@endsection