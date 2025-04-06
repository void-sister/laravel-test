<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Domain\DomainStoreRequest;
use App\Models\User;
use App\Services\Domain\DomainService;
use App\Services\Domain\Exceptions\DomainAlreadyExistsException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DomainService $domainService = new DomainService(),
    ) {
    }

    /**
     * Display the dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $domains = $this->domainService->getUserDomains($user);

        return view('dashboard.index', compact('domains'));
    }

    /**
     * Store a newly created domain in storage.
     *
     * @param DomainStoreRequest $request
     * @return RedirectResponse
     * @throws DomainAlreadyExistsException|ValidationException
     */
    public function store(DomainStoreRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $this->domainService->createForUser($request->toDto(), $user);

        return redirect()->route('dashboard')->with('success', 'Domain added successfully.');
    }
}
