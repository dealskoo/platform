<?php

namespace Dealskoo\Platform\Http\Controllers\Seller;

use Carbon\Carbon;
use Dealskoo\Platform\Models\Platform;
use Dealskoo\Seller\Http\Controllers\Controller as SellerController;
use Illuminate\Http\Request;

class PlatformController extends SellerController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->table($request);
        } else {
            return view('platform::seller.platform.index');
        }
    }

    private function table(Request $request)
    {
        $start = $request->input('start', 0);
        $limit = $request->input('length', 10);
        $keyword = $request->input('search.value');
        $columns = ['id', 'name', 'slug', 'website', 'score', 'country_id', 'approved', 'created_at', 'updated_at'];
        $column = $columns[$request->input('order.0.column', 0)];
        $desc = $request->input('order.0.dir', 'desc');
        $query = Platform::where('seller_id', $request->user()->id);
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
        foreach ($platforms as $platform) {
            $row = [];
            $row[] = $platform->id;
            $row[] = '<img src="' . $platform->logo_url . '" alt="' . $platform->name . '" title="' . $platform->name . '" class="me-1"><p class="m-0 d-inline-block align-middle font-16">' . $platform->name . '</p>';
            $row[] = $platform->slug;
            $row[] = $platform->website;
            $row[] = $platform->score;
            $row[] = $platform->country->name;
            $row[] = $platform->approved;
            $row[] = Carbon::parse($platform->created_at)->format('Y-m-d H:i:s');
            $row[] = Carbon::parse($platform->updated_at)->format('Y-m-d H:i:s');

            $edit_link = '';
            if (!$platform->approved) {
                $edit_link = '<a href="' . route('seller.platforms.edit', $platform) . '" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>';
            }
            $destroy_link = '';
            if (!$platform->approved) {
                $destroy_link = '<a href="javascript:void(0);" class="action-icon delete-btn" data-table="platforms_table" data-url="' . route('seller.platforms.destroy', $platform) . '"> <i class="mdi mdi-delete"></i></a>';
            }
            $row[] = $edit_link . $destroy_link;
            $rows[] = $row;
        }
        return [
            'draw' => $request->draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $rows
        ];
    }

    public function create(Request $request)
    {
        return view('platform::seller.platform.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['required', 'image'],
            'name' => ['required'],
            'website' => ['required'],
        ]);
        $platform = new Platform($request->only(['name', 'website', 'description']));
        $image = $request->file('logo');
        $seller = $request->user();
        $platform->seller_id = $seller->id;
        $platform->country_id = $seller->country->id;
        $platform->save();
        $filename = $platform->id . '.' . $image->guessExtension();
        $path = $image->storeAs('platforms', $filename);
        $platform->logo = $path;
        $platform->save();
        return redirect(route('seller.platforms.index'));
    }

    public function edit(Request $request, $id)
    {
        $platform = Platform::where('seller_id', $request->user()->id)->findOrFail($id);
        return view('platform::seller.platform.edit', ['platform' => $platform]);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('logo')) {
            $request->validate([
                'logo' => ['required', 'image'],
                'name' => ['required'],
                'website' => ['required'],
            ]);
        } else {
            $request->validate([
                'name' => ['required'],
                'website' => ['required'],
            ]);
        }
        $platform = Platform::where('seller_id', $request->user()->id)->findOrFail($id);
        $platform->fill($request->only(['name', 'website', 'description']));
        if ($request->has('logo')) {
            $image = $request->file('logo');
            $filename = $platform->id . '.' . $image->guessExtension();
            $path = $image->storeAs('platforms', $filename);
            $platform->logo = $path;
        }
        $platform->save();
        return redirect(route('seller.platforms.index'));
    }

    public function destroy(Request $request, $id)
    {
        return ['status' => Platform::where('seller_id', $request->user()->id)->where('approved', false)->delete($id)];
    }
}
