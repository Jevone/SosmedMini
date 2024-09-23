<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Saya</div>

                    <div class="card-body">
                        <h1>{{ Auth()->user()->name }}</h1>
                        @foreach ($semuamemberkecualisaya as $member )
                            <button class="btn btn-outline-primary">{{ $member->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if ($ceritabaru)
                    <button class="btn btn-danger btn-sm mb-2" wire:click ='batal'>Batal</button>
                @else
                    <button class="btn btn-primary btn-sm mb-2" wire:click ='buatCeritaBaru'>Tambah Story</button>
                @endif
                <i class="fas fa-sync fa-spin" wire:loading> </i>
                @if ($ceritabaru)
                <div class="card">
                    <div class="card-header">
                        Buat Cerita Baru
                    </div>
                    <div class="card-body">
                        ini tempat form cerita
                    </div>
                </div>
                @endif
                <div class="card shadow-lg ">
                    <div class="card-header">Judul Story</div>

                    <div class="card-body">
                        Story
                        <hr />
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tulis Komentar">
                            <button class="btn btn-primary">Kirim</button>
                        </div>
                        <br />
                        Daftar Komentar
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
