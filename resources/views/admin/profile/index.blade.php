@extends('layouts.admin')
@section('title', 'Profil')

@section('content')

    <div class="content-wrapper">
        <section class="content ">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class=" mt-5 col col-lg-9 col-xl-8">
                        <div class="card">
                            <div class="rounded-top text-white d-flex flex-row "
                                 style="background-color: #3f6791; height:200px;">
                                <div class="m-5" style="width: 150px;">
                                    <img
                                            src="{{ $loginUser->avatar ? Storage::url($loginUser->avatar) : asset('default-avatar.png') }}"
                                            alt="Generic placeholder image"
                                            class="img-fluid img-thumbnail mt-5 mb-2"
                                            style="width: 150px; height: 150px; object-fit: cover; z-index: 10">
                                </div>
                                <div class="ms-3" style="margin-top: 70px;">
                                    <h3 class=" display-4">{{$loginUser->name}}</h3>
                                </div>
                            </div>

                            <div class="card-body p-4 text-black w-75 m-auto mt-5">
                                <form action="{{route('updateProfile')}}#profile" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               name="name"
                                               value="{{$loginUser->name}}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-3">
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{$loginUser->email}}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="tel"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               id="phone"
                                               name="phone"
                                               value="{{ $loginUser->phone }}" required>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="position_id" class="form-label">Vəzifə</label>
                                        <select class="form-control @error('position_id') is-invalid @enderror"
                                                id="position_id"
                                                name="position_id" required>
                                            <option value="">---</option>
                                            @foreach($positions as $position)
                                                <option
                                                        value="{{ $position->id }}" {{ $loginUser->position_id == $position->id ? 'selected' : '' }}>
                                                    {{ $position->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('position_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="avatar">Profil şəkli</label>
                                        <input type="file"
                                               class="form-control @error('avatar') is-invalid @enderror"
                                               id="avatar"
                                               name="avatar">
                                        @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center">
                                        <button type="submit"
                                                class="btn btn-block w-25 mb-3 text-white"
                                                style="background-color: #3f6791;">
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


