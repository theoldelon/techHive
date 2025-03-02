@extends('front.layouts.tailwind')

@section('main')

<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-4">
      <div class="bg-white rounded-lg shadow-lg p-6 md:p-10 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Freelancer Register</h1>
  
        <!-- Progress Bar -->
        <div class="mb-8">
          <div class="flex justify-between mb-2">
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200" id="step1">
                          Personal Info
                      </span>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 opacity-50" id="step2">
                          Account Details
                      </span>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200 opacity-50" id="step3">
                          Preferences
                      </span>
          </div>
          <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
            <div id="progress-bar"
              class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500 w-1/3 transition-all duration-500 ease-in-out">
            </div>
          </div>
        </div>
  
        <!-- Form Steps -->
        <form action="" name="freelancerRegistrationForm" id="freelancerRegistrationForm">
        @csrf
        <input type="hidden" name="role" value="{{ request('role') }}">
          <!-- Step 1: Personal Information -->
          <div id="step-1" class="step">
            <div class="mb-6">
                <h1 class="text-xl font-bold text-left mb-8">Name</h1>
                <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                <input type="text" name="firstName" id="firstName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>

            <div class="mb-6">
              <label for="midName" class="block mb-2 text-sm font-medium text-gray-900">Middle Name</label>
              <input type="text" name="midName" id="midName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>

            <div class="mb-6">
              <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
              <input type="text" name="lastName" id="lastName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>
            
            <div class="mb-6">
                <h1 class="text-xl font-bold text-left mb-8">Additional Information</h1>
              <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Complete Address</label>
              <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>

            <div class="mb-6">
              <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
              <input type="tel" name="mobile" id="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>
          </div>
  
          <!-- Step 2: Account Details -->
          <div id="step-2" class="step hidden">
            <div class="mb-6">
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
              <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>
            
            <div class="mb-6">
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
              <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>
            
            <div class="mb-6">
                <label for="confirmPassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5" required>
                <p></p>
            </div>
          </div>
  
          <!-- Step 3: Preferences -->
          <div id="step-3" class="step hidden">
            <div class="mb-6">
              <label class="block mb-2 text-sm font-medium text-gray-900">Preferred Contact Method</label>
              <div class="flex items-center mb-4">
                <input id="contact-email" type="radio" name="contact_method" value="1" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                <label for="contact-email" class="ml-2 text-sm font-medium text-gray-900">Email</label>
                <p></p>
            </div>

              <div class="flex items-center">
                  <input id="contact-phone" type="radio" name="contact_method" value="0" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                  <label for="contact-phone" class="ml-2 text-sm font-medium text-gray-900">Phone</label>
                    <p></p>
            </div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 mb-4">Preferred Contact Time</label>

                <div class="flex items-center mb-4">
                    <input id="1" type="radio" name="contact_time" value="1" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                    <label for="1" class="ml-2 text-sm font-medium text-gray-900">Anytime</label>
                    <p></p>
                </div>
                
                <div class="flex items-center mb-4">
                  <input id="2" type="radio" name="contact_time" value="2" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                  <label for="2" class="ml-2 text-sm font-medium text-gray-900">8 AM - 11:30 AM</label>
                  <p></p>
                </div>

                <div class="flex items-center mb-4">
                  <input id="3" type="radio" name="contact_time" value="3" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                  <label for="3" class="ml-2 text-sm font-medium text-gray-900">11:31 AM - 2:30 PM</label>
                  <p></p>
                </div>

                <div class="flex items-center mb-4">
                  <input id="4" type="radio" name="contact_time" value="4" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                  <label for="4" class="ml-2 text-sm font-medium text-gray-900">2:31 PM - 5 PM</label>
                  <p></p>
                </div>
            </div>
          </div>
  
          <!-- Navigation Buttons -->
          <div class="flex justify-between mt-8">
            <button type="button" id="prevBtn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:shadow-outline hidden">Previous</button>
            <button type="button" id="nextBtn" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:shadow-outline">Next</button>
            <button type="submit" id="submitBtn" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:shadow-outline hidden">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    let currentStep = 1;
          const form = document.getElementById('multi-step-form');
          const prevBtn = document.getElementById('prevBtn');
          const nextBtn = document.getElementById('nextBtn');
          const submitBtn = document.getElementById('submitBtn');
          const progressBar = document.getElementById('progress-bar');
  
          function showStep(step) {
              document.querySelectorAll('.step').forEach(s => s.classList.add('hidden'));
              document.getElementById(`step-${step}`).classList.remove('hidden');
              
              progressBar.style.width = `${(step / 3) * 100}%`;
              for (let i = 1; i <= 3; i++) {
                  const stepIndicator = document.getElementById(`step${i}`);
                  if (i <= step) {
                      stepIndicator.classList.remove('opacity-50');
                  } else {
                      stepIndicator.classList.add('opacity-50');
                  }
              }
  
              prevBtn.classList.toggle('hidden', step === 1);
              nextBtn.classList.toggle('hidden', step === 3);
              submitBtn.classList.toggle('hidden', step !== 3);
          }
  
          function validateStep(step) {
              const currentStepElement = document.getElementById(`step-${step}`);
              const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
              let isValid = true;
  
              inputs.forEach(input => {
                  if (!input.value) {
                      isValid = false;
                      input.classList.add('border-red-500');
                  } else {
                      input.classList.remove('border-red-500');
                  }
              });
  
              if (step === 2) {
                  const password = document.getElementById('password');
                  const confirmPassword = document.getElementById('confirmPassword');
                  if (password.value !== confirmPassword.value) {
                      isValid = false;
                      confirmPassword.classList.add('border-red-500');
                      alert("Passwords do not match");
                  }
              }
  
              return isValid;
          }
  
          nextBtn.addEventListener('click', () => {
              if (validateStep(currentStep)) {
                  currentStep++;
                  showStep(currentStep);
              }
          });
  
          prevBtn.addEventListener('click', () => {
              currentStep--;
              showStep(currentStep);
          });
  
          form.addEventListener('submit', (e) => {
              e.preventDefault();
              if (validateStep(currentStep)) {
                  alert('Form submitted successfully!');
                  // Here you would typically send the form data to a server
              }
          });
  
          showStep(currentStep);
  </script>
@endsection

@section('customJs')
    <script>
        $("#freelancerRegistrationForm").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: '{{ route("account.processFreelancerRegistration") }}',
                type: 'post',
                data: $("#freelancerRegistrationForm").serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if(response.status == false) {
                        var errors = response.errors;
                            if (errors.firstName) {
                                $("#firstName").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.firstName)
                            } else {
                                $("#firstName").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                            if (errors.midName) {
                                $("#midName").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.midName)
                            } else {
                                $("#midName").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                            if (errors.lastName) {
                                $("#lastName").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.lastName)
                            } else {
                                $("#lastName").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                            if (errors.address) {
                                $("#address").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.address)
                            } else {
                                $("#address").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                            if (errors.email) {
                                $("#email").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email)
                            } else {
                                $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                            if (errors.password) {
                                $("#password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.password)
                            } else {
                                $("#password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }

                            if (errors.confirmPassword) {
                                $("#confirmPassword").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.confirmPassword)
                            } else {
                                $("#confirmPassword").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback')
                                .html('')
                            }
                    } else {
                        $("#firstName").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $("#midName").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $("#lastName").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $("#address").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $("#email").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        $("#password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');    

                        $("#confirmpassword").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');

                        window.location.href='{{ route("account.login") }}';
                    }
                }
            });
        });
    </script>
@endsection