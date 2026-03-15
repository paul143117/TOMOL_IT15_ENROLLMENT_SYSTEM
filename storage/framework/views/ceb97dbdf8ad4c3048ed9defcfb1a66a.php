<?php $__env->startSection('title', $course->course_name); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 1.5rem;">
    <a href="<?php echo e(route('courses.index')); ?>" style="font-size: 0.875rem; color: #4b5563; text-decoration: none;" onmouseover="this.style.color='#2563eb'" onmouseout="this.style.color='#4b5563'">&larr; Back to courses</a>
</div>

<div class="portal-card">
    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #e5e7eb;">
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #111; margin: 0;"><?php echo e($course->course_name); ?></h1>
        <dl style="margin: 0.75rem 0 0 0; display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
            <div>
                <dt style="font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; margin: 0;">Course code</dt>
                <dd style="font-size: 0.875rem; color: #111; margin: 0.125rem 0 0 0;"><?php echo e($course->course_code); ?></dd>
            </div>
            <div>
                <dt style="font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; margin: 0;">Capacity</dt>
                <dd style="font-size: 0.875rem; color: #111; margin: 0.125rem 0 0 0;"><?php echo e($course->students->count()); ?> / <?php echo e($course->capacity); ?> enrolled</dd>
            </div>
        </dl>
    </div>

    <div style="padding: 1.25rem 1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 600; color: #111; margin: 0 0 0.75rem 0;">Enrolled students</h2>
        <?php if($course->students->isEmpty()): ?>
            <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">No students enrolled in this course.</p>
        <?php else: ?>
            <ul style="margin: 0; padding: 0; list-style: none; border-top: 1px solid #e5e7eb;">
                <?php $__currentLoopData = $course->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li style="padding: 0.75rem 0; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e5e7eb;">
                        <div>
                            <span style="font-weight: 500; color: #111;"><?php echo e($student->full_name); ?></span>
                            <span style="color: #6b7280; font-size: 0.875rem; margin-left: 0.5rem;">(<?php echo e($student->student_number); ?>)</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <a href="<?php echo e(route('students.show', $student)); ?>" class="link-blue" style="font-size: 0.875rem;">View profile</a>
                            <form action="<?php echo e(route('enrollments.destroy')); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Drop this student from the course?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                <button type="submit" style="font-size: 0.875rem; color: #dc2626; background: none; border: none; cursor: pointer; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Drop</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>

    <?php if($course->students->count() < $course->capacity && $availableStudents->isNotEmpty()): ?>
        <div style="padding: 1.25rem 1.5rem; border-top: 1px solid #e5e7eb; background: #f9fafb;">
            <h3 style="font-size: 0.875rem; font-weight: 600; color: #111; margin: 0 0 0.75rem 0;">Enroll a student</h3>
            <form action="<?php echo e(route('enrollments.store')); ?>" method="POST" style="display: flex; flex-wrap: wrap; align-items: flex-end; gap: 0.75rem;">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                <div style="min-width: 200px;">
                    <label for="student_id" style="display: block; font-size: 0.75rem; font-weight: 500; color: #6b7280; margin-bottom: 0.25rem;">Student</label>
                    <select name="student_id" id="student_id" required style="display: block; width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 0.875rem;">
                        <option value="">Select a student</option>
                        <?php $__currentLoopData = $availableStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->full_name); ?> (<?php echo e($s->student_number); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="btn-red">Enroll</button>
            </form>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\nelyn\TOMOL_IT15_ENROLLMENT_SYSTEM\resources\views/courses/show.blade.php ENDPATH**/ ?>