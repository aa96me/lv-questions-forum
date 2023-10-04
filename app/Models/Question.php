<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'question','description'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function answers() {
        return $this->hasMany(Answer::class)->where('status', 1);
    }
}
