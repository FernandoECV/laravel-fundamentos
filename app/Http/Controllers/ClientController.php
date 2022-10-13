<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Lista os clientes
     *
     * @return View
     */
    public function index(): View
    {
        $clients = Client::get();

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Mostra um cliente especifico
     *
     * @param integer $id
     * @return View
     */
    public function show(int $id): View
    {
        $client = Client::find($id);

        return view('clients.show', [
            'client' => $client
        ]);
    }

    /**
     * Exibi o formulário de criação
     *
     * @return View
     */
    public function create(): View
    {
        return view('clients.create');
    }

    /**
     * Cria um cliente no banco de dados
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->except('_token');

        Client::create($dados);

        $request->session()->flash('AdicionarCliente', 'O Cliente foi adicionado com sucesso!');

        return redirect('/clients');
    }

    /**
     * Mostra o formulário para edição
     *
     * @param integer $id
     * @return View
     */
    public function edit(int $id): View
    {
        $client = Client::find($id);

        return view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Atualiza o cliente no banco de dados
     *
     * @param integer $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $client = Client::find($id);

        $client->update([
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'observacao' => $request->observacao
        ]);

        return redirect('/clients');
    }

    /**
     * Apaga um cliente no banco de dados
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id, Request $request)
    {
        $client = Client::find($id);

        $request->session()->flash('RemoverCliente', 'O Cliente foi removido com sucesso!');

        $client->delete();

        return redirect('/clients');
    }
}
