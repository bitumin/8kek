<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];

    /**
     * Scope a query to only include ... posts.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query, $since, $reverse = false)
    {
        $order = $reverse ? 'asc' : 'desc';

        if ($since === 'all-time') {
            return $query
                ->orderBy('views', $order);
        } else {
            $todayDt = new Carbon();

            switch ($since) {
                case 'last-year':
                    $sinceDt = $todayDt->subYear();
                    break;
                case 'last-month':
                    $sinceDt = $todayDt->subMonth();
                    break;
                case 'last-week':
                default:
                    $sinceDt = $todayDt->subWeek();
                    break;
            }

            return $query
                ->where('created_at', '>', $sinceDt)
                ->orderBy('views', $order);
        }
    }

    /**
     * Scope a query to only include ... posts.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePraised($query, $since, $reverse = false)
    {
        $order = $reverse ? 'asc' : 'desc';
        $ratio = '*, up/(down+1) AS ratio';

        if ($since === 'all-time') {
            return $query
                ->selectRaw($ratio)
                ->orderBy('ratio', $order);
        } else {
            $todayDt = new Carbon();

            switch ($since) {
                case 'last-year':
                    $sinceDt = $todayDt->subYear();
                    break;
                case 'last-month':
                    $sinceDt = $todayDt->subMonth();
                    break;
                case 'last-week':
                default:
                    $sinceDt = $todayDt->subWeek();
                    break;
            }

            return $query
                ->selectRaw($ratio)
                ->where('created_at', '>', $sinceDt)
                ->orderBy('ratio', $order);
        }
    }

    /**
     * Scope a query to only include ... posts.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeControversial($query, $since)
    {
        $ratio = '*, ABS(1.0 - up/(down+1)) AS rank';

        if ($since === 'all-time') {
            return $query
                ->selectRaw($ratio)
                ->orderByRaw('rank', 'asc');
        } else {
            $todayDt = new Carbon();

            switch ($since) {
                case 'last-year':
                    $sinceDt = $todayDt->subYear();
                    break;
                case 'last-month':
                    $sinceDt = $todayDt->subMonth();
                    break;
                case 'last-week':
                default:
                    $sinceDt = $todayDt->subWeek();
                    break;
            }

            return $query
                ->selectRaw($ratio)
                ->where('created_at', '>', $sinceDt)
                ->orderBy('rank', 'asc');
        }
    }

}
