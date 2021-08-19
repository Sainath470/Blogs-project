<?php

namespace App\Containers\BlogsSection\Blogs\Tasks;

use App\Containers\BlogsSection\Blogs\Data\Repositories\BlogsRepository;
use App\Containers\BlogsSection\Blogs\Models\Blogs;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Auth;
use Exception;
use JWTAuth;
use Log;

class CreateBlogsTask extends Task
{
    protected Blogs $repository;

    public function __construct(Blogs $repository)
    {
        $this->repository = $repository;
    }

    public function run(string $hotelName, string $foodName, string $description, string $price, string $rating, string $place)
    {
        $token = JWTAuth::getToken();
        $details = JWTAuth::getPayload($token)->toArray();
        $id = $details["sub"];
              
        return $this->repository->create([
            'admin_id' => $id,
            'hotelName' => $hotelName,
            'foodName' => $foodName,
            'description' => $description,
            'price' => $price,
            'rating' => $rating,
            'place' => $place
        ]);
    }
}
