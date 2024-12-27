@extends('layouts.app')
@section('title', 'Blog - Digital Startups')
@section('content')
<section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
    <div class="container">
         <div class="row">
             <div class="col-md-6 col-sm-6">
                 <h2 class="d-block">Blog</h2>
             </div>
             <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                  <ul class="breadcrumb mb-0 pl-1">
                       <li><a href="/">Home</a></li>
                       <li>Blog</li>
                   </ul>
             </div>
         </div>
    </div>
</section>
<section class="blog-bg w-100 d-block py-md-5 py-3">
  <div class="container">
        <div class="row mb-3">
            <div class="col-md-6 col-sm-6">
                 <div class="blog w-100">
                     <div class="blogImg position-relative">
                       <div class="blog-date position-absolute">
                            <span>25</span>
                            <dd>Sep 2024</dd>
                       </div>
                       <img src="images/blog-01.jpg" alt="">
                     </div>
                     <h2 class="d-block pt-5 pb-3">Behind Every Successful Business There Is A Well-Designed Website</h2>
                     <p>Hiring a web designer to create your website is the best thing you can ever do for your business. A website will act as a window to your products and services. For any business, a website is a must. It’s […]<a href="blog-details.php" class="more-info ml-2">Read More</a></p>
                 </div>
            </div>
            <div class="col-md-6 col-sm-6">
                 <div class="blog w-100">
                     <div class="blogImg position-relative">
                       <div class="blog-date position-absolute">
                            <span>12</span>
                            <dd>July 2024</dd>
                       </div>
                       <img src="images/blog-02.jpg" alt="">
                     </div>
                     <h2 class="d-block pt-5 pb-3">Remote Work Indeed Is The Future For The Business World</h2>
                     <p>We are in the middle of what is arguably the most important event of our collective lifetime- an unprecedented nationwide lockdown meant to curb the spread of the virus. These twin developments will have repercussions for both our economy (as […]<a href="blog-details.php" class="more-info ml-2">Read More</a></p>
                 </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                 <div class="blog w-100">
                     <div class="blogImg position-relative">
                       <div class="blog-date position-absolute">
                           <span>31</span>
                           <dd>May 2024</dd>
                       </div>
                       <img src="images/blog-03.jpg" alt="">
                     </div>
                     <h2 class="d-block pt-5 pb-3">Facebook Ads Marketing Can Take Your Business Several Notches Higher</h2>
                     <p>Without a doubt, Facebook is THE most popular and effective marketing platform with more than 2.7 billion active users across the globe. It would be silly to not leverage its advertising network that will give you marketing advantage every step […]<a href="blog-details.php" class="more-info ml-2">Read More</a></p>
               </div>
            </div>
            <div class="col-md-6 col-sm-6">
               <div class="blog w-100">
                 <div class="blogImg position-relative">
                   <div class="blog-date position-absolute">
                     <span>26</span>
                       <dd>Apr 2024</dd>
                   </div>
                       <img src="images/blog-04.jpg" alt="">
                 </div>
                   <h2 class="d-block pt-5 pb-3">Remote Work Indeed Is The Future For The Business World</h2>
                   <p>We are in the middle of what is arguably the most important event of our collective lifetime- an unprecedented nationwide lockdown meant to curb the spread of the virus. These twin developments will have repercussions for both our economy (as […]<a href="blog-details.php" class="more-info ml-2">Read More</a></p>
         </div>
       </div>
     </div>
 </div>
</section>
@endsection
