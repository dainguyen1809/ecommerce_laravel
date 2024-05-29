<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'brand.action')
            ->addColumn('logo', function ($query) {
                return '<img src="' . asset($query->logo) . '" height="150" alt="brand"/>';
            })
            ->addColumn('featured', function ($query) {
                $yes = '<i class="badge badge-success p-2">Yes</i>';
                $no = '<i class="badge badge-warning p-2">No</i>';
                if ($query->is_featured == 0) {
                    return $no;
                }
                return $yes;
            })
            ->addColumn('status', function ($query) {
                $switchId = 'switch' . $query->id;
                if ($query->status == 1) {
                    $switch = '
                    <input type="checkbox" id="' . $switchId . '"  class="change-status" checked data-switch="bool"  data-id="' . $query->id . '"/>
                    <label for="' . $switchId . '"></label>
                    ';
                } else {
                    $switch = '
                    <input type="checkbox" id="' . $switchId . '"  class="change-status" data-switch="bool" data-id="' . $query->id . '"/>
                    <label for="' . $switchId . '"></label>
                    ';
                }
                return $switch;
            })
            ->addColumn('action', function ($query) {
                $btn_edit = "<a class='btn btn-warning mr-2' href='" . route('admin.brand.edit', $query->id) . "'>
                <i class='uil-pen'/></i>
                </a>";
                $btn_delete = "<a class='btn btn-danger delete-item' href='" . route('admin.brand.destroy', $query->id) . "'>
                <i class='uil-trash'/></i>
                </a>";

                return $btn_edit . $btn_delete;
            })
            ->rawColumns([
                'logo',
                'featured',
                'status',
                'action',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model) : QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns() : array
    {
        return [
            Column::make('id'),
            Column::make('logo')->width(150),
            Column::make('name'),
            Column::make('slug'),
            Column::make('featured'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename() : string
    {
        return 'Brand_' . date('YmdHis');
    }
}
