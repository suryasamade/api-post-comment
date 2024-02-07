<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *     @OA\Schema(
 *          schema="Comment",
 *          required={"id", "message", "post_id"},
 *          @OA\Property(
 *              property="id",
 *              type="integer",
 *              format="int64",
 *              description="Comment ID",
 *              example=27
 *          ),
 *          @OA\Property(
 *              property="message",
 *              type="string",
 *              description="Message of the comment",
 *              example="Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores quod sequi et modi."
 *          ),
 *          @OA\Property(
 *              property="post_id",
 *              type="integer",
 *              format="int64",
 *              description="Post ID of the comment",
 *              example=10
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
 *      )
 */

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'post_id'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
