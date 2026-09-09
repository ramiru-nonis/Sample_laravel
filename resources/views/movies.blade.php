<!DOCTYPE html>
<html>

<head>
    <title>Movie List</title>
</head>

<body>
    <h1>Available Movies</h1>
    <ul>
        @foreach($movies as $movie)
        <li>{{ $movie }}</li>
        @endforeach
    </ul>
</body>

</html>