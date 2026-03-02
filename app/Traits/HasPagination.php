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
     * @param array $relations
     * @return AbstractPaginator
     */
    public function paginate(array $relations = []): AbstractPaginator
    {
        $model = $this->targetModel();

        $perPage = request()->query('per_page', 10);

        $query = $model::query();

        if ($relations) {
            $query->with($relations);
        }

        return $query->latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage]);
    }
}
