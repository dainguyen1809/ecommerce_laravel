<?php

namespace App\DataTables;

use App\Models\GeneralSetting;
use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingRuleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    protected $currency_icon = '';
    public function __construct()
    {
        $this->currency_icon = GeneralSetting::first()->currency_icon;
    }
    public function dataTable(QueryBuilder $query) : EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('type', function ($query) {
                switch ($query->type) {
                    case 'flat_cost':
                        return '<i class="badge badge-primary p-2" style="font-size: 16px;">Flate Amount</i>';
                    case 'min_cost':
                        return '<i class="badge badge-secondary p-2" style="font-size: 16px;">Minimum Order Amount</i>';
                    default:
                        break;
                }
            })
            ->addColumn('min_cost', function ($query) {
                if ($query->type === 'min_cost') {
                    return $this->currency_icon . ' ' . $query->min_cost;

                } else {
                    return $this->currency_icon . ' ' . '0';
                }
            })
            ->addColumn('cost', function ($query) {
                return $this->currency_icon . ' ' . $query->cost;
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
                $edit_btn = "<a class='btn btn-warning mr-3' href='" . route('admin.shipping-rule.edit', $query->id) . "' /><i class='uil-pen'/></i></a>";
                $del_btn = "<a class='btn btn-danger delete-item' href='" . route('admin.shipping-rule.destroy', $query->id) . "' /><i class='uil-trash'/></i></a>";
                return $edit_btn . $del_btn;
            })
            ->rawColumns([
                'type',
                'status',
                'action',
            ])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model) : QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html() : HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shippingrule-table')
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
            Column::make('name')->addClass('text-center'),
            Column::make('type')->addClass('text-center'),
            Column::make('cost')->addClass('text-center'),
            Column::make('min_cost')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
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
        return 'ShippingRule_' . date('YmdHis');
    }
}
