<?php $__env->startSection('title', 'Proyektlər'); ?>
<?php $__env->startSection('customCss'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="px-0  content">
            <div class="card p-4 container-fluid mt-5">
                <div class="row g-3 mt-2">
                    <?php if(request()->query('page', 1) == 1): ?>
                        <div class="col-12 col-sm-6 col-md-4 ">
                            <div class="new-project p-4 d-flex align-items-center justify-content-center"
                                 data-bs-toggle="modal" data-bs-target="#newProjectModal"
                                 style="height: 100%; min-height: 150px;">
                                <h5 class="text-secondary text-center">+ Yeni Proyekt</h5>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="card project-card h-100 m-auto">
                                <?php if(isset($project->icon)): ?>
                                    <img src="<?php echo e(Storage::url($project->icon)); ?>" class="card-img-top img-fluid"
                                         alt="Project image">
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column align-items-center">
                                    <h6>Proyekt #<?php echo e($project->id); ?></h6>
                                    <h5 class="mb-2"><?php echo e($project->project_name); ?></h5>
                                    <p class="flex-grow-1 text-center "><?php echo e(Str::limit($project->description, 65, '...')); ?></p>
                                    <div class="row align-items-center w-100">
                                        <div class="col-8">
                                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                                    data-bs-target="#projectModal<?php echo e($project->id); ?>">
                                                PROYEKTİ GÖR
                                            </button>
                                        </div>
                                        <div class="col-4 text-end">
                                            <?php if($project->status == 'todo'): ?>
                                                <span class="btn btn-warning btn-sm w-100">Yaradılıb</span>
                                            <?php elseif($project->status == 'doing'): ?>
                                                <span class="btn btn-primary btn-sm w-100">Hazırlanır</span>
                                            <?php elseif($project->status == 'done'): ?>
                                                <span class="btn btn-success btn-sm w-50">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="avatar-group d-flex pl-2">
                                        <?php $count = 0; ?>
                                        <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($count < 6): ?>
                                                <?php if(isset($user->avatar)): ?>
                                                    <img src="<?php echo e(Storage::url($user->avatar)); ?>" alt="User"
                                                         class="user-icon rounded-circle me-1"
                                                         style="width: 30px; height: 30px;">
                                                <?php else: ?>
                                                    <div class="user-icon rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1"
                                                         style="width: 30px; height: 30px;">
                                                        <?php echo e(implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), explode(' ', $user->name)))); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <?php $count++; ?>
                                            <?php else: ?>
                                                <?php break; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($project->users->count() > 6): ?>
                                            <span class="fw-bold">...</span>
                                        <?php endif; ?>
                                    </div>

                                    <button class="btn  btn-sm bg-danger ms-auto delete-button"
                                            data-id="<?php echo e($project->id); ?>"
                                            data-url="<?php echo e(route('admin.project.destroy', $project)); ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="modal fade" id="projectModal<?php echo e($project->id); ?>" tabindex="-1"
                                 aria-labelledby="projectModalLabel<?php echo e($project->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form method="POST" action="<?php echo e(route('admin.project.update', $project->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title"><?php echo e($project->project_name); ?>


                                                    <?php if($project->status == 'todo'): ?>
                                                        <span class="badge bg-warning"> Yaradılıb
                                                       </span>
                                                    <?php elseif($project->status == 'doing'): ?>
                                                        <span class="badge bg-gradient-primary"> Hazırlanır
                                                       </span>
                                                    <?php elseif($project->status == 'done'): ?>
                                                        <span class="badge bg-success"> Tamamlanıb
                                                       </span>
                                                    <?php endif; ?>
                                                </h5>

                                                <div class="px-5">
                                                    <div class="d-flex user-list"
                                                         id="project-users-<?php echo e($project->id); ?>">
                                                        <?php $count = 0; ?>
                                                        <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($count < 5): ?>
                                                                <?php if(isset($user->avatar)): ?>
                                                                    <img src="<?php echo e(Storage::url($user->avatar)); ?>"
                                                                         class="rounded-circle me-1" width="40"
                                                                         height="40"
                                                                         style="margin-left: -12px">
                                                                <?php else: ?>
                                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1"
                                                                         style="width: 40px; height: 40px; margin-left: -12px">
                                                                        <?php echo e(implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), explode(' ', $user->name)))); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php $count++; ?>
                                                            <?php else: ?>
                                                                <?php break; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($project->users->count() > 5): ?>
                                                            <span class="fw-bold">...</span>
                                                        <?php endif; ?>

                                                        <?php if($project->users->count() == 0): ?>
                                                            <span class="btn btn-outline-primary ms-2 rounded-circle me-4 plus-btn"
                                                                  data-bs-toggle="modal"
                                                                  data-bs-target="#userModal<?php echo e($project->id); ?>"> Üzv +
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="btn btn-outline-primary ms-2 rounded-circle me-4 plus-btn"
                                                                  data-bs-toggle="modal"
                                                                  data-bs-target="#userModal<?php echo e($project->id); ?>">+
                                                            </span>
                                                        <?php endif; ?>
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
                                                                  onclick="toggleEditProjectName(<?php echo e($project->id); ?>)">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="projectNameText<?php echo e($project->id); ?>"><?php echo e($project->project_name); ?></p>
                                                        <input type="text" name="project_name"
                                                               id="projectNameEdit<?php echo e($project->id); ?>"
                                                               class="form-control d-none"
                                                               value="<?php echo e($project->project_name); ?>">
                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveProjectNameBtn<?php echo e($project->id); ?>"
                                                              onclick="saveProjectName(<?php echo e($project->id); ?>)">Saxla
                                                        </span>
                                                    </div>
                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>PROYEKTİN QISA TƏSVİRİ</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditDescription(<?php echo e($project->id); ?>)">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="descriptionText<?php echo e($project->id); ?>"><?php echo e($project->description); ?></p>
                                                        <textarea name="description"
                                                                  id="descriptionEdit<?php echo e($project->id); ?>"
                                                                  class="form-control d-none"
                                                                  style="max-height: 100px; overflow-y: auto;"><?php echo e($project->description); ?></textarea>

                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveDescriptionBtn<?php echo e($project->id); ?>"
                                                              onclick="saveDescription(<?php echo e($project->id); ?>)">Saxla
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>BAŞLANĞIC TARİXİ:</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditStartDate(<?php echo e($project->id); ?>)">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="startDateText<?php echo e($project->id); ?>"><?php echo e($project->start_date); ?></p>
                                                        <input type="date" id="startDateEdit<?php echo e($project->id); ?>"
                                                               name="start_date" class="form-control d-none"
                                                               value="<?php echo e($project->start_date); ?>">

                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveStartDateBtn<?php echo e($project->id); ?>"
                                                              onclick="saveStartDate(<?php echo e($project->id); ?>)">Saxla
                                                        </span>
                                                    </div>

                                                    <div class="col-12 col-md-6 px-5">
                                                        <h6 class="d-flex justify-content-between text-lightblue">
                                                            <span><b>BİTMƏ TARİXİ:</b></span>
                                                            <span class="btn btn-sm btn-outline-secondary"
                                                                  onclick="toggleEditEndDate(<?php echo e($project->id); ?>)">
                                                                <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                            </span>
                                                        </h6>
                                                        <p id="endDateText<?php echo e($project->id); ?>"><?php echo e($project->end_date); ?></p>
                                                        <input type="date" id="endDateEdit<?php echo e($project->id); ?>"
                                                               name="end_date" class="form-control d-none"
                                                               value="<?php echo e($project->end_date); ?>">

                                                        <span class="btn btn-sm btn-outline-primary mt-2 d-none"
                                                              id="saveEndDateBtn<?php echo e($project->id); ?>"
                                                              onclick="saveEndDate(<?php echo e($project->id); ?>)">Saxla
                                                        </span>
                                                    </div>
                                                </div>
                                                <!-- Şərhlər -->
                                                <div class="px-4">
                                                    <h5 class="text-lightblue text-center">TAPŞIRIQ ƏLAVƏ ET</h5>
                                                    <div class="w-75 m-auto text-center">
                                                        <input type="text" id="taskInput<?php echo e($project->id); ?>"
                                                               class="form-control"
                                                               placeholder="Tapşırıq adı">
                                                        <span class="btn btn-primary mt-2"
                                                              onclick="addTask(<?php echo e($project->id); ?>)">Göndər</span>
                                                    </div>

                                                    <div id="tasksList<?php echo e($project->id); ?>" class="mt-3">
                                                        <?php if(count($project->tasks) > 0): ?>
                                                            <h5 class="text-lightblue text-center">Mövcud
                                                                Tapşırıqlar</h5>
                                                        <?php endif; ?>
                                                        <div class="list-container">
                                                            <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="current-task d-flex justify-content-between align-items-center bg-light p-2 my-1 rounded"
                                                                     id="taskDiv<?php echo e($task->id); ?>">
                                                                    <!-- Görünən mətn -->
                                                                    <div>
                                                                        <span class="task-number"><?php echo e($loop->iteration); ?>.</span>
                                                                        <span id="taskText<?php echo e($task->id); ?>"><?php echo e($task->task_name); ?></span>
                                                                    </div>
                                                                    <!-- Input (gizli olacaq) -->
                                                                    <input type="text" name="tasks[<?php echo e($task->id); ?>]"
                                                                           value="<?php echo e($task->task_name); ?>"
                                                                           class="form-control w-75 d-none"
                                                                           id="taskInput<?php echo e($task->id); ?>">

                                                                    <div>
                                                                        <!-- Redaktə düyməsi -->
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-primary"
                                                                                onclick="toggleEditTask(<?php echo e($task->id); ?>)"
                                                                                id="editTaskBtn<?php echo e($task->id); ?>">
                                                                            <i class="fa-regular fa-pen-to-square text-lightblue"></i>
                                                                        </button>

                                                                        <!-- Saxla düyməsi (gizli olacaq) -->
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-success d-none"
                                                                                onclick="saveTask(<?php echo e($task->id); ?>)"
                                                                                id="saveTaskBtn<?php echo e($task->id); ?>">
                                                                            <i class="fa-regular fa-save text-success"></i>
                                                                        </button>

                                                                        <!-- Sil düyməsi -->
                                                                        <button type="button"
                                                                                class="btn btn-sm btn-outline-danger delete-button"
                                                                                data-id="<?php echo e($task->id); ?>"
                                                                                data-url="<?php echo e(route('admin.task.destroy', $task->id)); ?>">
                                                                            <i class="fa-solid fa-trash text-danger"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>

                                                    </div>

                                                    <div id="newTasksContainer<?php echo e($project->id); ?>" class="mt-3 d-none">
                                                        <h5 class="text-success text-center">Yeni əlavə olunmuş
                                                            tapşırıqlar</h5>
                                                        <div id="newTasksList<?php echo e($project->id); ?>"></div>
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
                            <div id="userModal<?php echo e($project->id); ?>" class="modal fade" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">İstifadəçiləri idarə et - Proyekt
                                                #<?php echo e($project->id); ?></h5>
                                            <button type="button" class="close" data-bs-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Yeni əlavə ediləcək istifadəçilər -->
                                            <div class="list-container">
                                                <ul id="available-users-<?php echo e($project->id); ?>"
                                                    class="list-group mb-3">
                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(!in_array($user->id, $project->users->pluck('id')->toArray())): ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                                                data-user-id="<?php echo e($user->id); ?>"
                                                                data-user-name="<?php echo e($user->name); ?>"
                                                                data-user-avatar="<?php echo e(isset($user->avatar) ? Storage::url($user->avatar) : ''); ?>">
                                                                <?php echo e($user->name); ?>

                                                                <button class="btn btn-sm btn-primary add-user-btn"
                                                                        type="button">Əlavə et
                                                                </button>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>

                                            <!-- Mövcud istifadəçilər -->
                                            <h6 class="mt-2">Mövcud İstifadəçilər</h6>
                                            <div class="list-container">
                                                <ul id="current-users-<?php echo e($project->id); ?>"
                                                    class="list-group">
                                                    <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between"
                                                            data-user-id="<?php echo e($user->id); ?>">
                                                            <div class="d-flex align-items-center">
                                                                <?php if(isset($user->avatar)): ?>
                                                                    <img src="<?php echo e(Storage::url($user->avatar)); ?>"
                                                                         class="rounded-circle me-2"
                                                                         width="30" height="30">
                                                                <?php else: ?>
                                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                                                                         style="width: 30px; height: 30px;">
                                                                        <?php echo e(implode('', array_map(fn($word) => strtoupper(substr($word, 0, 1)), explode(' ', $user->name)))); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                <span><?php echo e($user->name); ?></span>
                                                            </div>
                                                            <button class="btn btn-sm btn-danger remove-user-btn">
                                                                Sil
                                                            </button>
                                                            <input type="hidden" name="users[]"
                                                                   value="<?php echo e($user->id); ?>">
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(request()->query('page', 1) != 1): ?>
                        <div class="col-12 col-sm-6 col-md-4 ">
                            <div class="new-project p-4 d-flex align-items-center justify-content-center"
                                 style="height: 100%; min-height: 150px;">
                                <h5 class="text-secondary text-center">
                                    <i class="fa-solid fa-angles-right"></i></h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer mt-3">
                    <nav aria-label="Page Navigation">
                        <?php echo $__env->make('components.pagination', ['paginator' => $projects], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <form method="POST" action="<?php echo e(route('admin.project.store')); ?>"
                                  enctype="multipart/form-data" class="needs-validation" novalidate>
                                <?php echo csrf_field(); ?>
                                <div class="p-3">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="project_name" class="form-label">Proyektin Adı</label>
                                            <input type="text" id="project_name" name="project_name"
                                                   class="form-control" value="<?php echo e(old('project_name')); ?>" required>
                                            <?php $__errorArgs = ['project_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                                    class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="icon" class="form-label">Şəkil</label>
                                            <input type="file" id="icon" name="icon" class="form-control">
                                            <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Proyekt haqqında qısa
                                                təsvir</label>
                                            <textarea id="description" name="description" class="form-control"
                                                      rows="4" required><?php echo e(old('description')); ?></textarea>
                                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                                    class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="users" class="form-label">Proyekti kimlər işləyəcək?</label>
                                            <select id="users" name="users[]" class="form-select" multiple required>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['users'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Başlanğıc Tarixi</label>
                                            <input type="date" id="start_date" name="start_date"
                                                   class="form-control" value="<?php echo e(old('start_date')); ?>"
                                                   min="<?php echo e(date('Y-m-d')); ?>" required>
                                            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                                    class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">Bitmə Tarixi</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control"
                                                   value="<?php echo e(old('end_date')); ?>"
                                                   min="<?php echo e(old('start_date', date('Y-m-d'))); ?>" required>
                                            <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span
                                                    class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

<?php $__env->stopSection(); ?>

<?php if(session('success')||session('error')): ?>
    <?php echo $__env->make('components.admin.sessionAlert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('components.admin.projectAlerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/admin/project/index.blade.php ENDPATH**/ ?>