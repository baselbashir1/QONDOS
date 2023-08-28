<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ClientAddress;
use App\Models\SpecialServiceOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientAddressRequest;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;

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
            $client = Client::create([
                'name' => $formFields['name'],
                'email' => isset($formFields['email']) ? $formFields['email'] : null,
                'phone' => $formFields['phone'],
                'city' => $formFields['city'],
                'password' => bcrypt($formFields['password'])
            ]);

            ClientAddress::create([
                'home' => isset($formFields['home']) ? $formFields['home'] : null,
                'address' => isset($formFields['address']) ? $formFields['address'] : null,
                'latitude' => isset($formFields['latitude']) ? $formFields['latitude'] : null,
                'longitude' => isset($formFields['longitude']) ? $formFields['longitude'] : null,
                'client_id' => $client->id,
                'is_current' => 1
            ]);

            notify()->success('تمت إضافة العميل بنجاح');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            notify()->error('حدث خطأ أثناء إضافة العميل');
        }
    }

    public function edit(Client $client)
    {
        $clientAddress = ClientAddress::where(['is_current' => 1, 'client_id' => $client->id])->first();
        return view('pages.clients.edit', ['client' => $client, 'clientAddress' => $clientAddress]);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $formFields = $request->validated();

        try {
            $client->update([
                'name' => $formFields['name'],
                'email' => isset($formFields['email']) ? $formFields['email'] : $client->email,
                'phone' => $formFields['phone'],
                'city' => $formFields['city'],
                'password' => bcrypt($formFields['password']),
            ]);

            foreach ($client->addresses as $address) {
                $address->update([
                    'is_current' => 0
                ]);
            }

            ClientAddress::create([
                'home' => isset($formFields['home']) ? $formFields['home'] : null,
                'address' => isset($formFields['address']) ? $formFields['address'] : null,
                'latitude' => isset($formFields['latitude']) ? $formFields['latitude'] : null,
                'longitude' => isset($formFields['longitude']) ? $formFields['longitude'] : null,
                'client_id' => $client->id,
                'is_current' => 1
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

    public function getLocation()
    {
        $client = Auth::user();
        $clientLocation = ClientAddress::where(['client_id' => $client->id, 'is_current' => 1])->first();
        return response()->json([
            'latitude' => $clientLocation->latitude,
            'longitude' => $clientLocation->longitude,
        ]);
    }
}
