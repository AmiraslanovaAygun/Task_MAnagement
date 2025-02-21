@extends('layouts.admin')
@section('title', 'İstifadəçilər')

@section('customCss')
    <style>
        .new-user {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            border-radius: 12px;
            height: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .new-user:hover {
            background: #f8f9fa;
        }

        ::placeholder {
            color: #b0b0b0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="px-0 content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row mt-4">
                        @if(request()->query('page', 1) == 1)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="new-user p-4" data-bs-toggle="modal" data-bs-target="#newUserModal">
                                        <h5 class="text-secondary">+ Yeni Üzv</h5>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach($users as $user)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5><b>{{$user->name}}</b></h5>
                                                @foreach($positions as $position)
                                                    @if(  $user->position_id == $position->id)

                                                        <h5><b>
                                                                <i class="fa-regular fas fa-user-md fa-circle-user"></i>
                                                                {{$position->position_name}}</b></h5>
                                                    @endif
                                                @endforeach
                                                <ul class=" ml-4 mb-0 fa-ul text-muted">

                                                    <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-envelope"></i></span>
                                                        {{$user->email}}
                                                    </li>
                                                    <li class="small  my-2"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span>
                                                        {{$user->phone}}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-calendar"></i></span>
                                                        Registrasiya:
                                                        {{$user->created_at->format('d M Y')}}
                                                    </li>
                                                </ul>
                                            </div>

                                            @if(isset($user->avatar))

                                                <div class="col-4 text-right">
                                                    <img src="{{Storage::url($user->avatar)}}"
                                                         alt="manager-avatar"
                                                         class="img-circle img-fluid"
                                                         style="width: 85px; height: 85px; object-fit: cover;">
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-end gap-1 ">
                                            <div class="">
                                                <a href="{{route('admin.userProfile',$user)}}"
                                                   class="btn btn-sm bg-gradient-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="">
                                                <button class="btn btn-sm bg-gradient-danger delete-button"
                                                        data-id="{{ $user->id }}"
                                                        data-url="{{ route('deleteUser', $user) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Page Navigation">
                        @include('components.pagination', ['paginator' => $users])
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newProjectModalLabel">YENİ İSTİFADƏÇİ ƏLAVƏ ET</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="name">AD, SOYAD</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name"
                                                   name="name"
                                                   value="{{ old('name') }}"
                                                   required>
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="email">ELEKTRON POÇT</label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   id="email"
                                                   name="email"
                                                   value="{{ old('email') }}" required>
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="phone">TELEFON</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone"
                                                   name="phone"
                                                   value="{{ old('phone') }}"
                                                   required>
                                            @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="password">ŞİFRƏ</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password" required>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="position_id" class="form-label">VƏZİFƏ</label>
                                            <select class="form-control @error('position_id') is-invalid @enderror"
                                                    id="position_id"
                                                    name="position_id" required>
                                                <option value="" disabled selected>---</option>
                                                @foreach($positions as $position)
                                                    <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                        {{ $position->position_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('position_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label class="mb-2" for="avatar">PROFİL ŞƏKLİ</label>
                                            <input type="file"
                                                   class="form-control-file @error('avatar') is-invalid @enderror"
                                                   id="avatar"
                                                   name="avatar">
                                            @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="role" value="user">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">YARAT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection

@if(session('success')||session('error'))
    @include('components.admin.sessionAlert')
@endif
@include('components.admin.deleteAlert')
