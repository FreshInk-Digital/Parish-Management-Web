<div>
    @php
        use App\Models\AttendanceDonation;
    @endphp

    <div class="mb-3">
        <label for="category" class="form-label">Aina ya Mahudhurio/Sadaka</label>
        <select name="category" id="category" class="form-select" wire:model.live='category'>
            <option value="">-- chagua aina --</option>
            @foreach (AttendanceDonation::categories() as $value => $label)
                <option value="{{ $value }}" {{ old('category') == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>
        @error('category')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    @if ($category == 'Shule ya Jumapili')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total_male" class="form-label">Idadi ya Wavulana</label>
                    <input class="form-control" type="number" name="total_male" value="{{ old('total_male',0) }}" id="total_male"
                        min="0">
                    @error('total_male')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total_female" class="form-label">Idadi ya Wasichana</label>
                    <input class="form-control" type="number" name="total_female" value="{{ old('total_female',0) }}" id="total_female"
                        min="0">
                    @error('total_female')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumla ya Sadaka</label>
            <input class="form-control" type="number" name="amount" value="{{ old('amount', 0) }}" id="amount" min="0"
                placeholder="Ingiza Jumla ya sadaka">
            @error('amount')
                <span class="text-error">{{ $message }}</span>
            @enderror
        </div>
    @elseif($category == 'Kikundi')
        <div class="mb-3">
            <label for="group_id" class="form-label">Jina la Kikundi</label>
            <select name="group_id" id="group_id" class="form-select">
                <option value="">-- chagua kikundi --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            @error('group_id')
                <span class="text-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total_male" class="form-label">Idadi ya Wanaume</label>
                    <input type="number" class="form-control" name="total_male" value="{{ old('total_male', 0) }}" id="total_male"
                        min="0">
                    @error('total_male')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="total_female" class="form-label">Idadi ya Wanawake</label>
                    <input type="number" class="form-control" name="total_female" value="{{ old('total_female', 0) }}" id="total_female"
                        min="0">
                    @error('total_female')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Jumla ya Sadaka</label>
            <input type="number" class="form-control" name="amount" value="{{ old('amount', 0) }}" id="amount" min="0"
                placeholder="Ingiza Jumla ya sadaka">
            @error('amount')
                <span class="text-error">{{ $message }}</span>
            @enderror
        </div>
    @elseif ($category == 'Jumuia')
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="total_male" class="form-label">Idadi ya Wanaume</label>
                    <input type="number" class="form-control" name="total_male" value="{{ old('total_male', 0) }}" id="total_male"
                        min="0">
                    @error('total_male')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="total_female" class="form-label">Idadi ya Wanawake</label>
                    <input type="number" class="form-control" name="total_female" value="{{ old('total_female', 0) }}" id="total_female"
                        min="0">
                    @error('total_female')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="total_children" class="form-label">Idadi ya Watoto</label>
                    <input type="number" class="form-control" name="total_children" value="{{ old('total_children', 0) }}" id="total_children"
                        min="0">
                    @error('total_children')
                        <span class="text-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-border table-striped myAddingTable">
                <thead>
                    <th>#</th>
                    <th>Namba ya Mshirika</th>
                    <th>Kiasi/Sadaka</th>
                    <th></th>
                </thead>
                @php
                    $id = 1;
                @endphp
                <tbody id="rowAdded">
                    <tr>
                        <td>
                            {{ $id++ }}
                        </td>
                        <td>
                            <input type="text" name="member_id[]" class="form-control" value="{{ old('member_id') }}" placeholder="Ingiza namba ya Mshirika">
                        </td>
                        <td>
                            <input type="number" name="amount[]" value="{{ old('amount', 0) }}" class="form-control">
                        </td>
                        <td>
                            <button type="button" class='btn btn-success btn-sm' id="addtr" onClick="addTr()">Ongeza Mstari</button>                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else

    @endif



    <script>
        const addingArea = document.getElementBy('rowAdded');
        const addingBtn = document.getElementById('addtr');
    
        var id = 1;
    
        function addTr(){
            alert();
            addingArea.append("<tr>\
                    <td>\
                        "+ (id++) +"\
                    </td>\
                    <td>\
                        <input type="text" name="member_id[]" class="form-control" value="{{ old('member_id') }}" placeholder="Ingiza namba ya Mshirika">\
                    </td>\
                    <td>\
                        <input type="number" name="amount[]" value="{{ old('amount', 0) }}" class="form-control">\
                    </td>\
                    <td>\
                        <button class='btn btn-danger btn-sm removetr'> <i class="bi bi-x"></i> </button> </td></tr>");
        }
    </script>

</div>
