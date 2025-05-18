<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Winata\PackageBased\Abstracts\BaseAction;
use Winata\PackageBased\Concerns\ValidationInput;

class CreateUser extends BaseAction
{
    use ValidationInput;

    public function __construct(
        public array $inputs,
        bool $usingDBTransaction = false
    )
    {
        parent::__construct($usingDBTransaction);
    }

    /**
     * @return BaseAction
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function rules(): BaseAction
    {
        $this->validate(
            inputs: $this->inputs,
            rules: [
                'name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]
        );

        return $this;
    }

    /**
     * @return mixed
     */
    public function handle(): mixed
    {
        $input = User::getFillableAttribute($this->validatedData);
        return User::query()->create($input);
    }
}
