<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *     @OA\Schema(
 *          schema="Post",
 *          required={"id", "title", "text"},
 *          @OA\Property(
 *              property="id",
 *              type="integer",
 *              format="int64",
 *              description="Post ID",
 *              example=10
 *          ),
 *          @OA\Property(
 *              property="title",
 *              type="string",
 *              description="Title of the post",
 *              example="Run in the rain"
 *          ),
 *          @OA\Property(
 *              property="text",
 *              type="string",
 *              description="Content or text of the post",
 *              example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur nostrum nam unde praesentium officia, minus, adipisci expedita nulla, similique eum voluptas. Ea, debitis."
 *          ),
 *          @OA\Property(
 *              property="created_at",
 *              type="string",
 *              format="date-time",
 *              description="Date time of the post creation",
 *              example="2023-12-21 13:08:19"
 *          ),
 *          @OA\Property(
 *              property="updated_at",
 *              type="string",
 *              format="date-time",
 *              description="Date time of post updating",
 *              example="2023-12-21 13:08:19"
 *          ),
 *      ),
 */

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
