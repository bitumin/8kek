<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'post_id', 'user_id', 'comment'];

    /**
     * relation to table users
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * relation to table posts
     * @return relation
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    /**
     * relation to table comments
     * @return relation
     */
    public function comment()
    {
        return $this->belongsTo('App\Comment', 'comment_id');
    }
}
