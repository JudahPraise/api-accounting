<div class="card" id="student">
    <div class="card-body">
        <div class="card-px text-center pt-15 pb-15">
            <h2 class="fs-2x fw-bold mb-0">Search Student</h2>
            <p class="text-gray-400 fs-4 fw-semibold py-7"> Click on the below buttons to search student.</p>
            <a id="search_student" class="btn btn-primary er fs-6 px-8 py-4">Search Student</a>
        </div>
        
        <div class="text-center pb-15 px-5">
            <img src="{{ asset('/assets/media/illustrations/sketchy-1/search-state.png') }}" alt=""
                class="mw-100 h-200px h-sm-325px">
        </div>
    </div>
</div>

<x-modal />

<script type="module" src="{{ asset('app/Assessment.js') }}"></script>
