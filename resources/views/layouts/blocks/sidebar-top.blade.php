<div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
    <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
        <div class="symbol symbol-50px">
            <img src="{{ asset('media/svg/avatars/blank.svg') }}" alt=""/>
        </div>

        <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
            <div class="d-flex">
                <div class="flex-grow-1 me-2">
                    <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ activeUser()->name }}</a>

                    <span class="text-gray-600 fw-semibold d-block fs-8 mb-1"></span>

                    <div class="d-flex align-items-center text-success fs-9">
                        <span class="bullet bullet-dot bg-success me-1"></span>online
                    </div>
                </div>

                <!-- Simple Logout Button -->
                <div class="me-n2">
                    <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-icon btn-active-color-primary" title="Logout">
                            <i class="fas fa-sign-out-alt text-white fs-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
