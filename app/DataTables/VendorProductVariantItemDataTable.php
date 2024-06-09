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

class VendorProductVariantItemDataTable extends DataTable
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
                $default = '<i class="badge bg-success p-2">Default</i>';
                $none = '<i class="badge bg-warning p-2">None</i> ';

                if ($query->is_default == 0) {
                    return $none;
                }
                return $default;
            })
            ->addColumn('status', function ($query) {
                $switchId = 'switch' . $query->id;
                if ($query->status == 1) {
                    $switch = '
                    <div class="form-check form-switch">
                        <input class="form-check-input change-status" type="checkbox" id="' . $switchId . '" data-id="' . $query->id . '" checked>
                        <label class="form-check-label" for="' . $switchId . '"></label>
                    </div>
                ';
                } else {
                    $switch = '
                    <div class="form-check form-switch">
                        <input class="form-check-input change-status" type="checkbox" id="' . $switchId . '" data-id="' . $query->id . '">
                        <label class="form-check-label" for="' . $switchId . '"></label>
                    </div>
                ';
                }
                return $switch;
            })
            ->addColumn('action', function ($query) {
                $edit_btn = "<a class='btn btn-warning me-2' href='" . route('vendor.products-variant-item.edit', $query->id) . "' /><i class='fas fa-pen-to-square'/></i></a>";
                $del_btn = "<a class='btn btn-danger delete-item' href='" . route('vendor.products-variant-item.destroy', $query->id) . "' /><i class='fas fa-trash'/></i></a>";
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
            ->setTableId('vendorproductvariantitem-table')
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
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}
