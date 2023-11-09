<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Inscrição</title>
</head>
<body>
    <div style="text-align: center;">
        <h1>Sua inscrição foi confirmada!</h1>
        <p>
            <strong>Evento:</strong> {{ $inscricao->nome }}<br>
            <strong>Data:</strong> {{ $inscricao->nome }}<br>
            <strong>Horário:</strong> {{ $inscricao->nome }}<br>
            <strong>Local:</strong> {{ $inscricao->nome }} | {{ $inscricao->nome }}
        </p>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <img src="{{ asset('caminho/para/sua/logo.png') }}" alt="Logo do Sistema" style="width: 100px; height: 100px;">

        <h2>Seu ingresso!</h2>

        <hr>

        <p>
            <strong>Participante:</strong> {{ $inscricao->nome }}<br>
            <strong>Atividade:</strong> {{ $inscricao->nome }}<br>
            <strong><img src="{{ asset('caminho/para/icon/calendario.png') }}" alt="Ícone de Calendário"> Data:</strong> {{ $inscricao->nome }}  {{ $inscricao->nome }} - {{ $inscricao->nome }}<br>
            <strong>Local:</strong> {{ $inscricao->nome }} | {{ $inscricao->nome }}
            <img src="{!!$message->embedData(QrCode::format('png')->generate('$qrCode'), 'QrCode.png', 'image/png')!!}">
        </p>
        
        <hr>
        
        <!-- Adicione mais elementos conforme necessário -->
    </div>
</body>
</html>