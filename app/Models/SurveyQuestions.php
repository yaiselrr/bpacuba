<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestions extends Model
{
    //
    protected $fillable = ['pregunta','si','no','mejorar'];
}
