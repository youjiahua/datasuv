@extends('admin.layout.common')
@section('header')
<title>角色管理</title>
@endsection
@section('content')
    <div class="m-body">
        <div class="mo-box">
            <div class="mo-box-hd">
                {{isset($role->id)?'编辑角色':'新建角色'}}
            </div>
            <div class="mo-box-bd">
                <form
                    class="mo-form mo-form--level"
                    method="post"
                    action="#"
                    data-form-ajax="true"
                    >
                    <div class="mo-form-item">
                        <span class="mo-form-item-label">角色名</span>
                        <span class="mo-form-item-form">
                            <input type="text" name="name" class="mo-input" placeholder="" value="{{ old('name') ??$role->name }}">
                        </span>
                    </div>
                    <div class="mo-form-item">
                        <span class="mo-form-item-label">权限控制</span>
                        <span class="mo-form-item-form">
                        	@if(isset($role->id))
                        	<div
                                data-tree-name="some"
                                data-tree-options="#treeJSON"
                                data-tree-value="{{$role->menus}}" 
                             >
                            </div>
                        	@else
                                <div
                                	data-tree-name="some"
                                	data-tree-options="#treeJSON"
                                 >
                        	@endif
                            </div>
                            <!-- 编辑状态
                            
                             -->
                            <script id="treeJSON" type="text/json" >
                            {!!$role_tree!!}
                            </script>
                        </span>
                    </div>
                    <div class="mo-form-item">
                        <span class="mo-form-item-label"></span>
                        <span class="mo-form-item-form">
                            <button class="mo-btn mo-btn--info">{{isset($role->id)?'编辑':'创建'}}</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection
