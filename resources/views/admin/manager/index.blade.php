@extends('layouts.admin')
@section('title', 'Adminlər')

@section('customCss')
    <style>
        .new-manager {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            border-radius: 12px;
            height: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .new-manager:hover {
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
                    <div class="row mt-5">
                        @if(request()->query('page', 1) == 1)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="new-manager p-4" data-bs-toggle="modal"
                                         data-bs-target="#newmanagerModal">
                                        <h5 class="text-secondary">+ Yeni Admin</h5>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @foreach($managers as $manager)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                @if(($manager->role == 'superadmin'))
                                                    <h2 class="lead" style="color: #3f6791; font-weight: bold">
                                                        SUPERADMİN</h2>
                                                @endif
                                                <h5><b>{{$manager->name}}</b></h5>
                                                @foreach($positions as $position)
                                                    @if(  $manager->position_id == $position->id)
                                                        <h5><b><i class="fa-regular fas fa-user-md fa-circle-user"></i>
                                                                {{$position->name}}</b></h5>
                                                    @endif
                                                @endforeach
                                                <ul class=" ml-4 mb-0 fa-ul text-muted">

                                                    <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-envelope"></i></span>
                                                        {{$manager->email}}
                                                    </li>
                                                    <li class="small  my-2"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span>
                                                        {{$manager->phone}}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-calendar"></i></span>
                                                        Registrasiya tarixi:
                                                        {{$manager->created_at->format('d M Y')}}
                                                    </li>
                                                </ul>
                                            </div>
                                            @if(isset($manager->avatar))
                                                @if(($manager->role == 'superadmin'))
                                                    <div class="col-4 text-right">
                                                        <img src="{{ Storage::url($manager->avatar) }}"
                                                             alt="manager-avatar"
                                                             class="img-circle img-fluid"
                                                             style="width: 85px; height: 85px; object-fit: cover;
                                                     outline: 3px solid red; outline-offset: 4px; border-radius: 50%;">
                                                    </div>
                                                @else
                                                    <div class="col-4 text-right">
                                                        <img src="{{Storage::url($manager->avatar)}}"
                                                             alt="manager-avatar"
                                                             class="img-circle img-fluid"
                                                             style="width: 85px; height: 85px; object-fit: cover;">
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    @if($manager->role != 'superadmin')
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <button class="btn btn-sm bg-danger delete-button"
                                                        data-id="{{ $manager->id }}"
                                                        data-url="{{ route('deleteUser', $manager) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Page Navigation">
                        @include('components.pagination', ['paginator' => $managers])
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="newmanagerModal" tabindex="-1" aria-labelledby="newmanagerModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newProjectModalLabel">YENİ ADMİN ƏLAVƏ ET</h5>
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
                                            <label for="role" class="form-label">ROL</label>
                                            <select class="form-select @error('role') is-invalid @enderror" id="role"
                                                    name="role">
                                                <option selected disabled>---</option>
                                                <option value="admin">ADMİN</option>
                                                <option value="superadmin">SUPERADMİN</option>
                                            </select>
                                            @error('role')
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
                                                    <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('position_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 m-auto">
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
