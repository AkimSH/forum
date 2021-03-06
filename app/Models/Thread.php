<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{
    use HasFactory;
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot() // method where we can add global query scope
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope('replies_count', function ($builder) { //was replyCount
             $builder->withCount('replies');
        });

        /*static::addGlobalScope('creator', function ($builder) { // we can make it protcted property $with = ['creator'] in the top. But it would always fetch Thread with creator, in such approach we can use App\Thread::withoutGlobalScopes()->first(); to find without creator
             $builder->with('creator');
        });*/


        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });

        //Model events when new thread created it automaticly creates row in activity model
        //This was moved to RecordsActivity trait boot methods and do the same as this do
        /*static::created(function ($thread) {
            $thread->recordActivity('created');
        });*/
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function channel()
    {
       return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
