<div class="progress-container">
    @for ($i = 6; $i <= 10; $i++)
        <div class="progress-step {{ $step >= $i ? 'active' : '' }}"></div>
    @endfor
</div>

<style>
    .progress-container {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    .progress-step {
        width: 20%;
        height: 10px;
        background-color: lightgray;
        transition: background-color 0.3s;
    }

    .progress-step.active {
        background-color: #3498db;
    }
</style>
