@extends('viewplace')
@section('viewform')
<div class="form-container-update" style='position: absolute; top: 10%; z-index: 1; background-color: white' id="formContainerUpdate">
    <form method="POST" action="{{ route('updateplace', ['id' => $place['DEP_ID']]) }}">
        @csrf
        <label for="depName" class="form-check-label">Газар нэгжийн нэршил:</label>
        <input type="text" id="depName" name="depName" class="form-check-input" value="{{ $place['DEP_NAME'] }}" required><br>

        <label for="status" class="form-check-label">Төлөв:</label>
        <select id="status" name="status" required>
            <option value="A" @if ($place['STATUS'] == 'A') selected @endif>Идэвхитэй</option>
            <option value="N" @if ($place['STATUS'] == 'N') selected @endif>Идэвхгүй</option>
        </select><br>

        <label for="sortOrder" class="form-check-label">Эрэмбэ:</label>
        <input type="text" class="form-check-input" id="sortOrder" name="sortOrder" value="{{ $place['SORT_ORDER'] }}"><br>

        <label class="form-check-label" for="parentDepId">Эцэг газар нэгж:</label>
        <select id="parentDepId" name="parentDepId" required>
            <option value="001">Төлөвлөлт удирдах зөвлөл-1</option>
            <option value="002">Төлөвлөлт удирдах зөвлөл-2</option>
        </select><br>

        <label class="form-check-label" for="directorEmpId">Захирал:</label>
        <select id="directorEmpId" name="directorEmpId" required>
            <option value="00000">[Сонгоно уу]</option>
            <option value="00012">Захирал</option>
        </select><br>

        <button class="btn btn-primary" type="submit">Засах</button>
        <button class="btn btn-danger" type="button" onclick="window.location='{{ route('viewplace') }}'">Буцах</button>
    </form>
</div>
@endsection
