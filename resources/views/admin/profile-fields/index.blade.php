@extends('layouts.admin')

@section('title', 'مدیریت فیلدهای پروفایل')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">مدیریت فیلدهای پروفایل</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- افزودن فیلد جدید --}}
    <div class="card mb-4">
        <div class="card-header">➕ افزودن فیلد جدید</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile-fields.store') }}" class="row g-3">
                @csrf

                <div class="col-md-3">
                    <label class="form-label">عنوان</label>
                    <input type="text" name="label" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">کلید (key)</label>
                    <input type="text" name="key" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">نوع فیلد</label>
                    <select name="type" class="form-select">
                        <option value="text">متن</option>
                        <option value="number">عدد</option>
                        <option value="textarea">متن بلند</option>
                        <option value="map">نقشه</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="required" id="required_new">
                        <label class="form-check-label" for="required_new">
                            اجباری
                        </label>
                    </div>
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-success w-100">ثبت</button>
                </div>
            </form>
        </div>
    </div>

    {{-- لیست فیلدها --}}
    <div class="card">
        <div class="card-header">📋 لیست فیلدها</div>
        <div class="card-body">

            @foreach($fields as $field)
                <div class="border rounded p-3 mb-3">

                    {{-- فرم ویرایش --}}
                    <form method="POST" action="{{ route('admin.profile-fields.update', $field->id) }}" class="row g-2 align-items-end">
                        @csrf
                        @method('PUT')

                        <div class="col-md-3">
                            <input type="text" name="label" value="{{ $field->label }}" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="key" value="{{ $field->key }}" class="form-control" required>
                        </div>

                        <div class="col-md-2">
                            <select name="type" class="form-select">
                                <option value="text" {{ $field->type === 'text' ? 'selected' : '' }}>متن</option>
                                <option value="number" {{ $field->type === 'number' ? 'selected' : '' }}>عدد</option>
                                <option value="textarea" {{ $field->type === 'textarea' ? 'selected' : '' }}>متن بلند</option>
                                <option value="map" {{ $field->type === 'map' ? 'selected' : '' }}>نقشه</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="required" value="1" {{ $field->required ? 'checked' : '' }}>
                                <label class="form-check-label">اجباری</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="enabled" value="1" {{ $field->enabled ? 'checked' : '' }}>
                                <label class="form-check-label">فعال</label>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-sm btn-success">ذخیره</button>
                        </div>
                    </form>

                    {{-- فرم حذف --}}
                    <form method="POST" action="{{ route('admin.profile-fields.destroy', $field->id) }}" class="mt-2"
                          onsubmit="return confirm('حذف شود؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
