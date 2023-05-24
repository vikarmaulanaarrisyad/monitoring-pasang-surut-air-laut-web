<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('post')

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="categories">Kategori</label>
                <select name="categories" id="categories" class="select2">
                    @foreach ($category as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="short_description">Deskripsi Singkat</label>
        <textarea name="short_description" id="short_description" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="body">Konten</label>
        <textarea name="body" id="body" rows="3" class="form-control summernote"></textarea>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="publish_date">Tanggal Publish</label>
                <div class="input-group datetimepicker" id="publish_date" data-target-input="nearest">
                    <input type="text" name="publish_date" class="form-control datetimepicker-input"
                        data-target="#publish_date" data-toggle="datetimepicker" />
                    <div class="input-group-append" data-target="#publish_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="custom-select">
                    <option disabled selected>Pilih salah satu</option>
                    <option value="publish">Publish</option>
                    <option value="archived">Diarsipkan</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <div class="form-group">
                <label for="path_image">Gambar</label>
                <div class="custom-file">
                    <input type="file" name="path_image" class="custom-file-input" id="path_image"
                        onchange="preview('.preview-path_image', this.files[0])">
                    <label class="custom-file-label" for="path_image">Choose file</label>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
    </x-slot>

</x-modal>
