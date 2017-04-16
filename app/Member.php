<?php

namespace Irma;

use Illuminate\Database\Eloquent\Model;

/**
 * Irma\Member
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $irma_id
 * @property string $last_name
 * @property string $first_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read Reservation[] $reservations
 *
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereIrmaId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Member whereUserId($value)
 */
class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'irma_id',
        'first_name',
        'last_name',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'member_id');
    }
}
