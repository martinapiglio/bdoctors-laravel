<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    show

    @if($profileInfo) 

    <div>
        {{ $profileInfo->slug }}
        {{ $profileInfo->phone_number }}
        {{ $profileInfo->user?->name }}
    </div>

    @else 

        <div>
            non hai aggiunto ancora nulla
        </div>
    
    @endif
</body>
</html>