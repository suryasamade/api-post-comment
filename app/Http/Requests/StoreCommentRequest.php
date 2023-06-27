<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function validationData()
    {
        return array_merge($this->request->all(), [
            'postId' => $this->route('postId')
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $post_id = $this->route('postId');

        return [
            'message' => 'required',
            'post_id' => 'required' . $this->route('postId')
        ];
    }
}
