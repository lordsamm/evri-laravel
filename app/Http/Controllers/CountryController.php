<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index(): View
    {
        $countries = Country::query()
            ->latest()
            ->paginate(15);

        return view('countries.index', compact('countries'));
    }

    public function create(): View
    {
        return view('countries.create');
    }

    public function store(StoreCountryRequest $request): RedirectResponse
    {
        $country = Country::query()->create($request->validated());

        return redirect()
            ->route('admin.countries.show', $country)
            ->with('success', 'Country created successfully.');
    }

    public function show(Country $country): View
    {
        return view('countries.show', compact('country'));
    }

    public function edit(Country $country): View
    {
        return view('countries.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country): RedirectResponse
    {
        $country->update($request->validated());

        return redirect()
            ->route('admin.countries.show', $country)
            ->with('success', 'Country updated successfully.');
    }
}
