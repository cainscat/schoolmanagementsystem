<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function OnlineUser()
    {
        return Cache::has('OnlineUser' . $this->id);
    }

    static public function getTotalUser($user_type)
    {
        return self::select('users.id')
                    ->where('user_type', '=', $user_type)
                    ->where('is_delete', '=', 0)
                    ->count();
    }

    static public function getSingleClass($id)
    {
        return self::select('users.*', 'class.amount', 'class.name as class_name')
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->where('users.id', '=', $id)
                    ->first();
    }

    static public function searchUser($search)
    {
        $return = self::select('users.*')
                    ->where(function($query) use ($search){
                        $query->where('users.name', 'like', '%'.$search.'%')
                        ->orWhere('users.last_name', 'like', '%'.$search.'%');
                    })
                    ->limit(10)
                    ->get();

        return $return;

    }

    static public function getEmailSingle($email)
    {
        return self::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token)
    {
        return self::where('remember_token', '=', $remember_token)->first();
    }

    public function getProfile()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return '';
        }
    }

    public function getProfileDirect()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return url('upload/profile/dummy-profile.jfif');
        }
    }

    static public function getAdmin()
    {
        $return = self::select('users.*')
                    ->where('user_type', '=', 1)
                    ->where('is_delete', '=', 0);

        if(!empty(Request::get('name')))
        {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('email')))
        {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('date')))
        {
            $return = $return->whereDate('created_at', '=',Request::get('date'));
        }

        $return = $return->orderBy('id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getUser($user_type)
    {
        return self::select('users.*')
                ->where('user_type', '=', $user_type)
                ->where('is_delete', '=', 0)
                ->get();
    }

    static public function getStudent()
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                    ->join('class', 'class.id', '=', 'users.class_id', 'left')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0);
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('class')))
                    {
                        $return = $return->where('class.name', 'like', '%'.Request::get('class').'%');
                    }
                    if(!empty(Request::get('admission_number')))
                    {
                        $return = $return->where('users.admission_number', 'like', '%'.Request::get('admission_number').'%');
                    }
                    if(!empty(Request::get('admission_date')))
                    {
                        $return = $return->where('users.admission_date', '=', Request::get('admission_date'));
                    }
                    if(!empty(Request::get('roll_number')))
                    {
                        $return = $return->where('users.roll_number', 'like', '%'.Request::get('roll_number').'%');
                    }
                    if(!empty(Request::get('blood_group')))
                    {
                        $return = $return->where('users.blood_group', 'like', '%'.Request::get('blood_group').'%');
                    }
                    if(!empty(Request::get('religion')))
                    {
                        $return = $return->where('users.religion', 'like', '%'.Request::get('religion').'%');
                    }
                    if(!empty(Request::get('caste')))
                    {
                        $return = $return->where('users.caste', 'like', '%'.Request::get('caste').'%');
                    }
                    if(!empty(Request::get('mobile_number')))
                    {
                        $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
                    }
                    if(!empty(Request::get('gender')))
                    {
                        $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
                    }
                    if(!empty(Request::get('status')))
                    {
                        $status = (Request::get('status') == 100) ? 0 : 1;
                        $return = $return->where('users.status', '=',$status);
                    }
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('users.created_at', '=',Request::get('date'));
                    }

        $return = $return->orderBy('users.id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getCollectFeesStudent()
    {
        $return = self::select('users.*', 'class.name as class_name', 'class.amount')
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0);

                    if(!empty(Request::get('student_id')))
                    {
                        $return = $return->where('users.id', '=', Request::get('student_id'));
                    }
                    if(!empty(Request::get('student_name')))
                    {
                        $student_name = Request::get('student_name');
                        $return = $return->where(function($query) use ($student_name){
                            $query->where('users.name', 'like', '%'.$student_name.'%')->orWhere('users.last_name','like','%'.$student_name.'%');
                        });
                    }
                    if(!empty(Request::get('class_id')))
                    {
                        $return = $return->where('users.class_id', '=', Request::get('class_id'));
                    }

        $return = $return->orderBy('users.name', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getPaidAmount($student_id, $class_id)
    {
        return StudentAddFeesModel::getPaidAmount($student_id, $class_id);
    }

    static public function getParent()
    {
        $return = self::select('users.*')
                    ->where('users.user_type', '=', 4)
                    ->where('users.is_delete', '=', 0);
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('address')))
                    {
                        $return = $return->where('users.address', 'like', '%'.Request::get('address').'%');
                    }
                    if(!empty(Request::get('occupation')))
                    {
                        $return = $return->where('users.occupation', 'like', '%'.Request::get('occupation').'%');
                    }
                    if(!empty(Request::get('mobile_number')))
                    {
                        $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
                    }
                    if(!empty(Request::get('gender')))
                    {
                        $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
                    }
                    if(!empty(Request::get('status')))
                    {
                        $status = (Request::get('status') == 100) ? 0 : 1;
                        $return = $return->where('users.status', '=',$status);
                    }
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('users.created_at', '=',Request::get('date'));
                    }

        $return = $return->orderBy('users.id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getSearchStudent()
    {
        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email')))
        {
            $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                    ->join('class', 'class.id', '=', 'users.class_id', 'left')
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0);

                    if(!empty(Request::get('id')))
                    {
                        $return = $return->where('users.id', '=', Request::get('id'));
                    }
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('users.created_at', '=',Request::get('date'));
                    }

            $return = $return->orderBy('users.id', 'desc')
                        ->limit(50)
                        ->get();

            return $return;
        }
    }

    static public function getMyStudent($parent_id)
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                    ->join('class', 'class.id', '=', 'users.class_id', 'left')
                    ->where('users.user_type', '=', 3)
                    ->where('users.parent_id', '=', $parent_id)
                    ->where('users.is_delete', '=', 0)
                    ->orderBy('users.id', 'desc')
                    ->get();

        return $return;
    }

    static public function getMyTotalStudentParent($parent_id)
    {
        $return = self::select('users.id')
                    ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                    ->join('class', 'class.id', '=', 'users.class_id', 'left')
                    ->where('users.user_type', '=', 3)
                    ->where('users.parent_id', '=', $parent_id)
                    ->where('users.is_delete', '=', 0)
                    ->count();

        return $return;
    }

    static public function getMyStudentIDs($parent_id)
    {
        $return = self::select('users.id')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.parent_id', '=', $parent_id)
                ->where('users.is_delete', '=', 0)
                ->orderBy('users.id', 'desc')
                ->get();

        $student_ids = array();
        foreach($return as $value)
        {
            $student_ids[] = $value->id;
        }

        return $student_ids;
    }

    static public function getMyStudentClassIDs($parent_id)
    {
        $return = self::select('users.class_id')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id')
                ->where('users.user_type', '=', 3)
                ->where('users.parent_id', '=', $parent_id)
                ->where('users.is_delete', '=', 0)
                ->orderBy('users.id', 'desc')
                ->get();

        $class_ids = array();
        foreach($return as $value)
        {
            $class_ids[] = $value->class_id;
        }

        return $class_ids;
    }

    static public function getTeacher()
    {
        $return = self::select('users.*')
                    ->where('users.user_type', '=', 2)
                    ->where('users.is_delete', '=', 0);
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('mobile_number')))
                    {
                        $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
                    }
                    if(!empty(Request::get('marital_status')))
                    {
                        $return = $return->where('users.marital_status', 'like', '%'.Request::get('marital_status').'%');
                    }
                    if(!empty(Request::get('gender')))
                    {
                        $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
                    }
                    if(!empty(Request::get('status')))
                    {
                        $status = (Request::get('status') == 100) ? 0 : 1;
                        $return = $return->where('users.status', '=',$status);
                    }
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('users.created_at', '=',Request::get('date'));
                    }
                    if(!empty(Request::get('admission_date')))
                    {
                        $return = $return->whereDate('users.admission_date', '=',Request::get('admission_date'));
                    }

        $return = $return->orderBy('users.id', 'desc')
                    ->paginate(20);

        return $return;
    }


    static public function getTeacherClass()
    {
        $return = self::select('users.*')
                    ->where('users.user_type', '=', 2)
                    ->where('users.is_delete', '=', 0);
        $return = $return->orderBy('users.id', 'desc')
                    ->get();

        return $return;
    }

    static public function getTeacherStudent($teacher_id)
    {
        $return = self::select('users.*', 'class.name as class_name')
        ->join('class', 'class.id', '=', 'users.class_id')
        ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
        ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
        ->where('assign_class_teacher.is_delete', '=', 0)
        ->where('assign_class_teacher.status', '=', 0)
        ->where('users.user_type', '=', 3)
        ->where('users.is_delete', '=', 0);
        if(!empty(Request::get('name')))
        {
            $return = $return->where('users.name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('last_name')))
        {
            $return = $return->where('users.last_name', 'like', '%'.Request::get('last_name').'%');
        }
        if(!empty(Request::get('email')))
        {
            $return = $return->where('users.email', 'like', '%'.Request::get('email').'%');
        }
        if(!empty(Request::get('mobile_number')))
        {
            $return = $return->where('users.mobile_number', 'like', '%'.Request::get('mobile_number').'%');
        }
        if(!empty(Request::get('gender')))
        {
            $return = $return->where('users.gender', 'like', '%'.Request::get('gender').'%');
        }
        $return = $return->orderBy('users.id', 'desc')
                        ->groupBy('users.id')
                        ->paginate(20);

        return $return;
    }

    static public function getTeacherStudentCount($teacher_id)
    {
        return self::select('users.id')
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
                    ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
                    ->where('assign_class_teacher.is_delete', '=', 0)
                    ->where('assign_class_teacher.status', '=', 0)
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0)
                    ->count();
    }

    static public function getStudentClass($class_id)
    {
        return self::select('users.id', 'users.name', 'users.last_name')
                    ->where('users.class_id', '=', $class_id)
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0)
                    ->orderBy('users.id', 'desc')
                    ->get();
    }

    static public function getAttendance($student_id, $class_id, $attendance_date)
    {
        return StudentAttendanceModel::checkAlreadyAttendance($student_id, $class_id, $attendance_date);
    }

}
