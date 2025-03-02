@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')

                <form action="" method="post" id="createJobForm" name="createJobForm">
                    @csrf
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Title<span class="req">*</span></label>
                                    <input type="text" placeholder="Job Title" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Job Type<span class="req">*</span></label>
                                    <select name="jobType" id="jobType" class="form-select @error('jobType') is-invalid @enderror">
                                        <option value="">Select Job Type</option>
                                        @if ($jobTypes->isNotEmpty())
                                            @foreach ($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}" {{ old('jobType') == $jobType->id ? 'selected' : '' }}>{{ $jobType->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('jobType')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="" class="mb-2">Vacant Position<span class="req">*</span></label>
                                    <input type="text" placeholder="Vacant Position" id="vacancy" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror" value="{{ old('vacancy') }}">
                                    @error('vacancy')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Salary</label>
                                    <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}">
                                    @error('salary')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location<span class="req">*</span></label>
                                    <input type="text" placeholder="Location" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                                    @error('location')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Description<span class="req">*</span></label>
                                <textarea class="textarea @error('description') is-invalid @enderror" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Benefits</label>
                                <textarea class="textarea @error('benefits') is-invalid @enderror" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ old('benefits') }}</textarea>
                                @error('benefits')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Responsibility</label>
                                <textarea class="textarea @error('responsibility') is-invalid @enderror" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ old('responsibility') }}</textarea>
                                @error('responsibility')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Qualifications</label>
                                <textarea class="textarea @error('qualifications') is-invalid @enderror" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ old('qualifications') }}</textarea>
                                @error('qualifications')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Experience <span class="req">*</span></label>
                                <select name="experience" id="experience" class="form-control @error('experience') is-invalid @enderror">
                                    <option value="1" {{ old('experience') == 1 ? 'selected' : '' }}>0 - 1 Year</option>
                                    <option value="2" {{ old('experience') == 2 ? 'selected' : '' }}>2 Years</option>
                                    <option value="3" {{ old('experience') == 3 ? 'selected' : '' }}>3 Years</option>
                                    <option value="4" {{ old('experience') == 4 ? 'selected' : '' }}>4 Years</option>
                                    <option value="5" {{ old('experience') == 5 ? 'selected' : '' }}>5 Years</option>
                                    <option value="6" {{ old('experience') == 6 ? 'selected' : '' }}>6 Years</option>
                                    <option value="7" {{ old('experience') == 7 ? 'selected' : '' }}>7 Years</option>
                                    <option value="8" {{ old('experience') == 8 ? 'selected' : '' }}>8 Years</option>
                                    <option value="9" {{ old('experience') == 9 ? 'selected' : '' }}>9 Years</option>
                                    <option value="10" {{ old('experience') == 10 ? 'selected' : '' }}>10 Years</option>
                                    <option value="10_plus" {{ old('experience') == '10_plus' ? 'selected' : '' }}>10+ Years</option>
                                </select>
                                @error('experience')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Keywords</label>
                                <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords') }}">
                                @error('keywords')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="company_logo" class="mb-2">Company Logo</label>
                                    <input type="file" name="company_logo" id="company_logo" class="form-control @error('company_logo') is-invalid @enderror">
                                    @error('company_logo')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Name<span class="req">*</span></label>
                                    <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}">
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Location</label>
                                    <input type="text" placeholder="Location" id="company_location" name="company_location" class="form-control @error('company_location') is-invalid @enderror" value="{{ old('company_location') }}">
                                    @error('company_location')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}">
                                    @error('website')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div> 
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Save Job</button>
                        </div>               
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection


@section('customJs')
<script type="text/javascript">
$("#createJobForm").submit(function (e) {
    e.preventDefault();
    $("button[type='submit']").prop('disabled', true);

    // Create a FormData object
    let formData = new FormData(this);
    formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token

    $.ajax({
        url: '{{ route("account.saveJob") }}',
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false, // Prevent jQuery from processing data
        contentType: false, // Prevent jQuery from setting content type
        success: function (response) {
            $("button[type='submit']").prop('disabled', false);

            if (response.status === true) {
                window.location.href = "{{ route('account.myJobs') }}";
            } else {
                // Handle validation errors
                var errors = response.errors;
                if (errors && errors.company_logo) {
                    $("#company_logo").addClass('is-invalid');
                    $("#image-error").html(errors.company_logo).addClass('invalid-feedback');
                } else {
                    $("#company_logo").removeClass('is-invalid');
                    $("#image-error").html('').removeClass('invalid-feedback');
                }
            }
        },
        error: function (xhr) {
            $("button[type='submit']").prop('disabled', false);
            console.log(xhr.responseText);
        }
    });
});

</script>
@endsection

