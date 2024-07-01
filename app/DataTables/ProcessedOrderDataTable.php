<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProcessedOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('customer', function ($query) {
                return $query->user->name;
            })
            ->addColumn('date', function ($query) {
                return date('d-M-Y', strtotime($query->created_at));
            })
            ->addColumn('order_status', function ($query) {
                switch ($query->order_status) {
                    case 'pending':
                        return "<span class='badge badge-warning badge-pill p-2'>Pending</span>";
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge badge-primary badge-pill p-2'>Processed</span>";
                    case 'dropped_off':
                        return "<span class='badge badge-dark badge-pill p-2'>Dropped Off</span>";
                    case 'shipped':
                        return "<span class='badge badge-success badge-pill p-2'>Shipped</span>";
                    case 'out_for_delivery':
                        return "<span class='badge badge-info badge-pill p-2'>Out for delivery</span>";
                    case 'delivered':
                        return "<span class='badge badge-success badge-pill p-2'>Delivered</span>";
                    case 'cancel':
                        return "<span class='badge badge-danger badge-pill p-2'>Canceled</span>";
                    default:
                        # code...
                        break;
                }
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status === 1)
                    return "<span class='badge badge-success badge-pill p-2'>Completed</span>";
                else
                    return "<span class='badge badge-danger badge-pill p-2'>Pending</span>";
            })
            ->addColumn('action', function ($query) {
                $show = "<a class='btn btn-primary mr-3' href='" . route('admin.orders.show', $query->id) . "' /><i class='uil-eye'/></i></a>";
                $del_btn = "<a class='btn btn-danger mr-3 delete-item' href='" . route('admin.orders.destroy', $query->id) . "' /><i class='uil-trash'/></i></a>";
                return $show . $del_btn;
            })
            ->addColumn('amount', function ($query) {
                return $query->currency_icon . $query->amount;
            })
            ->rawColumns([
                'order_status',
                'payment_status',
                'action',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model) : QueryBuilder
    {
        return $model->newQuery()->where('order_status', 'processed_and_ready_to_ship');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('processedorder-table')
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
    public function getColumns() : array
    {
        return [
            Column::make('id')->addClass('text-center'),
            Column::make('invoice_id')->addClass('text-center'),
            Column::make('customer')->addClass('text-center'),
            Column::make('date')->addClass('text-center'),
            Column::make('product_qty')->addClass('text-center'),
            Column::make('amount')->addClass('text-center'),
            Column::make('order_status')->addClass('text-center'),
            Column::make('payment_status')->addClass('text-center'),
            Column::make('payment_method')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename() : string
    {
        return 'ProcessedOrder_' . date('YmdHis');
    }
}
