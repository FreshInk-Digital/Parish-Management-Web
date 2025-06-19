<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AnnouncementsExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementsTable extends Component
{
    use withPagination;

    public $search = '';
    public $perPage = 5;
    public $isSelectedAll = false;
    public $selectedAnnouncements = [];
    public $selected = [];
    public $authUser;

    public function mount()
    {
        $this->authUser = Auth::user();
    }

    public function toggleSelectedAll()
    {
        $announcements = Announcement::all();

        if ($this->isSelectedAll) {
            $this->selectedAnnouncements = $announcements->pluck('id')->toArray();
        } else {
            $this->selectedAnnouncements = [];
        }
    }

    // public function deleteSelectedGroups()
    // {
    //     $this->selected = $this->selectedAnnouncements;
    //     Announcement::destroy($this->selectedAnnouncements);
    //     $count = count($this->selected);
    //     $this->selected = [];
    //     $this->selectedAnnouncements = [];

    //     if ($count === 1) {
    //         session()->flash('success', 'Tangazo limefutwa kikamilifu');
    //     } elseif ($count > 1) {
    //         session()->flash('success', 'Matangazo yamefutwa kikamilifu');
    //     }
    // }


    public function deleteSelectedGroups()
    {
        $this->selected = $this->selectedAnnouncements;
        $count = count($this->selected);

        // Loop through each selected announcement
        foreach ($this->selected as $id) {
            $announcement = Announcement::find($id);

            if ($announcement && $announcement->announcement_asset) {
                // Delete the file from public storage if it exists
                if (Storage::disk('public')->exists($announcement->announcement_asset)) {
                    Storage::disk('public')->delete($announcement->announcement_asset);
                }

                // Delete the announcement record
                $announcement->delete();
            }
        }

        // Reset selected arrays
        $this->selected = [];
        $this->selectedAnnouncements = [];

        // Flash message
        if ($count === 1) {
            session()->flash('success', 'Tangazo limefutwa kikamilifu');
        } elseif ($count > 1) {
            session()->flash('success', 'Matangazo yamefutwa kikamilifu');
        }
    }


    public function generatePdf()
    {
        $count = count($this->selectedAnnouncements);

        if ($count === 0) {
            $data = [
                'announcements' => Announcement::all()
            ];
        } else {
            $data = [
                'announcements' => Announcement::query()->whereKey($this->selectedAnnouncements)->get()
            ];
        }

        $pdf = Pdf::loadView('pdfs.announcements-pdf', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'orodha-ya-matangazo.pdf');
    }


    public function exportExcel()
    {
        $count = count($this->selectedAnnouncements);
        if ($count == 0) {
            $announcements = Announcement::all();
            $announcementIds = $announcements->pluck('id')->toArray();
            return (new AnnouncementsExport($announcementIds))->download('orodha-ya-matangazo-excel.xlsx');
        }

        return (new AnnouncementsExport($this->selectedAnnouncements))->download('orodha-ya-matangazo-excel.xlsx');
    }

    public function render()
    {
        return view('livewire.announcements-table', [
            'announcements' => Announcement::search($this->search)
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage),
        ]);
    }
}
