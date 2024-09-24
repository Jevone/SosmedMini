<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Saya</div>

                    <div class="card-body">
                        <h1>{{ Auth()->user()->name }}</h1>
                        <hr />
                        <button class="btn btn-warning" wire:click ='batal'>Status Saya</button>
                        @foreach ($semuamemberkecualisaya as $member )
                            <button class="btn {{ $member->id == $memberterpilih ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="pilihMember({{ $member->id }})">{{ $member->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @if ($ceritabaru)
                    <button class="btn btn-danger btn-sm" wire:click ='batal'>Batal</button>
                @else
                    <button class="btn btn-primary btn-sm" wire:click ='buatCeritaBaru'>Tambah Story</button>
                @endif
                <i class="fas fa-sync fa-spin" wire:loading> </i>
                @if ($ceritabaru)
                <div class="card">
                    <div class="card-header">
                        Buat Cerita Baru
                    </div>
                    <div class="card-body">
                        <form wire:submit = 'simpanCerita'>
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" wire:model = 'judul'>
                                @error('judul')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cerita">Cerita</label>
                                <textarea class="form-control" name="cerita" id="cerita" rows="3" wire:model="cerita"></textarea>
                                @error('cerita')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" class="form-control" id="gambar" wire:model='gambar'>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
                @endif

                @foreach ( $semuacerita as $c )
                    <div class="card shadow-lg ">
                        <div class="card-header">{{ $c->judul }}</div>

                        <div class="card-body">
                            <img src="{{ asset('storage/gambar/' . $c->foto) }}" class="img-fluid img-thumbnail">
                            <br />
                            {{ $c->isi }}
                            <hr />
                             <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tulis Komentar" wire:model= 'komentar'>
                                <button class="btn btn-primary" wire:click ='simpanKomentar({{ $c->id }})'>Kirim
                                </button>
                                @error('komentar')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <br />
                            @foreach ($c->komentars as $k )
                                <b>{{ $k->user->name }}</b> : {{ $k->isi }} <br />
                            @endforeach
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
