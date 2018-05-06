<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #111;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #111;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .header {
        }

        .container {
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h2>Relatório de atendimento</h2>
        </div>
        <div>
            Data da geração: {{ date('d/m/Y') }}
        </div>
    </div>
    <hr>
    <div class="flex-center position-ref">
        <table>
            <thead>
                <tr>
                    <th>ID do atendimento</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>  
</div>
</body>
</html>