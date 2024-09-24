<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Cerita;  // Pastikan Anda mengimpor model Story
use Livewire\WithFileUploads;
use App\Models\Komentar;

class Story extends Component
{
    use WithFileUploads;
    
    public $ceritabaru = false;
    public $judul, $cerita, $gambar, $memberterpilih, $komentar;

    public function pilihMember($id){
        $this->memberterpilih = $id;
    }

    public function simpanCerita()
    {
        $this->validate([
            'judul' => 'required',
            'cerita' => 'required',
            'gambar' => 'image|max:1024',
        ]);

        // Simpan gambar ke storage
        $this->gambar->store('gambar', 'public');

        // Menggunakan helper auth() untuk mendapatkan ID pengguna
        $userId = auth()->id();  // Gunakan auth()->id() untuk mendapatkan ID pengguna

        if ($userId) {
            Cerita::create([
                'user_id' => $userId,
                'judul' => $this->judul,
                'isi' => $this->cerita,
                'foto' => $this->gambar->hashName(),
            ]);

            // Reset form setelah menyimpan cerita
            $this->reset();
        } else {
            // Penanganan jika user tidak login (opsional)
            session()->flash('error', 'Anda harus login untuk membuat cerita.');
            return redirect()->route('login'); // Arahkan ke halaman login
        }
    }

    public function simpanKomentar($id){
        $this->validate([
            'komentar' => 'required'
        ]);

        Komentar::create([
            'user_id' => auth()->id(),
            'cerita_id' => $id,
            'isi' => $this->komentar
        ]);

        $this->reset();
    }

    public function buatCeritaBaru()
    {
        $this->ceritabaru = true;
    }

    public function batal()
    {
        $this->reset();
    }

    public function render()
    {
        // Pastikan auth()->user()->id digunakan dengan benar di sini
        $semuamemberkecualisaya = User::all()->except(auth()->user()->id);
        if ($this->memberterpilih) {
            $semuacerita = Cerita::with('user')->where('user_id', $this->memberterpilih)->latest()->get();
        }else{
            $semuacerita = Cerita::with('user')->where('user_id', auth()->user()->id)->latest()->get();
        }


        return view('livewire.story')->with([
            'semuamemberkecualisaya' => $semuamemberkecualisaya,
            'semuacerita' => $semuacerita
        ]);
    }
}
