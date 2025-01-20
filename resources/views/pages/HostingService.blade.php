@extends('layouts.app')
@section('title', 'Hosting Service - Digital Startups')
@section('content')
<section class="blue-bg w-100 d-block py-5 blue-bg-mt">
    <div class="container">
         <div class="row px-md-0 px-4">
             <h1 class="white-txt w-100 d-block pb-3">
                 HOSTING SERVICE
             </h1>
             <p class="d-block pb-1">A domain is the name of any website and to host the same website in the internet hosting space is required. There are many hosting service providers who has different types of plans and some plans are most expensive for a starter or medium-level business organisation. So, if you are looking for an affordable hosting service to host your new website or change to another web hosting service then DigitalStartups is the suitable option for you. We are one of the cheap hosting services in India.</p>
             <a href="{{route('discuss.project')}}" class="get-quote">Get Quote</a>
         </div>
    </div>
</section>

<div class="container py-md-5 py-3">
    <div class="row px-md-0 px-4">
        <div class="col-md-8 col-sm-8 pl-0">
            <h2 class="black-txt pb-3">How to Buy Hosting at Valuable Price</h2>
            <p>To buy hosting at cheap price you need to contact a cheap hosting provider which is affordable in price and has good loading speed and technical support. DigitalStartups is one of the cheap hosting providers in India, starting plan from Rs.2500/- per year.</p>
        </div>
        <div class="col-md-4 col-sm-4">
             <div class="no-image"><img src="./images/hosting-service.png" alt="" style="width:100%"></div>
        </div>
    </div>
</div>

<section class="chose-bg w-100 d-block py-md-4 py-3">
    <div class="container">
        <div class="row px-md-0 px-4">
             <h2 class="black-txt d-block pb-3">Why Choose DigitalStartups – Valuable Hosting Provider</h2>
             <p class="pb-2">We at DigitalStartups can help you avail the web hosting service at a reasonable price. As hosting service is of utmost importance for any company, we would want to ensure that you get a good service for the price you would be paying and that it gives you convenience throughout the period you will be availing the service. We provide flexible hosting and domain options with plans suitable for small, medium and large business enterprises. We are recognised for reliability, speed and excellent support.</p>
        </div>
    </div>
</section>

<div class="container py-md-5 py-3">
   <div class="row px-md-0 px-4">
       <h2 class="black-txt w-100 d-block text-center pb-3">FAQ</h2>
       <ul class="ques-ans pt-3 pl-0">
           <li>
             <span><dd class="mb-0">Q</dd><strong>Is availing hosting service necessary?</strong></span>
             <span class="pb-2"><b></b>Yes, without hosting, all data in your web will be available only for you. Then there is purpose left for a website.</span>
           </li>
           <li>
             <span><dd class="mb-0">Q</dd><strong>For my .net website which is the best hosting plan?</strong></span>
             <span class="pb-2"><b></b>You may go with our windows hosting plan for .net websites.</span>
           </li>
           <li>
             <span><dd class="mb-0">Q</dd><strong>Can I transfer my hosting account from Windows hosting to Linux hosting?</strong></span>
             <span class="pb-2"><b></b>Yes, you can transfer your account from Windows hosting to Linux hosting.
             </span>
           </li>
        </ul>
   </div>
</div>


@endsection
