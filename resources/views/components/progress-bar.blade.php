<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="progress-container">
    <div class="progress-bar">
        <div class="progress-fill" style="width: {{ ($step / 5) * 100 }}%;">
            <span class="progress-label">{{ round(($step / 5) * 100) }}%</span>
        </div>
    </div>
</div>

<style>
    .progress-container {
        width: 100%;
        margin: 20px 0;
    }

    .progress-bar {
        width: 100%;
        height: 15px;
        background-color: #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .progress-fill {
        height: 100%;
        background-color: #ff8200;
        transition: width 0.5s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        color: white;
        font-weight: bold;
        border-radius: 10px;
    }

    .progress-label {
        position: absolute;
        width: 100%;
        text-align: center;
    }
</style>
