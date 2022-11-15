<!-- /pagination -->
@if ($lastPage > 1)
@php
$prevous = $currentPage - 1;
$next = $currentPage + 1;
@endphp
<div class="row">
    <div class="col-md-12">
        <ul class="pagination lms-page mt-0">
            <li class="page-item prev">
                <form action="" method="get">
                    <input type="hidden" name="page" value="{{$prevous}}">
                    <button type="submit" @if($currentPage <=1) disabled @endif class="page-link" tabindex="-1"><i
                            class="fas fa-angle-left"></i></button>
                </form>
            </li>
            @for ($i = 1; $i <= $lastPage; $i++)
                <li class="page-item @if($currentPage == $i) first-page active @endif">
                    <form action="{{request()->url()}}" method="get">
                        @foreach ($params as $key => $param)
                            @if ($param)
                                <input type="hidden" name="{{$key}}" value="{{$param}}">                                
                            @endif
                        @endforeach
                        <input type="hidden" name="page" value="{{$i}}">
                        <button type="submit" class="page-link">{{$i}}</button>
                    </form>
                </li>
            @endfor
                <li class="page-item next">
                    <form action="" method="get">
                        <input type="hidden" name="page" value="{{$next}}">
                        <button type="submit" @if($currentPage>= $lastPage) disabled @endif
                            class="page-link"><i class="fas fa-angle-right"></i></button>
                    </form>
                </li>
        </ul>
    </div>
</div>
@endif
<!-- /pagination -->
