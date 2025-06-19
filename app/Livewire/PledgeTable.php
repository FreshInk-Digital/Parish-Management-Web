<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Pledge;
use Livewire\Component;
use App\Exports\PledgesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PledgeTable extends Component
{
    use withPagination;

    public $search = '';
    public $perPage = 5;
    public $isSelectedAll = false;
    public $selectedPledges = [];
    public $selected = [];
    public $authUser;

    public $inputMemberId = '';
    public $memberNameReturned = '';


    public function mount()
    {
        $this->authUser = Auth::user();
    }

    public function findMemberId()
    {
        if (!empty($this->inputMemberId)){
            $member = Member::where('member_id', 'like', '%'. $this->inputMemberId .'%')->first();
            if($member->isEmpty()){
                $this->memberNameReturned = "Hakuna mshirika mwenye namba. '$this->inputMemberId' ";
            }else{
                $this->memberNameReturned = $member->name;
            }
        }else{
            $this->memberNameReturned = '';
        }
    }

    public function toggleSelectedAll()
    {
        $pledges = Pledge::all();

        if ($this->isSelectedAll) {
            $this->selectedPledges = $pledges->pluck('id')->toArray();
        } else {
            $this->selectedPledges = [];
        }
    }

    public function deleteSelectedPledges()
    {
        $this->selected = $this->selectedPledges;
        Pledge::destroy($this->selectedPledges);
        $count = count($this->selected);
        $this->selected = [];
        $this->selectedPledges = [];

        if ($count === 1) {
            session()->flash('success', 'Ahadi imefutwa kikamilifu');
        } elseif ($count > 1) {
            session()->flash('success', 'Ahadi zimefutwa kikamilifu');
        }
    }

    public function generatePdf()
    {
        $count = count($this->selectedPledges);

        if ($count === 0) {
            $data = [
                'pledges' => Pledge::all()
            ];
        } else {
            $data = [
                'pledges' => Pledge::query()->whereKey($this->selectedPledges)->get()
            ];
        }

        $pdf = Pdf::loadView('pdfs.pledges-pdf', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'orodha-ya-ahadi.pdf');
    }


    public function exportExcel()
    {
        $count = count($this->selectedPledges);
        if ($count == 0) {
            $pledges = Pledge::all();
            $PledgeIds = $pledges->pluck('id')->toArray();
            return (new PledgesExport($PledgeIds))->download('orodha-ya-ahadi-excel.xlsx');
        }

        return (new PledgesExport($this->selectedPledges))->download('orodha-ya-ahadi-excel.xlsx');
    }

    public function render()
    {
        return view('livewire.pledge-table', [
            'pledges' => Pledge::search($this->search)
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
        ]);
    }
}
