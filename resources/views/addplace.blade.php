@extends('viewplace')
@section('viewform')
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
    <form id="registrationForm" method="POST" action="{{ route('addform') }}">
        @csrf
        <label for="depName" class="form-check-label">Газар нэгжийн нэршил</label>
        <input type="text" class="form-check-input" id="depName" name="depName" required>

        <label for="status" class="form-check-label">Төлөв</label>
        <select id="status" name="status" required>
            <option value="A">Идэвхитэй</option>
            <option value="N">Идэвхгүй</option>
        </select>

        <label for="sortOrder" class="form-check-label">Эрэмбэ</label>
        <input type="text" class="form-check-input" id="sortOrder" name="sortOrder">

        <label for="parentDepId" class="form-check-label">Эцэг газар нэгж</label>
        <select id="parentDepId" name="parentDepId" required>
            <option value="001">Төлөвлөлт удирдах зөвлөл-1</option>
            <option value="002">Төлөвлөлт удирдах зөвлөл-2</option>
        </select>

        <label for="directorEmpId" class="form-check-label">Захирал</label>
        <select id="directorEmpId" name="directorEmpId" required>
            <option value="00000">[Сонгоно уу]</option>
            <option value="00012">Захирал</option>
        </select>

        <button class="btn btn-primary" type="submit" name="submit">Хадгалах</button>
        <button class="btn btn-danger" type="button" onclick="window.location='{{ route('viewplace') }}'">Буцах</button>
    </form>
</div>  
@endsection
