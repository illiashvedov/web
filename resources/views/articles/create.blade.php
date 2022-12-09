<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Article</title>
</head>
<body>
<h1>articles form</h1>
<form action="/articles" method="post">
    @csrf
    <label for="text-input">Text</label>
    <input type="text" name="text" id="text-input">
    <label>
        Short Text
        <input type="text" name="short_text" id="short-text-input">
    </label>
    <label>
        Author Name
        <input type="text" name="author_name" id="autho-name-input">
    </label>
    <button type="submit">Submit</button>
</form>
</body>
</html>
