<?php

namespace App\Models;

use App\Http\DTO\DTO;
use App\Http\DTO\FilterDTO;
use App\Http\DTO\PaginateWithFiltersSorintg\PaginateWithFiltersDTO;
use App\Http\Extensions\FiltersAndSortingPaginateTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Models
 * @method paginateWithFilters(PaginateWithFiltersDTO $paginateWithFiltersDTO)
 * @author Shcerbakov Andrei
 */
class BaseModel extends Model
{
    use FiltersAndSortingPaginateTrait;

    /**
     * Заполнение аттрибутов
     *
     * @param DTO $data
     * @return $this
     */
    public function propagateFromDTO(DTO $data): self
    {
        foreach ($data->toArray() as $field => $value) {
            $this->$field = $value;
        }
        return $this;
    }

    /**
     * @param Builder $builder
     * @param FilterDTO $DTO
     * @return Builder
     */
    public function scopeFiltrate(Builder $builder, FilterDTO $DTO): Builder
    {
        if ($DTO->filter) {
            $filter = explode(':', $DTO->filter);
            return $builder->where("{$filter[0]}", $filter[1]);
        }
        return $builder;
    }

    /**
     * @param DTO $DTO
     * @param array $relations
     * @return void
     */
    public function updateRelations(DTO $DTO, array $relations): void
    {
        foreach ($relations as $key => $relation) {
            if ($DTO->{$key}) {
                if (is_null($DTO->{$key})) {
                    $this->{$relation['method']}()->dissociate();
                } else {
                    $relationEntity = $relation['entity']::find($DTO->{$key});
                    $this->{$relation['method']}()->associate($relationEntity);
                }
            }
        }
    }
}
