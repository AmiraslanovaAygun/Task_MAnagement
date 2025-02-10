@extends('layouts.admin')
@section('title', 'Vəzifələr')

@section('customCss')
    <style>
        .new-position {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            border-radius: 12px;
            height: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .new-position:hover {
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

                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="new-position p-4" data-bs-toggle="modal"
                                     data-bs-target="#newPositionModal">
                                    <h5 class="text-secondary">+ Yeni Vəzifə</h5>
                                </div>
                            </div>
                        </div>


                        @foreach($positions as $position)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="text-center">
                                                <h2><b>{{$position->name}}</b></h2>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button class="btn btn-sm bg-danger delete-button"
                                                    data-id="{{ $position->id }}"
                                                    data-url="{{ route('deletePosition', $position) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                {{--                <div class="card-footer">--}}
                {{--                    <nav aria-label="Page Navigation">--}}
                {{--                        @include('components.pagination', ['paginator' => $positions])--}}
                {{--                    </nav>--}}
                {{--                </div>--}}
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="newPositionModal" tabindex="-1" aria-labelledby="newPositionModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newProjectModalLabel">YENİ VƏZİFƏ ƏLAVƏ ET</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{route('createPosition')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-10 m-auto">
                                        <div class="form-group my-3">
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
