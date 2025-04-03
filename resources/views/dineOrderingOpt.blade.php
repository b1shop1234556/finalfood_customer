<link rel="stylesheet" href="{{ asset('css/dineOrdering.css') }}">

<div class="logo">
    <img src="{{ asset('/jollibee.png') }}" alt="Logo">
</div>

<div class="header-section">
    <h2>Where will you be eating today?</h2>
</div>

<div class="options-section">
    <div class="option" onclick="window.location.href='{{ url('/menu') }}'">
        <img src="{{ asset('/dinein.png') }}" alt="Eat In">
        <h3 class="option-btn">Dine In</h3>
    </div>
    <div class="option" onclick="window.location.href='{{ url('/take-out') }}'">
        <img src="{{ asset('/takeout.png') }}" alt="Take Out">
        <h3 class="option-btn">Take Out</h3>
    </div>
</div>
