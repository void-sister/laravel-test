<?php

namespace App\Services\Domain\Exceptions;

use Illuminate\Validation\ValidationException;

class DomainAlreadyExistsException extends ValidationException {}
