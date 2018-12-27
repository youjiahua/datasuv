@extends('admin.layout.common')
@section('header')
<title>用户角色</title>
@endsection
@section('content')
<div class="m-body">
        <div class="m-tool">
            <div class="mo-grid mo-grid--sapce">
                <div class="mo-grid-12">
                    <a href="/User/user_form" class="mo-btn mo-btn--primary">新建用户</a>
                </div>
                <div class="mo-grid-12" style="text-align:right;" >
                    <form  class="mo-form mo-form--inline" action="" method="post">
                    {{ csrf_field() }}
                       <div class="mo-form-item">
                           <span class="mo-form-item-form">
                               <input type="text" name="search[name]" class="mo-input" placeholder="输入用户名／手机" value="{{ $search['name']??$search['mobile']??'' }}">
                           </span>
                       </div>
                       <div class="mo-form-item">
                           <span class="mo-form-item-form mo-form-item-form--lg">
                               角色组：
                               <select name="search[role_id]">
                                    <option value="">请选择</option>
                               		@foreach($role as $item)
                                    <option value="{{$item->id}}" {{($search['role_id']??'')==$item->id?'selected':''}}>{{$item->name}}</option>
                               		@endforeach 
                               </select>
                           </span>
                       </div>
                       <div class="mo-form-item">
                           <button class="mo-btn mo-btn--info mo-form-btn"><span class="fa fa-search" ></span></button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
        <div class="mo-box">
            <div class="mo-box-hd">
                用户列表
            </div>
            <div class="mo-box-bd">
                <!-- Start -->
                <div class="mo-tableScroll">
                    <table class="mo-table">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    手机
                                </th>
                                <th>
                                    姓名
                                </th>
                                <th>
                                    角色组
                                </th>
                                <th>
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{get_fuzzy_mobile($item->mobile)}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->role->name}}</td>
                                <td>
                                @if($item->id!=1)
                                    <a href="/User/edit_form/{{$item->id}}" class="mo-btn mo-btn--primary">编辑</a>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End -->
                {{$list->links('admin.layout.page')}} 
            </div>
        </div>
    </div>
@endsection