@extends('layouts.front')
@section('content')
    <style>
        .text-red-500 {
            color: red;
        }
    </style>
    <section class="py-2 bg-light AccesibleServiceBody" id="partner-with-us">
        <div class="container">
            <!--<h2 class="fw-bold text-center mb-5">-->
            <!--    <span class="text-1">Book</span>-->
            <!--    <span class="text-2">Now</span>-->
            <!--</h2>-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('checkoutstore') }}" method="POST">
                @csrf
                <div class="row  justify-content-between">
                    <div class="col-md-6 mt-3 order-2 order-md-1">
                        <div class='row'>
                            <h2 class="fw-bold text-center mb-3">
                <span class="text-1">Book</span>
                <span class="text-2">Now</span>
            </h2>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required
                                placeholder="Enter Your name" value="{{ old('name') }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Enter Your email" value="{{ old('email') }}" />
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Mobile Number <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" required
                                placeholder="Enter Your number" value="{{ old('mobile') }}" />
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="name" class="form-label">Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" id="address" class="form-control" required
                                placeholder="Enter Your Address" value="{{ old('address') }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">State <span class="text-red-500">*</span></label>
                            <input type="text" name="state" id="state" class="form-control" required
                                placeholder="Enter your State" value="{{ old('state') }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" id="city" class="form-control" required
                                placeholder="Enter Your City" value="{{ old('city') }}" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Pincode <span class="text-red-500">*</span></label>
                            <input type="text" name="pincode" id="pincode" class="form-control" required
                                placeholder="Enter Your Pincode" value="{{ old('pincode') }}" />
                        </div>
                        </div>
                        <div class="text-end">
                        <button type="submit" class="btn  btn-success text-white rounded-pill px-4 py-2">
                            Book Now
                        </button>
                        </div>
                    </div>

                
                    
                    <div class="col-md-5 mt-3 order-1 order-md-2">
                      <div class="card shadow-sm border-0">
                        <div class="card-body">
                          <!--<h5 class="card-title mb-4">Plan Details</h5>-->
                          <h2 class="fw-bold text-center mb-3">
                                    <span class="text-1">Plan</span>
                                    <span class="text-2">Details</span>
                                </h2>
                                
                                <!-- next two fields -->
                          <div class="row mb-3">
                              <div class="col-md-4 mb-2 mb-md-0">
                              <label class="form-label">Plan Name:</label>
                              <!--<p class="form-control-plaintext mb-0">{{ $plans->name }}</p>-->
                              <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{ $plans->name }}" readonly  />
                            </div>
                            <div class="col-md-4">
                              <label class="form-label">Plan Amount:</label>
                              <!--<p class="form-control-plaintext mb-0" id="plan_amount">{{ $plans->amount }}</p>-->
                              <input type="text" class="form-control" id="plan_amount" name="plan_amount_display" value="{{ $plans->amount }}" readonly  />
                            </div>
                            <div class="col-md-4 ">
                              <label class="form-label">Duration Days:</label>
                              <!--<p class="form-control-plaintext mb-0">{{ $plans->duration_in_days }}</p>-->
                              <input type="text" class="form-control" id="duration_days" name="duration_days_display" value="{{ $plans->duration_in_days }}" readonly  />
                            </div>
                          </div>
                    
                          <!-- first two fields in one row -->
                          <div class="row mb-3">
                            
                            
                          </div>
                    
                          <!-- next two fields in one row -->
                          <div class="row mb-3">
                              <div class="col-md-6 mb-2 mb-md-0">
                              <label for="start_date" class="form-label">Start Date: <span class="text-red-500">*</span></label>
                              <input type="date" class="form-control" id="start_date" name="start_date" required />
                            </div>
                            <div class="col-md-6">
                              <label for="end_date" class="form-label">End Date:</label>
                              <input type="date" class="form-control" id="end_date" name="end_date" readonly />
                            </div>
                            
                          </div>
                    
                          <!-- next two fields -->
                          <div class="row mb-3">
                              <div class="col-md-6 mb-2 mb-md-0">
                              <label class="form-label">Total Member Plan:</label>
                              <!--<p class="form-control-plaintext mb-0">{{ $plans->no_of_members }}</p>-->
                              <input type="text" class="form-control" id="total_member_plan" name="total_member_plan_display" value="{{ $plans->no_of_members }}" readonly  />
                            </div>
                            <div class="col-md-6">
                              <label class="form-label">Extra Member Amount Per Person:</label>
                              <!--<p class="form-control-plaintext mb-0" id="extra_amount">{{ $plans->extra_amount_per_person }}</p>-->
                              <input type="text" class="form-control" id="extra_amount" name="extra_amount_display" value="{{ $plans->extra_amount_per_person }}" readonly  />   
                            </div>
                          </div>
                    
                          <!-- last field (can pair with another if needed) -->
                          <div class="row mb-3">
                              <div class="col-md-6 mb-2 mb-md-0">
                              <label for="extra_memeber" class="form-label">Extra Member:</label>
                              <select name="extra_memeber" id="extra_memeber" class="form-control">
                                <option value="">Please Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label for="net_amount" class="form-label">Net Amount:</label>
                              <input type="text" class="form-control" id="net_amount" name="net_amount" maxlength="10"
                                placeholder="Enter Net Amount" readonly
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                            </div>
                          </div>
                    
                          <!-- keep your hidden inputs as-is -->
                          <input type="hidden" name="plan_member" value="{{ $plans->no_of_members }}">
                          <input type="hidden" name="plan_id" value="{{ $plans->id }}">
                          <input type="hidden" name="plan_amount" value="{{ $plans->amount }}">
                          <input type="hidden" name="extra_amount_per_person" value="{{ $plans->extra_amount_per_person }}">
                          <input type="hidden" name="Guid" value="{{ $guid }}">
                    
                        </div>
                      
                      </div>
                   </div>

                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Elements
  const extraMemberSelect = document.getElementById('extra_memeber');
  const netAmountInput    = document.getElementById('net_amount');

  // Read from the HIDDEN fields (safest; unformatted numbers)
  const planAmountRaw           = document.querySelector('input[name="plan_amount"]')?.value;
  const extraPerPersonAmountRaw = document.querySelector('input[name="extra_amount_per_person"]')?.value;

  // Helper: robust number parser
  const toNumber = (v) => {
    if (v == null) return 0;
    const n = parseFloat(String(v).replace(/,/g, '').trim());
    return isNaN(n) ? 0 : n;
  };

  const PLAN_AMOUNT = toNumber(planAmountRaw);
  const EXTRA_PER_PERSON = toNumber(extraPerPersonAmountRaw);

  function updateNetAmount() {
    const extraMembers = parseInt(extraMemberSelect.value, 10) || 0;
    const net = PLAN_AMOUNT + (extraMembers * EXTRA_PER_PERSON);
    netAmountInput.value = net.toFixed(2); // keep 2 decimals
  }

  // Init & bind
  updateNetAmount();
  extraMemberSelect.addEventListener('change', updateNetAmount);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const startDateInput = document.getElementById('start_date');
  const endDateInput   = document.getElementById('end_date');
  const durationInDays = {{ $plans->duration_in_days ?? 0 }};
  
  function formatDate(date) {
    return date.toISOString().split('T')[0];
  }

  // --- Default start date = today + 2 days ---
  const today = new Date();
  today.setDate(today.getDate() + 2); 
  startDateInput.value = formatDate(today);

  // --- Calculate and set end date immediately ---
  if (durationInDays > 0) {
    const endDate = new Date(today);
    endDate.setDate(today.getDate() + durationInDays - 1);
    endDateInput.value = formatDate(endDate);
  }

  startDateInput.addEventListener('change', function () {
    const startDateValue = startDateInput.value;
    if (startDateValue && durationInDays > 0) {
      const startDate = new Date(startDateValue);
      const endDate = new Date(startDate);
      // inclusive range: add (duration - 1)
      endDate.setDate(startDate.getDate() + durationInDays - 1);
      endDateInput.value = endDate.toISOString().split('T')[0];
    } else {
      endDateInput.value = '';
    }
  });
});
</script>
@endsection

