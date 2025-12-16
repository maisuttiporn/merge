@extends('theme.app')



@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12 mt-5">
                <h4>
                    <i class="fa-solid fa-users"></i> สมาชิก
                    <a class="btn btn-primary btn-sm" href="{{ route('user.create') }}">+ เพิ่มสมาชิก</a>
                </h4>
            </div>

            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <th>สล๊อต</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>เบอร์โทร</th>
                        <th>ตำแน่ง</th>
                        <th>บ้าน</th>
                        <th>สถานะ</th>
                        <th></th>

                    </thead>

                    @for ($i=1; $i<=30; $i++)
                        <tr  @if (count($users->where('slotnumber', $i)) == 0 ) style="background-color: #fdd49a;" @endif>
                            <td>{{ $i }}</td>
                            <td>
                                @if (count($users->where('slotnumber', $i)) > 0 )
                                 {{ $users->where('slotnumber', $i)->first()->fname }}
                                @endif
                            </td>
                            <td>
                                @if (count($users->where('slotnumber', $i)) > 0 )
                                 {{ $users->where('slotnumber', $i)->first()->lname }}
                                @endif
                            </td>
                            <td>
                                @if (count($users->where('slotnumber', $i)) > 0 )
                                 {{ $users->where('slotnumber', $i)->first()->phone }}
                                @endif
                            </td>
                            <td>
                                @if (count($users->where('slotnumber', $i)) > 0 )
                                 {{ $users->where('slotnumber', $i)->first()->homesup() }}
                                @endif
                            </td>
                            <td>@if (count($users->where('slotnumber', $i)) > 0 )
                                 {{ $users->where('slotnumber', $i)->first()->homenumber }}
                                @endif</td>
                            <td>@if (count($users->where('slotnumber', $i)) > 0 )
                                 {{ $users->where('slotnumber', $i)->first()->slotactive() }}
                                @endif</td>
                            <td>
                                @if (count($users->where('slotnumber', $i)) > 0 )
                                    <a href="{{ route('user.edit', $users->where('slotnumber', $i)->first()->id) }}" class="btn btn-orange btn-sm">
                                    แก้ไข</a>


                                    <form style="display: inline-block;" method="post"
                                        action="{{ route('user.destroy', $users->where('slotnumber', $i)->first()->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('ลบ ?')"
                                        @if (\App\Models\Checkindesc::where('user_id', $users->where('slotnumber', $i)->first()->id)->get()->count() > 0) disabled @endif
                                        >
                                            ลบ
                                        </button>
                                    </form>

                                @endif


                            
                            </td>
                        </tr>
                    @endfor



                    @foreach ($users->where('slotnumber', '99') as $user)
                        <tr>
                            <td>
                                @if ($user->slotnumber != '99')
                                {{ $user->slotnumber }}
                                
                                @endif

                            </td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->homesup() }}</td>
                            <td>{{ $user->homenumber }}</td>
                            <td>{{ $user->slotactive() }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-orange btn-sm">
                                    แก้ไข</a>


                                <form style="display: inline-block;" method="post"
                                    action="{{ route('user.destroy', $user->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm " onclick="return confirm('ลบ ?')"
                                    @if (\App\Models\Checkindesc::where('user_id', $user->id)->get()->count() > 0) disabled @endif
                                    >
                                        ลบ
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>


@endsection