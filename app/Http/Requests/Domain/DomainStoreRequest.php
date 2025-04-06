<?php

namespace App\Http\Requests\Domain;

use App\Services\Domain\Dto\DomainDto;
use Illuminate\Foundation\Http\FormRequest;

class DomainStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'domain' => 'required|string|max:255|unique:domains,domain',
        ];
    }

    /**
     * Prepare the data for the DTO.
     *
     * @return DomainDto
     */
    public function toDto(): DomainDto
    {
        return new DomainDto(
            $this->get('domain'),
        );
    }
}
