<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:settings',
            'display_name' => 'required',
            'type' => 'required',
        ]);

        $setting = new Setting();
        $setting->key = 'site.' . $request->key;
        $setting->display_name = $request->display_name;
        $setting->type = $request->type;
        $setting->save();

        return redirect()->route('settings.index')->with('success', 'Parámetro creado exitosamente');
    }

    // Almacenar los datos de los parámetros
    public function storeValues(Request $request)
    {

        foreach ($request->except('_token') as $key => $parametro) {

            if (!empty($parametro)) {
                $setting = Setting::find($key);
                if ($setting->type == 'image') {
                    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
                    $typeImage  = $request->{$key}->getClientOriginalExtension();
                    $isImage    = in_array($typeImage, $extensions);
                    if ($isImage) {
                        if (!empty($setting->value)) {
                            if (Storage::disk('public')->exists($setting->value)) {
                                Storage::disk('public')->delete($setting->value);
                            }
                        }
                        $imageName = \Str::random(20) . '.' . $request->{$key}->extension();
                        $request->file($key)->storeAS('public/settings/images', $imageName);
                        $parametro = 'settings\\images\\' . $imageName;
                    } else {
                        $parametro = $setting->value;
                    }
                }
                $setting->value = $parametro;
                $setting->save();
            }
        }
        \Artisan::call('view:clear');
        return redirect()->back()->with('success', 'Parámetros actualizados exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::find($id);
        if ($setting->type == 'image' && !empty($setting->value)) {
            if (Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
        }
        $setting->delete();
        return redirect()->back()->with('success', 'Parámetro eliminado');
    }
}
