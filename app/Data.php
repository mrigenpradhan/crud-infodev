<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    protected $guarded = ['id',  'created_at', 'updated_at'];
    protected $fillable = [ 
                            'name',
                            'email',
                            'phone',
                            'gender',
                            'age',
                        ];
}
