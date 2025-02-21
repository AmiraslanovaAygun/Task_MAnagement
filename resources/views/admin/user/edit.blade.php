@extends('layouts.admin')
@section('title', 'İstifadəçi profili')
@section('content')

    <div class="content-wrapper">
        <section class="content ">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class=" mt-5 col col-lg-9 col-xl-8">
                        <div class="card">
                            <div class="rounded-top text-white d-flex flex-row justify-content-center"
                                 style="background-color: #3f6791; height:200px;">
                                @if(isset($user->avatar))
                                    <div class="m-5" style="width: 150px;">
                                        <img
                                                src="{{ $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png') }}"
                                                alt="Generic placeholder image"
                                                class="img-fluid img-thumbnail mt-5 mb-2 "
                                                style="width: 150px; height: 150px; object-fit: cover; z-index: 10">
                                    </div>
                                @endif
                                <div style="margin-top: 70px;">
                                    <h3 class="display-4">{{$user->name}}</h3>
                                </div>
                            </div>

                            <div class="card-body p-4 text-black w-75 m-auto mt-5">
                                <form action="{{route('updateProfile',$user)}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{$user->name}}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{$user->email}}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="tel"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               name="phone"
                                               value="{{ $user->phone }}" required>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="position_id" class="form-label">Vəzifə</label>
                                        <select class="form-control @error('position_id') is-invalid @enderror"
                                                id="position_id"
                                                name="position_id" required>
                                            <option value="" disabled>---</option>
                                            @foreach($positions as $position)
                                                <option
                                                        value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>
                                                    {{ $position->position_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row form-group mb-3">
                                        <div class="col-md-6">
                                            <label for="password">Yeni Şifrə</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="avatar">Profil şəkli</label>
                                            <input type="file"
                                                   class="form-control @error('avatar') is-invalid @enderror"
                                                   id="avatar"
                                                   name="avatar">
                                            @error('avatar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                                        <a href="{{route('admin.user')}}" class="btn btn-secondary text-white">
                                            <i class="fa-solid fa-chevron-left"></i> Geri
                                        </a>
                                        <button type="submit" class="btn btn-primary text-white">
                                            Profili Yenilə
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@if(session('success')||session('error'))
    @include('components.admin.sessionAlert')
@endif