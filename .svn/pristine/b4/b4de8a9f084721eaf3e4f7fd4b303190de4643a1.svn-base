@extends('admin.layout.common')
@section('header')
<title>角色管理</title>
@endsection
@section('content')
	<div class="m-body">
        <div class="m-tool">
            <a href="/Role/role_form" class="mo-btn mo-btn--primary">新建角色</a>
        </div>
        <div class="mo-box">
            <div class="mo-box-hd">
                角色列表
            </div>
            <div class="mo-box-bd">
                <!-- Start -->
                <div class="mo-tableScroll">
                    <table class="mo-table">
                        <thead>
                            <tr>
                                <th>
                                    角色名
                                </th>
                                <th>
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                        <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                	@if($item->id!=1)
                                    <a href="{{asset('/Role/edit_form/'.$item->id)}}" class="mo-btn mo-btn--primary">编辑</a>
                                	@endif
                                </td>
                            </tr>
                        @endforeach                            
                        </tbody>
                    </table>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
@endsection 
