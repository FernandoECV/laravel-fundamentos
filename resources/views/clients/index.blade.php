@extends('app')

@section('titulo', 'Lista de clientes')

@section('conteudo')
    <h1>Lista de Clientes</h1>

    @if (Session::has('RemoverCliente'))
        <div class="alert alert-danger">
            {{ Session::get('RemoverCliente') }}
        </div>
    @endif

    @if (Session::has('AdicionarCliente'))
        <div class="alert alert-success">
            {{ Session::get('AdicionarCliente') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Endereço</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <th scope="row">{{ $client->id }}</th>
                    <td><a href="{{ route('clients.show', $client) }}">{{ $client->nome }}</a></td>
                    <td>{{ $client->endereco }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('clients.edit', $client) }}">Atualizar</a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display: inline;">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('Tem certeza que deseja apagar?')">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a class="btn btn-success" href="{{ route('clients.create') }}">Novo Cliente</a>
@endsection
