<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('scripts/menu.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="{{ asset('css/dineOrdering.css') }}">

<div class="border-container">
    <div class="logo">
        <img src="{{ asset('/jollibee.png') }}" alt="Logo">
    </div>

    <div class="header-section">
        <h2 class="text-5xl font-bold">Choose one</h2>
    </div>

    <div class="options-section">
        <div class="option dine-in" onclick="handleOptionSelection('dine-in')">
            <img src="{{ asset('/dinein.png') }}" alt="Dine In">
            <h3>Dine In</h3>
        </div>
        <div class="option takeout" onclick="handleOptionSelection('takeout')">
            <img src="{{ asset('/takeout.png') }}" alt="Takeout">
            <h3>Takeout</h3>
        </div>

        <script>
            function handleOptionSelection(option) {
            if (option === 'dine-in') {
                window.location.href = '{{ url('/payment?type=dine-in') }}';
            } else if (option === 'takeout') {
                window.location.href = '{{ url('/payment?type=takeout') }}';
            }
            }
        </script>
    </div>
</div>

<style>
    .border-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        max-width: 400px;
        margin: 50px auto;
        border: 1px solid #ccc;
        border-radius: 15px;
        background: linear-gradient(to bottom,rgba(156, 133, 133, 0.8),rgba(244, 67, 54, 0.75)); /* Red gradient similar to the image */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }
    .logo {
        display: flex; 
        justify-content: center;
    }

    .logo img {
        max-width: 50%;
        height: auto;
    }

    .header-section h2 {
        font-size: 1.5rem;
        text-align: center;
        margin: 20px 0;
    }

    .options-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .option {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
        max-width: 150px;
    }

    .option img {
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    .option h3 {
        font-size: 1rem;
        margin: 0;
    }

    .option:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .header-section h2 {
            font-size: 1.2rem;
        }

        .option {
            max-width: 120px;
        }

        .option h3 {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .options-section {
            flex-direction: column;
            gap: 15px;
        }

        .option {
            max-width: 100%;
        }
    }
</style>

