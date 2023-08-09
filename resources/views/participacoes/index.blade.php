<!-- resources/views/participacoes/index.blade.php -->

<h1>Participacoes</h1>

@if($participacoes->isEmpty())
    <p>Participacoes/Inscrições não encontradas.</p>
@else
    <ul>
        @foreach($participacoes as $participacao)
            <li>
                {{
                    'user_id: ' . $participacao->user_id . ', ' .
                    'atividade_id: ' . $participacao->atividade_id . ', ' .
                    'situacao: ' . $participacao->situacao . ', ' .
                    'created_at: ' . $participacao->created_at . ', ' .
                    'updated_at: ' . $participacao->updated_at
                }}
            </li>
        @endforeach
    </ul>
@endif
