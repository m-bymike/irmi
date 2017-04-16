<?php

namespace Irma;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Irma\Reservation
 *
 * @property int    $id
 * @property int    $aircraft_id
 * @property Carbon $start
 * @property Carbon $end
 * @property string $remarks
 * @property int    $irma_id
 * @property string $irma_created
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int    $member_id
 * @property int    $type
 *
 * @property-read Aircraft $aircraft
 * @property-read Member $member
 *
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereAircraftId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereIrmaCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereIrmaId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Reservation whereType($value)
 *
 * @mixin \Eloquent
 */
class Reservation extends Model
{
    use SoftDeletes;


    const TYPE_RESERVATION = 1;
    const TYPE_WAITLIST = 2;
    const TYPE_BLOCKER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'irma_id',
        'aircraft_id',
        'start',
        'end',
        'member_id',
        'type',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getStartAttribute($value)
    {
        return Carbon::parse($value, 'UTC');
    }

    public function setStartAttribute(Carbon $value)
    {
        $this->attributes['start'] = $value->setTimezone('UTC')->toDateTimeString();
    }

    public function getEndAttribute($value)
    {
        return Carbon::parse($value, 'UTC');
    }

    public function setEndAttribute(Carbon $value)
    {
        $this->attributes['end'] = $value->setTimezone('UTC')->toDateTimeString();
    }
}
