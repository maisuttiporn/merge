@extends('theme.app')



@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-5">
                <h4>
                    <i class="fa-solid fa-vault"></i>
                    ตู้แก๊ง
                    <a class="btn btn-orange btn-sm" href="{{ route('inv.create') }}">+ เพิ่มไอเท็ม</a>
                </h4>
            </div>

        </div>

        <form action="{{ route('invdesc.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">ไอเทม</label>
                        <select name="inv_id" id="" class="form-control">
                            <option value="0">ไม่ระบุ</option>
                            @foreach ($invs as $row)
                                <option value="{{ $row->id }}">{{ $row->desc }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">ผู้ครอบครอง</label>
                        <select name="user_id" id="" class="form-control">
                            <option value="0">ไม่ระบุ</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">รับเข้า - เบิกออก</label>
                        <select name="type" id="" class="form-control">
                            <option value="0">รับเข้า</option>
                            <option value="1">เบิกออก</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">จำนวน</label>
                        <input type="number" class="form-control" value="1" name="amount">

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">note</label>
                        <input type="text" class="form-control" value="" name="note">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="" style="    margin-bottom: 8px;"> &nbsp;</label>
                        <button class="btn  btn-orange btn-block">
                            <!-- <i class="fa-solid fa-floppy-disk"></i> -->
                            บันทึก</button>
                    </div>
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

        <div class="row">
            <div class="col-md-12">
                <br>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>ชื่อ</th>
                        <th>จำนวน</th>
                        <th></th>
                        <th></th>
                    </thead>


                    @foreach ($invs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->desc }}</td>
                            <td>
                                <!-- {{ $item->amount }} -->
                                {{ number_format($item->invowner->where('inv_id', $item->id)->sum('amount'), 0) }}

                            </td>
                            <td>
                                @if (!is_null($item->imgpath))
                                    <img width="52" src="{{ asset('img/items') }}/{{ $item->imgpath }}" alt="">
                                @else
                                    <img width="52" src="{{ asset('img') }}/noimg.svg" alt="">
                                @endif
                            </td>
                            <td>

                                <a href="{{ route('inv.edit', $item->id) }}" class="btn btn-orange btn-sm">
                                    แก้ไข</a>

                                <a href="{{ route('inv.index', $item->id) }}" class="btn btn-orange btn-sm">
                                    เลือก</a>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-md-6">
                @if ($inv)
                @if (count($inv->invdesc) > 0)
                <h5>
                    @if (!is_null($inv->imgpath))
                        <img width="52" src="{{ asset('img/items') }}/{{ $inv->imgpath }}" alt="">
                    @else
                        <img width="52" src="{{ asset('img') }}/noimg.svg" alt="">
                    @endif
                    {{ $inv->desc }}
                </h5>

                    <h5>รายการถือครอง</h5>
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>จำนวน</th>
                            <th></th>
                        </thead>
                        @foreach ($inv->invowner->where('amount', '>' , '0') as $invowner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invowner->user->fname }}</td>
                                <td>{{ $invowner->amount }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </table>
                
                    <h5>รายการ รับเข้า - เบิกออก</h5>
                    <table class="table table-striped" style="font-size: 12px;">
                        <thead>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>จำนวน</th>
                            <th></th>
                            <th></th>
                        </thead>
                        @foreach ($inv->invdesc->sortByDesc('id') as $invdesc)
                            <tr
                            style="background-color:  @if($invdesc->type == 0) lightgreen @else orange @endif;"
                            >
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invdesc->user->fname }}</td>
                                <td>
                                    @if ($invdesc->type == '0')
                                        +
                                    @else
                                        -
                                    @endif
                                    {{ $invdesc->amount }}
                                </td>
                                <td>{{ $invdesc->note }}</td>
                                <td>
                                    {{ $invdesc->created_at }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
                @endif

            </div>


        </div>

    </div>

@endsection