<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySpecialtyRequest;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Models\Specialty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialtiesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::all();

        return view('admin.specialties.index', compact('specialties'));
    }

    public function create()
    {
        abort_if(Gate::denies('specialty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.create');
    }

    public function store(StoreSpecialtyRequest $request)
    {
        $specialty = Specialty::create($request->all());

        return redirect()->route('admin.specialties.index');
    }

    public function edit(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(UpdateSpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());

        return redirect()->route('admin.specialties.index');
    }

    public function show(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialties.show', compact('specialty'));
    }

    public function destroy(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialty->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecialtyRequest $request)
    {
        Specialty::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
