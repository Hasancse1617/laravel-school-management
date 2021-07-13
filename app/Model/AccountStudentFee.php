<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class AccountStudentFee extends Model
{
    public function student()
    {
    	return $this->belongsTo(User::class,'student_id','id');
    }
    public function student_class()
    {
    	return $this->belongsTo(StudentClass::class,'class_id','id');
    }
    public function year()
    {
    	return $this->belongsTo(Year::class,'year_id','id');
    }
    public function fee_category()
    {
    	return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }
}
