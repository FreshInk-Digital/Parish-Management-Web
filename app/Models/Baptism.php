<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    protected $fillable = [
        'user_id',
        'father_member_id',
        'mother_member_id',
        'baby_firstname',
        'baby_middlename',
        'baby_lastname',
        'dateOfBirth',
        'dateOfBaptism',
        'age',
        'status'
    ];


    //     public static function search($search)
    //     {
    //         return empty($search) ? static::query()
    //             : static::query()
    //                 ->leftJoin('users', 'baptisms.user_id', '=', 'users.id')
    //                 ->leftJoin('members', 'baptisms.father_member_id', '=', 'members.id')
    //                 ->leftJoin('members', 'baptisms.mother_member_id', '=', 'members.id')
    //                 ->where(function ($query) use ($search) {
    //                     $query->where('baptisms.id', 'like', '%' . $search . '%')
    //                         ->orWhere('members.firstname', 'like', '%' . $search . '%')
    //                         ->orWhere('members.middlename', 'like', '%' . $search . '%')
    //                         ->orWhere('members.lastname', 'like', '%' . $search . '%')
    // //                        ->orWhere('members.member_id', 'like', '%' . $search . '%')
    //                         ->orWhere('users.name', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.status', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.dateOfBaptism', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.baby_firstname', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.baby_middlename', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.baby_lastname', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.dateOfBirth', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.age', 'like', '%' . $search . '%')
    //                         ->orWhere('baptisms.created_at', 'like', '%' . $search . '%');
    //                 })
    //                 ->select('baptisms.*');
    //     }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
            ->leftJoin('users', 'baptisms.user_id', '=', 'users.id')
            ->leftJoin('members as fathers', 'baptisms.father_member_id', '=', 'fathers.id')
            ->leftJoin('members as mothers', 'baptisms.mother_member_id', '=', 'mothers.id')
            ->where(function ($query) use ($search) {
                $query->where('baptisms.id', 'like', '%' . $search . '%')
                    ->orWhere('fathers.firstname', 'like', '%' . $search . '%')
                    ->orWhere('fathers.middlename', 'like', '%' . $search . '%')
                    ->orWhere('fathers.lastname', 'like', '%' . $search . '%')
                    ->orWhere('mothers.firstname', 'like', '%' . $search . '%')
                    ->orWhere('mothers.middlename', 'like', '%' . $search . '%')
                    ->orWhere('mothers.lastname', 'like', '%' . $search . '%')
                    ->orWhere('users.name', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.status', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.dateOfBaptism', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.baby_firstname', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.baby_middlename', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.baby_lastname', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.dateOfBirth', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.age', 'like', '%' . $search . '%')
                    ->orWhere('baptisms.created_at', 'like', '%' . $search . '%');
            })
            ->select('baptisms.*');
    }


    public function father()
    {
        return $this->belongsTo(Member::class, 'father_member_id'); // ✅ Correct
    }
    
    public function mother()
    {
        return $this->belongsTo(Member::class, 'mother_member_id'); // ✅ Correct
    }
    
    public function user()
    {
        return $this->belongsTo(User::class); // ✅ Correct
    }
    
}
