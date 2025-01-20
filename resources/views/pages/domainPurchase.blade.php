@extends('layouts.app')
@section('title', 'Domain Purchase - Digital Startups')
@section('content')
<section class="blue-bg w-100 d-block py-5 blue-bg-mt">
    <div class="container">
         <div class="row px-md-0 px-4">
             <h1 class="white-txt w-100 d-block pb-3">
                 DOMAIN PURCHASE SERVICE
             </h1>
             <p class="d-block pb-1">If you are looking a domain purchase service provider then you are in the right place. Our executive will guide you about how to purchase a domain or you can directly book a domain from our website at an affordable price. List of domain you can buy from our website is - .com, .co.in, .net.in, .org.in, .org, .net, .biz, .info, .gen.in, .firm.in, .ind.in, mobi, .us, .eu, .cc, .tv, .ws, .co.uk, .org.uk, .me.uk.</p>
             <a href="{{route('discuss.project')}}" class="get-quote">Get Quote</a>
         </div>
    </div>
</section>

<div class="container py-md-5 py-3">
    <div class="row px-md-0 px-4">
        <div class="col-md-8 col-sm-8 pl-0">
            <h2 class="black-txt pb-3">How to Buy Domain at Valuable Price</h2>
            <p>By choosing a good and reliable broker you can purchase a domain at a valuable price. There are many companies, who are charging a high rate for domain purchase or provide domain at cheap price for first purchase but at the time of renewal taking high price. This policy is not included in our website. We taking the same price for the first purchase and renewal.</p>
        </div>
        <div class="col-md-4 col-sm-4">
             <img src="images/left-menu-logo/domain-purchase.jpg" class="img-fluid" alt="">
        </div>
    </div>
</div>

<section class="chose-bg w-100 d-block py-md-4 py-3">
    <div class="container">
        <div class="row px-md-0 px-4">
             <h2 class="black-txt d-block pb-3">Why Choose DigitalStartups – Domain Broker</h2>
             <p class="pb-2">We at DigitalStartups arrange a domain broker for you who will make an attempt to mediate a transaction with the current owner who holds your preferred domain name within a span of 30 days to procure the domain name for you. Although there is no guarantee for a successful change of ownership of the domain name. We also suggest other domain names if you want. This service is provided at a reasonable cost.</p>
        </div>
    </div>
</section>

<div class="container py-md-5 py-3">
   <div class="row px-md-0 px-4">
       <h2 class="black-txt w-100 d-block text-center pb-3">FAQ</h2>
       <ul class="ques-ans pt-3 pl-0">
           <li>
             <span><dd class="mb-0">Q</dd><strong>What is a Domain Registration and What is its importance?</strong></span>
             <span class="pb-2"><b></b>Domain registration is the process of claiming a domain name from a domain name registrar. The objective of Domain names is to identify online resources, such as computers, networks, and services, with a text-based logo that is easier to remember</span>
           </li>
           <li>
             <span><dd class="mb-0">Q</dd><strong>How does domain registration/enrolment work?</strong></span>
             <span class="pb-2"><b></b> Registration of a domain name makes a set of name server records in the DNS servers of the parent domain, implying the IP addresses of DNS servers that are authoritative for the domain.
             </span>
           </li>
           <li>
             <span><dd class="mb-0">Q</dd><strong>What is a domain registration/enrolment service?</strong></span>
             <span class="pb-2"><b></b> Domain registration service providers, also called domain registrars, help businesses reserve or acquire Internet domain names.</span>
           </li>
        </ul>
   </div>
</div>

@endsection
