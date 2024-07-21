<?php

namespace App\DataTables;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorRegisterDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function ($query) {
                return $query->user->name;
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 1)
                    return "<span class='badge badge-success badge-pill p-2'>Approved</span>";
                else
                    return "<span class='badge badge-warning badge-pill p-2'>Pending</span>";
            })
            ->addColumn('action', function ($query) {
                $edit_btn = "<a class='btn btn-primary mr-3' href='" . route('admin.vendor-register.show', $query->id) . "' /><i class='uil-eye'/></i></a>";
                return $edit_btn;
            })
            ->rawColumns([
                'status',
                'action',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vendor $model) : QueryBuilder
    {
        return $model->where('status', 0)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorregister-table')
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
            Column::make('user_name')->addClass('text-center'),
            Column::make('shop_name')->addClass('text-center'),
            Column::make('email')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename() : string
    {
        return 'VendorRegister_' . date('YmdHis');
    }
}
