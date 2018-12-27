@extends('admin.layout.common')
@section('header')
<title>角色管理</title>
@endsection
@section('content')
    <div class="m-body">
            <div class="m-tool">
            <div class="mo-grid mo-grid--sapce">
                <div class="mo-grid-12"> 
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
                           <button class="mo-btn mo-btn--info mo-form-btn"><span class="fa fa-search" ></span></button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
        <div class="mo-box">
            <div class="mo-box-hd">
                短信发送日志
            </div>
            <div class="mo-box-bd">
                <!-- Start -->
                <div class="mo-tableScroll">
                    <table class="mo-table">
                        <thead>
                            <tr>
                                <th>
                                    手机
                                </th>
                                <th>
                                    短信类型
                                </th>
                                <th>
                                    发送内容
                                </th>
                                <th>
                                    发送时间
                                </th>
                                <th>
                                    接口ID
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>{{get_fuzzy_mobile($item->mobile)}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->content}}</td>
                                <td>{{$item->send_time}}</td>
                                <td>
                                    {{$item->api_id}}
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
