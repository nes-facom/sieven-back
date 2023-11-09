<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="display-4 text-center text-primary">
                <i class="bi bi-check-circle"></i>
                Sua inscrição foi confirmada!
            </h1>
        </div>

        <div class="content">
            <p class="lead text-center text-success">
                <strong>Evento:</strong> {{ $evento->nome }} - {{ $atividade->nome }}
            </p>
            <p class="lead text-center text-success">
                <strong>Data:</strong> {{ $atividade->horario_inicio }}
            </p>
            <p class="lead text-center text-success">
                <strong>Horário:</strong> {{ $atividade->horario_inicio }}h
            </p>
            <p class="lead text-center text-success">
                <strong>Local:</strong> {{ $atividade->local }} | {{ $evento->local }}
            </p>

            <img src=" {{ asset('caminho/para/sua/logo.png') }}" alt="Logo do Sistema" class="img-fluid mx-auto d-block">

            <p class="lead text-center text-success">
                <strong>Participante:</strong> {{ $inscricao->nome }}
            </p>
            <p class="lead text-center text-success">
                <strong>Atividade:</strong> {{ $atividade->nome }}
            </p>
            <p class="lead text-center text-success">
                <strong><i class="bi bi-calendar-day"></i> Data:</strong> {{ $atividade->horario_inicio }}
            </p>
            <p class="lead text-center text-success">
                <strong>Local:</strong> {{ $evento->local }} | {{ $atividade->local2 }}
            </p>
            <img src=" {{ $image }}" alt="QR Code" class="img-fluid mx-auto d-block">

            <div class="text-center">
                <a href="#" class="btn btn-primary btn-lg">
                    <i class="bi bi-link"></i> Acessar informações
                </a>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: sans-serif;
            font-size: 16px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            border-radius: 5px;
        }

        .content {
            padding: 20px 0;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .text-primary {
            color: #007bff;
        }

        .text-success {
            color: #28a745;
        }

        .img-fluid:hover {
            box-shadow: 0 0 10px 0 #007bff;
        }
    </style>
</body>
</html>