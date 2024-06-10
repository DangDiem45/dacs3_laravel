<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    public function courseType()
    {
        return $this->belongsTo(CourseType::class, 'type_id', 'id');
    }
}
