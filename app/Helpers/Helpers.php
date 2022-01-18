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

function getCommunnes(){
    return \App\Region::find(env('REGION'))->communes->pluck('id')->toArray();
}

function getEstablecimmentsMyCommune() {
    return \App\Establishment::whereIn('commune_id', getCommunnes())->pluck('id');
}
