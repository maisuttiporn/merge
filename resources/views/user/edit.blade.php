@extends('theme.app')



@section('content')

    <div class="container">

        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('put')

            <div class="row">

                <div class="col-md-12 mt-5">
                    <h4>
                        <i class="fa-solid fa-users"></i> แก้ไขสมาชิก
                        <a class="btn btn-primary btn-sm " href="{{ route('user.index') }}"> <i
                                class="fa-solid fa-circle-left"></i> กลับ</a>
                    </h4>
                </div>



            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ชื่อ IC </label>
                        <input name="fname" type="text" class="form-control" value="{{ $user->fname }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">นามสกุล IC </label>
                        <input name="lname" type="text" class="form-control" value="{{ $user->lname }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">เบอร์โทร IC </label>
                        <input name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">บ้าน </label>
                        <select name="homenumber" id="" class="form-control">
                            <option @if($user->homenumber == '0') selected @endif value="0">ไม่มีบ้าน</option>
                            <option @if($user->homenumber == '1') selected @endif value="1">1</option>
                            <option @if($user->homenumber == '2') selected @endif value="2">2</option>
                            <option @if($user->homenumber == '3') selected @endif value="3">3</option>
                            <option @if($user->homenumber == '4') selected @endif value="4">4</option>
                            <option @if($user->homenumber == '5') selected @endif value="5">5</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ตำแหน่ง </label>
                        <select name="homesup" id="" class="form-control">
                            <option @if($user->homesup == '0') selected @endif value="0">ไม่ระบุ</option>
                            <option @if($user->homesup == '1') selected @endif value="1">หัวบ้าน</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">สลอต </label>
                        <select name="slotnumber" id="" class="form-control">
                            <option @if($user->slotnumber == '99') selected @endif value="99">ไม่ระบุ</option>
                            @for ($i = 1; $i <= 30; $i++)

                                <option @if($user->slotnumber == $i) selected @endif value="{{ $i }}">{{ $i }}</option>

                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">อยู่ในสลอต </label>
                        <select name="slotactive" id="" class="form-control">
                            <option @if($user->slotactive == '0') selected @endif value="0">ไม่อยู่</option>
                            <option @if($user->slotactive == '1') selected @endif value="1">อยู่ในสลอต</option>
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