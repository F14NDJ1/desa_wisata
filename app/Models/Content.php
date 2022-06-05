<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Content extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(368)
    //         ->height(232)
    //         ->sharpen(10);
    // }

    protected $guarded = ['id'];
    protected $primaryKey = 'id';


    public function content_kind()
    {
        return $this->belongsTo(Content_kind::class, 'content_kind_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
