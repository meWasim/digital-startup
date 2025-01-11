@extends('layouts.app')

@section('content')
    <section class="about-bnr blue-bg-mt w-100 d-block py-md-4 py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="d-block">Discuss Project</h2>
                </div>
                <div class="col-md-6 col-sm-6 d-flex flex-wrap justify-content-md-end justify-content-left">
                    <ul class="breadcrumb mb-0 pl-1">
                        <li><a href="/">Home</a></li>
                        <li>Discuss Project</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="about-bg w-100 d-block py-md-5 py-3">
        <div class="container">


            <form action="{{ route('discuss-project.store') }}" method="POST" enctype="multipart/form-data"
                id="discussProjectForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-md-3 mb-2">
                            <input type="text" class="form-control form-field" name="full_name" placeholder="Full Name"
                                required>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <input type="email" class="form-control form-field" name="email" placeholder="Email Address"
                                required>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <input type="text" class="form-control form-field" name="contact_number"
                                placeholder="Contact Number" required>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <input type="text" class="form-control form-field" name="company_name"
                                placeholder="Company Name" required>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <input type="text" class="form-control form-field" name="website_url"
                                placeholder="Website URL">
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <select class="form-control form-field" name="project_budget">
                                <option value="">Select Project Budget</option>
                                <option value="Rs.10000 - Rs.20000">Rs.10000 - Rs.20000</option>
                                <option value="Rs.20001 - Rs.30000">Rs.20001 - Rs.30000</option>
                                <option value="Rs.30001 - Rs.40000">Rs.30001 - Rs.40000</option>
                                <option value="Rs.40001 - Rs.50000">Rs.40001 - Rs.50000</option>
                            </select>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control form-field" name="image">
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-6">
                        <h4>Services</h4>
                        <div class="form-group mb-md-3 mb-2">
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Hosting Service">
                                    Hosting Service
                                </label>
                            </div>
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Facebook Ad Campaign Service"> Facebook Ad Campaign Service
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Google Ad Campaign">
                                    Google Ad Campaign
                                </label>
                            </div>
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Twitter Ad Campaign">
                                    Twitter Ad Campaign
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Graphic Design">
                                    Graphic Design
                                </label>
                            </div>
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Website Design">
                                    Website Design
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Brochure Design">
                                    Brochure Design
                                </label>
                            </div>
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Mobile App Development"> Mobile App Development
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-md-3 mb-2">
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="CRM Software Development"> CRM Software Development
                                </label>
                            </div>
                            <div class="form-check-inline selt-fld-md">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="services[]"
                                        value="Digital Marketing Services"> Digital Marketing Services
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </section>
@endsection
