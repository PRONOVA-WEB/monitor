<?php

if (!function_exists('settings')) {
    function settings($key = null)
    {
        $setting = optional(\App\Setting::where('key', $key)->first());
        if ($setting->value) {
            $valor = $setting->value;
            if ($setting->type == 'image' && \Storage::disk('public')->exists($setting->value)) {
                $valor = \Storage::disk('public')->url($setting->value);
            }
            return $valor;
        } else {
            return null;
        }
    }
}

function active($route_name)
{
    echo request()->routeIs($route_name) ? 'active' : '';
}

function getCommunes(){
    return \App\Region::find(env('REGION'))->communes->pluck('id')->toArray();
}

function getEstablishmentsMyCommune() {
    return \App\Establishment::whereIn('commune_id', getCommunes())->pluck('id');
}
