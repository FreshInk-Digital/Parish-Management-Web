<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    protected $table = "pledges";

    protected $fillable = [
        'user_id',
        'member_id',
        'amount',
        'fulfilled_amount',
        'end_date',
        'pledge_date',
        'type',
        'status'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()
                ->leftJoin('users', 'pledges.user_id', '=', 'users.id')
                ->leftJoin('members', 'pledges.member_id', '=', 'members.member_id')
                ->where(function ($query) use ($search) {
                    $query->where('pledges.id', 'like', '%' . $search . '%')
                        ->orWhere('members.firstname', 'like', '%' . $search . '%')
                        ->orWhere('members.middlename', 'like', '%' . $search . '%')
                        ->orWhere('members.lastname', 'like', '%' . $search . '%')
                        ->orWhere('users.name', 'like', '%' . $search . '%')
                        ->orWhere('pledges.amount', 'like', '%' . $search . '%')
                        ->orWhere('pledges.fulfilled_amount', 'like', '%' . $search . '%')
                        ->orWhere('pledges.end_date', 'like', '%' . $search . '%')
                        ->orWhere('pledges.pledge_date', 'like', '%' . $search . '%')
                        ->orWhere('pledges.type', 'like', '%' . $search . '%')
                        ->orWhere('pledges.status', 'like', '%' . $search . '%')
                        ->orWhere('pledges.created_at', 'like', '%' . $search . '%');
                })
                ->select('pledges.*');
    }


    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public static function types()
    {
        return [
            'Mnada' => 'Mnada',
            'Ujenzi' => 'Ujenzi',
            'Michango' => 'Michango',
            'Diakonia' => 'Diakonia',
            'Nyinginezo' => 'Nyinginezo',
        ];
    }
}
