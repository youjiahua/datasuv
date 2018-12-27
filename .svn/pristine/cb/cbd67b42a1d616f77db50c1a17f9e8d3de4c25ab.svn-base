    <div class="m-head">
        <div class="m-head-inner">
            <a class="m-head-logo" href="/" >
                <img src="{{asset('/common/logo.png')}}" alt="" class="m-head-logo-photo" />
            </a>
            <div class="m-head-nav">
            	@foreach($menus as $key=>$menu)
            		<a href="{{$menu['link']}}" class="m-head-nav-item  {{$head_active==$key?'m-head-nav-item--on':''}}">{{$menu['name']}}</a>
            	@endforeach 
            </div>
            <div class="m-head-user">
                <div href="#" class="m-head-user-link m-head-user-link--edit">账户编辑</div>
                <div href="#" class="m-head-user-link m-head-user-link--user">Hi,{{$admin['name']}}</div>
                <a href="/Auth/logout" class="m-head-user-link m-head-user-link--exit">退出</a>
            </div>
        </div>
    </div>