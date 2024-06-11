@extends('layout.app')

@section('content')
<div class="container">
    <h2>Ажилтны мэдээллийг засах</h2>
    <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="last_name">Эцэг/эхийн нэр:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}" required>
        </div>
        <div class="form-group">
            <label for="first_name">Өөрийн нэр:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" required>
        </div>
        <div class="form-group">
            <label for="reg_number">Регистрийн дугаар:</label>
            <input type="text" class="form-control" id="reg_number" name="reg_number" value="{{ $employee->reg_number }}" required>
        </div>
        <div class="form-group">
            <label for="position">Албан тушаал:</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" required>
        </div>
        <div class="form-group">
            <label for="email">И-мэйл:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Гар утасны дугаар:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}" required>
        </div>
        <div class="form-group">
            <label for="gender">Хүйс:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Эрэгтэй</option>
                <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Эмэгтэй</option>
            </select>
        </div>
        <div class="form-group">
            <label for="birth_date">Төрсөн өдөр:</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $employee->birth_date }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Ажилд орсон өдөр:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $employee->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="home_number">Гэрийн утасны дугаар:</label>
            <input type="text" class="form-control" id="home_number" name="home_number" value="{{ $employee->home_number }}">
        </div>
        <div class="form-group">
            <label for="work_number">Ажлын утасны дугаар:</label>
            <input type="text" class="form-control" id="work_number" name="work_number" value="{{ $employee->work_number }}">
        </div>
        <div class="form-group">
            <label for="photo">Зураг:</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <div class="form-group">
            <label for="state">Төлөв:</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ $employee->state }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Хадгалах</button>
    </form>
</div>
@endsection
