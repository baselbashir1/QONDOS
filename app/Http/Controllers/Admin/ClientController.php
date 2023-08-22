<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Models\ClientAddress;
use App\Models\SpecialServiceOrder;
use Exception;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(5);
        return view('pages.clients.list', ['clients' => $clients]);
    }

    public function show(Client $client)
    {
        $currentAddress = ClientAddress::where(['client_id' => $client->id, 'is_current' => 1])->first();
        return view('pages.clients.details', ['client' => $client, 'currentAddress' => $currentAddress]);
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

    public function getLocation(Client $client)
    {
        $location = ClientAddress::where(['client_id' => $client->id, 'is_current' => 1])->first();
        return response()->json([
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
        ]);
    }
}
