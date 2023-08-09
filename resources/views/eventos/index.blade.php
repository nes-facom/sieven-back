<!-- resources/views/eventos/index.blade.php -->

<h1>Eventos</h1>

@if($eventos->isEmpty())
    <p>Eventos não encontrados.</p>
@else
    <ul>
        @foreach($eventos as $evento)
            <li>
                {{
                    'nome: ' . $evento->nome . ', ' .
                    'descricao: ' . $evento->descricao . ', ' .
                    'local: ' . $evento->local . ', ' .
                    'categoria: ' . $evento->categoria . ', ' .
                    'data_inicial: ' . $evento->data_inicial . ', ' .
                    'data_final: ' . $evento->data_final . ', ' .
                    'created_by_user: ' . $evento->created_by_user . ', ' .
                    'situacao: ' . $evento->situacao . ', ' .
                    'created_at: ' . $evento->created_at . ', ' .
                    'updated_at: ' . $evento->updated_at
                }}
            </li>
        @endforeach
    </ul>
@endif
