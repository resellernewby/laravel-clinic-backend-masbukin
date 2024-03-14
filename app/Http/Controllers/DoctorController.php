<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(Request $request)
    {        
        $doctors = DB::table('doctors')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('pages.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_name'=>'required',
            'doctor_email'=>'required|email',
            'doctor_phone'=>'required',
            'doctor_specialist' => 'required',
            'sip'=>'required',
        ]);

        $doctor = new Doctor();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->photo = $request->photo;
        $doctor->address = $request->address;
        $doctor->sip = $request->sip;
        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor successfully created');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('pages.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_name'=>'required',
            'doctor_email'=>'required|email',
            'doctor_phone'=>'required',
            'doctor_specialist' => 'required',
            'sip'=>'required',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->photo = $request->photo;
        $doctor->address = $request->address;
        $doctor->sip = $request->sip;

        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Doctor successfully updated');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor successfully deleted');
    }
}
