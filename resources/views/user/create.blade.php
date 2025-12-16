@extends('theme.app')



@section('content')

    <div class="container">

        <form action="{{ route('user.store') }}" method="post">
            @csrf

            <div class="row">

                <div class="col-md-12 mt-5">
                    <h4>
                        <i class="fa-solid fa-users"></i> เพิ่มสมาชิก
                        <a class="btn btn-primary btn-sm " href="{{ route('user.index') }}"> <i
                                class="fa-solid fa-circle-left"></i> กลับ</a>
                    </h4>
                </div>



            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ชื่อ IC <small class="text-danger">***</small></label>
                        <input name="fname" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">นามสกุล IC <small class="text-danger">***</small></label>
                        <input name="lname" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">เบอร์โทร IC <small class="text-danger">***</small></label>
                        <input name="phone" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">บ้าน </label>
                        <select name="homenumber" id="" class="form-control">
                            <option value="0">ไม่มีบ้าน</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ตำแหน่ง </label>
                        <select name="homesup" id="" class="form-control">
                            <option value="0">ไม่ระบุ</option>
                            <option value="1">หัวบ้าน</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">สลอต </label>
                        <select name="slotnumber" id="" class="form-control">
                            <option value="99">ไม่ระบุ</option>
                            @for ($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>

                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">อยู่ในสลอต </label>
                        <select name="slotactive" id="" class="form-control">
                            <option value="0">ไม่อยู่</option>
                            <option value="1">อยู่ในสลอต</option>
                        </select>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        บันทึก</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-3">
                    @if ($errors->any())
                        <div class="alert alert-danger pt-3 ">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

        </form>
    </div>


@endsection