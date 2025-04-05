<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserIndexRequest;
use App\Services\User\UserService;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService = new UserService(),
    )
    {
    }

    /**
     * Display a listing of the users.
     *
     * @param UserIndexRequest $request
     * @return View
     */
    public function index(UserIndexRequest $request): View
    {
        $users = $this->userService->getAllByDto($request->toDto());

        return view('user.index', compact('users'));
    }
}
