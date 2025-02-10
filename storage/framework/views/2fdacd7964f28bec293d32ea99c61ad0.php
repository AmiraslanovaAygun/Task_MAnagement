<?php $__env->startSection('title', 'İstifadəçilər'); ?>

<?php $__env->startSection('customCss'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="px-0 content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row mt-5">
                        <?php if(request()->query('page', 1) == 1): ?>
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="new-user p-4" data-bs-toggle="modal" data-bs-target="#newUserModal">
                                        <h5 class="text-secondary">+ Yeni Üzv</h5>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5><b><?php echo e($user->name); ?></b></h5>
                                                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(  $user->position_id == $position->id): ?>

                                                        <h5><b>
                                                                <i class="fa-regular fas fa-user-md fa-circle-user"></i>
                                                                <?php echo e($position->name); ?></b></h5>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <ul class=" ml-4 mb-0 fa-ul text-muted">

                                                    <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-envelope"></i></span>
                                                        <?php echo e($user->email); ?>

                                                    </li>
                                                    <li class="small  my-2"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span>
                                                        <?php echo e($user->phone); ?>

                                                    </li>
                                                    <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-calendar"></i></span>
                                                        Registrasiya tarixi:
                                                        <?php echo e($user->created_at->format('d M Y')); ?>

                                                    </li>
                                                </ul>
                                            </div>

                                            <?php if(isset($user->avatar)): ?>

                                                <div class="col-4 text-right">
                                                    <img src="<?php echo e(Storage::url($user->avatar)); ?>"
                                                         alt="manager-avatar"
                                                         class="img-circle img-fluid"
                                                         style="width: 85px; height: 85px; object-fit: cover;">
                                                </div>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button class="btn btn-sm bg-danger delete-button"
                                                    data-id="<?php echo e($user->id); ?>"
                                                    data-url="<?php echo e(route('deleteUser', $user)); ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Page Navigation">
                        <?php echo $__env->make('components.pagination', ['paginator' => $users], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

                            <form action="<?php echo e(route('register')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="name">AD, SOYAD</label>
                                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="name"
                                                   name="name"
                                                   value="<?php echo e(old('name')); ?>"
                                                   required>
                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="email">ELEKTRON POÇT</label>
                                            <input type="email"
                                                   class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="email"
                                                   name="email"
                                                   value="<?php echo e(old('email')); ?>" required>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="phone">TELEFON</label>
                                            <input type="tel" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="phone"
                                                   name="phone"
                                                   value="<?php echo e(old('phone')); ?>"
                                                   required>
                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="password">ŞİFRƏ</label>
                                            <input type="password"
                                                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="password"
                                                   name="password" required>
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label for="position_id" class="form-label">VƏZİFƏ</label>
                                            <select class="form-control <?php $__errorArgs = ['position_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    id="position_id"
                                                    name="position_id" required>
                                                <option value="" disabled selected>---</option>
                                                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($position->id); ?>" <?php echo e(old('position_id') == $position->id ? 'selected' : ''); ?>><?php echo e($position->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['position_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group my-3">
                                            <label class="mb-2" for="avatar">PROFİL ŞƏKLİ</label>
                                            <input type="file"
                                                   class="form-control-file <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                   id="avatar"
                                                   name="avatar">
                                            <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

<?php $__env->stopSection(); ?>

<?php if(session('success')||session('error')): ?>
    <?php echo $__env->make('components.admin.sessionAlert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('components.admin.deleteAlert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/admin/user/index.blade.php ENDPATH**/ ?>