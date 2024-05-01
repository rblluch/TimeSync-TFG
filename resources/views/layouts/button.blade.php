
@php

    $bgColor = '';
    $colorWeight = '';
    $colorHoverWeight = '';

    $defaultColor = 'gray';
    $defaultHover = $defaultColor;

    $defaultColorWeight = '700';
    $defaultHoverWeight = '600';

    $finalColor = $defaultColor;
    $finalHover = $defaultHover;
    $finalColorWeight = $defaultColorWeight;
    $finalHoverWeight = $defaultHoverWeight;
    
    if (isset($color)){
        $finalColor = $color;
        $finalHover = $finalColor;
    }
    if(isset($hover)){
        $finalHover = $hover;
    }
    if(isset($weight)){
        $colorWeight = $weight;
        $colorHoverWeight = $colorWeight - 100;
    }

    $bgColor = 'bg-'.$finalColor.'-'.$finalColorWeight;
    $bghover = 'bg-'.$finalHover.'-'.$finalHoverWeight;
    
@endphp


<button class="{{$bgColor}} hover:{{$bghover}} text-white font-bold py-2 px-4 rounded">
    <a href="{{route($url)}}" class="btn">{{$text}}</a>
</button>