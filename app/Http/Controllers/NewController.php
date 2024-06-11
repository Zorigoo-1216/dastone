<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    public function viewposition()
    {
        return view('viewposition');
    }

    public function addposition()
    {
        return view('addposition');
    }

    public function addFormpos()
    {
        $conn = $this->db_conn(); 

        if (isset($_POST['submit'])) {
            $posName = $_POST['posName'];
            $status = $_POST['status'];
            $sortOrder = $_POST['sortOrder'];
            $editEmpId = '6666';
            $editDate = date('Y-m-d');

            $sql = "INSERT INTO ORG_POSITION (POS_NAME, STATUS, EDIT_DATE, EDIT_EMPID, SORT_ORDER) 
                    VALUES ('$posName', '$status', '$editDate', '$editEmpId','$sortOrder')";

            if (mysqli_query($conn, $sql)) {
                return view('addposition');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    public function deleteposition($id)
    {
        $conn = $this->db_conn(); 

        $sql = "DELETE FROM ORG_POSITION WHERE POS_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('viewposition');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function updateposition(Request $request, $id)
    {
        $conn = $this->db_conn(); 
    
        if ($request->isMethod('post')) {
            $posName = $request->input('posName');
            $status = $request->input('status');
            $sortOrder = $request->input('sortOrder');
            $editEmpId = '6666';
            $editDate = date('Y-m-d');
    
            $sql = "UPDATE ORG_POSITION SET 
                        POS_NAME='$posName', 
                        STATUS='$status', 
                        EDIT_DATE='$editDate', 
                        EDIT_EMPID='$editEmpId', 
                        SORT_ORDER='$sortOrder'
                    WHERE POS_ID='$id'";
    
            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                return redirect()->route('viewposition');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    
        $sql = "SELECT * FROM ORG_POSITION WHERE POS_ID='$id'";
        $result = mysqli_query($conn, $sql);
        $place = mysqli_fetch_assoc($result);
    
        mysqli_close($conn);
    
        return view('updateposition', compact('place'));
    }
    







    public function showForm()
    {
        $conn = $this->db_conn();
        $sql = "SELECT D.DEP_ID, D.DEP_NAME, D.STATUS, D.SORT_ORDER, LEVEL
                FROM ORG_DEPARTMENT D
                LEFT JOIN ORG_EMPLOYEE E ON E.EMP_ID = D.DIRECTOR_EMPID
                WHERE D.STATUS != 'D'
                START WITH D.PARENT_DEPID IS NULL
                CONNECT BY PRIOR D.DEP_ID = D.PARENT_DEPID AND D.STATUS != 'D'
                ORDER SIBLINGS BY D.SORT_ORDER";
        
        $result = mysqli_query($conn, $sql);
        $departments = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $departments[] = $row;
        }

        mysqli_close($conn);

        return view('addplace', compact('departments'));
    }

    public function viewplace()
    {
        return view('viewplace');
    }

    public function addplace()
    {
        return view('addplace');
    }

    private function db_conn()
    {
        $sname = "localhost";
        $uname = "root"; 
        $password = "";
        $db_name = "dastone";

        $conn = mysqli_connect($sname, $uname, $password, $db_name); 

        if (!$conn) {
            echo "Connection failed!";
        } else {
            return $conn;
        }
    }

    public function addForm()
    {
        $conn = $this->db_conn(); 

        if (isset($_POST['submit'])) {
            $depName = $_POST['depName'];
            $status = $_POST['status'];
            $sortOrder = $_POST['sortOrder'];
            $parentDepId = $_POST['parentDepId'];
            $directorEmpId = $_POST['directorEmpId'];
            $approveEmpId = '9999';
            $editEmpId = '6666';
            $editDate = date('Y-m-d');

            $sql = "INSERT INTO ORG_DEPARTMENT (DEP_NAME, STATUS, SORT_ORDER, PARENT_DEPID, DIRECTOR_EMPID, APPROVE_EMPID, EDIT_EMPID, EDIT_DATE) 
                    VALUES ('$depName', '$status', '$sortOrder', '$parentDepId', '$directorEmpId', '$approveEmpId', '$editEmpId', '$editDate')";

            if (mysqli_query($conn, $sql)) {
                return view('addplace');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    public function deleteplace($id)
    {
        $conn = $this->db_conn(); 

        $sql = "DELETE FROM ORG_DEPARTMENT WHERE DEP_ID='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('viewplace');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function updateplace(Request $request, $id)
    {
        $conn = $this->db_conn(); 

        if ($request->isMethod('post')) {
            $depName = $request->input('depName');
            $status = $request->input('status');
            $sortOrder = $request->input('sortOrder');
            $parentDepId = $request->input('parentDepId');
            $directorEmpId = $request->input('directorEmpId');
            $approveEmpId = '9999';
            $editEmpId = '6666';
            $editDate = date('Y-m-d');

            $sql = "UPDATE ORG_DEPARTMENT SET 
                        DEP_NAME='$depName', 
                        STATUS='$status', 
                        SORT_ORDER='$sortOrder', 
                        PARENT_DEPID='$parentDepId', 
                        DIRECTOR_EMPID='$directorEmpId', 
                        APPROVE_EMPID='$approveEmpId', 
                        EDIT_EMPID='$editEmpId', 
                        EDIT_DATE='$editDate' 
                    WHERE DEP_ID='$id'";

            if (mysqli_query($conn, $sql)) {
                mysqli_close($conn);
                return redirect()->route('viewplace');
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        $sql = "SELECT * FROM ORG_DEPARTMENT WHERE DEP_ID='$id'";
        $result = mysqli_query($conn, $sql);
        $place = mysqli_fetch_assoc($result);

        mysqli_close($conn);

        return view('updateplace', compact('place'));
    }
}
