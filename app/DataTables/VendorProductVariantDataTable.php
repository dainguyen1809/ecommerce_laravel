<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
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
                $variant_items = "<a class='btn btn-info text-light me-2' href='" . route('vendor.products-variant-item.index', [
                    'productId' => request()->product,
                    'variantId' => $query->id,
                ]) . "' />Variant Items</a>";
                $edit_btn = "<a class='btn btn-warning me-2' href='" . route('vendor.products-variant.edit', $query->id) . "' /><i class='fas fa-pen-to-square'/></i></a>";
                $del_btn = "<a class='btn btn-danger delete-item' href='" . route('vendor.products-variant.destroy', $query->id) . "' /><i class='fas fa-trash'/></i></a>";

                return $variant_items . $edit_btn . $del_btn;
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
    public function query(ProductVariant $model) : QueryBuilder
    {
        return $model->where('product_id', request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproductvariant-table')
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
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename() : string
    {
        return 'VendorProductVariant_' . date('YmdHis');
    }
}
