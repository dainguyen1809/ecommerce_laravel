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

class ProductDataTable extends DataTable
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
                        return '<i class="badge badge-primary p-2">New Arrival</i> ';
                    case 'featured_product':
                        return '<i class="badge badge-success p-2">Featured</i> ';
                    case 'best_product':
                        return '<i class="badge badge-warning p-2">Best Product</i> ';

                }
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
                $edit_btn = "<a class='btn btn-warning mr-2' href='" . route('admin.products.edit', $query->id) . "' /><i class='uil-pen'/></i></a>";
                $del_btn = "<a class='btn btn-danger mr-2 delete-item' href='" . route('admin.products.destroy', $query->id) . "' /><i class='uil-trash'/></i></a>";
                $setting_btn = '<button type="button" 
                    class="btn btn-primary dropdown-toggle" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false">
                        <i class="mdi mdi-settings"></i>
                    </button>
                <div class="dropdown-menu mr-3 border-none">
                    <a class="dropdown-item shadow-lg rounded" href="' . route('admin.products-image-gallery.index', ['product' => $query->id]) . '">Image Gallery</a>
                    <a class="dropdown-item shadow-lg rounded" href="' . route('admin.products-variant.index', ['product' => $query->id]) . '">Variants</a>
                </div>';
                return $edit_btn . $del_btn . $setting_btn;
            })
            ->rawColumns([
                'image',
                'product_type',
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
            ->setTableId('product-table')
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
            Column::make('name')->width(250),
            Column::make('price'),
            Column::make('slug')->width(200),
            Column::make('image'),
            Column::make('product_type'),
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
        return 'Product_' . date('YmdHis');
    }
}
