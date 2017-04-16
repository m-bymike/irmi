<?php

namespace Irma;

use Illuminate\Database\Eloquent\Model;

/**
 * Irma\Aircraft
 *
 * @property int $id
 * @property string $callsign
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Irma\Aircraft whereCallsign($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Aircraft whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Aircraft whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Aircraft whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\Aircraft whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Aircraft extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'callsign',
        'type',
    ];
}
