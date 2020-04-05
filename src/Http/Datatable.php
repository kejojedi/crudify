<?php

namespace Kejojedi\Crudify\Http;

use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class Datatable
{
    private $data;
    protected $order_by = 'name';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function make($data)
    {
        return new static($data);
    }

    protected function columns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    private function columnsArray()
    {
        $array = [];

        foreach ($this->columns() as $column) {
            $array[] = !is_array($column) ? $column->toArray() : $column;
        }

        return $array;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function html()
    {
        $html = DataTables::getHtmlBuilder();
        $html->setTableId(class_basename($this));
        $html->columns($this->columnsArray());
        $html->orderBy($this->orderByKey(), $this->orderBy()[1] ?? 'asc');

        if ($this->actions(null)) {
            $html->addAction(['title' => '']);
        }

        $this->htmlMethods($html);

        return compact('html');
    }

    protected function htmlMethods(Builder &$html)
    {
        //
    }

    protected function orderBy()
    {
        return $this->order_by;
    }

    private function orderByKey()
    {
        $order_by = $this->orderBy();

        foreach ($this->columnsArray() as $key => $column) {
            if ($column['data'] == $order_by[0] ?? $order_by) {
                return $key;
            }
        }

        return 0;
    }

    /** @noinspection PhpUnhandledExceptionInspection */
    public function json()
    {
        $datatables = DataTables::of($this->data);

        if ($this->actions(null)) {
            $datatables->editColumn('action', function ($model) {
                return $this->actions($model);
            });
        }

        $this->jsonMethods($datatables);

        return $datatables->toJson();
    }

    protected function jsonMethods(DataTableAbstract &$datatables)
    {
        //
    }

    protected function actions($model)
    {
        return null;
    }
}
