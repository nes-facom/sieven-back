@component('mail::message')
<h1>saiu um novo episódio</h1>

<h3>Hello Friend...</h3>

@component('mail::button', ['url' => 'https://google.com.br'])
    Google
@endcomponent 

<table style="width: 100%">
    <tr>
        <th>Id</th>
        <th>Nome</th>
    </tr>
    <?php
    foreach($atividades as $atividade){
    ?>
        <tr style="text-align: center">
            <td>{{$atividade->id}}</td>
            <td>{{$atividade->nome}}</td>
        </tr>
    <?php
    }
    ?>
</table>

<p>Seu nome é {{$user->name}}?</p>
@endcomponent