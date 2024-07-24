<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorListDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('avatar', function ($query) {
                $class = $query->avatar ? 'class="img-thumbnail avt_user"' : "";
                return '<img src="' . $query->avatar . '" alt="' . $query->name . '"  ' . $class . ' />';
            })
            ->addColumn('shop_name', function ($query) {
                return $query->vendor->shop_name;
            })
            ->addColumn('phone', function ($query) {
                return $query->vendor->phone;
            })
            ->addColumn('status', function ($query) {
                $switchId = 'switch' . $query->id;
                if ($query->status == 'active') {
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
                'avatar',
                'status',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model) : QueryBuilder
    {
        return $model->where('role', 'vendor')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('listvendor-table')
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
            Column::make('id')->addClass('text-center'),
            Column::make('avatar')->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            Column::make('shop_name')->addClass('text-center'),
            Column::make('email')->addClass('text-center'),
            Column::make('phone')->addClass('text-center'),
            Column::make('role')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename() : string
    {
        return 'ListVendor_' . date('YmdHis');
    }
}
