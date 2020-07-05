<?php

namespace App\DataTables;

use App\Models\Branches;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BranchesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'branches.action');
    }
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->make(true);
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Branch $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Branches $model)
    {
        return $model::newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('branch_id')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('branch_id'),
            Column::make('branch_number'),
            Column::make('branch_name'),
            Column::make('branch_phone'),
            Column::make('branch_type'),
            Column::make('branch_email'),
            Column::make('branch_address'),
            Column::make('branch_status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Branches_' . date('YmdHis');
    }
}
