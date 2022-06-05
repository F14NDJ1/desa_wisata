<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    // protected $fillable = [
    //             'name_content',
    //             'content_kind_id',
    //             'user_id',
    //             'url' ,
    //             'content' ,
    //             'thumbnail'
    // ];
        protected $guarded = ['id'];
    protected $primaryKey = 'id';


    public function content_kind ()
    {
        return $this->belongsTo(Content_kind::class, 'content_kind_id');
    }
    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
