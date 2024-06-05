<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('variant_name', function ($query) {
                return $query->productVariant->name;
            })
            ->addColumn('is_default', function ($query) {
                $default = '<i class="badge badge-success p-2">Default</i> ';
                $none = '<i class="badge badge-warning p-2">None</i> ';

                if ($query->is_default == 0) {
                    return $none;
                }
                return $default;
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
            ->addColumn('action', function ($query) {
                $edit_btn = "<a class='btn btn-warning mr-3' href='" . route('admin.products-variant-item.edit', $query->id) . "' /><i class='uil-pen'/></i></a>";
                $del_btn = "<a class='btn btn-danger delete-item' href='" . route('admin.products-variant-item.destroy', $query->id) . "' /><i class='uil-trash'/></i></a>";
                return $edit_btn . $del_btn;
            })
            ->rawColumns([
                'action',
                'is_default',
                'status',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model) : QueryBuilder
    {
        return $model->where('product_variant_id', request()->variantId)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('productvariantitem-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            // ->orderBy(1)
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
            Column::make('name'),
            Column::make('variant_name'),
            Column::make('price'),
            Column::make('is_default'),
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
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
