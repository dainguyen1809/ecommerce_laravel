<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function ($query) {
                return "<img src='" . asset($query->thumb_image) . "' width='150' />";
            })
            ->addColumn('product_type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge bg-primary p-2">New Arrival</i> ';
                    case 'featured_product':
                        return '<i class="badge bg-success p-2">Featured</i> ';
                    case 'best_product':
                        return '<i class="badge bg-warning p-2">Best Product</i> ';

                }
            })
            ->addColumn('approved', function ($query) {
                $default = '<i class="badge bg-success p-2">Approved</i>';
                $none = '<i class="badge bg-warning p-2">Pending</i> ';

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
                <input type="checkbox" class="change-status" id="' . $switchId . '" data-switch="bool" data-id="' . $query->id . '"/>
                <label for="' . $switchId . '"></label>
                ';
                }
                return $switch;
            })
            ->addColumn('action', function ($query) {
                $edit_btn = "<a class='btn btn-warning me-2' href='" . route('vendor.products.edit', $query->id) . "' /><i class='fas fa-pen-to-square'></i></a>";
                $del_btn = "<a class='btn btn-danger me-2 delete-item' href='" . route('vendor.products.destroy', $query->id) . "' /><i class='fas fa-trash'></i></a>";
                $setting_btn = '
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-gear"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item shadow-lg rounded" href="' . route('vendor.products-image-gallery.index', ['product' => $query->id]) . '">Image Gallery</a>
                            <a class="dropdown-item shadow-lg rounded" href="' . route('vendor.products-variant.index', ['product' => $query->id]) . '">Variants</a>
                        </div>
                    </div>
                ';
                return $edit_btn . $del_btn . $setting_btn;
            })
            ->rawColumns([
                'image',
                'product_type',
                'approved',
                'status',
                'action',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model) : QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproduct-table')
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
            Column::make('price'),
            Column::make('slug')->width(300),
            Column::make('image'),
            Column::make('product_type'),
            Column::make('approved'),
            Column::make('status'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
