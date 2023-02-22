<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ALERTA</title>
</head>
<body style=" padding-top: 10px; padding-bottom: 10px; text-align: center;">

	<div style="margin-right: 25%; margin-left: 25%; margin-top: 20px; margin-bottom:20px; border-radius: 10px; background-color: white;">

		<div style="margin-bottom: 20px; text-align: center; font-weight: 35px;  width: 100%; font-family: 'Avant Garde', Avantgarde, 'Century Gothic', CenturyGothic, 'AppleGothic', sans-serif;font-size: 20px;">
			<label>{{$datos}}</label><br>
		</div>
		<br>
		<br>
		<div style="margin-bottom: 20px; text-align: center;">
			<a href="{{url('/')}}/{{$ruta}}" style="border-radius: 10px; text-decoration: none; font-size: 35px; background-color: #B5E4C9; color: black; width: 100%; padding: 15px;">
				Ir al {{$modulo}}
			</a>
		</div>
		<br><br>
	</div>
</body>
</html>