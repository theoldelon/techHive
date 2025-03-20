<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\ClientVerificationController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FreelancerVerificationController;
use App\Http\Controllers\admin\HireController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\PaymentsController;
use App\Http\Controllers\admin\RequestsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\freelancer\FreelancerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RecoverController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will 
| be assigned to the "web" middleware group. Make something great! 
| 
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/meet-the-team', [HomeController::class, 'browseFreelancers'])->name('browseFreelancers');
Route::get('reset-password/{token}', [RecoverController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/update', [RecoverController::class, 'resetPassword'])->name('password.update');
Route::post('/save-job-review', [ReviewController::class, 'saveReview'])->name('job.saveReview');
Route::post('/reviews-store', [ReviewController::class, 'store'])->name('reviews.store');



// Contact Form Routes
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'processContact'])->name('processContact');

Route::get('/blocked', function () { return view('front.account.blocked'); })->name('account.blocked');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobsController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('applyJob');
Route::post('/save-the-job', [JobsController::class, 'saveTheJob'])->name('saveTheJob');
Route::post('/hire-freelancer', [JobsController::class, 'hireFreelancer'])->name('hireFreelancer');
Route::get('/profile/{id}', [AccountController::class, 'show'])->name('account.show');
Route::get('/edit-hires/{hireId}', [AccountController::class, 'editHires'])->name('account.editHires');
Route::put('/edit-hires/{hireId}', [AccountController::class, 'updateHires'])->name('account.updateHires');
Route::get('/payment/{paymentId?}', [PaymentController::class, 'showPaymentForm'])->name('payment.show');
Route::post('/payment', [PaymentController::class, 'sendPayment'])->name('account.sendPayment');
Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('account.forgotPassword');
Route::post('/process-forgot-password', [AccountController::class, 'processForgotPassword'])->name('account.processForgotPassword');
Route::get('/reset-password/{token}', [AccountController::class, 'resetPassword'])->name('account.resetPassword');
Route::post('/process-reset-password', [AccountController::class, 'processResetPassword'])->name('account.processResetPassword');

Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {

    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin Users Authority
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/create-user', [UserController::class, 'processRegister'])->name('admin.users.processRegister');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Admin Jobs Authority
    Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs.jobs-list');
    Route::get('/jobs/edit/{id}', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::delete('/jobs', [JobController::class, 'destroyJob'])->name('admin.jobs.destroyJob');

    // Admin Job Applications Authority
    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('admin.jobs.jobApplications');
    Route::delete('/job-applications', [JobApplicationController::class, 'destroyJobApplication'])->name('admin.jobs.jobApplications.destroyJobApplication');

    // Admin Job Contacts Authority
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.contacts-list');
    Route::get('/contacts/view/{id}', [ContactController::class, 'view'])->name('admin.contacts.view');
    Route::delete('/contacts', [ContactController::class, 'destroyContact'])->name('admin.contacts.destroyContact');

    // Admin Hires Authority
    Route::get('/hires', [HireController::class, 'index'])->name('admin.hires.hires-list');
    Route::delete('/hires', [HireController::class, 'destroyHire'])->name('admin.hires.hires-list.destroyHire');

    // Admin Freelancer Verification Authority
    Route::get('/freelancer-verifications', [FreelancerVerificationController::class, 'index'])->name('admin.freelancer-verifications.list');
    Route::get('/freelancer-verifications/edit/{id}', [FreelancerVerificationController::class, 'edit'])->name('admin.freelancer-verifications.edit');
    Route::get('/freelancer-verifications/{freelancer}/resume/view', [FreelancerVerificationController::class, 'viewResume'])->name('admin.freelancer-verifications.view-resume');
    Route::put('/freelancer-verifications/update/{id}', [FreelancerVerificationController::class, 'update'])->name('admin.freelancer-verifications.update');
    Route::delete('/freelancer-verifications/{id}', [FreelancerVerificationController::class, 'destroyVerification'])->name('admin.freelancer-verifications.list.deleteVerification');

    // Admin Client Verification Authority
    Route::get('/client-verifications', [ClientVerificationController::class, 'index'])->name('admin.client-verifications.list');
    Route::get('/client-verifications/edit/{id}', [ClientVerificationController::class, 'edit'])->name('admin.client-verifications.edit');
    Route::put('/client-verifications/update/{id}', [ClientVerificationController::class, 'update'])->name('admin.client-verifications.update');
    Route::delete('/client-verifications/{id}', [ClientVerificationController::class, 'destroyVerification'])->name('admin.client-verifications.list.deleteVerification');

    // Admin Payments Authority
    Route::get('/payments', [PaymentsController::class, 'list'])->name('admin.payments.list');
    Route::get('/payments/edit/{id}', [PaymentsController::class, 'edit'])->name('admin.payments.edit');
    Route::put('/payments/update/{id}', [PaymentsController::class, 'update'])->name('admin.payments.update');

    // Admin Requests Authority
    Route::get('/requests', [RequestsController::class, 'list'])->name('admin.requests.list');
    Route::get('/requests/edit/{id}', [RequestsController::class, 'edit'])->name('admin.requests.edit');
    Route::put('/requests/update/{id}', [RequestsController::class, 'update'])->name('admin.requests.update');
});

