<?php $__env->startSection('title', 'İdarəetmə'); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas  fa-box"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->get('total_products'); ?></span> <span
                                        class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-comment"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->get('comments'); ?></span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-luggage-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->get('total_orders'); ?></span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                        class="text-white fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->get('all_members'); ?></span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">

                        <!-- /.card -->
                        <div class="row">

                            <!-- /.col -->

                            <div class="col-md-6">
                                <!-- USERS LIST -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?php echo app('translator')->get('latest_members'); ?></h3>
                                        <div class="card-tools">
                                            <span
                                                    class="badge badge-danger">8 <?php echo app('translator')->get('new_members'); ?></span>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <ul class="users-list clearfix">
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <a href=""><?php echo app('translator')->get('view_all_users'); ?></a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!--/.card -->
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?php echo app('translator')->get('recently_added_products'); ?></h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <ul class="products-list product-list-in-card pl-2 pr-2">
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <a href=""
                                           class="uppercase"><?php echo app('translator')->get('view_all_products'); ?></a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title"><?php echo app('translator')->get('latest_orders'); ?></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('order_id'); ?></th>
                                            <th><?php echo app('translator')->get('products'); ?></th>
                                            <th><?php echo app('translator')->get('address'); ?></th>
                                            <th><?php echo app('translator')->get('status'); ?></th>
                                        </tr>
                                        </thead>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href=""
                                   class="btn btn-sm btn-secondary float-right"><?php echo app('translator')->get('view_all_orders'); ?></a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <!--direct-chat -->
                        <div class="card direct-chat direct-chat-warning">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo app('translator')->get('comments'); ?></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="direct-chat-messages" style="height: 755px !important;">
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href=""
                                   class="btn btn-sm btn-secondary float-right"><?php echo app('translator')->get('view_all_comments'); ?></a>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>