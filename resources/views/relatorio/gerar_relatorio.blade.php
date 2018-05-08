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

        table td,
            table th {
                padding:5px;
                border:1px solid #fff;
                border-width:0 1px 1px 0;
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
            <strong>Periodicidade:</strong> de {{ date('d/m/Y', strtotime($relatorio['filtro']['data_de'])) }} até {{ date('d/m/Y', strtotime($relatorio['filtro']['data_ate'])) }}
            
        </div>
    </div>
    <hr>
    <div>
        <table>
            <thead>
                <tr>
                    <th style="width: 200px;">ID do atendimento</th>
                    <th style="width: 200px;">Data de inicio</th>
                    <th style="width: 100px;">Qnt. de interações</th>
                    <th style="width: 100px;">Duração da interação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($relatorio['atendimentos'] as $atendimento)
                    <tr>
                        <td>{{ $atendimento['ID'] }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($atendimento['DATA_CRIACAO'])) }}</td>
                        <td>{{ count($atendimento['atendimento_has_pergunta']) + count($atendimento['atendimento_has_resposta']) }}</td>
                        <td>{{ $atendimento['DURACAO_ATENDIMENTO'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div>
        <h2>Detalhes</h2>
        <div>
            <div>
                <strong>Quantidade de atendimentos:</strong> {{ count($relatorio['atendimentos']) }}
            </div>
            <div>
                <strong>Quantidade de atendimentos resolvidos na pelo chatbot na primeira tentativa: </strong> {{ $relatorio['quantidade_atendimentos']['1_tentativas'] }}
            </div>
            <div>
                <strong>Quantidade de atendimentos resolvidos na pelo chatbot na segunda tentativa: </strong> {{ $relatorio['quantidade_atendimentos']['2_tentativas'] }}
            </div>
            <div>
                <strong>Quantidade de atendimentos resolvidos na pelo chatbot na terceira tentativa: </strong> {{ $relatorio['quantidade_atendimentos']['3_tentativas'] }}
            </div>
            <div>
                <strong>Quantidade de atendimentos encaminhado para atendimento humano: </strong> {{ $relatorio['quantidade_atendimentos']['encaminhamento_humano'] }} 
            </div>
        </div>
    </div>  
</div>
</body>
</html>