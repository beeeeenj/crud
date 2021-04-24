<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (array_wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            if(count(explode('.', $attribute))>2):
                            
                            [$relationName_1, $relationName_2, $relationAttribute_1] = explode('.', $attribute);
 
                            $query->orWhereHas($relationName_1.'.'.$relationName_2, function (Builder $query) use ($relationAttribute_1, $searchTerm) {
                                $query->where($relationAttribute_1, 'LIKE', "%{$searchTerm}%");
                            });
                        else:
                            [$relationName, $relationAttribute] = explode('.', $attribute);
 
                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        endif;
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });
 
            return $this;
        });
    }
}
