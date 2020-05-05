<?php

use App\UseCases\User\CreateUserService;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * @var CreateUserService
     */
    private $createOrderService;

    public function __construct(CreateUserService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    public function run()
    {
        $pass = Hash::make(111);

        factory(User::class, 1)->make(
            [
                'name' => 'manager',
                'email' => 'manager@mail.ru',
                'role_id' => 'admin'
            ]
        )->each(
            function ($user) use ($pass) {
                $data = array_merge(
                    $user->attributesToArray(),
                    [
                        'password' => $pass,
                    ]
                );
                $this->createOrderService->create($data);
            }
        );

        factory(User::class, 1)->make(
            [
                'name' => 'user',
                'email' => 'user@mail.ru'
            ]
        )->each(
            function ($user) use ($pass) {
                $data = array_merge(
                    $user->attributesToArray(),
                    [
                        'password' => $pass,
                    ]
                );
                $this->createOrderService->create($data);
            }
        );
    }
}
