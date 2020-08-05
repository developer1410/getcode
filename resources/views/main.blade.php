<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">

    <title>Task 2</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .main {
            margin-top: 100px;
        }

        table {
            font-size: 14px;
        }

        table,
        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        .pagination {
            text-align: center;
        }

        .pagination li {
            display: inline-block;
            margin: 10px;
            font-size: 18px;
        }



        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px;
            color: grey;
        }

        header ul {
            padding: 10px;
        }

        header li {
            display: inline-block;
            margin: 0px 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/task1">Task 1</a></li>
            <li><a href="/">Import products</a></li>
            <li><a href="/products">Products list</a></li>
        </ul>
    </nav>
</header>
<div class="main">
    <div class="content">
        @yield('content')
    </div>
</div>
@stack('footerJS')

</body>
</html>
