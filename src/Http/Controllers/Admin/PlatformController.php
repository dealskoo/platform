<?php

namespace Dealskoo\Platform\Http\Controllers\Admin;

use Carbon\Carbon;
use Dealskoo\Admin\Http\Controllers\Controller as AdminController;
use Dealskoo\Platform\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends AdminController
{
    public function index(Request $request)
    {
        abort_if(!$request->user()->canDo('platforms.index'), 403);
        if ($request->ajax()) {
            return $this->table($request);
        } else {
            return view('platform::admin.platform.index');
        }
    }

    private function table(Request $request)
    {
        $start = $request->input('start', 0);
        $limit = $request->input('length', 10);
        $keyword = $request->input('search.value');
        $columns = ['id', 'name', 'slug', 'website', 'score', 'country_id', 'seller_id', 'approved', 'created_at', 'updated_at'];
        $column = $columns[$request->input('order.0.column', 0)];
        $desc = $request->input('order.0.dir', 'desc');
        $query = Platform::query();
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
            $query->orWhere('slug', 'like', '%' . $keyword . '%');
            $query->orWhere('website', 'like', '%' . $keyword . '%');
            $query->orWhere('description', 'like', '%' . $keyword . '%');
        }
        $query->orderBy($column, $desc);
        $count = $query->count();
        $platforms = $query->skip($start)->take($limit)->get();
        $rows = [];
        $can_view = $request->user()->canDo('platforms.show');
        $can_edit = $request->user()->canDo('platforms.edit');
        $can_destroy = $request->user()->canDo('platforms.destroy');
        foreach ($platforms as $platform) {
            $row = [];
            $row[] = $platform->id;
            $row[] = '<img src="' . $platform->logo_url . '" alt="' . $platform->name . '" title="' . $platform->name . '" class="me-1"><p class="m-0 d-inline-block align-middle font-16">' . $platform->name . '</p>';
            $row[] = $platform->slug;
            $row[] = $platform->website;
            $row[] = $platform->score;
            $row[] = $platform->country_name;
            $row[] = '<a href="' . route('admin.sellers.show', $brand->seller) . '">' . $brand->seller->name . '</a>';
            $row[] = $platform->approved;
            $row[] = Carbon::parse($platform->created_at)->format('Y-m-d H:i:s');
            $row[] = Carbon::parse($platform->updated_at)->format('Y-m-d H:i:s');
            $view_link = '';
            if ($can_view) {
                $view_link = '<a href="' . route('admin.platforms.show', $platform) . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';
            }

            $edit_link = '';
            if ($can_edit) {
                $edit_link = '<a href="' . route('admin.platforms.edit', $platform) . '" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>';
            }
            $destroy_link = '';
            if ($can_destroy) {
                $destroy_link = '<a href="javascript:void(0);" class="action-icon delete-btn" data-table="platforms_table" data-url="' . route('admin.platforms.destroy', $platform) . '"> <i class="mdi mdi-delete"></i></a>';
            }
            $row[] = $view_link . $edit_link . $destroy_link;
            $rows[] = $row;
        }
        return [
            'draw' => $request->draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $rows
        ];
    }

    public function show(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('platforms.show'), 403);
        $platform = Platform::query()->findOrFail($id);
        return view('platform::admin.platform.show', ['platform' => $platform]);
    }

    public function edit(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('platforms.edit'), 403);
        $platform = Platform::query()->findOrFail($id);
        return view('platform::admin.platform.show', ['platform' => $platform]);
    }

    public function update(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('platforms.edit'), 403);
        $request->validate([
            'approved' => ['required', 'boolean'],
        ]);
        $platform = Platform::query()->findOrFail($id);
        $brand->fill($request->only([
            'approved',
        ]));
        $platform->save();
        return back()->with('success', __('admin::admin.update_success'));
    }

    public function destroy(Request $request, $id)
    {
        abort_if(!$request->user()->canDo('platforms.destroy'), 403);
        return ['status' => Platform::destroy($id)];
    }
}
