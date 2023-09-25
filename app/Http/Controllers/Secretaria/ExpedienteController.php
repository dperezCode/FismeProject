<?php

namespace App\Http\Controllers\Secretaria;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Expediente;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{

    public function index()
    {
        $area_id = Auth::user()->secretaria->area->id;

        if ($area_id == 5) {
            $expedientes = Expediente::latest()->paginate(5);
        } else {
            $expedientes = Expediente::where('area_id', $area_id)->paginate(5);
        }

        $areas = Area::all();

        return view('secretaria.expediente.index', compact('expedientes','areas'));
    }

    public function verPDF(String $name)
    {
        $filePath = 'documentos/' . $name;


        if (Storage::disk('public')->exists($filePath)) {

            $pdfPath = Storage::disk('public')->path($filePath);

            return response()->file($pdfPath);
        } else {
            return redirect()->back()->withErrors(['El archivo PDF no existe.']);
        }
    }

    public function atenderExpediente(Expediente $expediente)
    {
        return view('secretaria.expediente.atender', compact('expediente'));
    }

    public function addHistorialExpediente(Request $request, Expediente $expediente)
    {
        $request->validate([
            'descripcion' => 'required|max:255',
            'documento' => 'nullable|mimes:pdf'
        ]);

        //dd($request);
        $fecha_hora = Carbon::now()->toDateTimeString();
        $user_id = Auth::id();

        //Manejo del archivo
        if ($request->exists('documento')) {
            $uploadedFile = $request->file('documento');
            $uniqueFileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->storeAs('documentos', $uniqueFileName);
        } else {
            $uniqueFileName = null;
        }

        $request->merge(['fecha_hora' => $fecha_hora, 'user_id' => $user_id, 'documento_adjunto' => $uniqueFileName]);


        try {
            DB::beginTransaction();
            $expediente->estado = 'en revision';
            $expediente->save();
            $expediente->historiales()->create($request->except('documento'));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expediente.atender', ['expediente' => $expediente])->with('status', 'historial-stored');
    }

    public function cambiarEstadoExpediente(Request $request, String $id)
    {
        //dd($request->estado);
        $expediente = Expediente::find($id);
        try {
            DB::beginTransaction();
            $expediente->estado = $request->estado;
            $expediente->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Estado actualizado');
    }

    public function derivarAreaExpediente(Request $request, String $id)
    {
        $area = Area::where('id',$request->area_id)->first();
        $expediente = Expediente::find($id);

        try {
            DB::beginTransaction();
            //Actualizar area del expediente
            $expediente->area_id = $request->area_id;
            $expediente->save();

            //Crear un historial
            $fecha_hora = Carbon::now()->toDateTimeString();
            $descripcion = Auth::user()->name. ' ha derivado el expediente al área de '. $area->nombre;
            $user_id = Auth::id();

            $expediente->historiales()->create([
                'fecha_hora' => $fecha_hora,
                'descripcion' => $descripcion,
                'user_id' => $user_id
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('secretaria.expedientes.index')->with('success', 'Derivación exitosa');
    }
}