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