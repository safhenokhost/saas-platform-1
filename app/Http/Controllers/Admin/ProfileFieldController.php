<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileField;
use Illuminate\Http\Request;

class ProfileFieldController extends Controller
{
    public function index()
    {
        $fields = \App\Models\ProfileField::orderBy('id')->get();
        return view('admin.profile-fields.index', compact('fields'));
    }


    public function toggle($id)
    {
        $field = ProfileField::findOrFail($id);

        $field->enabled = ! $field->enabled;
        $field->save();

        return back()->with('success', 'وضعیت فیلد بروزرسانی شد');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'key'   => 'required|string|max:255|unique:profile_fields,key',
            'type'  => 'required|in:text,number,textarea,map',
        ]);

        ProfileField::create([
            'label'    => $data['label'],
            'key'      => $data['key'],
            'type'     => $data['type'],
            'required' => $request->has('required'),
            'enabled'  => true,
        ]);

        return redirect()->route('admin.profile-fields.index')
            ->with('success', 'فیلد جدید با موفقیت ذخیره شد');
    }


    public function destroy($id)
    {
        $field = ProfileField::findOrFail($id);
        $field->delete();

        return back()->with('success', 'فیلد با موفقیت حذف شد');
    }

    public function update(Request $request, $id)
    {
        $field = ProfileField::findOrFail($id);

        $data = $request->validate([
            'label' => 'required|string|max:255',
            'key'   => 'required|string|max:255|unique:profile_fields,key,' . $field->id,
            'type'  => 'required|in:text,number,textarea,map',
        ]);

        $field->label = $data['label'];
        $field->key = $data['key'];
        $field->type = $data['type'];
        $field->required = $request->has('required');
        $field->enabled  = $request->has('enabled');

        $field->save();

        return back()->with('success', 'فیلد با موفقیت بروزرسانی شد');
    }
}
