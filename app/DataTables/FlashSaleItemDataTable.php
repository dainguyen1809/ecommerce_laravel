<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('product_name', function ($query) {
                return '<a href="' . route('admin.products.edit', $query->product->id) . '">' . $query->product->name . '</a>';
            })
            ->addColumn('status', function ($query) {
                $statusSwitchId = 'statusSwitch' . $query->id;
                if ($query->status == 1) {
                    $switch = '
                    <input type="checkbox" class="change-status" id="' . $statusSwitchId . '" checked data-switch="bool" data-id="' . $query->id . '"/>
                    <label for="' . $statusSwitchId . '"></label>
                    ';
                } else {
                    $switch = '
                    <input type="checkbox" class="change-status" id="' . $statusSwitchId . '" data-switch="bool" data-id="' . $query->id . '"/>
                    <label for="' . $statusSwitchId . '"></label>
                    ';
                }
                return $switch;
            })
            ->addColumn('show_at_home', function ($query) {
                $showAtHomeSwitchId = 'showAtHomeSwitch' . $query->id;
                if ($query->show_at_home == 1) {
                    $switch = '
                    <input type="checkbox" class="show_at_home" id="' . $showAtHomeSwitchId . '" checked data-switch="bool" data-id="' . $query->id . '"/>
                    <label for="' . $showAtHomeSwitchId . '"></label>
                    ';
                } else {
                    $switch = '
                    <input type="checkbox" class="show_at_home" id="' . $showAtHomeSwitchId . '" data-switch="bool" data-id="' . $query->id . '"/>
                    <label for="' . $showAtHomeSwitchId . '"></label>
                    ';
                }
                return $switch;
            })
            ->addColumn('action', function ($query) {
                $del_btn = "<a class='btn btn-danger delete-item' href='" . route('admin.flash-sale.destroy', $query->id) . "' /><i class='uil-trash'/></i></a>";
                return $del_btn;
            })
            ->rawColumns([
                'product_name',
                'status',
                'show_at_home',
                'action',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model) : QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flashsaleitem-table')
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
            Column::make('product_name'),
            Column::make('show_at_home'),
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
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
