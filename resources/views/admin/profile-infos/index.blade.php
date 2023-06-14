<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    index

    qui puoi:<br>
    <a href="{{route('admin.profile-infos.show', $profileInfoItem->slug)}}">mostrare i dati del tuo profilo(show)</a><br>
    <a href="">modificare i dati del tuo profilo(edit)</a><br>
    <a href="">eliminare i dati del tuo profilo(delete)</a>
</body>
</html>