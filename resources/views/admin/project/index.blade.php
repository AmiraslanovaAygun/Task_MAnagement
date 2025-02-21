@extends('layouts.admin')
@section('title', 'Proyektlər')
@section('customCss')
    <style>
        .project-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .project-card:hover {
            transform: scale(1.05);
        }

        .new-project {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            border-radius: 12px;
            height: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .project-card .card-img-top {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .new-project:hover {
            background: #f8f9fa;
        }

        .avatar-group .user-icon {
            font-size: 12px;
            width: 30px;
            height: 30px;
            margin-left: -13px;
            border-radius: 50%;
            border: 1px solid #fff;
        }

        @media (prefers-color-scheme: dark) {
            input::placeholder {
                color: white !important;
            }
        }

        .list-container {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 10px;
            scrollbar-color: rgba(100, 100, 100, 0.5) transparent;
        }

        /* WebKit brauzerlər üçün (Chrome, Safari) */
        .list-container::-webkit-scrollbar {
            width: 8px; /* Scrollbar genişliyi */
        }

        .list-container::-webkit-scrollbar-thumb {
            background-color: rgba(100, 100, 100, 0.5); /* Scrollbar rəngi */
            border-radius: 4px; /* Kənarların yumrulaşması */
        }

        .list-container::-webkit-scrollbar-track {
            background: transparent; /* Scrollbar arxa fonu */
        }


    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="px-0  content">
            <div class="card p-4 container-fluid mt-5">
                <div class="row g-3 mt-2">
                    @if(request()->query('page', 1) == 1)
                        <div class="col-12 col-sm-6 col-md-4 ">
                            <div class="new-project p-4 d-flex align-items-center justify-content-center"
                                 data-bs-toggle="modal" data-bs-target="#newProjectModal"
                                 style="height: 100%; min-height: 150px;">
                                <h5 class="text-secondary text-center">+ Yeni Proyekt</h5>
                            </div>
                        </div>
                    @endif
                    @foreach($projects as $project)
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="card project-card h-100 m-auto">
                                @if(isset($project->icon))
                                    <img src="{{ Storage::url($project->icon) }}" class="card-img-top img-fluid"
                                         alt="Project image">
                                @endif
                                <div class="card-body d-flex flex-column align-items-center">
                                    <h6>Proyekt #{{$project->id}}</h6>
                                    <h5 class="mb-2">{{$project->project_name}}</h5>
                                    <p class="flex-grow-1 text-center ">{{ Str::limit($project->description, 65, '...') }}</p>
                                    <div class="row align-items-center w-100">
                                        <div class="col-8">
                                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                                    data-bs-target="#projectModal{{ $project->id }}">
                                                PROYEKTİ GÖR
                                            </button>
                                        </div>
                                        <div class="col-4 text-end">
                                            @if($project->status == 'todo')
                                                <span class="btn btn-warning btn-sm w-100">Yaradılıb</span>
                                            @elseif($project->status == 'doing')
                                                <span class="btn btn-primary btn-sm w-100">Hazırlanır</span>
                                            @elseif($project->status == 'done')
                                                <span class="btn btn-success btn-sm w-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="avatar-group d-flex pl-2">
                                        @php $count = 0; @endphp
                                        @foreach($project->users as $user)
                                            @if($count < 6)
                                                @if(isset($user->avatar))
                                                    <img src="{{ Storage::url($user->avatar) }}" alt="User"
                                                         class="user-icon rounded-circle me-1"
                                                         style="width: 30px; height: 30px;">
                                                @else
                                                    <div class="user-icon rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1"
                                                         style="width: 30px; height: 30px;">
                                                        {{ implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), explode(' ', $user->name))) }}
                                                    </div>
                                                @endif
                                                @php $count++; @endphp
                                            @else
                                                @break
                                            @endif
                                        @endforeach

                                        @if($project->users->count() > 6)
                                            <span class="fw-bold">...</span>
                                        @endif
                                    </div>

                                    <button class="btn  btn-sm bg-danger ms-auto delete-button"
                                            data-id="{{ $project->id }}"
                                            data-url="{{ route('admin.project.destroy', $project) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1"
                                 aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.project.update', $project->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $project->project_name }}

                                                    @if($project->status == 'todo')
                                                        <span class="badge bg-warning"> Yaradılıb
                                                       </span>
                                                    @elseif($project->status == 'doing')
                                                        <span class="badge bg-gradient-primary"> Hazırlanır
                                                       </span>
                                                    @elseif($project->status == 'done')
                                                        <span class="badge bg-success"> Tamamlanıb
                                                       </span>
                                                    @endif
                                                </h5>

                                                <div class="px-5">
                                                    <div class="d-flex user-list"
                                                         id="project-users-{{ $project->id }}">
                                                        @php $count = 0; @endphp
                                                        @foreach($project->users as $user)
                                                            @if($count < 5)
                                                                @if(isset($user->avatar))
                                                                    <img src="{{ Storage::url($user->avatar) }}"
                                                                         class="rounded-circle me-1" width="40"
                                                                         height="40"
                                                                         style="margin-left: -12px">
                                                                @else
                                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1"
                                                                         style="width: 40px; height: 40px; margin-left: -12px">
                                                                        {{ implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), explode(' ', $user->name))) }}
                                                                    </div>
                                                                @endif
                                                                @php $count++; @endphp
                                                            @else
                                                                @break
                                                            @endif
                                                        @endforeach
                                                        @if($project->users->count() > 5)
                                                            <span class="fw-bold">...</span>
                                                        @endif

                                                        @if($project->users->count() == 0)
                                                            <span class="btn btn-outline-primary ms-2 rounded-circle me-4 plus-btn"
                                                                  data-bs-toggle="modal"
                                                                  data-bs-target="#userModal{{ $project->id }}"> Üzv +
                                                            </span>
                                                        @else
                                                            <span class="btn btn-outline-primary ms-2 rounded-circle me-4 plus-btn"
                                                                  data-bs-toggle="modal"
                                                                  data-bs-target="#userModal{{ $project->id }}">+
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>PROYEKTİN ADI</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditProjectName({{ $project->id }})">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="projectNameText{{ $project->id }}">{{ $project->project_name }}</p>
                                                        <input type="text" name="project_name"
                                                               id="projectNameEdit{{ $project->id }}"
                                                               class="form-control d-none"
                                                               value="{{ $project->project_name }}">
                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveProjectNameBtn{{ $project->id }}"
                                                              onclick="saveProjectName({{ $project->id }})">Saxla
                                                        </span>
                                                    </div>
                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>PROYEKTİN QISA TƏSVİRİ</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditDescription({{ $project->id }})">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="descriptionText{{ $project->id }}">{{ $project->description }}</p>
                                                        <textarea name="description"
                                                                  id="descriptionEdit{{ $project->id }}"
                                                                  class="form-control d-none"
                                                                  style="max-height: 100px; overflow-y: auto;">{{ $project->description }}</textarea>

                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveDescriptionBtn{{ $project->id }}"
                                                              onclick="saveDescription({{ $project->id }})">Saxla
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>BAŞLANĞIC TARİXİ:</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditStartDate({{ $project->id }})">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="startDateText{{ $project->id }}">{{ $project->start_date }}</p>
                                                        <input type="date" id="startDateEdit{{ $project->id }}"
                                                               name="start_date" class="form-control d-none"
                                                               value="{{ $project->start_date }}">

                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveStartDateBtn{{ $project->id }}"
                                                              onclick="saveStartDate({{ $project->id }})">Saxla
                                                        </span>
                                                    </div>

                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>BİTMƏ TARİXİ:</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditEndDate({{ $project->id }})">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="endDateText{{ $project->id }}">{{ $project->end_date }}</p>
                                                        <input type="date" id="endDateEdit{{ $project->id }}"
                                                               name="end_date" class="form-control d-none"
                                                               value="{{ $project->end_date }}">

                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveEndDateBtn{{ $project->id }}"
                                                              onclick="saveEndDate({{ $project->id }})">Saxla
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- Şərhlər -->
                                                <div class="px-4">
                                                    <h5 class="text-lightblue text-center">TAPŞIRIQ ƏLAVƏ ET</h5>
                                                    <div class="w-75 m-auto text-center">
                                                        <input type="text" id="taskInput{{ $project->id }}"
                                                               class="form-control"
                                                               placeholder="Tapşırıq adı">
                                                        <span class="btn btn-primary mt-2"
                                                              onclick="addTask({{ $project->id }})">Göndər</span>
                                                    </div>

                                                    <div id="tasksList{{ $project->id }}" class="mt-3">
                                                        @if(count($project->tasks) > 0)
                                                            <h5 class="text-lightblue text-center">Mövcud
                                                                Tapşırıqlar</h5>
                                                        @endif
                                                        <div class="list-container">
                                                            @foreach($project->tasks as $task)
                                                                <div class="current-task d-flex justify-content-between align-items-center bg-light p-2 my-1 rounded"
                                                                     id="taskDiv{{ $task->id }}">
                                                                    <!-- Görünən mətn -->
                                                                    <div>
                                                                        <span class="task-number">{{ $loop->iteration }}.</span>
                                                                        <span id="taskText{{ $task->id }}">{{ $task->task_name }}</span>
                                                                    </div>
                                                                    <!-- Input (gizli olacaq) -->
                                                                    <input type="text" name="tasks[{{ $task->id }}]"
                                                                           value="{{ $task->task_name }}"
                                                                           class="form-control w-75 d-none"
                                                                           id="taskInput{{ $task->id }}">

                                                                    <div>
                                                                        <!-- Redaktə düyməsi -->
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-primary"
                                                                                onclick="toggleEditTask({{ $task->id }})"
                                                                                id="editTaskBtn{{ $task->id }}">
                                                                            <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                                        </button>

                                                                        <!-- Saxla düyməsi (gizli olacaq) -->
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-success d-none"
                                                                                onclick="saveTask({{ $task->id }})"
                                                                                id="saveTaskBtn{{ $task->id }}">
                                                                            <i class="fa-regular fa-save text-success"></i>
                                                                        </button>

                                                                        <!-- Sil düyməsi -->
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-danger delete-button"
                                                                                data-id="{{ $task->id }}"
                                                                                data-url="{{ route('admin.task.destroy', $task->id) }}">
                                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>

                                                    <div id="newTasksContainer{{ $project->id }}" class="mt-3 d-none">
                                                        <h5 class="text-success text-center">Yeni əlavə olunmuş
                                                            tapşırıqlar</h5>
                                                        <div id="newTasksList{{ $project->id }}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Dəyişiklikləri Yadda
                                                    Saxla
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="userModal{{ $project->id }}" class="modal fade" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">İstifadəçiləri idarə et - Proyekt
                                                #{{ $project->id }}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Yeni əlavə ediləcək istifadəçilər -->
                                            <div class="list-container">
                                                <ul id="available-users-{{ $project->id }}"
                                                    class="list-group mb-3">
                                                    @foreach($users as $user)
                                                        @if(!in_array($user->id, $project->users->pluck('id')->toArray()))
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                                data-user-id="{{ $user->id }}"
                                                                data-user-name="{{ $user->name }}"
                                                                data-user-avatar="{{ isset($user->avatar) ? Storage::url($user->avatar) : '' }}">
                                                                {{ $user->name }}
                                                                <button class="btn btn-sm btn-primary add-user-btn"
                                                                        type="button">Əlavə et
                                                                </button>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <!-- Mövcud istifadəçilər -->
                                            <h6 class="mt-2">Mövcud İstifadəçilər</h6>
                                            <div class="list-container">
                                                <ul id="current-users-{{ $project->id }}"
                                                    class="list-group">
                                                    @foreach($project->users as $user)
                                                        <li class="list-group-item d-flex align-items-center justify-content-between"
                                                            data-user-id="{{ $user->id }}">
                                                            <div class="d-flex align-items-center">
                                                                @if(isset($user->avatar))
                                                                    <img src="{{ Storage::url($user->avatar) }}"
                                                                         class="rounded-circle me-2"
                                                                         width="30" height="30">
                                                                @else
                                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                                                                         style="width: 30px; height: 30px;">
                                                                        {{ implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), explode(' ', $user->name))) }}
                                                                    </div>
                                                                @endif
                                                                <span>{{ $user->name }}</span>
                                                            </div>
                                                            <button class="btn btn-sm btn-danger remove-user-btn">
                                                                Sil
                                                            </button>
                                                            <input type="hidden" name="users[]"
                                                                   value="{{ $user->id }}">
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                Bağla
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(request()->query('page', 1) != 1)
                        <div class="col-12 col-sm-6 col-md-4 ">
                            <div class="new-project p-4 d-flex align-items-center justify-content-center"
                                 style="height: 100%; min-height: 150px;">
                                <h5 class="text-secondary text-center">
                                    <i class="fa-solid fa-angles-right"></i></h5>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer mt-3">
                    <nav aria-label="Page Navigation">
                        @include('components.pagination', ['paginator' => $projects])
                    </nav>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header text-white" style="background-color: #3f6791;">
                            <h5 class="modal-title" id="newProjectModalLabel">Yeni Proyekt Əlavə Et</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('admin.project.store')}}"
                                  enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="p-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="project_name" class="form-label">Proyektin Adı</label>
                                            <input type="text" id="project_name" name="project_name"
                                                   class="form-control" value="{{ old('project_name') }}" required>
                                            @error('project_name')<span
                                                    class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="icon" class="form-label">Şəkil</label>
                                            <input type="file" id="icon" name="icon" class="form-control">
                                            @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Proyekt haqqında qısa
                                                təsvir</label>
                                            <textarea id="description" name="description" class="form-control"
                                                      rows="4" required>{{ old('description') }}</textarea>
                                            @error('description')<span
                                                    class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="users" class="form-label">Proyekti kimlər işləyəcək?</label>
                                            <select id="users" name="users[]" class="form-select" multiple required>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('users')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Başlanğıc Tarixi</label>
                                            <input type="date" id="start_date" name="start_date"
                                                   class="form-control" value="{{ old('start_date') }}"
                                                   min="{{ date('Y-m-d') }}" required>
                                            @error('start_date')<span
                                                    class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">Bitmə Tarixi</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control"
                                                   value="{{ old('end_date') }}"
                                                   min="{{ old('start_date', date('Y-m-d')) }}" required>
                                            @error('end_date')<span
                                                    class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary w-50">Proyekt Yarat</button>
                                    </div>
                                </div>
                            </form>
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

@include('components.admin.projectAlerts')

