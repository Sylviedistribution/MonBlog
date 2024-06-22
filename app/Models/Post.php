<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable =['titre','slug','contenu','categorie','imagePath','user_id'];

    // Indiquez que le champ 'comments' doit être traité comme un tableau
    protected $casts = [
        'comments' => 'array',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }


    public function imageUrl(): string {
        //Generer l'url de l'image
        return Storage::url($this->imagePath);
    }

}
