    <div class="m-menu">
        <div class="m-menu-inner">
        @foreach($menus[$head_active]['children'] as $key=>$menu)
        	<a class="m-menu-item {{$active==$key?'m-menu-item--on':''}}" href="{{$menu['link']}}">{{$menu['name']}}</a>
        @endforeach            
        </div>
    </div>