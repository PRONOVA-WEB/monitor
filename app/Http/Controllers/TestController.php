<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fonasa()
    {
        $rut = 21097570;
        $dv  = 5;
        $wsdl = asset('ws/fonasa/CertificadorPrevisionalSoap.wsdl');

        $client = new \SoapClient($wsdl,array('trace'=>TRUE));
        $parameters = array(
            "query" => array(
                "queryTO" => array(
                    "tipoEmisor"  => 3,
                    "tipoUsuario" => 2
                ),
                "entidad"           => env('FONASA_ENTIDAD'),
                "claveEntidad"      => env('FONASA_CLAVE'),
                "rutBeneficiario"   => $rut,
                "dgvBeneficiario"   => $dv,
                "canal"             => 3
            )
        );

        $result = $client->getCertificadoPrevisional($parameters);

        if ($result === false) {
            /* No se conecta con el WS */
            $error = "No se pudo conectar a FONASA";
        }
        else {
            /* Si se conectó al WS */
            if($result->getCertificadoPrevisionalResult->replyTO->estado == 0) {
                /* Si no hay error en los datos enviados */
                //$certificado  = $result->getCertificadoPrevisionalResult;
                $beneficiario = $result->getCertificadoPrevisionalResult->beneficiarioTO;
                $afiliado     = $result->getCertificadoPrevisionalResult->afiliadoTO;

                $user['run']            = $beneficiario->rutbenef;
                $user['dv']             = $beneficiario->dgvbenef;
                $user['name']           = $beneficiario->nombres;
                $user['fathers_family'] = $beneficiario->apell1;
                $user['mothers_family'] = $beneficiario->apell2;
                $user['birthday']       = $beneficiario->fechaNacimiento;
                $user['gender']         = $beneficiario->generoDes;

                if($afiliado->desEstado == 'ACTIVO') {
                    $user['tramo'] = $afiliado->tramo;
                }
                else {
                    $user['tramo'] = null;
                }
                //$user['estado']         = $afiliado->desEstado;

            }
            else {
                /* Error */
                $error = $result->getCertificadoPrevisionalResult->replyTO->errorM;
            }
        }

        echo '<pre>';
        print_r($result);
        print_r(json_encode($user,JSON_UNESCAPED_UNICODE));
    }

    public function covidCases() {
        ini_set('max_execution_time', '360');

        $casos = [];

        if (($open = fopen('https://raw.githubusercontent.com/MinCiencia/Datos-COVID19/master/output/producto1/Covid-19_std.csv', "r")) !== FALSE) {

            while (($data = fgetcsv($open, 0, ",")) !== FALSE) {
                $casos[] = $data;
            }

            fclose($open);
        }

        // echo "<pre>";
        // dd(array_slice($casos, 1));
        \DB::table('minci_producto1_std')->delete();

        foreach (array_slice($casos, 1) as $item) {
            \App\MinciProducto1Std::create(
                [
                'region' => $item[0],
                'region_code' => $item[1],
                'commune' => $item[2],
                'commune_code' => $item[3],
                'population' => $item[4],
                'date' => $item[5],
                'commit_cases' => $item[6]
                ]
            );
        }

    }
}
