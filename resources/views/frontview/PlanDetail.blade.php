@extends('layouts.front')
@section('content')
    <section class="container my-5">
        <div class="row g-4 align-items-center">
            <!-- Left Side Image -->
            <div class="col-md-6">
                <img src="{{ asset('upload/plan-images/'.$plans->plan_image) }}"
                    alt="Package Image" class="img-fluid rounded shadow-sm w-100 package-img" />
            </div>

            <!-- Right Side Details -->
            <div class="col-md-6">
                <h2 class="fw-bold">{{ $plans->name }}</h2>
                @if($plans->is_corporate == 0)
                  <h4 class="text-success mb-3">₹{{ $plans->amount }}</h4>
                @endif
                <p><strong>Plan Type:</strong></p>
                <ul>
                    <li>Total Member Plan: {{ $plans->no_of_members }} Members Included</li>
                    @if($plans->is_corporate == 0)
                      <li>Extra Member: {{ $plans->extra_amount_per_person }} per person</li>
                    @endif
                </ul>

                <!-- Centered Buy Button -->
                @if($plans->is_corporate == 1)
                <div class="text-center my-4 text-md-start">
                    <p>{!! $plans->lab_special_terms_and_condition !!}</p>

                </div>
                @else
                <div class="text-center my-4 text-md-start">
                    <a href="{{ route('Front.Booking', $plans->slugname) }}"
                        class="btn btn-success px-5 py-2 text-white rounded-pill">
                        Buy Now
                    </a>
                </div>
                @endif
                  <!-- Plan Details Button -->
                  <!--@if($plans->plan_detail_pdf && $plans->is_corporate == 0 )-->
                  <!--      <a href="{{ url('upload/plan-detail-pdf/'.$plans->plan_detail_pdf) }}"-->
                  <!--          class="btn btn-success px-5 py-2 text-white rounded-pill" target="_blank">-->
                  <!--          Plan Details-->
                  <!--      </a>-->
                  <!--  @elseif($plans->plan_detail_pdf && $plans->is_corporate == 0)-->
                  <!--      <button class="btn btn-secondary px-5 py-2 text-white rounded-pill" disabled>-->
                  <!--          No Plan Details Available-->
                  <!--      </button>-->
                  <!--  @endif-->


            </div>
            <div class="plan-desc mt-4">
                <h5 class="fw-bold">{{ $plans->name }} Benefits</h5>
                {!! $plans->plan_detail_image !!}
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <!--<section class="container my-5">-->
    <!--    @if($plans->is_corporate == 0)-->
    <!--    <h3 class="mb-4">Frequently Asked Questions</h3>-->
    <!--    @endif-->
    <!--    <div class="accordion" id="faqAccordion">-->
    <!--        @foreach ($plandetails as $index => $plandetail)-->
    <!--            <div class="accordion-item">-->
    <!--                <h2 class="accordion-header" id="heading{{ $index }}">-->
    <!--                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"-->
    <!--                        data-bs-target="#collapse{{ $index }}" aria-expanded="false"-->
    <!--                        aria-controls="collapse{{ $index }}">-->
    <!--                        {{ ($plandetail->service->name ?? '') . ' - ' . $plandetail->session_count }}-->
    <!--                    </button>-->
    <!--                </h2>-->
    <!--                <div id="collapse{{ $index }}" class="accordion-collapse collapse"-->
    <!--                    aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">-->
    <!--                    <div class="accordion-body">-->
    <!--                        {!! $plandetail->service_description ?? '' !!}-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</section>-->
@endsection
