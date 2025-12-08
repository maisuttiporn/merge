@extends('theme.app')



@section('content')
    <form name="xx" action="{{ route('checkin.paymentupdate', $checkin->id) }}" method="post">
        @csrf
        <div class="container">
            <div class="row">

                <div class="col-md-12 mt-5">
                    <h4><strong>
                            <i class="fa-regular fa-calendar-check"></i> กิจกรรม : {{ $checkin->checkin_desc }}
                            {{ $checkin->checkindesc()->where('check', 1)->count() }} คน
                            <input type="hidden" id="paidcount"
                                value="{{ $checkin->checkindesc()->where('check', 1)->count() }}">
                        </strong></h4>
                    <h4>{{ thaidate('l ที่ j F Y', $checkin->checkin_date, false) }}

                    <a class="btn btn-orange btn-sm " href="{{ route('checkin.index') }}"> <i
                                class="fa-solid fa-circle-left"></i> กลับ</a>
                    </h4>

                    
                    <hr>
                </div>



            </div>



            <div class="row">

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">คนจ่ายเงิน <small class="text-danger">***</small></label>
                        <select name="checkin_payerid" class="form-control">
                            <option value="0">ไม่ระบุ</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" 
                                @if($checkin->checkin_payerid == $user->id) selected @endif>
                                    {{ $user->fname }} {{ $user->lname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">จ่ายเงิน <small class="text-danger">***</small></label>
                        <select name="checkin_payment" class="form-control">
                            <option @if($checkin->checkin_payment == '0') selected @endif value="0">ไม่จ่าย</option>
                            <option @if($checkin->checkin_payment == '1') selected @endif value="1">จ่าย</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">ชนะกิจกรรม?</label>
                        <select name="checkin_win" class="form-control">
                            <option @if($checkin->checkin_win == '0') selected @endif value="0">ไม่ชนะ</option>
                            <option @if($checkin->checkin_win == '1') selected @endif value="1">ชนะ</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">ของที่ได้รับ</label>
                        <input name="checkin_itemdesc" type="text" class="form-control" 
                        @if(empty($checkin->checkin_itemdesc))
                            value="กล่องปฐมพยาบาล 5 กล่องตีอาวุธ xx"
                        @else
                            value="{{ $checkin->checkin_itemdesc }}"
                        @endif
                        >
                    </div>
                </div>

            </div>
                
            <div class="row">

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">เปิดเช็คชื่อ <small class="text-danger">***</small></label>
                        <select name="checkin_lock" class="form-control">
                            <option @if($checkin->checkin_lock == '0') selected @endif value="0">เปิด</option>
                            <option @if($checkin->checkin_lock == '1') selected @endif value="1">ปิด</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">จำนวนเงินทั้งหมด</label>
                        <input name="checkin_total" id="paid" type="number" class="form-control" value="{{ $checkin->checkin_total }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">จ่ายคนละ</label>
                        <input id="paid1" type="text" class="form-control"  readonly
                        @if($checkin->checkin_total > 0)
                            value="{{ number_format($checkin->checkin_total / $checkin->checkindesc()->where('check', 1)->count() ,0) }}"
                        @else
                            value=""
                        @endif
                        >
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-orange btn-block">
                        <i class="fa-solid fa-floppy-disk"></i>
                        บันทึก</button>
                </div>
            </div>



        </div>
    </form>

@endsection

@section('js')
    <script>
        $('#paid').on('input', function (e) {
            var total = $('#paid').val() / $('#paidcount').val();
            var gtotal = total.toFixed(0);
            $('#paid1').val(gtotal.toLocaleString("en-US"));
        });
    </script>
@endsection