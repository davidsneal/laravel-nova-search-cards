<?php

namespace Davidsneal\LaravelNovaSearchCards;

use Laravel\Nova\Card;
use App\Models\Search;
use Illuminate\Support\Str;

class LatestSearchesCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * The latest searches.
     *
     * @return $this
     */
    public function latestSearches()
    {
        $searches = Search::select('term', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $searches = $searches->map(function($search) {
            $search->term = Str::limit($search->term, 30);
            return $search;
        });

        return $this->withMeta([
            'latestSearches' => $searches,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'laravel-nova-latest-searches-card';
    }
}
