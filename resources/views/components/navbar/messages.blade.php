<li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#">
        <i class="bi bi-chat-text"></i>
        <span class="navbar-badge badge text-bg-danger">3</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/img/user1-128x128.jpg') }}" 
                         alt="User Avatar" 
                         class="img-size-50 rounded-circle me-3" />
                </div>
                <div class="flex-grow-1">
                    <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger">
                            <i class="bi bi-star-fill"></i>
                        </span>
                    </h3>
                    <p class="fs-7">Call me whenever you can...</p>
                    <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                </div>
            </div>
            <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <!-- Additional messages -->
        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</li>
