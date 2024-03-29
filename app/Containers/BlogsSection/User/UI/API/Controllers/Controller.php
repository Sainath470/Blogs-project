<?php

namespace App\Containers\BlogsSection\User\UI\API\Controllers;

use App\Containers\BlogsSection\User\UI\API\Requests\CreateUserRequest;
use App\Containers\BlogsSection\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\BlogsSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Containers\BlogsSection\User\UI\API\Requests\FindUserByIdRequest;
use App\Containers\BlogsSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\BlogsSection\User\UI\API\Transformers\UserTransformer;
use App\Containers\BlogsSection\User\Actions\CreateUserAction;
use App\Containers\BlogsSection\User\Actions\FindUserByIdAction;
use App\Containers\BlogsSection\User\Actions\GetAllUsersAction;
use App\Containers\BlogsSection\User\Actions\UpdateUserAction;
use App\Containers\BlogsSection\User\Actions\DeleteUserAction;
use App\Containers\BlogsSection\User\Actions\LoginUserAction;
use App\Containers\BlogsSection\User\Actions\UserGetAllBlogsAction;
use App\Containers\BlogsSection\User\Tasks\LoginUserTask;
use App\Containers\BlogsSection\User\UI\API\Requests\LoginUserRequest;
use App\Containers\BlogsSection\User\UI\API\Requests\UserGetAllBlogsRequest;
use App\Containers\BlogsSection\User\UI\API\Transformers\LoginUserTransformer;
use App\Containers\BlogsSection\User\UI\API\Transformers\UserGetAllBlogsTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class Controller extends ApiController
{
    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $user = app(CreateUserAction::class)->run($request);
        return $this->created($this->transform($user, UserTransformer::class));
    }

    public function loginUser(LoginUserRequest $request): JsonResponse
    {
        $user = app(LoginUserAction::class)->run($request);
        return $this->created($this->transform($user, LoginUserTransformer::class));
    }

    public function getAllblogsForUser(UserGetAllBlogsRequest $request): array
    {
        $user = app(UserGetAllBlogsAction::class)->run($request);
        return $this->transform($user, UserGetAllBlogsTransformer::class);
    }

    public function findUserById(FindUserByIdRequest $request): array
    {
        $user = app(FindUserByIdAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function getAllUsers(GetAllUsersRequest $request): array
    {
        $users = app(GetAllUsersAction::class)->run($request);
        return $this->transform($users, UserTransformer::class);
    }

    public function updateUser(UpdateUserRequest $request): array
    {
        $user = app(UpdateUserAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }

    public function deleteUser(DeleteUserRequest $request): JsonResponse
    {
        app(DeleteUserAction::class)->run($request);
        return $this->noContent();
    }
}
