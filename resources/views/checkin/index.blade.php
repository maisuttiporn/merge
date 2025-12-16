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

                <table class="table">
                    <thead>
                        <th>date</th>
                        <th>desc</th>
                        <th>items</th>
                        <th width="30%">ผู้เข้าร่วม</th>
                        <th>จำนวนคน</th>
                        <th>เช็คชื่อ</th>
                        <th>จ่ายเงิน</th>
                        <th>จำนวนเงิน</th>
                        <th>สถานะ</th>
                        <th></th>
                    </thead>

                    @foreach ($checkins as $item)
                        @if ($item->checkindesc()->where('check', 1)->count() > 0)
                        
                        
                        <tr @if($item->checkin_win == '1') style="background-color: lightgreen;" @endif>
                            <td>
                                <strong>{{ thaidate('d-m-Y H:i', $item->checkin_date, false) }}</strong>
                            </td>
                            <td>{{ $item->checkin_desc }}
                                @if($item->checkin_win == '1')
                                ({{ $item->win() }})
                                @endif
                            </td>
                            <td>
                                {{ $item->checkin_itemdesc }}
                            </td>
                            <td style="font-size: 13px;">
                                @php $i=0; @endphp
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
                                <strong 
                                @if($item->checkin_lock == '1') 
                                    class="badge badge-danger" style="font-size: 100%"
                                @else 
                                    class="badge badge-success" style="font-size: 100%"
                                @endif
                                >
                                    {{ $item->lock() }}
                                </strong>
                            </td>
                            <td>{{ $item->paid() }}</td>
                            <td>{{ $item->checkin_total }}</td>
                            <td>
                                {{ $item->paid() }}
                            </td>
                            <td>
                                <a href="{{ route('checkin.payment', $item->id) }}" class="text-orange">
                                    <i class="fa-solid fa-file-invoice-dollar fa-2x"></i>
                                </a>
                            </td>
                        </tr>

                        @endif
                    @endforeach
                </table>

            </div>


        </div>
    </div>

@endsection