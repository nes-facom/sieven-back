@component('mail::message')
<h1 style="text-align: center;">Seu Evento foi Alterado</h1>
<br><br>    
<h3>Prezado, (Nome do Aluno)</h3>
<p>O evento {{$nome_evento}} sofreu alterações. Acesse o SIEVEN para verificar o que foi alterado.</p>
<p>Atenciosamente, Equipe Sieven.</p>
@component('mail::button', ['url' => 'https://Sieven.com.br'])
    Sieven
@endcomponent 
@endcomponent