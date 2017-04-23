<?php

namespace Irma;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * Irma\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $irma_user
 * @property string $irma_pw
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereIrmaPw($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereIrmaUser($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Irma\User whereUpdatedAt($value)
 * @method static \Irma\User create(array $values)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'irma_user',
        'irma_pw',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'irma_pw',
        'calendar_token',
    ];

    /**
     * Describe relation to member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'irma_user', 'irma_id');
    }

    /**
     * Register a callback for default values.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $model) {
            $model->generateCalendarToken();
        });
    }

    /**
     * Generates a random token for the calendar.
     *
     * @return void
     */
    protected function generateCalendarToken()
    {
        $this->attributes['calendar_token'] = str_random(64);
    }


    /**
     * Pw Mutator
     *
     * @param string $string
     *
     * @return string
     */
    public function getIrmaPwAttribute(string $string): string
    {
        return \Crypt::decryptString($string);
    }

    /**
     * Pw Mutator
     *
     * @param string $string
     *
     * @return void
     */
    public function setIrmaPwAttribute(string $string)
    {
        $this->attributes['irma_pw'] = \Crypt::encryptString($string);
    }
}
