<?php

namespace NutriScore\Services;

use NutriScore\DataMappers\UserMapper;
use NutriScore\Utils\CSRFToken;
use NutriScore\Utils\Session;
use NutriScore\Validators\LoginValidator;
use NutriScore\Validators\ValidationObject;

final class LoginService {

    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly LoginValidator $validator,
    ) { }

    public function login(array $formInput): ValidationObject {
        $this->validator->validate($formInput);

        if ($this->validator->isValid()) {
            $user = $this->userMapper->findByUsername($formInput['username']);
            Session::set('id', $user->getId());
            CSRFToken::create();
        }
        return $this->validator->getValidationObject();
    }

}