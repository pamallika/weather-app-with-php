<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Weather</title>
</head>
<body>
<?php
    $city=htmlspecialchars($_POST['city']);
    $url='http://api.openweathermap.org/data/2.5/weather';
    $options=array(
        'q'=>$city,
        'APPID'=>'af8391a0c580c86280d9f069d211261e',
        'units'=>'metric',
        'lang'=> 'en'
    );
    $ch= curl_init();
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_URL,$url.'?'.http_build_query($options));
    $response = curl_exec($ch);
    $data=json_decode($response,true);
    curl_close($ch);

    $sys=$data['sys'];
    $country=$sys['country'];
    $cityName=$data['name'];
    $main=$data['main'];
    $temp=$main['temp'];

?>
<div class="main">
        <div class="text">
            <h2>Погода</h2>
            <p>Узнайте погоду в своём городе</p>
        </div>
        <div class="form">
            <form  method="POST">
                <input type="text" name="city" placeholder="Введите город" >
                <button type="submit">Узнать погоду</button>
                <div class="content">
                <p>Местоположение:<?php echo $country,",", $cityName?></p>
                <p>Темпераура:<?php echo $temp,"&#8451;";?> </p>
                </form>
        </div>

        </div>
      </div>
</body>
</html>