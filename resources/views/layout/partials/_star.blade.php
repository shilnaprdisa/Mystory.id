<div class="rating mb-0">
    @for ($i = 0; $i < 5; $i++) @if ($i < $rating) <i class="fas fa-star filled"></i>
        @else
        <i class="fas fa-star"></i>
        @endif
        @endfor
        <span class="d-inline-block average-rating">
            <span>{{number_format((float)$rating, 1, '.', '')}}</span>
        </span>
</div>
