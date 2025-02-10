<div class="card-footer">
    <nav aria-label="Page Navigation">
        <?php if($paginator->hasPages()): ?>
            <ul class="pagination justify-content-center m-0">
                
                <?php if($paginator->onFirstPage()): ?>
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo;</a>
                    </li>
                <?php endif; ?>
                
                <?php $__currentLoopData = $paginator->getUrlRange(1, $paginator->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active">
                            <span class="page-link"><?php echo e($page); ?></span>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php if($paginator->hasMorePages()): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&raquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </nav>
</div>

<style>
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .page-link:hover {
        background-color: #f1f1f1;
    }

    .page-link:focus {
        z-index: 3;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .page-item:last-child .page-link {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

</style>
<?php /**PATH C:\Users\aygun\PhpstormProjects\TrelloApp\resources\views/components/pagination.blade.php ENDPATH**/ ?>