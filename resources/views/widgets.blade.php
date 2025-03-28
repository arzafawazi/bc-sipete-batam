@extends('layouts.vertical', ['title' => 'Widgets'])

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Widgets</h4>
        </div>

        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                <li class="breadcrumb-item active">Widgets</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary-subtle rounded-circle p-2 me-2 border border-dashed border-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><path fill="#287F71" fill-rule="evenodd" d="M13.463 9.692C13.463 12.664 10.77 14 7 14S.537 12.664.537 9.713c0-3.231 1.616-4.868 4.847-6.505L4.24 1.077A.7.7 0 0 1 4.843 0H9.41a.7.7 0 0 1 .603 1.023L8.616 3.208c3.23 1.615 4.847 3.252 4.847 6.484M7.625 4.887a.625.625 0 1 0-1.25 0v.627a1.74 1.74 0 0 0-.298 3.44l1.473.322a.625.625 0 0 1-.133 1.236h-.834a.625.625 0 0 1-.59-.416a.625.625 0 1 0-1.178.416a1.877 1.877 0 0 0 1.56 1.239v.636a.625.625 0 1 0 1.25 0v-.636a1.876 1.876 0 0 0 .192-3.696l-1.473-.322a.49.49 0 0 1 .105-.97h.968a.622.622 0 0 1 .59.416a.625.625 0 0 0 1.178-.417a1.874 1.874 0 0 0-1.56-1.238z" clip-rule="evenodd"/></svg>
                            </div>

                            <p class="mb-0 text-dark fs-15">Total Revenue</p>
                        </div>

                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 fs-24 text-black me-2">$604,784</h3>
                            <p class="text-muted mb-0 fs-13 ms-4 d-flex flex-column">
                                <span class="text-success fs-14"><i class="mdi mdi-trending-up fs-18"></i> 16%</span>
                                <small class="text-dark fs-14"> vs last 7 days </small>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">

                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-secondary-subtle rounded-circle p-2 me-2 border border-dashed border-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><path fill="#963b68" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m32 32h-64c-17.6 0-33.5 7.1-45.1 18.6c40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64m-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32S208 82.1 208 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2m-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4"/></svg>
                            </div>

                            <p class="mb-0 text-dark fs-15">Total Customer</p>
                        </div>

                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 fs-24 text-black me-2">457,800</h3>
                            <p class="text-muted mb-0 fs-13 ms-4 d-flex flex-column">
                                <span class="text-danger fs-14"><i class="mdi mdi-trending-down fs-18"></i> 0.3%</span>
                                <small class="text-dark fs-14"> vs last 7 days </small>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">

                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-info-subtle rounded-circle p-2 me-2 border border-dashed border-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#73bbe2" d="M7 20V8.975q0-.825.6-1.4T9.025 7H20q.825 0 1.413.587T22 9v8l-5 5H9q-.825 0-1.412-.587T7 20M2.025 6.25q-.15-.825.325-1.487t1.3-.813L14.5 2.025q.825-.15 1.488.325t.812 1.3L17.05 5H9Q7.35 5 6.175 6.175T5 9v9.55q-.4-.225-.687-.6t-.363-.85zM20 16h-4v4z"/></svg>
                            </div>

                            <p class="mb-0 text-dark fs-15">Total Transaction</p>   
                        </div>

                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 fs-24 text-black me-2">637,254</h3>
                            <p class="text-muted mb-0 fs-13 ms-4 d-flex flex-column">
                                <span class="text-success fs-14"><i class="mdi mdi-trending-up fs-18"></i> 7%</span>
                                <small class="text-dark fs-14"> vs last 7 days </small>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">

                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-warning-subtle rounded-circle p-2 me-2 border border-dashed border-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f59440" d="M5.574 4.691c-.833.692-1.052 1.862-1.491 4.203l-.75 4c-.617 3.292-.926 4.938-.026 6.022C4.207 20 5.88 20 9.23 20h5.54c3.35 0 5.025 0 5.924-1.084c.9-1.084.591-2.73-.026-6.022l-.75-4c-.439-2.34-.658-3.511-1.491-4.203C17.593 4 16.403 4 14.02 4H9.98c-2.382 0-3.572 0-4.406.691" opacity="0.5"/><path fill="#988D4D" d="M12 9.25a2.251 2.251 0 0 1-2.122-1.5a.75.75 0 1 0-1.414.5a3.751 3.751 0 0 0 7.073 0a.75.75 0 1 0-1.414-.5A2.251 2.251 0 0 1 12 9.25"/></svg>
                            </div>

                            <p class="mb-0 text-dark fs-15">Total Product</p>
                        </div>

                        <div class="d-flex align-items-center">
                            <h3 class="mb-0 fs-24 text-black me-2">256, 600</h3>
                            <p class="text-muted mb-0 fs-13 ms-4 d-flex flex-column">
                                <span class="text-success fs-14"><i class="mdi mdi-trending-up fs-18"></i> 12%</span>
                                <small class="text-dark fs-14"> vs last 7 days </small>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <!-- start row -->
    <div class="row">
        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">On boarding Campaign</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="justify-content-center">
                        <div class="row g-3">

                            <div class="col-md-12 col-xl-12">
                                <div class="border rounded-2 bg-light p-2 d-flex align-items-center">
                                    <i class="mdi mdi-star-four-points fs-19 text-primary me-2"></i>
                                    <p class="fs-16 mb-0">Help new customer understand the value they'll receive from your product.</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="border rounded-3 px-2 py-3">
                                    <span class="mb-2 text-black text-success bg-tag rounded-2 py-1 px-2 align-content-center"><i class="mdi mdi-circle-medium dot-primary mt-2"></i>Delivered</span>
                                    <div class="d-flex align-content-center justify-content-between">
                                        <div>
                                            <h3 class="m-0 mb-2 fs-22 text-black mt-3">12.50%</h3>
                                            <p class="text-muted mb-0 fs-14">Last 24 hours</p>
                                        </div>
                                        <div id="chart-boarding-delivered" class="apex-charts align-self-end"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="border rounded-3 px-2 py-3">
                                    <span class="mb-2 text-black text-success bg-tag rounded-2 py-1 px-2 align-content-center"><i class="mdi mdi-circle-medium dot-primary mt-2"></i>Opened</span>
                                    <div class="d-flex align-content-center justify-content-between">
                                        <div>
                                            <h3 class="m-0 mb-2 fs-22 text-black mt-3">40.3%</h3>
                                            <p class="text-muted mb-0 fs-14">Last 30 hours</p>
                                        </div>
                                        <div id="chart-boarding-opened" class="apex-charts align-self-end"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="border rounded-3 px-2 py-3">
                                    <span class="mb-2 text-black text-success bg-tag rounded-2 py-1 px-2 align-content-center"><i class="mdi mdi-circle-medium dot-primary mt-2"></i>Clicked</span>
                                    <div class="d-flex align-content-center justify-content-between">
                                        <div>
                                            <h3 class="m-0 mb-2 fs-22 text-black mt-3">38.7%</h3>
                                            <p class="text-muted mb-0 fs-14">Last 30 hours</p>
                                        </div>
                                        <div id="chart-boarding-clicked" class="apex-charts align-self-end"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <a href="#">
                                    <div class="border rounded-3 px-2 py-3">
                                        <span class="mb-2 text-black text-success bg-tag rounded-2 py-1 px-2 align-content-center"><i class="mdi mdi-circle-medium dot-primary mt-2"></i>Converted</span>
                                        <div class="d-flex align-content-center justify-content-between">
                                            <div>
                                                <h3 class="m-0 mb-2 fs-22 text-black mt-3">12.3%</h3>
                                                <p class="text-muted mb-0 fs-14">Last 30 hours</p>
                                            </div>
                                            <div id="chart-boarding-converted" class="apex-charts align-self-end"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- end card -->
        </div> <!-- end sales -->

        <div class="col-md-12 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Money Flow</h5>
                        <div class="ms-auto"> 
                            <button class="btn btn-sm bg-light border dropdown-toggle fw-medium text-black" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-currency-usd me-1 fs-14"></i>Profile<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Income</a>
                                <a class="dropdown-item" href="#">Expense</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div id="chart-money" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- Recent Transaction Section -->
    <div class="row">
        <div class="col-md-12 col-xl-8">
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card  overflow-hidden">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 text-black">Latest Transaction</h5>
                                <div class="ms-auto"> 
                                    <button class="btn btn-sm bg-light border dropdown-toggle fw-medium text-black" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-calendar-blank-outline me-1 fs-14"></i>Monthly<i class="mdi mdi-chevron-down ms-1 fs-14"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Date Wise</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-traffic mb-0">

                                    <thead>
                                        <tr class="">
                                            <th>Transaction type</th>
                                            <th>Person</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border d-flex align-items-center justify-content-center me-2" style="height: 35px; width: 35px;">
                                                    <i class="mdi mdi-credit-card-outline fs-17"></i>
                                                </div>
                                                <a href="#" class="text-reset">Salary payment</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                <p class="mb-0">Jenny wilson</p>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-reset">
                                            February 14, 2024
                                        </td>
                                        <td>
                                            <a href="#" class="text-reset">
                                                $449.51
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-reset ">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="check-circle" style="height: 16px; width: 16px;" class="text-primary me-2"></i>
                                                <p class="mb-0">Completed</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border d-flex align-items-center justify-content-center me-2" style="height: 35px; width: 35px;">
                                                    <i class="mdi mdi-cash fs-17"></i>
                                                </div>
                                                <a href="#" class="text-reset">Office Manage</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/images/users/user-15.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                <p class="mb-0">Jenny wilson</p>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-reset">
                                            January 25, 2024
                                        </td>
                                        <td>
                                            <a href="#" class="text-reset">
                                                $870.95
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-reset ">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="check-circle" style="height: 16px; width: 16px;" class="text-primary me-2"></i>
                                                <p class="mb-0">Completed</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border d-flex align-items-center justify-content-center me-2" style="height: 35px; width: 35px;">
                                                    <i class="mdi mdi-account-outline fs-17"></i>
                                                </div>
                                                <a href="#" class="text-reset">Client payment</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/images/users/user-13.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                <p class="mb-0">Cameron Williamson</p>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-reset">
                                            March 16, 2024
                                        </td>
                                        <td>
                                            <a href="#" class="text-reset">
                                                $687.85
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-reset ">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="loader" style="height: 16px; width: 16px;" class="text-warning me-2"></i>
                                                <p class="mb-0">On progress</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border d-flex align-items-center justify-content-center me-2" style="height: 35px; width: 35px;">
                                                    <i class="mdi mdi-hand-coin-outline fs-17"></i>
                                                </div>
                                                <a href="#" class="text-reset">Investment</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/images/users/user-11.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                <p class="mb-0">Jenny wilson</p>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-reset">
                                            June 20, 2024
                                        </td>
                                        <td>
                                            <a href="#" class="text-reset">
                                                $528.18
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-reset ">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="loader" style="height: 16px; width: 16px;" class="text-warning me-2"></i>
                                                <p class="mb-0">On progress</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border d-flex align-items-center justify-content-center me-2" style="height: 35px; width: 35px;">
                                                    <i class="mdi mdi-chart-box-plus-outline fs-17"></i>
                                                </div>
                                                <a href="#" class="text-reset">Marketing</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/images/users/user-14.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                <p class="mb-0">Esther Howard</p>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-reset">
                                            July 16, 2024
                                        </td>
                                        <td>
                                            <a href="#" class="text-reset">
                                                $449.51
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-reset ">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="check-circle" style="height: 16px; width: 16px;" class="text-primary me-2"></i>
                                                <p class="mb-0">Completed</p>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle border d-flex align-items-center justify-content-center me-2" style="height: 35px; width: 35px;">
                                                    <i class="mdi mdi-credit-card-outline fs-17"></i>
                                                </div>
                                                <a href="#" class="text-reset">Salary payment</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="/images/users/user-3.jpg" class="avatar avatar-sm rounded-circle me-2">
                                                <p class="mb-0">Darlene Robertson</p>
                                            </div>
                                        </td>
                                        <td class="text-nowrap text-reset">
                                            May 27, 2024
                                        </td>
                                        <td>
                                            <a href="#" class="text-reset">
                                                $478.51
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-reset ">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="check-circle" style="height: 16px; width: 16px;" class="text-primary me-2"></i>
                                                <p class="mb-0">Completed</p>
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div> <!-- end sales -->

        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Employee Performance Rating</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="employeeRating-chart" class="apex-charts"></div>
                </div>

            </div> <!-- end card -->
        </div>

    </div>

    <!-- Average revenue -->
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Average revenue</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="average-revenue" class="apex-charts"></div>

                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="mt-3">
                                <p class="mb-2 text-dark fs-15">This month</p>
                                <h3 class="m-0 mb-1 fs-18 text-black">$ 36,026.89</h3>
                                <div class="d-flex align-items-center">
                                    <span class="avatar-xs rounded-circle bg-success-subtle d-flex justify-content-center align-items-center me-2"><i class="mdi mdi-arrow-up fs-13 text-success"></i></span>
                                    <p class="text-muted mb-0 fs-13">+ $ 1,670.76</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="mt-3">
                                <p class="mb-2 text-dark fs-15">Today</p>
                                <h3 class="m-0 mb-1 fs-18 text-black">$ 1,260.16</h3>
                                <div class="d-flex align-items-center">
                                    <span class="avatar-xs rounded-circle bg-danger-subtle d-flex justify-content-center align-items-center me-2"><i class="mdi mdi-arrow-down fs-13 text-danger"></i></span>
                                    <p class="text-muted mb-0 fs-13">+ $ 1,670.76</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="mt-3">
                                <p class="mb-2 text-dark fs-15">This Year</p>
                                <h3 class="m-0 mb-1 fs-18 text-black">$ 136,026.89</h3>
                                <div class="d-flex align-items-center">
                                    <span class="avatar-xs rounded-circle bg-success-subtle d-flex justify-content-center align-items-center me-2"><i class="mdi mdi-arrow-up fs-13 text-success"></i></span>
                                    <p class="text-muted mb-0 fs-13">+ $ 11,670.76</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12 col-xl-6">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Earnings Reports</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-traffic mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0 fw-semibold text-black">Date</th>
                                    <th class="border-top-0 fw-semibold text-black">Item Count</th>
                                    <th class="border-top-0 fw-semibold text-black">Text</th>
                                    <th class="border-top-0 fw-semibold text-black">Earnings</th>
                                </tr>
                            </thead>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">01 January</a>
                                </td>
                                <td>
                                    45
                                </td>
                                <td class="text-success">
                                    +$70
                                </td> 
                                <td>
                                    $78,000
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">05 February</a>
                                </td>
                                <td>
                                    35
                                </td>
                                <td class="text-danger">
                                    -$48
                                </td> 
                                <td>
                                    $18,000
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">15 March</a>
                                </td>
                                <td>
                                    28
                                </td>
                                <td class="text-danger">
                                    -$31
                                </td> 
                                <td>
                                    $15,000
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">06 April</a>
                                </td>
                                <td>
                                    38
                                </td>
                                <td class="text-success">
                                    +$58
                                </td> 
                                <td>
                                    $125,000
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">08 May</a>
                                </td>
                                <td>
                                    42
                                </td>
                                <td class="text-success">
                                    +$65
                                </td> 
                                <td>
                                    $80,000
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">25 December</a>
                                </td>
                                <td>
                                    39
                                </td>
                                <td class="text-danger">
                                    -$41
                                </td> 
                                <td>
                                    $73,000
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">18 January</a>
                                </td>
                                <td>
                                    45
                                </td>
                                <td class="text-success">
                                    +$74
                                </td> 
                                <td>
                                    $72,500
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="#" class="text-reset">09 September</a>
                                </td>
                                <td>
                                    29
                                </td>
                                <td class="text-danger">
                                    -$25
                                </td> 
                                <td>
                                    $23,000
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sale Section Mix Widget -->
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Sales by Region</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="sales-region" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Upcoming Events</h5>
                    </div>
                </div>

                <!-- start card body -->
                <div class="card-body">
                    <ul class="list-unstyled mb-0 upcoming-events-list">
                        <li>
                            <div class="align-items-center d-flex justify-content-between border rounded-2 p-2 events-before">
                                <div class="product-list">
                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">Meeting with client</h6>
                                        <p class="mb-0 mt-1 text-muted">Zoom Conference</p>
                                    </div>
                                </div>

                                <div>
                                    <span class="text-muted"><i class="ri-time-line align-middle me-1 inline-block "></i>9:00am - 10:00am</span>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="align-items-center d-flex justify-content-between border rounded-2 p-2">
                                <div class="product-list">
                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">Event for music concert</h6>
                                        <p class="mb-0 mt-1 text-muted">Tomorrowland belgium</p>
                                    </div>
                                </div>

                                <div>
                                    <span class="text-muted"><i class="ri-time-line align-middle me-1 inline-block "></i>11:00am - 1:00pm</span>
                                </div>
                            </div>
                            
                        </li>

                        <li>
                            <div class="align-items-center d-flex justify-content-between border rounded-2 p-2">
                                <div class="product-list">
                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">General Team Meeting</h6>
                                        <p class="mb-0 mt-1 text-muted">Agenda for team growth</p>
                                    </div>
                                </div>

                                <div>
                                    <span class="text-muted"><i class="ri-time-line align-middle me-1 inline-block "></i>2:00pm - 4:00pm</span>
                                </div>
                            </div>
                        </li>

                        <li class="mb-0">
                            <div class="align-items-center d-flex justify-content-between border rounded-2 p-2">
                                <div class="product-list">
                                    <div class="product-body align-self-center">
                                        <h6 class="m-0 fw-semibold">Project Manager Meeting</h6>
                                        <p class="mb-0 mt-1 text-muted">Project sprint and remaining work</p>
                                    </div>
                                </div>

                                <div>
                                    <span class="text-muted"><i class="ri-time-line align-middle me-1 inline-block "></i>10:05am - 12:05pm</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> 
                <!-- end card body -->
            </div>
        </div>

        <div class="col-md-12 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Website Visitors</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="mt-2 mb-2">
                                <p class="mb-2 text-dark fs-15">Visit Duration</p>
                                <div class="d-flex align-items-center">
                                    <h3 class="m-0 mb-0 fs-22 text-black me-2">1m 35s</h3>
                                    <span class="badge rounded-3 bg-success-subtle d-flex justify-content-center align-items-center text-primary"><i class="mdi mdi-arrow-up fs-13 text-success me-1"></i>15 %</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="mt-2 mb-2">
                                <p class="mb-2 text-dark fs-15">Total Page Views</p>
                                <div class="d-flex align-items-center">
                                    <h3 class="m-0 mb-1 fs-18 text-black me-2">805K</h3>
                                    <span class="badge rounded-3 bg-danger-subtle d-flex justify-content-center align-items-center text-danger"><i class="mdi mdi-arrow-down fs-13 text-danger me-1"></i>12 %</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="mt-2 mb-2">
                                <p class="mb-2 text-dark fs-15">Unique visitors</p>
                                <div class="d-flex align-items-center">
                                    <h3 class="m-0 mb-0 fs-22 text-black me-2">120K</h3>
                                    <span class="badge rounded-3 bg-success-subtle d-flex justify-content-center align-items-center text-primary"><i class="mdi mdi-arrow-up fs-13 text-success me-1"></i>19 %</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="website-visitors" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- start row -->
    <div class="row">
        <div class="col-md-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Web Analytics</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="justify-content-center mb-4">
                        <div class="row g-3">
                            <div class="col-md-6 col-xl-3">
                                <a href="#">
                                    <div class="border rounded-3 px-2 py-3 text-center">
                                        <p class="mb-2 text-dark">Users</p>
                                        <h3 class="m-0 mb-2 fs-24 text-black">3 680</h3>
                                        <p class="text-muted mb-0 fs-13">
                                            <span class="text-primary bg-primary-subtle rounded-2 p-1 me-2"><i class="mdi mdi-arrow-up-circle"></i> 2.5%</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <a href="#">
                                    <div class="border rounded-3 px-2 py-3 text-center">
                                        <p class="mb-2 text-dark">New Users</p>
                                        <h3 class="m-0 mb-2 fs-24 text-black">2 870</h3>
                                        <p class="text-muted mb-0 fs-13">
                                            <span class="text-primary bg-primary-subtle rounded-2 p-1 me-2"><i class="mdi mdi-arrow-up-circle"></i> 1.6%</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <a href="#">
                                    <div class="border rounded-3 px-2 py-3 text-center">
                                        <p class="mb-2 text-dark">Key Event</p>
                                        <h3 class="m-0 mb-2 fs-24 text-black">78</h3>
                                        <p class="text-muted mb-0 fs-13">
                                            <span class="text-danger bg-danger-subtle rounded-2 p-1 me-2"><i class="mdi mdi-arrow-down-circle"></i> 7.7%</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <a href="#">
                                    <div class="border rounded-3 px-2 py-3 text-center">
                                        <p class="mb-2 text-dark">Event Count</p>
                                        <h3 class="m-0 mb-2 fs-24 text-black">9.4K</h3>
                                        <p class="text-muted mb-0 fs-13">
                                            <span class="text-primary bg-primary-subtle rounded-2 p-1 me-2"><i class="mdi mdi-arrow-up-circle"></i> 17.6%</span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="chart-new-clients" class="apex-charts"></div>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn text-black border fw-normal d-flex align-items-center justify-content-center text-capitalize rounded-3 mt-3">View reports snapshot <i class="mdi mdi-arrow-right ms-2 fs-17"></i></a>
                        </div>
                    </div>
                </div>

            </div> <!-- end card -->
        </div> <!-- end sales -->

        <div class="col-md-12 col-xl-6">
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 text-black">Traffic summary</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="chart-traffic" class="apex-charts"></div>
                        </div> <!-- end card body -->        
                    </div> <!-- end card -->
                </div>

                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0">Subscribers</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="chart-development-activity" class="apex-charts"></div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->

                </div>
            </div>
        </div> <!-- end sales -->
    </div>
    <!-- end row -->

    <!-- Task table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 text-black">Tasks</h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-traffic mb-0">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task Name</th>
                                    <th>Created Date</th>
                                    <th>Number of Task</th>
                                    <th>Deadline</th>
                                    <th>Project</th>
                                    <th>Assignee</th>
                                </tr>
                            </thead>

                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked>
                                </td>
                                <td>
                                    <a href="#" class="text-reset">Create user interface designs.</a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    June 01, 2024
                                </td>
                                <td>
                                    <a href="#" class="text-reset">
                                        <i data-feather="check" style="height: 18px; width: 18px;" class="me-1"></i>
                                        4/8
                                    </a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    June 10, 2024
                                </td>
                                <td>
                                    <a href="#" class="text-reset">
                                        <i data-feather="folder" style="height: 18px; width: 18px;" class="me-1"></i>
                                        2
                                    </a>
                                </td>
                                <td>
                                    <img src="/images/users/user-11.jpg" class="avatar avatar-sm rounded-2" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" >
                                </td>
                                <td>
                                    <a href="#" class="text-reset">Test new features and updates.</a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    July 15, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="check" style="height: 18px; width: 18px;" class="me-1"></i>
                                        1/5
                                    </a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    September 10, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="folder" style="height: 18px; width: 18px;" class="me-1"></i>
                                        4
                                    </a>
                                </td>
                                <td>
                                    <img src="/images/users/user-12.jpg" class="avatar avatar-sm rounded-2" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" >
                                </td>
                                <td>
                                    <a href="#" class="text-reset">Optimize database queries</a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    August 12, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="check" style="height: 18px; width: 18px;" class="me-1"></i>
                                        0/4
                                    </a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    December 08, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="folder" style="height: 18px; width: 18px;" class="me-1"></i>
                                        1
                                    </a>
                                </td>
                                <td>
                                    <img src="/images/users/user-13.jpg" class="avatar avatar-sm img-fluid rounded-2" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                                </td>
                                <td>
                                    <a href="#" class="text-reset">Develop API endpoints.</a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    September 5, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="check" style="height: 18px; width: 18px;" class="me-1"></i>
                                    2/6
                                    </a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    Fabruary 25, 2024
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="folder" style="height: 18px; width: 18px;" class="me-1"></i>
                                        5
                                    </a>
                                </td>
                                <td>
                                    <img src="/images/users/user-14.jpg" class="avatar avatar-sm img-fluid rounded-2" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked >
                                </td>
                                <td>
                                    <a href="#" class="text-reset">Conduct user feedback surveys</a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    October 1, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="check" style="height: 18px; width: 18px;" class="me-1"></i>
                                        4/10
                                    </a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    November 29, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="folder" style="height: 18px; width: 18px;" class="me-1"></i>
                                        3
                                    </a>
                                </td>
                                <td>
                                    <img src="/images/users/user-15.jpg" class="avatar avatar-sm img-fluid rounded-2" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked >
                                </td>
                                <td>
                                    <a href="#" class="text-reset">Review codebase for security vulnerabilities</a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    May 15, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="check" style="height: 18px; width: 18px;" class="me-1"></i>
                                        5/8
                                    </a>
                                </td>
                                <td class="text-nowrap text-reset">
                                    <i data-feather="calendar" style="height: 18px; width: 18px;" class="me-1"></i>
                                    December 08, 2023
                                </td>
                                <td class="text-nowrap">
                                    <a href="#" class="text-reset">
                                        <i data-feather="folder" style="height: 18px; width: 18px;" class="me-1"></i>
                                        6
                                    </a>
                                </td>
                                <td>
                                    <img src="/images/users/user-10.jpg" class="avatar avatar-sm img-fluid rounded-2" />
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- container-fluid -->

@endsection

@section('script-bottom')
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    @vite(['resources/js/pages/widgets.init.js'])
@endsection