<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\UseCases\User\CreateUserService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * @var CreateUserService
     */
    private $createUserService;

    public function __construct(CreateUserService $createUserService)
    {
        $this->middleware('guest');
        $this->createUserService = $createUserService;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->createUserService->create($request->all());

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]
        );
    }
}
