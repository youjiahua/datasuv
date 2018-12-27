@extends('admin.layout.common')
@section('header')
<title>新建用户</title>
@endsection
@section('content')
    <div class="m-body">
        <div class="mo-box">
            <div class="mo-box-hd">
                新建用户
            </div>
            <div class="mo-box-bd">
                <form
                    class="mo-form mo-form--level"
                    method="post"
                    action="#"
                    data-form-ajax="true"
                    >
                    <div class="mo-form-item">
                        <span class="mo-form-item-label">手机号</span>
                        <span class="mo-form-item-form">
                            <input type="text" name="mobile" class="mo-input" placeholder="" value="{{old('mobile')??$admin->mobile}}">
                        </span>
                    </div>
                    <div class="mo-form-item">
                        <span class="mo-form-item-label">姓名</span>
                        <span class="mo-form-item-form">
                            <input type="text" name="name" class="mo-input" placeholder="" value="{{old('name')??$admin->name}}">
                        </span>
                    </div>
                    <div class="mo-form-item">
                        <span class="mo-form-item-label">密码</span>
                        <span class="mo-form-item-form">
                            <input type="text" name="password" class="mo-input" placeholder="" value="{{old('password')??''}}">
                        </span>
                    </div>
                    <div class="mo-form-item">
                        <span class="mo-form-item-label">角色</span>
                        <span class="mo-form-item-form">
                            <select name="role_id">
                                <option value="">选择角色</option>
                            	@foreach($role as $item)
                                <option value="{{$item->id}}" {{ (old('role_id') ?? $admin->role_id)== $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                            	@endforeach 
                            </select>
                        </span>
                    </div>
                    <div class="mo-form-item">
                        <span class="mo-form-item-label"></span>
                        <span class="mo-form-item-form">
                            <button class="mo-btn mo-btn--info">创建</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
