<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Repositories;

use App\Models\ChatgptApi as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ChatgptApi extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
