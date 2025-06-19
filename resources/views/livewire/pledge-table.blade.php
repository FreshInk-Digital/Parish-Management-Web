<div class="container">
    <style>
        .my-dropbtn.dropdown-toggle::after {
            display: none !important;
        }

        /* Prevent any color or shadow change on focus */
        .my-topbar .input-group:focus-within {
            box-shadow: none; /* No box-shadow on focus */
            border-color: #ccc; /* Keep the grey border color */
        }

        /* Prevent form-control focus styles */
        .my-topbar .input-group .form-control:focus {
            box-shadow: none; /* Remove default input focus box-shadow */
            border-color: #ccc !important; /* Keep the grey border color */
            outline: none; /* Remove the default focus outline */
        }

        /* Input group text */
        .my-topbar .input-group .input-group-text {
            border-right: 0;
            background-color: transparent;
            border-radius: 0.375rem; /* Ensure matching border-radius */
        }

        /* Form control text */
        .my-topbar .input-group .form-control {
            border-left: 0;
            border-radius: 0.375rem; /* Ensure matching border-radius */
            border-color: #ccc; /* Set initial grey border color */
        }
    </style>

    <div class="row">
        <div class="my-topbar py-3 container-fluid">
            <div class="row align-items-center g-3 justify-content-between">

                <!-- Per page & Delete on md+ -->
                <div class="col-12 col-md-auto d-flex align-items-center">
                    <!-- Hidden on small screens -->
                    <div class="me-2 d-none d-md-block">Kwa Kurasa:</div>

                    <!-- Always visible select -->
                    <select class="form-select border border-secondary me-2" wire:model.live="perPage"
                            style="width: 80px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    @if(count($selectedPledges) > 1)
                        <!-- Delete button only visible on md+ -->
                        <button class="btn btn-danger d-none d-md-block" data-bs-toggle="modal"
                                data-bs-target="#deleteSelectedPledgeModal">
                            <i class="bi bi-trash text-light"></i> Futa Zote
                        </button>
                    @elseif(count($selectedPledges) == 1)
                        <!-- Delete button only visible on md+ -->
                        <button class="btn btn-danger d-none d-md-block" data-bs-toggle="modal"
                                data-bs-target="#deleteSelectedPledgeModal">
                            <i class="bi bi-trash text-light"></i> Futa
                        </button>
                    @endif
                </div>

                <!-- Right side: Search + Dropdown -->
                <div class="col-12 col-md d-flex justify-content-between justify-content-md-end align-items-center">

                    <!-- Search bar -->
                    <div class="flex-grow-1 me-2">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent">
                                <i class="bi bi-search"></i>
                            </span>
                            <input wire:model.live="search" type="search" class="form-control border-start-0"
                                   placeholder="Tafuta hapa..">
                        </div>
                    </div>

                    <!-- Dropdown -->
                    <div class="dropdown">
                        <button class="my-dropbtn btn btn-transparent border-0 dropdown-toggle shadow-none"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <!-- Only show Futa Zote inside dropdown on sm -->
                            @if(count($selectedPledges) > 1)
                                <!-- Delete button only visible on md+ -->
                                <li class="d-md-none">
                                    <a class="dropdown-item text-danger" href="#" style="cursor: pointer;"
                                       data-bs-toggle="modal" data-bs-target="#deleteSelectedPledgeModal">
                                        <i class="bi bi-trash-fill me-1"></i> Futa Zote
                                    </a>
                                </li>
                            @elseif(count($selectedPledges) == 1)
                                <!-- Delete button only visible on md+ -->
                                <li class="d-md-none">
                                    <a class="dropdown-item text-danger" href="#" style="cursor: pointer;"
                                       data-bs-toggle="modal" data-bs-target="#deleteSelectedPledgeModal">
                                        <i class="bi bi-trash-fill me-1"></i> Futa
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a wire:click="exportExcel" class="dropdown-item text-success" style="cursor: pointer;">
                                    <i class="bi bi-file-earmark-excel-fill me-1"></i> Hamisha Kwenda CSV
                                </a>
                            </li>
                            <li>
                                <a wire:click="generatePdf" class="dropdown-item text-danger" style="cursor: pointer;">
                                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Hamisha Kwenda PDF
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>

        <table wire:loading.class="opacity-25" class="table table-hover w-100 myUsersTable" style="width: 100%;"
               cellspacing="0" width="100%">
            <thead class="table-secondary text-dark font-semibold">
            <tr class="py-2">
                <th>
                    <input wire:model="isSelectedAll" wire:click="toggleSelectedAll" type="checkbox" id="bulk-select"
                           value="select-all-">
                </th>
                <th>#</th>
                <th>Jina Kamili</th>
                <th>Aina</th>
                <th>Kiasi (Tshs)</th>
                <th>Kilichotolewa (Tshs)</th>
                <th>Kilichobaki (Tshs)</th>
                <th>Tarehe ya Ahadi</th>
                <th>Tarehe ya Mwisho</th>
                <th>Hali</th>
                <th>Tarehe ya Kuundwa</th>
                <th>Vitendo</th>
            </tr>
            </thead>
            <tbody>
            @php
                $id = $pledges->firstItem();
            @endphp
            @forelse($pledges as $pledge)
                <tr class="py-2" wire:key="Pledge-{{ $pledge->id }}">
                    <td>
                        <input wire:model.live="selectedPledges" type="checkbox" id="bulk-select"
                               value="{{ $pledge->id }}">
                    </td>
                    <td>{{ $id++ }}</td>
                    <td>{{ $pledge->member->firstname .' '. $pledge->member->middlename .' '. $pledge->member->lastname  }}</td>
                    <td>{{ $pledge->type }}</td>
                    <td>{{ number_format((float) $pledge->amount, 2) }}</td>
                    <td>{{ number_format((float) $pledge->fulfilled_amount, 2) }}</td>
                    <td>{{ number_format((float) ($pledge->amount - $pledge->fulfilled_amount), 2) }}</td>
                    <td>{{ $pledge->pledge_date }}</td>
                    <td>
                        @if ($pledge->end_date == null)
                            <p class="text-muted fst-italic">null</p>
                        @else
                            {{ $pledge->end_date }}
                        @endif
                    </td>
                    <td>
                        @if($pledge->status == 'Imekamilika')
                            <span class="badge text-bg-success rounded-full">Imekamilika</span>
                        @else
                            <span class="badge text-bg-danger rounded-full">Haijakamilika</span>
                        @endif
                    </td>
                    <td>{{ $pledge->created_at }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="my-dropbtn btn btn-transparent border-0 dropdown-toggle shadow-none"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical text-primary"></i>
                            </button>
                            <ul class="dropdown-menu" style="z-index: 1000;">
                                <li>
                                    <button type="button" class="dropdown-item text-secondary" data-bs-toggle="modal"
                                            data-bs-target="#viewPledgeModal{{ $pledge->id }}" style="cursor: pointer;">
                                        <i class="bi bi-eye-fill me-1"></i> Tazama
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-success" data-bs-toggle="modal"
                                            data-bs-target="#editPledgeModal{{ $pledge->id }}" style="cursor: pointer;">
                                        <i class="bi bi-pen-fill me-1"></i> Hariri
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-danger" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#deletePledgeModal{{ $pledge->id }}">
                                        <i class="bi bi-trash-fill me-1"></i> Futa
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="12">
                        <div class="d-flex align-items-center justify-content-center py-3">
                            <i class="bi bi-inbox fs-2 text-muted"></i>
                            <span class="text-muted mx-3">Hakuna majibu ya '{{ $search }}' </span>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>


        @if($pledges->count() > 0)
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <div class="text-muted small mb-2">
                    Ukurasa {{ $pledges->currentPage() }} ya {{ $pledges->lastPage() }} | Jumla ya
                    Ahadi: {{ $pledges->total() }}
                </div>
                <nav aria-label="Page navigation">
                    {{ $pledges->links('vendor.pagination.custom-bootstrap') }}
                </nav>
            </div>
        @else
            <div></div>
        @endif

    </div>


    <!-- Modal - ADMIN Pledge VIEW -->
    @foreach($pledges as $pledge)
        <div class="modal fade" id="viewPledgeModal{{ $pledge->id }}" tabindex="-1"
             aria-labelledby="viewPledgeModal{{ $pledge->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="viewPledgeModal{{ $pledge->id }}Label">Tazama Kiongozi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Jina Kamili</label>
                                    <input type="text" class="form-control" value="{{ $pledge->member->firstname .' '. $pledge->member->middlename .' '. $pledge->member->lastname  }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dateOfPledge" class="form-label">Tarehe ya Ahadi</label>
                                    <input type="date" class="form-control" value="{{ $pledge->pledge_date }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tarehe ya Mwisho</label>
                                    @if ($pledge->end_date == null)
                                        <input type="text" class="form-control fst-italic text-muted" value="null" readonly>
                                    @else
                                        <input type="date" class="form-control" value="{{ $pledge->end_date }}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Aina</label>
                                    <input type="text" class="form-control" value="{{ $pledge->type }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Kiasi (Tshs)</label>
                                    <input type="text" class="form-control" value="{{ number_format((float) $pledge->amount, 2) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Kilichotolewa (Tshs)({{ ($pledge->fulfilled_amount/$pledge->amount) * 100 }}%)</label>
                                    <input type="text" class="form-control" value="{{ number_format((float) $pledge->fulfilled_amount, 2) }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dateOfPledge" class="form-label">Kilichobaki (Tshs)</label>
                                    <input type="text" class="form-control" value="{{ number_format((float) ($pledge->amount - $pledge->fulfilled_amount), 2) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tarehe ya Kuundwa</label>
                                    <input type="date" class="form-control" value="{{ $pledge->created_at }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dateOfPledge" class="form-label">Hali</label>
                                    <input type="text" class="form-control" value="{{ $pledge->status }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Funga</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Modal - ADMIN Pledge EDIT -->
    @foreach($pledges as $pledge)
        <div class="modal fade" id="editPledgeModal{{ $pledge->id }}" tabindex="-1"
             aria-labelledby="editPledgeModal{{ $pledge->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.edit.pledge') }}" method="POST" x-data="{ loading: false }"
                          @submit.prevent="loading = true; $el.submit()">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editPledgeModal{{ $pledge->id }}Label">Hariri Kiongozi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" value="{{ $pledge->id }}" name="id" hidden>
                            <input type="text" value="{{ $pledge->user_id }}" name="user_id" class="form-control" hidden>

                            {{-- <livewire:update-check-member-id :pledge-id="$pledge->id" /> --}}

                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sitisha</button>
                            <button type="submit"
                                    class="btn btn-primary d-flex align-items-center justify-content-center gap-2"
                                    :disabled="loading">
                                <!-- Spinner shown only when loading -->
                                <span x-show="loading" class="spinner-border spinner-border-sm" role="status"
                                      aria-hidden="true"></span>
                                <span>Hariri Taarifa</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Modal - ADMIN USER DELETE -->
    @foreach($pledges as $pledge)
        <div class="modal fade" id="deletePledgeModal{{ $pledge->id }}" tabindex="-1"
             aria-labelledby="deletePledgeModal{{ $pledge->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-o">
                        <h1 class="modal-title fs-5" id="deletePledgeModal{{ $pledge->id }}Label">Futa Kiongozi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Unauwakika wa kumfuta kiongozi huyu mwenye jina <span
                                class="fst-italic text-success">{{ '#' . $pledge->member->firstname .' '. $pledge->member->middlename .' '. $pledge->member->lastname }}</span>?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sitisha</button>
                        <form method="GET" action="{{ route('admin.delete.pledge', $pledge->id) }}"
                              x-data="{ loading: false }" @submit.prevent="loading = true; $el.submit()">
                            <button type="submit"
                                    class="btn btn-danger d-flex align-items-center justify-content-center gap-2"
                                    :disabled="loading">
                                <!-- Spinner shown only when loading -->
                                <span x-show="loading" class="spinner-border spinner-border-sm" role="status"
                                      aria-hidden="true"></span>
                                <span>Futa Kiongozi</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Modal - ADMIN DELETE SELECTED PledgeS -->
    <div class="modal fade" id="deleteSelectedPledgeModal" tabindex="-1" aria-labelledby="deleteSelectedPledgeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-o">
                    <h1 class="modal-title fs-5" id="deleteSelectedPledgeModalLabel">
                        @if(count($selectedPledges) > 1)
                            Futa Ahadi
                        @elseif(count($selectedPledges) == 1)
                            Futa Kiongozi
                        @endif
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(count($selectedPledges) > 1)
                        <p>Unauwakika wa kufuta Ahadi hawa?</span>?</p>
                    @elseif(count($selectedPledges) == 1)
                        <p>Unauwakika wa kumfuta kiongozi huyu?</span>?</p>
                    @endif
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sitisha</button>
                    <form x-data="{ loading: false }" @submit.prevent="loading = true; $el.submit()">
                        <button type="submit" wire:click="deleteSelectedPledges"
                                class="btn btn-danger d-flex align-items-center justify-content-center gap-2"
                                :disabled="loading">
                            <!-- Spinner shown only when loading -->
                            <span x-show="loading" class="spinner-border spinner-border-sm" role="status"
                                  aria-hidden="true"></span>
                            <span>
                                @if(count($selectedPledges) > 1)
                                    Futa Viongozi
                                @elseif(count($selectedPledges) == 1)
                                    Futa Kiongozi
                                @endif
                                </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

