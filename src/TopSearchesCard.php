<?php

namespace Davidsneal\LaravelNovaSearchCards;

use Laravel\Nova\Card;
use App\Models\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TopSearchesCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * The top searches.
     *
     * @return $this
     */
    public function topSearches()
    {
        $searches = Search::select('term', DB::raw('count(*) as count'))
            ->groupBy('term')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        $searches = $searches->map(function($search) {
            $search->term = Str::limit($search->term, 25);
            return $search;
        });

        return $this->withMeta([
            'topSearches' => $searches,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'laravel-nova-top-searches-card';
    }
}
