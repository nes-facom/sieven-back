<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição</title>

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

        .logo {
            width: 100px;
            height: 100px;
        }

        .qr-code {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sua inscrição foi confirmada!</h1>
        </div>

        <div class="content">
            <p>
                <strong>Evento:</strong> {{ $inscricao->nome }}
            </p>
            <p>
                <strong>Data:</strong> {{ $inscricao->data }}
            </p>
            <p>
                <strong>Horário:</strong> {{ $inscricao->horario }}
            </p>
            <p>
                <strong>Local:</strong> {{ $inscricao->local }} | {{ $inscricao->local2 }}
            </p>

            <img src=" {{ asset('caminho/para/sua/logo.png') }}" alt="Logo do Sistema" class="logo">

            <p>
                <strong>Participante:</strong> {{ $inscricao->nome }}
            </p>
            <p>
                <strong>Atividade:</strong> {{ $inscricao->atividade }}
            </p>
            <p>
                <strong><img src="{{ asset('caminho/para/icon/calendario.png') }}" alt="Ícone de Calendário"> Data:</strong> {{ $inscricao->data }}  {{ $inscricao->horario }} - {{ $inscricao->horario2 }}
            </p>
            <p>
                <strong>Local:</strong> {{ $inscricao->local }} | {{ $inscricao->local2 }}
            </p>
            <img src=" {{ $image }}" alt="QR Code" class="qr-code">
        </div>
    </div>
</body>
</html>