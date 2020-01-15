<?php
$id_product = $_GET['id_product'];

function ajax($url, $params)
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false,    // Disabled SSL Cert checks
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $params,
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch);
    $header  = curl_getinfo($ch);
    curl_close($ch);

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header['content'];
}

$data = ajax($apiUrl . '/category/info', array('id_product' => $id_product, 'Authorization' => $token));
$data = json_decode($data);
print_r($data);
$data = $data->data;
$data = json_decode($data);
$data = $data[0];
?>
<!-- <script>
</script> -->
<div class="form-group" style="text-align:center;">
    <div style="margin-bottom:40px;" data-id="' + data.data[i].name + '"></div>
    <div style="display:flex;justify-content:space-around;">
        <button class="btn home-btn btn-warning delete-catagory">Да</button>
        <button class="btn home-btn btn-warning not-delete-catagory">Нет</button>
    </div>
</div>