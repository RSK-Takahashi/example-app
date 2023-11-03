<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        // 84-01
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 84-01
            'tweet' => 'required|max:140'
        ];
    }

    // 84-01
    public function tweet(): string
    {
        return $this->input('tweet');
    }

    // 90-12
    public function id(): int
    {
        return (int) $this->route('tweetId');
    }
}
