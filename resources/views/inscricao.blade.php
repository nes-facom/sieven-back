<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
            <div class="header">
                <p>Sua inscrição foi confirmada!</p>
                <br>
                <p>Evento: <strong>{{ $evento->nome }} - {{ $atividade->nome }}</strong></p>
                <p>Data: <strong>{{ $atividade->horario_inicio }}</strong></p>
                <p>Horário: <strong>{{ $atividade->horario_inicio }}h</strong> | <strong>{{ $atividade->horario_inicio }}h</strong></p>
                <p>Local: <strong>{{ $atividade->local }} | {{ $evento->local }}</strong></p>
            </div>

            <div class="container-card">
                <div class="card">
                    <div class="card-header">
                        <!-- Adicionar aqui a imagme do Sieven centralizada no card -->
                        <img src="https://res.cloudinary.com/dzgahmu0x/image/upload/v1699623778/ehhu8ogwapqqeiqigqql.png" alt="">
                        <h3>Seu Ingresso !</h3>
                    </div>
                    <div class="card-info">
                        <hr>
                        <p><strong>Participante: </strong>{{ $inscricao->nome }}</p>
                        <hr>
                        <p><strong>Atividade: </strong>{{ $atividade->horario_inicio }}</p>
                        <hr>
                        <p><strong>Horário: </strong>{{ $atividade->horario_inicio }}h</p>
                        <hr>
                        <p><strong>Local: </strong>{{ $atividade->local }} | {{ $evento->local }}</p>
                        <hr>
                        <!-- QR Code inserido aqui -->
                        <div class="qr-code">
                            <img style="" src="{{ $image }}" alt="QR-Code">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>

<style>
    .container-card {
        display: flex;
        justify-content: center;
        
    }

    .card-info {
        text-align: left;
        margin-left: 5%;
        margin-right: 5%;
        margin-bottom: 63px;
        margin-top: 10px;
        display: block;
        align-items: center;
    }

    .card {
        border-radius: 5px;
        border: 1px solid #FFF;
        background: #FFF;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        max-width: 100%;
        /* margin: 5rem */
    }

    .card-header {
        text-align: center;
        display: block;
        justify-content: center;
    }

    .card-info p {
        margin-top: 28px;
        margin-bottom: 28px;
        color: #404040;
        font-family: Roboto Condensed;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    .card-header h3 {
        margin-bottom: 32px;
        color: #50525F;
        text-align: center;
        font-family: Roboto;
        font-size: 24px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    .header p {
        color: #000;
        font-family: Roboto;
        font-style: normal;
        font-weight: 400;
        line-height: 30%; /* 30.936px */
        letter-spacing: 0.193px;
    }

    hr{
        opacity: 0.2;
    }

    .card-header img {
        width: 20%;
        height: 20%;
    }

    .qr-code {
        display: flex;
        justify-content: center;
        margin-top: 33px;
        margin-bottom: 33px;
    }

    .qr-code img{
        height: 300px;
        width: 300px;
    }
</style>