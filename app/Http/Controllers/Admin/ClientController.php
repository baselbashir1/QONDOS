<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Exception;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(5);
        return view('pages.clients.list', ['clients' => $clients]);
    }

    public function create()
    {
        return view('pages.clients.add');
    }

    public function store(ClientRequest $request)
    {
        $formFields = $request->validated();

        try {
            Client::create([
                'name' => $formFields['name'],
                'email' => isset($formFields['email']) ? $formFields['email'] : null,
                'phone' => $formFields['phone'],
                'city' => $formFields['city'],
                'password' => bcrypt($formFields['password'])
            ]);

            notify()->success('تمت إضافة العميل بنجاح');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة العميل');
        }
    }

    public function edit(Client $client)
    {
        return view('pages.clients.edit', ['client' => $client]);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $formFields = $request->validated();

        try {
            $client->update([
                'name' => $formFields['name'],
                'email' => isset($formFields['email']) ? $formFields['email'] : null,
                'phone' => $formFields['phone'],
                'city' => $formFields['city'],
                'password' => bcrypt($formFields['password'])
            ]);

            notify()->success('تم تعديل العميل بنجاح');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء تعديل العميل');
        }
    }

    public function destroy(Client $client)
    {
        $client->delete();
        notify()->success('تم حذف العميل بنجاح');
        return redirect()->route('clients.index');
    }

    public function makeOrder()
    {
    }

    public function requestNewService()
    {
    }
}
