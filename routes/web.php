<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ClassController;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Controllers\ParentController;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\FeesColectionController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\AssignClassTeacherController;

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgot_password']);
Route::post('forgot-password', [AuthController::class, 'post_forgot_password']);
Route::get('reset/{token}', [AuthController::class, 'reset_password']);
Route::post('reset/{token}', [AuthController::class, 'post_reset_password']);

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    //Admin url
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //Teacher url
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);

    //Student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

    //Parent url
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my-student/{id}', [ParentController::class, 'my_student']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'assign_student_parent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, 'assign_student_parent_delete']);

    //Class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    //Subject url
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    //Assign Subject
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);

    //assign_class_teacher
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list']);
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add']);
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert']);
    Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
    Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
    Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);

    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);

    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);

    Route::get('admin/account', [UserController::class, 'my_account']);
    Route::post('admin/account', [UserController::class, 'update_my_account']);

    Route::get('admin/examinations/exam/list', [ExaminationsController::class, 'exam_list']);
    Route::get('admin/examinations/exam/add', [ExaminationsController::class, 'exam_add']);
    Route::post('admin/examinations/exam/add', [ExaminationsController::class, 'exam_insert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_edit']);
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'exam_delete']);

    Route::get('admin/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert']);

    Route::get('admin/examinations/marks_register', [ExaminationsController::class, 'marks_register']);
    Route::post('admin/examinations/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']);
    Route::post('admin/examinations/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']);

    Route::get('admin/examinations/marks_grade', [ExaminationsController::class, 'marks_grade']);
    Route::get('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_add']);
    Route::post('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_insert']);
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_edit']);
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_update']);
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class, 'marks_grade_delete']);

    Route::get('admin/attendance/student', [AttendanceController::class, 'attendance_student']);
    Route::post('admin/attendance/student/save', [AttendanceController::class, 'attendance_student_submit']);
    Route::get('admin/attendance/report', [AttendanceController::class, 'attendance_report']);

    Route::get('admin/communicate/notice_board', [CommunicateController::class, 'notice_board']);
    Route::get('admin/communicate/notice_board/add', [CommunicateController::class, 'add_notice_board']);
    Route::post('admin/communicate/notice_board/add', [CommunicateController::class, 'insert_notice_board']);
    Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'edit_notice_board']);
    Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'update_notice_board']);
    Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'delete_notice_board']);

    Route::get('admin/communicate/send_email', [CommunicateController::class, 'send_email']);
    Route::post('admin/communicate/send_email', [CommunicateController::class, 'send_email_user']);
    Route::get('admin/communicate/search_user', [CommunicateController::class, 'search_user']);

    Route::get('admin/homework/homework', [HomeworkController::class, 'homework']);
    Route::get('admin/homework/homework/add', [HomeworkController::class, 'add_homework']);
    Route::post('admin/homework/homework/add', [HomeworkController::class, 'insert_homework']);
    Route::post('admin/homework/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::get('admin/homework/homework/edit/{id}', [HomeworkController::class, 'edit_homework']);
    Route::post('admin/homework/homework/edit/{id}', [HomeworkController::class, 'update_homework']);
    Route::get('admin/homework/homework/delete/{id}', [HomeworkController::class, 'delete_homework']);
    Route::get('admin/homework/homework/submitted/{id}', [HomeworkController::class, 'submitted']);

    Route::get('admin/homework/homework_report', [HomeworkController::class, 'homework_report']);

    Route::get('admin/fees_colection/collect_fees', [FeesColectionController::class, 'collect_fees']);
    Route::get('admin/fees_colection/collect_fees/add_fees/{student_id}', [FeesColectionController::class, 'add_collect_fees']);

});

Route::middleware(TeacherMiddleware::class)->group(function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);
    Route::get('teacher/account', [UserController::class, 'my_account']);
    Route::post('teacher/account', [UserController::class, 'update_my_account_teacher']);

    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'my_class_subject']);
    Route::get('teacher/my_student', [StudentController::class, 'my_student']);
    Route::get('teacher/my_calendar', [CalendarController::class, 'my_calendar_teacher']);

    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'my_timetable_teacher']);
    Route::get('teacher/my_exam_timetable', [ExaminationsController::class, 'my_exam_timetable_teacher']);

    Route::get('teacher/marks_register', [ExaminationsController::class, 'marks_register_teacher']);
    Route::post('teacher/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']);
    Route::post('teacher/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']);

    Route::get('teacher/attendance/student', [AttendanceController::class, 'teacher_attendance_student']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'attendance_student_submit']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'teacher_attendance_report']);

    Route::get('teacher/my_notice_board', [CommunicateController::class, 'teacher_notice_board']);

    Route::get('teacher/homework/homework', [HomeworkController::class, 'teacher_homework']);
    Route::get('teacher/homework/homework/add', [HomeworkController::class, 'teacher_add_homework']);
    Route::post('teacher/homework/homework/add', [HomeworkController::class, 'teacher_insert_homework']);
    Route::post('teacher/homework/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::get('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'teacher_edit_homework']);
    Route::post('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'teacher_update_homework']);
    Route::get('teacher/homework/homework/delete/{id}', [HomeworkController::class, 'delete_homework']);

    Route::get('teacher/homework/homework/submitted/{id}', [HomeworkController::class, 'teacher_submitted']);

});

Route::middleware(StudentMiddleware::class)->group(function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
    Route::get('student/account', [UserController::class, 'my_account']);
    Route::post('student/account', [UserController::class, 'update_my_account_student']);

    Route::get('student/my_subject', [SubjectController::class, 'my_subject']);
    Route::get('student/my_calendar', [CalendarController::class, 'my_calendar_student']);
    Route::get('student/my_timetable', [ClassTimetableController::class, 'my_timetable_student']);
    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'my_exam_timetable_student']);
    Route::get('student/my_exam_result', [ExaminationsController::class, 'my_exam_result']);

    Route::get('student/my_attendance', [AttendanceController::class, 'my_attendance_student']);
    Route::get('student/my_notice_board', [CommunicateController::class, 'student_notice_board']);

    Route::get('student/my_homework', [HomeworkController::class, 'student_homework']);
    Route::get('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'student_submit_homework']);
    Route::post('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'student_submit_homework_insert']);
    Route::get('student/my_submitted_homework', [HomeworkController::class, 'student_submitted_homework']);

});

Route::middleware(ParentMiddleware::class)->group(function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);
    Route::get('parent/account', [UserController::class, 'my_account']);
    Route::post('parent/account', [UserController::class, 'update_my_account_parent']);

    Route::get('parent/my_student', [ParentController::class, 'my_student_list']);
    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'parent_student_subject']);

    Route::get('parent/my_student/subject/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'my_timetable_parent']);
    Route::get('parent/my_student/exam_timetable/{student_id}', [ExaminationsController::class, 'my_exam_timetable_parent']);
    Route::get('parent/my_student/exam_result/{student_id}', [ExaminationsController::class, 'parent_my_exam_result']);
    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'my_calendar_parent']);

    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class, 'my_student_attendance']);

    Route::get('parent/my_notice_board', [CommunicateController::class, 'parent_notice_board']);
    Route::get('parent/my_student_notice_board', [CommunicateController::class, 'parent_student_notice_board']);

    Route::get('parent/my_student/homework/{student_id}', [HomeworkController::class, 'my_student_homework']);
    Route::get('parent/my_student/submitted_homework/{student_id}', [HomeworkController::class, 'my_student_submitted_homework']);


});
