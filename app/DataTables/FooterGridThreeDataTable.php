<?php

namespace App\DataTables;

use App\Models\FooterGridThree;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FooterGridThreeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit_btn = "<a class='btn btn-warning mr-3' href='" . route('admin.footer-grid-three.edit', $query->id) . "' /><i class='uil-pen'/></i></a>";
                $del_btn = "<a class='btn btn-danger delete-item' href='" . route('admin.footer-grid-three.destroy', $query->id) . "' /><i class='uil-trash'/></i></a>";
                return $edit_btn . $del_btn;
            })
            ->addColumn('status', function ($query) {
                $switchId = 'switch' . $query->id;
                if ($query->status == 1) {
                    $switch = '
                <input type="checkbox" class="change-status" id="' . $switchId . '" checked data-switch="bool" data-id="' . $query->id . '"/>
                <label for="' . $switchId . '"></label>
                ';
                } else {
                    $switch = '
                <input type="checkbox" class="change-status" id="' . $switchId . '" data-switch="bool" data-id="' . $query->id . '"/>
                <label for="' . $switchId . '"></label>
                ';
                }
                return $switch;
            })
            ->rawColumns([
                'action',
                'status',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FooterGridThree $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('footergridthree-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
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
    protected function filename(): string
    {
        return 'FooterPolicy_' . date('YmdHis');
    }
}
