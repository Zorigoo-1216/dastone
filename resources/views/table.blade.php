@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="topbar">
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav mb-0">
                <h4 class="page-title" style="margin: 10px;">Ажилтнуудын жагсаалт</h4>
                <button class="btn btn-sm btn-soft-primary" onclick="window.location='{{ route('employee.create') }}'" style="margin: 10px; margin-top: 30px;">+ Шинээр бүртгэх</button>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <?php
                $sname = "localhost";
                $unmae = "root";
                $password = "Zorigt@#1216";
                $db_name = "mydemodb";
                $conn = mysqli_connect($sname, $unmae, $password, $db_name);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM employees";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='card-body'>";
                    echo "<div class='table-rep-plugin'>";
                    echo "<div class='table-responsive mb-0' data-pattern='priority-columns'>";
                    echo "<table id='tech-companies-1' class='table table-striped mb-0'>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Эцэг/эхийн нэр</th>
                                <th>Өөрийн нэр</th>
                                <th>Регистрийн дугаар</th>
                                <th>Албан тушаал</th>
                                <th>Цахим шуудан</th>
                                <th>Гар утас</th>
                                <th>Төлөв</th>
                                <th>Үйлдэл</th>
                            </tr>
                            </thead>
                            <tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["last_name"] . "</td>
                                <td>" . $row["first_name"] . "</td>
                                <td>" . $row["reg_number"] . "</td>
                                <td>" . $row["position"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phone_number"] . "</td>
                                <td>" . $row["state"] . "</td>
                                <td>
                                    <a class='btn btn-sm btn-warning' href='" . route('employee.edit', ['id' => $row['id']]) . "'>Засах</a>
                                    <form action='" . route('employee.destroy', ['id' => $row['id']]) . "' method='POST' style='display:inline-block;'>
                                        " . csrf_field() . "
                                        " . method_field('DELETE') . "
                                        <button type='submit' class='btn btn-sm btn-danger'>Устгах</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                    echo "</tbody></table>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "0 results";
                }

                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </ul>
        </nav>
    </div>
</div>
@endsection
