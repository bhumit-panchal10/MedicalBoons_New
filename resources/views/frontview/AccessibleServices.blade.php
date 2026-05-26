@extends('layouts.front')

@section('content')
    <div class="py-5 headsec accessibleServicesStyle BackGroundColor">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="display-4">
                    <span style="font-size: 35px; color: forestgreen">Our Trusted Network</span>

                    <span style="font-size: 35px; color: palevioletred">
                        & Partners</span>
                </h2>
                <p class="lead text-muted">
                    We work with industry leaders to bring the best services to you.
                </p>
            </div>
        </div>

       <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @forelse($ourpartners as $ourpart)
                <div class="col text-center">
                    <img src="{{ asset('upload/OurClient-images/' . $ourpart->image) }}"
                        alt="{{ $ourpart->name ?? 'Partner' }}"
                        class="img-fluid partner-logo" />
                    <h5 class="mt-3">{{ $ourpart->name ?? '' }}</h5>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No partners available at the moment.</p>
                </div>
            @endforelse
     </div>

    </div>
@endsection
