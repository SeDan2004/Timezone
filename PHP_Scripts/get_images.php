<?php

require_once('../phpQuery/phpQuery.php');

$s = curl_init();
//curl_setopt($s, CURLOPT_URL, 'https://www.alltime.ru/watch/filter/brand:casio/collection:g_shock/?utm_source=yandex&utm_medium=cpc&utm_campaign=Moskva%7CPoisk%7CVendor%7CNarychnie_chasi%7CCasio_G_Shock_new&utm_content=9411690174&utm_term=ST%3Asearch%7CS%3Anone%7CAP%3Ano%7CPT%3Apremium%7CP%3A3%7CDT%3Adesktop%7CRI%3A213%7CCI%3A53770990%7CGI%3A4260193361%7CPI%3A21499712210%7CAI%3A9411690174%7CKW%3Acasio%20g%20shock&yclid=5405860491742991493');
curl_setopt($s, CURLOPT_URL, 'https://yandex.ru');
curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
$out = curl_exec($s);

curl_close($s);
// file_put_contents('result', $out);

$doc = phpQuery::newDocument($out);
//var_dump($doc);

$elem = $doc->find('.weather__temp');

var_dump($elem);

/* function get_images($arg)
{

  $str = 'C:\Users\18107\Downloads';
  $download_dir = scandir($str);
  $Clock_arr = [];


  for ($i = 0; $i < count($download_dir); $i++)
  {

    if (strstr($download_dir[$i], $arg))
    {

      if (strstr($download_dir[$i], '.jpg'))
      {

        echo $str . '\\' . $download_dir[$i]; 
        echo $_SERVER['DOCUMENT_ROOT'] . '\\IconAndImages\\' . $download_dir[$i];

      }

    }

  }

}

get_images('G-Shock'); */

?>