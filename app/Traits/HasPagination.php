<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;

/**
 * @template T of Model
 */
trait HasPagination
{
    /**
     * @return class-string<T>
     */
    abstract protected function targetModel(): string;

    /**
     * @return AbstractPaginator
     */
    public function paginate(): AbstractPaginator
    {
        $model = $this->targetModel();

        $perPage = request()->query('per_page', 10);

        return $model::latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
    }
}
