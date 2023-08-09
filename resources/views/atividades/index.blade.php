<!-- resources/views/atividades/index.blade.php -->

<h1>Atividades</h1>

@if($atividades->isEmpty())
    <p>Atividades não encontradas.</p>

@else
    @foreach($atividades as $atividade)
    <li>
        {{
            'evento_id: ' . $atividade->evento_id . ', ' .
            'nome: ' . $atividade->nome . ', ' .
            'descricao: ' . $atividade->descricao . ', ' .
            'endereco: ' . $atividade->endereco . ', ' .
            'modalidade: ' . $atividade->modalidade . ', ' .
            'quantidade_vagas: ' . $atividade->quantidade_vagas . ', ' .
            'horario_inicio: ' . $atividade->horario_inicio . ', ' .
            'horario_encerramento: ' . $atividade->horario_encerramento . ', ' .
            'requisitos: ' . $atividade->requisitos . ', ' .
            'acessibilidade: ' . $atividade->acessibilidade . ', ' .
            'link_atividade: ' . $atividade->link_atividade . ', ' .
            'situacao: ' . $atividade->situacao . ', ' .
            'created_at: ' . $atividade->created_at . ', ' .
            'updated_at: ' . $atividade->updated_at
        }}
    </li>
@endforeach