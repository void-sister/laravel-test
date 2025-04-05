<?php

namespace App\Http\Requests\User;

use App\Services\User\Dto\UserSearchDto;
use App\Services\User\UserService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        return $user && $user->isAdmin();
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @throws HttpResponseException
     */
    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            Redirect::route('dashboard')->with('error', 'You are not authorized to view this page.')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'sort_by' => 'nullable|string|in:id,name,email,plan_id,created_at',
            'sort_direction' => 'nullable|string|in:asc,desc',
            'search' => 'nullable|string|min:3|max:255',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }

    /**
     * Prepare the data for the DTO.
     *
     * @return UserSearchDto
     */
    public function toDto(): UserSearchDto
    {
        return new UserSearchDto(
            $this->get('sort_by', 'created_at'),
            $this->get('sort_direction', 'desc'),
            $this->get('search', null),
            $this->get('per_page', UserService::DEFAULT_PER_PAGE)
        );
    }
}
