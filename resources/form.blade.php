<form action="/form" method="post">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
    </div>
    @if ($errors->all() as $error)
    <div>
        <ul>
            <li>{{ $error }}</li>
        </ul>
    </div>
    @endforeach

    <button type="submit">Submit</button>
</form>