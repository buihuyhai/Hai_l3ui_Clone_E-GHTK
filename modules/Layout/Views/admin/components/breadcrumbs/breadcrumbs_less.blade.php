<div class="pagetitle">
    <h1>{{$page_title ?? ''}}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{__("Trang Chủ")}}</a></li>
            @if(!empty($breadcrumbs))
                @foreach($breadcrumbs as $key => $breadcrumb)
                    @if(isset($breadcrumb["url"]))
                        <li class="breadcrumb-item">
                            <a href="{{$breadcrumb["url"]}}">{{$breadcrumb["name"]}}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item {{$breadcrumb["class"]}}">
                            {{$breadcrumb["name"]}}
                        </li>
                    @endif
                @endforeach
            @endif
        </ol>
    </nav>
</div>
<!-- End Page Title -->
