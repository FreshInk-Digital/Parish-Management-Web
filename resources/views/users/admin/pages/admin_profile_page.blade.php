@include('includes.dashboardHeader')
@include('includes.notifications_alert')

<title> Mfumo wa Parokia | Wasifu</title>

<!--begin::Body-->
@if ($errors->any())
    <div id="sessionMessage" class="alert-container d-flex align-items-center justify-content-end"
        style="position: absolute; top: 25px; right: 20px; z-index: 50000 !important;">
        <div class="alert alert-danger d-flex align-items-center w-100" role="alert">
            <i class="bi bi-x-circle text-danger fw-bold"></i>
            <div class="mx-3" style="font-size: 15px;">
                <b>Tatizo! </b> {{ 'Tafadhali jaza taarifa sahihi' }}
            </div>
        </div>
    </div>
@endif

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">

            <!--begin::Container-->
            <div class="container-fluid">

                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">

                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center"
                            data-bs-toggle="dropdown">
                            <span
                                class="bg-dark rounded-circle text-light fw-bold d-flex justify-content-center align-items-center"
                                style="width: 35px; height: 35px;">
                                {{ Str::limit($user->firstname, 1, '') }}{{ Str::limit($user->lastname, 1, '') }}
                            </span>
                            <span class="d-none d-md-inline mx-2">{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Profile Details-->
                            <li class="user-header d-flex align-items-center justify-content-start"
                                style="background-color: black; min-height: 50px !important;">
                                <span
                                    class="bg-dark rounded-circle text-light fw-bold d-flex justify-content-center align-items-center"
                                    style="width: 50px; height: 50px;">
                                    {{ Str::limit($user->firstname, 1, '') }}{{ Str::limit($user->lastname, 1, '') }}
                                </span>
                                <p class="d-flex flex-column align-items-start text-light mx-2"
                                    style="margin-bottom: 10px;">
                                    {{ $user->name }}
                                    <small
                                        style="color: rgba(245,245,245,0.7);">{{ Str::title($user->user_type) }}</small>
                                </p>
                            </li>
                            <!--end::User Image-->


                            <!--begin::Menu Footer-->
                            <li class="user-footer bg-black pb-3" style="border-top: 1px solid #cccccc40">
                                <a href="{{ route('admin.profile.page') }}" class="btn btn-dark btn-flat text-white">
                                    <x-heroicon-m-user style="width: 20px; height: 20px;" />
                                    Wasifu
                                </a>
                                <a href="{{ route('user.logout') }}"
                                    class="btn btn-danger btn-flat float-end text-white"
                                    style="background-color: darkred; border: 1px solid darkred;">
                                    <x-heroicon-m-arrow-left-start-on-rectangle style="width: 20px; height: 20px;" />
                                    Toka Nje
                                </a>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->

                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->

        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{ route('admin.dashboard.page') }}" class="brand-link">

                    {{--  <!--begin::Brand Image--> signout
                <img src="{{ asset('assets/AdminLTE-4.0.0-beta3/dist/assets/img/AdminLTELogo.png') }}"
                    alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->  --}}

                    <!--begin::Brand Text-->
                    <span class="brand-text fw-bold">ChurchParish</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->

            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">

                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard.page') }}" class="nav-link">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.view.users.page') }}" class="nav-link">
                                <i class="nav-icon bi bi-person-vcard-fill"></i>
                                <p>
                                    Wahusika
                                    <span class="nav-badge badge text-bg-success me-2">{{ $users->count() }}</span>
                                </p>
                            </a>
                        </li>

                        {{-- MCHUNGAJI --}}
                        <li class="nav-item menu-open mt-3">
                            <a href="#" class="nav-link">
                                {{-- <i class=""></i> --}}
                                <p>
                                    Muhasibu
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.attendance.donation.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-cash-coin"></i>
                                        <p>
                                            Maudhuria/Sadaka
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.pledges.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-journal-check"></i>
                                        <p>
                                            Ahadi
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- KATIBU --}}
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                {{-- <i class=""></i> --}}
                                <p>
                                    Katibu
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.members.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-person-fill"></i>
                                        <p>
                                            Washirika
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.leaders.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-briefcase-fill"></i>
                                        <p>
                                            Viongozi
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.leader.positions.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-funnel-fill"></i>
                                        <p>
                                            Nafasi za Viongozi
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.groups.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-people-fill"></i>
                                        <p>
                                            Vikundi
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.announcements.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-megaphone-fill"></i>
                                        <p>
                                            Matangazo
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.baptisms.page') }}" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-stars"></i>
                                        <p>
                                            Ubatizo
                                            <span
                                                class="nav-badge badge text-bg-success me-2">{{ $baptisms->count() }}</span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- MCHUNGAJI --}}
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                {{-- <i class=""></i> --}}
                                <p>
                                    Mchungaji
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <span class="mx-3"></span>
                                        <i class="bi bi-chat-dots-fill"></i>
                                        <p>
                                            Meseji
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('admin.profile.page') }}" class="nav-link active">
                                <span
                                    class="bg-dark rounded-circle text-light fw-bold d-flex justify-content-center align-items-center"
                                    style="width: 25px; height: 25px; font-size: 10px;">
                                    {{ Str::limit($user->firstname, 1, '') }}{{ Str::limit($user->lastname, 1, '') }}
                                </span>
                                <p>
                                    {{ $user->name ?? 'Wasifu' }}
                                </p>
                            </a>
                        </li>


                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->


        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item fs-6">Wasifu</li>
                                <li class="breadcrumb-item active fs-6" aria-current="page">Taarifa za
                                    {{ $user->lastname }}</li>
                            </ol>
                            <h3 class="mb-0 float-bold">Wasifu</h3>
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
                    <div class="row">

                        {{-- Malezo Binafsi --}}
                        <div class="my-3 border-muted border-top">
                            <div class="row py-3">
                                <div class="col-md-4">
                                    <h2 class="h4 fw-semibold pt-2">Hariri Maelezo Binafsi</h2>
                                    <p class="pt-2">
                                        Maelezo haya ni binafsi kwa muhusika, unauwezo wa kubadili maelezo yako na
                                        kuweka unavyotaka
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <form class="card rounded-2" method="POST"
                                        action="{{ route('admin.update.profile') }}" x-data="{ loading: false }"
                                        @submit.prevent="loading = true; $el.submit()">
                                        @csrf

                                        <input type="text" value="{{ $user->id }}" name="id" hidden>

                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label fw-semibold">Jina la
                                                            Kwanza</label>
                                                        <input type="text" id="firstname"
                                                            value="{{ old('firstname', $user->firstname) }}"
                                                            class="form-control" placeholder="Ingiza Jina la Kwanza"
                                                            name="firstname">
                                                        @error('firstname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label fw-semibold">Jina la
                                                            Mwisho</label>
                                                        <input type="text" id="lastname"
                                                            value="{{ old('lastname', $user->lastname) }}"
                                                            class="form-control" placeholder="Ingiza Jina la Mwisho"
                                                            name="lastname">
                                                        @error('lastname')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label fw-semibold">Barua Pepe</label>
                                                <input type="text" value="{{ old('email', $user->email) }}"
                                                    id="email" class="form-control"
                                                    placeholder="Ingiza Barua Pepe" name="email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label fw-semibold">Namba ya Simu</label>
                                                        <input type="text"
                                                            value="{{ old('phone', $user->phone) }}" id="phone"
                                                            class="form-control" placeholder="Ingiza Namba ya Simu"
                                                            name="phone">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="user_type" class="form-label fw-semibold">Aina ya
                                                            Mhusika</label>
                                                        <select name="user_type" id="user_type" class="form-select">
                                                            <option value="">-- chagua aina ya mhusika --
                                                            </option>
                                                            @foreach (\App\Models\User::types() as $value => $type)
                                                                <option value="{{ $value }}"
                                                                    {{ old('type', $user->user_type) == $value ? 'selected' : '' }}>
                                                                    {{ $type }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <select class="form-select" name="user_type">
                                                                            @if ($user->user_type == 'admin')
                                                                                <option value="">-- chagua Aina ya Mhusika --</option>
                                                                                <option value="admin" selected>Admin</option>
                                                                                <option value="mchungaji">Mchungaji</option>
                                                                                <option value="katibu">Katibu</option>
                                                                                <option value="mwasibu">Mwasibu</option>
                                                                            @elseif($user->user_type == 'mchungaji')
                                                                                <option value="">-- chagua Aina ya Mhusika --</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="mchungaji" selected>Mchungaji</option>
                                                                                <option value="katibu">Katibu</option>
                                                                                <option value="mwasibu">Mwasibu</option>
                                                                            @elseif($user->user_type == 'katibu')
                                                                                <option value="">-- chagua Aina ya Mhusika --</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="mchungaji">Mchungaji</option>
                                                                                <option value="katibu" selected>Katibu</option>
                                                                                <option value="mwasibu">Mwasibu</option>
                                                                            @elseif($user->user_type == 'mwasibu')
                                                                                <option value="">-- chagua Aina ya Mhusika --</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="mchungaji">Mchungaji</option>
                                                                                <option value="katibu">Katibu</option>
                                                                                <option value="mwasibu" selected>Mwasibu</option>
                                                                            @else
                                                                                <option value="" selected>-- chagua Aina ya Mhusika --</option>
                                                                                <option value="admin">Admin</option>
                                                                                <option value="mchungaji">Mchungaji</option>
                                                                                <option value="katibu">Katibu</option>
                                                                                <option value="mwasibu">Mwasibu</option>
                                                                            @endif
                                                                        </select> --}}
                                                        @error('user_type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="w-100 py-2 px-4 rounded rounded-bottom"
                                            style="background-color: #cccccc35;">
                                            <button type="submit"
                                                class="float-end btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                                :disabled="loading">
                                                <!-- Spinner shown only when loading -->
                                                <span x-show="loading" class="spinner-border spinner-border-sm"
                                                    role="status" aria-hidden="true"></span>
                                                <span>
                                                    Hariri
                                                </span>
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>


                        {{-- Badili Neno Siri --}}
                        <div class="my-3 border-muted border-top">
                            <div class="row py-3">
                                <div class="col-md-4">
                                    <h2 class="h4 fw-semibold pt-2">Hariri Neno Siri</h2>
                                    <p class="pt-2">
                                        Neno siri au nywira kuthibitisha mhusika, waweza badili hapa ilikulinda wasifu
                                        na kuweka imara ulinzi kwaajili ya wizi
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <form class="card rounded-2" method="POST"
                                        action="{{ route('admin.update.password.profile') }}"
                                        x-data="{ loading: false }" @submit.prevent="loading = true; $el.submit()">
                                        @csrf

                                        <div class="p-4">
                                            <input type="text" value="{{ $user->id }}" name="id" hidden>

                                            <!-- old Password -->
                                            <div class="mb-3" x-data="{ show: false }">
                                                <label for="old_password" class="form-label">Neno Siri la
                                                    Zamani</label>
                                                <div class="input-group">
                                                    <input :type="show ? 'text' : 'password'" name="old_password"
                                                        class="form-control border-end-0" id="old_password"
                                                        placeholder="Ingiza neno siri la zamani.."
                                                        value="{{ old('old_password') }}">
                                                    <span class="input-group-text border-start-0"
                                                        style="cursor: pointer;" @click="show = !show">
                                                        <template x-if="!show">
                                                            <i class="bi bi-eye"></i>
                                                        </template>
                                                        <template x-if="show">
                                                            <i class="bi bi-eye-slash"></i>
                                                        </template>
                                                    </span>
                                                </div>

                                                @error('old_password')
                                                    <span class="text-error fw-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="mb-3" x-data="{ show: false }">
                                                <label for="password" class="form-label">Neno Siri
                                                    Jipya</label>
                                                <div class="input-group">
                                                    <input :type="show ? 'text' : 'password'" name="password"
                                                        class="form-control border-end-0" id="password"
                                                        placeholder="Ingiza neno siri.."
                                                        value="{{ old('password') }}">
                                                    <span class="input-group-text  border-start-0"
                                                        style="cursor: pointer;" @click="show = !show">
                                                        <template x-if="!show">
                                                            <i class="bi bi-eye"></i>
                                                        </template>
                                                        <template x-if="show">
                                                            <i class="bi bi-eye-slash"></i>
                                                        </template>
                                                    </span>
                                                </div>

                                                @error('password')
                                                    <span class="text-error fw-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="mb-3" x-data="{ show: false }">
                                                <label for="confirm_password" class="form-label">Thibitisha
                                                    Neno Siri Jipya</label>
                                                <div class="input-group">
                                                    <input :type="show ? 'text' : 'password'" name="confirm_password"
                                                        class="form-control border-end-0" id="confirm_password"
                                                        placeholder="Thibitisha neno siri.."
                                                        value="{{ old('confirm_password') }}">
                                                    <span class="input-group-text border-start-0"
                                                        style="cursor: pointer;" @click="show = !show">
                                                        <template x-if="!show">
                                                            <i class="bi bi-eye"></i>
                                                        </template>
                                                        <template x-if="show">
                                                            <i class="bi bi-eye-slash"></i>
                                                        </template>
                                                    </span>
                                                </div>

                                                <div class="pt-2 text-error" id="my_text_output" style="color: red;"></div>

                                                @error('confirm_password')
                                                    <span class="text-error fw-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="w-100 py-2 px-4 rounded rounded-bottom"
                                            style="background-color: #cccccc35;">
                                            <button type="submit"
                                                class="float-end btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                                :disabled="loading">
                                                <!-- Spinner shown only when loading -->
                                                <span x-show="loading" class="spinner-border spinner-border-sm"
                                                    role="status" aria-hidden="true"></span>
                                                <span>
                                                    Hariri
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        {{-- Logout --}}
                        <div class="my-3 border-muted border-top">
                            <div class="row py-3">
                                <div class="col-md-4">
                                    <h2 class="h4 fw-semibold pt-2">Toka Nje</h2>
                                    <p class="pt-2">
                                        Toka nje ya mfumo
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <div class="card rounded-3 p-4">
                                        <p class="pt-2">
                                            Unapotoka nje ya Mfumo utatakiwa kurudia tena kuingia tena kwa kuweka maelezo yako katika fomu ya kuingia
                                        </p>
                                        <div class="w-100 float-start">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logout">
                                                <i class="bi bi-box-arrow-right text-light"></i> Toka Nje
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- Delete Account --}}
                        <div class="my-3 border-muted border-top">
                            <div class="row py-3">
                                <div class="col-md-4">
                                    <h2 class="h4 fw-semibold pt-2">Futa Akaunti</h2>
                                    <p class="pt-2">
                                        Futa akaunti yako kabisa
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <div class="card rounded-2 p-4">
                                        <p class="pt-2">
                                            Unapofuta akaunti yako hutoweza kupata uwezo wa kuingia kwenye mfumo huu tena, na maelezo yako yote yatafutwa kabisa
                                        </p>
                                        <div class="w-100 float-start">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserAccount">
                                                <i class="bi bi-trash text-light"></i> Futa Akaunti
                                             </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row (main row) -->

                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="{{ route('admin.dashboard.page') }}" class="text-decoration-none">ChurchParish</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->

    </div>
    <!--end::App Wrapper-->


    <div class="modal fade" id="deleteUserAccount" tabindex="-1" aria-labelledby="deleteUserAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="deleteUserAccountLabel">
                            Futa Akaunti Yako
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Unauwakika wa kufuta akaunti yako?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sitisha</button>
                    <form method="GET" action="{{ route('admin.delete.account.profile', $user->id) }}" x-data="{ loading: false }" @submit.prevent="loading = true; $el.submit()">
                        <button type="submit"
                                class="btn btn-danger d-flex align-items-center justify-content-center gap-2"
                                :disabled="loading">
                            <!-- Spinner shown only when loading -->
                            <span x-show="loading" class="spinner-border spinner-border-sm" role="status"
                                  aria-hidden="true"></span>
                            <span>
                                Futa Akaunti
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="logoutLabel">
                        Toka Nje
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Unauwakika wa kutoka katika mfumo?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sitisha</button>
                    <form method="GET" action="{{ route('user.logout') }}" x-data="{ loading: false }" @submit.prevent="loading = true; $el.submit()">
                        <button type="submit"
                                class="btn btn-danger d-flex align-items-center justify-content-center gap-2"
                                :disabled="loading">
                            <!-- Spinner shown only when loading -->
                            <span x-show="loading" class="spinner-border spinner-border-sm" role="status"
                                  aria-hidden="true"></span>
                            <span>
                                Toka Nje
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        const pw = document.getElementById('password');
        const confirmPw = document.getElementById('confirm_password');
        const textBox = document.getElementById('my_text_output');

        confirmPw.addEventListener('input', () => {
            const pwtext = pw.value;
            const confirmPwtext = confirmPw.value;

            if (pwtext == '' && confirmPwtext != '') {
                textBox.innerHTML = "Ingiza neno siri kwanza";
                textBox.classList.add("text-error");
            } else if (pwtext == '' && confirmPwtext == '') {
                textBox.innerHTML = "";
                textBox.classList.remove("text-success");
                textBox.classList.remove("text-error");
            } else if (pwtext != '' && confirmPwtext == '') {
                textBox.innerHTML = "";
                textBox.classList.remove("text-success");
                textBox.classList.remove("text-error");
            } else if (pwtext != '' && confirmPwtext != '') {
                if (pwtext == confirmPwtext) {
                    textBox.innerHTML = "Thibitisho linaendana";
                    textBox.classList.remove("text-error");
                    textBox.classList.add("text-success");
                } else {
                    textBox.innerHTML = "Neno siri si sahihi";
                    textBox.classList.remove("text-success");
                    textBox.classList.add("text-error");
                }
            }
        });
    </script>

    @include('includes.dashboardFooter')
