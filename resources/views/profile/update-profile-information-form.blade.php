 <form class="form-horizontal" action="{{ route('user-profile-information.update') }}" method="post" enctype="multipart/form-data">
     @csrf
     @method('PUT')
     <div class="form-group row">
         <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
         <div class="col-sm-10">
             <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName"
                 autocomplete="off" value="{{ old('name') ?? Auth()->user()->name }}">

             @error('name')
                 <span class="invalid-feedback">{{ $message }}</span>
             @enderror
         </div>
     </div>
     <div class="form-group row">
         <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
         <div class="col-sm-10">
             <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                 id="inputEmail" autocomplete="off" value="{{ old('email') ?? Auth()->user()->email }}">

             @error('email')
                 <span class="invalid-feedback">{{ $message }}</span>
             @enderror
         </div>
     </div>
     <div class="form-group row">
         <label for="inputSkills" class="col-sm-2 col-form-label">Avatar</label>
         <div class="col-sm-10">
             <input type="file" class="form-control  @error('avatar') is-invalid @enderror" name="avatar">
         </div>

         @error('avatar')
             <span class="invalid-feedback">{{ $message }}</span>
         @enderror
     </div>
     <div class="form-group row">
         <div class="offset-sm-2 col-sm-10">
             <button type="submit" class="btn btn-success">Simpan</button>
         </div>
     </div>
 </form>