Route::group(['prefix' => 'freelancer', 'middleware' => 'checkFreelancer'], function () {
    // Freelancer Dashboard
    Route::get('/freelancer-dashboard', [FreelancerController::class, 'freelancerDashboard'])->name('freelancer.freelancer-dashboard');
    Route::get('/verify-now', [FreelancerController::class, 'verifyNow'])->name('freelancer.verify-now');
    Route::post('/verify-credentials', [FreelancerController::class, 'verifyCredentials'])->name('freelancer.verifyCredentials');
    
    // Make sure this route matches the link in the Blade file
    Route::get('/transactions/{id}', [FreelancerController::class, 'hireDetails'])->name('freelancer.hire-details');
    Route::put('/update-transactions/{id}', [FreelancerController::class, 'updateLink'])->name('freelancer.updateLink');
});

Route::group(['prefix' => 'account'], function () {

    // Guest Routes
    Route::group(['middleware' => 'guest','preventCacheLogin'], function () {
        Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::get('/client-register', [AccountController::class, 'clientRegistration'])->name('account.clientRegistration');
        Route::get('/freelancer-register', [AccountController::class, 'freelancerRegistration'])->name('account.freelancerRegistration');
        Route::post('/process-client-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::post('/process-freelance-register', [AccountController::class, 'processFreelancerRegistration'])->name('account.processFreelancerRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
    });

    // Authenticated Routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/accountPassword', [AccountController::class, 'accountPassword'])->name('account.accountPassword');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::post('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');
        Route::get('/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
        Route::post('/save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');
        Route::get('/my-requests', [AccountController::class, 'myRequests'])->name('account.myRequests');
        Route::post('/feature-request', [AccountController::class, 'featureRequest'])->name('account.featureRequest');
        Route::get('/my-jobs', [AccountController::class, 'myJobs'])->name('account.myJobs');
        Route::get('/my-jobs/edit/{jobId}', [AccountController::class, 'editJob'])->name('account.editJob');
        Route::post('/update-job/{jobId}', [AccountController::class, 'updateJob'])->name('account.updateJob');
        Route::post('/delete-job/', [AccountController::class, 'deleteJob'])->name('account.deleteJob');
        Route::get('/hires', [AccountController::class, 'hiredFreelancers'])->name('account.hires');
        Route::post('/update-hires/{hireId}', [AccountController::class, 'updateJob'])->name('account.updateJob');
        Route::get('/my-job-applications', [AccountController::class, 'myJobApplications'])->name('account.myJobApplications');

        Route::post('/remove-job-application', [AccountController::class, 'removeJobs'])->name('account.removeJobs');
        Route::get('/saved-jobs', [AccountController::class, 'savedJobs'])->name('account.savedJobs');
        Route::post('/remove-saved-job', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');
        Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
        Route::get('/verify-now', [AccountController::class, 'verifyNow'])->name('account.client-verify');
        Route::post('/verify-credentials', [AccountController::class, 'verifyCredentials'])->name('account.client-verify.verifyCredentials');
    });
});
