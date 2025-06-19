<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceDonation extends Model
{
    protected $table = "attendance_donations";

    protected $fillable = [
        'user_id',
        'category',
        'amount',
        'group_id',
        'member_id',
        'total_male',
        'total_female',
        'total_children',
        'total_attended',
    ];

    public static function categories(){
        return [
            'Kikundi'               => 'Kikundi',
            'Ibada Nyinginezo'      => 'Ibada Nyinginezo',
            'Ibada ya Kwanza'       => 'Ibada ya Kwanza',
            'Ibada ya Pili'         => 'Ibada ya Pili',
            'Ibada ya Tatu'         => 'Ibada ya Tatu',
            'Jumuia'                => 'Jumuia',
            'Shule ya Jumapili'     => 'Shule ya Jumapili'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
