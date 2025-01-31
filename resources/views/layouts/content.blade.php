      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <div class="col-sm-6">
                          <h3 class="mb-0">Dashboard</h3>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-end">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                          </ol>
                      </div>
                  </div>
                  <!--end::Row-->
              </div>
              <!--end::Container-->
          </div>
          <!--end::App Content Header-->



          <!--begin::App Content-->
          <div class="app-content">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  {{-- <div class="row">
                      <!--begin::Col-->
                      <div class="col-lg-3 col-6">
                          <!--begin::Small Box Widget 1-->
                          <div class="small-box text-bg-primary">
                              <div class="inner">
                                  <h3>150</h3>
                                  <p>New Orders</p>
                              </div>
                              <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                  xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path
                                      d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                                  </path>
                              </svg>
                              <a href="#"
                                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                  More info <i class="bi bi-link-45deg"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 1-->
                      </div>
                      <!--end::Col-->
                      <div class="col-lg-3 col-6">
                          <!--begin::Small Box Widget 2-->
                          <div class="small-box text-bg-success">
                              <div class="inner">
                                  <h3>53<sup class="fs-5">%</sup></h3>
                                  <p>Bounce Rate</p>
                              </div>
                              <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                  xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path
                                      d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z">
                                  </path>
                              </svg>
                              <a href="#"
                                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                  More info <i class="bi bi-link-45deg"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 2-->
                      </div>
                      <!--end::Col-->
                      <div class="col-lg-3 col-6">
                          <!--begin::Small Box Widget 3-->
                          <div class="small-box text-bg-warning">
                              <div class="inner">
                                  <h3>44</h3>
                                  <p>User Registrations</p>
                              </div>
                              <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                  xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path
                                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                  </path>
                              </svg>
                              <a href="#"
                                  class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                  More info <i class="bi bi-link-45deg"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 3-->
                      </div>
                      <!--end::Col-->
                      <div class="col-lg-3 col-6">
                          <!--begin::Small Box Widget 4-->
                          <div class="small-box text-bg-danger">
                              <div class="inner">
                                  <h3>65</h3>
                                  <p>Unique Visitors</p>
                              </div>
                              <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                                  xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z">
                                  </path>
                                  <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z">
                                  </path>
                              </svg>
                              <a href="#"
                                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                  More info <i class="bi bi-link-45deg"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 4-->
                      </div>
                      <!--end::Col-->
                  </div> --}}


                  
                  <div class="row">
                      <!--begin::Col-->
                      <div class="col-lg-4 col-md-6 col-12">
                          <!--begin::Small Box Widget 1-->
                          <div class="small-box text-bg-primary">
                              <div class="inner">
                                  <h3>150</h3>
                                  <p>Ibu Hamil, Menyusui, dan Nifas</p>
                              </div>
                              <a href="#"
                                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                  Tambah Pencatatan <i class="bi bi-plus"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 1-->
                      </div>
                      <!--end::Col-->
                      <div class="col-lg-4 col-md-6 col-12">
                          <!--begin::Small Box Widget 2-->
                          <div class="small-box text-bg-success">
                              <div class="inner">
                                  <h3>53</h3>
                                  <p>Bayi, Balita, dan APRAS</p>
                              </div>
                              <a href="#"
                                  class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                  Tambah Pencatatan <i class="bi bi-plus"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 2-->
                      </div>
                      <!--end::Col-->
                      <div class="col-lg-4 col-md-6 col-12">
                          <!--begin::Small Box Widget 3-->
                          <div class="small-box text-bg-warning">
                              <div class="inner">
                                  <h3>44</h3>
                                  <p>Usia Produktif dan Lansia</p>
                              </div>
                              <a href="#"
                                  class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                  Tambah Pencatatan <i class="bi bi-plus"></i>
                              </a>
                          </div>
                          <!--end::Small Box Widget 3-->
                      </div>
                      <!--end::Col-->
                  </div>
                  <!--end::Row-->



                  <!--begin::Row-->
                  <div class="row">
                      <!-- Start col -->
                      <div class="col-lg-12">
                          <div class="card mb-4">
                              <div class="card-header">
                                  <h3 class="card-title">Sales Value</h3>
                              </div>
                              <div class="card-body">
                                  <div id="revenue-chart"></div>
                              </div>
                          </div>
                          <!-- /.card -->
                      </div>
                      <!-- /.Start col -->
                  </div>
                  <!--end::Row-->



                  <!--begin::Row-->
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card mb-4">
                              <div class="card-header d-flex justify-content-between align-items-center">
                                  <h3 class="card-title">Bordered Table</h3>
                                  <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                      data-bs-target="#addDataModal">
                                      Tambah Data
                                  </button>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <table class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px">#</th>
                                              <th>Task</th>
                                              <th>Progress</th>
                                              <th style="width: 40px">Label</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr class="align-middle">
                                              <td>1.</td>
                                              <td>Update software</td>
                                              <td>
                                                  <div class="progress progress-xs">
                                                      <div class="progress-bar progress-bar-danger" style="width: 55%">
                                                      </div>
                                                  </div>
                                              </td>
                                              <td><span class="badge text-bg-danger">55%</span></td>
                                          </tr>
                                          <tr class="align-middle">
                                              <td>2.</td>
                                              <td>Clean database</td>
                                              <td>
                                                  <div class="progress progress-xs">
                                                      <div class="progress-bar text-bg-warning" style="width: 70%">
                                                      </div>
                                                  </div>
                                              </td>
                                              <td><span class="badge text-bg-warning">70%</span></td>
                                          </tr>
                                          <tr class="align-middle">
                                              <td>3.</td>
                                              <td>Cron job running</td>
                                              <td>
                                                  <div class="progress progress-xs progress-striped active">
                                                      <div class="progress-bar text-bg-primary" style="width: 30%">
                                                      </div>
                                                  </div>
                                              </td>
                                              <td><span class="badge text-bg-primary">30%</span></td>
                                          </tr>
                                          <tr class="align-middle">
                                              <td>4.</td>
                                              <td>Fix and squish bugs</td>
                                              <td>
                                                  <div class="progress progress-xs progress-striped active">
                                                      <div class="progress-bar text-bg-success" style="width: 90%">
                                                      </div>
                                                  </div>
                                              </td>
                                              <td><span class="badge text-bg-success">90%</span></td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer clearfix">
                                  <ul class="pagination pagination-sm m-0 float-end">
                                      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                  </ul>
                              </div>
                          </div>
                          <!-- /.card -->
                      </div>
                      <!-- /.col -->
                  </div>
                  <!--end::Row-->



                  <!--begin::Modal-->
                  <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="addDataModalLabel">Tambah Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form>
                                      <div class="mb-3">
                                          <label for="taskName" class="form-label">Task</label>
                                          <input type="text" class="form-control" id="taskName"
                                              placeholder="Masukkan task">
                                      </div>
                                      <div class="mb-3">
                                          <label for="progress" class="form-label">Progress</label>
                                          <input type="number" class="form-control" id="progress"
                                              placeholder="Masukkan progress (dalam %)">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Simpan</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!--end::Modal-->



                  
                  <!-- begin:: Tabbed Widget -->
                  <div class="card mb-4">
                      <div class="card-header">
                          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab"
                                      data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1"
                                      aria-selected="true">Tab 1</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="tab2-tab" data-bs-toggle="tab"
                                      data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2"
                                      aria-selected="false">Tab 2</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="tab3-tab" data-bs-toggle="tab"
                                      data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3"
                                      aria-selected="false">Tab 3</button>
                              </li>
                          </ul>
                      </div>
                      <div class="card-body">
                          <div class="tab-content" id="myTabContent">
                              <!-- Tab 1 Content -->
                              <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                  aria-labelledby="tab1-tab">
                                  <h5>Tab 1 Content</h5>
                                  <p>Ini adalah konten untuk tab pertama.</p>
                              </div>
                              <!-- Tab 2 Content -->
                              <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                  <h5>Tab 2 Content</h5>
                                  <p>Ini adalah konten untuk tab kedua.</p>
                              </div>
                              <!-- Tab 3 Content -->
                              <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                  <h5>Tab 3 Content</h5>
                                  <p>Ini adalah konten untuk tab ketiga.</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- end:: Tabbed Widget -->

                  <!-- /.row -->
                  <!--end::Container-->
              </div>
              <!--end::App Content-->
      </main>
      <!--end::App Main-->
