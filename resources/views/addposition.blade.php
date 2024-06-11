@extends('viewposition')

@section('viewpos')
<div class="form-container" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainer">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="registrationForm" method="POST" action="{{ route('addformpos') }}">
        @csrf
        <label for="posName" class="form-check-label">Албан тушаалын нэршил</label>
        <input type="text" class="form-check-input" id="posName" name="posName" required>

        <label for="status" class="form-check-label">Төлөв</label>
        <select id="status" name="status" required>
            <option value="Идэвхитэй">Идэвхитэй</option>
            <option value="Идэвхгүй">Идэвхгүй</option>
        </select>

        <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
        <input type="text" class="form-check-input" id="sortOrder" name="sortOrder">

        <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
        <button class="btn btn-danger" type="button" onclick="window.location='{{ route('viewposition') }}'">Буцах</button>
    </form>
</div>  
@endsection
