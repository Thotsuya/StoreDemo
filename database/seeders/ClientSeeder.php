<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory(15)
            ->create()
            ->each(function(Client $client){

                Address::factory(rand(1,3))->create([
                    'client_id' => $client->id
                ]);

                Order::factory(rand(1,4))->create([
                    'client_id' => $client->id,
                    'address_id' => $client->addresses->random()->id
                ]);

            });
    }
}
