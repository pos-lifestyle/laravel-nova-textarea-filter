<?php declare(strict_types=1);

namespace PosLifestyle\TextareaFilter;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class TextareaFilter extends Filter
{
    /**
     * @var string
     */
    public $component = 'textarea-filter';

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    protected $column;

    public function __construct(string $name, string $column)
    {
        $this->name = $name;
        $this->column = $column;
    }

    /**
     * @param Request $request
     * @param Builder $query
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Request $request, $query, $value)
    {
        $values = preg_split('/\s/', $value, -1, PREG_SPLIT_NO_EMPTY);
        $query->whereIn($this->column, $values);

        return $query;
    }

    public function options(Request $request): array
    {
        return [];
    }

    public function key(): string
    {
        return parent::key() . '_' . $this->column;
    }
}
