<?php $__env->startSection('title', 'Student Directory'); ?>

<?php $__env->startSection('content'); ?>
<div class="portal-card">
    <div class="portal-card-header">
        <div>
            <h1 class="portal-card-title">Student Directory</h1>
            <p class="portal-card-desc">View and manage all registered students.</p>
        </div>
        <svg width="48" height="48" fill="none" stroke="rgba(255,255,255,0.9)" viewBox="0 0 24 24" style="flex-shrink: 0;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
    </div>
    <div style="overflow-x: auto;">
        <table class="portal-table">
            <thead>
                <tr>
                    <th>Student #</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Enrollment</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a href="<?php echo e(route('students.show', $student)); ?>" class="link-blue"><?php echo e($student->student_number); ?></a></td>
                        <td><?php echo e($student->full_name); ?></td>
                        <td><?php echo e($student->email); ?></td>
                        <td><?php echo e($student->courses_count); ?> course(s)</td>
                        <td style="text-align: right;">
                            <a href="<?php echo e(route('students.show', $student)); ?>" class="btn-red">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                View Profile
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" style="text-align: center; padding: 2.5rem; color: #6b7280;">No students found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\nelyn\TOMOL_IT15_ENROLLMENT_SYSTEM\resources\views/students/index.blade.php ENDPATH**/ ?>