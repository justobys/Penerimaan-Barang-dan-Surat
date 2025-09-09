<?php
namespace App\Helpers;

class WAGatewayHelper
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->apiKey = 'hJHbdfkdtUecrM_9ii_X';
        $this->apiUrl = 'https://api.fonnte.com/send';
    }

    public function kirimPesan($nomorTujuan, $pesan)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $nomorTujuan,
                'message' => $pesan,
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->apiKey
            ),
        ),
        );

        $response = curl_exec($curl);
        $error = null;

        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        curl_close($curl);

        return [
            'response' => json_decode($response, true),
            'error' => $error
        ];
    }

    public function kirimPesanDenganFoto($nomorTujuan, $pesan, $fotoPath)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $nomorTujuan,
                'message' => $pesan,
                'image' => curl_file_create($fotoPath)
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->apiKey
            ),
        ),
        );

        $response = curl_exec($curl);
        $error = null;

        if (curl_errno($curl)) {
            $error = curl_error($curl);
        }

        curl_close($curl);

        return [
            'response' => json_decode($response, true),
            'error' => $error
        ];
    }
}