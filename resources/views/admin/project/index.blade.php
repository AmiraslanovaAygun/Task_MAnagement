@extends('layouts.admin')
@section('title', 'Proyektlər')
@section('customCss')
    <style>
        .project-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .project-card:hover {
            transform: scale(1.05);
        }

        .new-project {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            border-radius: 12px;
            height: 100%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .new-project:hover {
            background: #f8f9fa;
        }

        .avatar-group img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-left: -10px;
            border: 2px solid #fff;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="container mt-5">
                    <div class="row g-4  mt-5">
                        <div class="col-md-3  mt-5">
                            <div class="new-project p-4" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                                <h5 class="text-secondary">+ New project</h5>
                            </div>
                        </div>
                        <div class="col-md-3 mt-5">
                            <div class="card project-card">
                                <img src="https://source.unsplash.com/300x200/?modern,interior" class="card-img-top"
                                     alt="Modern">
                                <div class="card-body">
                                    <h6>Project #2</h6>
                                    <h5>Modern</h5>
                                    <p>As Uber works through a huge amount of internal management turmoil.</p>
                                    <button class="btn btn-outline-primary w-100">VIEW PROJECT</button>
                                    <div class="mt-2 avatar-group">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="User">
                                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newProjectModalLabel">Create New Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="projectName" class="form-label">Project Name</label>
                                        <input type="text" class="form-control" id="projectName"
                                               placeholder="Enter project name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="projectType" class="form-label">Project Type</label>
                                        <select class="form-select" id="projectType">
                                            <option selected>Choose...</option>
                                            <option value="1">Modern</option>
                                            <option value="2">Scandinavian</option>
                                            <option value="3">Minimalist</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Create Project</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newProjectModalLabel">Create New Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label for="projectName" class="form-label">Project Name</label>
                                        <input type="text" class="form-control" id="projectName"
                                               placeholder="Enter project name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="projectType" class="form-label">Project Type</label>
                                        <select class="form-select" id="projectType">
                                            <option selected>Choose...</option>
                                            <option value="1">Modern</option>
                                            <option value="2">Scandinavian</option>
                                            <option value="3">Minimalist</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Create Project</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
