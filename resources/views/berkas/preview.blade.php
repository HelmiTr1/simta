<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>SIMTA | {{Auth::user()->username}} </title>
</head>
<body>
<iframe src="{{url('storage').'/'.$berkas}}" type="application/pdf" width="100%" height="630"></iframe>
</body>
</html>