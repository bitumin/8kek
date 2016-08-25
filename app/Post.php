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
        $viewsDirection = $reverse ? 'asc' : 'desc';

        if ($since === 'all-time') {
            return $query
                ->orderBy('views', $viewsDirection)
                ->latest();
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
                ->orderBy('views', $viewsDirection)
                ->latest();
        }
    }

    /**
     * Scope a query to only include ... posts.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePraised($query, $since, $reverse = false)
    {
        $ratio = '*, IF(down=0,up,up/down) AS ratio';
        $ratioDirection = $reverse ? 'asc' : 'desc';
        $upDirection = $ratioDirection;

        if ($since === 'all-time') {
            return $query
                ->selectRaw($ratio)
                ->orderBy('ratio', $ratioDirection)
                ->orderBy('up', $upDirection);
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
                ->orderBy('ratio', $ratioDirection)
                ->orderBy('up', $upDirection);
        }
    }

    /**
     * Scope a query to only include ... posts.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeControversial($query, $since)
    {
        $ratio = '*, ABS(LOG(up/down)) AS rank';

        if ($since === 'all-time') {
            return $query
                ->selectRaw($ratio)
                ->orderBy('rank', 'asc')
                ->orderBy('up', 'desc');
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
                ->orderBy('rank', 'asc')
                ->orderBy('up', 'desc');
        }
    }

}
