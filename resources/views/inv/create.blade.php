@extends('theme.app')



@section('content')

    <div class="container">

        <form method="post" action="{{ route('inv.store') }}" enctype="multipart/form-data">
        @csrf

            <div class="row">

                <div class="col-md-12 mt-5">
                    <h4>
                        <i class="fa-solid fa-vault"></i>
                        ตู้แก๊ง สร้างไอเทม
                        <a class="btn btn-primary btn-sm " href="{{ route('inv.index') }}"> <i
                                class="fa-solid fa-circle-left"></i> กลับ</a>
                    </h4>
                </div>

            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">ชื่อไอเทม</label>
                        <input type="text" class="form-control" name="desc">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">รูปไอเทม</label>
                        <input type="file" class="form-control" accept=".jpg, .png .bmp" name="imgpath">
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

        </form>
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

    </div>

@endsection