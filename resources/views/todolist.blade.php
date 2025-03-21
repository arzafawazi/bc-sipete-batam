@extends('layouts.vertical', ['title' => 'Dashboard'])

@section('css')
    @vite(['node_modules/simple-datatables/dist/style.css'])
@endsection

@section('content')

<!-- Start Content-->
<div class="container-fluid">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Todo List</h4>
        </div>

        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                <li class="breadcrumb-item active">Todo List</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all" id="datatable_1">
                            <thead>
                            <tr>
                                <th style="width: 16px;">
                                    <div class="form-check mb-0 ms-n1">
                                        <input type="checkbox" class="form-check-input" name="select-all" id="select-all">                                                    
                                    </div>
                                </th>
                                <th class="ps-0">Customer</th>
                                <th>Status</th>
                                <th>Assigned To</th>
                                <th>Deadline</th>
                                <th>Priority</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck1">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Create A New React app</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">In Progress</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Alexander White</a>
                                    </td>
                                    <td>Due in 3 days</td>
                                    <td>High</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck2">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-2.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Finish project report</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Not Started</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Sophia Williams</a>
                                    </td>
                                    <td>15 August 2024</td>
                                    <td>Medium</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck3">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-4.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Implement user authentication</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Completed</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Dale Osuna</a>
                                    </td>
                                    <td>11 August 2024</td>
                                    <td>Low</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck4">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-5.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Code review for feature branch</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Willie Makin</a>
                                    </td>
                                    <td>18 August 2024</td>
                                    <td>High</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck5">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-8.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Fix bug in payment processing</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Active</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Steven Hall</a>
                                    </td>
                                    <td>21 August 2024</td>
                                    <td>Medium</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck6">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-9.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Write unit tests for new API</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Not Started</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">John Spray</a>
                                    </td>
                                    <td>16 August 2024</td>
                                    <td>High</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck7">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-4.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Update documentation for REST API</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">In Progress</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Guillermo Pollard</a>
                                    </td>
                                    <td>21 August 2024</td>
                                    <td>Low</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck8">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-12.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Deploy new release to staging</span> 
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-secondary">Completed</span>
                                    </td>
                                    <td>
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Donald Hunter</a>
                                    </td>
                                    <td class="align-content-center">23 August 2024</td>
                                    <td class="align-content-center">Medium</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck9">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-13.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Research on database optimization</span> 
                                        </p>
                                    </td>
                                    <td class="align-content-center">
                                        <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                    </td>
                                    <td class="align-content-center">
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Thomas Hodges</a>
                                    </td>
                                    <td class="align-content-center">21 August 2024</td>
                                    <td class="align-content-center">Low</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck10">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-14.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Attend team meeting</span> 
                                        </p>
                                    </td>
                                    <td class="align-content-center">
                                        <span class="badge bg-secondary-subtle text-secondary">Active</span>
                                    </td>
                                    <td class="align-content-center">
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Ronald Rock</a>
                                    </td>
                                    <td class="align-content-center">14 August 2024</td>
                                    <td class="align-content-center">High</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck11">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-15.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Refactor legacy codebase</span> 
                                        </p>
                                    </td>
                                    <td class="align-content-center">
                                        <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                                    </td>
                                    <td class="align-content-center">
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Henry Hall</a>
                                    </td>
                                    <td class="align-content-center">23 August 2024</td>
                                    <td class="align-content-center">Medium</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck12">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-10.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Design new feature architecture</span> 
                                        </p>
                                    </td>
                                    <td class="align-content-center">
                                        <span class="badge bg-secondary-subtle text-secondary">In Progress</span>
                                    </td>
                                    <td class="align-content-center">
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Peter Carrick</a>
                                    </td>
                                    <td class="align-content-center">23 August 2024</td>
                                    <td class="align-content-center">Low</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck13">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="/images/users/user-3.jpg" alt="" class="thumb-md me-2 rounded-circle avatar-border">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="font-13 fw-medium">Optimize frontend loading times</span> 
                                        </p>
                                    </td>
                                    <td class="align-content-center">
                                        <span class="badge bg-secondary-subtle text-secondary">Completed</span>
                                    </td>
                                    <td class="align-content-center">
                                        <a href="" class="d-inline-block align-middle mb-0 text-body">Antonio Graham</a>
                                    </td>
                                    <td class="align-content-center">17 August 2024</td>
                                    <td class="align-content-center">Medium</td>
                                    <td class="text-end">
                                        <a aria-label="anchor" class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </a>
                                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
    @vite(['resources/js/pages/simple-datatables.init.js',])
@endsection